<?php
session_start();
require_once "settings.php";

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Sorry, something went wrong. Please try again later");
}

// if server request method is not post redirect to apply page 
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    error_log("Server request method is not post");
    header("Location: apply.php");
    exit;
}

// Create table if eoi table is not exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS eoi 
(   EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    JobReferenceNumber VARCHAR(50) NOT NULL,
    FirstName VARCHAR(20) NOT NULL,
    LastName VARCHAR(20) NOT NULL,
    StreetAddress VARCHAR(40) NOT NULL,
    Suburb VARCHAR(40) NOT NULL,
    State VARCHAR(3) NOT NULL,
    Postcode VARCHAR(4) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    PhoneNumber VARCHAR(20) NOT NULL,
    Python VARCHAR(50),
    Adobe_Illustrator VARCHAR(50),
    JAVA VARCHAR(50),
    MySQL VARCHAR(50),
    OtherSkills TEXT,
    Status ENUM('New', 'Current', 'Final') DEFAULT 'New' NOT NULL
)";
mysqli_query($conn, $createTableQuery);

// remove leading and trailing spaces, backslashes and HTML control characters.
function clean_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// get all errors if there is invalid input
$errors = [];

// check if there is invalid input
if (empty($_POST["jobNum"])) {
    $errors[] = "Job Reference Number is requiered";
} else {
    $jobRefNumber = clean_input($_POST["jobNum"]);
}

if (empty($_POST["firstName"])) {
    $errors[] = "First is requiered";
} else {
    $firstName = clean_input($_POST["firstName"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
        $errors[] = "Invalid First Name, you should only include charater and space";
    }
}

if (empty($_POST["lastName"])) {
    $errors[] = "Last Name is required";
} else {
    $lastName = clean_input($_POST["lastName"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
        $errors[] = "Invalid Last Name, you should only include charater and space";
    }
}

if (empty($_POST["DoB"])) {
    $errors[] = "Date of Birth is required";
} else {
    $dob = clean_input($_POST["DoB"]);
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $dob)) {
        $errors[] = "Invalid Date of Birth format";
    }
}

if (empty($_POST["Gender"])) {
    $errors[] = "Gender is required";
} else {
    $gender = clean_input($_POST["Gender"]);
    // check if gender is matching with value set in apply.php
    if (!in_array($gender, ['female', 'male', 'notSelected'])) {
        $errors[] = "Invalid Gender";
    }
}

if (empty($_POST["streetAddress"])) {
    $errors[] = "StreetAddress is required";
} else {
    $streetAddress = clean_input($_POST["streetAddress"]);
}

if (empty($_POST["suburbTown"])) {
    $errors[] = "Suburb is required";
} else {
    $suburb = clean_input($_POST["suburbTown"]);
}

if (empty($_POST["state"])) {
    $errors[] = "State is required";
} else {
    $state = clean_input($_POST["state"]);
    $validStates = ["ACT", "NSW", "NT", "QLD", "SA", "TAS", "VIC", "WA"];
    if (!in_array($state, $validStates)) {
        $errors[] = "Invalid State";
    }
}

if (empty($_POST["postcode"])) {
    $errors[] = "Postcode is required";
} else {
    $postcode = clean_input($_POST["postcode"]);
    if (!preg_match("/^[0-9]{4}$/", $postcode)) {
        $errors[] = "Invalid Postcode, Postcode should be exactly 4 digits \- matches state";
    }
}

if (empty($_POST["email"])) {
    $errors[] = "Email is required";
} else {
    $email = clean_input($_POST["email"]);
    // Check if input matchs with email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email";
    }
}

if (empty($_POST["phoneNum"])) {
    $errors[] = "PhoneNumber is required";
} else {
    $phoneNumber = clean_input($_POST["phoneNum"]);
    if (!preg_match("/^(\+?61|0)[0-9]{9}$/", str_replace(" ", "", $phoneNumber))) {
        $errors[] = "Invalid Phone Number";
    }
}

// if at lest one skill is checked, save checkbox values in array
$skills = isset($_POST["skill"]) ? $_POST["skill"] : [];

// set yes if skill is checked, set no if skill is not checked 
$python = in_array("Python", $skills) ? "Yes" : "No";
$adobe = in_array("Adobe Illustrator", $skills) ? "Yes" : "No";
$java = in_array("Java", $skills) ? "Yes" : "No";
$mysql = in_array("MySQL", $skills) ? "Yes" : "No";

// if skills array is empty, requires other skills input.
if (empty($skills)) {
    if ((empty($_POST["otherSkills"]))) {
        $errors[] = "Other skills is required";
    } else {
        $otherSkills = isset($_POST['otherSkills']);
    }
} else {
    $otherSkills = isset($_POST['otherSkills']) ? clean_input($_POST['otherSkills']) : '';
}

if (!empty($errors)) {
    echo "<h1>Form Validation Error</h1>";
    echo "<p>Please correct the following errors:</p>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<p>" . $error . "</p>";
    }
    echo "</ul>";
    echo "<p><a href='apply.php'>Go back to apply page</a></p>";
    exit();
}

$inStmt = $conn->prepare("INSERT INTO eoi (JobReferenceNumber, FirstName, LastName, StreetAddress, 
                                            Suburb, State, Postcode, Email, PhoneNumber, Python, 
                                            Adobe_Illustrator, JAVA, MySQL, OtherSkills, Status)
                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$inStmt->bind_param(
    "sssssssssssssss",
    $jobRefNumber,
    $firstName,
    $lastName,
    $streetAddress,
    $suburb,
    $state,
    $postcode,
    $email,
    $phoneNumber,
    $python,
    $adobe,
    $java,
    $mysql,
    $otherSkills,
    $status
);
$status = 'New';
$inResult = $inStmt->execute();

// if insert query sucess
if ($inResult) {
    $eoiNumber = mysqli_insert_id($conn);
    $selEOInumStmt = $conn->prepare("SELECT * FROM eoi where EOINumber=?");
    $selEOInumStmt->bind_param("s", $eoiNumber);
    $selEOInumStmt->execute();
    $selEOInumResult = $selEOInumStmt->get_result();

    // display info of applicant has current eoinumber 
    if ($user = $selEOInumResult->fetch_assoc()) {
        $_SESSION['EOInumber'] = $eoiNumber;
        if (isset($_SESSION['EOInumber'])) {
            echo "<h1>Your application has submitted</h1>";
            echo "<p>Thank you</p>";
            echo "<p>Your EOI Number is : " . $eoiNumber . "</p>";
            echo "<p>Job Reference Number : " . $jobRefNumber . "</p>";
            echo "<p>Name : " . $firstName . " " . $lastName . "</p>";
            echo "<p>Address : " . $streetAddress . " " . $suburb . " " . $state . "</p>";
            echo "<p>Postcode : " . $postcode . "</p>";
            echo "<p>email : " . $email . "</p>";
            echo "<p>phone : " . $phoneNumber . "</p>";
            echo "<p>Skills : ";
            if ($python == "Yes") echo "Python. ";
            if ($adobe == "Yes") echo "Adobe Illustrater. ";
            if ($java == "Yes") echo "JAVA. ";
            if ($mysql == "Yes") echo "MySQL. ";
            echo "</p>";
            echo "<a href=\"about.php\">Go to about page</a>";
        }
    } else {
        $_SESSION['error'] = "Invalid info. Please try again";
        echo "Invalid info. Please try again";
        header('Location:apply.php');
        exit;
    }
}

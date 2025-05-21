<?php
session_start();
require_once "settings.php";

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if($_SERVER["REQUEST_METHOD"]!="POST"){
    header("Location: apply.php");
    exit();
}

function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$createTableQuery = "CREATE TABLE IF NOT EXISTS eoi (
        EOInumber INT AUTO_INCREMENT PRIMARY KEY,
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

$jobNum = clean_input($_POST['jobNum']);
$firstName = clean_input($_POST['firstName']);
$lastName = clean_input($_POST['lastName']);
$street = clean_input($_POST['streetAddress']);
$suburb = clean_input($_POST['suburbTown']);
$state = clean_input($_POST['state']);
$postcode = clean_input($_POST['postcode']);
$email = clean_input($_POST['email']);
$phone = clean_input($_POST['phoneNum']);
$otherSkills = isset($_POST['otherSkills']) ? clean_input($_POST['otherSkills']) : '';
$skills = isset($_POST['skill']) ? $_POST['skill'] : [];

$skillVals = [
    'Python' => in_array('Python', $skills) ? 'Yes' : 'No',
    'Adobe_Illustrator' => in_array('Adobe Illustrator', $skills) ? 'Yes' : 'No',
    'JAVA' => in_array('Java', $skills) ? 'Yes' : 'No',
    'MySQL' => in_array('MySQL', $skills) ? 'Yes' : 'No'
];
$insertQuery = "INSERT INTO eoi 
(JobReferenceNumber, FirstName, LastName, StreetAddress, Suburb, State, Postcode, Email, PhoneNumber, 
Python, Adobe_Illustrator, JAVA, MySQL, OtherSkills)
VALUES (
    '$jobNum', '$firstName', '$lastName', '$street', '$suburb', '$state', '$postcode', '$email', '$phone', 
    '{$skillVals['Python']}', '{$skillVals['Adobe_Illustrator']}', '{$skillVals['JAVA']}', '{$skillVals['MySQL']}', '$otherSkills'
)";
$insertResult = mysqli_query($conn, $insertQuery);

if($insertResult){
    $query = "SELECT * FROM EOI";
    
    $eoiNumber = mysqli_insert_id($conn);
    
    $result = mysqli_query($conn, $query);
   
    if ($result) {
        $query = "SELECT * FROM eoi where EOINumber='$eoiNumber'";
        $result = mysqli_query($conn, $query);

        if ($user = mysqli_fetch_assoc($result)) 
        {
            $_SESSION['EOInumber'] = $eoiNumber;
            if (isset($_SESSION['EOInumber'])) 
            {
                echo "<h1>Your application has submitted</h1>";
                echo "<p>Thank you</p>";
                echo "<p>Your EOI Number is : " . $eoiNumber . "</p>";
                echo "<p>Job Reference Number : " . $jobNum . "</p>";
                echo "<p>Name : " . $firstName . " " . $lastName . "</p>";
                echo "<p>Address : " . $street . " " . $suburb . " " . $state . "</p>";
                echo "<p>Postcode : " . $postcode . "</p>";
                echo "<p>email : " . $email . "</p>";
                echo "<p>phone : " . $phone . "</p>";
                echo "<p>Skills : ";
                foreach ($skillVals as $skillName => $hasSkill) {
                    if ($hasSkill == "Yes") echo $skillName . ". ";
                }
                echo "</p>";
            }
        } 
        else 
        {
            $_SESSION['error'] = "Invalid info. Please try again";
            echo "Invalid info. Please try again";
            header('Location:apply.php');
            exit;
        }
    }
}
?>
<?php
session_start();

    require_once('settings.php');
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);
    // check if connection failed 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_job_ref'])) {
        // Deleting all EOIs for the selected JobReferenceNumber
        $job_ref = mysqli_real_escape_string($conn, $_POST['delete_job_ref']);
        $delete_sql = "DELETE FROM eoi WHERE JobReferenceNumber = '$job_ref'";
        mysqli_query($conn, $delete_sql);
    } elseif (isset($_POST['update_status'])) {
        $eoi_id = mysqli_real_escape_string($conn, $_POST['eoi_id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $update_sql = "UPDATE eoi SET Status = '$status' WHERE EOInumber = '$eoi_id'";
        mysqli_query($conn, $update_sql);
    }
}

// Fetch all unique Job References for the dropdown
$jobRefQuery = "SELECT DISTINCT JobReferenceNumber FROM eoi";
$jobRefResult = mysqli_query($conn, $jobRefQuery);
$jobReferences = [];
while ($row = mysqli_fetch_assoc($jobRefResult)) {
    $jobReferences[] = $row['JobReferenceNumber'];
}

// Fetch all EOIs from the database
$sql = "SELECT * FROM eoi";
$result = mysqli_query($conn, $sql);

// Apply filtering in PHP (front-end)
$filteredResults = [];
while ($row = mysqli_fetch_assoc($result)) {
    $match = true;

    // Filter based on Job Reference
    if (!empty($_GET['job_ref']) && $_GET['job_ref'] != 'All Jobs' && $row['JobReferenceNumber'] != $_GET['job_ref']) {
        $match = false;
    }

    // Filter based on First Name
    if (!empty($_GET['first_name']) && stripos($row['FirstName'], $_GET['first_name']) === false) {
        $match = false;
    }

    // Filter based on Last Name
    if (!empty($_GET['last_name']) && stripos($row['LastName'], $_GET['last_name']) === false) {
        $match = false;
    }

    // If it matches all criteria, include it in the filtered results
    if ($match) {
        $filteredResults[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This page is accessed by Pixel Protectors admin to manage EOIs">
    <meta name="keywords" content="Pixel Protectors admin, EOI managemet">
    <meta name="author" content="Emma McCormick">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Pixel Protectors EOI Management</title>
    <!-- Embedded link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Website header including logo, nav and email -->
    <?php include 'header.inc'; ?>

    <!-- Login successful and logout option -->
    <?php if (isset($_SESSION['username'])) {
            echo '<p>Logged in as ' . $_SESSION['username'] . ' | <a href="logout.php">Logout</a></p>';
    }
    ?>        

    <br>
    <h1>Manage EOIs</h1>

    <!-- Search Form -->
    <form method="get">
        <div>
            <label for="job_ref">Job Reference:</label>
            <select id="job_ref" name="job_ref">
                <option value="All Jobs" <?= isset($_GET['job_ref']) && $_GET['job_ref'] === 'All Jobs' ? 'selected' : '' ?>>All Jobs</option>
                <?php foreach ($jobReferences as $jobRef): ?>
                    <option value="<?= htmlspecialchars($jobRef) ?>" <?= isset($_GET['job_ref']) && $_GET['job_ref'] === $jobRef ? 'selected' : '' ?>><?= htmlspecialchars($jobRef) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($_GET['first_name'] ?? '') ?>">
        </div>
        <br>
        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($_GET['last_name'] ?? '') ?>">
        </div>
        <br>
        <button class="search-button" type="submit">Search</button>
    </form>
    <br>

    <!-- Delete All EOIs Button (visible when a Job Reference is selected) -->
    <?php if (!empty($_GET['job_ref']) && $_GET['job_ref'] != 'All Jobs'): ?>
        <form method="post" onsubmit="return confirm('Are you sure you want to delete all EOIs for this Job Reference?')">
            <input type="hidden" name="delete_job_ref" value="<?= htmlspecialchars($_GET['job_ref']) ?>">
            <button class="delete-button" type="submit">Delete All EOIs for this Job Reference</button>
        </form>
        <br>
    <?php endif; ?>

    <!-- EOIs Table -->
    <table>
        <thead>
            <tr>
                <th>EOI Number</th>
                <th>Job Reference</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Tech Skills</th>
                <th>Other Skills</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($filteredResults) > 0): ?>
                <?php foreach ($filteredResults as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['EOInumber']) ?></td>
                        <td><?= htmlspecialchars($row['JobReferenceNumber']) ?></td>
                        <td><?= htmlspecialchars($row['FirstName']) ?></td>
                        <td><?= htmlspecialchars($row['LastName']) ?></td>
                        <td><?= htmlspecialchars($row['DateOfBirth']) ?></td>
                        <td><?= htmlspecialchars($row['Gender']) ?></td>
                        <td><?= htmlspecialchars("{$row['StreetAddress']}, {$row['Suburb']}, {$row['State']} {$row['Postcode']}") ?></td>
                        <td><?= htmlspecialchars($row['Email']) ?></td>
                        <td><?= htmlspecialchars($row['PhoneNumber']) ?></td>
                        <td><?= htmlspecialchars("{$row['Python']}, {$row['Adobe_Illustrator']}, {$row['JAVA']} {$row['MySQL']}") ?>
                        <td><?= htmlspecialchars($row['OtherSkills']) ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="eoi_id" value="<?= $row['EOInumber'] ?>">
                                <select name="status" onchange="this.form.submit()">
                                    <option value="New" <?= $row['Status'] === 'New' ? 'selected' : '' ?>>New</option>
                                    <option value="Current" <?= $row['Status'] === 'Current' ? 'selected' : '' ?>>Current</option>
                                    <option value="Final" <?= $row['Status'] === 'Final' ? 'selected' : '' ?>>Final</option>
                                </select>
                                <input type="hidden" name="update_status" value="1">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="14">No records found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <br>
    <br>
    <br>

    <?php mysqli_close($conn); ?>
    
    <!-- Footer content containing page links, logo and JIRA project link -->
    <?php include 'footer.inc'; ?>   
</body>
</html>

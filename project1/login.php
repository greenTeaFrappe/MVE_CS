<?php
    require_once('settings.php');
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);
    // check if connection failed 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pixel Protectors admin login to manage EOIs">
    <meta name="keywords" content="admin login, EOI management">
    <meta name="author" content="Emma McCormick">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Pixel Protector Admin Login</title>
    <!-- Embedded link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Website header including logo, nav and email -->
    <?php include 'header.inc'; ?>  
    <h1>Admin Login</h1>
        <!-- User login form -->
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <br>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <br>
            <br>
            <input type="submit" value="Login">
        </form>
    <!-- End of login form -->

    <!-- Login Process -->
    <?php
    session_start(); // Important to start the session

    require_once('settings.php');
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);

    // Check if connection failed 
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Run login logic only after form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize user input
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Use prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ? AND password = ?");
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['username'] = $user['username'];
            header("Location: manage.php");
            exit();
        } else {
            echo "<p style='color:red;'>❌ Incorrect username or password.</p>";
        }
    }
    ?>
    <br>
    <br>
    <!-- Footer content containing page links, logo and JIRA project link -->
    <?php include 'footer.inc'; ?> 
</body>
</html>
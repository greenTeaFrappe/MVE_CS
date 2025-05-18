<?php
require_once "settings.php";
$dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);
if($dbconn){
    $query = "SELECT * FROM EOI";

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

    $result = mysqli_query($dbconn, $query);
   
}
?>
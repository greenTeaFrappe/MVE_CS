<?php
    require_once('settings.php');
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This page outlilnes the jobs available at Pixel Protectors have openings for">
    <meta name="keywords" content="job, software engineer, cyber security, programmer, data analyst">
    <meta name="author" content="Vanessa Giuliano">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Explore our jobs!</title>
    <!-- Embedded link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
     <!-- Website header including logo, nav and email -->
     <?php include 'header.inc'; ?>
    <!--Pages main title, introducing the pages intention-->
    <section>
        <h1 id="hiring">We&apos;re Hiring!</h1>
        <p id="pagedes">Want to join a diverse and supportive team? Discover jobs we currently have openings for!</p>
    </section><br>
   <!--Main page contents including details of jobs-->
    <article>
            <?php
                // creating dynamic button links to job desciptions from database
                $query = "SELECT id, title FROM jobs";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        echo "<a class='button' href='#job" . $id . "'>$title</a>";
                    }
                }
                echo "<div id='jobcontent'>";
                    // accessing job info from the jobs table in the database
                    $query = "SELECT * FROM jobs";
                    $result = mysqli_query($conn, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        // complete while loop for each row of the jobs table 
                        while($row = mysqli_fetch_assoc($result)) {
                            $id = ($row['id']);
                            $title = ($row['title']);
                            $description = ($row['description']);
                            $salary = ($row['salary']);
                            $ref_number = ($row['ref_number']);
                            echo "<div id='job" . $id . "'>";
                                echo "<h2><strong>$title</strong></h2>";
                                echo "<p>$description</p>";
                                echo "<h3>Resonsibilities:</h3>";
                                //for loop iterating over each line of responsibilities to print them as a list in html
                                $lines = explode("\n", $row['responsibilites']);
                                echo "<ul>";
                                foreach ($lines as $line) {
                                    $line = trim($line);
                                    echo "<li>" . $line . "</li>";
                                }
                                echo "</ul>";
                                echo "<h3>Requirements:</h3>";
                                //for loop iterating over each line of responsibilities and its sub list to print them as a list in html
                                $lines = explode("\n", $row['requirements']);
                                echo "<ol>";
                                //for each sub line in the requirements column create a sublist, or else create a regular list item
                                foreach ($lines as $line) {
                                    $line = trim($line);
                                        if (str_starts_with($line, '- ')) {
                                            echo "<ul><li>" . substr($line, 2) . "</li></ul>";
                                        } else {
                                        echo "<li>" . $line . "</li>";
                                        }
                                    }
                                echo "</ol>";
                                // key information about job
                                echo "<h3>Key Information:</h3>";
                                echo "<p>Job Title: $title</p>";
                                echo "<p>Salary: &dollar;$salary</p>";
                                echo "<p>Reference Number: $ref_number</p><br>";
                                echo "<a href='apply.php' class='button'>Apply now</a>";
                            echo "</div>";
                        }      
                    }
                    ?>
                    <!--side content including facts and statements about the company-->
                    <div id='extra'>
                        <aside>
                            <br>
                            <p class="funfact"><strong>Join a diverse team!</strong></p><br>
                            <p class="funfact"><strong>Rated #1 in job satisfaction</strong></p><br>
                            <p class="funfact"><strong>Enjoy healthcare benefits</strong></p><br>
                            <p class="funfact"><strong>Develop your career with our upskill events</strong></p><br>
                            <p class="funfact"><strong>Work comfortably with blended in-office and work-from-home modes</strong></p><br>
                            <!--AI generated paragraph, Prompt: Generate a paragraph a company would write about thier values towards workers -->
                            <br><hr><br>
                            <p>At Pixel Protectors, our people are the heart of our success, and we deeply value their contributions. We are committed to fostering a supportive and inclusive environment where every individual feels respected, valued, and empowered to thrive. We believe in investing in our employees&apos; growth through continuous learning opportunities, providing fair compensation and benefits, and prioritising their well-being. Open communication, collaboration, and a culture of trust are fundamental to how we operate, ensuring that every team member has a voice and the opportunity to make a meaningful impact. We strive to create a workplace where individuals can build fulfilling careers and feel a strong sense of belonging.</p>
                            <br><hr><br>
                            <p id="partners">Leading the way with our amazing partners!</p>
                            <!--images and links to partner webistes-->
                            <a href="https://github.com" target="_blank" title="GitHub"><img src="images/github_logo.png" alt="The GitHub logo" loading="lazy"><br></a>
                            <a href="https://www.rsm.global" target="_blank" title="RSM Global"><img src="images/RSM_logo..jpg" alt="The RSM global logo" loading="lazy"></a><br>
                            <a href="https://www.swinburne.edu.au" target="_blank" title="Swinburne University of Technology"><img src="images/swin_logo.png" alt="The Swinburne University logo" loading="lazy"></a>
                            <!--images from Github, RSM Global and Swinburne University websites-->
                        </aside>
                    </div>
                <?php
                echo "</div>";
                ?>
    </article>
     <!-- Footer content containing page links, logo and JIRA project link -->
     <?php include 'footer.inc'; ?>     
</body>
</html>
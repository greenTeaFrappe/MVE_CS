<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Meet the experts behind Pixel Protectors cyber security solutions. Learn more about our skillsets and hobbies.">
   <meta name="keywords" content="cyber, security, pixel protectors team">
   <meta name="author" content="Emma McCormick">
   <title>About Us - Get to know the Pixel Protectors team</title>
   <!-- CSS link styles link  -->
   <link href="styles/styles.css" rel="stylesheet">
   <!-- Embedded link -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Website header including logo, nav and email -->
    <?php include 'header.inc'; ?>
   <!-- Start of main content for the About page -->
   <main>
      <h1>Get to know the Pixel Protectors team!</h1>
         <div id="about-main" class="container">
            <!-- This section includes teams interests and skillsets contained within a table element -->
            <section id="about-table">
               <table>
                  <caption><h3>Team skillsets and interests</h3></caption>
                  <thead>
                     <tr>
                        <th>Team Member</th>
                        <th colspan="2">Skillsets and Interests</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <th>Minjin</th>
                        <td>
                           <strong>Skillsets:</strong>
                           <br>HTML
                           <br>CSS
                           <br>JS
                           <br>SQL
                           <br>CSS
                           <br>kotlin
                           <br>c++
                        </td>
			               <td>
                           <strong>Interests:</strong>
                           <br>Video and Nintendo games
                           <br>Sci-Fi movies
                           <br>K-pop
                           <br>J-pop
                           <br>Swimming
                           <br>kotlin
                           <br>c++
                        </td>
                     </tr>
                     <tr class="tr-odd">
                        <th>Vanessa</th>
                        <td>
                           <strong>Skillsets:</strong>
                           <br>Python
                           <br>HTML
                           <br>CSS
                           <br>Adobe Illustrator
                        </td>
			               <td>
                           <strong>Interests:</strong>
                           <br>Reading
                           <br>Sci-Fi and fantasy novels
                           <br>Horror movies
                           <br>Video games
                           <br>AFL
                        </td>
                     </tr>
                     <tr>
                        <th>Emma</th>
			               <td>
                           <strong>Skillsets:</strong>
                           <br>Adobe creative suite
                           <br>HTML
                           <br>CSS
                           <br>Digital marketing strategist
                           <br>Digital project management
                        </td>
			               <td>
                           <strong>Interests:</strong>
                           <br>Tennis
                           <br>Hiking
                           <br>Travel
                           <br>Drawing
                           <br>World's cutest dog - my dog Winnie
                        </td>
                     </tr>
                  </tbody>
               </table>
            </section>

            <!-- Section with team photo and class/student details formatted in lists -->
            <section id="team-details">
               <figure>
                  <img src="images/MVE_team-photo.jpg" alt="Pixel Protectors team photo" title="Pixel Protectors team photo">
                  <figcaption>Pixel Protectors team. Pictured left to right: Emma, Minjin, and Vanessa.</figcaption>
               </figure>
               <ul>
                  <li><h4>Group Details</h4>
                     <ul>
                        <li>Class: Friday 10:30 - 12:30</li>
                        <li>Tutor: Nick</li>
                        <li>Code: G04-mve</li>
                     </ul>
                  </li>
                  <li><h4>Group Members</h4>
                     <ul>
                        <li>Minjin Kim - 105686638</li>
                        <li>Vanessa Giuliano - 105853801</li>
                        <li>Emma McCormick - 100628622</li>
                     </ul>
                  </li>
               </ul>
            </section>
            

            <!-- This section outlines team roles and resposibilities in a definition list -->
            <section id="team-roles">
               <h3>Roles and Responsibilities</h3>
               <dl>
                  <dt><strong>Minjin</strong></dt>
                     <dd>Group leader.<br>Developed all HTML, PHP, and CSS used on <em>apply.php</em> and <em>process_eoi.php</em>.<br>Created <em>eoi table</em> in MySQL database.</dd>
                  <dt><strong>Vanessa</strong></dt>
                     <dd>Developed all HTML, PHP, and CSS used on <em>jobs.php</em>.<br>Created <em>settings.php</em> file.<br>Coverted header and footer into <em>.inc</em> files.<br>Created <em>jobs table</em> in MySQL database.</dd>
                  <dt><strong>Emma</strong></dt>
                     <dd>Developed header and footer HTML and CSS.<br>Developed all HTML, PHP, and CSS used on <em>about.php</em>, <em>manage.php</em>, <em>login.php</em>, and <em>logout.php</em>.<br>Created <em>user table</em> in MySQL database.</dd>
                  <dt><strong>Team</strong></dt>
                     <dd>Developed <em>index.php</em>.<br>Created general site styles guides.<br>Group presentation.</dd>
               </dl>
            </section>
         </div>
   </main>

    <!-- Footer content containing page links, logo and JIRA project link -->
    <?php include 'footer.inc'; ?>
</body>
</html>
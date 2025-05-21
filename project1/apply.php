<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Job application page">
        <meta name="keywords" content="job application, cs, job, apply">
        <meta name="author" content="Minjin Kim">
        <title>Apply</title>
        <!-- CSS -->
        <link href="styles/styles.css" rel="stylesheet">
        <!-- Embedded code -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    </head>
    <body>
         <!-- Website header including logo, nav and email -->
         <?php include 'header.inc'; ?>
        <h1 id="applyH1">Job <br> application</h1>
        <main>
            <form action="process_eoi.php" method="POST">
                <fieldset class="applyFieldset">
                    <legend class="legends">job number</legend>
                    <label for="jobNum">Job reference number</label>
                    <br>
                        <select id="jobNum" name="jobNum" style="width: 205px; height: 41px; margin-top: 20px">
                            <option value="none" selected disabled>select</option>
                            <option value="G01">Software Developer</option>
                            <option value="G02">Network Administrator</option>
                            <option value="G03">Data Analyst</option>
                            <option value="G04">Cybersecurity Specialist</option>
                            <option value="G05">IT Support Technician</option>
                            <option value="G06">Cloud Engineer</option>
                            <option value="G07">AI/ML Engineer</option>
                        </select>
                </fieldset>

                <fieldset class="applyFieldset">
                    <legend class="legends">applicant details</legend>
                    <p id="applicationDetails">
                      <span>
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" minlength="1" maxlength="15" pattern="[a-zA-Z]{1,15}" required>
                      </span>
                  
                      <span>
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" minlength="1" maxlength="15" pattern="[a-zA-Z]{1,15}" required>
                      </span>
                    </p>
                  
                    <p>
                      <label for="DoB">Date of Birth</label><br>
                      <input type="date" id="DoB" name="DoB">
                    </p>
                </fieldset>

                <fieldset class="applyFieldset">
                    <legend class="legends">gender</legend>
                    <p>Gender</p>
                    <p id="gender">
                        <label for="female">Female</label>
                        <input type="radio" id="female" name="Gender" value="female" required="required">
                        <label for="male">Male</label>
                        <input type="radio" id="male" name="Gender" value="male" required="required">
                        <label for="notSelected">Not selected</label>
                        <input type="radio" id="notSelected" name="Gender" value="notSelected" required="required"> 
                    </p>
                </fieldset>

                <fieldset class="applyFieldset">
                    <legend class="legends">Address</legend>
                    <p id="address1">
                        <span>
                            <label for="streetAddress">Street Address</label>
                            <input type="text" id="streetAddress" name="streetAddress" maxlength="40" pattern="[a-zA-Z0-9\s,.'-]{1,40}" required="required">
                        </span>
                        <span>
                            <label for="state">State</label>
                            <select id="state" name="state" style="width: 205px; height: 41px; margin-top: 20px">
                                <option value="none" selected disabled>select</option>
                                <option value="VIC">VIC</option>
                                <option value="NSW">NSW</option>
                                <option value="QLD">QLD</option>
                                <option value="NT">NT</option>
                                <option value="WA">WA</option>
                                <option value="SA">SA</option>
                                <option value="TAS">TAS</option>
                                <option value="ACT">ACT</option>
                            </select>
                        </span>
                    </p>
                    
                    <p id="address2">
                        <span>
                            <label for="suburbTown">Suburb/Town</label>
                            <input type="text" id="suburbTown" name="suburbTown" maxlength="40" pattern="[a-zA-Z0-9\s,.'-]{1,40}" required="required">
                        </span>
                        <span>
                            <label for="postcode">Postcode</label>
                            <input type="text" id="postcode" name="postcode" pattern="\d{4}" maxlength="4" required>
                        </span>
                    </p>

                    
                </fieldset>

                <fieldset class="applyFieldset">
                    <legend class="legends">contact</legend>
                    <p>Contact</p>
                    <p id="contact">
                        <span>
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" required="required" placeholder="email@platform">
                        </span>
                        <span>
                            <label for="phoneNum">Phone Number</label>
                            <input type="text" id="phoneNum" name="phoneNum" maxlength="12" pattern="\d{8,12}" required="required" placeholder="0111222333">
                        </span>
                    </p>
                </fieldset>

                <fieldset class="applyFieldset">
                    <legend class="legends">skill</legend>
                    <p>Skill</p>
                    <p>
                        <label for="Python">Python</label>
                        <input type="checkbox" class="skillCheck" id="Python" name="skill[]" value="Python" checked="checked">
                        <label for="Adobe_Illustrator">Adobe Illustrator</label>
                        <input type="checkbox" class="skillCheck" id="Adobe_Illustrator" name="skill[]" value="Adobe Illustrator">
                        <label for="Java">Java</label>
                        <input type="checkbox" class="skillCheck" id="Java" name="skill[]" value="Java">
                        <label for="MySQL">MySQL</label>
                        <input type="checkbox" class="skillCheck" id="MySQL" name="skill[]" value="MySQL">
                        <label for="otherSkill">Other skill...</label>
                        <input type="checkbox" class="skillCheck" id="otherSkill" name="skill[]" value="otherSkill">
                    </p>
                    <br>
                    <span id="otherSkillText">
                        <label for="otherSkills">Other Skills</label>
                        <input type="text" id="otherSkills" name="otherSkills" maxlength="200" pattern="[a-zA-Z0-9\s,.'-]{1,200}" placeholder="write your skills">
                    </span>
                </fieldset>
                <span id="applySubmit">
                    <input type="submit" id="submitBtn" value="Apply">
                </span>
            </form>
        </main>
         <!-- Footer content containing page links, logo and JIRA project link -->
         <?php include 'footer.inc'; ?>
    </body>
</html>
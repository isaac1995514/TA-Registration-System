<?php

    require_once("studentSupport.php");
    

    $content = <<<CONTENT

    <div class="form-style-5">
    <form>
        <fieldset>
            <legend><span class="number">1</span> Basic Info</legend>

            <input type = "text" name = 'studentId' placeholder = 'Student Id *'>
                <div class = 'subSection'>
                    <input type = "text" name = "firstName" placeholder = 'First Name *'>
                    <input type = "text" name = "middleName" placeholder = 'Middle Name *'>
                    <input type = "text" name = "lastName" placeholder = 'Last Name *'>
                </div>

                <input type= "email" name="email" placeholder = "Email *">
                <input type= "text" name = "phone" placeholder = "Phone Number *">
                <input type = 'number' name = 'gpa' step = "2" placeholder = "GPA *">
                <input type = 'text' name = "departmentName" placeholder = "Name of Your Department *">
            
            <legend><span class="number">2</span> Additional Info</legend>

                <label for="entry">Which is your entry semster?</label>
                <div id = 'entry' class = 'subSection'>
                    <input type = 'text' name = "entryYear" placeholder = "Entry Year *">
                    <select name = 'entryTerm'>
                        <option value = 'Fall'>Fall</option>
                        <option value = 'Spring'>Spring</option>
                    </select>
                </div>

                <label for="studentType">Studnet Type:</label>
                <select id="studentType" name="studentType">
                    <option value = 'Undergrad'>Undergrad</option>
                    <option value = 'Grad'>Grad</option>
                    <option value = 'Master'>Master</option>
                    <option value = 'PhD'>PhD</option>
                </select>

                <label for="adviser">What is the name of your adviser?</label>
                <input id = 'adviser' type = 'text' name = "adviser" placeholder = "Name of Your Adviser *">

                <label for="earnedMasterDegree">Have you earned a Master Degree: </label>
                <select id="studentType" name="studentType">
                    <option value = '1'>Yes</option>
                    <option value = '0'>No</option>
                </select>

                <label for="foreignStudent">Are you a foreign student?</label>
                <select id="foreignStudent" name="foreignStudent">
                    <option value = '1'>Yes</option>
                    <option value = '0'>No</option>
                </select>

                <label for="emiTestPassed">If you are a foreign Student, Have you passed the EMI Test?</label>
                <select id="emiTestPassed" name="emiTestPassed">
                    <option value = '-1'>Not applicatable</option>
                    <option value = '1'>Yes</option>
                    <option value = '0'>No</option>
                </select>

                <label for="currentEMI">If you, Have you passed the EMI Test?</label>
                <select id="currentEMI" name="currentEMI">
                    <option value = '-1'>Not applicatable</option>
                    <option value = '1'>Yes</option>
                    <option value = '0'>No</option>
                </select>
        </fieldset>

    <input type="reset" value = "Clear Form"/>
    <input type="submit" value="Apply" />
    </form>
</div>
CONTENT;

$content = generatePage($content, "Personal Info", "personalInfo.css");
echo $content;

?>


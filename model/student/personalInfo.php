<?php

    require_once("studentSupport.php");

    $content = <<<CONTENT

    <div class="form-style-5">
    <form>
        <fieldset>
            <legend><span class="number">1</span> Basic Info</legend>

            <input type = "text" name = 'studentId' placeholder = 'Student Id *'>
            <span>
                <input type = "text" name = "firstName" placeholder = 'First Name *'>
                <input type = "text" name = "middleName" placeholder = 'Middle Name *'>
                <input type = "text" name = "lastName" placeholder = 'Last Name *'>
            </span>

            <input type= "email" name="email" placeholder = "Email *">
            <input type= "text" name = "phone" placeholder = "Phone Number *">
            <input type = 'number' name = 'gpa' step = "2" placeholder = "GPA *">
            <input type = 'text' name = "departmentName" placeholder = "Name of Your Department *">

            <textarea name="field3" placeholder="About yourself"></textarea>


            <label for="job">Interests:</label>
            <select id="job" name="field4">

            <optgroup label="Indoors">
                <option value="fishkeeping">Fishkeeping</option>
                <option value="reading">Reading</option>
                <option value="boxing">Boxing</option>
                <option value="debate">Debate</option>
                <option value="gaming">Gaming</option>
                <option value="snooker">Snooker</option>
                <option value="other_indoor">Other</option>
            </optgroup>
            <optgroup label="Outdoors">
                <option value="football">Football</option>
                <option value="swimming">Swimming</option>
                <option value="fishing">Fishing</option>
                <option value="climbing">Climbing</option>
                <option value="cycling">Cycling</option>
                <option value="other_outdoor">Other</option>
            </optgroup>
            </select>      
        </fieldset>

        <fieldset>
            <legend><span class="number">2</span> Additional Info</legend>
            <textarea name="field3" placeholder="About Your School"></textarea>
        </fieldset>
    <input type="submit" value="Apply" />
    </form>
</div>

CONTENT;

$content = generatePage($content, "Personal Info", "personalInfo.css");
echo $content;

?>


<?php

    require_once("./../DatabaseManager.php");
    session_start();

    $errorMsg = "";
    $studentId = null;
    $searchResult = null;

    // Check if login in gate has been passed
    if(isset($_SESSION['studentId'])){
        $studentId = trim($_SESSION['studentId']);
    }else{
        header("Location: ./../login/login.php");
    }

    if(isset($_SESSION['database'])){
        $database = $_SESSION['database'];
    }else{
        $database = new DatabaseManager();
    }

    // Check if this is a new Account
    // If it is, the student is required to fill in all information except the studentId.
    // If not, the information will be pull from the database every time the window is visit
    if(!isset($_SESSION['newAccount'])){
        $result = $database->getStudent($studentId);

        // The result is not empty
        if($result[0] == 0){
            $searchResult = $result[1][0];
            $_SESSION['studentInfo'] = $searchResult;

        // The result is empty    
        }else if($result[0] == 1){
            $errorMsg = "Student does not existed in the database. Please report to Admin";
            $_SESSION['newAccount'] = true;
        }else{
            $errorMsg = "System Failed. Please report to Admin";
        }
    
    }else{
        $errorMsg = "This is a new Account. Please fill in all data before proceeding to other functionality";
    }

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Personal Information</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href='./../../resources/style/personalInfo.css'>
        <link rel="stylesheet" type="text/css" href='./../../resources/style/commonStudentStyle.css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script
            src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
        <script src= "./../../resources/script/personalInfo.js"></script> 
    </head>
    
    <body>
        <!-- Navigation Bar-->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                 <!-- Navigation Part 1-->
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">TA Registration System</a>
    
                    <!-- button visible when navbar collapses -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarcontent">
    
                        <!-- displaying icon representing button -->
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
    
                <div id="navbarcontent" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="./../logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:20%">
            <h3 class="w3-bar-item">Student Function Menu</h3>
            <a id = 'personalInfo' href="personalInfo.php" class="w3-bar-item w3-button">Personal Info</a>
            <a id = 'newApp' href="newApplication.php" class="w3-bar-item w3-button">New Application</a>
            <a id = 'viewApp' href="viewApplication.php" class="w3-bar-item w3-button">View & Edit Applications</a>
            <a id = 'assignedTA' href="assignedTA.php" class="w3-bar-item w3-button">Assigned TA</a>
            <a id = 'comments' href="comments.php" class="w3-bar-item w3-button">Comments</a>
        </div>
      
        <!-- Page Content -->
        <div style="margin-left:20%">
      
            <div id = 'headerBlock' class="w3-container w3-teal">
                <h1>Personal Infomation</h1>
            </div>
      
            <div id = 'contentBlock' class="w3-container">
                <div class="form-style-5">
                    <?="<h1 id = 'errorMsg'>{$errorMsg}</h1>"?>
                    <form action = "personalInfoSubmit.php" method = 'post' width = "90%" enctype="multipart/form-data">
                        <fieldset>
                            <legend><span class="number">1</span> Basic Info</legend>

                            <input readonly type = "text" name = 'studentId' <?php echo (isset($_SESSION['studentId'])) ? "value = '{$studentId}'": "INVALID" ?>>
                                <div class = 'subSection'>
                                    <input required type = "text" name = "firstName" placeholder = 'First Name *' <?php echo (isset($searchResult['firstName'])) ? "value = '{$searchResult['firstName']}'": "" ?>>
                                    <input type = "text" name = "middleName" placeholder = 'Middle Name *' <?php echo (isset($searchResult['middleName'])) ? "value = '{$searchResult['middleName']}'": "" ?>>
                                    <input required type = "text" name = "lastName" placeholder = 'Last Name *' <?php echo (isset($searchResult['lastName'])) ? "value = '{$searchResult['lastName']}'": "" ?>>
                                </div>

                                <input required type= "email" name="email" placeholder = "Email *" <?php echo (isset($searchResult['email'])) ? "value = '{$searchResult['email']}'": "" ?>>
                                <input required type= "text" id = "phone" name = "phone" placeholder = "Phone Number * (###-###-####)" <?php echo (isset($searchResult['phone'])) ? "value = '{$searchResult['phone']}'": "" ?>>
                                <input required type = 'number' name = 'gpa' step = "0.01" min = "0" max = "4.0" placeholder = "GPA *" <?php echo (isset($searchResult['gpa'])) ? "value = '{$searchResult['gpa']}'": "" ?>>
                                <input required type = 'text' id = 'departmentName' name = "departmentName" placeholder = "Name of Your Department *" <?php echo (isset($searchResult['departmentName'])) ? "value = '{$searchResult['departmentName']}'": "" ?>>
                            
                            <legend><span class="number">2</span> Additional Info</legend>

                                <label>Which is your entry semester?</label>
                                <div id = 'entry' class = 'subSection'>
                                    <input type = 'text' id = "entryYear" name = "entryYear" placeholder = "Entry Year *" <?php echo (isset($searchResult['entryYear'])) ? "value = '{$searchResult['entryYear']}'": "" ?>>
                                    <select required name = 'entryTerm'>
                                        <option value = 'Fall' <?php echo (isset($searchResult['entryTerm']) && $searchResult['entryTerm'] == "Fall") ? "selected": "" ?>>Fall</option>
                                        <option value = 'Spring' <?php echo (isset($searchResult['entryTerm']) && $searchResult['entryTerm'] == "Spring") ? "selected": "" ?>>Spring</option>
                                    </select>
                                </div>

                                <label for="studentType">Studnet Type:</label>
                                <select required id="studentType" name="studentType">
                                    <option value = 'Undergrad' <?php echo (isset($searchResult['studentType']) && $searchResult['studentType'] == "Undergrad") ? "selected": "" ?>>Undergrad</option>
                                    <option value = 'Grad' <?php echo (isset($searchResult['studentType']) && $searchResult['studentType'] == "Grad") ? "selected": "" ?>>Grad</option>
                                    <option value = 'Master' <?php echo (isset($searchResult['studentType']) && $searchResult['studentType'] == "Master") ? "selected": "" ?>>Master</option>
                                    <option value = 'PhD' <?php echo (isset($searchResult['studentType']) && $searchResult['studentType'] == "PhD") ? "selected": "" ?>>PhD</option>
                                </select>

                                <label for="adviser">What is the name of your adviser?</label>
                                <input id = 'adviser' type = 'text' name = "adviser" placeholder = "Name of Your Adviser *" <?php echo (isset($searchResult['adviser'])) ? "value = '{$searchResult['adviser']}'": "" ?>>

                                <label for="earnedMasterDegree">Have you earned a Master Degree: </label>
                                <select required id="earnedMasterDegree" name="earnedMasterDegree">
                                    <option value = '1' <?php echo (isset($searchResult['earnedMasterDegree']) && $searchResult['earnedMasterDegree'] == "1") ? "selected": "" ?>>Yes</option>
                                    <option value = '0' <?php echo (isset($searchResult['earnedMasterDegree']) && $searchResult['earnedMasterDegree'] == "0") ? "selected": "" ?>>No</option>
                                </select>

                                <label for="foreignStudent">Are you a foreign student?</label>
                                <select required id="foreignStudent" name="foreignStudent">
                                    <option value = '1' <?php echo (isset($searchResult['foreignStudent']) && $searchResult['foreignStudent'] == "1") ? "selected": "" ?>>Yes</option>
                                    <option value = '0' <?php echo (isset($searchResult['foreignStudent']) && $searchResult['foreignStudent'] == "0") ? "selected": "" ?>>No</option>
                                </select>

                                <label for="emiTestPassed">If you are a foreign Student, Have you passed the Maryland English Institute (MEI) Test?</label>
                                <select required id="emiTestPassed" name="emiTestPassed">
                                    <option value = '-1' <?php echo (isset($searchResult['emiTestPassed']) && $searchResult['emiTestPassed'] == "-1") ? "selected": "" ?>>Not applicatable</option>
                                    <option value = '1' <?php echo (isset($searchResult['emiTestPassed']) && $searchResult['emiTestPassed'] == "1") ? "selected": "" ?>>Yes</option>
                                    <option value = '0' <?php echo (isset($searchResult['emiTestPassed']) && $searchResult['emiTestPassed'] == "0") ? "selected": "" ?>>No</option>
                                </select>

                                <label for="currentEMI">If you have not passed the test, are you currently taking and MEI course?</label>
                                <select required id="currentEMI" name="currentEMI">
                                    <option value = '-1' <?php echo (isset($searchResult['currentEMI']) && $searchResult['currentEMI'] == "-1") ? "selected": "" ?>>Not applicatable</option>
                                    <option value = '1' <?php echo (isset($searchResult['currentEMI']) && $searchResult['currentEMI'] == "1") ? "selected": "" ?>>Yes</option>
                                    <option value = '0' <?php echo (isset($searchResult['currentEMI']) && $searchResult['currentEMI'] == "0") ? "selected": "" ?>>No</option>
                                </select>
                            <legend><span class="number">3</span> Documents</legend>
                            <input type="file" name="transcriptFile" id="transcriptFile" accept=".pdf" class="required" />

                        </fieldset>

                        <input type="reset" name = "resetBtn" value = "Clear Form"/>
                        <input type="submit" name = "submitBtn" value="Submit New/Update" />
                    </form>
                </div>
            </div>
        </div>
    
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        </body>
    </html>


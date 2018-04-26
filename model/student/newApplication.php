<?php
    require_once("./../DatabaseManager.php");

    session_start();

    $errorMsg = "";
    $studentId= null;
    $errorCode = 0;

    $nextSemesterYear = DatabaseManager::$nextSemesterYear;
    $nextSemesterTerm = DatabaseManager::$nextSemesterTerm;

    // Set Cookie
    setcookie("nextSemesterYear", $nextSemesterYear);
    setcookie("nextSemesterTerm", $nextSemesterTerm);

    // Check if login in gate has been passed
    if(isset($_SESSION['studentId'])){
        $studentId = $_SESSION['studentId'];
    }else{
        header("Location: ./../login/login.php");
    }

    if(isset($_SESSION['database'])){
        $database = $_SESSION['database'];
    }else{
        $database = new DatabaseManager();
    }

        $result = $database->getCourse($studentId);
        $errorCode = $result[0];

    $studentInfo = $_SESSION['studentInfo'];
    $studentType = $studentInfo['studentType'];
    $foreignStudent = $studentInfo['foreignStudent'];
    $emiTestPassed = $studentInfo['emiTestPassed'];

    // Check if the student can teach
    $canTeach = false;

    if($foreignStudent == "0"){
        $canTeach = true;
    }else{
        if($emiTestPassed == "1"){
            $canTeach = true;
        }
    }

    // Search for the list of course everytime
    // Check if course list is empty
        if($errorCode == 0){
            $searchResult = $result[1];
        $options = "";
        foreach($searchResult as $course){
            $options .= "<option value = '{$course['courseCode']}'>{$course['courseCode']}</option>";
        }    
    
    // No Course Found
    }else if($errorCode == 1){
        $errorMsg = "There is not a list of course in the database for the students Major. Please contact admin!"

    }else{
        $errorMsg = "System Failed. Please report to Admin";
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>New Application</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href='./../../resources/style/newApplication.css'>
        <link rel="stylesheet" type="text/css" href='./../../resources/style/commonStudentStyle.css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src= "./../../resources/script/newApplication.js"></script> 
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
            <a id = 'comments' href="comments.php" class="w3-bar-item w3-button">Comments</a>
        </div>
      
        <!-- Page Content -->
        <div style="margin-left:20%">
      
            <div id = 'headerBlock' class="w3-container w3-teal">
                <h1>New Application</h1>
            </div>
      
            <div id = 'contentBlock' class="w3-container">
                <div class="form-style-5">
                    <?="<h1 id = 'errorMsg'>{$errorMsg}</h1>"?>
                    <form action="newApplicationSubmit.php" method="post">
                        <legend>Application Preferences</legend>
                        <label for="taType">TA Type:</label>
                            <select required class="form-control" id = 'taType' name="taType">
                                <option <?=(($studentType == "Undergrad") ? "disabled": "" )?> value = 'Full Time'>Full Time (20hrs/week)</option>
                                <option <?=(($studentType == "Grad") ? "disabled": "" )?> value = 'Part Time'>Part Time (10hrs/week)</option>
                            </select>
                        
                        <legend>Course</legend>
                        <label for="academicYear">Academic Year:</label>
                        <input required type = "number" name = 'academicYear' id = 'academicYear' value = '<?=$nextSemesterYear?>'/>
                        
                        <label for="term">Semester:</label>
                            <select required class="form-control" id="term" name = 'term'>
                                <option <?php echo (($nextSemesterTerm == 'Fall') ? "selected" : "")?> value = 'Fall'>Fall</option>
                                <option <?php echo (($nextSemesterTerm == 'Spring') ? "selected" : "")?> value = 'Spring'>Spring</option>
                                <option <?php echo (($nextSemesterTerm == 'Summer') ? "selected" : "")?> value = 'Summer'>Summer</option>
                            </select>
                        
                        <label for="pref-courses">Select Classes to TA</label>
                            <div id="pref-courses">
                                <select required class="form-control" name = "courseCode[]" id="courseCode" multiple>
                                <?=$options?>
                                </select>
                            </div>
                        
                        <label for="taType">Can you teach these courses?</label>
                            <select required class="form-control" id = 'canTeach' name="canTeach">
                                <option <?=((!$canTeach) ? "disabled": "" )?> value = '1'>Yes</option>
                                <option <?=((!$canTeach) ? "selected": "" )?> value = '0'>No</option>
                            </select>
                        
                        <input type="reset" name = "resetBtn" value = "Clear Application"/>
                        <input type="submit" name = "submitBtn" value="Submit Application"/>
                    </form>
                </div>
            </div>
        </div>
    
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        </body>
    </html>


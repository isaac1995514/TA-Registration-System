<?php

    require_once("./../DatabaseManager.php");
    session_start();

    $errorMsg = "";
    $errorCode = 0;
    $fullTable = "";

    /*
    // Check if login in gate has been passed
    if(isset($_SESSION['studentId'])){
        $studentId = $_SESSION['studentId'];
    }else{
        header("Location: ./../login/login.php");
    }

    */

    if(isset($_SESSION['database'])){
        $database = $_SESSION['database'];
    }else{
        $database = new DatabaseManager();
    }

    // course Department Selection
    $result = $database->getCourseCode();
    $searchResult = $result[1];
    $course = "";
    foreach($searchResult as $courseCode){
        $course .= "<option ";
        if($courseCode == 'CMSC'){
            $course .= "selected ";
        }
        $course .= "id = '{$courseCode}' value = '{$courseCode}'>{$courseCode}</option>";
    }

    // Check if filter button has been clicked
    if(isset($_POST['sumbitBtn'])){
        $studentId = $_POST['studentId'];
        $courseCode = $_POST['courseCode'];
        $department = $_POST['department'];
        $studentType = $_POST['studentType'];
        $taType = $_POST['taType'];
        $orderBy = $_POST['orderBy'];
        
        $result = $database->getAllApplication($studentId, $courseCode, $department, $studentType, $taType, $orderBy);
        $errorCode = $result[0];



        // If there is a match
        if($errorCode == 0){

            //print_r($result);
            $searchResult = $result[1];
            $teachingApplication = "<h3>Teaching TA Applications</h3><table id = 'teaching' class = 'table table-responsive table-condensed table-hover'>";
            $gradingApplication = "<h3>Grading TA Applications</h3><table id = 'grading' class = 'table table-responsive table-condensed table-hover'>";
            $head  = '<tr><th>StudentId</th><th>Student Name</th><th>Student Type</th><th>GPA</th><th>Year</th><th>Semester</th><th>Course</th><th>TA Type</th><th>View Application</th><th>Assign Button</th></tr>';
            $teachingApplicationRow = "";
            $gradingApplicationRow = "";

            foreach($searchResult as $application){
                $applicationId = $application['id'];
                $buttonId = 'assignBtn'."@"."{$applicationId}";
                $studentId = $application['studentId'];
                $viewButtonId = 'viewBtn'."@"."{$studentId}";
                $studentName = $application['studentName'];
                $studentType = $application['studentType'];
                $gpa = $application['gpa'];
                $academicYear = $application['academicYear'];
                $term = $application['term'];
                $courseCode = $application['courseCode'];
                $taType = $application['taType'];
                $canTeach = $application['canTeach'];
                $mime = $application['mime'];
                $data = $application['data'];

                // Check if the student can teach the course
                if($canTeach == '1'){
                    $teachingApplicationRow .= "<tr class = 'teaching'>";
                    $teachingApplicationRow .= "<td>{$studentId}</td><td>{$studentName}</td><td>{$studentType}</td><td>{$gpa}</td><td>{$academicYear}</td><td>{$term}</td><td>{$courseCode}</td><td>{$taType}</td>";
                    if($mime != null){
                        $teachingApplicationRow .= "<td><a href = './../ajaxScript/transcript.php?studentId={$studentId}' target='_blank'><img class = 'viewBtn' id = '{$viewButtonId}' src='./../../resources/image/transcriptIcon.png' alt='viewButton'/></a></td>";
                    }else{
                        $teachingApplicationRow .= "<td>X</td>";
                    }
                    $teachingApplicationRow .= "<td><img class = 'assignBtn' id = '{$buttonId}' src='./../../resources/image/assignButtonIcon.png' alt='assignButton'/></td>";
                    $teachingApplicationRow .= "</tr>";
                }else{
                    $gradingApplicationRow .= "<tr class = 'grading'>";
                    $gradingApplicationRow .= "<td>{$studentId}</td><td>{$studentName}</td><td>{$studentType}</td><td>{$gpa}</td><td>{$academicYear}</td><td>{$term}</td><td>{$courseCode}</td><td>{$taType}</td>";
                    if($mime != null){
                        $gradingApplicationRow .= "<td><a href = './../ajaxScript/transcript.php?studentId={$studentId}' target='_blank'><img class = 'viewBtn' id = '{$viewButtonId}' src='./../../resources/image/transcriptIcon.png' alt='viewButton'/></a></td>";
                    }else{
                        $gradingApplicationRow .= "<td>X</td>";
                    }
                    $gradingApplicationRow .= "<td><img class = 'assignBtn' id = '{$buttonId}' src='./../../resources/image/assignButtonIcon.png' alt='assignButton'/></td>";
                    $gradingApplicationRow .= "</tr>";

                }
            }
            
            $fullTable .= $teachingApplication.$head.$teachingApplicationRow;
            $fullTable .= "</table><br><br><br>";
            $fullTable .= $gradingApplication.$head.$gradingApplicationRow;
            $fullTable .= "</table><br><br><br>";
        }else if($errorCode == 1){
            $errorMsg = "No Student Application found for this filtering criteria!";
        }else{
            $errorMsg = "System Fail. Please report to admin!";
        }
        
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Application Filter</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href='./../../resources/style/applicationFilter.css'>
        <link rel="stylesheet" type="text/css" href='./../../resources/style/commonAdminStyle.css'>
        <script src= "./../../resources/script/applicationFilter.js"></script> 
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
            <h3 class="w3-bar-item">Admin Function Menu</h3>
            <a id = 'applicationFilter' href="#" class="w3-bar-item w3-button">Assign TA</a>
            <a id = 'configuration' href="configuration.php" class="w3-bar-item w3-button">Configuration</a>
        </div>
      
        <!-- Page Content -->
        <div style="margin-left:20%">
      
            <div id = 'headerBlock' class="w3-container w3-teal">
                <h1>TA Assignment</h1>
            </div>
      
            <div id = 'contentBlock' class="w3-container">
                <div class="form-style-5">
                    <input type = 'button' id = 'hideShow' value = 'Hide/Show Filtering Criteria'>
                    <form action = <?php echo $_SERVER['PHP_SELF'];?> method = 'post'>
                        <fieldset id = 'filter'>
                            <h1>Filtering Criteria </h1>
                            <h4>Student Id: </h4><input type = "text" id = 'studentId' name = 'studentId' placeholder = "Filter By Student id *"/>&nbsp;&nbsp;&nbsp;&nbsp;
                            <h4>Course Code:</h4> <input type = "text" id = 'courseCode' name = 'courseCode' placeholder = "CMSCXXX(Optional Letter)"/>&nbsp;&nbsp;&nbsp;&nbsp;<br>
                            <h4>Department</h4>
                            <select id = 'department' name = 'department'>
                                <?=$course;?>
                            </select>&nbsp;&nbsp;&nbsp;&nbsp;
                            <h4> TA Type: </h4>
                            <select name = 'taType'>
                                <option selected id = 'allStudent' value = 'allStudent'>All Student</option>
                                <option id = 'fullTime' value = 'Full Time'>Full Time</option>
                                <option id = 'partTime' value = 'Part Time'>Part Time</option>
                            </select>&nbsp;&nbsp;&nbsp;&nbsp;
                            <h4> Student Type: </h4>
                            <select name = 'studentType'>
                                <option selected id = 'allStudent' value = 'allStudent'>All Student</option>
                                <option id = 'Undergrad' value = 'Undergrad'>Undergrad</option>
                                <option id = 'Grad' value = 'Grad'>Grad</option>
                                <option id = 'Master' value = 'Master'>Master</option>
                                <option id = 'PhD' value = 'PhD'>PhD</option>
                            </select><br>
                            <h4> Order By: </h4>
                            <select name = 'orderBy'>
                                <option selected id = 'none' value = 'none'>None</option>
                                <option id = 'lastName' value = 'lastName'>Last Name</option>
                                <option id = 'gpa' value = 'gpa'>GPA</option>
                                <option id = 'studentType' value = 'studentType'>Student Type</option>
                                <option id = 'taType' value = 'taType'>TA Type</option>
                            </select>
                            <input type = 'submit' name = 'sumbitBtn' value = 'Apply Filter'>
                        </fieldset>
                    </form>
                    <?=$errorMsg;?>
                    <?=$fullTable;?>
                </div>
            </div>
        </div>
    
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        </body>
    </html>
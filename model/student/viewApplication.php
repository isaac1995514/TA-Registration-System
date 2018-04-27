<?php

    require_once("./../DatabaseManager.php");
    session_start();

    $errorMsg = "";
    $studentId = null;
    $errorCode = 0;
    $fullTable = "";
    $nextSemesterYear = DatabaseManager::$nextSemesterYear;
    $nextSemesterTerm = DatabaseManager::$nextSemesterTerm;

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

    // Get Student's Application Information
    $result = $database->getStudentApplication($studentId);
    $errorCode = $result[0];

    if($errorCode == 0){
        $searchResult = $result[1];

            $currHead  = '<tr><th>Course</th><th>Year</th><th>Semester</th><th>Application Status</th><th>Teaching</th><th>TA Type</th><th>Remove Button</th></tr>';
            $prevHead  = '<tr><th>Course</th><th>Year</th><th>Semester</th><th>Application Status</th><th>Teaching</th><th>TA Type</th></tr>';

            $currApplication = "";
            $previousApplication = "";

            foreach($searchResult as $application){
                $id = $application['id'];
                $buttonId = "removeButton@{$id}";
                $course = $application['courseCode'];
                $year = $application['academicYear'];
                $semester = $application['term'];
                $status = $application['appStatus'];
                $teach = ($application['canTeach'] == "1") ? "Yes" : "No";
                $type = $application['taType'];

                // Check if the application is current
                if($application['academicYear'] == $nextSemesterYear && $application['term'] == $nextSemesterTerm){
                    $currApplication .= "<tr>";
                    $currApplication .= "<td>{$course}</td><td>{$year}</td><td>{$semester}</td><td>{$status}</td><td>{$teach}</td><td>{$type}</td>";
                    $currApplication .= "<td><img class = 'removeBtn' id = '{$buttonId}' src='./../../resources/image/removeButtonIcon.png' alt='removeButton'/></td>";
                    $currApplication .= "</tr>";
                }else{
                    $previousApplication .= "<tr><td>{$course}</td><td>{$year}</td><td>{$semester}</td><td>{$status}</td><td>{$teach}</td><td>{$type}</td></tr>";
                }
            }

            $fullTable = "<h1>Current Application</h1>";
            $fullTable .= '<table id = "current" class = "table table-responsive table-condensed table-hover">';
            $fullTable .= "{$currHead}{$currApplication}</table><br><br><br>";
            $fullTable .= "<h1>Previous Application</h1>";
            $fullTable .= '<table id = "previous" class = "table table-responsive table-condensed table-hover">';
            $fullTable .= "{$prevHead}{$previousApplication}</table>";

    }else if($errorCode == 1){
        $errorMsg = "No Application exists for this student.";
        $currHead  = '<tr><th>Course</th><th>Year</th><th>Semester</th><th>Application Status</th><th>Teaching</th><th>TA Type</th><th>Remove Button</th></tr>';
        $prevHead  = '<tr><th>Course</th><th>Year</th><th>Semester</th><th>Application Status</th><th>Teaching</th><th>TA Type</th></tr>';

        $fullTable = "<h1>Current Application</h1>";
        $fullTable .= '<table id = "current" class = "table table-responsive table-condensed table-hover">';
        $fullTable .= "{$currHead}</table><br><br><br>";
        $fullTable .= "<h1>Previous Application</h1>";
        $fullTable .= '<table id = "previous" class = "table table-responsive table-condensed table-hover">';
        $fullTable .= "{$prevHead}</table>";
    }else{
        $errorMsg = "System Failed. Please report to Admin";
        
    }    
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Student Application</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href='./../../resources/style/viewApplication.css'>
        <link rel="stylesheet" type="text/css" href='./../../resources/style/commonStudentStyle.css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src= "./../../resources/script/viewApplication.js"></script> 
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
                <h1>View Student Application</h1>
            </div>
      
            <div id = 'contentBlock' class="w3-container">
                <div class="form-style-5 container">
                    <?="<h1 id = 'errorMsg'>{$errorMsg}</h1>"?>
                    <?=$fullTable?>
                </div>
            </div>
        </div>
    
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        </body>
    </html>


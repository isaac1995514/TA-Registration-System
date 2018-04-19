<?php

    require_once("./../DatabaseManager.php");
    session_start();

    $errorMsg = "";
    $errorCode = 0;
    $searchResult = "";
    $commentView = "<br><br>";
    $studentId = null;

    // Check if login in gate has been passed
    if(isset($_SESSION['studentId'])){
        $studentId = $_SESSION['studentId'];
    }else{
        header("Location: ./../login/login.php");
    }
    
    (isset($_SESSION['studentId']) ? $_SESSION['studentId'] : "INVALID");
    if(isset($_SESSION['database'])){
        $database = $_SESSION['database'];
    }else{
        $database = new DatabaseManager();
    }

    // Check to see if there is a local copy
    if(isset($_SESSION['comments'])){
        // Find local copy
        $searchResult = $_SESSION['comments'];
        $errorCode = 202;
        
            //echo "<h1>Local Copy</h1>";
            
    }else{
        // Get SQL search result
        $result = $database->getComment($studentId) ;
        $errorCode = $result[0];
        $searchResult = $result[1];

        // Store Result as local Copy
        $_SESSION['comment'] = $searchResult;

            //echo "<h1>New Copy</h1>";
    }

    // Comments in Database or Local Copy
    if($errorCode == 0 || $errorCode == 202){

        // Process Comment Array (Array of Hash Time)
        foreach($searchResult as $comment){
            $commentView .= <<<COMMENT

            <div>
                {$comment["firstName"]} {$comment["lastName"]} @ {$comment["sendTime"]}
            </div>
            <textarea readonly rows = "7">
                {$comment["comment"]}
            </textarea> 
            <br><br><br><br><br>
COMMENT;

        }
    // Error Msg: This is no comments for this student
    }elseif($errorCode == 1){
        $errorMsg = "There is no comments for this student";
    }else{
        $errorMsg = "System Failed. Please report to Admin";
    }
    
?>


<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Comments</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href='./../../resources/style/commonStudentStyle.css'>
        <link rel="stylesheet" type="text/css" href='./../../resources/style/comments.css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
            <a id = 'viewApp' href="viewApplication.php" class="w3-bar-item w3-button">View Applications</a>
            <a id = 'comments' href="comments.php" class="w3-bar-item w3-button">Comments</a>
        </div>
      
        <!-- Page Content -->
        <div style="margin-left:20%">
      
            <div id = 'headerBlock' class="w3-container w3-teal">
                <h1>Comments</h1>
            </div>
      
            <div id = 'contentBlock' class="w3-container">
                <div class="form-style-5">
                    <?php
                        if($errorCode == 1){
                            echo "<h1 sytle='color:red'>{$errorMsg}</h1>";
                        }else if($errorCode == 0 || $errorCode == 202){
                            echo $commentView;
                        }else{
                            echo $errorCode;
                        }
                    ?>
                </div>
            </div>
        </div>
    
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>


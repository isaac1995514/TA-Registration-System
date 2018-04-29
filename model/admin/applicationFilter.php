<?php

    require_once("./../DatabaseManager.php");
    session_start();

    $errorMsg = "";
    $errorCode = 0;

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

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Personal Information</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href='./../../resources/style/applicationFilter.css'>
        <link rel="stylesheet" type="text/css" href='./../../resources/style/commonAdminStyle.css'>
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
            <a id = 'personalInfo' href="#" class="w3-bar-item w3-button">Select TA</a>
        </div>
      
        <!-- Page Content -->
        <div style="margin-left:20%">
      
            <div id = 'headerBlock' class="w3-container w3-teal">
                <h1>Personal Infomation</h1>
            </div>
      
            <div id = 'contentBlock' class="w3-container">
                <div class="form-style-5">
                    <form>
                        <h1> Filter Criteria </h1>
                        <h4>Student Id: </h4><input type = "text" id = 'studentId' name = 'studentId' placeholder = "Filter By Student id *"/>&nbsp;&nbsp;&nbsp;&nbsp;
                        <h4>First Name: </h4><input type = "text" id = 'firstName' name = 'firstName' placeholder = "Filter By Student's firstName *"/>&nbsp;&nbsp;&nbsp;&nbsp;
                        <h4>Last Name: </h4><input type = "text" id = 'lastName' name = 'lastName' placeholder = "Filter By Student's lastName *"/>&nbsp;&nbsp;&nbsp;&nbsp;

                        <h

                        <h3>Teaching TA Applications</h3>
                        <table id = "teaching">
                            
                        </table>

                        <h3>Grading TA Applications</h3>
                        <table id = "grading">
                            
                        </table>
                    </form>
                </div>
            </div>
        </div>
    
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        </body>
    </html>


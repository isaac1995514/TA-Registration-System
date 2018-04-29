<?php

    require_once("./../DatabaseManager.php");
    session_start();

    $errorMsg = "";
    $errorCode = 0;

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

    // Self Referencing Script
    if(isset($_POST['submit'])){

        $numOfStudent = $_POST['numOfStudent'];

        if($errorCode == 0){

            $result = $database->setConfig($numOfStudent);

            if($result == 0){
                $errorMsg = "Updated Successfully";
            }else{
                $errorMsg = "Failed to update";
            }

        }else{
            $errorMsg = "System Failed. Please report to Admin";
            
        }    
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Configuation</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href='./../../resources/style/commonAdminStyle.css'>
        <link rel="stylesheet" type="text/css" href='./../../resources/style/applicationFilter.css'>
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
            <a id = 'personalInfo' href="./applicationFilter.php" class="w3-bar-item w3-button">Assign TA</a>
            <a id = 'personalInfo' href="#" class="w3-bar-item w3-button">Configuration</a>
        </div>
      
        <!-- Page Content -->
        <div style="margin-left:20%">
      
            <div id = 'headerBlock' class="w3-container w3-teal">
                <h1>Configuation</h1>
            </div>
      
            <div id = 'contentBlock' class="w3-container">
                <?="<h1 id = 'errorMsg'>{$errorMsg}</h1>"?>
                <div class="form-style-5">
                    <form action = <?php echo $_SERVER['PHP_SELF']; ?> method = 'post'>
                        <h4>TA per section: </h4> <input type = 'number' name = 'numOfStudent'min = '0' max = '10' value = '5'/>&nbsp;&nbsp;&nbsp;<h4>(5 is default)</h1>
                        <input type = 'submit' name = 'submit' value = "Submit"/>
                    </form>
                </div>
            </div>
        </div>
    
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>


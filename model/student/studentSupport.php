<?php

function generatePage($body, $title="Example") {
    $page = <<<EOPAGE
    <!doctype html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>$title</title>
    
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="./resources/bootstrap/css/bootstrap.min.css" rel = "stylesheet">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                                   integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
                                   crossorigin="anonymous">
            <style>
                body{
                    padding-top: 50px;
                }
            </style>
        </head>
    
        <body>
    
            <!-- Navigation Bar-->
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <!-- Navigation Part 1-->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">TA Registration System</a>
    
                        <!-- button visible when navbar collapses -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#navbarcontent">
    
                            <!-- displaying icon representing button -->
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
    
                    <div id="navbarcontent" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href=#history>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>        
            <!-- Sidebar -->
            <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:25%">
                <h3 class="w3-bar-item">Menu</h3>
                <a id = 'personalInfo' href="personalInfo.php" class="w3-bar-item w3-button">Personal Info</a>
                <a id = 'newApp' href="newApplication.php" class="w3-bar-item w3-button">New Application</a>
                <a id = 'viewApp' href="viewApplication.php" class="w3-bar-item w3-button">View Applications</a>
                <a id = 'comments' href="comments.php" class="w3-bar-item w3-button">Comments</a>
            </div>
      
            <!-- Page Content -->
            <div style="margin-left:25%">
      
                <div id = 'headerBlock' class="w3-container w3-teal">
                    <h1>$title</h1>
                </div>
      
                <div id = 'contentBlock' class="w3-container">
                    $body
                </div>
            </div>
    
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
                    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
                    crossorigin="anonymous"></script>
            <script src="./../scripts/student.js"></script>
        </body>
    </html>
EOPAGE;

    return $page;
}
?>
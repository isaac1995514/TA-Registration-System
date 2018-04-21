<?php
   
    require_once("./../DatabaseManager.php");
    session_start();

    if(isset($_SESSION['database'])){
        $database = $_SESSION['database'];
    }else{
        $database = new DatabaseManager();
    }

    // Remove the application based on the application Id
    $applicationId = $_POST['removeId'];
    $database->removeStudentApplication($applicationId);
    
    // Remove the local copy of application table for viewApplication Tab to ensure it refreshes
    if(isset($_SESSION['applicationTable'])){
        unset($_SESSION['applicationTable']);
    }

    // Redirect back to the viewApplication Page
    header("Location: viewApplication.php")
?>
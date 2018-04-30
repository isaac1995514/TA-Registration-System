<?php
    $applicationId = $_GET['appId'];

    require_once("./../DatabaseManager.php");
    session_start();

    if(isset($_SESSION['database'])){
        $database = $_SESSION['database'];
    }else{
        $database = new DatabaseManager();
    }

    // Remove the application based on the application Id
    $result = $database->removeStudentApplication($applicationId);

    if($result == 0){
        echo "0";
    }else{
        echo "404";
    }
    
?>
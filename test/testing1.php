<?php

    require_once("./../model/DatabaseManager.php");
    session_start();

    if(isset($_SESSION['database'])){
        $database = $_SESSION['database'];
    }else{
        $database = new DatabaseManager();
    }

    $result = $database->getAllApplication("", "", "CMSC", "allStudent", "allStudent", "none");
    
?>
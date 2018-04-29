<?php

    require_once("./../model/DatabaseManager.php");
    session_start();

    if(isset($_SESSION['database'])){
        $database = $_SESSION['database'];
    }else{
        $database = new DatabaseManager();
    }

    $result = $database->isTA('10000003', '2018', 'Summer');
    $isTA = $result[1];

    // If the student is a TA already

    print_r($isTA);
?>
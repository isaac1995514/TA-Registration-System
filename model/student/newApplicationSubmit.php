<?php

    require_once("./../DatabaseManager.php");
    session_start();

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

    if(isset($_POST['submitBtn'])){

        $selectCourse = $_POST['courseCode'];
        $studentId = $_SESSION['studentId'];
        $insert_success_count = 0;

        foreach($selectCourse as $course){
            $arguments = array(
                "studentId" => $studentId,
                "taType" => $_POST['taType'],
                "academicYear" => $_POST['academicYear'],
                "courseCode" => $course,
                "term" => $_POST['term'],
                "appStatus" => "New",
            );
            $errorCode = $database->addApplication($arguments);
        }

        header("Location: newApplication.php");

    }else{
        echo "<h1 style='color:red';>Submission Error</h1>";
    }
?>
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
                "canTeach" => $_POST['canTeach']
            );
            $errorCode = $database->addApplication($arguments);
        }

        // Remove the local copy of application table for viewApplication Tab to ensure it refreshes
        if(isset($_SESSION['applicationTable'])){
            unset($_SESSION['applicationTable']);
        }

        header("Location: newApplication.php");

    }else{
        echo "<h1 style='color:red';>Submission Error</h1>";
    }
?>
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
        $arguments = array(
            "studentId" => $_POST['studentId'],
            "firstName" => $_POST['firstName'],
            "middleName" => ($_POST['middleName'] == "") ? "NULL" : $_POST['middleName'],
            "lastName" => $_POST['lastName'],
            "email" => $_POST['email'],
            "phone" => $_POST['phone'],
            "gpa" => $_POST['gpa'],
            "departmentName" => $_POST['departmentName'],
            "entryYear" => $_POST['entryYear'],
            "entryTerm" => $_POST['entryTerm'],
            "studentType" => $_POST['studentType'],
            "adviser" => ($_POST['adviser'] == "" ? "NULL" : $_POST['adviser']),
            "earnedMasterDegree" => $_POST['earnedMasterDegree'],
            "foreignStudent" => $_POST['foreignStudent'],
            "emiTestPassed" => $_POST['emiTestPassed'],
            "currentEMI" => $_POST['currentEMI']
        );

        // Check if this is a new account (set only for new student)
        if(isset($_SESSION['newAccount'])){
            $errorCode = $database->addStudent($arguments);
            unset($_SESSION['newAccount']);
        }else {
            $errorCode = $database->updateStudent($arguments);
        }

        // Upload transcript
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["transcriptFile"]["name"]);
        if (file_exists($target_file)) {
            echo "<h1 style=color:red;>File already uploaded</h1>";
        } else {
            if (!file_exists("../uploads")) {
                mkdir("../uploads", 0600);
            }
            $valid_move = move_uploaded_file($_FILES["transcriptFile"]["name"], $target_file);
            if ($valid_move) {
                echo "The file has been successfully uploaded";
            }
        }

        // Unset local copy after insert or update
        unset($_SESSION['studentInfo']);
        header("Location: personalInfo.php");

    }else{
        echo '<h1 style="color:red;">Submission Error</h1>';
    }

?>
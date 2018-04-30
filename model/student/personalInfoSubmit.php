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

            // Let the user to pass the New Account Gate
            unset($_SESSION['newAccount']);
        }else {
            $errorCode = $database->updateStudent($arguments);
        }

        // Upload transcript
        // $db = new PDO("mysql:host=localhost;dbname=tasql", "dbuser" ,"password");
        if($_FILES['transcriptFile']['name'] != "") {
            // A file was selected for upload, your (re)action goes here

            $name = $_FILES["transcriptFile"]["name"];
            $type = $_FILES["transcriptFile"]["type"];
            $data = file_get_contents($_FILES["transcriptFile"]["tmp_name"]);
            $studentID = $arguments["studentId"];
            $result = $database->uploadTranscript($studentId, $type, $data);
        }

        // Unset local copy after insert or update
        unset($_SESSION['studentInfo']);
        header("Location: personalInfo.php");

    }else{
        echo '<h1 style="color:red;">Submission Error</h1>';
    }

?>
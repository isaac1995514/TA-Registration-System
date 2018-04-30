<?php

    // unset all login info
    if(isset($_SESSION['studentId'])){
        unset($_SESSION['studentId']);
    }

    if(isset($_SESSION['facultyId'])){
        unset($_SESSION['facultyId']);
    }

    if(isset($_SESSION['adminId'])){
        unset($_SESSION['adminId']);
    }

    // Go back to login page
    header("Location: ./login/login.php");

?>
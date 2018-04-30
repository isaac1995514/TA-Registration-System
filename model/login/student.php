<?php
  $username = $_POST['user'];
  $pass = $_POST['password'];
  $verpass = $_POST['verpassword'];
  $id = $_POST['key'];

  $db = new mysqli('localhost', 'dbuser', 'password', 'tasql');
  if(!$db){
    die("first failed" . mysqli_connect_error());
  }

    if($pass == $verpass){
      $passw = password_hash($pass, PASSWORD_DEFAULT);
      $sqlQuery = "insert into StudentAccount values('$id', '$username', '$passw')";
      $result = mysqli_query($db, $sqlQuery);
      if($result){
        session_start();
        $_SESSION['studentId'] = $id;
        $_SESSION['new'] = true;
        header("Location: ../student/personalInfo.php");
      }else{
        die("second failed1" . mysqli_connect_error());
      }
    }else{
      echo "Passwords do not match";
    }
?>

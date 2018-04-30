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
    $first = $_POST['first'];
    $middle = $_POST['middle'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dept = $_POST['dept'];

    $passw = password_hash($pass, PASSWORD_DEFAULT);
    $sqlQuery = "insert into FacultyAccount values('$id', '$username', '$passw')";
    $sqlQuery2 = "insert into Faculty (facultyId, firstName, middleName, lastName, email, phone, departmentName) values ('$id', '$first', '$middle', '$last', '$email', '$phone', '$dept')";

    $result = mysqli_query($db, $sqlQuery);
    $result2 = mysqli_query($db, $sqlQuery2);

    if($result && $result2){
      session_start();
      $_SESSION['facultyId'] = $id;
      $_SESSION['new'] = true;
      header("Location: ../faculty/viewTA.php");
      //redirect to other login for faculty
    }else{
      die("second2 failed" . mysqli_connect_error());
    }
  }else{
    echo "Passwords do not match";
  }
 ?>

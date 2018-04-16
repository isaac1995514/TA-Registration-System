<html>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Login</title>
  <link rel="stylesheet" href="login.css" />
<header>
  <img src= "UMD-White.png" alt="umd icon">
</header>

  <ul class="nav nav-tabs" role="tablist">
    <li class ="active"><a data-toggle= "tab" href= "#home">Log In</a></li>
    <li><a data-toggle="tab" href="#register">Register</a></li>
  </ul>

<body>
  <div class= "block">


  <div class= "tab-content">
    <br><div id="home" class= "tab-pane active" >
      <form action= "<?php $_SERVER['PHP_SELF']?>" method="post">
        <div class= "input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input type="text" class="form-control" name="user" placeholder="Username" required>
        </div><br>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <br><br>

        <select class="form-control" name= "type" required>
          <option value="student">Student</option>
          <option value="professor">Professor</option>
          <option value="admin">Admin</option>
        </select><br><br>

        <button type="submit" class="btn btn-default" name = "sub">
          <span class="glyphicon glyphicon-circle-arrow-right"></span>
        </button>

      </form>
      <?php
        require_once('../model/DatabaseManager.php');
        if(isset($_POST['sub'])){
          $obj = new DatabaseManager();
          $username = $_POST['user'];
          $pass = $_POST['password'];
          $temp = $obj->__construct();
          $db = new mysqli('localhost', 'dbuser', 'password', 'tasql');
          if(!$db){
            die("connection failed" . mysqli_connect_error());
          }

          if($_POST['type'] == 'student'){
            $sqlQuery = "select psw, studentId from StudentAccount where username = '$username'";
            $result = mysqli_query($db, $sqlQuery);
            if($result){
              $recordArray = mysqli_fetch_assoc($result);
              session_start();
              if(password_verify($pass, $recordArray['psw'])){
                $_SESSION['studentId'] = $recordArray['studentId'];
                header("Location: ../model/student/personalInfo.php");
              }else{
                echo "Username and password combination do not exist";
              }
            }
          }elseif($_POST['type'] == 'professor'){
            $sqlQuery = "select psw, facultyId from StudentAccount where username = '$username'";
            $result = mysqli_query($db, $sqlQuery);
            if($result){
              $recordArray = mysqli_fetch_assoc($result);
              session_start();
              if(password_verify($pass, $recordArray['psw'])){
                $_SESSION['facultyId'] = $recordArray['facultyId'];
                //Include new page for faculty
              }else{
                echo "Username and password combination do not exist";
              }
            }
          }else{
            $adminUser = 'Admin';
            $psw = 'password';

            if($username == $adminUser && $pass == $psw){
              //Include new page for admin
            }else {
              echo "Username and password combination do not exist";
            }
          }
        }
       ?>
    </div>
    <div id="register" class="tab-pane fade">
      <form action = "<?php $_SERVER['PHP_SELF']?>" method= "post">
        <select class="form-control" name= "acctype" required>
          <option value="student">Student</option>
          <option value="professor">Professor</option>
        </select><br>

        <div class= "input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
          <input type="text" class="form-control" name="user" placeholder="Username" required>
        </div><br>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div><br>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input type="password" class="form-control" name="verpassword" placeholder="Verify Password" required>
        </div><br><br>

        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
          <input type="text" class="form-control" name="key" placeholder="Key (Professors) or Student Id" required>
        </div><br><br>

        <button type="submit" class="btn btn-default" name="subdos">
          <span class="glyphicon glyphicon-circle-arrow-right"></span>
        </button>
      </form>
      <?php
        if(isset($_POST['subdos'])){
          require_once('../model/DatabaseManager.php');
          $obj = new DatabaseManager();
          $username = $_POST['user'];
          $pass = $_POST['password'];
          $verpass = $_POST['verpassword'];
          $id = $_POST['key'];
          $temp = $obj->__construct();
          $db = new mysqli('localhost', 'dbuser', 'password', 'tasql');
          if(!$db){
            die("connection failed" . mysqli_connect_error());
          }

          if($_POST['acctype'] == 'student'){
            if($pass == $verpass){
              $passw = password_hash($pass, PASSWORD_DEFAULT);
              $sqlQuery = "insert into StudentAccount values('$id', '$username', '$passw')";
              $result = mysqli_query($db, $sqlQuery);
              if($result){
                session_start();
                $_SESSION['studentId'] = $id;
                header("Location: ../model/student/personalInfo.php");
              }
            }else{
              echo "Passwords do not match";
            }
          }else{
            if($pass == $verpass){
              $passw = password_hash($pass, PASSWORD_DEFAULT);
              $sqlQuery = "insert into FacultyAccount values('$id', '$username', '$passw')";
              $result = mysqli_query($db, $sqlQuery);
              if($result){
                session_start();
                $_SESSION['facultyId'] = $id;
                //redirect to other login for faculty
              }
            }else{
              echo "Passwords do not match";
            }
          }
        }
      ?>
    </div>
  </div>
</div>
</body>
</html>

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
        if(isset($_POST['sub'])){
          $username = $_POST['user'];
          $pass = $_POST['password'];
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
                header("Location: ./../student/personalInfo.php");
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
              header("Location: ./../admin/applicationFilter.php");
            }else {
              echo "Username and password combination do not exist";
            }
          }
        }
       ?>
    </div>
    <div id="register" class="tab-pane fade">
      <form action = "<?php $_SERVER['PHP_SELF']?>" method= "post">


        <select data-target=".my-info-1" class="div-toggle form-control" name= "acctype" required>
            <option value="student" data-show=".stud">Student</option>
            <option value="professor" data-show=".prof">Professor</option>
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

        <div class = "my-info-1">
          <div id = "prof" class = "prof hide">
            <input type="text" class="form-control" name="first" placeholder="First Name" required><br>
            <input type="text" class="form-control" name="middle" placeholder="Middle Name"><br>
            <input type="text" class="form-control" name="last" placeholder="Last Name" required><br>
            <div class= "input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div><br>

            <div class= "input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
              <input type="text" size = "10" maxlength="10" class="form-control" id= "phone" name="phone" placeholder="Phone Number" required>
            </div><br>

            <div class= "input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
              <input type="text" class="form-control" name="dept" placeholder="Department Name" required>
            </div><br>

            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
              <input type="text" class="form-control" name="key" placeholder="Faculty Id" required>
            </div><br><br>

            <button type="submit" class="btn btn-default" name="subdos">
              <span class="glyphicon glyphicon-circle-arrow-right"></span>
            </button>
          </div>

          <div id = "stud" class = "stud hide">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
              <input type="text" class="form-control" name="key" placeholder="Student Id" required>
            </div><br><br>

            <button type="submit" class="btn btn-default" name="subdos">
              <span class="glyphicon glyphicon-circle-arrow-right"></span>
            </button>
          </div>
        </div>

      </form>

      <script>
        $(document).on('change', '.div-toggle', function() {
          var target = $(this).data('target');
          var show = $("option:selected", this).data('show');
          $(target).children().addClass('hide');
          $(show).removeClass('hide');
        });
        $(document).ready(function(){
            $('.div-toggle').trigger('change');
        });
      </script>
      <?php
        if(isset($_POST['subdos'])){
          $username = $_POST['user'];
          $pass = $_POST['password'];
          $verpass = $_POST['verpassword'];
          $id = $_POST['key'];
          $db = new mysqli('localhost', 'dbuser', 'password', 'tasql');
          if(!$db){
            die("first failed" . mysqli_connect_error());
          }

          if($_POST['acctype'] == 'student'){
            if($pass == $verpass){
              $passw = password_hash($pass, PASSWORD_DEFAULT);
              $sqlQuery = "insert into StudentAccount values('$id', '$username', '$passw')";
              $result = mysqli_query($db, $sqlQuery);
              if($result){
                session_start();
                $_SESSION['studentId'] = $id;
                $_SESSION['newAccount'] = true;
                header("Location: ./../student/personalInfo.php");
              }else{
                die("second failed" . mysqli_connect_error());
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
                $_SESSION['newAccount'] = true;
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

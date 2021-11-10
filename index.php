<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sweet alert -->
<script src="plugins/sweetalert/sweetalert.js"></script>


<?php
include 'connectdb.php';
session_start();

if(isset($_POST['btn_login'])){

$useremail = $_POST['txt_useremail'];
$password = $_POST['txt_password'];


$row= $pdo->query("SELECT * FROM tbl_user WHERE useremail='$useremail' AND password = '$password'")->fetch(PDO::FETCH_OBJ);


// echo $useremail;
// echo $password;
// echo "<pre>";
// print_r($row);
// echo "<br>";
// echo $row->useremail;
// echo "</pre>";
if($row){
    if($row->useremail==$useremail AND $row->password==$password AND $row->role=="Admin"){
      $_SESSION['useremail'] = $row->useremail;
      $_SESSION['user_id'] = $row->user_id;
      $_SESSION['username'] = $row->username;
      $_SESSION['role'] = $row->role;
     echo '<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "Succfully LOG IN",
          text: "Welcome!'.$_SESSION['username'].'",
          icon: "success",
        });

        });

</script>';

      header('refresh:1;orderlist.php');
    }
    else if($row->useremail==$useremail AND $row->password==$password AND $row->role=="User"){
     $_SESSION['useremail'] = $row->useremail;
      $_SESSION['user_id'] = $row->user_id;
      $_SESSION['username'] = $row->username;
      $_SESSION['role'] = $row->role;

      echo'<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "Succfully",
          text: "LOG IN",
          icon: "success",
        });

        });

</script>';

      header('refresh:1;orderlist.php');
    }
  }
    else{
      echo '<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "LOGIN",
          text: "Fail",
          icon: "error",
        });

        });

</script>';
    }
}



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- <link rel="stylesheet" href="plugins/sweetalert/sweetalert.js"> -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.php"><b>INVENTORY</b>POS</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="index.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="txt_useremail" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="txt_password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
             
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="btn_login">Log In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->



</body>
</html>

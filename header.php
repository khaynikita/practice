<?php
date_default_timezone_set('Asia/Kolkata');
if($_SESSION['useremail']==""){

  header('location:index.php');
}
if (isset($_POST['change'])) {
  $old_pass = $_POST['txtoldpass'];
  $new_pass = $_POST['txtnewpass'];
  $conf_pass = $_POST['txtconfpass'];
  $id = $_SESSION['user_id'];

       if($new_pass == $conf_pass){
         $row = $pdo->query("UPDATE tbl_user SET password = '$new_pass' WHERE user_id = '$id'")->fetch(PDO::FETCH_OBJ);
         echo'<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "Succfully Updated",
          text: "LOG IN",
          icon: "success",
        });

        });

         </script>';
       }
      

 else{
 echo '<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "password does not match",
          text: "Fail'.$_SESSION['username'].'",
          icon: "error",
        });

        });

</script>';

 }
}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<!-- data tables -->
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
 <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <title>INVENTORY POS</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">INVENTORY POS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['username']?></a>
          <a href="#" class="d-block"><?php echo $_SESSION['useremail']?></a>
          <br>
           
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-password" id="change_btn">

                  Change Password
                </button><br><br>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">
                  logout
                </button>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li >
            <a href="orderlist.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                 Dashboard
              </p>
            </a>
            <ul class="nav">
              <li class="nav-item">
                <a href="createorder.php" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Create Order</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="category.php" class="nav-link">
                  <i class="far fa-list-alt nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
             <li class="nav-item">
                <a href="registration.php" class="nav-link ">
                  <i class="far fa-registered nav-icon"></i>
                  <p>Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="productlist.php" class="nav-link ">
                  <i class="far fa-list-alt"></i>
                  <p> Product List </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="addproduct.php" class="nav-link ">
                  <i class="far fa-plus-square"></i>
                  <p>Add Product</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    <!-- </div> -->
    <!-- /.sidebar -->
  </aside>

  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Log Out</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <b> <p>Are u sure ?</p><b>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             <a href="logout.php"><button type="button" class="btn btn-danger" >Log Out</button></a> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

       <div class="modal fade" id="modal-password">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Passsword</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <div class="card card-primary">
             
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" name="password-form" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="txtoldpass">Old Password</label>
                    <input type="password" class="form-control" id="txtoldpass" placeholder="Enter password" name="txtoldpass" required>
                    <div id="not_match">
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="txtnewpass">New Password</label>
                    <input type="password" class="form-control" id="txtnewpass" placeholder="Password" name="txtnewpass" required>
                  </div>
                  <div class="form-group">
                    <label for="textconfpass">Confirm Password</label>
                    <input type="password" class="form-control" id="txtconfpass" placeholder="Password" name="txtconfpass" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="change" name="change" value="change_submit">Change</button>
                </div>
              </form>
            </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->  
<!-- <script type="text/javascript">
  $('#txtoldpass').keypress(function(e) {
    /* Act on the event */
    var key = e.keycode || e.which;
    if(key == 13)
    {
      alert("check");
    }
  });
</script>   -->
<script src="plugins/sweetalert/sweetalert.js"></script>   
<script src="plugins/jquery/jquery.min.js"></script>
  <script type="text/javascript"> 
    $('#change_btn').click(function() {
          $("#change").hide();
    });
    
  $('#txtoldpass').focusout(function(e) {
    /* Act on the event */
      var old_pass = $(this).val();
      
      $.ajax({
              url: 'match_password.php',
              type: 'POST',
              data: {old_pass: old_pass},
              dataType: 'JSON',
              success : function(response) {
              // var  response = $.parseJSON(response);
               // console.log(response.success);
               //  console.log(response.mayank);  
              if(response.success == 1)
              {
               
                $('#not_match').html('<span class="alert text-success">Correct Password!!</span>');
                     $("#change").show();   
              }
              else{
                $('#not_match').html('<span class="alert text-danger">Incorrect Password!!</span>');
                     $("#change").hide();

              }
            } 
            });
           });

</script> 

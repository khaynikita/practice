
<?php
include 'connectdb.php' ;
include 'sweet.php' ;

session_start();

if($_SESSION['useremail']=="") { 
  header('location:index.php');
}
if($_SESSION['role']=="User"){
  echo'<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "Only for admin",
          text: "NO ACEESS",
          icon: "error",
        });

        });

</script>';
header('refresh:1;orderlist.php');

}
include 'header.php';
include 'registerform.php';

error_reporting(0);
$id = $_GET['user_id'];
if ($id) {
  $delete=$pdo->prepare("delete from tbl_user where user_id=".$id);
if($delete->execute()){
 echo'<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "Succfully Deleted",
          text: "DELETE",
          icon: "success",
        });

        });

</script>';

}else{
  echo '<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "DELETE",
          text: "Fail",
          icon: "error",
        });

        });

</script>';


}

  
}


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Registration</h1>
        </div><!-- /.col -->
        <!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Register</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="registerform.php" method="Post">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="txtname">Name</label>
                      <input type="name" class="form-control" name="txtname" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                      <label for="txtemail">Email address</label>
                      <input type="email" class="form-control" name="txtemail" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                      <label for="txtpassword">Password</label>
                      <input type="password" class="form-control" name="txtpassword" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <label>Role</label>
                      <select class="form-control" name="txtselect_option">
                        <option class="form-control" name="txtselect_option">Select role</option>
                        <option>Admin</option>
                        <option>User</option>
                      </select>
                    </div>
                     <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="btn_save">Save</button>
                </div>
                  </div>
                </form>
                  
                  <div class="col-md-8">
                    <div style="overflow-x: auto">
                    <table class="table table striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Password</th>
                          <th>Role</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php
                       $select= $pdo->prepare("Select* from tbl_user order by user_id desc");
                       $select->execute();
                       while($row=$select->fetch(PDO::FETCH_OBJ)){
                        echo'<tr>
                        <td>'.$row->user_id.'</td>
                        <td>'.$row->username.'</td>
                        <td>'.$row->useremail.'</td>
                        <td>'.$row->password.'</td>
                        <td>'.$row->role.'</td>
                        <td><a href="registration.php?user_id='.$row->user_id.'" class="btn btn-danger" role="button"><span class="fas fas-trash" title="delete"></span></a>
                        </td>
                        </tr>'; 
                      }


                       ?> 
                       
                      
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
                <!-- /.card-body -->
               
            
          </div>
  </section>
  <!-- content-wrapper -->
</div>
  <?php
include 'footer.php';

?>

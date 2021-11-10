<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sweet alert -->
<script src="plugins/sweetalert/sweetalert.js"></script>

<?php
include'connectdb.php';
if(isset($_POST['btn_save'])){

$username= $_POST['txtname'];
$useremail= $_POST['txtemail'];
$password= $_POST['txtpassword'];
$role= $_POST['txtselect_option'];

if(isset($_POST['txtemail'])){

$select=$pdo->prepare("select useremail from tbl_user where useremail = '$useremail' ");
$select->execute();

if($select->rowcount()>0){

	echo '<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "Entered Email",
          text: "Already Exist",
          icon: "error",
        });

        });

</script>';
header('refresh:3;registration.php');
}
else{

	$insert = $pdo->prepare("insert into tbl_user(username,useremail,password,role) values(:name,:email,:pass,:role) ");
$insert->bindParam(":name",$username);
$insert->bindParam(":email",$useremail);
$insert->bindParam(":pass",$password);
$insert->bindParam(":role",$role);
$insert->execute();
 echo '<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "Successfully SAVED",
          text: "Welcome!  '.$username.'",
          icon: "success",
        });

        });

</script>';
header('refresh:3;registration.php');

}


}






}



?>
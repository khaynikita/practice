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


include 'header.php';




if(isset($_POST['btn_save'])){

$category = $_POST['txtcategory'];

if(empty($category)){
  $error = '<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "Error",
          text: "Feild is empty : please enter category!!",
          icon: "error",
          button:"ok",
        });

        });

</script>';
echo $error;
}

if(!isset($error)){
$insert = $pdo->prepare("insert into tbl_cat(category) values(:cat) ");
 $insert->bindParam(":cat",$category);
  $aya = $insert->execute();
  if ($aya) {
    echo '<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "Good Job !",
          text: "Your Category is Added",
          icon: "success",
          button : "ok",
        });

        });

</script>';
    
  }

}
}

if(isset($_POST['btn_update'])){

 $id = $_POST['cat_id'];
 $category = $_POST['category'];

if(empty($category)){
  $errorupdate = '<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "Error",
          text: "Feild is empty : please enter category!!",
          icon: "error",
          button:"ok",
        });

        });

</script>';
echo $errorupdate;
}

if(!isset($errorupdate)){

  $update = $pdo->prepare("update tbl_cat set category='$category' where cat_id=".$id);
  $update->bindParam(':category',$category);

  if($update->execute()){
  
  echo '<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "Good Job !",
          text: "Your Category is Update !!",
          icon: "success",
          button : "ok",
        });

        });

</script>';



  }

}

}

if(isset($_POST['btndelete'])){
$id = $_POST['btndelete'];
if ($id) {
  $delete=$pdo->prepare("delete from tbl_cat where cat_id=".$id);
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

}



?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Category</h1>
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
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">
                Category form
              </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <form role="form" action="category.php" method="Post">
              <div class="row">
                  <?php
                  if(isset($_POST['btnedit'])){
                    // $h = $_POST['btnedit'];
                    // echo $h;
                   $select = $pdo->prepare("select * from tbl_cat where cat_id=".$_POST['btnedit']);
                   $select->execute();

                   if($select){
                    $row = $select->fetch(PDO::FETCH_OBJ);
                    echo' <div class="col-md-4">
                    <div class="form-group">
                      <input type="hidden" class="form-control" value="'.$row->cat_id.'"name="cat_id" >
                    </div>
                    <div class="form-group">
                      <label for="txtcategory">category</label>
                      <input type="text" class="form-control"
                      value="'.$row->category.'" name="category" placeholder="Enter Name">
                    </div>
                  
                    <div class="card-footer">
                      <button type="submit" class="btn btn-info" name="btn_update">Update</button>
                    </div>
                  </div>';

                   }

                  }
                  else{
                    echo ' <div class="col-md-4">
                    <div class="form-group">
                      <label for="txtcategory">category</label>
                      <input type="text" class="form-control" name="txtcategory" placeholder="Enter Name">
                    </div>
                  
                    <div class="card-footer">
                      <button type="submit" class="btn btn-success" name="btn_save">Save</button>
                    </div>
                  </div>';

                  }


                  ?>
                
                 
                      <div class="col-md-8">
                        <table class="table table striped" id="myTable">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Category</th>
                              <th>Edit</th>
                              <th>Delete</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                                 $select= $pdo->prepare("Select* from tbl_cat order by cat_id desc");
                                 $select->execute();
                                 while($row=$select->fetch(PDO::FETCH_OBJ)){
                                  echo'<tr>
                                  <td>'.$row->cat_id.'</td>
                                  <td>'.$row->category.'</td>
                                  <td>
                                  <button type="submit" value="'.$row->cat_id.'" class="btn btn-success" name="btnedit">EDIT</button>
                                  </td>
                                  <td>
                                  <button type="submit" value="'.$row->cat_id.'" class="btn btn-danger" name="btndelete">DELETE</button>
                                  </td>
                                  </tr>'; 
                                         }
                                         ?>
                          </tbody>
                        </table>
                      </div>
                </div>
              </form>
              <!-- /.card-body -->
            </div>
  </section>
  <!-- content-wrapper -->
</div>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<?php
include 'footer.php';

?>

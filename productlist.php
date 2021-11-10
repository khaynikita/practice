<?php
include 'connectdb.php';
session_start();
if($_SESSION['useremail']==""){

	header('location:index.php');
  }
include 'header.php';

if(isset($_POST['btn_delete'])){
$id = $_POST['btn_delete'];
if ($id) {
  $delete=$pdo->prepare("delete from tbl_product where p_id=".$id);
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
	          <h1 class="m-0 text-dark">Products</h1>
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
			        <div class="col-md-12">
			          <!-- general form elements -->
			          <div class="card card-info">
			            <div class="card-header">
			              <h3 class="card-title"> Product List</h3>
			            </div>
			            <!-- /.card-header -->
			            
					    <div class="card-body">
						    <div class="row">
							    <div class="col-md-12 text-center">
							    	<form method="post" action="productlist.php">
							    <div  style="overflow-x: auto">
	                               <table class="col-md-12 table table striped" id="myTable">
			                          <thead>
			                            <tr>
			                              <th>#</th>
			                              <th>Name</th>
			                              <th>Category</th>
			                              <th>Purchase Price</th>
			                              <th>Sale Price</th>
			                              <th>Stock</th>
			                              <th>Description</th>
			                              <th>Image</th>
			                              <th>View</th>
			                              <th>Edit</th>
			                              <th>Delete</th>
			                            </tr>
			                          </thead>
			                               <tbody>
			                                 <?php
			                                 $select= $pdo->prepare("Select* from tbl_product order by p_id desc");
			                                 $select->execute();
			                                 while($row=$select->fetch(PDO::FETCH_OBJ)){
			                                  echo'<tr>
			                                  <td>'.$row->p_id.'</td>
			                                  <td>'.$row->p_name.'</td>
			                                  <td>'.$row->p_category.'</td>
			                                  <td>'.$row->p_price.'</td>
			                                  <td>'.$row->sale_price.'</td>
			                                  <td>'.$row->p_stock.'</td>
			                                  <td>'.$row->p_desc.'</td>
			                                  <td><img src = "upload/'.$row->p_image.'" class = "img-rounded" width="40px" height="40px"/></td>
			                                  <td><a href="viewproduct.php?view_btn='.$row->p_id.'">
			                                  <button type="button" class="btn btn-success" value="'.$row->p_id.'" name="view_btn">VIEW</button>
			                                  </a>
			                                  </td>
			                                  <td>
			                                 <a href="editproduct.php?edit_btn='.$row->p_id.'">
			                                  <button type="button" class="btn btn-info" value="'.$row->p_id.'"name="edit_btn">EDIT</button>
			                                  </a>
			                                  </td>
			                                  <td>
			                                  <button type="submit" value="'.$row->p_id.'" class="btn btn-danger" name="btn_delete">DELETE</button>
			                                  </td>
			                                  </tr>'; 
			                                         }
			                                         ?>
			                              </tbody>
	                              </table>
	                          </div>
	                           </form>
	               


							   
							</div>
				        </div>
				   </div>		          
		        </div>       <!-- /.card-body -->    
		   </div>
	  </section>
	  <!-- content-wrapper -->
	</div>

<?php
include 'footer.php';
?>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>


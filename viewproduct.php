<?php

include "connectdb.php";
session_start();
if($_SESSION['useremail']==""){

	header('location:index.php');
  }
include "header.php";
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">View Product</h1>
          </div><!-- /.col -->
         <!-- /.col -->        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row">

        	<?php
        	$id = $_GET['view_btn'];

        	$select=$pdo->prepare("select * from tbl_product where p_id=".$id);
        	
        	$select->execute();

        	while($row=$select->fetch(PDO::FETCH_OBJ)){

        		echo '<div class="col-md-6">
					              	 <ul class="list-group">
					              	         <center><p class="list-group-item list-group-item-success"><b>Product Detail</b></p></center>
											  <li class="list-group-item d-flex justify-content-between align-items-center">
											    ID
											    <span class="badge badge-primary badge-pill">'.$id.'</span>
											  </li>
											  <li class="list-group-item d-flex justify-content-between align-items-center">
											    Product Name
											    <span class="badge badge-success badge-pill">'.$row->p_name.'</span>
											  </li>
											  <li class="list-group-item d-flex justify-content-between align-items-center">
											    Category
											   <span class="badge badge-danger badge-pill">'.$row->p_category.'</span>
											  </li>
											  <li class="list-group-item d-flex justify-content-between align-items-center">
											    Purchase Price
											   <span class="badge badge-info badge-pill">'.$row->p_price.'</span>
											  </li> 
											  <li class="list-group-item d-flex justify-content-between align-items-center">
											    Sale Price
											   <span class="badge badge-warning badge-pill">'.$row->sale_price.'</span>
											  </li> 
											  <li class="list-group-item d-flex justify-content-between align-items-center">
											    Stock
											   <span class="badge badge-success badge-pill">'.$row->p_stock.'</span>
											  </li> 
											  <li class="list-group-item  justify-content-between align-items-center">
											    Description :
											   <span class="">'.$row->p_desc.'</span>
											  </li>
											  
                                      </ul>
                                      <br><br>
                                      <div class="col-md-12 text-center">
				                  	 <a href="productlist.php" class="btn btn-danger" role="button">Back To Product List</a>
				                  	 </div>
					              	 </div>

					              	 <div class="col-md-6">
					             	 	<ul class="list-group">
					              	         <center><p class="list-group-item list-group-item-success"><b>Product Image</b></p></center>
											  <img src = "upload/'.$row->p_image.'" class = "img-responsive" height="500px"/>
                                      </ul>	
					            	</div>';



        	}




        	




        	?>







        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

<?php
include "footer.php";
 ?>
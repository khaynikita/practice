<?php
 ob_start();
include "connectdb.php";
include 'sweet.php' ;
session_start();
if($_SESSION['useremail']==""){

  header('location:index.php');
}
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


	if(isset($_GET['edit_btn']))
	{
	 $id = $_GET['edit_btn'];	
	 $select= $pdo->prepare("Select* from tbl_product where p_id=".$id);
	 $select->execute();
	 $row=$select->fetch(PDO::FETCH_OBJ);
	 $_SESSION['p_id'] = $row->p_id; 
	 $_SESSION['p_name'] = $row->p_name;
	 $_SESSION['p_category'] = $row->p_category;
	 $_SESSION['p_price'] = $row->p_price;
	 $_SESSION['sale_price'] = $row->sale_price;
	 $_SESSION['p_stock'] = $row->p_stock;
	 $_SESSION['p_desc'] = $row->p_desc;
	 $_SESSION['p_image'] = $row->p_image;
	}

if(isset($_POST['btn_update'])) {

	$p_id = $_POST['edit_btn'];
	$pname = $_POST['p_name'];

	$category = $_POST['txtselect_option'];

	$purchaseprice = $_POST['p_price'];

	$saleprice = $_POST['sale_price'];

	$stock = $_POST['p_stock'];

	$desc = $_POST['p_desc'];

	$p_image = $_FILES['p_image']['name'];
	if ($p_image) {
		
       
	$f_name = $_FILES['p_image']['name'];
	$f_tmp =  $_FILES['p_image']['tmp_name'];

	 $f_size = $_FILES['p_image']['size'];
	 $f_extension = explode('.',$f_name);
	 $f_extension = end($f_extension);
	 $f_newfile = uniqid().".". $f_extension;
	  $store = "upload/".$f_newfile;

// To check file size is not more than 1MB
	     if ($f_extension=="jpg"||$f_extension=="png"||$f_extension=="gif"||$f_extension=="jpeg") {
			   if ($f_size>=1000000) {
			   	$error = '<script type="text/javascript">
			      jQuery(function validation(){

			         swal({
			          title: "Error!",
			          text: "Max file should be 1MB!",
			          icon: "warning",
			          button:"Ok",
			        });

			        });

			</script>';
			echo $error;
			   } 
	       else {
	   	if (move_uploaded_file($f_tmp,$store)) {
	      $image = $f_newfile;
	   	}
	  } 
	}  
	 else {
	    $error = '<script type="text/javascript">
	      jQuery(function validation(){

	         swal({
	          title: "Warning!",
	          text: "only jpg,jpeg,png and gif can be upload!",
	          icon: "error",
	          button:"Ok",
	        });

	        });

	</script>';

	echo $error;
	 	}      
	}

 

// ----------------------------------------//


 if(!isset($error)){

if($p_image){


$insert = $pdo->prepare("update tbl_product set p_name=:p_name,p_category=:p_category,p_price=:p_price,sale_price=:sale_price,p_stock=:p_stock,p_desc=:p_desc,p_image=:p_image where p_id=".$p_id);


$insert->bindParam(':p_name',$pname);
$insert->bindParam(':p_category',$category);
$insert->bindParam(':p_price',$purchaseprice);
$insert->bindParam(':sale_price',$saleprice);
$insert->bindParam(':p_stock',$stock);
$insert->bindParam(':p_desc',$desc);
$insert->bindParam(':p_image',$image);
}
else{

$insert = $pdo->prepare("update tbl_product set p_name=:p_name,p_category=:p_category,p_price=:p_price,sale_price=:sale_price,p_stock=:p_stock,p_desc=:p_desc where p_id=".$p_id);


$insert->bindParam(':p_name',$pname);
$insert->bindParam(':p_category',$category);
$insert->bindParam(':p_price',$purchaseprice);
$insert->bindParam(':sale_price',$saleprice);
$insert->bindParam(':p_stock',$stock);
$insert->bindParam(':p_desc',$desc);
}

if($insert->execute()){

echo'<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "Add product sucessfully !!",
          text: "INSERTED",
          icon: "success",
        });

        });

</script>';

header('Location:productlist.php');
}else{
	echo'<script type="text/javascript">
      jQuery(function validation(){

         swal({
          title: "Add product fail !!",
          text: "error",
          icon: "error",
          button: "ok",
        });

        });

</script>';

}

 }
}
 ob_end_flush();
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Product</h1>
          </div><!-- /.col -->
         <!-- /.col -->        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
     <div class="container-fluid">
       <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Update Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
          <form role="form" action="editproduct.php"  method="Post" enctype="multipart/form-data" >
            <input type="hidden" name="edit_btn" value="<?= $id ?>">
				            <div class="card-body">
				                <div class="row">
				                	<div class="col-md-12 text-center">
				                  	 <a href="productlist.php" class="btn btn-danger" role="button">Back To Product List</a>
				                  	 </div>
				                  	 <br><br>
				                  <div class="col-md-6">
				                  	
					                    <div class="form-group">
					                      <label for="p_category">Category</label>
					                      <select class="form-control" name="txtselect_option" id="cat" required >
					                        <option value=""
					                        disabled selected 
					                        ></option>
					                        <?php
                                           $select = $pdo->prepare("select*from tbl_cat order by cat_id desc");
                                           $select->execute();
                                           while($row=$select->fetch(PDO::FETCH_ASSOC)){
                                           	extract($row)?>
                                         <option value="<?php echo $row['category'];?>"><?php echo $row['category'];?></option>
                                         <?php


                                           } 
                                           ?>

					                    </select>

					                      <div class="form-group">
					                      <label for="p_name">Product Name</label>
					                      <input type="name" class="form-control" name="p_name" placeholder="Enter Name" value="<?=  $_SESSION['p_name']; ?>" required>
					                    </div>
					                       
					                    </div>
					                    <div class="form-group">
					                      <label for="p_price">Purchase price</label>
					                      <input type="number" min="1" step="1"  class="form-control" name="p_price" placeholder="Enter" value="<?= $_SESSION['p_price']?>" required>
					                    </div>
					                   <div class="form-group">
					                      <label for="sale_price">Sale price</label>
					                      <input type="number" min="1" step="1" class="form-control" name="sale_price" placeholder="Enter" value="<?= $_SESSION['sale_price']?>" required>
					                   </div>
					                    <div class="card-footer">
                     
                                        <a href="editproduct.php?btn_update"> <button type="submit" class="btn btn-info" name="btn_update">Update</button></a>
                                       </div>
					               </div>   
					                 
				                  
					                   <div class="col-md-6">
						                   <div class="form-group">
						                      <label for="p_stock">Stock</label>
						                      <input type="number" min="1" step="1" class="form-control" name="p_stock" placeholder="Enter" value="<?= $_SESSION['p_stock']?>" 
						                      required>
					                        </div>
					                        <div class="form-group">
						                      <label for="p_desc">Description</label>
						                      <textarea type="name" class="form-control" name="p_desc" placeholder="Enter" rows="4" required><?= $_SESSION['p_desc']?></textarea>
					                       </div>
					                         <div class="form-group">
							                      <label for="p_image">Image</label>
							                      <img src="upload/<?= $_SESSION['p_image']?>" class = "img-rounded" width="40px" height="40px">
							                      <input type="file" class="form-control" name="p_image" placeholder="Enter" >
							                      <p>upload image</p>
					                         </div>
					                  </div>
				                </div>
				           </div>
          </form>
                <!-- /.card-body -->     
        </div>
  </section>

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
 $tep = "";
 $tep .="<script>";
 $tep .="$('#cat').val('".$_SESSION['p_category']."').attr('selected',true)";
 $tep .="</script>";
 
 echo $tep; 
 ?>
<?php
include "footer.php";
?>
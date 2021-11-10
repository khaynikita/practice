<?
include 'connectdb.php';
session_start();
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
'<script type="text/javascript">
		      jQuery(function validation(){

		         swal({
		          title: "Update product success !!",
		          text: "error",
		          icon: "sucess",
		          button: "ok",
		        }).then(function(){ 
   location.reload();
   });

		        });

		</script>';

		header('refresh:3;productlist.php');


		}else{
			echo '<script type="text/javascript">
		      jQuery(function validation(){

		         swal({
		          title: "Update product fail !!",
		          text: "error",
		          icon: "error",
		          button: "ok",
		        });

		        });

		</script>';

		}

 }

}





?>
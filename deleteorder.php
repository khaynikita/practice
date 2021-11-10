<?php
include 'connectdb.php';
session_start();
include 'sweet.php';
if(isset($_GET['btn_delete'])){
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
	  else{
	$id = $_GET['btn_delete'];
	// echo $id;
	if ($id) {

		// DELETE T1,T2 FROM T1 INNER JOIN T2 ON T1.key = T2.key WHERE condition T1.key = id;
		$sql = "delete tbl_invoice, tbl_invoice_details FROM tbl_invoice INNER JOIN tbl_invoice_details ON tbl_invoice.in_id = tbl_invoice_details.in_id where tbl_invoice.in_id=$id";
	    $delete = $pdo->prepare($sql);
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
    header("location:orderlist.php");
}
}
?>
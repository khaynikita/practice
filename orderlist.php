<?php

include 'connectdb.php';
session_start();

if($_SESSION['useremail']==""){

  header('location:index.php');
}

// print_r($_POST);
 include 'header.php';
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin Dashboard</h1>
          </div><!-- /.col -->
         <!-- /.col -->        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        	<div  style="overflow-x: auto">
	                               <table class="col-md-12 table table striped" id="orderlisttable">
			                          <thead>
			                            <tr>
			                              <th>Invoice ID</th>
			                              <th>Customer Name</th>
			                              <th>OrderDate</th>
			                              <th>Total</th>
			                              <th>Paid</th>
			                              <th>Due</th>
			                              <th>Payment Type</th>
			                              <th>Print</th>
			                              <th>Edit</th>
			                              <th>Delete</th>
			                            </tr>
			                          </thead>
			                               <tbody>
			                                 <?php
			                                 $select= $pdo->prepare("Select* from tbl_invoice order by in_id desc");
			                                 $select->execute();
			                                 while($row=$select->fetch(PDO::FETCH_OBJ)){
			                                  echo'<tr>
			                                  <td>'.$row->in_id.'</td>
			                                  <td>'.$row->cust_name.'</td>
			                                  <td>'.$row->date.'</td>
			                                  <td>'.$row->total.'</td>
			                                  <td>'.$row->paid.'</td>
			                                  <td>'.$row->due.'</td>
			                                  <td>'.$row->pay_type.'</td>
			                                  
			                                  <td><a href="invoice_db.php?view_btn='.$row->in_id.'" target="_blank">
			                                  <button type="button" class="btn btn-warning" value="'.$row->in_id.'" name="print_btn">PRINT</button>
			                                  </a>
			                                  </td>


			                                  <td>
			                                 <a href="editorder.php?edit_btn='.$row->in_id.'">
			                                  <button type="button" class="btn btn-info" value="'.$row->in_id.'"name="edit_btn">EDIT</button>
			                                  </a>
			                                  </td>
			                                  <td>
											  <a href="deleteorder.php?btn_delete='.$row->in_id.'">
			                                  <button type="submit" value="'.$row->in_id.'" class="btn btn-danger" name="btn_delete">DELETE</button>
											  </a>
			                                  </td>
											

			                                  </tr>'; 
			                                         }
			                                         ?>
			                              </tbody>
	                              </table>
	                          </div>
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
include 'footer.php';

?>
<script>
$(document).ready( function () {
    $('#orderlisttable').DataTable();
} );
</script>


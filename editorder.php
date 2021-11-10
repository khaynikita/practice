
<?php
include 'connectdb.php';
include 'sweet.php';
session_start();

// include 'updateorder.php';

if($_SESSION['useremail']==""){

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
///////////////////////////////////////////////////////////
function fill_product($pdo,$pid){

$output='';

$select=$pdo->prepare("select * from tbl_product order by p_name asc");
$select->execute();

$result = $select->fetchAll();

foreach($result as $row){

  $output.='<option value="'.$row["p_id"].'"';
  if($pid==$row['p_id']){
    $output.='selected';
  }
  $output.='>'.$row["p_name"].'</option>';
}

return $output;

}
function pro($pdo,$pid){
  $out = '';
  $yo=$pdo->prepare("select * from tbl_product where p_id=$pid");
  $yo->execute();
  $yop= $yo->fetchAll();
  foreach($yop as $proname){
    $out.='value = "'.$yop["p_name"].'"';
  }
  return $out;
}
if($id = $_GET['edit_btn']){
$select=$pdo->prepare("select * from tbl_invoice where in_id = $id");
// print_r($select);
$select->execute();

$row=$select->fetch(PDO::FETCH_ASSOC);
// print_r($row);

$cust_name = $row['cust_name'];
$cust_number = $row['cust_number'];
$date = $row['date'] ;
$sub_total = $row['sub_total'];
$tax = $row['tax'];
$discount = $row['discount'];
$total = $row['total'];
$paid = $row['paid'];
$due = $row['due'];
$pay_type = $row['pay_type'];

$hello=$pdo->prepare("select * from tbl_invoice_details where in_id = $id");
// print_r($hello);
$hello->execute();

$row_invoice_details=$hello->fetchAll(PDO::FETCH_ASSOC);
// print_r($row_invoice_details);
}
////////////////////////////////////////////////////////
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Order</h1>
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
              <h3 class="card-title">Edit Order</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
          <form role="form" action="updateorder.php"  method="Post" enctype="multipart/form-data" >
                   <div class="card-body">
                         <div class="row">

                             <div class="col-md-6">
                                  <div class="form-group">
                                       <label for="cust_name">Customer Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="fas fa-user-circle"></i>
                                              </span>
                                           </div>
                                          <input type="text" class="form-control" name="cust_name" value="<?php echo $cust_name;?>"  required>
                                        </div>
                                  </div>
                               
                              </div>   
                           
                              <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="cust_number">Contact No.</label>
                                      <input type="number" class="form-control" name="cust_number" value="<?php echo $cust_number?>" placeholder="Contact Number" required>
                                     <input type="hidden" name="date" value="<?php echo $date; ?>" data-date-format="H:i:s M d, Y">
                                    </div>
                                 </div>    
                            </div>

                          <div class="row">
                            <div class="col-md-12">
                               <div style="overflow-x: auto">
                              <table class=" table table striped" id="myTable">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Search Product</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Enter Quantity</th>
                                    <th>Total</th>
                                    <th>
                                      <button type="button" name="add" class="btn btn-info btn-sm btn_add"><span class="fas fa-plus"></span></button>
                                    </th>
                                    
                                  </tr>
                                </thead>
                                
                                <?php
                                foreach($row_invoice_details as $item_invoice_details){
                                    // echo $item_invoice_details['p_id'];
                                    $select=$pdo->prepare("select * from tbl_product where p_id='{$item_invoice_details['p_id']}'");
                                    $select->execute();
                                    $row_product=$select->fetch(PDO::FETCH_ASSOC);
                                    // print_r($row_product);
                                    ?>
                                    <tr>
                                    <?php
                                    echo'<td><input type="hidden" class="form-control p_name" value="'.$row_product['p_name'].'"  name="productname[]"></td>';
                                    echo'<td><select class="form-control p_id" name="productid[]" ><option value="">Select Option</option>'.fill_product($pdo,$item_invoice_details['p_id']).'</select></td>';         
                                    echo'<td><input type="text" class="form-control stock" name="stock[]" value="'.$row_product['p_stock'].'"  readonly></td>';
                                    echo'<td><input type="text" class="form-control price" name="price[]" value="'.$row_product['p_price'].'"  readonly></td>';
                                    echo'<td><input type="number" min="1" class="form-control qty" name="qty[]" value="'.$item_invoice_details['qty'].'"></td>';
                                    echo'<td><input type="text" class="form-control total" name="total[]" value="'.$row_product['p_price']*$item_invoice_details['qty'].'"  readonly></td>';
                                     echo'<td><center<button type="button" name="remove" class="btn btn-danger btn-sm btn_row_delete"><span class="fas fa-times"></span></button></center></td>' ;
                                    ?>
                                    </tr>

                                <?php
                                }
                                ?>
                                
                                
        
                               </table>
                              </div>
                            </div>
                          </div>

                          <div class="row">

                             <div class="col-md-6">
                                  <div class="form-group">
                                       <label for="sub_total">Sub Total</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="fas fa-rupee-sign"></i>
                                              </span>
                                           </div>
                                          <input type="text" class="form-control" name="sub_total" id="sub_total" value="<?php echo $sub_total?>" required readonly>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                       <label for="discount">Tax</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="fas fa-rupee-sign"></i>
                                              </span>
                                           </div>
                                          <input type="text" class="form-control" name="tax" id="tax" value="<?php echo $tax ?>"  required readonly>
                                        </div>
                                  </div>
                                 <div class="form-group">
                                       <label for="discount">Discount</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="fas fa-rupee-sign"></i>
                                              </span>
                                           </div>
                                          <input type="text" class="form-control" name="discount" id="discount"  required>
                                        </div>
                                  </div>
                               
                              </div>   
                           
                              <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="total">Total</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="fas fa-rupee-sign"></i>
                                              </span>
                                            </div>
                                            <input type="text" class="form-control" name="total" id="total" value="<?php echo $total ?> " required readonly>
                                          </div>
                                      </div>
                                        <div class="form-group">
                                            <label for="due">Paid</label>
                                              <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="fas fa-rupee-sign"></i>
                                                    </span>
                                                  </div>
                                                  <input type="text" class="form-control" name="paid"
                                                  id="paid" value="<?php echo $paid?>"  required>
                                                </div>
                                         </div>  
                                          <div class="form-group">
                                            <label for="due">Due</label>
                                              <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="fas fa-rupee-sign"></i>
                                                    </span>
                                                  </div>
                                                  <input type="text" class="form-control" name="due"
                                                  id="due" value="<?php echo $due ?>"  required readonly>
                                                </div>
                                           </div>
                                           <br>
                                           <label>Payment Method : </label>
                                           <div class="form-group clearfix">
                                                  <div class="icheck-primary d-inline">
                                                    <input type="radio" id="radioPrimary1" name="rb" 
                                                    value="Cash" <?php echo($pay_type=='Cash')?'checked':''?>>
                                                    <label for="radioPrimary1">
                                                      CASH
                                                    </label>
                                                  </div>
                                                  <div class="icheck-primary d-inline">
                                                    <input type="radio" id="radioPrimary2" name="rb" value="Card" <?php echo($pay_type=='Card')?'checked':''?>>
                                                    <label for="radioPrimary2">
                                                      CARD
                                                    </label>
                                                  </div>
                                                  <div class="icheck-primary d-inline">
                                                    <input type="radio" id="radioPrimary3" name="rb" value="Cheque" <?php echo($pay_type=='Cheque')?'checked':''?>>
                                                    <label for="radioPrimary3">
                                                      CHEQUE
                                                    </label>
                                                  </div>
                                            </div>
                                    </div>    
                            </div>
                        <div class="text-center">
                        <a href="updateorder.php?update_btn=<?php echo $id ?>">
			                                  <button type="submit" class="btn btn-info" value="<?php echo $id ?>" name="update_btn">Update</button>
			                   </a>
                        </div>
                        </div>
          </form>
                <!-- /.card-body -->     
        </div>
  </section>
  <!-- content-wrapper -->
</div>


<script>

$(document).ready(function(){


$(document).on('click','.btn_add',function(){



  var html='';
  html+='<tr>';

  html+='<td><input type="hidden" class="form-control p_name"  name="productname[]"></td>';
  html+='<td><select class="form-control p_id" name="productid[]" ><option value="">Select Option</option><?php echo fill_product($pdo,'');?></select></td>';
  html+='<td><input type="text" class="form-control stock" name="stock[]"  readonly></td>';
  html+='<td><input type="text" class="form-control price" name="price[]"  readonly></td>';
  html+='<td><input type="number" min="1" class="form-control qty" name="qty[]"></td>';
  html+='<td><input type="text" class="form-control total" name="total[]"  readonly></td>';
   html+='<td><center<button type="button" name="remove" class="btn btn-danger btn-sm btn_row_delete"><span class="fas fa-times"></span></button></center></td>';
    // html+='</tr>';
  $('#myTable').append(html);


   $('.p_id').select2()

    $('.p_id').select2({
      theme: 'bootstrap4'
    })
    $(".p_id").on('change',function(e){

      var p_id = this.value;
      var tr = $(this).parent().parent();

      $.ajax({

        url:"getproduct.php",
        method:"get",
        data:{id:p_id},
        success:function(data){

          tr.find(".stock").val(data['p_stock']);
          tr.find(".price").val(data["sale_price"]);
          tr.find(".p_name").val(data["p_name"]);
          tr.find(".qty").val(1);
          tr.find(".total").val(tr.find(".qty").val() * tr.find(".price").val());
          calculate(0,0);
          $("#paid").val("");


        }
      })
    })
    
})
$(document).on('click','.btn_row_delete',function(){

     $(this).closest('tr').remove();
      calculate(0,0);
     $("#paid").val("");

})

$("#myTable").delegate('.qty', 'keyup', function(event) {
  
  var quantity = $(this);
  var tr = $(this).parent().parent();

  if ( (quantity.val()-0)>(tr.find(".stock").val()-0) ){

    swal("WARNING!","SORRY! This much of quantity is not available","warning");
    quantity.val(1);

    tr.find(".total").val( quantity.val() * tr.find(".price").val());
     calculate(0,0);
}
    else{

      tr.find(".total").val( quantity.val() * tr.find(".price").val());
       calculate(0,0);
       $("#paid").val("");
    }
});

function calculate(dis,paid){

  var subtotal = 0 ;
  var tax = 0;
  var discount = dis;
  var net_total =0;
  var paid = paid;
  var due = 0;

  $(".total").each(function(){

    subtotal = subtotal + ($(this).val()*1);
  })

  tax= 0.05*subtotal;
  net_total = tax+subtotal;
  net_total = net_total-discount;
  due = net_total-paid;
  $("#tax").val(tax.toFixed(2));
  $("#sub_total").val(subtotal.toFixed(1));
  $("#total").val(net_total.toFixed(2));
  $("#discount").val(discount);
  $("#due").val(due.toFixed(2));


}

$("#discount").keyup(function(){

  var discount = $(this).val();
  calculate(discount,0);
})

$("#paid").keyup(function(){

  var paid = $(this).val();
  var discount = $("#discount").val();
  calculate(discount,paid);


})




});



</script>
<?php
include 'footer.php';
?>
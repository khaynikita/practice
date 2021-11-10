<?php

include 'connectdb.php';
session_start();
// $select=$pdo->prepare("select * from tbl_product order by p_name ");
// $select->execute();

// $result = $select->fetchAll();
// print_r($result);
///////////////////////////////////////////////////////////
function fill_product($pdo){

$output='';

$select=$pdo->prepare("select * from tbl_product order by p_name ");
$select->execute();

$result = $select->fetchAll();

foreach($result as $row){
  
  $output.='<option value="'.$row["p_id"].'">'.$row["p_name"].'</option>';
}

return $output;

}


if(isset($_POST['btn_saveorder'])){


//  print_r($_POST);

  $cust_name = $_POST['cust_name'];
  $cust_number = $_POST['cust_number'];
  
  $date = $_POST['date'] ;
  $sub_total = $_POST['sub_total'];
  $tax = $_POST['tax'];
  $discount = $_POST['discount'];
  $total = $_POST['total'];
  $paid = $_POST['paid'];
  $due = $_POST['due'];
  $pay_type = $_POST['rb'];
  // //////////////////////////////////////
  $arr_pid = $_POST['productid'];
  $arr_pname = $_POST['productname'];
  $arr_stock = $_POST['stock'];
  $arr_qty = $_POST['qty'];
  $arr_price = $_POST['price'];
  $arr_total = $_POST['total'];

 

  $insert = $pdo->prepare("insert into tbl_invoice(cust_name,cust_number,date,sub_total,tax,discount,total,paid,due,pay_type)values(:cust_name,:cust_number,:date,:sub_total,:tax,:discount,:total,:paid,:due,:pay_type)");

  $insert->bindParam('cust_name',$cust_name);
  $insert->bindParam('cust_number',$cust_number);
  
  $insert->bindParam('date',$date);
  $insert->bindParam('sub_total',$sub_total);
  $insert->bindParam('tax',$tax);
  $insert->bindParam('discount',$discount);
  $insert->bindParam('total',$total);
  $insert->bindParam('paid',$paid);
  $insert->bindParam('due',$due);
  $insert->bindParam('pay_type',$pay_type);

  $insert->execute();


  // 2nd insert query for tbl_invoice_details

  $invoice_id = $pdo->lastInsertId();
  if($invoice_id!=null){

    for( $i=0 ; $i<count($arr_pid); $i++ ){


      $rem_qty = $arr_stock[$i] - $arr_qty[$i];

      if($rem_qty<0){

        return "Order Is not Complete";
      }else{

        $update = $pdo->prepare("update tbl_product SET p_stock = '$rem_qty' where p_id = '".$arr_pid[$i]."'");

        $update->execute();
      }










      $insert = $pdo->prepare("insert into tbl_invoice_details(in_id,p_id,p_name,qty,price,date)values(:in_id,:p_id,:p_name,:qty,:price,:date)");

      $insert->bindParam(':in_id',$invoice_id);
      $insert->bindParam(':p_id',$arr_pid[$i]);
      $insert->bindParam(':p_name',$arr_pname[$i]);
      $insert->bindParam(':qty',$arr_qty[$i]);
      $insert->bindParam(':price',$arr_price[$i]);
      $insert->bindParam(':date',$date);

      $insert->execute();

      
    }

    // echo "successfully created order";
    header('location:orderlist.php');
  }


}
////////////////////////////////////////////////////////
  

if($_SESSION['useremail']==""){

  header('location:index.php');
}
include 'header.php'; 
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Create Order</h1>
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
              <h3 class="card-title">Create Order</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
          <form role="form" action="createorder.php"  method="Post" enctype="multipart/form-data" >
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
                                          <input type="text" class="form-control" name="cust_name"  required>
                                        </div>
                                  </div>
                               
                              </div> 



                           
                              <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="cust_number">Contact No.</label>
                                      <input type="Contact" class="form-control" name="cust_number" placeholder="Contact Number" required>
                                     <input type="hidden" name="date" value="<?php echo date('Y-m-d h:i:s'); ?>" data-date-format="H:i:s M d, Y">
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
                                      <button type="button" name="add" class="btn btn-success btn-sm btn_add"><span class="fas fa-plus"></span></button>
                                    </th>
                                    
                                  </tr>
                                </thead>

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
                                          <input type="text" class="form-control" name="sub_total" id="sub_total" required readonly>
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
                                          <input type="text" class="form-control" name="tax" id="tax"  required readonly>
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
                                            <input type="text" class="form-control" name="total" id="total"required readonly>
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
                                                  id="paid"  required>
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
                                                  id="due"  required readonly>
                                                </div>
                                           </div>
                                           <br>
                                           <label>Payment Method : </label>
                                           <div class="form-group clearfix">
                                                  <div class="icheck-primary d-inline">
                                                    <input type="radio" id="radioPrimary1" name="rb" 
                                                    value="Cash" checked>
                                                    <label for="radioPrimary1">
                                                      CASH
                                                    </label>
                                                  </div>
                                                  <div class="icheck-primary d-inline">
                                                    <input type="radio" id="radioPrimary2" name="rb" value="Card">
                                                    <label for="radioPrimary2">
                                                      CARD
                                                    </label>
                                                  </div>
                                                  <div class="icheck-primary d-inline">
                                                    <input type="radio" id="radioPrimary3" name="rb" value="Cheque">
                                                    <label for="radioPrimary3">
                                                      CHEQUE
                                                    </label>
                                                  </div>
                                            </div>
                                    </div>    
                            </div>
                        <div class="text-center">
                          <input type="submit" name="btn_saveorder" value="Order" class="btn-lg btn-info">
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

  html+='<td><input type="hidden" class="form-control p_name"  name="productname[]" ></td>';
  html+='<td><select class="form-control p_id" name="productid[]" ><option value="">Select Option</option><?php echo fill_product($pdo,"");?></select></td>';
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

          // console.log(data);

          tr.find(".stock").val(data['p_stock']);
          tr.find(".price").val(data["sale_price"]);
          tr.find('.p_name').val(data["p_name"]);
          
          tr.find(".qty").val(1);
          tr.find(".total").val(tr.find(".qty").val() * tr.find(".price").val());
          calculate(0,0);


        }
      })
    })
    
})
$(document).on('click','.btn_row_delete',function(){

     $(this).closest('tr').remove();
      calculate(0,0);
      $("#paid").val(0);

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
<?php
include 'connectdb.php';
session_start();
// print_r($_POST);
if(isset($_POST['update_btn'])){
    $txt_custname = $_POST['cust_name'];
    $txt_custnum = $_POST['cust_number'];
    $txt_date = $_POST['date'];
    $txt_subtotal = $_POST['sub_total'];
    $txt_tax = $_POST['tax'];
    $txt_discount = $_POST['discount'];
    $txt_total = $_POST['total'];
    $txt_paid = $_POST['paid'];
    $txt_due = $_POST['due'];
    $txt_pay = $_POST['rb'];
    // //////////////////////////////

    $arr_pid = $_POST['productid'];
    // print_r($arr_pid);
    $arr_pname = $_POST['productname'];
    $arr_stock = $_POST['stock'];
    $arr_qty = $_POST['qty'];
    $arr_price = $_POST['price'];
    $arr_total = $_POST['total'];
    $id = $_POST['update_btn'];
    $select=$pdo->prepare("select * from tbl_invoice_details where in_id = $id");
    $select->execute();
    $row_invoice_details=$select->fetchAll(PDO::FETCH_ASSOC);
    // print_r($row_invoice_details);
    $in_id = $row_invoice_details[0]['in_id'];

    ///////////////////////////////////////

    foreach($row_invoice_details as $item_invoice_details){

        
        $updateproduct = $pdo->prepare("update tbl_product set p_stock = p_stock+".$item_invoice_details['qty']."where p_id='".$item_invoice_details['p_id']."'");
        // print_r($updateproduct);
        $updateproduct->execute();

    }
    // /////////////////////////////////////////////////////
    $delete_invoice_details = $pdo->prepare("delete from tbl_invoice_details where in_id=$in_id");

    $delete_invoice_details->execute();
    // ////////////////////////////////////////////////////////

    $update_invoice = $pdo->prepare("update tbl_invoice set cust_name=:cust,cust_number=:cust_num,date=:date,sub_total=:stotal,tax=:tax,discount=:discount,total=:total,paid=:paid,due=:due,pay_type=:ptype where in_id=$in_id");

    $update_invoice->bindParam(':cust',$txt_custname);
    $update_invoice->bindParam(':cust_num',$txt_custnum);
    $update_invoice->bindParam(':date',$txt_date);
    $update_invoice->bindParam(':stotal', $txt_subtotal);
    $update_invoice->bindParam(':total',$txt_total);
    $update_invoice->bindParam(':tax',$txt_tax);
    $update_invoice->bindParam(':discount', $txt_discount);
    $update_invoice->bindParam(':paid',$txt_paid);
    $update_invoice->bindParam(':due',$txt_due);
    $update_invoice->bindParam(':ptype',$txt_pay);
//   print_r($update_invoice);
    $update_invoice->execute();
    // print_r($update_invoice);

    // //////////////////////////////////////////////////////////

    $invoice_id=$pdo->lastInsertId();
    // print_r ($invoice_id);
    if($invoice_id!=null){

        for($i=0;$i<count($arr_pid);$i++){

            $selectpdt= $pdo->prepare("select * from tbl_product where p_id='".$arr_pid[$i]."'");
            // print_r($selectpdt);
            $selectpdt->execute();
            $rowpdt=$selectpdt->fetch(PDO::FETCH_OBJ);
            // print_r($rowpdt);
            
            while($rowpdt=$selectpdt->fetchAll(PDO::FETCH_OBJ)){

                $db_stock[$i]=$rowpdt->p_stock;

                $rem_qty= $db_stock[$i]-$arr_qty[$i];

                if($rem_qty<0){

                    return"Order is not Complete";
                }
                else{
                    $update= $pdo->prepare("update tbl_product SET p_stock= '$rem_qty' where p_id='".$arr_pid[$i]."'");
                    $update->execute();
                }
            
            }
            $insert = $pdo->prepare("insert into tbl_invoice_details(in_id,p_id,p_name,qty,price,date)values(:in_id,:p_id,:p_name,:qty,:price,:date)");

            $insert->bindParam(':in_id',$in_id);
            $insert->bindParam(':p_id',$arr_pid[$i]);
            $insert->bindParam(':p_name',$arr_pname[$i]);
            // print_r($hero);
            
            $insert->bindParam(':qty',$arr_qty[$i]);
            // print_r($pero);
            $insert->bindParam(':price',$arr_price[$i]);
            $insert->bindParam(':date',$txt_date);
            // print_r($insert);
           $hero =  $insert->execute();
        //    print_r($hero);
    

        }

        header('location:orderlist.php');
    }
    else{

        echo "Fail";
    }
    

}

?>
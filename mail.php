<?php

include 'connectdb.php';
$id = $_GET['mail_btn'];
 $select= $pdo->prepare("Select* from tbl_invoice where in_id = $id");
 $select->execute();
 $row=$select->fetch(PDO::FETCH_OBJ);
 print_r($row);
//  require_once('invoice_db.php?view_btn='+$id);
//  $file_name = $id.'.pdf';
//  $html_code = '<link rel="stylesheet" href="bootstrap.min.css">';
//  $pdf = new Pdf();
//  $pdf->load_html($html_code);
//  $pdf->render();
//  $file = $pdf->output();
//  file_put_contents($file_name,$file);

 	// unlink($file_name);
?>
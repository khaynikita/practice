<?php

// call the pdf library
require('fpdf/fpdf.php');

// A4 width : 219mm
// default margin : 10mm each side
// writable horiZontal : 219 - (10*2) = 190times

// create pdf is_object
$pdf = new FPDF('P','mm','A4');

// String orientation(P or L)- portrait or landscape
// String unit (pt,mm,cm,and in) - measure unit
// Mixed format (A3,A4,A5,Letter and Legal) - format of pages






// add a new page

$pdf->AddPage();

// First set a font for a doc.
// $pdf->SetFont("Font","B I U","Size");
// B->Bold , I->Italic , U->Underline;
$pdf->SetFont('Arial','BIU',14);
// Then create a cell
// $pdf->Cell(width,height,"text",border,PostionAfterCell,Align,BackgroundFill,"link");
// border:0 (No) / 1 (Yes);
// PositionAfterCell: 0 (To Right), 1 (Start of next line), 2 (Below);
// Align: L (Left) , C (Center) , R (Right) ;
// BackgroundFill: true / false(default);
// to fill color in cell if true
// $pdf->SetFillcolor(200,145,133);
// $pdf->Cell(60,10,'hello world 1',1,1,'C',true,"google.com");
// $pdf->Cell(60,10,'hello world 2',1,2,'C',true,"google.com");
// $pdf->Cell(60,10,'hello world 3',1,0,'C',true,"google.com");

$pdf->SetFont('Arial','B',16);
$pdf->Cell(80,10,'Kushi Vastra Bhandaar',0,0,'');

$pdf->SetFont('Arial','B',13);
$pdf->Cell(112,10,'INVOICE',0,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,'Address : Arya samaj road , Uttam nagar New delhi - 110056',0,0,'');

$pdf->Setfont('Arial','',10);
$pdf->Cell(112,5,'Invoice : #12211',0,1,'C');

$pdf->SetFont('Arial','',8);
$pdf->Cell(80,5,'Phone Number : +91 7665464434',0,0,'');

$pdf->Setfont('Arial','',10);
$pdf->Cell(112,5,'Date : 29-01-2021',0,1,'C');

$pdf->Setfont('Arial','',8);
$pdf->Cell(80,5,'E-mail Address : WorkforKushi@mail.com',0,1,'');
$pdf->Cell(80,5,'Website : www.cyberg.com',0,1,'');

// Line(x1,y1,x2,y2);

$pdf->Line(5,45,205,45);
$pdf->Line(5,46,205,46);

// line break
$pdf->Ln(10);

$pdf->Setfont('Arial','BI',12);
$pdf->Cell(20,10,'Bill To :',0,0,'');

$pdf->Setfont('Courier','BI',14);
$pdf->Cell(50,10,'Mayank Prasher',0,1,'');

$pdf->Cell(50,5,'',0,1,'');

// 190 divides cells
$pdf->Setfont('Arial','BI',12);
$pdf->SetFillcolor(208,208,208);
$pdf->Cell(100,8,'PRODUCT',1,0,'C',true);
$pdf->Cell(20,8,'QTY',1,0,'C',true);
$pdf->Cell(30,8,'PRICE',1,0,'C',true);
$pdf->Cell(40,8,'TOTAL',1,1,'C',true);

$pdf->Setfont('Arial','B',12);
$pdf->Cell(100,8,'Levis jeans',1,0,'L');
$pdf->Cell(20,8,'1',1,0,'C');
$pdf->Cell(30,8,'900',1,0,'C');
$pdf->Cell(40,8,'900',1,1,'C');

$pdf->Setfont('Arial','B',12);
$pdf->Cell(100,8,'Denim Jacket',1,0,'L');
$pdf->Cell(20,8,'1',1,0,'C');
$pdf->Cell(30,8,'500',1,0,'C');
$pdf->Cell(40,8,'500',1,1,'C');

$pdf->Setfont('Arial','B',12);
$pdf->Cell(100,8,'shirt',1,0,'L');
$pdf->Cell(20,8,'1',1,0,'C');
$pdf->Cell(30,8,'400',1,0,'C');
$pdf->Cell(40,8,'400',1,1,'C');


$pdf->Setfont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Subtotal',1,0,'C',true);
$pdf->Cell(40,8,'1800',1,1,'C');

$pdf->Setfont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Tax',1,0,'C',true);
$pdf->Cell(40,8,'60',1,1,'C');

$pdf->Setfont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Discount',1,0,'C',true);
$pdf->Cell(40,8,'30',1,1,'C');

$pdf->Setfont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Grand Total',1,0,'C',true);
$pdf->Cell(40,8,'$'.'1200',1,1,'C');

$pdf->Setfont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Paid',1,0,'C',true);
$pdf->Cell(40,8,'700',1,1,'C');

$pdf->Setfont('Arial','B',12);
$pdf->Cell(100,8,'',0,0,'L');
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Due',1,0,'C',true);
$pdf->Cell(40,8,'500',1,1,'C');

$pdf->Setfont('Arial','B',10);
$pdf->Cell(100,8,'',0,0,'L');
$pdf->Cell(20,8,'',0,0,'C');
$pdf->Cell(30,8,'Payment Method',1,0,'C',true);
$pdf->Cell(40,8,'Cash',1,1,'C');

$pdf->Cell(50,10,'',0,1,'');

$pdf->Setfont('Arial','B',10);
$pdf->Cell(32,10,"Important Notice :",0,0,'',true);

$pdf->Setfont('Arial','',8);
$pdf->Cell(148,10,'No item will be replaced or refunded if you dont have the invoice with you. You can refund within 2 days of purchase.',0,0,'');









// output the result
$pdf->Output();


?>
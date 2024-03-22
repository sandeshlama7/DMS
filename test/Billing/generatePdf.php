<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include('../connect.php');
    require('fpdf.php');

    $quer = mysqli_query($con, "SELECT * FROM Invoices ORDER BY invoiceID DESC LIMIT 1");
    $inv = mysqli_fetch_assoc($quer);
    $id = $inv['invoiceID'];

    // $sql = "SELECT * From Invoices inner join Members on Invoices.Customer=Members.Name WHERE invoiceID = '$id'";
    // $result=mysqli_query($con,$sql);

    // if(mysqli_num_rows($result)>0){
    //     $invoice = mysqli_fetch_assoc($result);
    // }else{
    $result = mysqli_query($con, "SELECT * FROM Invoices WHERE invoiceID = '$id'");
    $invoice = mysqli_fetch_assoc($result);
    // }

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130	,5,'Dhulikhel Dairy Farm',0,0);
$pdf->Cell(59	,5,'INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130	,5,'[Dhulikhel Buspark]',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'[Dhulikhel-03, Kavre]',0,0);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(34	,5,$invoice['Date'],0,1);//end of line

$pdf->Cell(130	,5,'Phone [+977-9823281271]',0,0);
$pdf->Cell(25	,5,'Invoice #',0,0);
$pdf->Cell(34	,5,$invoice['invoiceID'],0,1);//end of line

$pdf->Cell(130	,5,'',0,0);
// $pdf->Cell(25	,5,'Customer ID',0,0);
// $pdf->Cell(34	,5,$invoice['clientID'],0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$invoice['Customer'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$invoice['Address'],0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$invoice['Contact'],0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(105	,5,'Items',1,0);
$pdf->Cell(25	,5,'Quantity',1,0);
$pdf->Cell(30	,5,'Unit Price',1,0);
$pdf->Cell(30, 5, 'Amount',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

//items
$query = mysqli_query($con,"select * from InvoiceItem where invoiceID = '".$invoice['invoiceID']."'");


//display the items
while($item = mysqli_fetch_array($query)){
	$pdf->Cell(105	,5,$item['Item'],1,0);
	//add thousand separator using number_format function
	$pdf->Cell(25	,5,number_format($item['Quantity']),1,0,'C');
	$pdf->Cell(30	,5,number_format($item['Price']),1,0,'C');
    $pdf->Cell(30, 5,number_format($item['SubTotal']),1,1,'R'); //end of line
	//accumulate tax and amount
// 	$tax += $item['tax'];
// 	$amount += $item['amount'];
}

//summary
$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(30	,5,'Subtotal',0,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(22	,5,number_format($invoice['SubTotal']),1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(30	,5,'Discount',0,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(22	,5,number_format($invoice['Discount']),1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(30	,5,'Total',0,0);
$pdf->Cell(8	,5,'Rs.',1,0);
$pdf->Cell(22	,5,number_format($invoice["Total"]),1,1,'R');//end of line


$pdf->Output();
// header('Location: billing.php');
exit;
?>

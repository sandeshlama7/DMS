<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../connect.php');

if (isset($_POST['createInvoice'])) {

    $sql = "SELECT invoiceID from Invoices ORDER BY invoiceID desc LIMIT 1";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $invoiceIdItem = $row['invoiceID'] + 1;

    $stmt = $con->prepare("INSERT INTO InvoiceItem(invoiceID, Item, Quantity, Price, SubTotal) VALUES (?, ?, ?, ?,?)");

    $rowCount = count($_POST['item']);
    for($i=0;$i < $rowCount; $i++){
        $item = $_POST['item'][$i];
        $quantity = (float)$_POST['quantity'][$i];
        $price = $_POST['Price'][$i];
        $sub_total = (float)$_POST['sub-total'][$i];

        $stmt->bind_param('isdid',$invoiceIdItem,$item,$quantity,$price,$sub_total);
        if(!$stmt->execute()){
            die('Failed to execute Statement:' .$stmt->error);
        }
    }
    $customer = $_POST['customer_name'];
    $date = $_POST['date'];
    $invoice_subtotal = $_POST['invoice_subtotal'];
    $invoice_discount = $_POST['invoice_discount'];
    $invoice_total = $_POST['invoice_total'];
    $status = $_POST['status'];

    if($status === "pending"){
    $recsql = "UPDATE Members SET Receivables = Receivables + '$invoice_total' WHERE Name = '$customer'";
    mysqli_query($con, $recsql);
    $pendingAmt = $invoice_total;
    }else{
        $pendingAmt = 0;
    }

    $sql1 = "INSERT INTO `Invoices` ( `Date`, `Customer`, `SubTotal`, `Discount`, `Total`, `Status`, `PendingAmount`) VALUES ('$date', '$customer', '$invoice_subtotal', '$invoice_discount', '$invoice_total', '$status', '$pendingAmt')";
    $res = mysqli_query($con, $sql1);

    if($res){
        header('location:billing.php');
    }
   else{
    echo "Error";
   }
   $stmt->close();
   mysqli_close($con);
}
?>

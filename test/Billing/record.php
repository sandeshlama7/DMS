<?php

    include('../connect.php');

    $paid = $_POST['paid'];
    $id = $_POST['id'];
    $name = $_POST['name'];

    $sql = "UPDATE Members SET Receivables = Receivables - '$paid' WHERE Name='$name'";
    $result=mysqli_query($con,$sql);

    $sql3 = "UPDATE Invoices SET PendingAmount = PendingAmount - '$paid' where invoiceID = '$id'";
    mysqli_query($con, $sql3);

    $sql1 = "SELECT PendingAmount FROM Invoices WHERE invoiceID='$id'";
    $result1 = mysqli_query($con,$sql1);
    $row1 = mysqli_fetch_assoc($result1);

    if($row1['PendingAmount'] == 0){
        mysqli_query($con, "UPDATE Invoices SET Status = 'paid' WHERE invoiceID = '$id' ");
    }

    if($result){
        echo "SUCCESS";
    }

?>

<?php

    include('../connect.php');

    $paid = $_POST['paid'];
    $id = $_POST['id'];
    $name = $_POST['name'];

    $sql = "UPDATE Members SET Receivables = Receivables - '$paid' WHERE Name='$name'";
    $result=mysqli_query($con,$sql);

    $sql1 = "SELECT Total FROM Invoices WHERE invoiceID='$id'";
    $result1 = mysqli_query($con,$sql1);
    $row1 = mysqli_fetch_assoc($result1);

    if($paid == $row1['Total']){
        mysqli_query($con, "UPDATE Invoices SET Status = 'paid' WHERE invoiceID = '$id' ");
    }

    if($result){
        echo "SUCCESS";
    }

?>

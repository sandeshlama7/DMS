<?php
    include('../connect.php');

    $id = $_POST['id'];
    $sql = "SELECT * FROM Invoices WHERE invoiceID = '$id'";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($res);

    if($res){
        echo $row['PendingAmount'];
    }
?>

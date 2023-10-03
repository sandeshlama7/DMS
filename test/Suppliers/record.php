<?php

    include('../connect.php');

    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    if(isset($_POST['record'])){
        $supplier = $_POST['supplier'];
        $fat = (float) $_POST['fat'];
        $fatcost = (float) $_POST['fatcost'];
        $quantity =(float) $_POST['quantity'];
        $cost =(float) $_POST['cost'];
        $item = 'Milk(Raw)';
        $date = $_POST['date'];
        $supplierID = $_POST['supplierID'];

        $suppSql = "UPDATE Suppliers set Payables= Payables + $cost where Name='$supplier'";
        $res = mysqli_query($con, $suppSql);

        $sql1 = "INSERT into SupplyHistory(date,supplierName,supplierID,fat,quantity) VALUES('$date','$supplier','$supplierID','$fat','$quantity')";
        $res1 = mysqli_query($con, $sql1);

        $invSql = "UPDATE Inventories set Quantity= Quantity + $quantity where Item ='$item'";
        $result = mysqli_query($con,$invSql);
        if($res && $result &&$res1){
            header('location: supply.php');
        }
        else{
            echo("NOT");
            echo'<script> alert("Error");</script>';

        }
    }
 ?>

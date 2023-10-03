<?php
    include('../connect.php');

    if(isset($_POST['edit']))
    {
        $id = $_POST['id'];
        $name =$_POST['name'];
        $address =  $_POST['address'];
        $contact = $_POST['contact'];
        $payables =  $_POST['payables'];
        $type = $_POST['type'];


    $sql = "UPDATE Suppliers SET Name='$name', SupplierType ='$type', Address='$address', Contact='$contact', Payables='$payables' where supplierID='$id' ";
    $res = mysqli_query($con, $sql);
    if($res){
        header("location:suppliers.php");
    }
    else{
        echo '<script> alert("Data not updated");</script>';
    }

    }
?>

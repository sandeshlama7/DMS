<?php
    include('../connect.php');

    if(isset($_POST['edit']))
    {
        $id = $_POST['id'];
        $item =$_POST['item'];
        $quantity =  $_POST['quantity'];
        // $metric = $_POST['metric'];

    $sql = "UPDATE Inventories SET Item='$item', Quantity='$quantity' where  itemID='$id' ";
    $res = mysqli_query($con, $sql);

    if($res){
        header("location:inventory.php");
    }
    else{
        echo '<script> alert("Data not updated");</script>';
    }

    }
?>

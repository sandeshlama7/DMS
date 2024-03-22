<?php

    include('../connect.php');

    $quantity = $_POST['quantity'];
    $item = $_POST['item'];


    $res = mysqli_query($con, "SELECT * FROM Inventories WHERE Item ='$item'");
    $row = mysqli_fetch_assoc($res);
    $available = $row['Quantity'];

    if($quantity>$available){
        echo  "Quantity exceeds inventory level";
    }
    else{
        echo  "No problem";
    }

?>

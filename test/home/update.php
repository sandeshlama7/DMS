<?php

include '../connect.php';

$id = $_POST['id'];
$item = $_POST['item'];
$metric = $_POST['metric'];
$price = $_POST['price'];

$sql = "UPDATE PriceList SET item='$item', metric='$metric', price='$price' WHERE item='$id'";

if(mysqli_query($con, $sql)){
  echo 'Item updated successfully';
} else {
  echo 'Error: ' . mysqli_error($con);
}

?>

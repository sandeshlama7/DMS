<?php

include '../connect.php';

$item = $_POST['item'];

$sql = "DELETE FROM PriceList WHERE item='$item'";

if(mysqli_query($con, $sql)){
  echo 'Item deleted successfully';
} else {
  echo 'Error: ' . mysqli_error($con);
}

?>

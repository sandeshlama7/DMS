<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include '../connect.php';

$item = $_POST['item'];
$metric = $_POST['metric'];
$price = $_POST['price'];

$checkQuery = "SELECT * FROM PriceList WHERE item = '$item'";
$result = mysqli_query($con, $checkQuery);

if(mysqli_num_rows($result)>0){
  echo 'Item with the same name already exists.';
}
else{
$sql = "INSERT INTO PriceList(item, metric, price) VALUES ('$item', '$metric', '$price')";

if(mysqli_query($con, $sql)){
  echo 'Item added successfully';
} else {
  echo 'Error: ' . mysqli_error($con);
}
}

?>

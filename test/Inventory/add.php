<?php
    include('../connect.php');

if(isset($_POST['insert'])){
$item = $_POST['item'];
$quantity = $_POST['quantity'];
$metric = $_POST['metric'];

$sql = "INSERT into Inventories (Item,Quantity,Metric) VALUES('$item','$quantity','$metric')";
$res = mysqli_query($con, $sql);

if($res){
    header('Location: inventory.php');
}
else{
    echo'<script> alert("not");</script>';
}

    }
?>

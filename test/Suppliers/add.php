<?php
    include('../connect.php');

if(isset($_POST['insert'])){

    $name = $_POST['name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$payables = (int) $_POST['payables'];
$type = $_POST['type'];


$sql = "INSERT into Suppliers(Name,Address,SupplierType,Contact,Payables) VALUES('$name','$address','$type','$contact','$payables')";
$res = mysqli_query($con, $sql);


if($res){
    header('Location: suppliers.php');
}
else{
    echo'Unsuccessful';
}

    }
?>

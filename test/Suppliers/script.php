<?php
include('../connect.php');
// Retrieve the selected supplier from the AJAX request
$selectedSupplier = $_POST['value'];

$sql = "SELECT * from Suppliers where name='$selectedSupplier'";
$res = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($res);
$type = $row['SupplierType'];
$supplierId = $row['supplierID'];

if($type === 'Middle Man'){
    $cost = 20.00;
}elseif($type === 'Farmer'){
    $cost = 16.50;
}

$responseData = array(
    'message' => 'Success',
    'value' => $cost,
    'supplierId' => $supplierId
);

// Set the appropriate headers
header('Content-Type: application/json');

// Convert the data to JSON format
$jsonResponse = json_encode($responseData);

// Return the JSON response
echo $jsonResponse;
?>

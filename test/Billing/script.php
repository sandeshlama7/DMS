<?php

include('../connect.php');
// Retrieve the value sent in the AJAX request
$value = $_POST['value'];

$sql = "SELECT * FROM PriceList WHERE item='$value'";
$res = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($res);
$val =  $row['price'];

// Process the value as needed
// ...


// Create an associative array or object with the data to return
$responseData = array(
    'message' => 'Success',
    'value' => $val
);

// Set the appropriate headers
header('Content-Type: application/json');

// Convert the data to JSON format
$jsonResponse = json_encode($responseData);

// Return the JSON response
echo $jsonResponse;
?>

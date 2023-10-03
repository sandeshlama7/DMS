<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../connect.php');

if(isset($_POST['createSale'])){
    $stmt = $con->prepare("INSERT INTO Sales(Date, Items, Quantity, Price, SubTotal) VALUES (?,?, ?, ?, ?)");

    $rowCount = count($_POST['item']);
    for($i=0;$i < $rowCount; $i++){
        $item = $_POST['item'][$i];
        $quantity = (float)$_POST['quantity'][$i];
        $price = $_POST['Price'][$i];
        $sub_total = (float)$_POST['sub-total'][$i];
        $date = $_POST['date'];

        $stmt->bind_param('ssdid',$date,$item,$quantity,$price,$sub_total);
        if(!$stmt->execute()){
            die('Failed to execute Statement:' .$stmt->error);
        }
        $updateStmt = $con->prepare("UPDATE Inventories SET Quantity = Quantity - ? WHERE Item = ?");
        $updateStmt->bind_param('ds', $quantity, $item);
        if(!$updateStmt->execute()){
            die('Failed to update inventory: ' . $updateStmt->error);
        }
    }
    if($stmt && $updateStmt){
    header('location: recordSales.php');
    }
    $stmt->close();
    $updateStmt->close();
    mysqli_close($con);
}
?>

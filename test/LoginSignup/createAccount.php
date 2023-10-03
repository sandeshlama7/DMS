<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../connect.php');
if (isset($_SESSION['name']) && isset($_SESSION['address']) && isset($_SESSION['contact']) && isset($_SESSION['email']) && isset($_SESSION['password'])) {

$name = $_SESSION['name'];
$address = $_SESSION['address'];
$contact = $_SESSION['contact'];
$email = $_SESSION['email'];
$pass = $_SESSION['password'];

$check = "SELECT * FROM USER";
$checkRes = mysqli_query($con,$check);
if($checkRes){
    $count = mysqli_num_rows($checkRes);
    if($count>=1){
        $_SESSION['info'] = "Cannot Create Account. Admin account already exists!!";
        header('Location: index.php');
    }
    else{$sql = "INSERT INTO `User` (`userId`, `name`, `address`, `contact`, `email`, `password`) VALUES (NULL,'$name','$address','$contact','$email','$pass') ";
        $res = mysqli_query($con, $sql);

        if ($res) {
            $_SESSION['info'] = 'Account Successfully Created';
            header('Location: index.php');
            exit(); // Add exit() here
        } else {
            echo '<script> alert("Error");</script>';
        }}
}


}
?>

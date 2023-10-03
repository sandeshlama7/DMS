<?php
    $con = new mysqli('localhost','root','','DMS');
    if($con->connect_error){
        die("connection failed".$con->connect_error);
    }
?>

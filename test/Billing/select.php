<?php

    include('../connect.php');

    $id = $_POST['id'];

    $sql = "SELECT * FROM Members where memberId = '$id'";
    $res = mysqli_query($con,$sql);

    $row = mysqli_fetch_assoc($res);

    $response = array('name'=>$row['Name'], 'address'=>$row['Address'], 'contact'=>$row['Contact'] );

    echo json_encode($response);

?>

<?php
    include('../connect.php');

    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $name =$_POST['name'];
        $address =  $_POST['address'];
        $contact = $_POST['contact'];
        $receivables =  $_POST['receivables'];

    $sql = "UPDATE Members SET Name='$name', Address='$address', Contact='$contact', Receivables='$receivables' where  MemberID='$id' ";
    $res = mysqli_query($con, $sql);

    if($res){
        header("location:members.php");
    }
    else{
        echo '<script> alert("Data not updated");</script>';
    }

    }
?>

<?php
    include('../connect.php');

    if(isset($_POST['delete'])){
        $id = $_POST['deleteid'];

        $sql = "DELETE From Inventories WHERE itemID='$id' ";
        $res = mysqli_query($con, $sql);

        if($res){
            header('location:inventory.php');
        }
        else{
            echo 'Error';
        }
    }


?>

<?php
    include('../connect.php');

    if(isset($_POST['delete'])){
        $id = $_POST['deleteid'];

        $sql = "DELETE From Suppliers WHERE supplierID='$id' ";
        $res = mysqli_query($con, $sql);

        if($res){
            header('location:suppliers.php');
        }
        else{
            echo 'Error';
        }
    }


?>

<?php
    include('../connect.php');

    if(isset($_POST['delete'])){
        $id = $_POST['deleteid'];

        $sql = "DELETE From Invoices WHERE invoiceID='$id' ";
        $res = mysqli_query($con, $sql);

        if($res){
            header('location:invoiceList.php');
        }
        else{
            echo 'Error';
        }
    }

mysqli_close($con);
?>

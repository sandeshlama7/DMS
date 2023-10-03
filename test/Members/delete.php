<?php
    include('../connect.php');

    if(isset($_POST['delete'])){
        $id = $_POST['deleteid'];

        $sql = "DELETE From Members WHERE MemberID='$id' ";
        $res = mysqli_query($con, $sql);

        if($res){
            header('location:members.php');
        }
        else{
            echo 'Error';
        }
    }


?>

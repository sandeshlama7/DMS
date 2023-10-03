<?php
    include('../connect.php');

if(isset($_POST['insert'])){
$name = $_POST['name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$receivables = (int) $_POST['receivables'];

$sql = "INSERT into Members (`Name`,`Address`,`Contact`,`Receivables`) VALUES('$name','$address','$contact','$receivables')";
$res = mysqli_query($con, $sql);

if($res){
    header('Location: members.php');
}
else{
    echo'<script> alert("not");</script>';
}

    }
?>

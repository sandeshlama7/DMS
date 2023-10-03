<?php

    include('../connect.php');
    $id = $_POST['supplierID'];

    $sql = "SELECT * FROM SupplyHistory WHERE supplierID = '$id' ORDER By date";
    $result = mysqli_query($con,$sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $date = $row['date'];
            $fat = $row['fat'];
            $quantity = $row['quantity'];

            echo '<tr>
                <td>' . $date . '</td>
                <td>' . $fat . '</td>
                <td>' . $quantity . '</td>
            </tr>';
        }
    }
?>

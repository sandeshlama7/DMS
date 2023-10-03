<?php
    include('../connect.php');

    $id = $_POST['id'];

    $sql = "SELECT * FROM InvoiceItem WHERE invoiceID ='$id'";
    $res = mysqli_query($con,$sql);

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $item = $row['Item'];
            $quantity = $row['Quantity'];
            $price = $row['Price'];
            $subtotal = $row['SubTotal'];

            echo '<tr>
                <td>' . $item . '</td>
                <td>' . $quantity . '</td>
                <td>' . $price . '</td>
                <td>' . $subtotal .  '</td>
            </tr>';
        }
    }

?>

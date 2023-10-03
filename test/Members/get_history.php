<?php

    include('../connect.php');
    $member = $_POST['member'];

    $sql = "SELECT * FROM Invoices WHERE Customer = '$member' ORDER By date";
    $result = mysqli_query($con,$sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $invoiceID = $row['invoiceID'];
            $date = $row['Date'];
            $total = $row['Total'];
            $status = $row['Status'];
            $pending = $row['PendingAmount'];

            echo '<tr>

                <td>' . $invoiceID . '</td>
                <td>' . $date . '</td>
                <td>' . $total . '</td>
                <td>' . $status . '</td>
                <td>' . $pending . '</td>
            </tr>';
        }
    }
?>

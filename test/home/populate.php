<?php
include('../connect.php');

$sql1 = "SELECT * FROM PriceList";
$result = mysqli_query($con, $sql1);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $item = $row['item'];
        $metric = $row['metric'];
        $price = $row['price'];

        echo '<tr>
            <td>' . $item . '</td>
            <td>' . $metric . '</td>
            <td>' . $price . '</td>
            <td>
                <button class="editBtn">Edit</button>
                <button class="deleteBtn">Delete</button>
            </td>
        </tr>';
    }
}
?>

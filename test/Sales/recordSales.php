<?php

include('../home.php');
include('../connect.php');

?>

<div class="Container m-2 p-2">

    <h2 class="m-2 text-center">Record Sales</h2>
    <form action="createSale.php" method="POST" id="create_invoice" >

        <div class="col-xs-8 text-right">


            <strong>Date:</strong>
            <input type="date" name="date" id="datePicker" />
        </div>


<div class="mt-3" >
        <table class="table table-bordered table-hover table-striped" id="invoice_table">
            <thead>
                <tr>
                    <th><button type="button" id="addnewRow" class="btn btn-sm btn-secondary ">+</button> Item</th>
                    <th> Quantity</th>
                    <th>Price(Rs.)</th>
                    <th>Sub-Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * from PriceList";
                $result = mysqli_query($con, $sql);
                ?>
                <tr>
                    <td><select name="item[]" id="itemSelect"  required>
                            <option disabled selected value> -- Select an Item -- </option>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                // populate the options
                                echo '<option value="' . $row['item'] . '">' . $row['item'] . '</option>';
                            }
                            ?>
                        </select></td>
                    <td>
                        <input type="number" id="quantity" class="quantity form-control" name="quantity[]" value="1"
                            oninput="calculateTotal()" onchange="calculateTotal()">
                    </td>
                    <td>
                        <input type="number" id="priceSelect" class="priceSelect form-control required" name="Price[]" value="0.00"
                            oninput="calculateTotal()" onchange="calculateTotal()">
                    </td>
                    <td>
                        <input type="number" id="sub-total" class="sub-total form-control" name="sub-total[]" value="0.00" >
                    </td>
                </tr>
            </tbody>

        </table>
</div>


        <div class="col-xs-6 mt-2 btn-group">
            <input type="submit" name="createSale" class="btn btn-success float-right" value="Record Sale"
                data-loading-text="Creating...">
        </div>

    </form>
</div>
<script>
    document.getElementById('datePicker').valueAsDate = new Date();
</script>

<script>

    $(document).on('change', '#itemSelect', function() {
        var selected = $(this).val();
        var row = $(this).closest('tr');

        $.ajax({
            url: 'script.php',
            type: 'POST',
            dataType: 'json',
            data: { value: selected },
            success: function(data) {
                row.find('#priceSelect').val(data.value);
                calculateTotal();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
</script>
<script>

    function calculateTotal() {
        var quantity = parseFloat(document.getElementById('quantity').value);
        var price = parseFloat(document.getElementById('priceSelect').value);
        var total = quantity * price;

        if (!isNaN(total)) {
            document.getElementById('sub-total').value = total.toFixed(2);
             } else {
            document.getElementById('sub-total').value = '';
        }
    }


</script>

<script>
$(document).ready(function() {
    // Add row when button is clicked
    $('#addnewRow').click(function() {
        var newRow = '<tr>' +
            '<td><select name="item[]" id="itemSelect" class="itemSelect">' +
            '<option disabled selected value> -- Select an Item -- </option>' +
            '<?php    $sql = "SELECT * from PriceList";
                $result = mysqli_query($con, $sql);
             while ($row = mysqli_fetch_assoc($result)) { ?>' +
            '<option value="<?php echo $row['item']; ?>"><?php echo $row['item']; ?></option>' +
            '<?php } ?>' +
            '</select></td>' +
            '<td>' +
            '<input type="number" id="quantity"  class="form-control quantity" name="quantity[]" value="1" oninput="calculateTotal1(),calcTotal()" onchange="calculateTotal1(),calcTotal()">' +
            '</td>' +
            '<td>' +
            '<input type="number" id="priceSelect" class="priceSelect form-control required" name="Price[]" value="0.00" oninput="calculateTotal1(),calcTotal()" onchange="calculateTotal1(),calcTotal()">' +
            '</td>' +
            '<td>' +
            '<input type="number" class="sub-total form-control" name="sub-total[]" id="sub-total" value="0.00" >' +
            '</td>' +
            '</tr>';

        $('#invoice_table tbody').append(newRow);
    });

    $(document).on('change', '.itemSelect', function() {
        var selected = $(this).val();
        var row = $(this).closest('tr');

        $.ajax({
            url: 'script.php',
            type: 'POST',
            dataType: 'json',
            data: { value: selected },
            success: function(data) {
                row.find('.priceSelect').val(data.value);
                calculateTotal1();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });

});

</script>
<script>

function calculateTotal1() {
    var table = document.getElementById('invoice_table');
    var sum = 0;

    for (var i = 0; i < table.rows.length; i++) {
        var quantityElement = document.getElementsByClassName('quantity')[i];
        var priceElement = document.getElementsByClassName('priceSelect')[i];
        var subTotalElement = document.getElementsByClassName('sub-total')[i];

        if (quantityElement && priceElement && subTotalElement) {
            var quantity = parseFloat(quantityElement.value);
            var price = parseFloat(priceElement.value);
            var total = quantity * price;

            if (!isNaN(total)) {
                subTotalElement.value = total.toFixed(2);
                sum += total;
            } else {
                subTotalElement.value = '';
            }
        }
    }
    }
    </script>

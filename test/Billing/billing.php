<?php

include('../home.php');
include('../connect.php');

?>

<div class="Container m-2 p-2">

    <form action="createinvoice.php" method="POST" id="create_invoice" >

        <div class="col-xs-8 text-right">
            <label>Status:</label>
            <select name="status" id="status">
                <option value="pending" selected>Pending</option>
                <option value="paid">Paid</option>
            </select>

            <strong>Date:</strong>
            <input type="date" name="date" id="datePicker" />
        </div>

        <div class="panel-heading">
            <h4 class="float-left">Customer Information</h4>
            <a href="#" id="selectCustomer" class="float-right select-customer" data-toggle="modal" data-target="#selectModal"><b>OR</b> Select Existing Customer</a>
        <div class="mt-2 panel-body form-group form-group-sm">

                <div class="col-xs-6">

                        <input type="text" class="margin-bottom copy-input required" name="customer_name"
                            id="customer_name" placeholder="Enter Name" tabindex="1" required>

                        <input type="text" class="margin-bottom copy-input required"
                            name="customer_address" id="customer_address" placeholder="Address" tabindex="2">

                        <input type="text" class="required" name="customer_phone" id="customer_phone"
                            placeholder="Phone Number" tabindex="3">

            </div>
        </div>
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
                            oninput="calculateTotal(),calcTotal()" onchange="calculateTotal(),calcTotal()">
                    </td>
                    <td>
                        <input type="number" id="priceSelect" class="priceSelect form-control required" name="Price[]" value="0.00"
                            oninput="calculateTotal(),calcTotal()" onchange="calculateTotal(),calcTotal()">
                    </td>
                    <td>
                        <input type="number" id="sub-total" class="sub-total form-control" name="sub-total[]" value="0.00" >
                    </td>
                </tr>
            </tbody>

        </table>
</div>

        <div class="col-xs-6 no-padding-right">
            <div class="row">
                <div class="col-xs-4 col-xs-offset-5">
                    <strong>Sub Total:</strong>
                </div>
                <div class="col-xs-3">
                    <input name="invoice_subtotal" id="invoice_subtotal"  >
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-xs-offset-5">
                    <strong>Discount:</strong>
                </div>
                <div class="col-xs-3">
                    <input name="invoice_discount" id="invoice_discount" placeholder="Enter % or amount"
                        oninput="calcTotal()" onchange="calcTotal()" >
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-xs-offset-5">
                    <strong>Total:</strong>
                </div>
                <div class="col-xs-3">
                    <input name="invoice_total" id="invoice_total" >
                </div>
            </div>
        </div>

        <div class="col-xs-6 mt-2 btn-group">
            <input type="submit" name="createInvoice" class="btn btn-success float-right" value="Create Invoice"
                data-loading-text="Creating...">
        </div>

    </form>
</div>
<script>
    document.getElementById('datePicker').valueAsDate = new Date();
</script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- Modal -->
<div id="selectModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Select Customer</h4>
        <button type="button" class="close" data-bs-dismiss="modal">X</button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Address</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php
// Fetch and display customer data from the database
$sql = "SELECT * FROM Members";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['MemberID'] . '</td>';
    echo '<td>' . $row['Name'] . '</td>';
    echo '<td>' . $row['Address'] . '</td>';
    echo '<td><button class="btn btn-sm btn-primary select">Select</button></td>';
    echo '</tr>';
}
?>

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


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
                calcTotal();
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
            var table =document.getElementById('invoice_table');
        var sum=0;
        $('#invoice_table tbody tr').each(function() {
  var value = parseFloat($(this).find('#sub-total').val());
  if (!isNaN(value)) {
    sum += value;
  }
});
            document.getElementById('invoice_subtotal').value = sum.toFixed(2);
        } else {
            document.getElementById('sub-total').value = '';
        }
    }


</script>
<script>
    function calcTotal() {
        var table =document.getElementById('invoice_table');
        var sum=0;
        $('#invoice_table tbody tr').each(function() {
  var value = parseFloat($(this).find('#sub-total').val());
  if (!isNaN(value)) {
    sum += value;
  }
});


        var sub_total = parseFloat(document.getElementById('invoice_subtotal').value);
        var discount = document.getElementById('invoice_discount').value;
        var inv_total = sub_total - discount;


        if (!isNaN(inv_total)) {
            document.getElementById('invoice_total').value = inv_total.toFixed(2);
        } else {
            document.getElementById('invoice_total').value = '';
        }
    }
</script>

<script>
const input = document.getElementById('invoice_discount');
const form = document.getElementById('create_invoice')
    form.addEventListener('submit',function(e){
        if(input.value === ''){
            input.value = 0;
        }
    });
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
                calcTotal();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });

    $(document).on('click', '#selectCustomer', function(){
        $('#selectModal').modal('show');
    });
    $('#selectModal').on('click', '.select', function(){
        var id = $(this).closest('tr').find('td:eq(0)').text();

        $.ajax({
    url: "select.php",
    method: "POST",
    data: {id: id},
    success: function(response){
        var parsedResponse = JSON.parse(response);
    console.log(parsedResponse);
    $('#customer_name').val(parsedResponse.name);
    $('#customer_address').val(parsedResponse.address);
    $('#customer_phone').val(parsedResponse.contact);
    $('#selectModal').modal('hide');
    }
  });


    });
});

</script>
<script>
//         function calculateTotal1() {
//         var table =document.getElementById('invoice_table');
//         for(var i = 0; i< table.rows.length;i++){
//             var quantity = parseFloat(document.getElementsByClassName('quantity')[i].value);
//             var price = parseFloat(document.getElementsByClassName('priceSelect')[i].value);
//             var total = quantity * price;
//             if (!isNaN(total)) {
//                 document.getElementsByClassName('sub-total')[i].value = total.toFixed(2);
//                 var table =document.getElementById('invoice_table');
//         var sum=0;
//         $('#invoice_table tbody tr').each(function() {
//   var value = parseFloat($(this).find('#sub-total').val());
//   if (!isNaN(value)) {
//     sum += value;
//   }
// });
//         document.getElementById('invoice_subtotal').value = sum.toFixed(2);
//             } else {
//                 document.getElementsByClassName('sub-total')[i].value = '';
//             }
//         }
//     }
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
document.getElementById('invoice_subtotal').value =  sum.toFixed(2);
    }

    </script>

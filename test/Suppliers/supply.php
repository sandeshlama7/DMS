<?php
 include('../home.php');
 include('../connect.php');
?>
<div>
<h1 class="text-center mt-3">Raw Milk Supply Details</h1>

<form id="myForm" class=" m-3" action="record.php" method="POST"  >
    <label>Date:</label>
    <input type="date" name="date" id="datePicker" >
    <table class="mt-4 table table-bordered table-striped" >
        <thead>
            <th>Supplier</th>
            <th>Milk Fat</th>
            <th>Quantity(litre)</th>
            <th>Cost per Fat</th>
            <th>Total Cost(Rs.)</th>
        </thead>
        <tbody>
            <tr>
                <?php
                    $sql = "SELECT * from Suppliers";
                    $result=mysqli_query($con,$sql);
                ?>
            <td>
                <select name="supplier" id="supplierSelect" required>
                            <option disabled selected value> -- Select Supplier -- </option>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                // populate the options
                                echo '<option value="' . $row['Name'] . '">' . $row['Name'] . '</option>';
                            }
                            ?>
                        </select></td>
            <td><input name="fat" class="form-control" type="number" value="0.00" step="0.1" id="fat" oninput="calculateCost()" onchange="calculateCost" required></td>
            <td><input name="quantity" class="form-control" type="number" value="0.00" step="0.1" id="quantity" oninput="calculateCost()" onchange="calculateCost" required> </td>
            <td><input name="fatcost" class="form-control" type="number" value="0.00" step="0.1" id="fatCost" oninput="calculateCost()" onchange="calculateCost" required></td>
            <td><input name="cost" class="form-control" type="text" value="0.00" step="1.0" id="Cost" required></td>
            </tr>
        </tbody>
    </table>

    <input type="hidden" name="supplierID" id="supplierID"/>
    <button type="submit" class="btn btn-primary" name="record">Record</button>
</form>

</div>

<script>
    document.getElementById('datePicker').valueAsDate = new Date();
</script>

 <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
$(document).ready(function() {
  $('#supplierSelect').change(function() {
    var selectedSupplier = $(this).val();
    $.ajax({
      url: 'script.php',
      method: 'POST',
      dataType: 'json',
      data: { value: selectedSupplier },
      success: function(response) {
        $('#fatCost').val(response.value);
        $('#supplierID').val(response.supplierId);
        calculateCost();
      }
    });
  });
});
</script>

<script>

function calculateCost() {
        var quantity = parseFloat(document.getElementById('quantity').value);
        var fat = parseFloat(document.getElementById('fat').value);
        var costperFat =parseFloat(document.getElementById('fatCost').value);
        var total = quantity * fat * costperFat;

        if (!isNaN(total)) {
            document.getElementById('Cost').value = total.toFixed(2);
        }else {
            document.getElementById('Cost').value = '';
        }
    }
    function validateFat(){
        var fat = document.getElementById('fat').value;
        if(fat >0.0 && fat <=10.0){
            return true;
        }
        else{
            alert("Fat should be between 0 and 10");
            return false;
        }
    }
    function validateQuantity(){
        var quantity= document.getElementById('quantity').value;
        if(quantity <=0){
            alert("Quantity should be higher than 0");
            return false;
        }
        return true;
    }
    </script>
<script>

document.getElementById("myForm").addEventListener("submit", function(e) {
    if(!validateFat() || !validateQuantity()){
        e.preventDefault();
    }
  });
  </script>

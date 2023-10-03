<?php
include('../home.php');
include('../connect.php');
?>
<?php
    $sql = "select * from Suppliers";
    $result = mysqli_query($con,$sql);
?>
<div class="m-3">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplier">
    Add Supplier</button>
</div>
<!-- Modal -->
<div class="modal fade" id="addSupplier" tabindex="-1" aria-labelledby="addSupplierLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addSupplierLabel">Supplier Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addSupplier" action="add.php" method="POST">
                <div class="modal-body">

                <div class="mb-3">
                        <label for="name" class="form-label">Name</label><span class="text-danger" id="name-error"></span>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label><span class="text-danger" id="addr-error"></span>
                        <input type="text" name="address" class="form-control" id="address" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">SupplierType </label><br>
                        <select class="form-control" name="type">
                            <option selected>Farmer</option>
                            <option >Middle Man</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label><span class="text-danger" id="cont-error"></span>
                        <input type="number" name="contact" class="form-control" id="contact" required>
                    </div>

                    <div class="mb-3">
                        <label for="payables" class="form-label">Payables</label><span class="text-danger" id="pay-error"></span>
                        <input type="number" name="payables" class="form-control" id="payables" value="0">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="insert" class="btn btn-primary">Add Supplier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateAddForm() {
  var nameInput = document.getElementById("name");
  var addressInput = document.getElementById("address");
  var contactInput = document.getElementById("contact");
  var payablesInput = document.getElementById("payables");
//   var typeInput = document.getElementById('type');

  var name = nameInput.value.trim();
  var address = addressInput.value.trim();
  var contact = contactInput.value.trim();
  var payables = payablesInput.value.trim();
//   var type =typeInput.value.trim();

  console.log(name);
  var Nameerror = document.getElementById("name-error");
  var Addresserror = document.getElementById("addr-error");
  var Contacterror = document.getElementById("cont-error");
  var Payableserror = document.getElementById("pay-error");
//   var Typeerror = document.getElementById("type-error");

    var isvalid = true;
  // Validate name (only letters or whitespaces)
  var nameRegex = /^[A-Za-z\s]+$/;
  if (!nameRegex.test(name)) {
    Nameerror.innerText = "* Please enter a valid name (only letters or whitespaces).";
    isvalid = false;
  }else{
    Nameerror.innerText="";}


  // Validate address (address format)
  var addressRegex = /^[A-Za-z]+-?\s?\d{1,2}(?:,[A-Za-z]+)?/;
  if (!addressRegex.test(address)) {
    Addresserror.innerText = "* Please enter a valid address.";
    isvalid = false;
  }else{
    Addresserror.innerText="";}

  // Validate contact (positive and exactly 10 digits)
  var contactRegex = /^\d{10}$/;
  if (!contactRegex.test(contact)) {
    Contacterror.innerText = "* Please enter a valid contact number (exactly 10 digits).";
    isvalid = false;
  }else{
    Contacterror.innerText="";}


  // Validate receivables (positive)
  if (parseFloat(payables) < 0) {
    Payableserror.innerText = "* Please enter a positive value for payables.";
    isvalid = false;
  }else{
    Payableserror.innerText="";}


  // Form is valid, submit the form
  return isvalid;
}

// Attach the form validation to the form's submit event
var form = document.getElementById("addSupplier");
form.addEventListener("submit", function (event) {
  if (!validateAddForm()) {
    event.preventDefault(); // Prevent form submission if validation fails
  }
});

    </script>


<!-- Edit MODAL -->

<div class="modal fade" id="editSupplier" tabindex="-1" aria-labelledby="editSupplierLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editSupplierLabel">Supplier Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="editSupplier" action="edit.php" method="POST">
                <div class="modal-body">

                <input type="hidden" id="id" name="id">
                <div class="mb-3">
                        <label for="nameS" class="form-label">Name</label><span class="text-danger" id="name-err"></span>
                        <input type="text" name="name" id="nameS" class="form-control" >
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">SupplierType </label><br>
                        <select class="form-control" name="type" id="typeS">
                            <option value="Farmer">Farmer</option>
                            <option value="Middle Man">Middle Man</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="addressS" class="form-label">Address</label><span class="text-danger" id="addr-err"></span>
                        <input type="text" name="address" id="addressS" class="form-control" >
                    </div>

                    <div class="mb-3">
                        <label for="contactS" class="form-label">Contact</label><span class="text-danger" id="cont-err"></span>
                        <input type="number" name="contact" id="contactS" class="form-control" >
                    </div>

                    <div class="mb-3">
                        <label for="payablesS" class="form-label">Payables</label><span class="text-danger" id="pay-err"></span>
                        <input type="number" name="payables" id="payablesS" class="form-control"  value="0">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="edit" class="btn btn-primary">Edit Supplier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateEditForm() {
  var nameInput = document.getElementById("nameS");
  var addressInput = document.getElementById("addressS");
  var contactInput = document.getElementById("contactS");
  var payablesInput = document.getElementById("payablesS");

  var name = nameInput.value.trim();
  var address = addressInput.value.trim();
  var contact = contactInput.value.trim();
  var payables = payablesInput.value.trim();

  console.log(name);
  var Nameerror = document.getElementById("name-err");
  var Addresserror = document.getElementById("addr-err");
  var Contacterror = document.getElementById("cont-err");
  var Payableserror = document.getElementById("pay-err");

    var isvalid = true;
  // Validate name (only letters or whitespaces)
  var nameRegex = /^[A-Za-z\s]+$/;
  if (!nameRegex.test(name)) {
    Nameerror.innerText = "* Please enter a valid name (only letters or whitespaces).";
    isvalid = false;
  }else{
    Nameerror.innerText="";}


  // Validate address (address format)
  var addressRegex = /^[A-Za-z]+-?\s?\d{1,2}(?:,[A-Za-z]+)?/;
  if (!addressRegex.test(address)) {
    Addresserror.innerText = "* Please enter a valid address.";
    isvalid = false;
  }else{
    Addresserror.innerText="";}

  // Validate contact (positive and exactly 10 digits)
  var contactRegex = /^\d{10}$/;
  if (!contactRegex.test(contact)) {
    Contacterror.innerText = "* Please enter a valid contact number (exactly 10 digits).";
    isvalid = false;
  }else{
    Contacterror.innerText="";}


  // Validate receivables (positive)
  if (parseFloat(payables) < 0) {
    Payableserror.innerText = "* Please enter a positive value for payables.";
    isvalid = false;
  }else{
    Payableserror.innerText="";}


  // Form is valid, submit the form
  return isvalid;
}

// Attach the form validation to the form's submit event
var form = document.getElementById("editSupplier");
form.addEventListener("submit", function (event) {
  if (!validateEditForm()) {
    event.preventDefault(); // Prevent form submission if validation fails
  }
});

    </script>
<!-- Edit END xxxxxxxXXXXXXXxxxxxxxx -->


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Remove Supplier</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
                <form action="delete.php" method="POST">
                <div class="modal-body" >
                    <input type="hidden" name="deleteid" id="deleteid">
                    <h4>Do you want to Delete this Supplier?</h4>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="delete" class="btn btn-danger" data-dismiss="modal">Delete</button>
                </div>
</form>
</div>
</div>
</div>

<!-- xxXXXxxx -->
        <div class="container pt-2">
            <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th>Payables</th>
                    <th>Options</th>
            </tr>
                </thead>
                <tbody>
                <?php
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
    <tr>
        <td><?=$row['supplierID']?></td>
        <td><?=$row['Name']?></td>
        <td><?=$row['SupplierType']?></td>
        <td><?=$row['Address']?></td>
        <td><?=$row['Contact']?></td>
        <td><?=$row['Payables']?></td>
        <td><button type="button" class="btn btn-sm btn-info edit"><i class="fas fa-edit"></i></button>
            <button type="button" class="btn btn-sm btn-danger delete"><i class="fas fa-trash-alt"></i></button>
            <button type="button" class="btn btn-sm btn-secondary history" data-bs-toggle="modal" data-bs-target="#historyModal"><i class="fas fa-history"></i></button>
                            </tr>

                           <?php }} ?>
                </tbody>
            </table>
    </div>
</div>
<!-- History Modal -->
<div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="historyModalLabel">History for <?= $row['Name'] ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Fat</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="historyData">
                  </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- History Modal End -->

<!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> -->

<script>
    $(document).ready(function () {
      $('#myTable').on('click', '.edit', function () {
            $('#editSupplier').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
                return $(this).text().trim();
            }).get();

            $('#id').val(data[0]);
            $('#nameS').val(data[1]);
            $('#typeS').val(data[2]);
            $('#addressS').val(data[3]);
            $('#contactS').val(data[4]);
            $('#payablesS').val(data[5]);

        });

        $('#myTable').on('click', '.delete', function () {
            $('#deleteModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text().trim();
            }).get();

            console.log(data[0]);

            $('#deleteid').val(data[0]);
        });

        $('#myTable').on('click', '.history', function(){
          var supplierID = $(this).closest('tr').find('td:eq(0)').text();
          var supplier = $(this).closest('tr').find('td:eq(1)').text();
          $('#historyModal').find('.modal-title').text('Supply History of ' + supplier);
          $('#historyModal').modal('show');

          $.ajax({
        url: 'get_history.php',
        type: 'POST',
        data: { supplierID: supplierID},
        success: function(response) {
          console.log("success");
          $('#historyModal').find('#historyData').html(response);
        },
        error: function(){
          alert("Error");
        }
        });
    });
  });
</script>


<?php
include('../home.php');
include('../connect.php');
?>
<?php
$sql = "select * from Members";
$result = mysqli_query($con, $sql);
?>

<div  class="m-3" >
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMember">
        Add Member</button>
</div>
<!-- Modal -->
<div class="modal fade" id="addMember" tabindex="-1" aria-labelledby="addMemberLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addMemberLabel">Member Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add-form" action="add.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label> <span class="text-danger" id="name-error"></span>
                        <input type="text" name="name" class="form-control" id="addname" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label> <span class="text-danger" id="addr-error"></span>
                        <input type="text" name="address" class="form-control" id="addaddress" required>
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label> <span class="text-danger" id="cont-error"></span>
                        <input type="number" name="contact" class="form-control" id="addcontact" required>
                    </div>

                    <div class="mb-3">
                        <label for="receivables" class="form-label">Receivables</label> <span class="text-danger" id="rece-error"></span>
                        <input type="number" name="receivables" class="form-control" id="addreceivables" value="0">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="insert" class="btn btn-primary">Add Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateAddForm() {
  var nameInput = document.getElementById("addname");
  var addressInput = document.getElementById("addaddress");
  var contactInput = document.getElementById("addcontact");
  var receivablesInput = document.getElementById("addreceivables");

  var name = nameInput.value.trim();
  var address = addressInput.value.trim();
  var contact = contactInput.value.trim();
  var receivables = receivablesInput.value.trim();

  var Nameerror = document.getElementById("name-error");
  var Addresserror = document.getElementById("addr-error");
  var Contacterror = document.getElementById("cont-error");
  var Receivableserror = document.getElementById("rece-error");

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
  if (parseFloat(receivables) < 0) {
    Receivableserror.innerText = "* Please enter a positive value for receivables.";
    isvalid = false;
  }else{
    Receivableserror.innerText="";}


  // Form is valid, submit the form
  return isvalid;
}

// Attach the form validation to the form's submit event
var form = document.getElementById("add-form");
form.addEventListener("submit", function (event) {
  if (!validateAddForm()) {
    event.preventDefault(); // Prevent form submission if validation fails
  }
});

    </script>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Member Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-form" action="update.php" method="POST">
                <div class="modal-body">

                    <input type="hidden" name="id" id="id">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <span class="text-danger" id="nameErr"></span>
                        <input type="text" name="name" id="editname" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <span class="text-danger" id="addressErr"></span>
                        <input type="text" name="address" id="editaddress" class="form-control ">
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <span class="text-danger" id="contactErr"></span>
                        <input type="number" name="contact" id="editcontact" class="form-control ">
                    </div>

                    <div class="mb-3">
                        <label for="receivables" class="form-label">Receivables</label>
                        <span class="text-danger" id="receivablesErr"></span>
                        <input type="number" name="receivables" id="editreceivables" class="form-control " value="0">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update" class="btn btn-primary">Update Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateEditForm() {
  var nameInput = document.getElementById("editname");
  var addressInput = document.getElementById("editaddress");
  var contactInput = document.getElementById("editcontact");
  var receivablesInput = document.getElementById("editreceivables");

  var name = nameInput.value.trim();
  var address = addressInput.value.trim();
  var contact = contactInput.value.trim();
  var receivables = receivablesInput.value.trim();

  var Nameerror = document.getElementById("nameErr");
  var Addresserror = document.getElementById("addressErr");
  var Contacterror = document.getElementById("contactErr");
  var Receivableserror = document.getElementById("receivablesErr");

    var isvalid = true;
  // Validate name (only letters or whitespaces)
  var nameRegex = /^[A-Za-z\s]+$/;
  if (!nameRegex.test(name)) {
    Nameerror.innerText = "* Invalid name!! (only letters or whitespaces).";
    isvalid = false;
  }else{
    Nameerror.innerText="";}


  // Validate address (address format)
  var addressRegex = /^[A-Za-z]+-?\s?\d{1,2}(?:,[A-Za-z]+)?/;
  if (!addressRegex.test(address)) {
    Addresserror.innerText = "* Invalid address.";
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
  if (parseFloat(receivables) < 0) {
    Receivableserror.innerText = "* Please enter a positive value for receivables.";
    isvalid = false;
  }else{
    Receivableserror.innerText="";}


  // Form is valid, submit the form
  return isvalid;
}

// Attach the form validation to the form's submit event
var form = document.getElementById("edit-form");
form.addEventListener("submit", function (event) {
  if (!validateEditForm()) {
    event.preventDefault(); // Prevent form submission if validation fails
  }
});

    </script>

<!-- EditModal End -->


<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Remove Member</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
                <form action="delete.php" method="POST">
                <div class="modal-body" >
                    <input type="hidden" name="deleteid" id="deleteid">
                    <h4>Do you want to Delete this Member?</h4>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="delete" class="btn btn-danger" data-dismiss="modal">Delete</button>
                </div>
</form>
</div>
</div>
</div>

<!-- xxxxxxxxxxxxxxxxxxxxxxxxxx -->

<div class="container pt-2">
    <table id="myTable" class="table table-striped table-bordered table-responsive">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact No.</th>
                <th>Receivables</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td>
                            <?= $row['MemberID'] ?>
                        </td>
                        <td>
                            <?= $row['Name'] ?>
                        </td>
                        <td>
                            <?= $row['Address'] ?>
                        </td>
                        <td>
                            <?= $row['Contact'] ?>
                        </td>
                        <td>
                            <?= $row['Receivables'] ?>
                        </td>
                        <td><button type="button" class="btn btn-sm btn-info edit"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-sm btn-danger delete"><i class="fas fa-trash-alt"></i></button>
                            <button type="button" class="btn btn-sm btn-danger history"><i class="fas fa-history"></i></button>
                        </td>
                    </tr>

                <?php }
            } ?>
        </tbody>
    </table>
</div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

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
                            <th>InvoiceID</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>PendingAmount</th>
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

<script>
    $(document).ready(function () {
        $('#myTable').on('click', '.edit', function () {
            $('#editModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
                return $(this).text().trim();
            }).get();

            console.log(data[0]);
            $('#id').val(data[0]);
            $('#editname').val(data[1]);
            $('#editaddress').val(data[2]);
            $('#editcontact').val(data[3]);
            $('#editreceivables').val(data[4]);

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
          var member = $(this).closest('tr').find('td:eq(1)').text().trim();
          $('#historyModal').find('.modal-title').text('Sales History of ' + member);
          $('#historyModal').modal('show');

          $.ajax({
        url: 'get_history.php',
        type: 'POST',
        data: { member: member},
        success: function(response) {
          $('#historyModal').find('#historyData').html(response);
        },
        error: function(){
          alert("Error");
        }
        });
    });
    });
</script>

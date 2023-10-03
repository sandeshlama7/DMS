<?php
include('../home.php');
include('../connect.php');

?>

<?php
    $sql = "Select * from Inventories";
    $result=mysqli_query($con,$sql);
?>


<div class="m-3">
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItem">
    Add Item</button>
</div>
<!-- Modal -->
<div class="modal fade" id="addItem" tabindex="-1" aria-labelledby="addItemLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addItemLabel">Item Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add-Form" action="add.php" method="POST">
                <div class="modal-body">

                <div class="mb-3">
                        <label for="item" class="form-label">Item</label><span class="text-danger" id="itemError" ></span>
                        <input type="text" name="item" class="form-control" id="item">
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label><span class="text-danger" id="quantityError" ></span>
                        <input type="number" name="quantity" class="form-control" id="quantity">
                    </div>

                    <div class="mb-3">
                        <label for="metric" class="form-label">Metric</label></br>
                    <select name="metric" id="metric">
                    <option value="Litre">Litre</option>
                    <option value="Kg">Kilogram</option>
                </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="insert" class="btn btn-primary">Add Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateAddForm(){

        var item = document.getElementById("item").value.trim();
        var quantity = document.getElementById("quantity").value.trim();

        console.log(item);
        var itemError = document.getElementById("itemError");
        var quantityError = document.getElementById("quantityError");

        var isvalid = true;

        var itemRegex = /^[A-Za-z\s]+(?:\([A-Za-z]+\))?$/;
        if(!itemRegex.test(item)){
            itemError.innerText = "* Invalid Item name!!";
            isvalid = false;
        }else{
            itemError.innerText ="";
        }

        if(quantity > 1000){
            quantityError.innerText = "* Quantity too high";
            isvalid = false;
        }else if(quantity<0){
            quantityError.innerText ="* Quantity cannot be negative";
            isvalid = false;

        }
        else{
            quantityError.innerText = "";
        }
        return isvalid;

    }

    var form = document.getElementById("add-Form");
form.addEventListener("submit", function (event) {
  if (!validateAddForm()) {
    event.preventDefault(); // Prevent form submission if validation fails
  }
});

    </script>

<!-- Edit MoDAL -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editItemLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editItemLabel">Item Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-Form" action="edit.php" method="POST">
                <div class="modal-body">

                <input type="hidden" id="id" name="id">
                <div class="mb-3">
                        <label for="item" class="form-label">Item</label>
                        <input type="text" name="item" class="form-control item" id="itemE" >
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label><span class="text-danger" id="quantityErr" ></span>
                        <input type="number" name="quantity" class="form-control quantity" id="quantityE">
                    </div>

                    <!-- <div class="mb-3">
                        <label for="metric" class="form-label">Metric</label></br>
                    <select name="metric" class="metric">
                    <option value="Litre">Litre</option>
                    <option value="Kg">Kilogram</option>
                </select>
                    </div> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="edit" class="btn btn-primary">Edit Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateEditForm(){
        var quantity = document.getElementById("quantityE").value.trim();
        var quantityErr = document.getElementById("quantityErr");

        isvalid = true;
        if(quantity<0){
            quantityErr.innerText = "* Quantity cannot be negative";
            isvalid = false;
        }else{
            quantityErr.innerText = "";
        }
        return isvalid;

    }
    var forms = document.getElementById('edit-Form');
    forms.addEventListener("submit", function(e){
        if(!validateEditForm()){
            e.preventDefault();
        }
    });
    </script>


<!--  -->

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
                    <h4>Do you want to Remove this Item?</h4>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="delete" class="btn btn-danger" data-dismiss="modal">Remove</button>
                </div>
</form>
</div>
</div>
</div>

<!-- xxxxxxxxxxxxxxxxxxxxxxxxxx -->

        <div class="container pt-2">
            <table id="myTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Metric</th>
                    <th>Options</th>
            </tr>
                </thead>
                <tbody>
                    <?php
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
            <td><?php echo $row['itemID'] ?></td>
            <td><?php echo $row['Item'] ?></td>
            <td><?php echo $row['Quantity'] ?></td>
            <td><?php echo $row['Metric'] ?></td>
            <td>
            <button type="button" class="btn btn-sm btn-info edit"><i class="fas fa-edit"></i></button>
            <button type="button" class="btn btn-sm btn-danger delete"><i class="fas fa-trash-alt"></i></button>
            </td>
 <?php  } } ?>

                </tbody>
            </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#myTable').on('click', '.edit', function () {
            $('#editModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
                return $(this).text().trim();
            }).get();

            $('#id').val(data[0]);
            $('.item').val(data[1]);
            $('.quantity').val(data[2]);
            $('.metric').val(data[3]);

        });

        $('#myTable').on('click', '.delete', function () {
            $('#deleteModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text().trim();
            }).get();


            $('#deleteid').val(data[0]);
        });
    });
</script>

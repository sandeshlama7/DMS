<?php
    include('../home.php');
    include('../connect.php');
?>
<?php
    $sql = "Select * from Invoices";
    $result = mysqli_query($con,$sql);
?>

<!-- Edit MoDAL -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editItemLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editItemLabel">Invoice Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form >
                <div class="modal-body">

                <input type="hidden" id="id" name="id">
                <input type="hidden" id="nameM" name="nameM">
                <div class="mb-3">

                <input type="hidden" id="invID" />
                        <label for="pending" class="form-label">Pending Amount</label>
                        <input type="number" name="pending" class="form-control " id="pending" disabled>
                    </div>
                    <div class="mb-3">
                        <button id="fully" class="btn btn-sm btn-info fully" >Paid Fully</button>
                        <!-- <button id="partially" class="btn btn-sm btn-secondary" >Paid Partially</button> -->
                    </div>
                    <div class="mb-3">
                    <label for="paid"class="form-label">Paid Amount</label> <span id="paidErr" class="text-danger" ></span>
                    <input type="number" name="paid"class="form-control" id="paid"  required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" name="edit" class="btn btn-primary record">Record</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--  -->

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Remove Invoice</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form action="delete.php" method="POST">
                <div class="modal-body" >
                    <input type="hidden" name="deleteid" id="deleteid">
                    <h4>Do you want to Remove this Invoice?</h4>
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

<!-- DETAILS MODAL -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailsModalLabel">Invoice Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="detailsTbody" >
                        <!-- Add PHP code here to fetch and display the invoice details -->

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- xxxxxxxxxxxxxxxxxxxxxxxxxx -->


<div class="m-3 pt-2">
<table id="myTable" class="table table-bordered table-striped">

<thead >
    <th>ID</th>
    <th>Issued Date</th>
    <th>Customer</th>
    <th>Subtotal</th>
    <th>Discount</th>
    <th>Total</th>
    <th>Status</th>
    <th>Options</th>
</thead>
<tbody>
<?php
    if($result){
    while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?php echo $row['invoiceID'] ?></td>
            <td><?php echo $row['Date']?></td>
            <td><?php echo $row['Customer'] ?></td>
            <td><?php echo $row['SubTotal'] ?></td>
            <td><?php echo $row['Discount'] ?></td>
            <td><?php echo $row['Total'] ?></td>
            <td><?php echo $row['Status'] ?></td>
            <td>
            <?php if ($row['Status'] == 'pending'){?>
            <button type="button" class="btn btn-sm btn-danger edit">Paid</button>
            <?php } ?>
            <!-- <button type="button" class="btn btn-sm btn-danger delete">Delete</button> -->
            <button type="button" class="btn btn-sm btn-info details" ><i class="fas fa-info-circle"></i></button>
            </td>
 <?php  } } ?>
</tbody>
</table>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<script>
    $(document).ready(function () {
        var pending;
        $('#myTable').on('click', '.edit', function () {
            $('#editModal').modal('show');
            //  pending = $(this).closest('tr').find('td:eq(5)').text();
            var id = $(this).closest('tr').find('td:eq(0)').text();
            var name = $(this).closest('tr').find('td:eq(2)').text();

            $('#paid').val("");
            $('#nameM').val(name);
            $('#invID').val(id);
            // $('#pending').val(pending);

            $.ajax({
                url:"findPending.php",
                type:'POST',
                data:{id:id},
                success : function (data){
                    $('#pending').val(data);
                }
            });

        });
        $('#editModal').on('click', '.fully', function(e){
            e.preventDefault();
            pending =document.getElementById('pending').value;
            $('#paid').val(pending);
        });

        $('#editModal').on('click', '.record', function(){
            if(validatePayment()){
                var paid =document.getElementById('paid').value;
                var id =document.getElementById('invID').value;
                var name =document.getElementById('nameM').value;

               $.ajax({
                url: 'record.php',
                type:'POST',
                data:{paid: paid, id:id, name:name},
                success : (data)=>{
                    console.log(data);
                    window.location.href = 'invoiceList.php';
                }
               });
            }

        });

        function validatePayment(){
            var paid =document.getElementById('paid').value.trim();
            pending =document.getElementById('pending').value;
            isValid = true;

            if(paid === ""){
                paidErr.innerText = "* Cannot be Empty";
                isValid = false;
            }
            else if(paid > parseInt(pending)){
        paidErr.innerText = "* Paid Amount cannot exceed Pending Amount";
        isValid=false;
    }else{
        paidErr.innerText = "";
    }
    return isValid;
        }

        $('#myTable').on('click', '.delete', function () {
            $('#deleteModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text().trim();
            }).get();


            $('#deleteid').val(data[0]);
        });

        $('#myTable').on('click', '.details', function(){
            $('#detailsModal').modal('show');

            var id = $(this).closest('tr').find('td:eq(0)').text();

        $.ajax({
        url: "details.php",
        method: "POST",
        data:{id:id},
        success: function(data) {
          $('#detailsTbody').html(data);
        }
      });
        });


    });
</script>

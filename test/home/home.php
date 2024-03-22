<?php

include('../home.php');
include('../connect.php')
?>

<?php
    $sql = "Select * From PriceList ";
    $result = mysqli_query($con, $sql);
?>

<script>
        function updateTime() {
            var date = new Date();
            var time = date.toLocaleTimeString();
            var currentDate = date.toISOString().slice(0,10);

            document.getElementById("current-date").innerHTML = currentDate;
            document.getElementById("current-time").innerHTML = time;
        }
        setInterval(updateTime, 1000); // Update every second (1000 milliseconds)
    </script>

<style>
    /* Custom CSS for the boxes */
    .custom-box {
        background-color: #f0f0f0;
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
        margin-bottom: 15px;
        background: linear-gradient(to bottom, #cccccc, #999999); /* Gradient background */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Box shadow */
    }
</style>

<div class="m-2 mb-4">
  <span class="m-2" id="current-date"><?php echo date("Y-m-d");?></span> <span id="current-time"><?php echo date("H:i:s a"); ?></span>
</div>

<div class="container m-2">

  <div class="row justify-content-between">
    <div style="max-width: 30%;" class="col-md-4 mb-3" >
      <div class="border border-black p-3 custom-box">
        <?php
          $res = mysqli_query($con, "SELECT * FROM Members");
          $member = mysqli_num_rows($res);
          echo $member;
        ?>
        <h4>Members</h4>
      </div>
    </div>
    <div style="max-width: 30%;" class="col-md-4 mb-3 ">
      <div class="border border-black p-3 custom-box">
        <?php
          $res = mysqli_query($con, "SELECT * FROM Suppliers");
          $supplier = mysqli_num_rows($res);
          echo $supplier;
        ?>
        <h4>Suppliers</h4>
      </div>
    </div>
    <div style="max-width: 30%;" class="col-md-4 mb-3 ">
      <div class="border border-black p-3 custom-box">
      <span class="p-1">Rs.</span>  <?php
          $res = mysqli_query($con, "SELECT SUM(Receivables) FROM Members");
          $row = mysqli_fetch_row($res);
          echo $row[0];
        ?>
        <h4>Receivables</h4>
      </div>
    </div>
    <div style="max-width: 30%;" class="col-md-4 mb-3 ">
      <div class="border border-black p-3 custom-box">
      <span class="p-1" >Rs.</span> <?php
          $res = mysqli_query($con, "SELECT SUM(Payables) FROM Suppliers");
          $row = mysqli_fetch_row($res);
          echo $row[0];
        ?>
        <h4>Payables</h4>
      </div>
    </div>

    <div style="max-width: 30%;" class="col-md-4 mb-3 ">
      <div class="border border-black p-3 custom-box">
        <?php
          $res = mysqli_query($con, "SELECT * FROM Invoices WHERE Status ='pending'");
          $member = mysqli_num_rows($res);
          echo $member;
        ?>
        <h4>Pending Bills</h4>
      </div>
    </div>

    <div style="max-width: 30%;" class="col-md-4 mb-3 ">
      <div class="border border-black p-3 custom-box">
        <span class="p-1" >Rs.</span><?php
          $res = mysqli_query($con, "SELECT SUM(SubTotal) FROM Sales WHERE date = '". date('Y-m-d') . "'");

          $row = mysqli_fetch_row($res);
          if($row[0] !== null && $row[0] !== ""){
          echo $row[0];
          }else {echo "0";}
        ?>
        <h4>Today's Sales</h4>
      </div>
    </div>
  </div>
</div>

<div class="container m-2 text-center">
        <h2 class="m-1" style="display:inline;">Price List</h2>
        <button class="btn btn-primary mb-2" id="editBtn" >Edit PriceList</button>
        <table id="priceTable" class="table table-striped table-bordered mx-auto" style="width: 40%">
    <thead>
        <tr>
            <th>Product</th>
            <th>Metrics</th>
            <th>Price</th>
        </tr>
    </thead>
        <tbody>

 <?php
    if($result){
        while($row = mysqli_fetch_assoc($result)){
        $id = $row['itemID'];
        $item = $row['item'];
        $metric = $row['metric'];
        $price = $row['price'];
        ?>
        <tr>
            <td><?php echo $item ?></td>
            <td><?php echo $metric ?></td>
            <td><?php echo $price ?></td>

         </tr>
    <?php } } ?>
</tbody>
</table>
</div>





<!-- Modal -->
<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Price List</h4>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Item</th>
              <th>Metric</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody id="modalTableBody">

          </tbody>

        </table>

        <button id="addBtn">Add New</button>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
       <a href="home.php"> <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
        <a href="home.php"><button type="button" class="btn btn-primary" data-dismiss="modal">Save</button></a>
      </div>

    </div>
  </div>
</div>

<!-- Add item modal -->
<div class="modal fade" id="addModal">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">
        <h4>Add New Item</h4>
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <input class="form-control" name="addItem" type="text" id="addItem" placeholder="Item Name" required></br>
        <input type="text" name="addMetric" class="form-control" id="addMetric" placeholder="Metric" required></br>
        <input type="number" name="addPrice" id="addPrice" class="form-control" placeholder="Price" required>

      </div>

      <div class="modal-footer">
          <span class="text-danger" id="already" ></span>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="addConfirm" >Confirm</button>

      </div>

    </div>

  </div>

</div>

<div id="editItemModal" class="modal">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <h4>Edit Item</h4>

        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>

      </div>

      <div class="modal-body">

        <input class="form-control" type="text" id="editItem"></br>
        <input class="form-control" type="text" id="editMetric"></br>
        <input class="form-control" type="number" id="editPrice">
        <input class="form-control" type="hidden" id="editId">

      </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button id="saveEdit" class="btn btn-primary" >Save</button>

      </div>

    </div>

  </div>

</div>

<script>
$(document).ready(function(){


  $('#editBtn').click(function(){
    $('#editModal').modal('show');

    // Fetch existing data from database and populate modal table
    <?php
      $sql = "SELECT * FROM PriceList";
      $result = mysqli_query($con, $sql);
    ?>

    $('#modalTableBody').html('');
    // $('#itemTable').empty();


    <?php
      while($row = mysqli_fetch_assoc($result)){
    ?>

      $('#modalTableBody').append(`
        <tr>
          <td><?php echo $row['item'] ?></td>
          <td><?php echo $row['metric'] ?></td>
          <td><?php echo $row['price'] ?></td>
          <td>
           <button class='editBtn'>Edit</button>
            <button class='deleteBtn'>Delete</button>
          </td>
        </tr>
      `);

    <?php } ?>

  });
});
</script>

<script>

// Add item
$('#addBtn').click(function(){
  $('#addModal').modal('show');
});


$('#addModal').on('click', '#addConfirm', function(){

var item = $('#addItem').val();
var metric = $('#addMetric').val();
var price = $('#addPrice').val();

$.ajax({
  url: "insert.php",
  method: "POST",
  data: {item:item, metric:metric, price:price},
  success: function(response){
   if(response === 'Item added successfully'){
       $('#addModal').modal('hide');
       $.ajax({
        url: "populate.php",
        method: "GET",
        success: function(data) {
          $('#modalTableBody').html(data);
        }
      });
      }
          else{
            console.log(document.getElementById('already'));
            document.getElementById('already').innerText= response;
        console.log(response);
    }
  }
});

});



// Edit item
$('#modalTableBody').on('click','.editBtn', function(){


  var item = $(this).closest('tr').find('td:eq(0)').text();
  var metric = $(this).closest('tr').find('td:eq(1)').text();
  var price = $(this).closest('tr').find('td:eq(2)').text();

  $('#editItemModal').modal('show');
  var olditem = $(this).closest('tr').find('td:eq(0)').text();
  $('#editItem').val(item);
  $('#editMetric').val(metric);
  $('#editPrice').val(price);
  $('#editId').val(olditem);

});

// Update on save click
$('#editItemModal').on('click', '#saveEdit', function(){

    console.log("clicked");
  var id = $('#editId').val();
  var item = $('#editItem').val();
  var metric = $('#editMetric').val();
  var price = $('#editPrice').val();

  $.ajax({
    url: "update.php",
    method: "POST",
    data: {id: id, item: item, metric: metric, price: price},
    success: function(){
      $.ajax({
        url: "populate.php",
        method: "GET",
        success: function(data) {
          $('#modalTableBody').html(data);
        }
      });
      $('#editItemModal').modal('hide');
    }
  });

});


// Delete item
$('#modalTableBody').on('click','.deleteBtn',function(){

  var item = $(this).closest('tr').find('td:eq(0)').text();

  $.ajax({
    url: "delete.php",
    method: "POST",
    data: {item: item},
    success: function(){
      $.ajax({
        url: "populate.php",
        method: "GET",
        success: function(data) {
          $('#modalTableBody').html(data);
        }
      });
    }
  });

})

</script>

<?php
    include('../home.php');
    include('../connect.php');
?>
<?php
    $sql = "Select * from Sales";
    $result = mysqli_query($con,$sql);
?>

<h2 class="m-2 text-center">Sales Record</h2>
<div class="m-3 pt-2">
<table id="myTable" class="table table-bordered table-striped">

<thead >
    <th>ID</th>
    <th>Sale Date</th>
    <th>Items</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Subtotal</th>
</thead>
<tbody>
<?php
    if($result){
    while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?php echo $row['salesId'] ?></td>
            <td><?php echo $row['Date']?></td>
            <td><?php echo $row['Items'] ?></td>
            <td><?php echo $row['Quantity'] ?></td>
            <td><?php echo $row['Price'] ?></td>
            <td><?php echo $row['SubTotal'] ?></td>

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
             pending = $(this).closest('tr').find('td:eq(5)').text();
            var id = $(this).closest('tr').find('td:eq(0)').text();
            var name = $(this).closest('tr').find('td:eq(2)').text();

            $('#paid').val("");
            $('#nameM').val(name);
            $('#invID').val(id);
            $('#pending').val(pending);

        });
        $('#editModal').on('click', '.fully', function(e){
            e.preventDefault();
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
            // console.log(pending);
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

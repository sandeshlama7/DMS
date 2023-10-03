<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DMS Home</title>
    <link rel="stylesheet" href="../styles.css">
    <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">

    <script defer src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://kit.fontawesome.com/edd7d76e40.js" crossorigin="anonymous"></script>
    <script  src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
       document.addEventListener('DOMContentLoaded', function() {
  var table = document.getElementById('myTable');
  var dataTable = new DataTable(table);

  var columnName = 'Options'; // Replace with the actual column name
    var column = dataTable.columns().header().to$().filter(':contains("' + columnName + '")');
    column.width('15%');
});
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

   document.querySelector('.supp-btn').addEventListener('click', function() {
    document.querySelector('.supp-show').classList.toggle("show");
    // document.querySelector('.first').toggleClass("rotate");
});

  document.querySelector('.sale-btn').addEventListener('click', function(){
    document.querySelector(".sale-show").classList.toggle("show2");
  });

document.querySelector('.bill-btn').addEventListener('click', function() {
    document.querySelector('.bill-show').classList.toggle("show1");
    // document.querySelector('.second').toggleClass("rotate");
});
    });
</script>
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //   var userDropdown = document.querySelector('.user-menu');
    //   var dropdownInstance = new bootstrap.Dropdown(userDropdown);
    // });
    document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.dropdown-toggle').addEventListener('click', function() {
        document.querySelector('.dropdown-menu').classList.toggle('show');
    });
});

  </script>


</head>
<body>
    <header class="main-header">
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top navbar-inverse" role="navigation">

            <a href="../home/home.php" class="navbar-brand"> Mero Dairy </a>
         <div class="navbar-custom-menu">
           <ul class="nav navbar-right top-nav">
            <span>Dhulikhel Dairy Farm</span>
             <!-- User Account Menu -->
             <li class="dropdown user user-menu">
               <!-- Menu Toggle Button -->
               <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-gear"></i><b class="caret"></b>
               </a>
               <ul class="dropdown-menu">
                <li><a href="../profile/profile.php"><i class="fa fas fa-user"></i>Profile</a></li>
                 <li><a href="" id="logout"><i class="fa fa-fw fa-power-off"></i>Log Out</a></li>
               </ul>
             </li>
           <!-- </ul> -->
         </div>
       </nav>
     </header>


        <div class="wrapper">

            <div class="sidebar">
            <ul>
                <li><a href="../home/home.php"><i class="fas fa-sharp fa-solid fa-house"></i> Home</a></li>
                <li><a href="../Inventory/inventory.php"><i class="fas fa-solid fa-warehouse"></i> Inventory</a></li>
                <li><a href="../Members/members.php"><i class="fas fa-solid fa-users "></i> Members</a></li>
                <li>
                    <a href="#" class="supp-btn"><i class="fas fa-solid fa-users"></i> Suppliers<span class="fas fa-caret-down supp-btn first"></span></a>
                </li>
                    <ul class="supp-show">
                        <li><a href="../Suppliers/supply.php"><i class="fas fa-plus"></i>Record a Supply</a></li>
                        <li><a href="../Suppliers/suppliers.php"><i class="fas fa-cog"></i>Manage Suppliers</a></li>
                    </ul>
                <li>
                    <a href="#" class="bill-btn"><i class="fas fa-solid fa-receipt"></i> Invoice<span class="fas fa-caret-down second"></span></a></li>
                <ul class="bill-show">
                    <li><a href="../Billing/billing.php"><i class="fas fa-plus"></i>Create Invoice</a></li>
                    <li><a href="../Billing/invoiceList.php"><i class="fas fa-receipt"></i>Manage Invoices</a></li>
                </ul>
                <li>
                    <a href="#" class="sale-btn"><i class="fas fa-solid fa-chart-line"></i> Sales<span class="fas fa-caret-down second"></span></a></li>
                <ul class="sale-show">
                    <li><a href="../Sales/recordSales.php"><i class="fas fa-plus"></i>Record a Sale</a></li>
                    <li><a href="../Sales/sales.php"><i class="fas fa-chart-line"></i>Sales Records</a></li>
                </ul>

            </div>
            <div class="main">
<script>
        $(document).ready(function() {
  $('#logout').click(function(e) {
    e.preventDefault(); // Prevent the default behavior of the link

    // Send an AJAX request to the PHP script
    $.ajax({
      url: '../logout.php',
      type: 'POST',
    //   data: { param1: 'value1', param2: 'value2' }, // Optional data to send to the PHP script
      success: function(response) {
        // Handle the response from the PHP script
        console.log(response);
        window.location.href = '../LoginSignUp/index.php';
      },
      error: function(xhr, status, error) {
        // Handle any errors that occur during the AJAX request
        console.log(error);
      }
    });
  });
});

    </script>

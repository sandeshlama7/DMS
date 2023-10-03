<?php

include('../home.php');
include('../connect.php')
?>

<?php
    $sql = "SELECT * from User";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);

?>

<link rel="stylesheet" href="profile.css">
<div class="container">
<div class="profile  m-3">

  <h2 class="text-center">Dairy Details</h2>
  <span id="profileErr"></span>
  <form class="form" id="detailsForm">
    <label for="name">Dairy Name:</label><span class="text-danger" id="nameErr" ></span>
    <input class="form__input" type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br>

    <label for="contact">Contact:</label><span id="contactErr" class="text-danger" > </span>
    <input class="form__input" type="text" id="contact" name="contact" value="<?php echo $row['contact']; ?>" required><br>

    <label for="address">Address:</label><span id="addressErr" class="text-danger" ></span>
    <input class="form__input" type="text" id="address" name="address" value="<?php echo $row['address']; ?>" required><br>

    <label for="email">Email:</label>
    <input class="form__input" type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>

    <span class="btnspan">
    <input class="form_btn button submit" type="submit" id="savedetails" value="Save">
    </span>
  </form>
</div>

<div class="password-change  m-3">
  <h2 class="text-center">Change Password</h2>
  <span class="text-danger" id="passErr"></span>
  <form class="form" id="passwordForm">
    <label for="currentPassword">Current Password:</label>
    <input class="form__input" type="password" id="currentPassword" name="currentPassword" required><br>

    <label for="newPassword">New Password:</label>
    <input class="form__input"  type="password" id="newPassword" name="newPassword" required><br>

    <label for="confirmPassword">Confirm New Password:</label>
    <input class="form__input"  type="password" id="confirmPassword" name="confirmPassword" required><br>

    <span class="btnspan">
    <input class="form_btn button submit" id="changepw" type="submit" value="Change Password">
    </span>
  </form>
</div>
</div>
  <script>
    // Add your JavaScript code here
    const detailsForm = document.getElementById('detailsForm');
    const passwordForm = document.getElementById('passwordForm');
$(document).ready(function(){

  detailsForm.addEventListener('submit', function(event) {
    if(!validateForm()){
      event.preventDefault();
    }else{
    const name = document.getElementById('name').value;
    const contact = document.getElementById('contact').value;
    const address = document.getElementById('address').value;
    const email = document.getElementById('email').value;

    // Perform the necessary actions to save the details
    // For example, you can make an AJAX request to a server endpoint
    $.ajax({
      url: '../change.php',
      type: 'POST',
      data: {
        name: name,
        contact: contact,
        address: address,
        email: email
      },
      success: function(response) {
        var parsedResponse = JSON.parse(response);
    console.log(parsedResponse.message);
    var profileErr = document.getElementById("profileErr");
  profileErr.innerText = parsedResponse.message;


        // You can display a success message to the user or perform any other necessary actions
      },
      error: function(xhr, status, error) {
        console.log('Error updating details:', error);
        // You can display an error message to the user or perform any other necessary actions
      }
    });
  }
  });

  passwordForm.addEventListener('submit', function(event) {
    event.preventDefault();
    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    // Perform the necessary actions to change the password
    // For example, you can make an AJAX request to a server endpoint
    // to update the user's password
    $.ajax({
      url: '../change.php',
      type: 'POST',
      data: {
        currentPassword: currentPassword,
        newPassword: newPassword,
        confirmPassword: confirmPassword
      },
      success: function(response) {
        var parsedResponse = JSON.parse(response);
    console.log(parsedResponse.message);

    var passErr = document.getElementById("passErr");
  passErr.innerText = parsedResponse.message;

        // You can display a success message to the user or perform any other necessary actions
      },
      error: function(xhr, status, error) {
        console.log('Error changing password:', error);
        // You can display an error message to the user or perform any other necessary actions
      }
    });


  });

  function validateForm(){
    var name = document.getElementById('name').value.trim();
    var contact =document.getElementById('contact').value.trim();
    var address =document.getElementById('address').value.trim();

    var nameErr = document.getElementById('nameErr');
    var contactErr = document.getElementById('contactErr');
    var addressErr = document.getElementById('addressErr');

    var isvalid = true;
  var nameRegex = /^[A-Za-z\s]+$/;
  if (!nameRegex.test(name)) {
    nameErr.innerText = "* Please enter a valid name (only letters or whitespaces).";
    isvalid = false;
  }else{
    nameErr.innerText="";}


  // Validate address (address format)
  var addressRegex = /^[a-zA-Z]{3,}-?\s?\d{1,2}(?:,\s?[a-zA-Z]*)?$/;
   if (!addressRegex.test(address)) {
    addressErr.innerText = "* Please enter a valid address.";
    isvalid = false;
  }else{
    addressErr.innerText="";}


  // Validate contact (positive and exactly 10 digits)
  var contactRegex = /^\d{10}$/;
  if (!contactRegex.test(contact)) {
    contactErr.innerText = "* Please enter a valid contact number (exactly 10 digits).";
    isvalid = false;
  }else{
    contactErr.innerText="";
  }
  return isvalid;


  }

})
  </script>

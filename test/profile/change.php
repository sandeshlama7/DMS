<?php
include('connect.php');
// Assuming you have a database connection established

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Check if the request is for updating user details
  if (isset($_POST['name']) && isset($_POST['contact']) && isset($_POST['address']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    // Perform the necessary actions to update the user details in the database
    // For example, you can use SQL queries to update the corresponding user record
    $sql = "UPDATE User SET name = '$name', contact = '$contact', address = '$address' WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    if ($result) {
      $response = array('status' => 'success', 'message' => 'Details has been updated successfully');
    } else {
      $response = array('status' => 'error', 'message' => 'Error updating details');
    }

    echo json_encode($response);
  }

  // Check if the request is for changing the password
  if (isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Make sure to validate the current password and match the new password with the confirm password
    if ($newPassword === $confirmPassword) {
      $sql = "UPDATE User SET password = '$newPassword' WHERE userID = 11 AND password = '$currentPassword'";
      $result = mysqli_query($con, $sql);

      if ($result) {
        $response = array('status' => 'success', 'message' => 'Password changed successfully');
      } else {
        $response = array('status' => 'error', 'message' => 'Wrong password');
      }
    } else {
      $response = array('status' => 'error', 'message' => 'New password and confirm password do not match');
    }

    echo json_encode($response);
  }
}
?>

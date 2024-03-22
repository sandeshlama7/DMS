<?php
// Start the session
session_start();

// Unset the session variable
unset($_SESSION['loggedin']);

// Return a response back to the JavaScript
$response = 'Logout successful!';
echo $response;

?>

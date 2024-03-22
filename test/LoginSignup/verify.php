<?php
// Start the session
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../connect.php');

// print_r($_POST);
if(isset($_POST['login'])){
        $Lemail = $_POST['emailLogin'];
        $Lpassword = $_POST['passwordLogin'];

        // Perform the login verification
        $stmt = $con->prepare("SELECT * FROM User WHERE email = ?");
        $stmt->bind_param("s", $Lemail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // Verify the password
            if ($Lpassword === $row['password']) {
                // Set session variables
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $Lemail;

                $sql = "SELECT name FROM User WHERE email = '$Lemail'";
                $res = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($res);
                $_SESSION['name'] = $row['name'];
                // Redirect to a logged-in page
                header('Location: ../home/home.php');
                exit;
            } else {
                // Display error message
                $errorMessage = "Wrong password!!";
            }
        } else {
            // Display error message
            $errorMessage = "Wrong email!!";
        }

        $stmt->close();
        $_SESSION['loginErr'] = $errorMessage;
    }

    // Close the database connection
    $con->close();
    header('location: ../../dms');


?>

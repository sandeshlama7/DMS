<?php

// Start the session
session_start();

include('../connect.php');
// Define variables and set to empty values
$nameErr = $addressErr = $contactErr = $emailErr = $passwordErr = $confirmPasswordErr = "";
$name = $address = $contact = $email = $password = $confirmPassword = "";


// Form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // $loginemail = test_input($_POST['emailLogin']);
  // $loginpass = test_input($_POST['passwordLogin']);

  // echo $loginpass;

  // Validate name
  if (!empty($_POST['name'])) {
    $name = test_input($_POST['name']);
    // Check if name contains only letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  // Validate address
  if (!empty($_POST['address'])) {
    $address = test_input($_POST['address']);
  }

  // Validate contact
  if (!empty($_POST['contact'])) {
    $contact = test_input($_POST['contact']);
    // Check if contact is exactly 10 digits
    if (!preg_match("/^\d{10}$/", $contact)) {
      $contactErr = "Contact should be exactly 10 digits";
    }
  }

  // Validate email
  if (!empty($_POST['email'])) {
    $email = test_input($_POST['email']);
    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  // Validate password
  if (!empty($_POST['password'])) {
    $password = test_input($_POST['password']);
  }

  // Validate confirm password
  if (!empty($_POST['confirmPassword'])) {
    $confirmPassword = test_input($_POST['confirmPassword']);
    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
      $confirmPasswordErr = "Passwords don't match";
    }
  }

  // If there are no errors, proceed with registration
  if (empty($nameErr) && empty($addressErr) && empty($contactErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
    $_SESSION['name'] = $name;
    $_SESSION['address'] = $address;
    $_SESSION['contact'] = $contact;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;


    // Perform registration process
    header('location: createAccount.php');
    // Set session variables or redirect to a success page
  }
  else{
    echo '<script>document.addEventListener("DOMContentLoaded", function() { changeForm(); });</script>';
  }
  }


// Function to sanitize and validate input
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<html lang="en">

<head>
  <!-- <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0"> -->
  <!-- <meta charset="utf-8"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
</head>

<body>
  <div class="main">
    <div class="container b-container" id="b-container">
      <form class="form" id="b-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

        <h2 class="form_title title">Create DairyOwner Account</h2>


        <input name="name" class="form__input" type="text" placeholder="Dairy's Name" value="<?php echo $name; ?>"
          required> <span class="error">
          <?php echo $nameErr; ?>
        </span><br>
        <input name="address" class="form__input" type="text" placeholder="Address" value="<?php echo $address; ?>"
          required> <span class="error">
          <?php echo $addressErr; ?>
        </span><br>
        <input name="contact" class="form__input" type="number" placeholder="Contact" value="<?php echo $contact; ?>"
          required> <span class="error">
          <?php echo $contactErr; ?>
        </span><br>
        <input name="email" class="form__input" type="email" placeholder="Email" value="<?php echo $email ?>" required>
        <span class="error">
          <?php echo $emailErr; ?>
        </span><br>
        <input name="password" id="password" class="form__input" pattern="[a-zA-Z0-9]{8,}" type="password"
          placeholder="Password" value="<?php echo $password; ?>" required><i class="fas fa-eye password-toggle"></i></br>
        <span class="error">
          <?php echo $passwordErr; ?>
        </span>
        <br>

        <input name="confirmPassword" class="form__input" type="password" placeholder="Confirm Password"
          value="<?php echo $confirmPassword; ?>" required> <i class="fas fa-eye password-toggle"></i>
        <span class="error">
          <?php echo $confirmPasswordErr; ?>
        </span><br>
        <button type="submit" class="form__button button submit" name="sign-up">SIGN UP</button>
      </form>
    </div>

    <div class="container a-container" id="a-container">
      <form class="form" id="a-form" action="verify.php" method="POST">
        <h2 class="form_title title">Sign in to Website</h2>
        <span>
              <?php if(isset($_SESSION['info'])){echo $_SESSION['info']; unset($_SESSION['info']);} ?>
            </span>
    <input name="emailLogin" class="form__input" type="email" placeholder="Email" required>
    <input name="passwordLogin" class="form__input" type="password" placeholder="Password" required><i class="fas fa-eye password-toggle"></i>
    <button type="submit" name="login" class="form__button button submit">SIGN IN</button>
    </form>
    </div>

    <div class="switch" id="switch-cnt">
      <div class="switch__circle"></div>
      <div class="switch__circle switch__circle--t"></div>
      <div class="switch__container " id="switch-c2">
        <h2 class="switch__title title">Hello Saau !</h2>
        <p class="switch__description description">Enter your dairy details and create an account</p>
        <button class="switch__button button switch-btn">SIGN UP</button>
      </div>
      <div class="switch__container is-hidden" id="switch-c1">
        <h2 class="switch__title title">Welcome Back !</h2>
        <p class="switch__description description">If you already have an account, please login with your personal info
        </p>
        <button class="switch__button button switch-btn">SIGN IN</button>
      </div>
    </div>
  </div>
  <script src="index.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const togglePassword = document.querySelectorAll('.password-toggle');
      togglePassword.forEach((icon) => {
        icon.addEventListener('click', () => {
          const inputField = icon.previousElementSibling;
          const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
          inputField.setAttribute('type', type);
          icon.classList.toggle('fa-eye-slash');
        });
      });
    });
  </script>
  <!-- <script>
    document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('a-form');
  const submitButton = document.querySelector('.form__button[name="login"]');

  submitButton.addEventListener('click', (event) => {
    event.preventDefault(); // Prevent the default form submission

    // Manually submit the form using JavaScript
    form.submit();
  });
});
  </script> -->


</body>

</html>

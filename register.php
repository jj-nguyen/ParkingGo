<?php
  session_start();

  // Register user php script
  include('scripts/user-register.php');

?>
<!DOCTYPE html>
<html>

  <head>
    <!-- Encoding -->
    <meta charset="utf-8">
    <title>Register page</title>
    <!-- Viewports allow for dynamic design and sizes depending on the device-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link the style sheet -->
    <link href="style.css" rel="stylesheet" type="text/css" />
    <!-- Link to javascript file for form verification -->
    <script type="text/javascript" src="validate-form.js"> </script>
  </head>

  <body>


    <!-- Navigation menu -->
    <?php
      include('includes/header.php');
    ?>
    <!-- Register form -->
    <!-- Elements are centered-->
    <form id="register" method ="post" onsubmit="return validateRegisterForm(register)">

      <label for="first-name" class="center">First Name</label>
      <input type="text" class="form-item center" placeholder="Enter First Name" name="First-Name" id="first-name" required>

      <label for="last-name" class="center">Last Name</label>
      <input type="text" class="form-item center" placeholder="Enter Last Name" name="Last-Name" id="last-name" required>

      <label for="email" class="center">Email</label>
      <input type="email" class="form-item center" placeholder="Enter Email" name="Register-Email" id="register-email" required>

      <label for="password" class="center">Password</label>
      <input type="password" class="form-item center" placeholder="Enter Password" name="Register-Password" id="register-password" required>

      <label for="password-repeat" class="center">Repeat Password</label>
      <input type="password" class="form-item center" placeholder="Repeat Password" name="Password-Repeat" id="password-repeat" required>

      <button type="submit" class="form-item center" name="Register-User" id="register-user">Register</button>

    </form>

  </body>

</html>

<?php
  include("scripts/user-login.php");
 ?>
<!-- Navigation menu -->
<header>

  <!-- jusity-content: space-between allows for left/right spacing of groups (if there are 2 groups) -->
  <nav class="topnav">
    <!-- Left located links -->
    <ul>
      <li>
        <a href="#"><img src="img/earth-globe.svg" alt="Home" title="Home" class="scale" /></a>
      </li>

      <li>
        <a href="search.php">Search</a>
      </li>

      <li>
        <a href="register.php">Register</a>
      </li>

      <?php
        if ($_SESSION['isLogged']){
          echo "
            <li>
              <a href='submission.php'>Parking Submission</a>
            </li>
            ";
        }
       ?>
    </ul>

    <ul>
      <?php
        // Add log in button if user is not logged in
        if (!$_SESSION['isLogged']){
          echo "
          <li>
            <form id='login-form' method='post'>
              <input class='login-form-item' type='text' placeholder='Email' name='Login-Email' id='login-email' required/>
              <input class='login-form-item' type='password' placeholder='Password' name='Login-Password' id='login-password' required/>
              <button  class='login-form-item' type='submit' name ='Login-User' id='login-user'>Login</button>
            </form>
          </li>
          ";
        }
        // Add log out button if user is logged in
        if ($_SESSION['isLogged']){
          echo "<li class='login-form-item'>
          Welcome, " . $_SESSION['userFirstName'] . " " . $_SESSION['userLastName'] . "
          </li>";
          echo "<li><form id='login-form' method='post'>";
          echo "<button  class='login-form-item' type='submit' name ='Logout-User' id='login-user'>Log out</button>";
          echo "</form></li>";
        }
       ?>
    </ul>
  </nav>

</header>

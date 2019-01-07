<?php

include_once('scripts/dbconn.php');

$errors = array();

// Login user
// Checks if submit button 'register-user' is clicked
// $_POST uses the control's name
if (isset($_POST['Login-User'])){

  // Establish connection with database
  $dbconn = dbConnect();

  // Grab login fields
  $email =$_POST['Login-Email'];
  $password =$_POST['Login-Password'];

  // Server-side validation of fields
  if (empty($email)) {
    array_push($errors, "Email is required");
  }else {
    // Check proper syntax for email
    if (!preg_match('/\S+@\S+\.\S+/',$email)){
      array_push($errors, "Not a valid email");
    }
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  } else {
    // Check proper syntax for password
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',$password)){
      array_push($errors, "Password must be at least eight characters, one letter and one number (no special characters)");
    }
  }

  // Prepare statement to prevent SQL Injection
  $query = "SELECT * FROM users where email = :email LIMIT 1";
  $statement = $dbconn->prepare($query);
  $statement->bindParam(":email",$email);

  // Execute query
  $statement->execute();

  // Fetch data from database using query
  // Fetch gives back an array based on the query
  $row = $statement->fetch(PDO::FETCH_ASSOC);

  // If a user is found
  if ($row) {

    // Verify password
    $verify=password_verify($password,$row['password_hash']);

    if ($verify) {

      // User is now logged in
      $_SESSION['isLogged'] = True;
      $_SESSION['userFirstName'] = $row['first_name'];
      $_SESSION['userLastName'] = $row['last_name'];
      $_SESSION['userId'] = $row['user_id'];

      // Redirect to the search page
      header("Location: search.php");

    } else {
      echo "Password is incorrect";
    }
  } else {
    echo "No user found";
  }

  // Close database connection
  $db->close();
  }

if (isset($_POST['Logout-User'])){

    // Set user no longer logged in
    $_SESSION['isLogged'] = False;

    // Redirect to the search page
    header("Location: search.php");
}

// Clear errors
unset($errors);

?>

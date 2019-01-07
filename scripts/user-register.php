<?php

include_once('scripts/dbconn.php');

$errors = array();

// Register user
// Checks if submit button 'register-user' is clicked
// $_POST uses the control's name
if (isset($_POST['Register-User'])){

  // Establish connection with database
  $dbconn = dbConnect();

  // Grab register fields
  $firstName =$_POST['First-Name'];
  $lastName = $_POST['Last-Name'];
  $email =  $_POST['Register-Email'];
  $password = $_POST['Register-Password'];
  $passwordRepeat = $_POST['Password-Repeat'];

  // Server-side validation of fields
  // First check if empty, if not, check syntax.
  if (empty($firstName)) {
    array_push($errors, "First name is required");
  }

  if (empty($lastName)) {
    array_push($errors, "Last name is required");
  }

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

  // Check if passwords repeat
  if ($password != $passwordRepeat) {
    array_push($errors, "Passwords must match");
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
    // And if email already exists within database
    if ($row['email'] === $email){
      // Add to error array
      array_push($errors, "Email already exists");
    }
  }

  // If there are no errors register the user
  if (count($errors) == 0){
    // Hash and salt the password BCRYPT algorithm
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    try {
      $dbconn->beginTransaction();
      // Insert new user into database
      $query = "INSERT INTO users(first_name,last_name,email,password_hash) VALUES(:firstName, :lastName,:email,:password)";
      $statement = $dbconn->prepare($query);
      $statement->bindParam(":firstName",$firstName);
      $statement->bindParam(":lastName",$lastName);
      $statement->bindParam(":email",$email);
      $statement->bindParam(":password",$passwordHash);
      $statement->execute();
      $dbconn->commit();

      echo "
        <script>
          alert('User created succesfully');
        </script>
      ";

      // Redirect to the search page
      header("Location: search.php");
    } catch(PDOException $e){
      $dbconn->rollback();
      die($e->getMessage());
    }
  } else {
    // Output errors
    foreach ($errors as $error){
      echo $error;
    }
  }

  // Clear errors
  unset($errors);

  // Close database connection
  $db->close();
}
?>

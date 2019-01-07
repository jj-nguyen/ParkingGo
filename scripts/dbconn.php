<?php
// Connect to database
function dbConnect() {

  // Database credentials
  $username  = 'admin';
  $password  = 'password';

  // Try to connect to the database
  try {
    // Connect to database
    $dbconn = new PDO('mysql:host=localhost;dbname=comp4ww3', $username, $password);

    // Set error handling
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    // If error exit
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }

  return $dbconn;
}

?>

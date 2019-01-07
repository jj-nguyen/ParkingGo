<?php


include_once('scripts/dbconn.php');

$errors = array();

// User must be logged in to submit a parking spot
if (isset($_POST['Submit-Parking']) &&  $_SESSION['isLogged']){

  $dbconn = dbConnect();

  // Grab parking submission fields
  $name =$_POST['Name'];
  $latitude = $_POST['Latitude'];
  $longitude =  $_POST['Longitude'];
  $price = $_POST['Price'];
  $picture = $_FILES['Picture'];
  $description = $_POST['Description'];


  echo "Got variables";

  // Server-side validation of fields
  // First check if empty, if not, check syntax.
  if (empty($name)) {
    array_push($errors, "Parking name is required");
  }

  if (empty($latitude)) {
    array_push($errors, "Latitude is required");
  } else {
    // Check proper syntax for latitude
    if (!preg_match('/^[+-]?\d+(\.\d+)?$/',$latitude)){
      array_push($errors,"Latitude is not a number");
    }
  }

  if (empty($longitude)) {
    array_push($errors, "Longitude is required");
  } else {
    // Check proper syntax for longitude
    if (!preg_match('/^[+-]?^\d+(\.\d+)?$/',$longitude)){
      array_push($errors,"longitude is not a number");
    }
  }

  if (empty($price)) {
    array_push($errors, "Price is required");
  } else {
    // Check proper syntax for price
    if (!preg_match('/^[0-9]+\.[0-9]{2}$|^[0-9]+$/',$price)){
      array_push($errors,"Price is not in the proper format");
    }
  }

  echo "Verified variables";

  // // Prepare statement to prevent SQL Injection
  $query = "SELECT * FROM parking WHERE parking_name = :name LIMIT 1";
  $statement = $dbconn->prepare($query);
  $statement->bindParam(":name",$name);
  $statement->execute();

  // Fetch data from database using query
  // Fetch gives back an array based on the query
  $row = $statement->fetch(PDO::FETCH_ASSOC);

  // If an existing parking spot is found
  if ($row) {
    array_push($errors, "Parking spot already exists");
  }

  echo "Executed existing parking spot query";

  // If there are no errors add new parking to database
  if (count($errors) == 0 ){
    try {
      echo "\n Inserting parking spot";
      $dbconn->beginTransaction();
      // Insert new parking spot into database
      $query = "INSERT INTO parking(parking_name,latitude,longitude,price,parking_description)
                VALUES(:parkingName,:latitude,:longitude,:price,:parkingDescription)";
      $statement = $dbconn->prepare($query);
      $statement->bindParam(":parkingName",$name);
      $statement->bindParam(":latitude",$latitude);
      $statement->bindParam(":longitude",$longitude);
      $statement->bindParam(":price",$price);
      $statement->bindParam(":parkingDescription",$parkingDescription);
      $statement->execute();
      $dbconn->commit();

      // If there exists a image file, upload to server
      if (!empty($picture)){
        $path = "img/";
        $path = $path . basename($picture['name']);

        if(move_uploaded_file($picture['tmpName'], $path)) {
            echo "The file ".  basename( $_FILES['uploaded_file']['name']).
            " has been uploaded";
        } else{
            echo "There was an error uploading the file, please try again!";
        }
      }

      // Redirect to the search page
      header("Location: search.php");

      echo "
        <script>
          alert('Parking spot created succesfully');
        </script>
      ";
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

}

 ?>

<?php

include_once('scripts/dbconn.php');

// Get parking based on ID
function getParking($parkingId) {
  try {

    // Connect to database;
    $dbconn = dbConnect();

    // Prepare statement to prevent SQL Injection
    $query = "SELECT * FROM parking WHERE parking_id = :id;  LIMIT 1";
    $statement = $dbconn->prepare($query);
    $statement->bindParam(":id",$parkingId);
    // Execute query
    $statement->execute();

    // Fetch data from database using query
    // Fetch gives back an array based on the query
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    // Close connection
    $dbconn = null;

    return $row;

  } catch (Exception $e){
    throw $e;
    die("Error in the query");
  }
}

// Search database for relevant parking spots
function getParkings($parkingName,$price,$rating,$latitude,$longitude){

  $first = TRUE;
  // Connect to database;
  $dbconn = dbConnect();
  $query = "Select * FROM parking WHERE";

  // Add parking name to query if isn't empty
  if (!empty($parkingName)){
    // Match substring of any name
    $parkingName = "%" . $parkingName . "%";
    if ($first == TRUE){
        $query .= " parking_name LIKE :parkingName";
        $first = False;
    } else {
      $query .= " AND parking_name LIKE :parkingName";
    }

  }

  // Add parking price to query if isn't empty
  if (!empty($price)){
    if ($first == TRUE){
        $query .= " price = :price";
        $first = False;
    } else {
      $query .= " AND price = :price";
    }
  }

  // Add rating to query if isn't empty
  if (!empty($rating)){
    if ($first == TRUE){
        $query .= " rating = :rating";
        $first = False;
    } else {
      $query .= " AND rating = :rating";
    }
  }

  // Add latitude to query if isn't empty
  if (!empty($latitude)){
      $latitude = $latitude . "%";
    if ($first == TRUE){
        $query .= " latitude LIKE :latitude";
        $first = False;
    } else {
      $query .= " AND latitude LIKE :latitude";
    }
  }

  // Add longitude to query if isn't empty
  if (!empty($longitude)){
    $longitude = $longitude . "%";
    if ($first == TRUE){
        $query .= " longitude LIKE :longitude";
        $first = False;
    } else {
      $query .= " AND longitude LIKE :longitude";
    }
  }

  // Prepare query and execute
  $statement = $dbconn->prepare($query);
  if (!empty($parkingName)){
    $statement->bindParam(':parkingName',$parkingName);
  }
  if (!empty($price)){
    $statement->bindParam(':price',$price);
  }
  if (!empty($rating)){
    $statement->bindParam(':rating',$rating);
  }
  if (!empty($latitude)){
    $statement->bindParam(':latitude',$latitude);
  }
  if (!empty($longitude)){
    $statement->bindParam(':longitude',$longitude);
  }

  $statement->execute();

  // Fetch data from database using query
  // Fetch gives back an array based on the query
  $row = $statement->fetchAll(PDO::FETCH_ASSOC);

  return $row;
}
?>

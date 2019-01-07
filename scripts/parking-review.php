<?php

include_once('scripts/dbconn.php');

$errors = array();

// Submit review
if (isset($_POST['Submit-Review'])){


  $rating = $_POST['Review-Rating'];
  $description = $_POST['Review-Description'];

  // Connect to database;
  $dbconn = dbConnect();

  try {
    $dbconn->beginTransaction();
    // Insert new user into database
    $query = "INSERT INTO reviews(parking_id,rating,review_description) VALUES(:parkingId,:rating,:description)";
    $statement = $dbconn->prepare($query);
    $statement->bindParam(":parkingId",$_SESSION['parkingId']);
    $statement->bindParam(":rating",$rating);
    $statement->bindParam(":description",$description);
    $statement->execute();
    $dbconn->commit();

    echo "
      <script>
        alert('Review created successfully');
      </script>
    ";

    // Redirect to the search page
    header("Location: search.php");
  } catch(PDOException $e){
    $dbconn->rollback();
    die($e->getMessage());
  }

}


// Get parking reviews
function getReviews($parkingId) {
  try {

    // Connect to database;
    $dbconn = dbConnect();

    // Prepare statement to prevent SQL Injection
    $query = "SELECT * FROM reviews WHERE parking_id = :id";
    $statement = $dbconn->prepare($query);
    $statement->bindParam(":id",$parkingId);
    // Execute query
    $statement->execute();

    // Fetch data from database using query
    // Fetch gives back an array based on the query
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Close connection
    $dbconn = null;

    return $row;

  } catch (Exception $e){
    throw $e;
    die("Error in the query");
  }
}
?>

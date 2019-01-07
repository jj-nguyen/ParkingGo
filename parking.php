
<?php
  session_start();
  include('scripts/parking-results.php');
  include('scripts/parking-review.php');

  // Grab parking information based on ID to populate page
  $_SESSION['parkingId'] = $_GET['id'];
  $row = getParking($_SESSION['parkingId']);
  $reviews = getReviews($_SESSION['parkingId']);

?>
<!DOCTYPE html>
<html>

  <head>
    <!-- Encoding -->
    <meta charset="utf-8">
    <title>Parking page</title>
    <!-- Viewports allow for dynamic design and sizes depending on the device-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link the style sheet -->
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>

  <body>

    <!-- Navigation menu -->
    <?php
      include('includes/header.php');
    ?>

    <div class="title-rating-container">
      <h1>
        <?php
        echo $row['parking_name'];
        ?>
      </h1>
      <h1 class="price-value">
        <?php
        echo "$". $row['price'];
        ?>
      </h1>
    </div>
    <h2 class="rating-container">Rating: <span class="rating-good">
      <?php echo $row['rating'] . "/5"; ?>
    </span></h2>
    <h2 class="location"> <?php echo"Latitude:" . $row['latitude']; ?> , <?php echo "Longitude:" . $row['longitude']; ?></h2>

    <hr />
    <!-- Calls "parking-img" and "center" classes for the parking image -->
    <img src="img/main.png" class="flexible center" alt="Parking image" />

    <hr />

    <h2>Parking Description</h2>
    <p class="flex-text">
      <?php
      echo $row['parking_description'];
      ?>
    </p>

    <hr>

    <h2>Reviews</h2>
    <?php
      // Populate reviews showing rating and description
      foreach($reviews as $review){
        echo "
        <div class='review-container'>
          <h3>" .$review['rating'] . "/5</h3>
          <p>
            " .$review['review_description'] . "
          </p>
        </div>
        ";
      }
    ?>
    <!--
    <div class="review-container">
      <h3 class="reviewer">FirstName LastName:</h3>
      <h3><span class="rating-okay">3/5 </span>Its alright!</h3>
      <p>
        Parking was a bit wonky
      </p>
    </div>

    <div class="review-container">
      <h3 class="reviewer">FirstName LastName:</h3>
      <h3><span class="rating-okay">3/5 </span> Meh</h3>

    </div>
  -->
    <?php
      // Allow the user to write a review if the user is logged in
      if ($_SESSION['isLogged']){
        echo "
        <form id='review-form' method='post'>
            <label for='rating' class='center'> Rating </label>
            <input class ='form-item center' type='number' Name='Review-Rating' id='review-rating' placeholder='Enter Rating 0-5' min='0' max='5' required/>

            <label for='description' class='center'>Description</label>
            <textarea class='form-item center' rows='4' cols='50' placeholder='Enter description' name='Review-Description' id='review-description' form='review-form'></textarea>

            <button type='submit' class='form-item center' name='Submit-Review'>Submit Parking Review</button>
        </form>
        ";
      }
    ?>
  </body>

</html>

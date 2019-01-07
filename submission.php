<?php
  session_start();

  // Submit parking php script
  include("scripts/parking-submission.php");

 ?>
<!DOCTYPE html>
<html>

  <head>
    <!-- Encoding -->
    <meta charset="utf-8">
    <title>Submission Page</title>
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
      include("includes/header.php");
    ?>

    <!-- Submission form -->
    <!-- Elements are centered-->
    <form id="submission" method="post" onsubmit="return validateParkingSubForm(submission)">

      <label for="name" class="center">Name</label>
      <input type="text" class="form-item center" placeholder="Enter Parking Name" name="Name" id="name" required>

      <label for="latitude" class="center">Latitude</label>
      <input type="number" step="any" class="form-item center" placeholder="Enter Latitude" name="Latitude" id="latitude" required>

      <label for="longitude" class="center">Longitude</label>
      <input type="number" step="any" class="form-item center" placeholder="Enter Longitude" name="Longitude" id="longitude" required>

      <label for="price" class="center"> Price </label>
      <input type="number" step="0.01" class="form-item center" name="Price" id="price" placeholder="Enter Price ($)" required>

      <label for="picture" class="center">Pictures</label>
      <input type="file" class="form-item file-upload center" name="Picture" id="picture" accept="image/*">

      <label for="description" class="center">Description</label>
      <textarea class="form-item center" rows="4" cols="50" placeholder="Enter description" name="Description" id="description" form="submission"></textarea>

      <button type="submit" class="form-item center" name="Submit-Parking">Submit Parking Spot</button>

    </form>

  </body>

</html>

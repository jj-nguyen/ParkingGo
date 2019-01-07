<?php
session_start();
?>
<!DOCTYPE html>
<html>

  <head>
    <!-- Encoding -->
    <meta charset="utf-8">
    <title>Search page</title>
    <!-- Viewports allow for dynamic design and sizes depending on the device-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link the style sheet -->
    <link href="style.css" rel="stylesheet" type="text/css" />
    <!-- Link to javascript file for form verification -->
    <script type="text/javascript" src="validate-form.js"> </script>
    <script type="text/javascript" src="google-maps.js"> </script>
  </head>

  <body>

    <!-- Navigation menu -->
    <?php
      include('includes/header.php');
    ?>

    <!-- Search form -->
    <!-- Elements are centered-->
    <form id="search" action ="results.php" method="get" onsubmit="return validateSearchForm(search)">

      <label for=" parking-name" class="center">Name </label>
      <input type="text" class="form-item center" name="Parking-Name" id="parking-name" placeholder="Enter Name">

      <label for="distance" class="center"> Distance </label>
      <input type="number" step="any" class="form-item center" name="Distance" id="distance" placeholder=" Enter Distance (km)">

      <label for="latitude" class="center"> Latitude </label>
      <input type="number" step="any" class="form-item center" name="Latitude" id="latitude" placeholder=" Enter Distance (km)">

      <label for="longitude" class="center"> Longitude </label>
      <input type="number" step="any" class="form-item center" name="Longitude" id="longitude" placeholder=" Enter Distance (km)">

      <!-- step="any" allows for any float or integer number
       step="0.01" allows for floats with steps of 0.01 -->
      <label for="price" class="center"> Price </label>
      <input type="number" step="0.01" class="form-item center" name="Price" id="price" placeholder="Enter Price ($)">

      <label for="rating" class="center"> Rating </label>
      <input type="number" class="form-item center" name="Rating" id="rating" placeholder="Enter Rating 0-5" min="0" max="5">

      <input type="button" class="form-item center button" value="Use current location" onclick="return getLocation()" name="User Location" id="user-location">
      <input type="submit" class="form-item center" id="search-id" value="Search">

    </form>

  </body>

</html>

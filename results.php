<?php

session_start();

// Parking results php script
include('scripts/parking-results.php');

$row = getParkings($_GET['Parking-Name'],$_GET['Price'],$_GET['Rating'],$_GET['Latitude'],$_GET['Longitude']);

$jsonRow = json_encode($row);

?>
<!DOCTYPE html>
<html>

  <head>
    <!-- Encoding -->
    <meta charset="utf-8">
    <title>Results page</title>
    <!-- Viewports allow for dynamic design and sizes depending on the device-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link the style sheet -->
    <link href="style.css" rel="stylesheet" type="text/css" />
    <!-- Google map javascripts -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGSPLUeIQq8VKZUD9dkXDGYwA7ggOhPJU&callback=initMap"></script>
    <script type=text/javascript src="google-maps.js"></script>
  </head>

  <body>

    <!-- Navigation menu -->
    <?php
      include('includes/header.php');
    ?>

    <!-- div element for map -->
    <div id="map" class="center"></div>

    <!-- Results Table -->
    <!-- Elements are centered-->
    <table class="center">
      <caption>
        Search results:
      </caption>
      <!-- Table Contains the Name, Location, Rating and Price of the parking spot -->
      <thead>
        <tr>
          <th>
            Name
          </th>
          <th>
            Location
          </th>
          <th>
            Rating
          </th>
          <th>
            Price
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Generate results
          // Each parking has a name, latitude and longitude, rating, and price
          foreach($row as $parkingSpot){
            echo "<tr>";
            echo "<td>";
            echo "<a href=parking.php?id=" . $parkingSpot['parking_id'] . ">" . $parkingSpot['parking_name'] . "</a>";
            echo "</td>";
            echo "<td>";
            echo "<a href=parking.php?id=" . $parkingSpot['parking_id'] . ">" . $parkingSpot['latitude'] . "," . $parkingSpot['longitude'] . "</a>";
            echo "</td>";
            echo "<td>";
            echo "<a href=parking.php?id=" . $parkingSpot['parking_id'] . ">" . $parkingSpot['rating'] . "</a>";
            echo "</td>";
            echo "<td>";
            echo "<a href=parking.php?id=" . $parkingSpot['parking_id'] . ">" . $parkingSpot['price'] . "</a>";
            echo "</td>";
            echo "</tr>";
          }
         ?>
      </tbody>
    </table>
  </body>

</html>

// Google Maps
// Map requires you to consent to location sharing when prompted by browser
// Google maps api key: AIzaSyAGSPLUeIQq8VKZUD9dkXDGYwA7ggOhPJU

var nightStyle = [
        {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
        {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
        {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
        {
          featureType: 'administrative.locality',
          elementType: 'labels.text.fill',
          stylers: [{color: '#d59563'}]
        },
        {
          featureType: 'poi',
          elementType: 'labels.text.fill',
          stylers: [{color: '#d59563'}]
        },
        {
          featureType: 'poi.park',
          elementType: 'geometry',
          stylers: [{color: '#263c3f'}]
        },
        {
          featureType: 'poi.park',
          elementType: 'labels.text.fill',
          stylers: [{color: '#6b9a76'}]
        },
        {
          featureType: 'road',
          elementType: 'geometry',
          stylers: [{color: '#38414e'}]
        },
        {
          featureType: 'road',
          elementType: 'geometry.stroke',
          stylers: [{color: '#212a37'}]
        },
        {
          featureType: 'road',
          elementType: 'labels.text.fill',
          stylers: [{color: '#9ca5b3'}]
        },
        {
          featureType: 'road.highway',
          elementType: 'geometry',
          stylers: [{color: '#746855'}]
        },
        {
          featureType: 'road.highway',
          elementType: 'geometry.stroke',
          stylers: [{color: '#1f2835'}]
        },
        {
          featureType: 'road.highway',
          elementType: 'labels.text.fill',
          stylers: [{color: '#f3d19c'}]
        },
        {
          featureType: 'transit',
          elementType: 'geometry',
          stylers: [{color: '#2f3948'}]
        },
        {
          featureType: 'transit.station',
          elementType: 'labels.text.fill',
          stylers: [{color: '#d59563'}]
        },
        {
          featureType: 'water',
          elementType: 'geometry',
          stylers: [{color: '#17263c'}]
        },
        {
          featureType: 'water',
          elementType: 'labels.text.fill',
          stylers: [{color: '#515c6d'}]
        },
        {
          featureType: 'water',
          elementType: 'labels.text.stroke',
          stylers: [{color: '#17263c'}]
        }
      ];
var map;

// Initializes map
function initMap(){

  // Default location is McMaster University if browser does not allow geolocation
  // Default is styled in Night mode
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 43.2620, lng:-79.92},
    zoom: 6,
    styles: nightStyle
  });

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position){
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      map.setCenter(pos);
      map.setZoom(14);
    })
  } else {
    // Browser doesn't support geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }



  // Add hard coded marker for parking location which is at McMaster University
  // var marker = new google.maps.Marker({
  //         map: map,
  //         draggable: false,
  //         animation: google.maps.Animation.DROP,
  //         position: {lat: 43.2620, lng: -79.92},
  //         title: "Good Parking"
  // });
  //
  // // Description of marker
  // var contentString = '<body>' +
  //     '<h1><a href="parking_good.html">Good Parking</a></h1>' +
  //     '<h2> Rating: 5/5 <h2>'+
  //     'This is the best parking spot ever' +
  //     '</body>';
  //
  // // Create info window with content string
  // var infoWindow = new google.maps.InfoWindow({
  //   content: contentString
  // });
  //
  // // Add a listener for mouse clicks on the marker
  // marker.addListener('click', function(){
  //   // Opens up an info window about the parking spot marker once clicked
  //   infoWindow.open(map, marker);
  // });
}

// Updates current map position
function updateMapPosition(latitude,longitude){
  var pos = {
    lat: latitude,
    lng: longitude
  }
  map.setCenter(pos);
  map.setZoom(14);
}

// location error handler function
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
  infoWindow.open(map);
}

// Toggles marker bounce animation
function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

// Add marker to map
function addMarker(location,map) {
  var marker = new google.maps.Marker({
    position: location,
    title: 'Home Center',
  });
  marker.setMap(map);
}

// Add many markers
function addMarkers(parkings){

}

// Grab current Location
function getLocation(){
    // If successful, get user position.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(getPositionSuccess);
    // Else say that geolocation is not allowed
    } else {
      alert("Geolocation is not supported by this browser");
    }
}

// Display latitude and longitude
function getPositionSuccess(position) {
  var lat = position.coords.latitude;
  var lng = position.coords.longitude;

  // Show user coordinates on user-location button
  var button = document.getElementById("user-location")
  button.value= "Latitude:" + lat + " \nLongitude:" + lng;
  button.style.color = "#d4e7c2";

}

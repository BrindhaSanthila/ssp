<?php
error_reporting(0);
ob_start();
session_start(); 

 
include('../inc/dbConnect.php');
include('../inc/commonfunction.php');


	  $latitudes=$_GET['latitude'];
	  $longitudes=$_GET['longitude'];
	  $company_names="ROYAL CRM";
		?>

<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    
    <title><?php echo $company_names; ?> MAP</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      function initMap() {
      	//alert("map Calling");
        var coords = {lat: <?php echo $latitudes; ?>, lng: <?php echo $longitudes; ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: coords
        });

        var contentString = '<div id="content">'+
            '<p id="firstHeading"><b><?php echo $company_names; ?></b></p>'+
            '<div id="bodyContent">'+
            '<p><?php echo $bill_addresss; ?></p>'+
            '</div>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        var marker = new google.maps.Marker({
          position: coords,
          map: map,
          title: '<?php echo $company_names; ?>'
        });
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
      }
    </script>
     <script async defer src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyC9Mm_hk5x71uiIussqM2DLYCOhDlWYQls&callback=initMap">
</script>
    </body>
</html>
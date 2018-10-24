<?php

//$P=$_POST['Parametro'];
/*
$Origenlat=$_POST["origenla"];
$Origenlong=$_POST["origenlo"];
$destinolat=$_POST["destinola"];
$destinolong=$_POST["destinolo"];
*/

$Origenlat="4.5919617";
$Origenlong="-74.1268185";
$destinolat="4.6425977";
$destinolong="-74.1617739";

    $response = array();
    $P=$_POST['Parametro'];
        $response["receive"] = array();
            $dato = array();
            $dato["DATO1"] = "hola";
            array_push($response["receive"], $dato);
        
        $response["success"] = 1;
        $R=$_POST["totaldis"];
        


?>
<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    html, body { height: 100%; margin: 0; padding: 0; }
    #map { height: 100%; }
</style>
</head>
<body>


<form id="formdistancia" name="formdistancia" method="post" action="Lista_distancia.php">
<input type="text" name="totaldis" id="totaldis">
<input type="submit" value="enviar">
</form>
  <div id="map"></div>
  <script type="text/javascript">
var totalDistance = 0;
    var map;
    function initMap() {

      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 4.666348, lng: -74.0855769},
        zoom: 14
    });
      var myLatLng = {lat: <?php echo $Origenlat;?>, lng: <?php echo $Origenlong;?>};
      //var myLatLng = {lat: 4.6425977, lng: -74.1617739};
      var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Origen'
    });

      var myLatLng2 = {lat: <?php echo $destinolat;?>, lng: <?php echo $destinolong;?>};
      var marker2 = new google.maps.Marker({
        position: myLatLng2,
        map: map,
        title: 'Destino'
    });

      var directionsDisplay = new google.maps.DirectionsRenderer({
        map: map
    });

        // Set destination, origin and travel mode.
        var request = {
          destination: myLatLng2,
          origin: myLatLng,
          travelMode: 'DRIVING'
      };

        // Pass the directions request to the directions service.
        var directionsService = new google.maps.DirectionsService();
        directionsService.route(request, function(response, status) {
          if (status == 'OK') {
            // Display the route on the map.
            directionsDisplay.setDirections(response);

            
            var totalDuration = 0;
            var legs = response.routes[0].legs;
            for(var i=0; i<legs.length; ++i) {
              totalDistance += legs[i].distance.value;
              totalDuration += legs[i].duration.value;
          }
          totalDistance=totalDistance/1000;
          alert(totalDistance);
        document.getElementById("totaldis").value = totalDistance;
        document.getElementById('formdistancia').submit();
        <?php
        
        $response["message"] = "No se encontrasron dato4 <script>document.write(totaldis)</script> s";
        echo json_encode($response);
        ?>
      }
  });



    }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4SahdlkwrVh8WVIEZ6F-GaJmmdFfLMeM&callback=initMap">
</script>
</body>
</html>

<?php


          
?>
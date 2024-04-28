<!DOCTYPE html>
<html>
<head>
<title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_step2.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_side.css">   
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- //routing css -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <!-- search -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <style>
        body{
            margin: 0;
            padding: 0;
        }
       
    </style>
</head>
<body id="body">
   <?php include 'ride_side.php'; ?>
<!-- ---------------------------------------------------------------------------------- -->
<div class="activity">
        <div class="box">
            <div class="contant" >
                <a href="<?=ROOT?>/customer/ride_step1"><i class="fa-solid fa-circle-left fa-fade" id="back"></i></a>
                <center>
                    <img src="<?= ROOT ?>/assets/img/customer/gif.gif" alt="">
                    <h2>Select the alternative path <br>
                    click the map</h2>
                   
                    <form method="POST">
                        <a href="<?=ROOT?>/customer/ride_step3" class="golink"><button class="go" id="sizeButton">Go</button></a><br>
                        <input type="text" id="time" name="time" class="fetch_data">
                        <input type="text" id="distance" name="distance" class="fetch_data">
                        <input type="text" id="m_lat" name="m_lat" class="fetch_data">
                        <input type="text" id="m_long" name="m_long" class="fetch_data">
                    </form>
                    <a href="#" class="refresh" onclick="refreshPage()">Refresh</a>

                </center>
                
                
            </div>
            <div id="map" > </div>
        </div>
    </div>       
    <div class="toggleicon" id="toggleSidebar" onclick="side_open()">
             <i class="fa-solid fa-bars"></i>
      </div>
      <script>
        function side_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.querySelector('.activity').style.opacity= '0.5';
        }

        function side_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.querySelector('.activity').style.opacity= '1';
        }
        
      </script>
    </body>

</html>
<script>
    // button movment
    function toggleBeat() {
    var button = document.getElementById("sizeButton");
    button.classList.toggle("beating");
   }

   function refreshPage() {
    location.reload(true);
  }
</script>


<!-- leaflet js code -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
 <!-- routing js file -->
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<!-- search -->
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
           
    // map instalizion
    var map = L.map('map').setView([ 7.8774, 80.7003], 9);
    // google street
    googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        });
    googleStreets.addTo(map)

    var marker = null;
    var lat3=0;
    var long3=0;
    var onetime =0;


//------------------------------------------------------------------------


    map.on('click', function(e) {
        if (marker !== null) {
            map.removeLayer(marker);
        }
    if(onetime==0){
        onetime=1;
        lat3 = e.latlng.lat;
        long3 = e.latlng.lng;
        marker = L.marker(e.latlng).addTo(map);
      
        document.getElementById('m_lat').value=lat3;
        document.getElementById('m_long').value=long3;

    var Routing;
    var lat=<?php echo isset($_GET['l_lat']) ? json_encode($_GET['l_lat']) : 'null'; ?>;
    var long=<?php echo isset($_GET['l_long']) ? json_encode($_GET['l_long']) : 'null'; ?>;
    var lat1=<?php echo isset($_GET['d_lat']) ? json_encode($_GET['d_lat']) : 'null'; ?>;
    var lon1=<?php echo isset($_GET['d_long']) ? json_encode($_GET['d_long']) : 'null'; ?>;
    Routing = L.Routing.control({
        waypoints: [
            L.latLng(lat,long),
            L.latLng(lat3,long3),
            L.latLng(lat1,lon1)
           
        ],routeWhileDragging: true
      
    }); 
    


 Routing.on('routesfound', function(e) {
    var route = e.routes[0];
    var distance = route.summary.totalDistance; // Distance in meters
    var time = route.summary.totalTime; // Time in seconds


    document.getElementById("time").value='0'+Math.floor(time/3600) + ':'+Math.floor((time%3600)/60);
    document.getElementById("distance").value=(distance/1000).toFixed(2);
    
});

    Routing.addTo(map);
    const popupElement = document.getElementsByClassName('leaflet-routing-container leaflet-bar leaflet-routing-collapsible leaflet-control')[1];
    popupElement.classList.add('leaflet-routing-container-hide');

    var lat2=(lat1+lat)/2
    var lon2=(lon1+long)/2
    map.flyTo([lat2,lon2], 14)
    
    
    
    }
});




// -------------------------------------------------------------------------------------------------------

if(lat3==0 && long3==0){
    var Routing;
    var lat=<?php echo isset($_GET['l_lat']) ? json_encode($_GET['l_lat']) : 'null'; ?>;
    var long=<?php echo isset($_GET['l_long']) ? json_encode($_GET['l_long']) : 'null'; ?>;
    var lat1=<?php echo isset($_GET['d_lat']) ? json_encode($_GET['d_lat']) : 'null'; ?>;
    var lon1=<?php echo isset($_GET['d_long']) ? json_encode($_GET['d_long']) : 'null'; ?>;
    Routing = L.Routing.control({
        waypoints: [
            L.latLng(lat,long),
            L.latLng(lat1,lon1)
        ],  lineOptions: {
        styles: [{color: 'black', opacity: 0.6, weight: 4}]
    }
    }); 

    

 Routing.on('routesfound', function(e) {
    var route = e.routes[0];
    var distance = route.summary.totalDistance; // Distance in meters
    var time = route.summary.totalTime; // Time in seconds


    document.getElementById("time").value='0'+Math.floor(time/3600) + ':'+Math.floor((time%3600)/60);
    document.getElementById("distance").value=(distance/1000).toFixed(2);
    
});

    Routing.addTo(map);
    const popupElement = document.getElementsByClassName('leaflet-routing-container leaflet-bar leaflet-routing-collapsible leaflet-control')[0];
    popupElement.classList.add('leaflet-routing-container-hide');
    
    var lat2=(lat1+lat)/2
    var lon2=(lon1+long)/2
    map.flyTo([lat2,lon2], 14)
    
}
   
     
    </script>
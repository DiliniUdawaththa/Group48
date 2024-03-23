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
        #map{
            width: 50%;
            height: 90vh;
        }
    </style>
</head>
<body id="body">
   <div class="topbar" id="topbar">
      <div class="topbarin">
         <div>
            <i class="fa-solid fa-bars" onclick="openNav()" id="menu"></i>
            <img src="<?= ROOT ?>/assets/img/logo_name.png" alt="">
         </div>
         <div><img src="<?= ROOT ?>/assets/img/person.jpg" alt="" class="person"></div>
   </div>

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
                   
                    <a href="<?=ROOT?>/customer/ride_step3" class="golink"><button class="go" id="sizeButton">Go</button></a><br>
                    <a href="<?=ROOT?>/customer/ride_step2" class="refresh">Refresh</a>

                </center>
                
                
            </div>
            <div id="map" > </div>
        </div>
    </div>       
        
    </body>
</html>
<script>
    // button movment
    function toggleBeat() {
    var button = document.getElementById("sizeButton");
    button.classList.toggle("beating");
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

    var Routing;
    var lat=6.901963
    var long=80.861292
    var lat1=6.901963
    var lon1=79.861292
    Routing = L.Routing.control({
        waypoints: [
            L.latLng(lat,long),
            L.latLng(lat1,lon1)
        ]
    });

    Routing.addTo(map);
    var lat2=(lat1+lat)/2
    var lon2=(lon1+long)/2
    map.flyTo([lat2,lon2], 14)
    const popupElement = document.getElementsByClassName('leaflet-routing-container leaflet-bar leaflet-routing-collapsible leaflet-control')[0];
    popupElement.classList.add('leaflet-routing-container-hide');
   
           
        
    </script>
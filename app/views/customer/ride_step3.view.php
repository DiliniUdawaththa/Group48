<!DOCTYPE html>
<html>
<head>
<title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_step3.css">
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
        <div class="mainbox">
            <div class="contant" >
                <a href="<?=ROOT?>/customer/ride_step1"><i class="fa-solid fa-circle-left fa-fade" id="back"></i></a>
                <center>
                    
                    <h2>Select the Vehicle</h2>
                    <div class="box_row">

                        <div class="box" id="box1" onclick="highlightBox('box1','select1')" >
                            <img src="<?= ROOT ?>/assets/img/customer/c1.png" alt="">
                            <div class="ctext">
                               <span>Moto</span>
                               <span><b>$157.00</b></span>
                               <span class="no_user"><b>1</b><i class="fa-solid fa-user-group"></i></i></span>
                               <span class="select" id="select1"><i class="fa-solid fa-circle-check" style="color: #2ce86e;"></i></span>
                            </div>
                        </div>

                        <div class="box" id="box2" onclick="highlightBox('box2','select2')">
                            <img src="<?= ROOT ?>/assets/img/customer/c2.jpeg" alt="">
                            <div class="ctext">
                              <span>Auto</span>
                              <span><b>$200.00</b></span>
                              <span class="no_user"><b>3</b><i class="fa-solid fa-user-group"></i></i></span>
                              <span class="select" id="select2"><i class="fa-solid fa-circle-check" style="color: #2ce86e;"></i></span>
                           </div>
                        </div>

                    </div>

                    <div class="box_row">

                        <div class="box" id="box3" onclick="highlightBox('box3','select3')">
                            <img src="<?= ROOT ?>/assets/img/customer/c3.png" alt="">
                            <div class="ctext">
                                <span>Car</span>
                                <span><b>$220.00</b></span>
                                <span class="no_user"><b>4</b><i class="fa-solid fa-user-group"></i></i></span>
                                <span class="select" id="select3"><i class="fa-solid fa-circle-check" style="color: #2ce86e;"></i></span>
                            </div>
                        </div>

                        <div class="box" id="box4" onclick="highlightBox('box4','select4')">
                            <img src="<?= ROOT ?>/assets/img/customer/c3.png" alt="">
                            <div class="ctext">
                                <span>AC-Car</span>
                                <span><b>$250.00</b></span>
                                <span class="no_user"><b>4</b><i class="fa-solid fa-user-group"></i></i></span>
                                <span class="select" id="select4"><i class="fa-solid fa-circle-check" style="color: #2ce86e;"></i></span>
                            </div>
                        </div>

                    </div>
                    <form action="" method="POST">
                   <input type="text" name="vehicle" id="vehicle" value="" >
                    <a href="<?=ROOT?>/customer/ride_step4" class="golink"><button class="go" id="sizeButton">Go</button></a><br>
                    </form>
                   
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

<script>
    // box click
    var markers=[];
    function highlightBox(boxId,selectId) {
        // Remove border from all boxes
        var boxes = document.querySelectorAll('.box');
        var selects = document.querySelectorAll('.select');
        boxes.forEach(function(box) {
            box.classList.remove('highlighted');
        });
        selects.forEach(function(select) {
            select.style.display="none";
        });
        
        // Add border to the clicked box
        var box = document.getElementById(boxId);
        var select = document.getElementById(selectId);
        box.classList.add('highlighted');
        select.style.display='block';
        
        // Show the button container
        var buttonContainer = document.getElementById('sizeButton');
        buttonContainer.style.display = 'block';


       // ---------------------------------------------------------------------------------------------------------------
        var newLat=<?php echo isset($_GET['l_lat']) ? json_encode($_GET['l_lat']) : 'null'; ?>;
        var newLng=<?php echo isset($_GET['l_long']) ? json_encode($_GET['l_long']) : 'null'; ?>;
        map.flyTo([lat,long], 15)
        deleteAllMarkers();
       //bike ----------------------------------------------------------------------------------------------------------------
        if(boxId=="box1"){
            var taxi = L.icon({
                iconUrl : '<?= ROOT ?>/assets/img/customer/bike.png',
                iconSize:[30,30]
            })
            
            coords=[[ 6.903528493716559,79.86255888285733],[6.90578774905135,79.85891096002354],[6.90259068644725,79.85790241665184],[ 6.908217502180756,79.85777366643418]]
            let l =coords.length;
            if(markers.length!=0){
            
            }
            for(let i=0; i<l; i++){
                // console.log('Marker position updated to:', [newLat, newLng]);
                var x = (coords[i][0]-newLat)*(coords[i][0]-newLat)
                var y =(coords[i][1]-newLng)*(coords[i][1]-newLng)
                var z = x+y;
                var x1 = (6.906064826793089-6.901963)*(6.906064826793089-6.901963)
                var y1 =(79.8586320012186-79.861292)*(79.8586320012186-79.861292)
                var z1 = x1+y1;
                var marker1 = L.marker(coords[i],{icon : taxi})
                if(z<3*z1){
                    marker1.addTo(map)
                    markers.push(marker1);
                }
        
            }
            document.getElementById("vehicle").value='bike';
        }
    // auto ---------------------------------------------------------------------------------------------------------------------------------        
        else if(boxId=='box2')
        {
            var taxi = L.icon({
                iconUrl : '<?= ROOT ?>/assets/img/customer/auto.png',
                iconSize:[50,30]
            })
            
            coords=[[ 6.90002849379999,79.86005888288888],[6.90178774900000,79.85791096000000],[6.90859068644444,79.8529024166666],[ 6.90621750218888,79.8507736664444]]
            let l =coords.length;
            if(markers.length!=0){
            
            }
            for(let i=0; i<l; i++){
                // console.log('Marker position updated to:', [newLat, newLng]);
                var x = (coords[i][0]-newLat)*(coords[i][0]-newLat)
                var y =(coords[i][1]-newLng)*(coords[i][1]-newLng)
                var z = x+y;
                var x1 = (6.906064826793089-6.901963)*(6.906064826793089-6.901963)
                var y1 =(79.8586320012186-79.861292)*(79.8586320012186-79.861292)
                var z1 = x1+y1;
                var marker1 = L.marker(coords[i],{icon : taxi})
                if(z<5*z1){
                    marker1.addTo(map)
                    markers.push(marker1);
                }
        
            }
            document.getElementById("vehicle").value='auto';
        }
// car---------------------------------------------------------------------------------------------------------------------------------
        else if(boxId == 'box3') {
            var taxi = L.icon({
                iconUrl : '<?= ROOT ?>/assets/img/customer/taxi.png',
                iconSize:[50,30]
            })
            
            coords=[[ 6.905,79.865],[6.906,79.854],[6.902,79.855],[ 6.905,79.858]]
            let l =coords.length;
            if(markers.length!=0){
            
            }
            for(let i=0; i<l; i++){
                // console.log('Marker position updated to:', [newLat, newLng]);
                var x = (coords[i][0]-newLat)*(coords[i][0]-newLat)
                var y =(coords[i][1]-newLng)*(coords[i][1]-newLng)
                var z = x+y;
                var x1 = (6.906064826793089-6.901963)*(6.906064826793089-6.901963)
                var y1 =(79.8586320012186-79.861292)*(79.8586320012186-79.861292)
                var z1 = x1+y1;
                var marker1 = L.marker(coords[i],{icon : taxi})
                if(z<5*z1){
                    marker1.addTo(map)
                    markers.push(marker1);
                }
        
            }
            document.getElementById("vehicle").value='car';
        }
//-Ac-car-----------------------------------------------------------------------------------------------------------------------------------
        else if(boxId == 'box4') {
            var taxi = L.icon({
                iconUrl : '<?= ROOT ?>/assets/img/customer/taxi.png',
                iconSize:[50,30]
            })
            
            coords=[[ 6.903,79.862],[6.905,79.858],[6.902,79.857],[ 6.908,79.857]]
            let l =coords.length;
            if(markers.length!=0){
            
            }
            for(let i=0; i<l; i++){
                // console.log('Marker position updated to:', [newLat, newLng]);
                var x = (coords[i][0]-newLat)*(coords[i][0]-newLat)
                var y =(coords[i][1]-newLng)*(coords[i][1]-newLng)
                var z = x+y;
                var x1 = (6.906064826793089-6.901963)*(6.906064826793089-6.901963)
                var y1 =(79.8586320012186-79.861292)*(79.8586320012186-79.861292)
                var z1 = x1+y1;
                var marker1 = L.marker(coords[i],{icon : taxi})
                if(z<3*z1){
                    marker1.addTo(map)
                    markers.push(marker1);
                }
        
            }
            document.getElementById("vehicle").value='Ac-car';
        }
//--------------------------------------------------------------------------------------------------------------------------------
        function deleteAllMarkers() {
            for (var i = 0; i < markers.length; i++) {
                map.removeLayer(markers[i]); // Remove each marker from the map
            }
            markers = [];}
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
    var lat=<?php echo isset($_GET['l_lat']) ? json_encode($_GET['l_lat']) : 'null'; ?>;
    var long=<?php echo isset($_GET['l_long']) ? json_encode($_GET['l_long']) : 'null'; ?>;
    var lat1=<?php echo isset($_GET['d_lat']) ? json_encode($_GET['d_lat']) : 'null'; ?>;
    var lon1=<?php echo isset($_GET['d_long']) ? json_encode($_GET['d_long']) : 'null'; ?>;
    Routing = L.Routing.control({
        waypoints: [
            L.latLng(lat,long),
            L.latLng(lat1,lon1)
        ]
    });

    Routing.addTo(map);
    const popupElement = document.getElementsByClassName('leaflet-routing-container leaflet-bar leaflet-routing-collapsible leaflet-control')[0];
    popupElement.classList.add('leaflet-routing-container-hide');
   
           
        
    </script>
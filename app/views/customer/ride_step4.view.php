<!DOCTYPE html>
<html>
<head>
<title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_step4.css">
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
                    
                    <h2>Select the Driver</h2>
                   
                    <div class="driverlist" id="list1" onclick="highlightBox('list1')">
                        <div class="imgstar"><img src="<?= ROOT ?>/assets/img/customer/person.jpg" alt="">
                           <span>
                              <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                              <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                              <i class="fa-solid fa-star" style="color: #D9D9D9;"></i>
                              <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                              <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                           </span></div>
                        <div class="name">Mr.S.Makesh</div>
                        <div class="fare">Fare<br><b>500/-</b></div>
                        <div class="nrbutton">
                           <button class="Negotiate">Negotiate</button>
                           <button class="Request">Select</button>
                        </div>
                      </div>

                      <div class="driverlist" id="list2" onclick="highlightBox('list2')">
                        <div class="imgstar"><img src="<?= ROOT ?>/assets/img/customer/person.jpg" alt="">
                           <span>
                              <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                              <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                              <i class="fa-solid fa-star" style="color: #D9D9D9;"></i>
                              <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                              <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                           </span></div>
                        <div class="name">Mr.S.Makesh</div>
                        <div class="fare">Fare<br><b>500/-</b></div>
                        <div class="nrbutton">
                           <button class="Negotiate">Negotiate</button>
                           <button class="Request">Select</button>
                        </div>
                      </div>

                      <div class="driverlist" id="list3" onclick="highlightBox('list3')">
                        <div class="imgstar"><img src="<?= ROOT ?>/assets/img/customer/person.jpg" alt="">
                           <span>
                              <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                              <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                              <i class="fa-solid fa-star" style="color: #D9D9D9;"></i>
                              <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                              <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                           </span></div>
                        <div class="name">Mr.S.Makesh</div>
                        <div class="fare">Fare<br><b>500/-</b></div>
                        <div class="nrbutton">
                           <button class="Negotiate">Negotiate</button>
                           <button class="Request">Select</button>
                        </div>
                      </div>

                      <div class="driverlist" id="list4" onclick="highlightBox('list4')">
                        <div class="imgstar"><img src="<?= ROOT ?>/assets/img/customer/person.jpg" alt="">
                           <span>
                              <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                              <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                              <i class="fa-solid fa-star" style="color: #D9D9D9;"></i>
                              <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                              <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                           </span></div>
                        <div class="name">Mr.S.Makesh</div>
                        <div class="fare">Fare<br><b>500/-</b></div>
                        <div class="nrbutton">
                           <button class="Negotiate">Negotiate</button>
                           <button class="Request">Select</button>
                        </div>
                      </div>
                      <form action="" method="POST">
                   <!-- <input type="text" value='' name='Driver_Id' id='Driver_Id'> -->
                    <a href="<?=ROOT?>/customer/ride_step5" class="golink"><button class="go" id="sizeButton">Go</button></a><br>
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
  
    function highlightBox(listId) {
        // Remove border from all boxes
        var lists = document.querySelectorAll('.driverlist');
        lists.forEach(function(list) {
            list.classList.remove('highlighted');
        });
        
        // Add border to the clicked box
        var list = document.getElementById(listId);
        list.classList.add('highlighted');
        
        // Show the button container
        var buttonContainer = document.getElementById('sizeButton');
        buttonContainer.style.display = 'block';

        if(listId=="list1"){
            map.flyTo([ 6.903528493716559,79.86255888285733], 16)
            var myIcon = L.icon({
                iconUrl: '<?= ROOT ?>/assets/img/customer/dod.png',
                iconSize: [38, 38]
              });
              var singlemarker=L.marker([6.903528493716559,79.86255888285733],{icon: myIcon}).addTo(map); 
              var contant = "<img src='<?= ROOT ?>/assets/img/customer/person.jpg' alt='Your Image' style='width: 100px; height: auto;'><br><b>Hello world!</b><br>This is a popup.";
             var popup = singlemarker.bindPopup(contant)
              singlemarker.openPopup();

        }else  if(listId=="list2"){
            map.flyTo([6.90578774905135,79.85891096002354], 16)
            var myIcon = L.icon({
                iconUrl: '<?= ROOT ?>/assets/img/customer/dod.png',
                iconSize: [38, 38]
              });
              var singlemarker=L.marker([6.90578774905135,79.85891096002354],{icon: myIcon}).addTo(map); 
              var contant = "<img src='<?= ROOT ?>/assets/img/customer/person.jpg' alt='Your Image' style='width: 100px; height: auto;'><br><b>Hello world!</b><br>This is a popup.";
             var popup = singlemarker.bindPopup(contant)
              singlemarker.openPopup();

        } else  if(listId=="list3"){
            map.flyTo([6.90259068644725,79.85790241665184], 16)
            var myIcon = L.icon({
                iconUrl: '<?= ROOT ?>/assets/img/customer/dod.png',
                iconSize: [38, 38]
              });
              var singlemarker=L.marker([6.90259068644725,79.85790241665184],{icon: myIcon}).addTo(map); 
              var contant = "<img src='<?= ROOT ?>/assets/img/customer/person.jpg' alt='Your Image' style='width: 100px; height: auto;'><br><b>Hello world!</b><br>This is a popup.";
             var popup = singlemarker.bindPopup(contant)
              singlemarker.openPopup();

        } else  if(listId=="list4"){
            map.flyTo([6.908217502180756,79.85777366643418], 16)
            var myIcon = L.icon({
                iconUrl: '<?= ROOT ?>/assets/img/customer/dod.png',
                iconSize: [38, 38]
              });
              var singlemarker=L.marker([6.908217502180756,79.85777366643418],{icon: myIcon}).addTo(map); 
              var contant = "<img src='<?= ROOT ?>/assets/img/customer/person.jpg' alt='Your Image' style='width: 100px; height: auto;'><br><b>Hello world!</b><br>This is a popup.";
             var popup = singlemarker.bindPopup(contant)
              singlemarker.openPopup();
        } 


       
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


      // bike---------------------------------------------------------------------------------------------------------------
     
      var markers=[];
      var vehicle;
      var newLat=<?php echo isset($_GET['l_lat']) ? json_encode($_GET['l_lat']) : 'null'; ?>;
      var newLng=<?php echo isset($_GET['l_long']) ? json_encode($_GET['l_long']) : 'null'; ?>;
      var vehicle=<?php echo isset($_GET['vehicle']) ? json_encode($_GET['vehicle']) : 'null'; ?>;
        deleteAllMarkers();
                   vehicle = L.icon({
                    iconUrl : '<?= ROOT ?>/assets/img/customer/'+vehicle+'.png',
                    iconSize:[50,30]
                })     
            coords=[[ 6.903528493716559,79.86255888285733],[6.90578774905135,79.85891096002354],[6.90259068644725,79.85790241665184],[ 6.908217502180756,79.85777366643418]]
            let l =coords.length;
            if(markers.length!=0){
            
            }
            map.flyTo([lat,long], 15)
            for(let i=0; i<l; i++){
                // console.log('Marker position updated to:', [newLat, newLng]);
                var x = (coords[i][0]-newLat)*(coords[i][0]-newLat)
                var y =(coords[i][1]-newLng)*(coords[i][1]-newLng)
                var z = x+y;
                var x1 = (6.906064826793089-6.901963)*(6.906064826793089-6.901963)
                var y1 =(79.8586320012186-79.861292)*(79.8586320012186-79.861292)
                var z1 = 5*(x1+y1);
                var marker1 = L.marker(coords[i],{icon :  vehicle})
                if(z<z1){
                    marker1.addTo(map)
                    markers.push(marker1);
                }
        
            }
            
        function deleteAllMarkers() {
            for (var i = 0; i < markers.length; i++) {
                map.removeLayer(markers[i]); // Remove each marker from the map
            }
            markers = [];}
   
           
        
    </script>
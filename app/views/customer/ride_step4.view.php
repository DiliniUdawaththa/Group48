<?php $driver_id=0 ?>
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
   

   <?php include 'ride_side.php'; ?>

<!-- ---------------------------------------------------------------------------------- -->
<div class="activity">
        <div class="mainbox">
            <div class="contant" id="contant" >
                <a href="<?=ROOT?>/customer/ride_step1"><i class="fa-solid fa-circle-left fa-fade" id="back"></i></a>
                <center>
                    
                    <h2>Select the Driver</h2>
                   
                    <?php  foreach ($rows as $row) :  ?>
                        <?php if($row->vehicle == $_GET['vehicle']){  ?>
                            <div class="driverlist" id="list_<?=$row->driver_id?>" onclick="highlightBox('list_<?=$row->driver_id?>')">
                                <div class="imgstar"><img src="<?= ROOT ?>/assets/img/customer/person.png" alt="">
                                <span>
                                    <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                                    <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                                    <i class="fa-solid fa-star" style="color: #D9D9D9;"></i>
                                    <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                                    <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                                </span></div>
                                <div class="name">Mr.S.Makesh</div>
                                <div class="fare"><b>500/-</b></div>
                                <div class="nrbutton">
                                <button class="Negotiate" id="Negotiate_<?=$row->driver_id?>">Negotiate</button>
                                <!-- <button class="Request">Select</button> -->
                                </div>
                            </div>
                            <?php $driver_id=$row->driver_id?>
                         <?php } ?>
                      <?php endforeach; ?>

                      <form action="" method="POST">
                           <input type="text" value='0' name='driver_id' id='Driver_Id'>
                           <a href="<?=ROOT?>/customer/ride_step5" class="golink"><button class="go" id="sizeButton">Go</button></a><br>
                      </form>
                </center>
                <form action="" method="POST">
                <div class="message_popup" id="message_popup">
                    <div class="message_topbar">
                        <i class="fa-solid fa-xmark" id="close"></i>
                    </div>
                    <div class="message_view">
                    <?php  foreach ($rows1 as $row) :  ?>
                        <?php if($row->ride_id == $driver_id+$_SESSION['USER_DATA']->id){?>
                        <div><?=$row->sender?> : <?=$row->message?></div>
                        <?php }?>
                    <?php endforeach; ?>
                    </div>
                    <div class="message_input">
                      <textarea name="message_text" id="message_text" cols="50" rows="3" value=""></textarea>
                      <input type="text"  name='Driver_id' id='driverId' style="display:none;">
                      <button>Send</button>
                    </div>
                </div>
                </form>
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
            var Id = listId.split('_')
            document.getElementById('Driver_Id').value=Id[1]
        });
        
        // Add border to the clicked box
        var list = document.getElementById(listId);
        list.classList.add('highlighted');
        
        // Show the button container
        var buttonContainer = document.getElementById('sizeButton');
        buttonContainer.style.display = 'block';
        
        //show drivers
        <?php  foreach ($rows as $row) :  ?>
             <?php if($row->vehicle == $_GET['vehicle']){  ?>
                if(listId=="list_<?=$row->driver_id?>"){
                    map.flyTo([ <?=$row->lat?>,<?=$row->long?>], 16)
                    var myIcon = L.icon({
                        iconUrl: '<?= ROOT ?>/assets/img/customer/dod.png',
                        iconSize: [38, 38]
                    });
                    var singlemarker=L.marker([<?=$row->lat?>,<?=$row->long?>],{icon: myIcon}).addTo(map); 
                    var contant = "<center><img src='<?= ROOT ?>/assets/img/customer/person.png' alt='Your Image' style='width: 100px; height: auto; '><br><b style='color:red;'>2314B (RED)</b><br>I am waiting for you.</center>";
                    var popup = singlemarker.bindPopup(contant)
                    singlemarker.openPopup();
                    }
            <?php } ?>
        <?php endforeach; ?>

        }
        //---------------------------------------------------------------------------------------------------------------
        <?php  foreach ($rows as $row) :  ?>
             <?php if($row->vehicle == $_GET['vehicle']){  ?>
                
                var negotiate = document.getElementById('Negotiate_<?=$row->driver_id?>');
                var messagebox=document.getElementById('message_popup');
                var contant=document.getElementById('contant');
                var close=document.getElementById('close')

                negotiate.addEventListener('click', () => {
                    messagebox.style.display="block";
                    document.getElementById('driverId').value=<?=$row->driver_id?>;
                    
                })
                close.addEventListener('click', () => {
                    messagebox.style.display="none";
                })
                <?php } ?>
        <?php endforeach; ?>

       
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
            
            
            map.flyTo([lat,long], 15)
              <?php foreach ($rows as $row) :  ?>
                   <?php if($row->vehicle == $_GET['vehicle']){?>
                        var x = (<?=$row->lat?>-newLat)*(<?=$row->lat?>-newLat)
                        var y =(<?=$row->long?>-newLng)*(<?=$row->long?>-newLng)
                        var z = x+y;
                        var x1 = (6.906064826793089-6.901963)*(6.906064826793089-6.901963)
                        var y1 =(79.8586320012186-79.861292)*(79.8586320012186-79.861292)
                        var z1 = 6*(x1+y1);
                        var marker1 = L.marker([<?=$row->lat?>,<?=$row->long?>],{icon :  vehicle})
                        if(z<z1){
                            marker1.addTo(map)
                            markers.push(marker1);
                        }
                   <?php } ?>
            <?php endforeach; ?>
          
            
        function deleteAllMarkers() {
            for (var i = 0; i < markers.length; i++) {
                map.removeLayer(markers[i]); // Remove each marker from the map
            }
            markers = [];}
   
           
        
    </script>
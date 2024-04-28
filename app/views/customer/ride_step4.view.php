<?php $driver_id=0 ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="15" id="refreshMeta">
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
        
        .loader {
        border: 5px solid #000;
        border-radius: 50%;
        border-top: 5px solid white;
        width: 30px;
        height: 30px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
        margin-top: 20px;
        }

        /* Safari */
        @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
        }

    </style>
</head>
<body id="body">
   

   <?php include 'ride_side.php'; ?>

<!-- ---------------------------------------------------------------------------------- -->
<div class="activity">
        <div class="mainbox">
            <div class="contant" id="contant" >

            <form action="" method="POST">
                <button type="submit" name="submit" value="submit" style="border: none; background: none; cursor: pointer;">
                       <a href="<?=ROOT?>/customer/ride_step1"><i class="fa-solid fa-circle-left fa-fade" id="back"></i></a>
                </button>
           </form>
                <center>
                    
                    <h2>Select the Driver</h2>
                    <?php  foreach ($rows4 as $row4) :  ?>  <!--  //current_ride table -->
                            <?php  foreach ($rows2 as $row2) :  ?>  <!--  //offers table -->
                                    <?php if( $_GET['vehicle'] == $row4->vehicle && $row4->id == $row2->ride_id  && $row4->passenger_id ==$_SESSION['USER_DATA']->id){  ?>
                                        <div class="driverlist" id="list_<?=$row2->driver_id?>" onclick="highlightBox('list_<?=$row2->driver_id?>')">
                                            <div class="imgstar"><img src="<?= ROOT ?>/assets/img/customer/person.png" alt="">
                                            <span>
                                                <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                                                <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                                                <i class="fa-solid fa-star" style="color: #D9D9D9;"></i>
                                                <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                                                <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                                            </span></div>
                                            <div class="name">Mr.
                                            <?php  foreach ($rows3 as $row3) :     // user table
                                                    if($row3->id == $row2->driver_id)
                                                    {
                                                        echo $row3->name;
                                                    }
                                                endforeach; ?>
                                            </div>
                                            <div class="fare"><b><?=$row2->offer_price?>/-</b></div>
                                            <div class="nrbutton">
                                            <button class="Negotiate" id="Negotiate_<?=$row2->driver_id?>" onclick="show_message('Negotiate_<?=$row2->driver_id?>')">Negotiate</button>
                                            <!-- <button class="Request">Select</button> -->
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php endforeach; ?>
                         
                      <?php endforeach; ?>
                      <div class="loader"></div>
                      <b>Searching </b>

                      <form action="" method="POST">
                           <input type="text" value='0' name='driver_id' id='Driver_Id'>
                           <input type="text" value='' name='fare' id="form_fare" style='display:none;'>
                           <input type="text" value='' name='id' id="ride_id" style='display:none;'>
                           <a href="<?=ROOT?>/customer/ride_step5" class="golink"><button class="go" id="sizeButton">Go</button></a><br>
                      </form>
                </center>
                <form action="" method="POST">
                <div class="message_popup" id="message_popup">
                    <div class="message_topbar">
                        <i class="fa-solid fa-xmark" id="close"></i>
                    </div>
                 
                    <div class="message_input"  style="z-index:500; background-color:white;">
                        <div style="padding:10px 30px">Enter your Negotiate fare</div>
                      <input name="message_text" id="message_text" value="" placeholder="Enter your fare..." style="margin:5px 20%; height:25px; font-size:1.2em">
                      <input type="text"  name='Driver_id' id='driverId' style="display:none;">
                      <input type="text"  name='ride_id' id='rideid' style="display:none;">
                      <button>Send</button>
                    </div>
                </div>
                </form>
                <!-- <button onclick="refreshPage()">Refresh Page</button> -->
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
            // // Clear the interval timer to stop reloading
            // clearInterval(reloadInterval);
        
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
        <?php  foreach ($rows4 as $row4) :  ?>   //current_ride table -->
        <?php  foreach ($rows2 as $row2) :  ?>   //offers table
        <?php  foreach ($rows as $row) :  ?>     //driver_state table
             <?php if( $_GET['vehicle'] == $row4->vehicle && $row4->id == $row2->ride_id  && $row4->passenger_id ==$_SESSION['USER_DATA']->id && $row->driver_id == $row2->driver_id){ ?>
                if(listId=="list_<?=$row->driver_id?>"){
                    document.getElementById('form_fare').value=<?=$row2->offer_price;?>;
                    document.getElementById('ride_id').value=<?=$row4->id;?>;
                    map.flyTo([ <?=$row->lat?>,<?=$row->lng?>], 16)
                    var myIcon = L.icon({
                        iconUrl: '<?= ROOT ?>/assets/img/customer/dod.png',
                        iconSize: [38, 38]
                    });
                    var singlemarker=L.marker([<?=$row->lat?>,<?=$row->lng?>],{icon: myIcon}).addTo(map); 
                    var contant = "<center><img src='<?= ROOT ?>/assets/img/customer/person.png' alt='Your Image' style='width: 100px; height: auto; '><br><b style='color:red;'>2314B (RED)</b><br>I am waiting for you.</center>";
                    var popup = singlemarker.bindPopup(contant)
                    singlemarker.openPopup();
                    }
            <?php } ?>
        <?php endforeach; ?>
        <?php endforeach; ?>
        <?php endforeach; ?>

        }
        //---------------------------------------------------------------------------------------------------------------
        function show_message(id){
            <?php  foreach ($rows2 as $row2) :  ?>
                if(id == 'Negotiate_<?=$row2->driver_id?>')
                {
                    var negotiate = document.getElementById('Negotiate_<?=$row2->driver_id?>');
                    var messagebox=document.getElementById('message_popup');
                    var contant=document.getElementById('contant');
                    var close=document.getElementById('close')

                    negotiate.addEventListener('click', () => {
                        messagebox.style.display="block";
                        document.getElementById('driverId').value=<?=$row2->driver_id?>;
                        document.getElementById('rideid').value=<?=$row2->ride_id?>;
                        
                    })
                    close.addEventListener('click', () => {
                        messagebox.style.display="none";
                    })
                }

                <?php endforeach; ?>
        }
         //<!-- offer-->
            
                
                
              
        

       
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
    var lat2=<?php echo isset($_GET['m_lat']) ? json_encode($_GET['m_lat']) : 'null'; ?>;
    var lon2=<?php echo isset($_GET['m_long']) ? json_encode($_GET['m_long']) : 'null'; ?>;
    if(lat2 == '' && lon2 == '')
    {
        Routing = L.Routing.control({
        waypoints: [
            L.latLng(lat,long),
            L.latLng(lat1,lon1)
        ]
    });
    }else{
    Routing = L.Routing.control({
        waypoints: [
            L.latLng(lat,long),
            L.latLng(lat2,lon2),
            L.latLng(lat1,lon1)
        ]
    });
    }
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
                               
            
            map.flyTo([lat,long], 15)
            <?php  foreach ($rows4 as $row4) :  ?>   //current_ride table -->
            <?php  foreach ($rows2 as $row2) :  ?>   //offers table
              <?php foreach ($rows as $row) :  ?>
                   <?php if($_GET['vehicle'] == $row4->vehicle && $row4->id == $row2->ride_id  && $row4->passenger_id ==$_SESSION['USER_DATA']->id && $row->driver_id == $row2->driver_id){?>
                       vehicle = L.icon({
                            iconUrl : '<?= ROOT ?>/assets/img/customer/<?=$row->vehicle?>.png',
                            iconSize:[50,30]
                        }) 
                        var marker1 = L.marker([<?=$row->lat?>,<?=$row->lng?>],{icon :  vehicle})
                        marker1.addTo(map)
                        markers.push(marker1);
                   <?php } ?>
            <?php endforeach; ?>
            <?php endforeach; ?>
            <?php endforeach; ?>
          
            
        function deleteAllMarkers() {
            for (var i = 0; i < markers.length; i++) {
                map.removeLayer(markers[i]); // Remove each marker from the map
            }
            markers = [];}
   
           
        
    </script>
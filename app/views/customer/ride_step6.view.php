<!DOCTYPE html>
<html>
<head>
<title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
<meta http-equiv="refresh" content="15" id="refreshMeta">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_step5.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_side.css"> 
    <!-- google font   -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />

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
            <div class="contant" >
             <center>
                    <h2>Driver on the way</h2> 
                    <h6>Estimate time </h6>    
                    <h5 id='time_limit'></h5>
                    <div class="driver_profile">
                        <img class="driver_image" src="<?= ROOT ?>/assets/img/customer/person.png" alt="">
                        <img class="driver_vehicle" src="<?= ROOT ?>/assets/img/customer/c2.jpeg" alt="">
                    </div>
            </center>
               
            </div>
            <div id="map" > </div>
        </div>
    </div>       
    <script>
    function openWhatsApp() {
        
        // WhatsApp URL with phone number (replace '1234567890' with the desired phone number)
        <?php  foreach ($rows2 as $row2) :  ?>
               
        num =  parseInt("<?=$row2->phone;?>");       
         var url = 'https://wa.me/+94'+num;

        // Open WhatsApp in a new tab
        window.open(url, '_blank');
        <?php   endforeach; ?>
    }
</script>
</body>
</html>

<!-- leaflet js code -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
 <!-- routing js file -->
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<!-- search -->
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
           
    // map instalizion
    var map = L.map('map').setView([ 6.9027950684792625, 79.85960115453588], 10);
    // google street
    googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        });
    googleStreets.addTo(map)
    var id=<?php echo isset($_GET['id']) ? json_encode($_GET['id']) : 'null'; ?>;
    <?php  foreach ($rows as $row) :  ?>
        if(<?=$row->id ?> == id ){
            
            Routing = L.Routing.control({
                waypoints: [
                    L.latLng(<?=$row->l_lat?>,<?=$row->l_long?>),
                    <?php 
                        if($row->m_lat) {
                            $lat = floatval($row->m_lat);
                            $long = floatval($row->m_long);
                            echo 'L.latLng('.$lat.','.$long.'),';
                        } 
                        ?>
                    L.latLng(<?=$row->d_lat?>,<?=$row->d_long?>)
                ],routeWhileDragging: true
            });
            
        

        // real time tracking
            var taxiIcon = L.icon({
                    iconUrl: '<?= ROOT ?>/assets/img/customer/<?=$row->vehicle?>.png',
                    iconSize: [50, 40]
                })
                var marker = L.marker([<?=$row->l_lat?>, <?=$row->l_long?>], { icon: taxiIcon }).addTo(map);
                    L.Routing.control({
                        waypoints: [
                            L.latLng(<?=$row->l_lat?>, <?=$row->l_long?>),
                            <?php 
                            if($row->m_lat) {
                                $lat = floatval($row->m_lat);
                                $long = floatval($row->m_long);
                                echo 'L.latLng('.$lat.','.$long.'),';
                            } 
                            ?>
                            L.latLng(<?=$row->d_lat?>, <?=$row->d_long?>)
                        ]
                    }).on('routesfound', function (e) {
                        var routes = e.routes;
                        var time = e.routes[0].summary.totalTime; 
                        document.getElementById("time_limit").innerText=Math.floor((time%3600)/60)+' min';
                        e.routes[0].coordinates.forEach(function (coord, index) {
                            setTimeout(function () {
                                marker.setLatLng([coord.lat, coord.lng]);
                            }, 200* index)
                        })

                     }).addTo(map); 
                     const popupElement = document.getElementsByClassName('leaflet-routing-container leaflet-bar leaflet-routing-collapsible leaflet-control')[0];
                    popupElement.classList.add('leaflet-routing-container-hide');
                    }
    <?php endforeach; ?>               
           
        
</script>







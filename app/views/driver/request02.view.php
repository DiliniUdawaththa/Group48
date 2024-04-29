<!DOCTYPE html>
<html>
    <head>
        <title>
            Profile
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/driverui.css">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/driver/request.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito Sans' rel='stylesheet'>
        <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <!-- //routing css -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
        <!-- search -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <style>
            .opt1{
                    background-color:#194672;
                    color: white;
            }

</style>
    </head>
    <body>
        
    
    <?php include 'driver_side.php'; ?>


        <div class="page-container">
            <div class="body-container">

            
            
                <div class="req-body">
                    <div class="req-content">
                    
                        <div class="req-customer" style="padding-top:20px">
                            <img src="<?= ROOT ?>/assets/img/images/default_profile.png" class="req-cus-pic">
                            <div class="req-customer-details">
                               
                                    <p class="customer-name"><?php echo ucfirst($data['customer']->name)?></p>
                                    <img src="<?= ROOT ?>/assets/img/images/rating.png" class="customer-rating">
                                    <p class="req-time">2 mins ago</p>
                                
                            </div>
                        </div>
                        <div class="location-destination">
                            <p class="req-loc-des"><b>From:</b> <?php echo $data['ride_info']->location?></p>
                            <p class="req-loc-des"><b>To:</b> <?php echo $data['ride_info']->destination?></p>
                            <p class="req-loc-des"><b>Distance:</b> 5.2km</p>
                            <p class="req-loc-des"><b>Vehicle</b> Three Wheeler</p>
                            <p class="req-loc-des"><b>Offer sent:</b> Rs <?php echo $data['offer_price'] ?></p>
                        </div>
                        
                        <div style="display:flex;justify-content:space-around;"><p>Waiting for customer<div class="loader"></div></p></div>
                        <form method="POST"><input type="submit" value="Cancel" class="cancel-offer-btn" name="cancel-offer"></form>
                        
                        <div class="negotiation">
                        
                           <h3>Negotiation request</h3>
                           <div>
                                <p class="req-loc-des"><b>Offered fare:</b> Rs <?php echo $data['offer_price'] ?></p>
                                <p class="req-loc-des"><b>Requesting fare:</b><div class="neg-price"> Rs. <?php echo $data['negotiation_price'] ?></div></p>
                            </div>
                            <form method="POST">  
                           <div class="neg-btns">
                                    <input type="submit" class="accept-neg-btn" value="Accept" name="accept-neg">
                                    <!-- <button class="accept-neg-btn">Accept</button> -->
                                   
                                    <input type="submit" class="decline-neg-btn" value="Decline" name="decline-neg">
                                    <!-- <button class="decline-neg-btn">Decline</button> -->
                                
                            </div>
                            </form>
                        
                        </div>
                       
                        
                    </div>
                    <div class="req-map">
                        <div id="map">
                            
                        </div>
                        
                    </div>
                </div>
            
                

                                    
                       
    
                        
                    
                
                <div class="logout-container">
                    <h2>Log Out</h2>
                    <p class="logout-text">Are you sure you want to log out?</p>
                    <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn" onclick = "window.location.href = '<?=ROOT?>/logout';">Log Out</button></div>
                </div>
            </div>
       </div>
            <!-- leaflet js code -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <!-- routing js file -->
        <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
        <!-- search -->
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
        <script>
            <?php if($data['negotiation_sent'] == 1):?>
                document.querySelector('.negotiation').style.display = 'flex';
            <?php endif;?>

            function display_negotiation(){
                if(document.querySelector('.negotiation').style.display == 'none'){
                    document.querySelector('.negotiation').style.display = 'flex';
                }
            }


            setInterval(() =>{
                console.log("Hi");
                let xhr = new XMLHttpRequest();
                console.log(xhr);
                xhr.open("POST", '<?php echo ROOT; ?>'+"/driver/request02", true);
                xhr.onload = ()=>{
                    console.log("nol");
                    if(xhr.readyState === XMLHttpRequest.DONE){
                    
                    if(xhr.status === 200){
                        let data = xhr.response;
                        if(data=="Accepted"){
                            window.location.href = "<?php echo ROOT; ?>/driver/request03";
                        }else if(data != "Waiting"){
                            document.querySelector('.negotiation').style.display = 'flex';
                            document.querySelector('.neg-price').innerHTML = data;
                        }
                    
                }
            }
            }
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("incoming_id="+'yes');
        }, 5000);
                
            
            // map instalizion
            var map = L.map('map').setView([ 7.8774, 80.7003], 9);
            // google street
            googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
                    maxZoom: 20,
                    subdomains:['mt0','mt1','mt2','mt3']
                });
            googleStreets.addTo(map)

            var Routing;
            <?php if (isset($data['ride_info']->l_lat) && isset($data['ride_info']->l_long) && isset($data['ride_info']->d_lat) && isset($data['ride_info']->d_lat)): ?>
                var lat=parseFloat("<?php echo $data['ride_info']->l_lat?>")
                var long=parseFloat("<?php echo $data['ride_info']->l_long?>")
                var lat1=parseFloat("<?php echo $data['ride_info']->d_lat?>")
                var lon1=parseFloat("<?php echo $data['ride_info']->d_long?>")
            <?php else: ?> 
                var lat=6.87848
                var long=79.8581
                var lat1=6.87313
                var lon1=79.868 
            <?php endif; ?> 
            Routing = L.Routing.control({
                waypoints: [
                    L.latLng(lat,long),
                    L.latLng(lat1,lon1)
                ],
                addWaypoints: false // Hide the waypoints
            });

            Routing.addTo(map);
            var lat2=(lat1+lat)/2
            var lon2=(lon1+long)/2
            map.flyTo([lat2,lon2], 14)
            const popupElement = document.getElementsByClassName('leaflet-routing-container leaflet-bar leaflet-routing-collapsible leaflet-control')[0];
            popupElement.classList.add('leaflet-routing-container-hide');
        
            

            
                

            var status = 1
            var sidenav = 1
            const addVehBtn = document.querySelector('#add-veh-btn');
            const more = document.querySelector('.more-icon');
            const navigation = document.querySelector('.side-nav')
            const active_btn = document.querySelector('.active');
            const inactive_btn = document.querySelector('.inactive');
            const status_icon = document.getElementById('status_icon');
            const logout_option = document.querySelector('.opt4');                
            const notification_container = document.querySelector('.analytics-container')
            const activity_container = document.querySelector('.activity-container')
            const vehicles_container = document.querySelector('.vehicles-container')
            const profile_container = document.querySelector('.profile-container')
            const logout_container = document.querySelector('.logout-container')
            const cancel_button = document.querySelector('.cancel-btn')
            const logout_button = document.querySelector('.logout-btn')
            
            logout_option.addEventListener('click',function (){
                logout_container.style.display = 'block';
            })

            cancel_button.addEventListener('click',function (){
                logout_container.style.display = 'none';
            })
            
            more.addEventListener('click', function (){
                if(sidenav == 1){
                    navigation.style.display = 'none';
                    sidenav = 0
                }else{
                    navigation.style.display = 'block';
                    sidenav = 1
                }
                

            })



            
            function map_view(){
                document.querySelector('.map-route').style.display = 'block';
            }
            function close_map(){
                document.querySelector('.map-route').style.display = 'none';
            }


            
            

            function addVehicle(){
                addVehBtn.style.display = 'none';
                document.querySelector('.add-vehicle').style.display = 'flex'
            }



        </script>
    </body>
</html>


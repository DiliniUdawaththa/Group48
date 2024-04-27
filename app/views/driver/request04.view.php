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
        
    



        <div class="page-container">
            <div class="body-container">

            <?php include 'driver_side.php'; ?>

                <div class="req-body">
                    <div class="req-content">
            
                        <div class="req-customer" style="padding-top:20px">
                            <img src="<?= ROOT ?>/assets/img/images/default_profile.png" class="req-cus-pic">
                            <div class="req-customer-details">
                               
                                    <p class="customer-name"><?php echo ucfirst($data['customer']->name)?></p>
                                    <img src="<?= ROOT ?>/assets/img/images/rating.png" class="customer-rating">
                                    <p class="req-time">On ride..</p>
                                
                            </div>
                        </div>
                        <div class="location-destination">
                            <p class="ride-txt">Mr <?php echo ucfirst($data['customer']->name)?> is currently on your ride.</p>
                            <p class="ride-txt"><b>Caution</b>
                                <ul class="ride-txt">
                                    <li>Stay alert and aware of your surroundings while in the vehicle</li>
                                    <li>Avoid sharing personal information or engaging in inappropriate behavior</li>
                                    <li>Follow Traffic Laws</li>
                                    <li>Be Respectful to the Customer</li>
                                </ul>
                            </p>

                            <p class="collect-cus-time"><b>Estimated Time:</b> 10 minutes</p>
                            <div class="loader" style="margin:20px auto;"></div>
                        </div>
                       

                        <form>
                            <center>
                            <input type="submit" name="end-ride" value="End Ride" class="end-ride">
                            </center>
                        </form>
                        
                           
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
            !-- leaflet js code -->
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
                ],
                addWaypoints: false // Hide the waypoints
            });

            Routing.addTo(map);
            var lat2=(lat1+lat)/2
            var lon2=(lon1+long)/2
            map.flyTo([lat2,lon2], 14)
            const popupElement = document.getElementsByClassName('leaflet-routing-container leaflet-bar leaflet-routing-collapsible leaflet-control')[0];
            popupElement.classList.add('leaflet-routing-container-hide');
        
            const standard_fare = document.getElementById('std-fare')
            standard_fare.addEventListener('click', function() {
                if (standard_fare.checked) {
                    console.log("Hi")
                    document.getElementById('offer-price').value = 600
                } else {
                }
            });
                

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

            active_btn.addEventListener('click',function (){
                status = 1
                status_icon.src = '<?= ROOT ?>/assets/img/images/active.png';
                active_btn.style.backgroundColor = '#162938'
                active_btn.style.color = 'white'
                inactive_btn.style.backgroundColor = '#E4E4E4'
                inactive_btn.style.color = 'black'
            })
            inactive_btn.addEventListener('click',function (){
                status = 0
                status_icon.src = '<?= ROOT ?>/assets/img/images/inactive.png';
                active_btn.style.backgroundColor = '#E4E4E4'
                active_btn.style.color = 'black'
                inactive_btn.style.backgroundColor = '#162938'
                inactive_btn.style.color = 'white'
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

            document.querySelector('.update-veh').addEventListener('click', function(){
                document.querySelector('.update-veh1').style.display = 'block'
            })

            document.querySelector('.cancel-veh-btn').addEventListener('click', function(){
                document.querySelector('.update-veh1').style.display = 'none'
            })


        </script>
    </body>
</html>


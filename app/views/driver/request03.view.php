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
            <form method="POST">
                <div class="req-body">
                    <div class="req-content">
            
                        <div class="req-customer" style="padding-top:20px">
                            <img src="<?= ROOT ?>/assets/img/customer/profile/<?php echo $data['customer']->img_path?>" class="req-cus-pic">
                            <div class="req-customer-details">
                               
                                    <p class="customer-name"><?php echo ucfirst($data['customer']->name)?></p>
                                    <img src="<?= ROOT ?>/assets/img/images/rating.png" class="customer-rating">
                                    <p class="req-time">Waiting..</p>
                                
                            </div>
                        </div>
                        <div class="location-destination" style="text-align: center;">
                            <p>Mr <?php echo ucfirst($data['customer']->name)?> is waiting at his pick-up location</p>
                            <p class="collect-cus-time"><b>Estimated Time:</b> 10 minutes</p>
                            <div class="loader" style="margin:20px auto;"></div>
                        </div>
                       

                        
                            <div class="neg-btns">
                                <button type="button" class="cancel-s-ride" onclick="show_popup()">Cancel</button>
                            
                                <input type="submit" name="start-ride" value="Start Ride" class="start-ride">
                            </div>
                            <div class="driver-canceled">
                                <p>Customer canceled the Ride</p>
                            </div>
                            
      
                        
                           
                    </div>
                    <div class="req-map">
                        <div id="map">

                        </div>
                        <div class="call-option"><i class="fa-solid fa-phone"></i></div>
                    </div>
                    <div class="cancel-reason1">
                           <h3>Please give a reason</h3>
                            <select name="reason" id="cancel-reason">
                                <option value="Taking long">Taking Long</option>
                                <option value="Vehicle Breakdown">Vehicle Breakdown</option>
                                <option value="Other">Other</option>
                            </select>
                           <input type="Submit" name="cancel-s-ride" value="Submit" class="submit-pop-up" style="height:30px;">
                           <button type="button" class="cancel-pop-up" onclick="hide_popup()">Cancel</button>
                    </div>
                </div>

                </form>
                        

                

                                    
                       
    
                        
                    
                
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

       

    setInterval(() =>{
                console.log("Hi");
                let xhr = new XMLHttpRequest();
                console.log(xhr);
                xhr.open("POST", '<?php echo ROOT; ?>'+"/driver/request03", true);
                xhr.onload = ()=>{
                    console.log("nol");
                    if(xhr.readyState === XMLHttpRequest.DONE){
                    
                    if(xhr.status === 200){
                        let data = xhr.response;
                        console.log(data);
                        if(data=="customer-cancel"){
                            document.querySelector('.driver-canceled').style.display = "block";
                            document.querySelector('.neg-btns').style.display = "none";
                            setTimeout(() => {
                                window.location.href = "<?php echo ROOT; ?>/driver/activity";
                            }, 2000);
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

            var driver_lat = 0;
        var driver_long=0;
            if(!navigator.geolocation){
                        console.log("Error")
                    }else{
                        //automatically coordinate change
                        // setInterval(()=>{
                            //get current position
                            navigator.geolocation.getCurrentPosition(getPosition)
                        // },5000);
                    
                    }
                    var marker,circle;
                    function getPosition(position){
                        console.log(position)  
                         driver_lat=position.coords.latitude
                         console.log(driver_lat);
                         driver_long=position.coords.longitude
                         console.log(driver_long)
                        var accuracy= position.coords.accuracy

                        if(marker){
                            map.removeLayer(marker)
                        }
                        if(circle){
                            map.removeLayer(circle)
                        }

                        marker=L.marker([driver_lat,driver_long])
                        map.removeLayer(marker);
                        markers.push(marker)
                        // marker.addTo(map)
                        circle =L.circle([driver_lat,driver_long],{radius:accuracy})

                        var featureGroup = L.featureGroup([marker,circle]).addTo(map)

                        map.fitBounds(featureGroup.getBounds())

                        console.log("your coordinate is Lat:"+lat+"Long"+long+"Accuracy"+accuracy)

                       map.flyTo([driver_lat,driver_long],14    )
                   
                        // map.setView(marker, 18);
                    }


            var Routing;
            <?php if (isset($data['ride_info']->l_lat) && isset($data['ride_info']->l_long) && isset($data['ride_info']->d_lat) && isset($data['ride_info']->d_lat)): ?>
                var lat=parseFloat(driver_lat)
                var long=parseFloat(driver_long)
                var lat1=parseFloat("<?php echo $data['ride_info']->l_lat?>")
                var lon1=parseFloat("<?php echo $data['ride_info']->l_long?>")
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
        
    


            function hide_popup(){
                document.querySelector('.cancel-reason1').style.display = 'none';
            }
            function show_popup(){
                document.querySelector('.cancel-reason1').style.display = 'flex';
            }

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


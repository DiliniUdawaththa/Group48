<!DOCTYPE html>
<html>
    <head>
        <title>
            Profile
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/driverui.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito Sans' rel='stylesheet'>
        <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
        <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script> -->
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
                
                <div class="activity-container" style="display:block">
                    <div class="status-container">
                        <h2>Hello, <?php echo $_SESSION['USER_DATA']->name; ?></h2>
                        
                        <div class="select-status">
                            <div><p>Active status:</p></div>
                            <div class="active">
                                <p>Available</p>
                            </div>
                            <div class="inactive">
                                <p>Unavailable</p>
                            </div>
                            
                        </div>
                    </div>

                    <div class="request-container">
                        <h2>Request for ride</h2>
                        <?php foreach ($data['current_rides'] as $rides) : ?>
                                <div class="request-box">
                                    <div>
                                        <img src="<?= ROOT ?>/assets/img/images/default_profile.png" class="request-customer-pic">
                                        <img src="<?= ROOT ?>/assets/img/images/rating.png" style="height: 10px;display: block;">
                                    </div>
                                    <div class="destination">
                                        <p style="display: block;margin: 5px;">From: <?php echo $rides -> location; ?></p>
                                        <p style="display: block;margin: 5px;">To: <?php echo $rides -> destination; ?></p>
                                    </div>
                                    <div style="width: 100px;"> 
                                        <?php if($data['vehicles']==0):?>
                                            <p style="color:brown">Add your vehicle first to send offers!</p>
                                        <?php endif;?>
                                        <?php if($data['vehicles']>0):?>
                                            <button onclick="map_view()" class="map-view-btn">Map View</button>
                                            <button class="accept-btn" id="proceed_<?=$rides->id?>" onclick="delete_line('proceed_<?=$rides->id?>')">Proceed</button> 
                                        <?php endif;?>
                                    </div>
                                </div>
                        <?php endforeach; ?>
                        <?php if(count($data['current_rides'])==0):?>
                            <h2>No rides</h2>
                        <? else: ?>
                            

                            <h2></h2>
                        <?php endif;?>
                        
                        
                        <div class="map-route">
                            <button onclick="close_map()" class="close-map">X</button>
                            <div id="map">


                            </div>
                         </div>
    
                        <div class="offer-container">
                            <button class="close-offer">X</button>
                            <div style="text-align: center;">
                                <table class="offer-table">
                                    <tr><td rowspan="2" style="vertical-align: top;padding-right: 10px;font-size: 25px;">Your Fare(Rs):</td><td style="text-align: left;"><input type="number" id="fare-amount"></td></tr>
                                    <tr><td style="text-align: left;"><input type="checkbox" id="std-fare"> Standard fare</td></tr>
                                </table>
                                <button class="send-offer">Send Offer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="logout-container">
                    <h2>Log Out</h2>
                    <p class="logout-text">Are you sure you want to log out?</p>
                    <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn" onclick = "window.location.href = '<?=ROOT?>/logout';">Log Out</button></div>
                </div>
        </div>

                

        <script>
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


            document.querySelector('.accept-btn1').addEventListener('click', function(){
                document.querySelector('.offer-container').style.display = 'block'
            })

            document.querySelector('.close-offer').addEventListener('click', function(){
                document.querySelector('.offer-container').style.display = 'none'
            })

            const standard_fare = document.getElementById('std-fare')
            standard_fare.addEventListener('click', function() {
                if (standard_fare.checked) {
                    document.getElementById('fare-amount').value = '600'
                    document.getElementById('fare-amount').disabled = true
                } else {
                    document.getElementById('fare-amount').disabled = false
                }
            });

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

            function delete_line(data)
          {
                <?php foreach ($data['current_rides'] as $rides) : ?>
                if(data=="proceed_<?=$rides->id?>"){ 
                    window.location.href ="<?=ROOT?>/driver/request/<?=$rides->id?>/<?=$rides->passenger_id?>"
                }
                <?php endforeach; ?>
          }

        </script>
    </body>
</html>



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
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    </head>
    <body>
        <div class="navigation-bar">
            <div style="width: 80px;"><img src="<?= ROOT ?>/assets/img/images/more_icon.png"  class="more-icon" ></div>
            <img src="<?= ROOT ?>/assets/img/images/Logo.png" style="height: 60px;">
        </div>
        <div class="page-container">
            <div class="side-nav">
                <img src="<?= ROOT ?>/assets/img/logonamenw.png" class="logo">
                <div>
                    <img src="<?= ROOT ?>/assets/img/images/profilepic.png" class="profile-pic">
                    
                    <h4 class="name"><?php echo $_SESSION['USER_DATA']->name; ?> - Driver<img src="<?= ROOT ?>/assets/img/images/active.png" id="status_icon" class="status-light"></h4>
                    <img src="<?= ROOT ?>/assets/img/images/rating.png" class="rating">
                </div>
                <div class="options">
                    <div class="opt1"><div><i class="fa fa-tasks" aria-hidden="true" style="margin-right: 10px;"></i> Hire Request</div><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                    <div class="opt2"><div><i class="fa fa-line-chart" aria-hidden="true" style="margin-right: 10px;"></i> Analytics</div><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                    <div class="opt2-1"><div><i class="fa fa-car" aria-hidden="true" style="margin-right: 10px;"></i> Vehicles</div><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                    <div class="opt3"><div><i class="fa fa-user" aria-hidden="true" style="margin-right: 10px;"></i> Profile</div><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
                    <div class="opt4"><div><i class="fa fa-sign-out" aria-hidden="true" style="margin-right: 10px;"></i> Logout</div></div>

                </div>
            </div>
            <div class="body-container">
                <div class="notification-bar">
                    <div class="nosubmit">
                        <input class="search-box" type="search" placeholder="Search...">
                    </div>
                    <div>
                        <i class="fa-regular fa-bell noti-icon"></i>
                        <i class="fa-regular fa-message msg-icon"></i>
                    </div>
                </div>
                <div class="activity-container">
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
                        <div class="request-box">
                            <div>
                                <img src="<?= ROOT ?>/assets/img/images/default_profile.png" class="request-customer-pic">
                                <img src="<?= ROOT ?>/assets/img/images/rating.png" style="height: 10px;display: block;">
                            </div>
                            <div class="destination">
                                <p style="display: block;margin: 5px;">From: 25, Hill Street, Colombo</p>
                                <p style="display: block;margin: 5px;">To: 213/A , Katubedda , Moratuwa</p>
                            </div>
                            <div style="width: 100px;"> 
                                <?php if($data['vehicles']==0):?>
                                    <p style="color:brown">Add your vehicle first to send offers!</p>
                                <?php endif;?>
                                <?php if($data['vehicles']>0):?>
                                    <button class="map-view-btn">Map View</button>
                                    <button class="accept-btn">Offer</button> 
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="request-box">
                            <div>
                                <img src="<?= ROOT ?>/assets/img/images/default_profile.png" class="request-customer-pic">
                                <img src="<?= ROOT ?>/assets/img/images/rating.png" style="height: 10px;display: block;">
                            </div>
                            <div class="destination">
                                <p style="display: block;margin: 5px;">From: 43, Bambalapitiya, Colombo</p>
                                <p style="display: block;margin: 5px;">To: 243/A , Kollupitiya, Colombo</p>
                            </div>
                            <div style="width: 100px;"> 
                                <?php if($data['vehicles']==0):?>
                                    <p style="color:brown">Add your vehicle first to send offers!</p>
                                <?php endif;?>
                                <?php if($data['vehicles']>0):?>
                                    <button class="map-view-btn1">Map View</button>
                                    <button class="accept-btn1">Offer</button> 
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="map-route">
                            <button class="close-map">X</button>
                            <img src="<?= ROOT ?>/assets/img/images/map.jpg">
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
                <div class="analytics-container">
                    <div class="today-analytics">
                        <div class="t-topic"><h3>Today's Performance</h3> </div>
                        <div class="t-body">
                            <div class="t-content"><img src="<?= ROOT ?>/assets/img/images/coin.png" class="performance-img"> <p class="p-stat">LKR 2,000</p></div>
                            <div class="t-content"><img src="<?= ROOT ?>/assets/img/images/clock.png" class="performance-img"><p class="p-stat">126 Mins</p></div>
                            <div class="t-content"><img src="<?= ROOT ?>/assets/img/images/bar-chart.png" class="performance-img"> <p class="p-stat">13  Rides</p></div>       


                        </div>

                    </div>
                    <div class="charts-container">
                        <div class="chart">
                            <h3 style="text-align: center;">Daily Rides</h3>
                            <div id="chart1">
                            </div>
                        </div>

                        <div class="chart">
                            <div id="chart2">
                            </div>
                        </div>

                    </div>
                </div>
                
                <script>

                var options = {
                chart: {
                    type: 'line',
                    width: 600 ,
                },
                series: [{
                    name: 'sales',
                    data: [27,23,18,19,17,13,25,19,22]
                }],
                xaxis: {
                    categories: ["Feb 14","Feb 15","Feb 16","Feb 17","Feb 18","Feb 19","Feb 20","Feb 21","Feb 22"]
                }
                }
                var chart = new ApexCharts(document.querySelector("#chart1"), options);
                chart.render();

                var chart2 = new ApexCharts(document.querySelector("#chart2"), options);
                chart2.render();

                </script>
                <div class="vehicles-container">
                    <?php if($data['vehicles']==0):?>
                        
                    
                        <div class="empty-vehicles">
                            <div style="text-align: center;margin:20px;">
                                <h3 >No vehicles to display!</h3>
                                
                            </div>
                            <button id="add-veh-btn" onclick="addVehicle()">Add Vehicle</button>
                            <div class="add-vehicle">
                                <form action="" method="post">
                                    <!-- <button type="button" onclick="test()">Hi</button>
                                    <script>
                                        function test(){
                                            console.log("Test1")
                                        }
                                    </script> -->
                                    <table>
                                        <tr><td class="veh-attribute">
                                            <label for="licenseplate">License Plate number</label></td>
                                            <td class="veh-value">
                                            <?php if(!empty($errors['licenseplate'])):?>
                                                <small id="Firstname-error" class="signup-error" style="color: red;"> <?= $errors['licenseplate']?> </small>
                                            <?php endif;?>
                                                <input type="text" class="vehicle-input" name="licenseplate" id="licenseplate"></td></tr>
                                        <tr><td class="veh-attribute"><p>Type</p></td>
                                            <td class="veh-value"><div style="display: block;">
                                                    
                                                    <input type="radio" class="vehicle-input-check" name="type" value="threewheel" id="type1" checked>
                                                    <label for="type1">Three Wheeler</label>
                                                </div>
                                                <div style="display: block;">
                                                    <input type="radio" class="vehicle-input-check" name="type" value="car" id="type1">
                                                    <label for="type2">Car</label>
                                                </div>
                                            </td>
                                            
                                                
                                        </tr>
                            
                                        <tr><td class="veh-attribute"><label for="color">Color</label></td><td class="veh-value"><input type="color" name="color" id="color"></td></tr>
                                    </table>
                                    <input type="submit" value="Add" class="add-btn">
                                    
                                    
                                    
                                    
                                </form>
                            </div>
                            
                        </div>
                    <?php endif;?>
                    <?php if($data['vehicles']>0):?>
                    <div class="vehicles-bar">
                        <h1>Vehicles Owned</h1>
                       <div class="vehicle1">
                            <div class="vehicle1-type">
                                <?php if($data['vehicledata']->type=='threewheel'):?>
                                <img src="<?= ROOT ?>/assets/img/images/c2.png" style="width: 100px;">
                                <?php endif;?>
                                <?php if($data['vehicledata']->type=='car'):?>
                                <img src="<?= ROOT ?>/assets/img/images/c3.png" style="width: 100px;">
                                <?php endif;?>
                                <span class="display-type"><?php echo $data['vehicledata']->type?></span>
                            </div>
                            <div class="vehicle1-lp">
                                <p style="font-weight: bold;">LicensePlate:</p>
                                <p><?php echo $data['vehicledata']->licenseplate?></p>
                            </div>
                            <div class="vehicle1-color">
                                <P style="font-weight: bold;">Color:</P>
                                <P style="background-color: <?php echo $data['vehicledata']->color?>;padding:5px;border-radius: 100%;"><?php echo $data['vehicledata']->color?></P>
                            </div>
                            <div class="vehicle1-btns">
                                <button class="update-veh">Update</button>
                                <form method="post">
                                    <input type="submit" value="delete" name="delete" class="delete-veh">
                                </form>
                            </div>

                       </div>
                       <div class="update-veh1">
                            <h2>Update current vehicle information</h2>
                            <form action="" method="post">
                                <table>
                                    <tr><td class="veh-attribute"><label for="licenseplate">License Plate number</label></td><td class="veh-value"><input type="text" class="vehicle-input" name="newlicenseplate" id="licenseplate" value="<?php echo $data['vehicledata']->licenseplate?>"></td></tr>
                                    <tr><td class="veh-attribute"><p>Type</p></td>
                                        <td class="veh-value"><div style="display: block;">
                                                
                                                <input type="radio" class="vehicle-input-check" value="threewheel" name="newtype" id="type1" checked>
                                                <label for="type1">Three Wheeler</label>
                                            </div>
                                            <div style="display: block;">
                                                <input type="radio" class="vehicle-input-check" value="car" name="newtype" id="type2">
                                                <label for="type2">Car</label>
                                            </div>
                                        </td>
                                        
                                            
                                    </tr>
                        
                                    <tr><td class="veh-attribute"><label for="color">Color</label></td><td class="veh-value"><input type="color" name="newcolor" id="color" value="<?php echo $data['vehicledata']->color?>"></td></tr>
                                </table>                               
                            <div class="save-veh-container"><input type="submit" name="save" class="save-veh-btn" value="Save"></div>
                            </form>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
                <div class="profile-container">
                    <div class="profile-bar">
                        <div class="propic-container">
                            <img src="<?= ROOT ?>/assets/img/images/profilepic.png" class="propic">
                            <button class="upload-propic"><img src="<?= ROOT ?>/assets/img/images/upload_icon.png" style="height:10px"> Upload</button>
                        </div>
                        <div class="detail-container">
                            <table class="profile-details-table">
                                <tr class="tr1">
                                    <td class="col1">Name</td>
                                    <td class="col2"><?php echo $_SESSION['USER_DATA']->name; ?></td>
                                    <td class="col3"><button><img src="<?= ROOT ?>/assets/img/images/edit_icon.png"></button></td>
                                </tr>
                                <tr>
                                    <td class="col1">NIC</td>
                                    <td class="col2">200143234422</td>
                                    <td class="col3"><button><img src="<?= ROOT ?>/assets/img/images/edit_icon.png"></button></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="col1">Registation ID</td>
                                    <td class="col2">1001324292d</td>
                                    <td class="col3"><button><img src="<?= ROOT ?>/assets/img/images/edit_icon.png"></button></td>
                                </tr>
                                <tr>
                                    <td class="col1">Email</td>
                                    <td class="col2"><?php echo $_SESSION['USER_DATA']->email; ?></td>
                                    <td class="col3"><button><img src="<?= ROOT ?>/assets/img/images/edit_icon.png"></button></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="col1">Phone</td>
                                    <td class="col2"><?php echo $_SESSION['USER_DATA']->phone; ?></td>
                                    <td class="col3"><button><img src="<?= ROOT ?>/assets/img/images/edit_icon.png"></button></td>
                                </tr>
                                <tr>
                                    <td class="col1">Date Of Birth</td>
                                    <td class="col2">09/20/2001</td>
                                    <td class="col3"><button><img src="<?= ROOT ?>/assets/img/images/edit_icon.png"></button></td>
                                </tr>
                                
                            </table>
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

        <script>
            var status = 1
            var sidenav = 1
            const addVehBtn = document.querySelector('#add-veh-btn');
            const more = document.querySelector('.more-icon');
            const navigation = document.querySelector('.side-nav')
            const active_btn = document.querySelector('.active');
            const inactive_btn = document.querySelector('.inactive');
            const status_icon = document.getElementById('status_icon');
            const hire_option = document.querySelector('.opt1');
            const activity_option = document.querySelector('.opt2');
            const vehicles_option = document.querySelector('.opt2-1');
            const profile_option = document.querySelector('.opt3');
            const logout_option = document.querySelector('.opt4')
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
            hire_option.addEventListener('click', function (){
                notification_container.style.display = 'none'
                activity_container.style.display = 'block'
                profile_container.style.display = 'none'
                vehicles_container.style.display = 'none'
                hire_option.style.backgroundColor = '#194672'
                activity_option.style.backgroundColor = ''
                profile_option.style.backgroundColor = ''
                vehicles_option.style.backgroundColor = ''
            })

            activity_option.addEventListener('click',function (){
                profile_container.style.display = 'none'
                notification_container.style.display = 'block'
                activity_container.style.display = 'none'
                vehicles_container.style.display = 'none'
                hire_option.style.backgroundColor = ''
                activity_option.style.backgroundColor = '#194672'
                profile_option.style.backgroundColor = ''
                vehicles_option.style.backgroundColor = ''
            })

            profile_option.addEventListener('click',function (){
                profile_container.style.display = 'block'
                activity_container.style.display = 'none'
                notification_container.style.display = 'none'
                vehicles_container.style.display = 'none'
                profile_option.style.backgroundColor = '#194672'
                activity_option.style.backgroundColor = ''
                vehicles_option.style.backgroundColor = ''
                hire_option.style.backgroundColor = ''
            })



            vehicles_option.addEventListener('click',function (){
                profile_container.style.display = 'none'
                activity_container.style.display = 'none'
                notification_container.style.display = 'none'
                vehicles_container.style.display = 'block'
                vehicles_option.style.backgroundColor = '#194672'
                profile_option.style.backgroundColor = ''
                activity_option.style.backgroundColor = ''
                hire_option.style.backgroundColor = ''
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

            document.querySelector('.map-view-btn1').addEventListener('click', function(){
                document.querySelector('.map-route').style.display = 'block'
            })


            document.querySelector('.map-view-btn').addEventListener('click', function(){
                document.querySelector('.map-route').style.display = 'block'
            })

            document.querySelector('.close-map').addEventListener('click', function(){
                document.querySelector('.map-route').style.display = 'none'
            })

            document.querySelector('.accept-btn').addEventListener('click', function(){
                document.querySelector('.offer-container').style.display = 'block'
            })

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


        </script>
    </body>
</html>
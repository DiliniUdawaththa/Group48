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
            .opt2-1{
                background-color:#194672;
                color: white;
            }
        </style>
    </head>
    <body>
        
        <?php include 'driver_side.php'; ?>



        <div class="page-container">
            <div class="body-container">
            <div class="vehicles-container">
                    <?php if($data['vehicles']==0):?>
                        
                    
                        <div class="empty-vehicles">
                            <div style="text-align: center;margin:20px;">
                                <?php if($data['vehicleError'] != " "): ?>
                                    <h3 style="color:red"><?php echo $data['vehicleError'] ?></h3>
                                <?php endif;?>
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
                                                <div>
                                                    <input type="radio" class="vehicle-input-check" name="type" value="threewheel" id="type1" checked>
                                                    <label for="type1">Three Wheeler</label>
                                                </div>
                                                <div style="display: block;">
                                                    <input type="radio" class="vehicle-input-check" name="type" value="bike" id="type1">
                                                    <label for="type2">Bike</label>
                                                </div>
                                                <div style="display: block;">
                                                    <input type="radio" class="vehicle-input-check" name="type" value="car" id="type1">
                                                    <label for="type2">Car</label>
                                                </div>
                                                <div style="display: block;">
                                                    <input type="radio" class="vehicle-input-check" name="type" value="Ac-car" id="type1">
                                                    <label for="type2">AC Car</label>
                                                </div>
                                            </td>
                                            
                                                
                                        </tr>
                            
                                        <tr><td class="veh-attribute"><label for="color">Color</label></td><td class="veh-value"><input type="color" name="color" id="color"></td></tr>
                                    </table>
                                    <input type="submit" name="add-vehicle" value="Add" class="add-btn">
                                    
                                    
                                    
                                    
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
                                <img src="<?= ROOT ?>/assets/img/images/threewheel.png" style="width: 100px;">
                                <?php endif;?>
                                <?php if($data['vehicledata']->type=='car'):?>
                                <img src="<?= ROOT ?>/assets/img/images/car.png" style="width: 100px;">
                                <?php endif;?>
                                <?php if($data['vehicledata']->type=='Ac-car'):?>
                                <img src="<?= ROOT ?>/assets/img/images/car.png" style="width: 100px;">
                                <?php endif;?>
                                <?php if($data['vehicledata']->type=='bike'):?>
                                <img src="<?= ROOT ?>/assets/img/images/bike.png" style="width: 100px;">
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


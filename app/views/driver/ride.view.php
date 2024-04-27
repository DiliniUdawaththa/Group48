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
            .opt3{
                    background-color:#194672;
                    color: white;
            }
        </style>
    </head>
    <body>
        
        <?php include 'driver_side.php'; ?>



        <div class="page-container">
            <div class="body-container">

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


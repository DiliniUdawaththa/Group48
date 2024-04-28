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

            #email-col2,#phone-col2{
                display:none;
            }

            .profile-update{
                height:20px;
                width:70%;
            }

            #email-upd-btn2,#phone-upd-btn2{
                display:none;
            }
        </style>
    </head>
    <body>
        
    
    <?php include 'driver_side.php'; ?>


        <div class="page-container">
            <div class="body-container">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="profile-container">
                    <div class="profile-bar">
                        <div class="propic-container">
                            <img src="<?= ROOT ?>/<?php echo $_SESSION['USER_DATA']->img_path; ?>" class="propic">
                            <button type="button" class="upload-propic" onclick="upload_pic()"><img src="<?= ROOT ?>/assets/img/images/upload_icon.png" style="height:10px"> Upload</button>
                            <button type="submit" name="update-pic" value="1" class="save-propic"><img src="<?= ROOT ?>/assets/img/images/done_icon.png" style="height:10px"> Save</button>
                            <input onchange="load_image(this.files[0])" type="file" name="photoInput" id="photoInput" style="display: none;">
                        </div>
                        <div class="detail-container">

                            <table class="profile-details-table">
                                <tr class="tr1">
                                    <td class="col1">Name</td>
                                    <td class="col2"><?php echo $_SESSION['USER_DATA']->name; ?></td>
                                    <td class="col3"></td>
                                </tr>
                                <tr>
                                    <td class="col1">Registration ID</td>
                                    <td class="col2"><?php echo $_SESSION['USER_DATA']->id; ?></td>
                                    <td class="col3"></td>
                                </tr>
                                <tr class="tr1">
                                    <td class="col1">Email</td>
                                    <td class="col2" id="email-col1"><?php echo $_SESSION['USER_DATA']->email; ?></td>
                                    <td class="col2" id="email-col2"><input type="text" class="profile-update" name="new-email"></td>
                                    <td class="col3">
                                        <button type="button" onclick="update_email()" id="email-upd-btn"><img src="<?= ROOT ?>/assets/img/images/edit_icon.png" style="height:15px"></button>
                                        <button type="submit" value="1" name="update-email" id="email-upd-btn2"><img src="<?= ROOT ?>/assets/img/images/done_icon.png" style="height:15px"></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col1">Phone</td>
                                    <td class="col2" id="phone-col1"><?php echo $_SESSION['USER_DATA']->phone; ?></td>
                                    <td class="col2" id="phone-col2"><input type="text" class="profile-update" name="new-phone"></td>
                                    <td class="col3">
                                        <button type="button" onclick="update_phone()" id="phone-upd-btn"><img src="<?= ROOT ?>/assets/img/images/edit_icon.png" style="height:15px"></button>
                                        <button type="submit" value="1"name="update-phone" id="phone-upd-btn2"><img src="<?= ROOT ?>/assets/img/images/done_icon.png" style="height:15px"></button>
                                    </td>
                                </tr>
                                <tr class="tr1">
                                    <td class="col1">Role</td>
                                    <td class="col2">Driver</td>
                                    <td class="col3"></td>
                                </tr>
                                <tr>
                                    <td class="col1">Joined Date</td>
                                    <td class="col2"><?php echo $_SESSION['USER_DATA']->date; ?></td>
                                    <td class="col3"></td>
                                </tr>
                                
                            </table>
                        </div>
                        
                        
                    </div>
                    <div class="renew-registration-container">
                        <p class="reg-exp">Your registration will be expired after <?php echo (365 - $data['dayDifference']) ?> days.</p>
                        <button type="button" class="renew-registraion">Renew Now</button>
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

        <script>
            document.querySelector('.renew-registraion').addEventListener('click', function() {
                window.location.href = "<?= ROOT ?>/driver/renewHelp";


            });

            function upload_pic(){
                document.getElementById('photoInput').click();
            }
            function load_image(file){
                var mylink = window.URL.createObjectURL(file);
                console.log(mylink);
                document.querySelector(".propic").src = mylink;
                uploadedFlag = 1;
                document.querySelector('.upload-propic').style.display = 'none';
                document.querySelector('.save-propic').style.display = 'block';
            }

            function update_email(){
                document.getElementById('email-col1').style.display = 'none';
                document.getElementById('email-col2').style.display = 'block';
                document.getElementById('email-upd-btn').style.display = 'none';
                document.getElementById('email-upd-btn2').style.display = 'block';

            }

            function update_phone(){
                document.getElementById('phone-col1').style.display = 'none';
                document.getElementById('phone-col2').style.display = 'block';
                document.getElementById('phone-upd-btn').style.display = 'none';
                document.getElementById('phone-upd-btn2').style.display = 'block';
            }
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


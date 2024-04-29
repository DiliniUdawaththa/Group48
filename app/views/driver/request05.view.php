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
                    <div class="req-content" style="text-align:center;">
                        <p class="rating-heading">Rating</p>
                        <div>
                            <h3>Mr. <?php echo ucfirst($data['customer']->name)?></h3>
                            <img src="<?= ROOT ?>/assets/img/images/default_profile.png" class="rating-pro-pic">
                            <div class="staricon">
                                <i class="fa-solid fa-star" id="star1"></i>
                                <i class="fa-solid fa-star" id="star2"></i>
                                <i class="fa-solid fa-star" id="star3"></i>
                                <i class="fa-solid fa-star" id="star4"></i>
                                <i class="fa-solid fa-star" id="star5"></i>
                            </div>
                            <input type="text" name='star' id="star" value=0>

                        </div>
                        
                       

                        
                            <center>
                            <input type="submit" name="submit-rating" value="Submit" class="submit-rating">
                            <input type="submit" name="skip-rating" value="Skip" class="skip-rating">
                            </center>
                        
                        
                        
                           
                    </div>
                    
                    <div class="reporting">
                        <p class="rating-heading">Reporting</p>
                      
                        <div class="reporting-categories">
                        <div><input type="checkbox" name="report1"  value="Inappropriate Conduct"><label >Inappropriate Conduct</label></div>
                        <div><input type="checkbox" name="report2"  value="Refuse to pay"><label >Refuse to pay</label></div>
                        <div><input type="checkbox" name="report3" value="Disrespect"><label >Disrespect</label></div>
                        <div><input type="checkbox" name="report4" value="Damaging Vehicle"><label >Damaging Vehicle</label></div>
                        <div><input type="checkbox" name="report5" value="Harassment"><label >Harassment</label></div>
                        <div><input type="checkbox" name="report6" value="Intoxication"><label >Intoxication</label></div>
                        <div><input type="checkbox" name="report7" value="Theft"><label >Theft</label></div>
                        <div><input type="checkbox" name="report8" value="Trespassing"><label >Trespassing</label></div>
                        

                        </div>
                       
                        <div class="reporttext">
                            
                            <textarea type="text" placeholder="any note" name="other" value='' class="report-txtarea" ></textarea>
                            
                        </div>  
                        
                        
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
            
            const star1 = document.getElementById('star1');
            const star2 = document.getElementById('star2');
            const star3 = document.getElementById('star3');
            const star4 = document.getElementById('star4');
            const star5 = document.getElementById('star5');
            document.getElementById('star').style.display= "none";

                star1.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = 'black';
                      star3.style.color = 'black';
                      star4.style.color = 'black';
                      star5.style.color = 'black';
                      document.getElementById('star').value=1;

                    });
                
                star2.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = '#D1B000';
                      star3.style.color = 'black';
                      star4.style.color = 'black';
                      star5.style.color = 'black';
                      document.getElementById('star').value=2;
                    });

                star3.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = '#D1B000';
                      star3.style.color = '#D1B000';
                      star4.style.color = 'black';
                      star5.style.color = 'black';
                      document.getElementById('star').value=3;
                    });

                star4.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = '#D1B000';
                      star3.style.color = '#D1B000';
                      star4.style.color = '#D1B000';
                      star5.style.color = 'black';
                      document.getElementById('star').value=4;
                    });

                star5.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = '#D1B000';
                      star3.style.color = '#D1B000';
                      star4.style.color = '#D1B000';
                      star5.style.color = '#D1B000';
                      document.getElementById('star').value=5;
                });

                
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


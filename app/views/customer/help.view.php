<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/help.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_side.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
</head>

<body>
    <div class="main">
        <!-- side bar========================= -->
        <div class="sidebar">

             <div class="barimagetag">
                <img src="<?= ROOT ?>/assets/img/logonamenw.png" alt="" class="barimage">
             </div>


             <div class="profile">
                <img src="<?= ROOT ?>/assets/img/customer/profile/<?=$img?>" alt="" class="userimage">
                <H3 class="username"><?php echo $_SESSION['USER_DATA']->role; ?> - <?=Auth::getname();?></H3>
                <h6>
                <?php for($i=0; $i<$rating; $i++){ ?>
                  <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                  <?php } for($i=$rating; $i<5; $i++){?>
                  <i class="fa-solid fa-star" ></i>
                  <?php }?>
                </h6>
             </div>
             

             <div class="linktag">
                <a href="<?= ROOT ?>/customer/ride" class="link2"><div class="linkbutton"><i class="fa-solid fa-car-tunnel"></i>Ride</div></a>
                <a href="<?= ROOT ?>/customer/add_place" class="link2"><div class="linkbutton"><i class="fa-solid fa-map-location-dot"></i>Add Place</div></a>
                <a href="<?= ROOT ?>/customer/activity" class="link2"><div class="linkbutton"><i class="fa-solid fa-file-lines"></i>Activity</div></a>
                <a href="<?=ROOT?>/customer/profile" class="link2"><div class="linkbutton"><i class="fa-solid fa-user"></i>Profile</div></a>
                <a href="<?= ROOT ?>/customer/help" class="link"><div class="linkbutton1"><i class="fa-solid fa-handshake-angle"></i>Help</div></a>
                <a href="#" class="link2"><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket"></i>Logout</div></a>
             </div>
      
             <div class="logout-container">
              <h2>Log Out</h2>
              <p class="logout-text">Are you sure you want to log out?</p>
              <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log Out</button></div>
             </div>
           
             
        </div>
        
      <!-- //------------------------------------------mobile bar----------------------------------- -->
      <div class="open-sidebar open-bar-block open-border-right" style="display:none" id="mySidebar">
            <button onclick="side_close()" class="sidebar_close_button"><i class="fa-solid fa-circle-left fa-fade"></i></button>
               <div class="barimagetag">
                <img src="<?= ROOT ?>/assets/img/logonamenw.png" alt=" " class="barimage">
             </div>


             <div class="profile">
                <img src="<?= ROOT ?>/assets/img/customer/profile/<?=$img?>" alt="" class="userimage">
                <H3 class="username"><?php echo $_SESSION['USER_DATA']->role; ?> - <?=Auth::getname();?></H3>
                <h6>
                <?php for($i=0; $i<$rating; $i++){ ?>
                  <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                  <?php } for($i=$rating; $i<5; $i++){?>
                  <i class="fa-solid fa-star" ></i>
                  <?php }?>
                </h6>
             </div>
             

             <div class="linktag">
                <a href="<?= ROOT ?>/customer/ride" class="link2"><div class="linkbutton"><i class="fa-solid fa-car-tunnel"></i>Ride</div></a>
                <a href="<?= ROOT ?>/customer/add_place" class="link2"><div class="linkbutton"><i class="fa-solid fa-map-location-dot"></i>Add Place</div></a>
                <a href="<?= ROOT ?>/customer/activity" class="link2"><div class="linkbutton"><i class="fa-solid fa-file-lines"></i>Activity</div></a>
                <a href="<?=ROOT?>/customer/profile" class="link2"><div class="linkbutton"><i class="fa-solid fa-user"></i>Profile</div></a>
                <a href="<?= ROOT ?>/customer/help" class="link"><div class="linkbutton1"><i class="fa-solid fa-handshake-angle"></i>Help</div></a>
                <a href="#" class="link2"><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket"></i>Logout</div></a>
             </div>
      
             <div class="logout-container">
              <h2>Log Out</h2>
              <p class="logout-text">Are you sure you want to log out?</p>
              <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log Out</button></div>
             </div>
          </div>
          <!-- ------------------------------------------------------------------------ -->
         <div class="container">

            <div class="h1"><center><h1>How to Request the Ride</h1></center></div>
            <center><div class="version"><i id="pc" class="fa-solid fa-desktop"></i><i id="mobile" class="fa-solid fa-mobile"></i></div></center>
            <!-- --------------------------slideshow-container--------------------------------------------------------------------------------------- -->
            <div class="slideshow-container">

              <div class="mySlides fade">               
                <img src="<?=ROOT?>/assets/img/customer/help/1.png" style="width:100%">  
                <div class="text">Step 1 <br><center><h3>slelect the location and destination</h3></center></div>  
              </div>

              <div class="mySlides fade">  
                <img src="<?=ROOT?>/assets/img/customer/help/2.png" style="width:100%">
                <div class="text">Step 2 <br><center><h3>slelect the althernative path</h3></center></div>    
              </div>

              <div class="mySlides fade">    
                <img src="<?=ROOT?>/assets/img/customer/help/3.png" style="width:100%">
                <div class="text">Step 3 <br><center><h3>slelect the vehicle</h3></center></div>    
              </div>

              <div class="mySlides fade">    
                <img src="<?=ROOT?>/assets/img/customer/help/4.png" style="width:100%">
                <div class="text">Step 4 <br><center><h3>slelect the driver & negotiate</h3></center></div>      
              </div>

              <div class="mySlides fade">    
                <img src="<?=ROOT?>/assets/img/customer/help/5.png" style="width:100%">
                <div class="text">Step 5 <br><center><h3>Waiting for driver</h3></center></div>      
              </div>

              <div class="mySlides fade">    
                <img src="<?=ROOT?>/assets/img/customer/help/6.png" style="width:100%">
                <div class="text">Step 6 <br><center><h3>Journey underway</h3></center></div>      
              </div>

              <div class="mySlides fade">    
                <img src="<?=ROOT?>/assets/img/customer/help/7.png" style="width:100%">
                <div class="text">Step 7 <br><center><h3>Rating and complain</h3></center></div>      
              </div>

            </div>
            <div class="slideshow-container1" style="display:none;">

              <div class="mySlides fade">               
                <img src="<?=ROOT?>/assets/img/customer/help/11.png" style="width:100%">  
                <div class="text">Step 1 <br><center><h3>slelect the location and destination</h3></center></div>  
              </div>

              <div class="mySlides fade">  
                <img src="<?=ROOT?>/assets/img/customer/help/12.png" style="width:100%">
                <div class="text">Step 2 <br><center><h3>slelect the althernative path</h3></center></div>    
              </div>

              <div class="mySlides fade">    
                <img src="<?=ROOT?>/assets/img/customer/help/13.png" style="width:100%">
                <div class="text">Step 3 <br><center><h3>slelect the vehicle</h3></center></div>    
              </div>

              <div class="mySlides fade">    
                <img src="<?=ROOT?>/assets/img/customer/help/14.png" style="width:100%">
                <div class="text">Step 4 <br><center><h3>slelect the driver & negotiate</h3></center></div>      
              </div>

              <div class="mySlides fade">    
                <img src="<?=ROOT?>/assets/img/customer/help/15.png" style="width:100%">
                <div class="text">Step 5 <br><center><h3>Waiting for driver</h3></center></div>      
              </div>

              <div class="mySlides fade">    
                <img src="<?=ROOT?>/assets/img/customer/help/16.png" style="width:100%">
                <div class="text">Step 6 <br><center><h3>Journey underway</h3></center></div>      
              </div>

              <div class="mySlides fade">    
                <img src="<?=ROOT?>/assets/img/customer/help/17.png" style="width:100%">
                <div class="text">Step 7 <br><center><h3>Rating and complain</h3></center></div>      
              </div>

            </div>
              <br>

              <div style="text-align:center">
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
              </div>

            <!-- -------------------------------------------------------------------------------------------------------------------- -->
            <div class="h1"><center><h1>How to Add Place</h1></center></div>
            <div class="img"><center><img src="<?=ROOT?>/assets/img/help.jpg" alt=""></center></div>
            <div class="p">
                  <p>
                    <ul>
                  <li><b>Open the Wep:</b> Launch the FareFlex wep on your mobile device and log in if necessary.

                  </li><br><li><b>Set Your Location:</b> Your app may automatically detect your current location using GPS, or you might need to enter it manually. Ensure your current location is accurate.

                    <br></li><br><li><b>Enter Destination:</b> Enter your destination address. The app should have a designated field for you to input the address, or you may be able to set the destination <br> on a map.

                    <br></li><br><li><b>View Available Options:</b> The app should display available ride options, such as different types of vehicles or services (e.g., economy, premium, shared, etc.),<br> along with estimated wait times and fares.

                    <br></li><br><li><b>Select a Ride:</b> Choose the type of ride you want based on your preferences and budget.

                    <br></li><br><li><b>Confirm the Ride:</b> After selecting a ride option, confirm your choice. The app will typically show you the driver's details, including their name, vehicle details, <br>and an estimated time of arrival.

                    <br></li><br><li><b>Payment Method:</b> Select your preferred payment method (credit card, PayPal, cash, etc.) and confirm the ride.

                    <br></li><br><li><b>Waiting for the Driver:</b> You'll be able to track the driver's location in real-time on a map. The app will also provide you with their contact information.

                   <br> </li><br><li><b>Enjoy Your Ride:</b> Once the driver arrives, hop in the vehicle, and the driver will take you to your destination.

                   <br> </li><br><li><b>Payment:</b> Payment is usually processed automatically through the app based on your chosen payment method. You may also have the option to add a tip for the driver.

                    <br></li><li><b>Rate and Review:</b> After the ride, you can rate the driver and leave a review if you'd like to provide feedback.
                  </li></ul>  
                </p>
            </div>
        </div>

        





        </div>
        <script>
  //   --------slide show--------------------------------------------------------------------
            let slideIndex = 0;
            showSlides();

            function showSlides() {
              let i;
              let slides = document.getElementsByClassName("mySlides");
              let dots = document.getElementsByClassName("dot");
              for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
              }
              slideIndex++;
              if (slideIndex > slides.length) {slideIndex = 1}    
              for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
              }
              slides[slideIndex-1].style.display = "block";  
              dots[slideIndex-1].className += " active";
              setTimeout(showSlides, 2000); // Change image every 2 seconds
            }

//------------------------logout---------------------------------------------

            const container=document.querySelector('.container')
            const logout_option = document.querySelector('.linkbutton2')
            const logout_container = document.querySelector('.logout-container')
            const cancel_button = document.querySelector('.cancel-btn')
            const logout_button = document.querySelector('.logout-btn')
                  
                   logout_option.addEventListener('click',()=>{
                    logout_container.style.display = 'block'
                    container.style.display="none";
                    })

                    cancel_button.addEventListener('click', ()=>{
                     window.location.href ="<?=ROOT?>/customer/help";
                    })
                    logout_button.addEventListener('click', ()=>{
                        window.location.href = "<?=ROOT?>/logout";
                    })
        </script>
        <div class="toggleicon" id="toggleSidebar" onclick="side_open()">
             <i class="fa-solid fa-bars"></i>
        </div>
        <script>
          function side_open() {
          document.getElementById("mySidebar").style.display = "block";
          document.querySelector('.container').style.opacity= '0.5';
          }

          function side_close() {
          document.getElementById("mySidebar").style.display = "none";
          document.querySelector('.container').style.opacity= '1';
          }

          pc=document.getElementById('pc');
          mobile=document.getElementById('mobile');
          pc_img = document.querySelector('.lideshow-container');
          mobile_img=document.querySelector('.lideshow-container1');

          pc.addEventListener('click',()=>{
            mobile_img.style.display='none';
            pc_img.style.display="block";
            pc.style.background-color='aliceblue';
            
          });
          mobile.addEventListener('click',()=>{
            mobile_img.style.display='block';
            pc_img.style.display="none";
          });
        </script>
        </body>
        </html>
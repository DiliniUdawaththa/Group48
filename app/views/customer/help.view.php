<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/help.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
</head>

<body>
    <div class="main">
        <!-- side bar========================= -->
        <div class="sidebar">

             <div class="barimagetag">
                <img src="<?= ROOT ?>/assets/img/logoname.png" alt="" class="barimage">
             </div>


             <div class="profile">
                <img src="<?= ROOT ?>/assets/img/person.png" alt="" class="userimage">
                <H3 class="username"><?php echo $_SESSION['USER_DATA']->role; ?> - <?=Auth::getname();?></H3>
                <h6>
                  <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                  <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                  <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                  <i class="fa-solid fa-star" ></i>
                  <i class="fa-solid fa-star" ></i>
                </h6>
             </div>
             

             <div class="linktag">
                <a href="<?= ROOT ?>/customer/ride" class="link"><div class="linkbutton"><i class="fa-solid fa-car-tunnel"></i>Ride</div></a>
                <a href="<?= ROOT ?>/customer/add_place" class="link"><div class="linkbutton"><i class="fa-solid fa-map-location-dot"></i>Add Place</div></a>
                <a href="<?= ROOT ?>/customer/activity" class="link"><div class="linkbutton"><i class="fa-solid fa-file-lines"></i>Activity</div></a>
                <a href="<?= ROOT ?>/customer/help" class="link"><div class="linkbutton1"><i class="fa-solid fa-handshake-angle"></i>Help</div></a>
                <a href="#" class="link"><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket"></i>Logout</div></a>
             </div>
      
             <div class="logout-container">
              <h2>Log Out</h2>
              <p class="logout-text">Are you sure you want to log out?</p>
              <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log Out</button></div>
             </div>
           
             
        </div>
         <div class="container">

            <div class="h1"><h1>How to Request the Ride</h1></div>
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
            const logout_option = document.querySelector('.linkbutton2')
            const logout_container = document.querySelector('.logout-container')
            const cancel_button = document.querySelector('.cancel-btn')
            const logout_button = document.querySelector('.logout-btn')
                  
                   logout_option.addEventListener('click',()=>{
                    logout_container.style.display = 'block'
                    })

                    cancel_button.addEventListener('click', ()=>{
                    logout_container.style.display = 'none'
                    })
                    logout_button.addEventListener('click', ()=>{
                        window.location.href = "<?=ROOT?>/logout";
                    })
        </script>
        </body>
        </html>
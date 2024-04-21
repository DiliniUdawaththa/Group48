<!DOCTYPE html>
<html>
<head>
<title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ridestep.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
</head>
<body id="body">

   <!-- --------------------------side open bar------------------------- -->

   <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

      <div class="sideprofile">
         <img src="<?= ROOT ?>/assets/img/person.jpg" alt="">
         <H3 ><?php echo $_SESSION['USER_DATA']->name; ?> </H3>
         <h6>
           <i class="fa-solid fa-star" style="color: #D1B000;"></i>
           <i class="fa-solid fa-star" style="color: #D1B000;"></i>
           <i class="fa-solid fa-star" style="color: #D1B000;"></i>
           <i class="fa-solid fa-star" ></i>
           <i class="fa-solid fa-star" ></i>
         </h6>
      </div>
                <a href="#" ><div ><i class="fa-solid fa-car-tunnel"></i>Ride</div></a>
                <a href="#" ><div ><i class="fa-solid fa-file-lines"></i>Activity</div></a>
                <a href="#" ><div ><i class="fa-solid fa-handshake-angle"></i>Help</div></a>
                <a href="#" ><div ><i class="fa-solid fa-right-from-bracket"></i>Logout</div></a>
    </div>
    
      
</div>
    <div class="ride" id="ride">
      <!-- ----------------------------------------mobile virsion top bar---------------------- -->
     
        <!-- side bar========================= -->
        <div class="sidebar">

             <div class="barimagetag">
                <img src="<?= ROOT ?>/assets/img/logoname.png" alt=" " class="barimage">
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
                <a href="<?=ROOT?>/customer/ride" class="link"><div class="linkbutton1"><i class="fa-solid fa-car-tunnel"></i>Ride</div></a>
                <a href="<?=ROOT?>/customer/add_place" class="link"><div class="linkbutton"><i class="fa-solid fa-map-location-dot"></i>Add Place</div></a>
                <a href="<?=ROOT?>/customer/activity" class="link"><div class="linkbutton"><i class="fa-solid fa-file-lines"></i>Activity</div></a>
                <a href="<?=ROOT?>/customer/help" class="link"><div class="linkbutton"><i class="fa-solid fa-handshake-angle"></i>Help</div></a>
                <a href="#" class="link"><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket"></i>Logout</div></a>
             </div>
      
             <div class="logout-container">
              <h2>Log Out</h2>
              <p class="logout-text">Are you sure you want to log out?</p>
              <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log Out</button></div>
             </div>
           
             
        </div>

<!-- ---------------------------------------------------------------------------------- -->
        <div class="ridemain">

           

             <div class="step1" id="step1">
                <h1>
                    Request a Ride now
                </h1>
                <form action="" class="step1form">
                    <div class="step1label"><label for="" >pickup location</label> <i class="fa-solid fa-location-crosshairs"></i></div>
                    <input type="text" class="step1input">
                    <div class="step1label"><label for="" >destination location</label><i class="fa-solid fa-location-dot"></i></div>    
                    <input type="text" class="step1input">
                </form>
                <button id="next1">Next</button>
             </div>
<!-- -------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------------------------------ -->
<!-- -------------------------------------------------------------------------------------------- -->
<!-- --------------------------------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------------------------------------------------- -->         
            

             <script>
            //   ------------------------------side bar open---------------------
                  function openNav() {
                     document.getElementById("mySidenav").style.width = "40vw";
                     document.getElementById("ride").style.filter = "brightness(0.7)";
                     // document.getElementById("topbar").style.filter = "brightness(0.7)";


                     }

                  function closeNav() {
                      document.getElementById("mySidenav").style.width = "0";
                      document.getElementById("ride").style.filter = "brightness(1)";
                     }


                
// rate or report start--------------------------------------------------------------
//star--------------------------------------------------------------------------------------
// ---------------------------------------------------------logout part-------------------------------------------------------------------
            const logout_option = document.querySelector('.linkbutton2')
            const logout_container = document.querySelector('.logout-container')
            const cancel_button = document.querySelector('.cancel-btn')
            const main = document.querySelector('.ridemain')
           const logout_button = document.querySelector('.logout-btn')
                logout_option.addEventListener('click',()=>{
                    logout_container.style.display = 'block'
                    main.style.display='none'
                    })

                    cancel_button.addEventListener('click', ()=>{
                    logout_container.style.display = 'none'
                    main.style.display='block'
                    })

                    logout_button.addEventListener('click', ()=>{
                        window.location.href = "<?=ROOT?>/logout";
                    })
            </script>
        </div>
    </div>
</body>
</html>
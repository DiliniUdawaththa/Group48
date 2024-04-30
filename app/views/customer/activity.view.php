<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/Activity.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_side.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
</head>
<body>
    <div class="sidebar">

        <div class="barimagetag">
           <img src="<?= ROOT ?>/assets/img/logonamenw.png" alt="" class="barimage">
        </div>


        <div class="profile">
           <img src="<?= ROOT ?>/assets/img/customer/profile/<?=$img?>" alt="" class="userimage">
           <H3 class="username"><?php echo $_SESSION['USER_DATA']->role; ?> - <?php echo $_SESSION['USER_DATA']->name; ?> </H3>
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
           <a href="<?= ROOT ?>/customer/activity" class="link"><div class="linkbutton1"><i class="fa-solid fa-file-lines"></i>Activity</div></a>
           <a href="<?=ROOT?>/customer/profile" class="link2"><div class="linkbutton"><i class="fa-solid fa-user"></i>Profile</div></a>
           <a href="<?= ROOT ?>/customer/help" class="link2"><div class="linkbutton"><i class="fa-solid fa-handshake-angle"></i>Help</div></a>
           <a href="#" class="link2"><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket"></i>Logout</div></a>
        </div>
 
        <div class="logout-container">
         <h2>Log Out</h2>
         <p class="logout-text">Are you sure you want to log out?</p>
         <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log Out</button></div>
        </div>
      
        
   </div>
   
      <!-- //---------------------------------------------mobile bar----------------------------------- -->
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
                <a href="<?= ROOT ?>/customer/activity" class="link"><div class="linkbutton1"><i class="fa-solid fa-file-lines"></i>Activity</div></a>
                <a href="<?=ROOT?>/customer/profile" class="link2"><div class="linkbutton"><i class="fa-solid fa-user"></i>Profile</div></a>
                <a href="<?= ROOT ?>/customer/help" class="link2"><div class="linkbutton"><i class="fa-solid fa-handshake-angle"></i>Help</div></a>
                <a href="<?= ROOT ?>/Login" class="link2"><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket"></i>Logout</div></a>
            </div>
      
             <div class="logout-container">
              <h2>Log Out</h2>
              <p class="logout-text">Are you sure you want to log out?</p>
              <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log Out</button></div>
             </div>
          </div>
    <!-- //----------------------------------------------------------------------------------------------- -->
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

        <div class="activity">
            <div class="heading">
                <div class="date">Date & Time</div>
                <div class="name">Name</div>
                <div class="location"> Location</div>
                <div class="location">Destination</div>
                <div class="vehicle">Vehicle</div>
                <div class="fare">Distance</div>  
                <div class="fare">Fare</div>            
            </div>
            <div class="h1"><center><h1>Activity</h1></center></div>
            <?php foreach ($rows as $row) :  ?>
            <?php if($row->state == 'Success' && $row->passenger_id==$_SESSION['USER_DATA']->id) { ?>
                <div class="data">
                    <div class="date"><span>Date&Time:-</span><?= $row->date; ?></div>
                    <div class="name"><span>Driver Name:-</span>Mr.
                        <?php
                           foreach ($rows2 as $row2) : 
                             if($row2->id == $row->driver_id)
                             {
                                echo $row2->name;
                             }
                            endforeach; 
                         ?>
                    </div>                  
                    <div class="location"><span>Location:-</span><?= $row->location; ?></div>
                    <div class="location"><span>Destination:-</span><?= $row->destination; ?></div>
                    <div class="vehicle"><span>Vehicle:-</span><?= $row->vehicle; ?></div>
                    <div class="fare"><span>Distance:-</span><?= $row->distance; ?> Km</div> 
                    <div class="fare"><span>Fare:-</span><?= $row->fare; ?>/-</div>
                </div>
           <?php } ?>
            <?php endforeach; ?>
           
            <div class="toggleicon" id="toggleSidebar" onclick="side_open()">
             <i class="fa-solid fa-bars"></i>
            </div>
            <script>
                function side_open() {
                document.getElementById("mySidebar").style.display = "block";
                document.querySelector('.activity').style.opacity= '0.5';
                }

                function side_close() {
                document.getElementById("mySidebar").style.display = "none";
                document.querySelector('.activity').style.opacity= '1';
                }
            </script>

        </div>
</body>
</html>
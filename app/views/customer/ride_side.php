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
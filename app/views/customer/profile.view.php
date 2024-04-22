<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/Profile.css">
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
                <img src="<?= ROOT ?>/assets/img/customer/profile/<?=$_SESSION['USER_DATA']->img_path;?>" alt="" class="userimage">
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
                <a href="<?= ROOT ?>/customer/ride" class="link2"><div class="linkbutton"><i class="fa-solid fa-car-tunnel"></i>Ride</div></a>
                <a href="<?= ROOT ?>/customer/add_place" class="link2"><div class="linkbutton"><i class="fa-solid fa-map-location-dot"></i>Add Place</div></a>
                <a href="<?= ROOT ?>/customer/activity" class="link2"><div class="linkbutton"><i class="fa-solid fa-file-lines"></i>Activity</div></a>
                <a href="<?=ROOT?>/customer/profile" class="link"><div class="linkbutton1"><i class="fa-solid fa-user"></i>Profile</div></a>
                <a href="<?= ROOT ?>/customer/help" class="link2"><div class="linkbutton"><i class="fa-solid fa-handshake-angle"></i>Help</div></a>
                <a href="#" class="link2"><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket"></i>Logout</div></a>
             </div>
      
             <div class="logout-container">
              <h2>Log Out</h2>
              <p class="logout-text">Are you sure you want to log out?</p>
              <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log Out</button></div>
             </div>
           
             
        </div>

        <!-- //-------------------------------------------------------------------------------------------------------------------- -->
        <div class="container">
           <div class="h1"><center><h1>Profile</h1></center></div>

           <form  method="post" enctype="multipart/form-data">
                <input type="file" name="image">
                <input type="submit" name="submit" value="Upload">
            </form>
        </div>

</div>
</body>
</html>
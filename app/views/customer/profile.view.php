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
        <!-- side bar=========================  -->
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
               <div class="main_box">
                 <div class="image_box">
                 <?php foreach ($rows as $row) : ?>
                    <?php if($row->id==$_SESSION['USER_DATA']->id) { ?>
                    <img src="<?= ROOT ?>/assets/img/customer/profile/<?=$img?>" alt="" class="propic">
                    <input type="file" name="image" id="fileInput" onchange="load_image(this.files[0])" style="display:none;">
                      <label for="fileInput" style="cursor: pointer; margin:30px">
                          <center><span alt="Upload File" class="upload_file"style=" "> Upload <i class="fa-solid fa-upload"></i> </span></center>
                      </label>
                      <?php if(!empty($errors['img'])):?>
                        <center><small id="Firstname-error" class="signup-error" style="color:red;" > <?=$errors['img']?></small></center>
                    <?php endif;?>
                 </div>
                 
                 
                 <div class="input_box">
                    <label for="">Name</label><br>
                    <input type="text" name="name" value="<?=$row->name;?>" readonly><br>
                    <label for="">E-Mail Address</label><br>
                    <input type="text" name="email" value="<?=$row->email;?>" readonly><br>
                    <label for="">Mobile Number</label><br>
                    <input type="text" name="phone" value="<?=$row->phone;?>"><br>
                    <?php if(!empty($errors['phone'])):?>
                        <center><small id="Firstname-error" class="signup-error" style="color:red;" > <?=$errors['phone']?></small></center>
                    <?php endif;?>
                    <label for="" >Address</label><br>
                    <input type="text" value="<?=$row->address;?>" name="address"><br>
                    <?php if(!empty($errors['address'])):?>
                        <center><small id="Firstname-error" class="signup-error" style="color:red;" > <?=$errors['address']?></small></center>
                    <?php endif;?>
                    <label for="">NIC No</label><br>
                    <input placeholder="xxxxxxxxxxxx" type="text" value="<?=$row->nic;?>" name="nic" <?php if($row->nic !== ''){echo 'readonly';}?>><br>
                    <?php if(!empty($errors['nic'])):?>
                        <center><small id="Firstname-error" class="signup-error" style="color:red;" > <?=$errors['nic']?></small></center>
                    <?php endif;?>
                    <label for="">DOB</label><br>
                    <input placeholder="dd/mm/yyyy" type="text" value="<?=$row->dob;?>" name="dob" <?php if($row->dob !== ''){echo 'readonly';}?>><br>
                    <?php if(!empty($errors['dob'])):?>
                        <center><small id="Firstname-error" class="signup-error" style="color:red;" > <?=$errors['dob']?></small></center>
                    <?php endif;?>
                 </div>
                    <?php }?>
                    <?php endforeach; ?>
                 </div>
                <input type="submit" name="submit" value="Upload" class="upload">
            </form>
        </div>

</div>
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

          function load_image(file){
                var mylink = window.URL.createObjectURL(file);
                console.log(mylink);
                document.querySelector(".propic").src = mylink;
          }
        </script>
</body>
</html>
<script>
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
                     window.location.href ="<?=ROOT?>/customer/Profile";
                    })
                    logout_button.addEventListener('click', ()=>{
                        window.location.href = "<?=ROOT?>/logout";
                    })
</script>
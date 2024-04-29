<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/Add_Place.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_side.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <!-- map  -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- //routing css -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <!-- search -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
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
                <a href="<?= ROOT ?>/customer/add_place" class="link"><div class="linkbutton1"><i class="fa-solid fa-map-location-dot"></i>Add Place</div></a>
                <a href="<?= ROOT ?>/customer/activity" class="link2"><div class="linkbutton"><i class="fa-solid fa-file-lines"></i>Activity</div></a>
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
                <a href="<?= ROOT ?>/customer/add_place" class="link"><div class="linkbutton1"><i class="fa-solid fa-map-location-dot"></i>Add Place</div></a>
                <a href="<?= ROOT ?>/customer/activity" class="link2"><div class="linkbutton"><i class="fa-solid fa-file-lines"></i>Activity</div></a>
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
<!-- -------------------------------------------------------------------------------------------------------------------------------------- -->
        

         <div class="container_part">
          <!-- <div></div> -->
         <center>
          <div class="place_container">
          
            <div class="add_form" id="add_form">
              
                 <div class="place_top"><h1><i class="fa-solid fa-map-location-dot"></i> Add Place</h1></div>
                 <div class="form_map">
                 <form name="addPlaceForm" action="" method="POST" >
                 <div class="input_box" id="input_box"> 
                      <div>
                          <label for="name" class="label" >Placename</label><br>
                        </div>
                          <input value="<?= set_value('name') ?>" type="text" name="name" id="name" class="<?=!empty($errors['name']) ? 'error':'';?>" >
                          <?php if(!empty($errors['name'])):?>
                             <small id="Firstname-error" class="signup-error" style="color: red;"> <?= $errors['name']?> </small>
                           <?php endif;?>
                          <br>
                       <div>
                          <label for="category" class="label" >Category</label><br>
                        </div>
                          <input value="<?= set_value('category') ?>" list="categorys" name="category" id="categoryInput" >
                              <datalist id="categorys">
                                <option value="Home">
                                <option value="Food & Drink">
                                <option value="Shopping">
                                <option value="Education">
                                <option value="Religion">
                                <option value="Hotels & lodging"></option>
                                <option value="Hospital"></option>
                                <option value="Bank"></option>
                                <option value="Office"></option>
                                <option value="Other"></option>
                              </datalist>
                              <?php if(!empty($errors['category'])):?>
                             <small id="Firstname-error" class="signup-error" style="color: red;"> <?= $errors['category']?> </small>
                           <?php endif;?>
                              <br>
                          
                         <div class="address">
                          <label for="address" class="label">Address</label><br>
                          </div>
                          <input type="text" id="location_name" name="location" value="<?= set_value('location') ?>" >
                          <?php if(!empty($errors['address'])):?>
                             <small id="Firstname-error" class="signup-error" style="color: red;"> <?= $errors['address']?> </small>
                           <?php endif;?>
                          <br>
                        
                          <input type="text" id="lat" name="lat">
                          <input type="text" id="long" name="lng">
                          <button  id="submit_btn" class="submit_btn">Submit</button>
                          
                          <a href="<?=ROOT?>/customer/add_place"><small class="skip"><center>skip</center></small></a>
                  </div>
              </form>
              <div class="map_point" id="map_point">
                    <div id="map"></div>
                  </div>
            </div>
           
          </div>
           
          </div>
         </center>
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


            //  ------------------------------------------------------------------------------------------------------------------------ 
            // categery list part 
            const categoryInput = document.getElementById('categoryInput');

                      categoryInput.addEventListener('input', function () {
                          const enteredValue = this.value;
                          const options = document.getElementById('categorys').getElementsByTagName('option');
                          let validOption = false;

                          for (let i = 0; i < options.length; i++) {
                              if (options[i].value === enteredValue) {
                                  validOption = true;
                                  break;
                              }
                          }

                          if (!validOption) {
                              // Clear the input if the entered value is not in the datalist
                              this.value = '';
                          }
                      });

      // --------------------------------------------------------------------------------------------------------------------------------------------------------------------
    

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

         
        </script>
      </body>
</html>

<!-- leaflet js code -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
 <!-- routing js file -->
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<!-- search -->
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
           
    // map instalizion
    var map = L.map('map').setView([ 6.863695780668124,79.90294212928187], 12);
    // google street
    googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        });
    googleStreets.addTo(map)

    L.Control.geocoder().addTo(map);



    // map on click show marker---------------------------------------------------
    var currentMarker = null;
    var locationName;
    var apiKey = '2688fa5aa40a47f5a9854c202549d631';

    var requestOptions = {
            method: 'GET',
            redirect: 'follow'
            };
   
    function onMarkerClick(e) {
        if (currentMarker !== null) {
            map.removeLayer(currentMarker);
        }
        var newMarker = L.marker(e.latlng).addTo(map);

        //get the place name-------------------------------------------------------
        fetch(`https://api.geoapify.com/v1/geocode/reverse?lat=${e.latlng.lat}&lon=${e.latlng.lng}&apiKey=${apiKey}`, requestOptions)
              .then(response => response.json())
              .then(result => {
              locationName = result.features[0].properties.formatted;
              newMarker.bindPopup(locationName).openPopup();
              var location = locationName.split(',');
              console.log(location.length);
              if(location.length<4){
                   document.getElementById("location_name").value=locationName;
              }
              else{
                  document.getElementById("location_name").value=location[0]+','+location[1]+','+location[2];
              }
                })
              .catch(error => console.log('error', error));

         newMarker.bindPopup(locationName).openPopup();
         document.getElementById("lat").value=e.latlng.lat;
         document.getElementById("long").value=e.latlng.lng;
        currentMarker = newMarker;

    }

    map.on('click', onMarkerClick);


  </script>
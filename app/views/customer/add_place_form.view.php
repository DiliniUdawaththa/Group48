<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/Add_Place.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <!-- map  -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- //routing css -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <!-- search -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <style>
        .error {
            border: 1px solid red;
            color: red;
        }
        .message{
            /* margin-top:; */
            height: 50px;
            width: 100%;
            margin-bottom: 10px;
            
         }
         .message p{
            padding: 10px;
            font-size: 1em;
            color: #026334;
            background-color: #a7cfbc;
            
            
         }
         #map{
          display: block;
          width: 100%;
          height: 450px;
         }
    </style>
</head>

<body>
    <div class="main">
        <!-- side bar========================= -->
        <div class="sidebar">

             <div class="barimagetag">
                <img src="<?= ROOT ?>/assets/img/logoname.png" alt="" class="barimage">
             </div>


             <div class="profile">
                <img src="<?= ROOT ?>/assets/img/person.jpg" alt="" class="userimage">
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
                <a href="<?= ROOT ?>/customer/add_place" class="link"><div class="linkbutton1"><i class="fa-solid fa-map-location-dot"></i>Add Place</div></a>
                <a href="<?= ROOT ?>/customer/activity" class="link"><div class="linkbutton"><i class="fa-solid fa-file-lines"></i>Activity</div></a>
                <a href="<?= ROOT ?>/customer/help" class="link"><div class="linkbutton"><i class="fa-solid fa-handshake-angle"></i>Help</div></a>
                <a href="#" class="link"><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket"></i>Logout</div></a>
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
              <form name="addPlaceForm" action="" method="post" onsubmit="return validateForm()">
                 <div class="place_top"><h1><i class="fa-solid fa-map-location-dot"></i> Add Place</h1></div>
                 <div class="input_box">

                       

                      <div>
                          <label for="name" class="label">Placename</label><br>
                        </div>
                          <input value="<?= set_value('name') ?>" type="text" name="name" id="name" class="<?=!empty($errors['name']) ? 'error':'';?>" required>
                          <?php if(!empty($errors['name'])):?>
                             <small id="Firstname-error" class="signup-error" style="color: red;"> <?= $errors['name']?> </small>
                           <?php endif;?>
                          <br>
                       <div>
                          <label for="category" class="label" >Category</label><br>
                        </div>
                          <input value="<?= set_value('category') ?>" list="categorys" name="category" id="categoryInput" required>
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
                              <br>
                         <div class="address">
                          <label for="address" class="label">Address</label>
                          <!-- <i class="fa-solid fa-location-dot"></i> -->
                          <br>
                        </div>
                          <i class="fa-solid fa-location-dot" id="set_location"></i>
                          <input value="<?= set_value('address') ?>" type="text" name="address" id="address" required>
                          <br>
                          <button  id="submit_btn" class="submit_btn">Submit</button>
                          <br>
                          <a href="<?=ROOT?>/customer/add_place"><small class="skip"><center>skip</center></small></a>
                  </div>
                  <div id="map">

                  </div>

              </form>
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

                    // --------------------------------------------------------------------------------------------

              const table = document.querySelector('.add_table')
              const form = document.querySelector('.add_form')
              const skip = document.querySelector('.skip')
              const plus = document.getElementById('plus')
             

            // plus.addEventListener('click',()=>{
            //     form.style.display = 'block'
            //     table.style.display = 'none'
            //   })

            //   skip.addEventListener('click',()=>{
            //     form.style.display = 'none'
            //     table.style.display = 'block'
            //   })
              // ------------------------------------------------------

          


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
    
        // ------------------------------------------------------------------------------------------------------------------------

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
    var map = L.map('map').setView([ 7.8774, 80.7003], 9);
    // google street
    googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        });
    googleStreets.addTo(map)

    L.Control.geocoder().addTo(map);


    // on click show marker---------------------------------------------------
    var currentMarker = null;
    function onMarkerClick(e) {
        if (currentMarker !== null) {
            map.removeLayer(currentMarker);
        }
        var newMarker = L.marker(e.latlng).addTo(map);
        var destinationName = '';

        //get the place name-------------------------------------------------------
        fetch(`https://api.geoapify.com/v1/geocode/reverse?lat=${e.latlng.lat}&lon=${e.latlng.lng}&apiKey=${apiKey}`, requestOptions)
              .then(response => response.json())
              .then(result => {
              destinationName = result.features[0].properties.formatted;
                })
              .catch(error => console.log('error', error));

              console.log(destinationName)

         newMarker.bindPopup(destinationName).openPopup();
        console.log("Latitude: " + e.latlng.lat + ", Longitude: " + e.latlng.lng);
        currentMarker = newMarker;
    }

    map.on('click', onMarkerClick);
  </script>
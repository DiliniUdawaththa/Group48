<!DOCTYPE html>
<html>
<head>
<title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_step1.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_side.css">   
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- //routing css -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <!-- search -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />


    <style>
        body{
            margin: 0;
            padding: 0;
        }
       
        small{
            color: red;
        }
        .coodinates{
            display: none;
        }
    </style>
</head>
<body id="body">

   <?php include 'ride_side.php'; ?>
   

<!-- ---------------------------------------------------------------------------------- -->
<div class="activity">
        <div class="searchbox">

        <div class="search" >
                <h1>                   
                     Go anywhere with <br>FareFlex
                </h1>
                <br>
                <br>
                <h2>
                    Request a ride, hop in, and go.
                </h2>   
                <form action="" method="POST">
                    <?php if(!empty($errors['location'])):?>
                         <center><small id="Firstname-error" class="signup-error" > <?=$errors['location']?></small></center>
                    <?php endif;?>
                <div class="search-box">
                    <input type="text" name="location" class="search-input" id="searchInput1" placeholder="Enter location..." onfocus="showDropdown(1)" oninput="filterItems(this.value, 1)">
                    <i class="search-icon" onclick="toggleDropdown(1)">🔍</i>
                    <i  class="fa-regular fa-circle" id="searchicon"></i>
                    <div class="dropdown-list" id="dropdownList1">
                        <div class="dropdown-list-item" onclick="selectItem(this, 1)"><i class="fa-solid fa-location-crosshairs"></i> Live location</div>
                        <div class="dropdown-list-item" onclick="selectItem(this, 1)"><i class="fa-solid fa-map-pin"></i> Set Location</div>
                        <?php foreach ($rows as $row) : ?>
                            <div class="dropdown-list-item" onclick="selectItem(this, 1)"><i class="<?= $row->icon; ?>"></i> <?= $row->name; ?></div>
                        <?php endforeach; ?>
                    </div>                
                </div>

                <input type="text" name="l_lat" id="l.lat" value="0.000" class="coodinates"><input type="text" name="l_long"  id="l.long" value="0.000" class="coodinates" >

                <div class="search-box">

                    <input type="text" name="destination" class="search-input" id="searchInput2" placeholder="Enter destination..." onfocus="showDropdown(2)" oninput="filterItems(this.value, 2)" >
                    <i class="search-icon" onclick="toggleDropdown(2)">🔍</i>
                    <i class="fa-solid fa-circle" id="searchicon"></i>
                    <div class="dropdown-list" id="dropdownList2">
                        <div class="dropdown-list-item" onclick="selectItem(this, 2)"><i class="fa-solid fa-map-pin"></i> Set Location</div>
                        <?php foreach ($rows as $row) : ?>
                            <div class="dropdown-list-item" onclick="selectItem(this, 2)"><i class="<?= $row->icon; ?>"></i> <?= $row->name; ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
               
                <input type="text" name="d_lat" id="d.lat" value="0.000" class="coodinates"><input type="text" name="d_long"  id="d.long"  value="0.000" class="coodinates">

                <a href="<?=ROOT?>/customer/ride_step2" class="golink"><button id="Go" class="go" onclick="sendDataToPHP()"><b>Go</b></button></a>
                
                </form>
               
            </div>
            <div id="map" class="map" > </div>
        </div>
    </div>
    <script>
            const logout_option = document.querySelector('.linkbutton2')
            const logout_container = document.querySelector('.logout-container')
            const cancel_button = document.querySelector('.cancel-btn')
           const logout_button = document.querySelector('.logout-btn')
           const plus=document.getElementById('plus');
                   logout_option.addEventListener('click',()=>{
                      logout_container.style.display = 'block'
                      plus.style.display="none";
                      })

                    cancel_button.addEventListener('click', ()=>{
                      window.location.href ="<?=ROOT?>/customer/add_place";
                      })
                    logout_button.addEventListener('click', ()=>{
                        window.location.href = "<?=ROOT?>/logout";
                    })
        </script>
    <script>
        var lat,long,lat1,lon1;
        var markers=[];
        let isDropdownShown = false;
        //geocode-reverse api
        var apiKey = '2688fa5aa40a47f5a9854c202549d631';
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
            };
    
        function toggleDropdown(index) {
            const dropdownList = document.getElementById("dropdownList" + index);
            dropdownList.style.display = isDropdownShown ? "none" : "block";
            isDropdownShown = !isDropdownShown;
        }
    
        function showDropdown(index) {
            const dropdownList = document.getElementById("dropdownList" + index);
            dropdownList.style.display = "block";
            isDropdownShown = true;
        }
    
        function hideDropdown(index) {
            const dropdownList = document.getElementById("dropdownList" + index);
            dropdownList.style.display = "none";
            isDropdownShown = false;
        }
    
        function filterItems(input, index) {
            const dropdownList = document.getElementById("dropdownList" + index);
            const items = dropdownList.getElementsByClassName("dropdown-list-item");
    
            for (let i = 0; i < items.length; i++) {
                const item = items[i];
                const text = item.innerText.toLowerCase();
    
                if (text.includes(input.toLowerCase())) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            }
        }
    
        function selectItem(item, index) {
            const searchInput = document.getElementById("searchInput" + index);
            searchInput.value = item.innerText;
            hideDropdown(index);

            const selectedValue = item.innerText;
            if (selectedValue === " Live location" && index===1) {
               
              //Real time tracking
                if(!navigator.geolocation){
                        console.log("Error")
                    }else{
                        //automatically coordinate change
                        // setInterval(()=>{
                            //get current position
                            navigator.geolocation.getCurrentPosition(getPosition)
                        // },5000);
                    
                    }
                    var marker,circle;
                    if (!markers.length == 0) {
                             deleteAllMarkers();
                         }

                    function getPosition(position){
                        console.log(position)  
                         lat=position.coords.latitude
                         long=position.coords.longitude
                        var accuracy= position.coords.accuracy

                        if(marker){
                            map.removeLayer(marker)
                        }
                        if(circle){
                            map.removeLayer(circle)
                        }

                        marker=L.marker([lat,long])
                        map.removeLayer(marker);
                        markers.push(marker)
                        // marker.addTo(map)
                        circle =L.circle([lat,long],{radius:accuracy})

                        var featureGroup = L.featureGroup([marker,circle]).addTo(map)

                        map.fitBounds(featureGroup.getBounds())

                        console.log("your coordinate is Lat:"+lat+"Long"+long+"Accuracy"+accuracy)

                        document.getElementById("l.lat").value=lat;
                        document.getElementById("l.long").value=long;
                        
                        fetch(`https://api.geoapify.com/v1/geocode/reverse?lat=${lat}&lon=${long}&apiKey=${apiKey}`, requestOptions)
                        .then(response => response.json())
                        .then(result => {
                            var locationName = result.features[0].properties.formatted; 
                            var location = locationName.split(',');
                            document.getElementById("searchInput1").value=location[0]+','+location[location.length - 1];
                        })
                        .catch(error => console.log('error', error));
                   
                        // map.setView(marker, 18);
                    }
                 } 

//--------------------------------set location ------------------------------------------------------------------------------
                          else if (selectedValue === " Set Location" && index===1) {
                              if (!markers.length == 0) {
                                    deleteAllMarkers();
                                }
                               lat=6.863695780668124;
                               long=79.90294212928187;
                              var marker=L.marker([lat,long] ,{draggable: true}).addTo(map);
                               map.flyTo([lat,long], 12)
                               marker.on('dragend', function(event){
                                    var marker = event.target;  // Get the marker object
                                    var position = marker.getLatLng();  // Get marker's position
                                    var lat = position.lat;  // Get latitude
                                    var long = position.lng;  // Get longitude
                                    document.getElementById("l.lat").value=lat;
                                    document.getElementById("l.long").value=long;

                                        fetch(`https://api.geoapify.com/v1/geocode/reverse?lat=${lat}&lon=${long}&apiKey=${apiKey}`, requestOptions)
                                            .then(response => response.json())
                                            .then(result => {
                                                var locationName = result.features[0].properties.formatted; 
                                                var location = locationName.split(',');
                                                document.getElementById("searchInput1").value=location[0]+','+location[location.length - 1];
                                            })
                                            .catch(error => console.log('error', error));
                                                    });
                                markers.push(marker)
                                document.getElementById("l.lat").value=lat;
                                document.getElementById("l.long").value=long;

                                fetch(`https://api.geoapify.com/v1/geocode/reverse?lat=${lat}&lon=${long}&apiKey=${apiKey}`, requestOptions)
                                    .then(response => response.json())
                                    .then(result => {
                                        var locationName = result.features[0].properties.formatted; 
                                        var location = locationName.split(',');
                                        document.getElementById("searchInput1").value=location[0]+','+location[location.length - 1];
                                    })
                                    .catch(error => console.log('error', error));
                          }

//----------------------------------------------------------------------------------------------------------------------------------
               <?php foreach ($rows as $row) : ?>
                        else if (selectedValue === " <?= $row->name; ?>" && index===1) {
       
                            if (!markers.length == 0) {
                                    deleteAllMarkers();
                                }
                            var marker=L.marker([<?= $row->lat; ?>,<?= $row->lng; ?>])
                            markers.push(marker)
                            marker.addTo(map);
                            map.flyTo([<?= $row->lat; ?>,<?= $row->lng; ?>], 14)

                            document.getElementById("l.lat").value=<?= $row->lat; ?>;
                                document.getElementById("l.long").value=<?= $row->lng; ?>;
                                }
                      <?php endforeach; ?>
//-------------------------------------------------------------------------------------------------------------------------------------                       }
                        else if (selectedValue === " Set Location" && index===2) {
                              if (!markers.length == 0) {
                                    deleteAllMarkers();
                                }
                              var lat1=6.863695780668124;
                              var long1=79.90294212928187;
                               var marker=L.marker([lat1,long1] ,{draggable: true}).addTo(map);
                               map.flyTo([lat1,long1], 12)
                               marker.on('dragend', function(event){
                                    var marker = event.target;  // Get the marker object
                                    var position = marker.getLatLng();  // Get marker's position
                                    var lat1 = position.lat;  // Get latitude
                                    var long1 = position.lng;  // Get longitude
                                    document.getElementById("d.lat").value=lat1;
                                    document.getElementById("d.long").value=long1;

                                    fetch(`https://api.geoapify.com/v1/geocode/reverse?lat=${lat1}&lon=${long1}&apiKey=${apiKey}`, requestOptions)
                                        .then(response => response.json())
                                        .then(result => {
                                            var destinationName = result.features[0].properties.formatted;
                                            var destination = destinationName.split(',');
                                             document.getElementById("searchInput2").value=destination[0]+','+destination[destination.length - 1];
                                        })
                                        .catch(error => console.log('error', error));

                                });
                                markers.push(marker)
                                document.getElementById("d.lat").value=lat1;
                                document.getElementById("d.long").value=long1;

                                fetch(`https://api.geoapify.com/v1/geocode/reverse?lat=${lat1}&lon=${long1}&apiKey=${apiKey}`, requestOptions)
                                        .then(response => response.json())
                                        .then(result => {
                                            var destinationName = result.features[0].properties.formatted;
                                            var destination = destinationName.split(',');
                                             document.getElementById("searchInput2").value=destination[0]+','+destination[destination.length - 1];
                                        })
                                        .catch(error => console.log('error', error));
                          }
//---------------------------------------------------------------------------------------------------------------------------------------------
                     <?php foreach ($rows as $row) : ?>
                        else if (selectedValue === " <?= $row->name; ?>" && index===2) {
       
                            if (!markers.length == 0) {
                                    deleteAllMarkers();
                                }
                            var marker=L.marker([<?= $row->lat; ?>,<?= $row->lng; ?>])
                            markers.push(marker)
                            marker.addTo(map);
                            map.flyTo([<?= $row->lat; ?>,<?= $row->lng; ?>], 14)

                            document.getElementById("d.lat").value=<?= $row->lat; ?>;
                                document.getElementById("d.long").value=<?= $row->lng; ?>;
                                }
                      <?php endforeach; ?>
                         
                        

                         function deleteAllMarkers() {
                            for (var i = 0; i < markers.length; i++) {
                                map.removeLayer(markers[i]); // Remove each marker from the map
                            }
                            markers = [];}
                        }
                       

                   

    </script>
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
    var map = L.map('map').setView([ 7.8774, 80.7003], 8);
    // google street
    googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        });
    googleStreets.addTo(map)

    L.Control.geocoder().addTo(map);
</script>

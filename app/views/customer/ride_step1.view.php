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
        #map{
            width: 50%;
            height: 90vh;
        }
    </style>
</head>
<body id="body">
   <div class="topbar" id="topbar">
      <div class="topbarin">
         <div>
            <i class="fa-solid fa-bars" onclick="openNav()" id="menu"></i>
            <img src="<?= ROOT ?>/assets/img/logo_name.png" alt="">
         </div>
         <div><img src="<?= ROOT ?>/assets/img/person.jpg" alt="" class="person"></div>
   </div>

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
                <!-- <form action="" method="POST"> -->
                <div class="search-box">
                    <input type="text" class="search-input" id="searchInput1" placeholder="Enter location..." onfocus="showDropdown(1)" oninput="filterItems(this.value, 1)">
                    <i class="search-icon" onclick="toggleDropdown(1)">🔍</i>
                    <i  class="fa-regular fa-circle" id="searchicon"></i>
                    <div class="dropdown-list" id="dropdownList1">
                        <div class="dropdown-list-item" onclick="selectItem(this, 1)"><i class="fa-solid fa-location-crosshairs"></i> Live location</div>
                        <div class="dropdown-list-item" onclick="selectItem(this, 1)">Petta</div>
                        <div class="dropdown-list-item" onclick="selectItem(this, 1)">Option 3</div>
                    </div>
                </div>
                
                <div class="search-box">
                    <input type="text" class="search-input" id="searchInput2" placeholder="Enter destination..." onfocus="showDropdown(2)" oninput="filterItems(this.value, 2)" >
                    <i class="search-icon" onclick="toggleDropdown(2)">🔍</i>
                    <i class="fa-solid fa-circle" id="searchicon"></i>
                    <div class="dropdown-list" id="dropdownList2">
                        <div class="dropdown-list-item" onclick="selectItem(this, 2)">Option 1</div>
                        <div class="dropdown-list-item" onclick="selectItem(this, 2)">UCSC</div>
                        <div class="dropdown-list-item" onclick="selectItem(this, 2)">Option 3</div>
                    </div>
                </div>

                <a href="<?=ROOT?>/customer/ride_step2" class="golink"><button id="Go" class="go" onclick="sendDataToPHP()"><b>Go</b></button></a>
                
                <!-- </form> -->
               
            </div>
            <div id="map" > </div>
        </div>
    </div>
    <script>
               const logout_option = document.querySelector('.linkbutton2')
            const logout_container = document.querySelector('.logout-container')
            const cancel_button = document.querySelector('.cancel-btn')
            const main = document.querySelector('.activity')
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
   
    <script>
         var lat,long,lat1,lon1;
        let isDropdownShown = false;
    
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
                        // marker.addTo(map)
                        circle =L.circle([lat,long],{radius:accuracy})

                        var featureGroup = L.featureGroup([marker,circle]).addTo(map)

                        map.fitBounds(featureGroup.getBounds())

                        console.log("your coordinate is Lat:"+lat+"Long"+long+"Accuracy"+accuracy)
                         
                        

                   
                        // map.setView(marker, 18);
                    }
                        } 
                    else if (selectedValue === "Petta" && index===1) {
                       
                        // map.removeLayer(marker);

                        var marker=L.marker([6.901963,80.861292])
                        map.removeLayer(marker);
                        // map.setView(marker, 18);
                       
                        marker.addTo(map);
                       
                            map.flyTo([6.901963,80.861292], 14)
                            lat=6.901963;
                            long=80.861292;
                        
                            // map.setView(marker, 18);
                          }

                          else if (selectedValue === "UCSC" && index===2) {
                       
                       // map.removeLayer(marker);

                       var marker2=L.marker([6.901963,79.861292])
                       map.removeLayer(marker2);
                       // map.setView(marker, 18);
                      
                       marker2.addTo(map);
                             lat1=6.901963;
                             lon1=79.861292;
                      
                           map.flyTo([lat1,lon1], 16)

                       
                           // map.setView(marker, 18);
                         }
                        }



                        //----------------------------------------------------------------------------------------------------------
//                       var go = document.getElementById('Go');
// var Routing;

// go.addEventListener('click', () => {
//     Routing = L.Routing.control({
//         waypoints: [
//             L.latLng(lat, long),
//             L.latLng(lat1,lon1)
//         ]
//     });

//     Routing.addTo(map);
//     var lat2=(lat1+lat)/2
//     var lon2=(lon1+long)/2
//     map.flyTo([lat2,lon2], 14)
// });
  


        // function sendDataToPHP() {

        //     // Get data
        //     var name = "John";
        //     var email = "john@example.com";

        //     // Create an XMLHttpRequest object
        //     var xhr = new XMLHttpRequest();

        //     // Configure the request
        //     xhr.open("POST", "Customer.php", true);
        //     xhr.setRequestHeader("Content-Type", "<?=ROOT?>/customer");

        //     // Define what happens on successful data submission
        //     // xhr.onreadystatechange = function() {
        //     //     if (xhr.readyState == 4 && xhr.status == 200) {
        //     //         // Handle the response from the PHP script
        //     //         alert(xhr.responseText);
        //     //     }
        //     // };

        //     // Convert data to JSON format
        //     var data = JSON.stringify({name: name, email: email});


        //     // Send the POST request with the data
        //     xhr.send(data);
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
    </script>
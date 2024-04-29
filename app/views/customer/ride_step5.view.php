<!DOCTYPE html>
<html>
<head>
<title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
<!-- <meta http-equiv="refresh" content="15" id="refreshMeta"> -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_step5.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_side.css"> 
    <!-- google font   -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />

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
      
    </style>
</head>
<body id="body">
 

   <?php include 'ride_side.php'; ?>
 
<!-- ---------------------------------------------------------------------------------- -->
<div class="activity">
        <div class="mainbox">
            <div class="contant" >
             <center>
                    <h2>Driver on the way</h2> 
                    <h6>Estimate time </h6>    
                    <h5 id='time_limit'></h5>
                    <div class="driver_profile">
                        <img class="driver_image" src="<?= ROOT ?>/assets/img/customer/person.png" alt="">
                        <img class="driver_vehicle" src="<?= ROOT ?>/assets/img/customer/<?=$vehicle?>.png" alt="">
                    </div>
            </center>
            
            <button class="whatapp" onclick="openWhatsApp()">
              <i class="fa-solid fa-phone"></i>
              </button>
            <button class="chatbot-toggler">
                <span class="material-symbols-rounded">chat</span>
                <span class="material-symbols-outlined">close</span>
              </button>
              <button class="chatbot-toggler1">
                <span class="material-symbols-rounded1"><i class="fa-solid fa-xmark"></i></span>
                <span class="material-symbols-outlined1"><i class="fa-solid fa-xmark"></i></span>
              </button>
              <form action="" method='POST' id="message_form">
                <div class="chatbot">    
                    <span class="close-btn material-symbols-outlined"></span>
                    <center>
                    <div id="message1">Come fast</div>
                    <div id="message2">I'm waiting for you</div>
                    <div id="message3">Hurry up, please</div>
                    <div id="message4">Running late, sorry</div>
                    <div id="message5">Please be on time</div>
                    <div id="message6">See you soon</div>
                    <div id="message7">I'm almost there</div>
                    <div id="message8">Will arrive in a few minutes</div>
                    <div id="message9">I'm here, where are you?</div>
                    <div id="message10">Please wait a moment</div>
                    <div id="message11">Let's get moving</div>
                    <div id="message12">Let me know when you're here</div>
                    <input type="text" name="message" id="passenger_message" style="display:none;">
                    </center>
                </div>
              </form> 
              <form action="" method='POST' id="cancel_form">
              <div class="chatbot1">    
                    <span class="close-btn1 material-symbols-outlined"></span>
                    <center>
                    <div id="cancel1">no driver</div>
                    <div id="cancel2">change of plans</div>
                    <div id="cancel3">delayed pickup</div>
                    <div id="cancel4">vehicle issue</div>
                    <div id="cancel5">Feeling uncomfortable</div>
                    <div id="cancel6">emergency</div>
                    <div id="cancel7">wrong destination</div>
                    <div id="cancel8">other</div>
                    <input type="text" name="passenger_cancel" id="passenger_cancel" style="display:none;">
                    </center>
                </div>
              </form>
                
            </div>
            <div id="map" > </div>
        </div>
    </div>   
    <div class="toggleicon" id="toggleSidebar" onclick="side_open()">
             <i class="fa-solid fa-bars"></i>
      </div>
      <script>
        setInterval(() =>{
                console.log("Hi");
                let xhr = new XMLHttpRequest();
                console.log(xhr);
                xhr.open("POST", '<?php echo ROOT; ?>'+"/customer/ride_step5", true);
                xhr.onload = ()=>{
                    console.log("nol");
                    if(xhr.readyState === XMLHttpRequest.DONE){
                    
                    if(xhr.status === 200){
                        let data = xhr.response;
                        console.log(data);
                        if(data=="exists"){
                            location.reload();
                        }
           
                }
            }
            }
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("incoming_id="+'yes');
        }, 5000);
      </script>
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
    <script>
    function openWhatsApp() {
        
        // WhatsApp URL with phone number (replace '1234567890' with the desired phone number)
        <?php  foreach ($rows2 as $row2) :  ?>
               
        num =  parseInt("<?=$row2->phone;?>");       
         var url = 'https://wa.me/+94'+num;

        // Open WhatsApp in a new tab
        window.open(url, '_blank');
        <?php   endforeach; ?>
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
    var map = L.map('map').setView([ 7.8774, 80.7003], 9);
    // google street
    googleStreets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        });
    googleStreets.addTo(map)

    var lat=<?php echo isset($_GET['l_lat']) ? json_encode($_GET['l_lat']) : 'null'; ?>;
    var long=<?php echo isset($_GET['l_long']) ? json_encode($_GET['l_long']) : 'null'; ?>;
    <?php  foreach ($rows as $row) :  ?>
        <?php if($row->driver_id == $_GET['driver_id']){  ?>  
            Routing = L.Routing.control({
                waypoints: [
                    L.latLng(lat,long),
                    L.latLng(<?=$row->lat?>,<?=$row->lng?>)
                ],routeWhileDragging: true
            });
            
        

        // real time tracking
            var taxiIcon = L.icon({
                    iconUrl: '<?= ROOT ?>/assets/img/customer/<?=$row->vehicle?>.png',
                    iconSize: [50, 40]
                })
                var marker = L.marker([<?=$row->lat?>, <?=$row->lng?>], { icon: taxiIcon }).addTo(map);
                    L.Routing.control({
                        waypoints: [
                            L.latLng(<?=$row->lat?>, <?=$row->lng?>),
                            L.latLng(lat,long)
                        ]
                    }).on('routesfound', function (e) {
                        var routes = e.routes;
                        var time = e.routes[0].summary.totalTime; 
                        document.getElementById("time_limit").innerText=Math.floor((time%3600)/60)+' min';
                        e.routes[0].coordinates.forEach(function (coord, index) {
                            setTimeout(function () {
                                marker.setLatLng([coord.lat, coord.lng]);
                            }, 200* index)
                        })

                     }).addTo(map); 
                     const popupElement = document.getElementsByClassName('leaflet-routing-container leaflet-bar leaflet-routing-collapsible leaflet-control')[0];
                    popupElement.classList.add('leaflet-routing-container-hide');
        <?php } ?>
    <?php endforeach; ?>               
           
        
</script>


<!-- chat box -->
<script>
    const chatbotToggler = document.querySelector(".chatbot-toggler");
    const chatbotToggler1 = document.querySelector(".chatbot-toggler1");
const closeBtn = document.querySelector(".close-btn");
const closeBtn1 = document.querySelector(".close-btn1");
const chatbox = document.querySelector(".chatbox");
const chatbox1 = document.querySelector(".chatbox1");

closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));

closeBtn1.addEventListener("click", () => document.body.classList.remove("show-chatbot1"));
chatbotToggler1.addEventListener("click", () => document.body.classList.toggle("show-chatbot1"));

var message = [];
var messageText= [];
for (var i = 1; i < 13; i++) {
    message[i] = document.getElementById('message' + i);
    messageText[i] = message[i].innerText;
}

    message[1].addEventListener('click', function() {
    document.getElementById('passenger_message').value=messageText[1];
    document.getElementById('message_form').submit();
     });
    message[2].addEventListener('click', function() {
    document.getElementById('passenger_message').value=messageText[2];
    document.getElementById('message_form').submit();
     });
     message[3].addEventListener('click', function() {
    document.getElementById('passenger_message').value=messageText[3];
    document.getElementById('message_form').submit();
     });
     message[4].addEventListener('click', function() {
    document.getElementById('passenger_message').value=messageText[4];
    document.getElementById('message_form').submit();
     });
     message[5].addEventListener('click', function() {
    document.getElementById('passenger_message').value=messageText[5];
    document.getElementById('message_form').submit();
     });
     message[6].addEventListener('click', function() {
    document.getElementById('passenger_message').value=messageText[6];
    document.getElementById('message_form').submit();
     });
     message[7].addEventListener('click', function() {
    document.getElementById('passenger_message').value=messageText[7];
    document.getElementById('message_form').submit();
     });
     message[8].addEventListener('click', function() {
    document.getElementById('passenger_message').value=messageText[8];
    document.getElementById('message_form').submit();
     });
     message[9].addEventListener('click', function() {
    document.getElementById('passenger_message').value=messageText[9];
    document.getElementById('message_form').submit();
     });
     message[10].addEventListener('click', function() {
    document.getElementById('passenger_message').value=messageText[10];
    document.getElementById('message_form').submit();
     });
     message[11].addEventListener('click', function() {
    document.getElementById('passenger_message').value=messageText[11];
    document.getElementById('message_form').submit();
     });
     message[12].addEventListener('click', function() {
    document.getElementById('passenger_message').value=messageText[12];
    document.getElementById('message_form').submit();
     });

var cancel = [];
var cancelText= [];
for (var i = 1; i < 9; i++) {
    cancel[i] = document.getElementById('cancel' + i);
    cancelText[i] = cancel[i].innerText;
}
    cancel[1].addEventListener('click', function() {
    document.getElementById('passenger_cancel').value=cancelText[1];
    document.getElementById('cancel_form').submit();
     });
     cancel[2].addEventListener('click', function() {
    document.getElementById('passenger_cancel').value=cancelText[2];
    document.getElementById('cancel_form').submit();
     });
     cancel[3].addEventListener('click', function() {
    document.getElementById('passenger_cancel').value=cancelText[3];
    document.getElementById('cancel_form').submit();
     });
     cancel[4].addEventListener('click', function() {
    document.getElementById('passenger_cancel').value=cancelText[4];
    document.getElementById('cancel_form').submit();
     });
     cancel[5].addEventListener('click', function() {
    document.getElementById('passenger_cancel').value=cancelText[5];
    document.getElementById('cancel_form').submit();
     });
     cancel[6].addEventListener('click', function() {
    document.getElementById('passenger_cancel').value=cancelText[6];
    document.getElementById('cancel_form').submit();
     });
     cancel[7].addEventListener('click', function() {
    document.getElementById('passenger_cancel').value=cancelText[7];
    document.getElementById('cancel_form').submit();
     });
     cancel[8].addEventListener('click', function() {
    document.getElementById('passenger_cancel').value=cancelText[8];
    document.getElementById('cancel_form').submit();
     });

</script>




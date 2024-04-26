<!DOCTYPE html>
<html>
<head>
<title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
<meta http-equiv="refresh" content="15" id="refreshMeta">
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
        #map{
            width: 50%;
            height: 90vh;
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
                        <img class="driver_vehicle" src="<?= ROOT ?>/assets/img/customer/c2.jpeg" alt="">
                    </div>
            </center>
            
            <button class="whatapp" onclick="openWhatsApp()">
              <i class="fa-solid fa-phone"></i>
              </button>
            <button class="chatbot-toggler">
                <span class="material-symbols-rounded">chat</span>
                <span class="material-symbols-outlined">close</span>
              </button>
              
              <div class="chatbot">
                <header>
                  <h2>Chatbot</h2>
                  <span class="close-btn material-symbols-outlined">close</span>
                </header>
                <ul class="chatbox">
                  <li class="chat incoming">
                    <span class="material-symbols-outlined">smart_toy</span>
                    <p>Hi there 👋<br>How can I help you today?</p>
                  </li>
                </ul>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return validateForm()">
                <div class="chat-input">
                  <textarea   id="message" name="address" placeholder="Enter a message..." spellcheck="false" required></textarea>
                  <span id="send-btn" class="material-symbols-rounded" ><input type="submit" value="Submit">send</span>
                </div>
                </form>
              </div>
                
                
            </div>
            <div id="map" > </div>
        </div>
    </div>       
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
                    L.latLng(<?=$row->lat?>,<?=$row->long?>)
                ],routeWhileDragging: true
            });
            
        

        // real time tracking
            var taxiIcon = L.icon({
                    iconUrl: '<?= ROOT ?>/assets/img/customer/<?=$row->vehicle?>.png',
                    iconSize: [50, 40]
                })
                var marker = L.marker([<?=$row->lat?>, <?=$row->long?>], { icon: taxiIcon }).addTo(map);
                    L.Routing.control({
                        waypoints: [
                            L.latLng(<?=$row->lat?>, <?=$row->long?>),
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
const closeBtn = document.querySelector(".close-btn");
const chatbox = document.querySelector(".chatbox");
const chatInput = document.querySelector(".chat-input textarea");
const sendChatBtn = document.querySelector(".chat-input span");

let userMessage = null; // Variable to store user's message
const API_KEY = "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"; // Paste your API key here
const inputInitHeight = chatInput.scrollHeight;

const createChatLi = (message, className) => {
    // Create a chat <li> element with passed message and className
    const chatLi = document.createElement("li");
    chatLi.classList.add("chat", `${className}`);
    let chatContent = className === "outgoing" ? `<p></p>` : `<span class="material-symbols-outlined">smart_toy</span><p></p>`;
    chatLi.innerHTML = chatContent;
    chatLi.querySelector("p").textContent = message;
    return chatLi; // return chat <li> element
}

   const generateResponse = (chatElement) => {
    const API_URL = "https://api.openai.com/v1/chat/completions";
    const messageElement = chatElement.querySelector("p");

    // Define the properties and message for the API request
    const requestOptions = {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${API_KEY}`
        },
        body: JSON.stringify({
            model: "gpt-3.5-turbo",
            messages: [{role: "user", content: userMessage}],
        })
    }

    // Send POST request to API, get response and set the reponse as paragraph text
    fetch(API_URL, requestOptions).then(res => res.json()).then(data => {
        messageElement.textContent = data.choices[0].message.content.trim();
    }).catch(() => {
        messageElement.classList.add("error");
        messageElement.textContent = "Oops! Something went wrong. Please try again.";
    }).finally(() => chatbox.scrollTo(0, chatbox.scrollHeight));
}

const handleChat = () => {
    userMessage = chatInput.value.trim(); // Get user entered message and remove extra whitespace
    if(!userMessage) return;

    // Clear the input textarea and set its height to default
    chatInput.value = "";
    chatInput.style.height = `${inputInitHeight}px`;

    // Append the user's message to the chatbox
    chatbox.appendChild(createChatLi(userMessage, "outgoing"));
    chatbox.scrollTo(0, chatbox.scrollHeight);
    
    setTimeout(() => {
        // Display "Thinking..." message while waiting for the response
        const incomingChatLi = createChatLi("Thinking...", "incoming");
        chatbox.appendChild(incomingChatLi);
        chatbox.scrollTo(0, chatbox.scrollHeight);
        generateResponse(incomingChatLi);
    }, 600);
}

chatInput.addEventListener("input", () => {
    // Adjust the height of the input textarea based on its content
    chatInput.style.height = `${inputInitHeight}px`;
    chatInput.style.height = `${chatInput.scrollHeight}px`;
   
});

chatInput.addEventListener("keydown", (e) => {
    // If Enter key is pressed without Shift key and the window 
    // width is greater than 800px, handle the chat
    if(e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
        e.preventDefault();
        handleChat();
    }
});

sendChatBtn.addEventListener("click", handleChat);
closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));


</script>




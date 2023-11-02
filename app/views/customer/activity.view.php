<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/Activity.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <div class="sidebar">

        <div class="barimagetag">
           <img src="./img/logo_name.png" alt="" class="barimage">
        </div>


        <div class="profile">
           <img src="./img/person.jpg" alt="" class="userimage">
           <H3 class="username">Thusikaran</H3>
           <h6>
             <i class="fa-solid fa-star" style="color: #D1B000;"></i>
             <i class="fa-solid fa-star" style="color: #D1B000;"></i>
             <i class="fa-solid fa-star" style="color: #D1B000;"></i>
             <i class="fa-solid fa-star" ></i>
             <i class="fa-solid fa-star" ></i>
           </h6>
        </div>
        

        <div class="linktag">
           <a href="#" class="link"><div class="linkbutton"><i class="fa-solid fa-car-tunnel"></i>Ride</div></a>
           <a href="#" class="link"><div class="linkbutton"><i class="fa-solid fa-map-location-dot"></i>Add Place</div></a>
           <a href="#" class="link"><div class="linkbutton1"><i class="fa-solid fa-file-lines"></i>Activity</div></a>
           <a href="#" class="link"><div class="linkbutton"><i class="fa-solid fa-handshake-angle"></i>Help</div></a>
           <a href="#" class="link"><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket"></i>Logout</div></a>
        </div>
 
        <div class="logout-container">
         <h2>Log Out</h2>
         <p class="logout-text">Are you sure you want to log out?</p>
         <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log Out</button></div>
        </div>
      
        
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
   </script>

        <div class="activity">
            <div class="heading">
                <div class="date">Date</div>
                <div class="time">Time</div>
                <div class="name">Name</div>
                <div class="location">Location</div>
                <div class="location">Location</div>
                <div class="fare">Fare</div>
            </div>
            <div class="data">
                <div class="date">Date</div>
                <div class="time">Time</div>
                <div class="name">Name</div>
                <div class="location">Location</div>
                <div class="location">Location</div>
                <div class="fare">Fare</div>
            </div>
            <div class="data">
                <div class="date">Date</div>
                <div class="time">Time</div>
                <div class="name">Name</div>
                <div class="location">Location</div>
                <div class="location">Location</div>
                <div class="fare">Fare</div>
            </div>
            <div class="data">
                <div class="date">Date</div>
                <div class="time">Time</div>
                <div class="name">Name</div>
                <div class="location">Location</div>
                <div class="location">Location</div>
                <div class="fare">Fare</div>
            </div>

        </div>
</body>
</html>
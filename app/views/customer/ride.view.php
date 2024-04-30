<!DOCTYPE html>
<html>
<head>
<title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ridestep.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
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

<!-- ---------------------------------------------------------------------------------- -->
        <div class="ridemain">

           

             <div class="step1" id="step1">
                <h1>
                    Request a Ride now
                </h1>
                <form action="" class="step1form">
                    <div class="step1label"><label for="" >pickup location</label> <i class="fa-solid fa-location-crosshairs"></i></div>
                    <input type="text" class="step1input">
                    <div class="step1label"><label for="" >destination location</label><i class="fa-solid fa-location-dot"></i></div>    
                    <input type="text" class="step1input">
                </form>
                <button id="next1">Next</button>
             </div>
<!-- -------------------------------------------------------------------------------------- -->
             <div class="step2" id="step2">
                <img src="<?= ROOT ?>/assets/img/path.jpg">
                <button id="prev2">Back</button>
                <button id="next2">Next</button>
             </div>
<!-- ------------------------------------------------------------------------------------------------------------ -->
             <div class="step3" id="step3">
                <h1>Category</h1>
                <div class="column">
                  <div class="type">
                      <img src="<?= ROOT ?>/assets/img/c1.png" alt="">
                      <div class="ctext">
                         <span>Moto</span>
                         <span><b>Rs 157.00</b></span>
                         <span class="no_user"><b>1</b><i class="fa-solid fa-user-group"></i></i></span>
                      </div>
                  </div>
                  <div class="type">
                      <img src="<?= ROOT ?>/assets/img/c2.jpeg" alt="">
                      <div class="ctext">
                        <span>Auto</span>
                        <span><b>Rs 200.00</b></span>
                        <span class="no_user"><b>3</b><i class="fa-solid fa-user-group"></i></i></span>
                     </div>
                  </div>
                  <div class="type">
                      <img src="<?= ROOT ?>/assets/img/c3.png" alt="">
                      <div class="ctext">
                        <span>Car</span>
                        <span><b>Rs 230.00</b></span>
                        <span class="no_user"><b>4</b><i class="fa-solid fa-user-group"></i></i></span>
                     </div>
                 </div>
                </div>
                <div class="column">
                  <div class="type">
                     <img src="<?= ROOT ?>/assets/img/c3.png" alt="">
                     <div class="ctext">
                        <span>AC-Car</span>
                        <span><b>Rs 260.00</b></span>
                        <span class="no_user"><b>4</b><i class="fa-solid fa-user-group"></i></i></span>
                     </div>
                 </div>
                  <div class="type">
                      <img src="<?= ROOT ?>/assets/img/c4.png" alt="">
                      <div class="ctext">
                        <span>Mini-Van</span>
                        <span><b>Rs 300.00</b></span>
                        <span class="no_user"><b>6</b><i class="fa-solid fa-user-group"></i></i></span>
                     </div>
                  </div>
                </div>
                <div class="step3button">
                <button id="prev3">Back</button>
                <button id="next3">Next</button>
               </div>
             </div>

<!-- -------------------------------------------------------------------------------------------- -->
             <div class="step4" id="step4">
                <h1>Request  for Driver</h1>
                <div class="sf"><h4>Standed fare  : Rs 500.00</h4></div>
                
                <div class="driverlist">
                  
                  <div class="imgstar"><img src="<?= ROOT ?>/assets/img/person.jpg" alt="">
                     <span>
                        <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                        <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                        <i class="fa-solid fa-star" style="color: #D9D9D9;"></i>
                        <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                        <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                     </span></div>
                  <div class="name">Mr.S.Makesh</div>
                  <div class="fare">Fare<br><b>Rs 400.00</b></div>
                  <div class="nrbutton">
                     <button class="Negotiate">Negotiate</button>
                     <button class="Request">Select</button>
                  </div>
                </div>
                
                <div class="driverlist">
                  
                  <div class="imgstar"><img src="<?= ROOT ?>/assets/img/person.jpg" alt=""><span>
                     <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                     <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                     <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                     <i class="fa-solid fa-star" style="color: #D9D9D9;"></i>
                     <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                  </span></div>
                  <div class="name">Mr.S.Ravi</div>
                  <div class="fare">Fare<br><b>Rs 420.00</b></div>
                  <div class="nrbutton">
                     <button class="Negotiate">Negotiate</button>
                     <button class="Request">Select</button>
                  </div>
                </div>
                
                <div class="driverlist">
                  
                  <div class="imgstar"><img src="<?= ROOT ?>/assets/img/person.jpg" alt=""><span>
                     <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                     <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                     <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                     <i class="fa-solid fa-star" style="color: #D9D9D9;"></i>
                     <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                  </span></div>
                  <div class="name">Mr.S.Raja</div>
                  <div class="fare">Fare<br><b>Rs 450.00</b></div>
                  <div class="nrbutton">
                     <button class="Negotiate">Negotiate</button>
                     <button class="Request">Select</button>
                  </div>
                </div>
                
                <div class="driverlist">
                  
                  <div class="imgstar"><img src="<?= ROOT ?>/assets/img/person.jpg" alt=""><span>
                     <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                     <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                     <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                     <i class="fa-solid fa-star" style="color: #D9D9D9;"></i>
                     <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                  </span></div>
                  <div class="name">Mr.S.Kamal</div>
                  <div class="fare">Fare<br><b>Rs 500.00</b></div>
                  <div class="nrbutton">
                     <button class="Negotiate">Negotiate</button>
                     <button class="Request">Select</button>
                  </div>
                </div>
                
                <div class="driverlist">
                  
                  <div class="imgstar"><img src="<?= ROOT ?>/assets/img/person.jpg" alt=""><span>
                     <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                     <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                     <i class="fa-solid fa-star" style="color: #D1B000;"></i>
                     <i class="fa-solid fa-star" style="color: #D9D9D9;"></i>
                     <i class="fa-solid fa-star" style="color: #D9D9D9;" ></i>
                  </span></div>
                  <div class="name">Mr.S.Lambo</div>
                  <div class="fare">Fare<br><b>Rs 500.00</b></div>
                  <div class="nrbutton">
                     <button class="Negotiate">Negotiate</button>
                     <button class="Request">Select</button>
                  </div>
                </div>
               <div class="step4button">
                <button id="prev4">Back</button>
                <button id="next4">Request</button>
               </div>
             </div>
<!-- --------------------------------------------------------------------------------------------------------- -->
             <div class="step5" id="step5">
               <img src="<?= ROOT ?>/assets/img/path.jpg">
               <h1>Driver Direction</h1>
                <button id="next5">Next</button>
             </div>
<!-- ----------------------------------------------------------------------------------------------------------------- -->
             <div class="step6" id="step6">
               <img src="<?= ROOT ?>/assets/img/path.jpg">
               <h1>Start Ride </h1>
               <button class="safety">Safety Ride</button>
                <button id="next6">Next</button>
             </div>
<!-- ----------------------------------------------------------------------------------------------------------------- -->
             <div class="step7" id="step7">
                <h1>Finished Ride</h1>
                <div class="switch">
                  <div id="rate" class="switch1">rate</div>
                  <div id="report" class="switch2">report</div>
                </div>
                <div id="finclude">
                <img src="<?= ROOT ?>/assets/img/person.jpg" alt="">
                <h3>Mr.S.Makesh</h3>
                <div class="staricon">
                  <i class="fa-solid fa-star" id="star1"></i>
                  <i class="fa-solid fa-star" id="star2"></i>
                  <i class="fa-solid fa-star" id="star3"></i>
                  <i class="fa-solid fa-star" id="star4"></i>
                  <i class="fa-solid fa-star" id="star5"></i>
                </div>
               </div>
               <div id="freport">
                  <div class="reportform">
                  <div class="reportlist">
                    <div class="relist">
                     <div><input type="checkbox"><label >Cheating</label></div>
                     <div><input type="checkbox"><label >Bad behavior</label></div>
                     <div><input type="checkbox"><label >Driver drinking</label></div>
                     <div><input type="checkbox"><label >Over Speed</label></div>
                     <div><input type="checkbox"><label >Ride slow</label></div>
                     <div><input type="checkbox"><label >Damage vehiles</label></div>
                     <div><input type="checkbox"><label >Traffic signal not flow</label></div>
                     </div>
                     <div class="relist">
                     <div><input type="checkbox"><label >Honesty</label></div>
                     <div><input type="checkbox"><label >Responsibility</label></div>
                     <div><input type="checkbox"><label >Alertness</label></div>
                     <div><input type="checkbox"><label >Knowledge</label></div>
                     <div><input type="checkbox"><label >Patience</label></div>
                     <div><input type="checkbox"><label >Independence</label></div>
                     <div><input type="checkbox"><label >Self-discipline</label></div>
                     </div>
                  </div>
                  <div class="reporttext">
                     <input type="text" placeholder="any note">
                  </div>
               </div>
                
               </div>
               <button id="next7">Submit</button>
                <a class="a1" href="#">skip</a>
             </div>
<!-- ----------------------------------------------------------------------------------------------------------------- -->         
            

             <script>
            //   ------------------------------side bar open---------------------
                  function openNav() {
                     document.getElementById("mySidenav").style.width = "40vw";
                     document.getElementById("ride").style.filter = "brightness(0.7)";
                     // document.getElementById("topbar").style.filter = "brightness(0.7)";


                     }

                  function closeNav() {
                      document.getElementById("mySidenav").style.width = "0";
                      document.getElementById("ride").style.filter = "brightness(1)";
                     }


                const next1 = document.getElementById('next1');
                const next2 = document.getElementById('next2');
                const next3 = document.getElementById('next3');
                const next4 = document.getElementById('next4');
                const next5 = document.getElementById('next5');
                const next6 = document.getElementById('next6');
                const next7 = document.getElementById('next7');
                
                const prev2 = document.getElementById('prev2');
                const prev3 = document.getElementById('prev3');
                const prev4 = document.getElementById('prev4');
                const prev5 = document.getElementById('prev5');

                

                const step1 = document.getElementById('step1');
                const step2 = document.getElementById('step2');
                const step3 = document.getElementById('step3');
                const step4 = document.getElementById('step4');
                const step5 = document.getElementById('step5');
                const step6 = document.getElementById('step6');
                const step7 = document.getElementById('step7');

                
                next1.addEventListener('click', () => {
                      step2.style.display = 'block';
                      step1.style.display = 'none';
                    });
                
                next2.addEventListener('click', () => {
                      step3.style.display = 'block';
                      step2.style.display = 'none';
                    });

                next3.addEventListener('click', () => {
                      step4.style.display = 'block';
                      step3.style.display = 'none';
                    });

                next4.addEventListener('click', () => {
                      step5.style.display = 'block';
                      step4.style.display = 'none';
                    });

                next5.addEventListener('click', () => {
                      step6.style.display = 'block';
                      step5.style.display = 'none';
                    });

                next6.addEventListener('click', () => {
                      step7.style.display = 'block';
                      step6.style.display = 'none';
                    });

                next7.addEventListener('click', () => {
                      step1.style.display = 'block';
                      step7.style.display = 'none';
                    });


                    prev2.addEventListener('click', () => {
                      step1.style.display = 'block';
                      step2.style.display = 'none';
                    });

                    prev3.addEventListener('click', () => {
                      step2.style.display = 'block';
                      step3.style.display = 'none';
                    });

                    prev4.addEventListener('click', () => {
                      step3.style.display = 'block';
                      step4.style.display = 'none';
                    });
// rate or report start--------------------------------------------------------------
                const rate = document.getElementById('rate');
                const report = document.getElementById('report');
                const finclude = document.getElementById('finclude');
                const freport = document.getElementById('freport');

                    rate.addEventListener('click', () => {
                      finclude.style.display = 'block';
                     rate.style.backgroundColor = '#162938';
                     rate.style.color = '#D9D9D9';
                      freport.style.display = 'none';
                      report.style.backgroundColor = '#D9D9D9';
                      report.style.color = '#162938';

                    });

                    report.addEventListener('click', () => {
                      freport.style.display = 'block';
                      report.style.backgroundColor = '#162938';
                      rate.style.color = '#162938';
                      finclude.style.display = 'none';
                      rate.style.backgroundColor = '#D9D9D9';
                      report.style.color = '#D9D9D9';
                    });
               //   ?usort($numbers, function($a, $b) {
               //       return $a - $b;
               //    });
//star--------------------------------------------------------------------------------------
                const star1 = document.getElementById('star1');
                const star2 = document.getElementById('star2');
                const star3 = document.getElementById('star3');
                const star4 = document.getElementById('star4');
                const star5 = document.getElementById('star5');

                star1.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = '#9f9f9f';
                      star3.style.color = '#9f9f9f';
                      star4.style.color = '#9f9f9f';
                      star5.style.color = '#9f9f9f';
                    });
                
                star2.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = '#D1B000';
                      star3.style.color = '#9f9f9f';
                      star4.style.color = '#9f9f9f';
                      star5.style.color = '#9f9f9f';
                    });

                star3.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = '#D1B000';
                      star3.style.color = '#D1B000';
                      star4.style.color = '#9f9f9f';
                      star5.style.color = '#9f9f9f';
                    });

                star4.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = '#D1B000';
                      star3.style.color = '#D1B000';
                      star4.style.color = '#D1B000';
                      star5.style.color = '#9f9f9f';
                    });

                star5.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = '#D1B000';
                      star3.style.color = '#D1B000';
                      star4.style.color = '#D1B000';
                      star5.style.color = '#D1B000';
                    });
// ---------------------------------------------------------logout part-------------------------------------------------------------------
            const logout_option = document.querySelector('.linkbutton2')
            const logout_container = document.querySelector('.logout-container')
            const cancel_button = document.querySelector('.cancel-btn')
            const main = document.querySelector('.ridemain')
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
                  //   usort($fruits, function($a, $b) {
                  //       return strcmp(strtolower(substr($a, 0, 1)), strtolower(substr($b, 0, 1)));
                  //    });
            </script>
        </div>
    </div>
</body>
</html>
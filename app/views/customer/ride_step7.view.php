<!DOCTYPE html>
<html>
<head>
<title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Customer/ride_step7.css">
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
 

   <?php include 'ride_side.php'; ?>

<!-- ---------------------------------------------------------------------------------- -->
   <div class="activity">
    <form action="" method="POST" enctype="multipart/form-data">
<!-- -----------------------------Rating part------------------------------------------------------------------ -->
        <div class="box1">
            <div>
                <h1>Rating</h1>
            </div>
             <div >
                <img id="driver_photo" src="<?= ROOT ?>/assets/img/person.jpg" alt="">
                <h3>Mr.S.Makesh</h3>
                <div class="staricon">
                  <i class="fa-solid fa-star" id="star1"></i>
                  <i class="fa-solid fa-star" id="star2"></i>
                  <i class="fa-solid fa-star" id="star3"></i>
                  <i class="fa-solid fa-star" id="star4"></i>
                  <i class="fa-solid fa-star" id="star5"></i>
                </div>
                <input type="text" name='star' id="star" value=0>
               </div>   
               <div class="report_submit">
                  <button>Submit</button>
                  <a href="<?=ROOT?>/Customer/ride_step1">skip</a>
               </div> 
         </div>
<!-- //------------------------------Reporting part------------------------------------------------------ -->
         <div class="box2">
            <div>
                <h1>Reporting</h1>
            </div>
             <div id="freport">
                  <div class="reportform">
                  <div class="reportlist">
                    <div class="relist">
                     <div><input type="checkbox" name="report1"  value="Cheating"><label >Cheating</label></div>
                     <div><input type="checkbox" name="report2"  value="Bad behavior"><label >Bad behavior</label></div>
                     <div><input type="checkbox" name="report3" value="Driver drinking"><label >Driver drinking</label></div>
                     <div><input type="checkbox" name="report4" value="Over Speed"><label >Over Speed</label></div>
                     <div><input type="checkbox" name="report5" value="Ride slow"><label >Ride slow</label></div>
                     <div><input type="checkbox" name="report6" value="Damage vehiles"><label >Damage vehiles</label></div>
                     <div><input type="checkbox" name="report7" value="Traffic signal not flow"><label >Traffic signal not flow</label></div>
                     </div>
                     <div class="relist">
                     <div><input type="checkbox" name="report8" value="Honesty"><label >Honesty</label></div>
                     <div><input type="checkbox" name="report9" value="Responsibility"><label >Responsibility</label></div>
                     <div><input type="checkbox" name="report10" value="Alertness"><label >Alertness</label></div>
                     <div><input type="checkbox" name="report11" value="Knowledge"><label >Knowledge</label></div>
                     <div><input type="checkbox" name="report12" value="Patience"><label >Patience</label></div>
                     <div><input type="checkbox" name="report13" value="Independence"><label >Independence</label></div>
                     <div><input type="checkbox" name="report14" value="Self-discipline"><label >Self-discipline</label></div>
                     </div>
                  </div>
                  <div>
                  <input type="file" id="fileInput" style="display: none;" name="file">
                      <label for="fileInput" style="cursor: pointer;">
                          <span alt="Upload File" style="width: 50px; height: 50px; padding:5px; border:solid; border-radius:10px;"> Upload <i class="fa-solid fa-upload"></i> </span>
                      </label>
                  </div>
                  <div class="reporttext">
                     <textarea type="text" placeholder="any note" name="other" value='' > </textarea>
                  </div>   
         </div>
        </form>
    </div>       
        
    </body>
</html>
<script>
    // star----------------------------------------------------------------------------------------------
            const star1 = document.getElementById('star1');
            const star2 = document.getElementById('star2');
            const star3 = document.getElementById('star3');
            const star4 = document.getElementById('star4');
            const star5 = document.getElementById('star5');
            document.getElementById('star').style.display= "none";

                star1.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = 'black';
                      star3.style.color = 'black';
                      star4.style.color = 'black';
                      star5.style.color = 'black';
                      document.getElementById('star').value=1;

                    });
                
                star2.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = '#D1B000';
                      star3.style.color = 'black';
                      star4.style.color = 'black';
                      star5.style.color = 'black';
                      document.getElementById('star').value=2;
                    });

                star3.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = '#D1B000';
                      star3.style.color = '#D1B000';
                      star4.style.color = 'black';
                      star5.style.color = 'black';
                      document.getElementById('star').value=3;
                    });

                star4.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = '#D1B000';
                      star3.style.color = '#D1B000';
                      star4.style.color = '#D1B000';
                      star5.style.color = 'black';
                      document.getElementById('star').value=4;
                    });

                star5.addEventListener('click', () => {
                      star1.style.color = '#D1B000';
                      star2.style.color = '#D1B000';
                      star3.style.color = '#D1B000';
                      star4.style.color = '#D1B000';
                      star5.style.color = '#D1B000';
                      document.getElementById('star').value=5;
                    });
</script>




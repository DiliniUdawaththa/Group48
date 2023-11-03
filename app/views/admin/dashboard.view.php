<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/Dashboard.css">
</head>
<body>

    <!-- in nav bar contant -->
    <!-- we will use getemail or other data _callstatic do it -->
   <!-- echo getname() -->

    <!-- logout format -->
    <!-- <div> <li><a href="?=ROOT?>/logout">Logout</a></li> </div> -->

    <section id="menu">
        <div class="logo">
            <img src="<?= ROOT ?>/assets/img/logoname.png">
            <br>   
        </div>
        <div class="profile">
                <img src="<?= ROOT ?>/assets//img/person.jpg" alt="" class="userimage">
                <br>
                <H3 class="username"><?=Auth::getname();?></H3>
         </div>
        <div class="items">
            <li><i class="fa-solid fa-gauge"></i><a href="<?=ROOT?>/admin">Dashboard</a></li>
            <li><i class="fa-solid fa-users"></i><a href="<?=ROOT?>/admin/customer">Customers</a></li>
            <li><i class="fa-solid fa-user-group"></i><a href="<?=ROOT?>/admin/driver">Drivers</a></li>
            <li><i class="fa-solid fa-user-tie"></i><a href="<?=ROOT?>/admin/officer">Officer</a></li>
            <li><i class="fa-solid fa-taxi"></i><a href="<?=ROOT?>/admin/ride">Rides</a></li>
            <li><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket fa-rotate-180"></i><a href="/logout">Logout</a></li>
        </div>

        <!-- <div class="logout-container">
         <h2>Log Out</h2>
         <p class="logout-text">Are you sure you want to log out?</p>
         <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log Out</button></div>
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
    </script> -->

    </section>
   
    <!-- <?php $this->view('admin/include/sidebar',$data) ?> -->
    <section id="interface">
        <div class="navigation">
            <div class="n1">
                <div class="search">
                    <i class="fa-solid fa-gauge"></i>
                    <h3>Admin Dashboard</h3>
                </div>
            </div>

            <div class="profile">
                <i class="fa-solid fa-bell"></i>
            </div>
        </div>

        <div class="values">
            <div class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                    <span>Customers</span>
                    <h3>1000</h3>
                </div>   
            </div>
            <div class="val-box">
                <i class="fa-solid fa-user-group"></i>
                <div>
                    <span>Drivers</span>
                    <h3>100</h3>
                </div>
            </div>
            <div class="val-box">
                <i class="fa-solid fa-user-tie"></i>
                <div>
                    <span>Officers</span>
                    <h3>4</h3>
                </div>
            </div>
            <div class="val-box">
                <i class="fa-solid fa-taxi"></i>
                <div>
                    <span>Rides</span>
                    <h3>400</h3>
                </div>
            </div>
        </div>

        <!-- <div class="graph">
            <div class="container">
               <div class="bar one"></div> 
               <div class="bar two"></div> 
               <div class="bar three"></div> 
               <div class="bar four"></div> 
               <div class="bar five"></div> 
               <div class="bar six"></div> 
               <div class="bar seven"></div> 
               <div class="bar eight"></div> 
               <div class="bar nine"></div> 
               <div class="bar ten"></div> 
               <div class="bar eleven"></div> 
               <div class="bar twelve"></div> 

                <ul class="v-meter">
                    <li><div>200</div></li>
                    <li><div>160</div></li>
                    <li><div>120</div></li>
                    <li><div>80</div></li>
                    <li><div>40</div></li>
                    <li><div>0</div></li>
                </ul>

            </div>
        </div> -->

    </section>

</body>
</html>
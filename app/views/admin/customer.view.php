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
        <div class="navi">
            <div class="navi1">
                <h2>CUSTOMERS</h2>
            </div>
        </div>
    </section>
</body>
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
            <li><i class="fa-solid fa-users"></i><a href="<?=ROOT?>/admin/customer/">Customers</a></li>
            <li><i class="fa-solid fa-user-group"></i><a href="<?=ROOT?>/admin/driver/">Drivers</a></li>
            <li><i class="fa-solid fa-user-tie"></i><a href="<?=ROOT?>/admin/officer/">Officer</a></li>
            <li><i class="fa-solid fa-taxi"></i><a href="<?=ROOT?>/admin/ride/">Rides</a></li>
            <li><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket fa-rotate-180"></i><a href="#">Logout</a></li>
        </div>

        <div class="logout-container">
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
    </script>

    </section>

    
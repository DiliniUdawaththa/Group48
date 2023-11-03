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
                <h2>OFFICER</h2>
            </div>

            <!-- <div class="operation">
                <button type="button" class="button-style" id="plus">Add Officer</button>
            </div> -->
        </div>

        <div class="officer_form">
            <form action="" method="post">
                 <div class="officer_box">
                      <div>
                          <label for="" class="label">Employee ID</label><br>
                        </div>
                          <input type="text" name="empID"  required>
                          <?php if(!empty($errors['empID'])):?>
                          <?php endif;?>
                          <br>
                        <div>
                          <label for="" class="label" >Name</label><br>
                        </div>
                          <input type="text" name="Name" required>
                            <?php if(!empty($errors['Name'])):?>
                            <?php endif;?>
                            <br>
                        <div>
                          <label for="" class="label">Email</label>
                          <!-- <i class="fa-solid fa-location-dot"></i> -->
                          <br>
                        </div>
                          <input type="text" name="Email" required>
                          
                          <?php if(!empty($errors['Email'])):?>
                             <!-- <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['address']?></small> -->
                          <?php endif;?>
                          <br>
                        <div>
                          <label for="" class="label">Mobile</label>
                          <!-- <i class="fa-solid fa-location-dot"></i> -->
                          <br>
                        </div>
                          <input type="text" name="Mobile" required>
                          
                          <?php if(!empty($errors['Mobile'])):?>
                        <!-- <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['Mobile']?></small>  -->
                          <?php endif;?>
                          <br>
                          <a href="<?=ROOT?>/admin/officer/"><button type="submit" class="submit_btn">Submit</button>
                          <!-- <a href="<?=ROOT?>/admin/officer/"><button type="submit" class="cancel_btn">Cancel</button> -->
                          <!-- <small class="skip"><center>skip</center></small> -->
                  </div>
              </form>
        </div>

    </section>
    <script>
        // const logout_option = document.querySelector('.linkbutton2')
        // const logout_container = document.querySelector('.logout-container')
        // const cancel_button = document.querySelector('.cancel-btn')
        //   //  const logout_button = document.querySelector('.logout-btn')
        //         logout_option.addEventListener('click',()=>{
        //             logout_container.style.display = 'block'
        //             })

        //             cancel_button.addEventListener('click', ()=>{
        //             logout_container.style.display = 'none'
        //             })

        const table = document.querySelector('.table1')
        const form = document.querySelector('.officer_form')
        const skip = document.querySelector('.skip')
        const plus = document.getElementById('plus')

        plus.addEventListener('click',()=>{
            form.style.display = 'block'
            table.style.display = 'none'
        })

        skip.addEventListener('click',()=>{
            form.style.display = 'none'
            table.style.display = 'block'
        })
    </script>
</body>
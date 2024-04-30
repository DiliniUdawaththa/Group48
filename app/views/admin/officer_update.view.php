<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/Officer.css">
    <style>
        .error{
            border: 1px solid red;
            color: red;
        }
        .message{
            height: 50px;
            width: 100%;
            margin-bottom: 10px;
        }
        .message p{
            padding: 10px;
            font-size: 1em;
            color: #026334;
            background-color: #a7cfbc;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="sidebar">
            <div class="logo">
                <img src="<?= ROOT ?>/assets/img/logoname.png" class="barimage">
                <br>   
            </div>
            <div class="profile">
                <img src="<?= ROOT ?>/assets//img/person.jpg" alt="" class="userimage">
                <br>
                <H3 class="username"><?=Auth::getname();?></H3>
            </div>
            <div class="items">
            <a href="<?=ROOT?>/admin" class="link"><div class="linkbutton"><i class="fa-solid fa-gauge"></i>Dashboard</div></a>
                <a href="<?=ROOT?>/admin/customer" class="link"><div class="linkbutton"><i class="fa-solid fa-users"></i>Customers</div></a>
                <a href="<?=ROOT?>/admin/driver" class="link"><div class="linkbutton"><i class="fa-solid fa-user-group"></i>Drivers</div></a>
                <a href="<?=ROOT?>/admin/officer" class="link"><div class="linkbutton1"><i class="fa-solid fa-user-tie"></i>Officer</div></a>
                <a href="<?=ROOT?>/admin/ride" class="link"><div class="linkbutton"><i class="fa-solid fa-taxi"></i>Rides</div></a>
                <a href="<?=ROOT?>/admin/report" class="link"><div class="linkbutton"><i class="fa-solid fa-list"></i>Reports</div></a>
                <a href="#" class="link"><div class="linkbutton2"><i class="fa-solid fa-right-from-bracket fa-rotate-180"></i>Logout</div></a>
            </div>

            <div class="logout-container">
                <h2>Log Out</h2>
                <p class="logout-text">Are you sure you want to log out?</p>
                <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log Out</button></div>
            </div> 
        </div>

        <div class="interface">
            <div class="navi">
                <div class="navi1">
                    <h2>OFFICER</h2>
                </div>
            </div>
            <center>
            <div class="officer_form">
                <form action="" method="post">
                    <div class="officer_box">
                        <?php foreach ($rows as $row) : ?>
                        <div>
                            <label for="" class="label">Employee ID</label><br>
                        </div>
                        <input type="text" value="<?= $row->empID; ?>" name="empID"  readonly>
                        <?php if(!empty($errors['empID'])):?>
                        <?php endif;?>
                        <br>

                        <div>
                            <label for="" class="label" >Name</label><br>
                        </div>
                        <input type="text" value="<?= $row->name; ?>" name="name" readonly>
                        <?php if(!empty($errors['name'])):?>
                        <?php endif;?>
                        <br>

                        <div>
                            <label for="" class="label">Email</label>
                            <!-- <i class="fa-solid fa-location-dot"></i> -->
                            <br>
                        </div>
                        <input type="text" value="<?= $row->email; ?>" name="email" readonly>    
                        <?php if(!empty($errors['email'])):?>
                                <!-- <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['address']?></small> -->
                        <?php endif;?>
                        <br>

                        <div>
                            <label for="" class="label">Mobile</label>
                            <!-- <i class="fa-solid fa-location-dot"></i> -->
                            <br>
                        </div>
                        <input type="text" value="<?= $row->phone; ?>" name="phone" required>
                        <?php if(!empty($errors['phone'])):?>
                            <!-- <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['Mobile']?></small>  -->
                        <?php endif;?>
                        <br>
                        <button type="submit"  name="submit" id="submit_btn" class="submit_btn">Submit</button>
                        <!-- <a href="<?=ROOT?>/admin/officer/"><button type="submit" class="submit_btn">Submit</button> -->
                        <br>
                        <a href="<?=ROOT?>/admin/officer"><small class="skip"><center>Cancel</center></small></a>
                    </div>
                    <?php endforeach; ?>    
                </form>
            </div>
            </center>
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

        const table = document.querySelector('.table1')
        const form = document.querySelector('.officer_form')
        const skip = document.querySelector('.skip')
        const plus = document.getElementById('plus')

        // plus.addEventListener('click',()=>{
        //     form.style.display = 'block'
        //     table.style.display = 'none'
        // })

        // skip.addEventListener('click',()=>{
        //     form.style.display = 'none'
        //     table.style.display = 'block'
        // })
    </script>
</body>
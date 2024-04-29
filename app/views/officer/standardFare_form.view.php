<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/Officer.css">
    <style>
    .error {
        border: 1px solid red;
        color: red;
    }

    .message {
        height: 50px;
        width: 100%;
        margin-bottom: 10px;
    }

    .message p {
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
                <img src="<?= ROOT ?>/assets/img/person.jpg" alt="" class="userimage">
                <br>
                <H3 class="username"><?=Auth::getname();?></H3>
            </div>
            <div class="items">
                <a href="<?=ROOT?>/officer" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-gauge"></i>Dashboard</div>
                </a>
                <a href="<?=ROOT?>/officer/officerdriverRegistration" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-users"></i>Driver Registration</div>
                </a>
                <a href="<?=ROOT?>/officer/driver" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-user-group"></i>Drivers</div>
                </a>
                <a href="<?=ROOT?>/officer/customer" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-users"></i>Customers</div>
                </a>
                <a href="<?=ROOT?>/officer/complains" class="link">
                    <div class="linkbutton"><i class="fa-sharp fa-solid fa-circle-exclamation"></i>Complains</div>
                </a>
                <a href="<?=ROOT?>/officer/standardFare" class="link">
                    <div class="linkbutton1"><i class="fa-solid fa-tag"></i>Standard Fare</div>
                </a>
                <!--<a href="<?=ROOT?>/admin/ride" class="link"><div class="linkbutton"><i class="fa-solid fa-taxi"></i>Rides</div></a>-->
                <a href="#" class="link">
                    <div class="linkbutton2"><i class="fa-solid fa-right-from-bracket fa-rotate-180"></i>Logout</div>
                </a>
            </div>

            <div class="logout-container">
                <h2>Log Out</h2>
                <p class="logout-text">Are you sure you want to log out?</p>
                <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log
                        Out</button></div>
            </div>


        </div>

        <script>
        const logout_option = document.querySelector('.linkbutton2')
        const logout_container = document.querySelector('.logout-container')
        const cancel_button = document.querySelector('.cancel-btn')
        const logout_button = document.querySelector('.logout-btn')
        logout_option.addEventListener('click', () => {
            logout_container.style.display = 'block'
        })

        cancel_button.addEventListener('click', () => {
            logout_container.style.display = 'none'
        })

        logout_button.addEventListener('click', () => {
            window.location.href = "<?=ROOT?>/logout";
        })
        </script>



        <div class="interface">
            <div class="navi">
                <div class="navi1">
                    <h2>Standard Fare</h2>
                </div>
            </div>

            <center>
                <div class="officer_form">
                    <form name="addStandardFare" action="" method="post" onsubmit="return validateForm()">
                        <div class="officer_box">

                            <div>
                                <label for="vehicletype" class="label">Vehicle Type</label><br>
                            </div>
                            <input value="<?= set_value('vehicletype') ?>" list="vehicletype_list" name="vehicletype"
                                id="vehicletype" required>
                            <datalist id="vehicletype_list">
                                <option value="Bike">Bike</option>
                                <option value="Three Weel">Three Weel</option>
                                <option value="Car(Non A/C)">Car(Non A/C)</option>
                                <option value="Car(A/C)">Car(A/C)</option>
                                <option value="Mini Van">Mini Van</option>
                            </datalist>



                            <div>
                                <label for="faretype" class="label">Fare Type</label><br>
                            </div>
                            <input value="<?= set_value('faretype') ?>" list="faretype_list" name="faretype"
                                id="faretype" required>
                            <datalist id="faretype_list">
                                <option value="Heavy Trafic Time">Heavy Trafic Time</option>
                                <option value="Trafic Time">Trafic Time</option>
                                <option value="Late Night & Early Morning">Late Night & Early Morning</option>
                                <!--<option value="Car(A/C)">-->
                                <option value="Normal">Normal</option>
                            </datalist>


                            <div>
                                <label for="fare" class="label">Fare</label><br>
                            </div>
                            <input value="<?= set_value('fare') ?>" type="text" name="fare"
                                class="<?=!empty($errors['fare']) ? 'error':'';?>" required>
                            <?php if(!empty($errors['fare'])):?>
                            <?php endif;?>
                            <br>


                            <div>
                                <label for="updatedby" class="label">Updated Officer Email</label><br>
                            </div>
                            <input value="<?= set_value('updatedby') ?>" type="text" name="updatedby"
                                class="<?=!empty($errors['updatedby']) ? 'error':'';?>" required>
                            <?php if(!empty($errors['updatedby'])):?>
                            <small id="Firstname-error" class="signup-error" style="color: red;">
                                <?=$errors['address']?></small>
                            <?php endif;?><br>

                            <div>
                                <label for="date" class="label">Updated Date</label><br>
                            </div>
                            <input value="<?= set_value('date') ?>" type="date" name="date"
                                class="<?=!empty($errors['date']) ? 'error':'';?>" required>
                            <?php if(!empty($errors['date'])):?>
                            <?php endif;?><br>

                            <div class="btn">
                                <a href="<?=ROOT?>/officer/standardFare"><button id="submit_btn"
                                        class="submit_btn">Submit</button></a>
                                <a href="<?=ROOT?>/officer/standardFare"><small class="skip">
                                        <center>Cancel</center>
                                    </small></a>
                            </div>
                        </div>
                    </form>
                </div>
            </center>
        </div>
        <script>
        const table = document.querySelector('.table1')
        const form = document.querySelector('.officer_form')
        // const skip = document.querySelector('.skip')
        const operation = document.getElementById('submit_btn')
        </script>








</body>

</html>
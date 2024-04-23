<!DOCTYPE html>
<html>
    <head>
        <title>
            Driver Set Up
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= ROOT?>/assets/css/driverCSS.css">
    </head>
    <body>
        <div class="header-container">
            <img id="logo" src="<?= ROOT?>/assets/img/images/Logo.png">
            <img class="profile-pic" src="<?= ROOT?>/assets/img/images/Image-60.png">
        </div>
        <div class="outer-container">
            <div style="margin-top:60px;"></div>
            <p class="welcome-text">Welcome, <?php echo $_SESSION['USER_DATA']->name; ?></p>
            <p class="text1">
                Here are the steps you need to follow to set up your profile.
            </p>
            <div class="inner-container">
                <div class="setup-options" id="op1">
                    <div><img class="document_icon" src="<?= ROOT?>/assets/img/images/document_icon.png"></div>
                    <div>
                        <div class="setup-options-inner">
                            <a class="profile" href="<?=ROOT?>/driver/profilePicture">Profile photo</a>
                            <?php if($_SESSION['regitems']['profileimg']=='0'):?>
                                <img class="arrow1" src="<?= ROOT?>/assets/img/images/Square Arrow Right.png">
                            <?php else: ?>
                                <img class="arrow1" src="<?= ROOT?>/assets/img/images/Square Tick.png">
                            <?php endif;?>
                        </div>
                        <img  class="line" src="<?= ROOT?>/assets/img/images/Line.png">
                    </div>
                </div>
                <div class="setup-options">
                    <div><img class="document_icon" src="<?= ROOT?>/assets/img/images/document_icon.png"></div>
                    <div>
                        <div class="setup-options-inner">
                            <a class="d-license" href="<?=ROOT?>/driver/driverLicense">Driving License</a>
                            <?php if($_SESSION['regitems']['driverlicenseimg']=='0'):?>
                                <img class="arrow1" src="<?= ROOT?>/assets/img/images/Square Arrow Right.png">
                            <?php else: ?>
                                <img class="arrow1" src="<?= ROOT?>/assets/img/images/Square Tick.png">
                            <?php endif;?>

                        </div>
                        <img  class="line" src="<?= ROOT?>/assets/img/images/Line.png">
                    </div>
                </div>
                <div class="setup-options">
                    <div><img class="document_icon" src="<?= ROOT?>/assets/img/images/document_icon.png"></div>
                    <div>
                        <div class="setup-options-inner">
                            <a class="r-license" href="<?=ROOT?>/driver/revenueLicense">Revenue License</a>
                            <?php if($_SESSION['regitems']['revenuelicenseimg']=='0'):?>
                                <img class="arrow1" src="<?= ROOT?>/assets/img/images/Square Arrow Right.png">
                            <?php else: ?>
                                <img class="arrow1" src="<?= ROOT?>/assets/img/images/Square Tick.png">
                            <?php endif;?>
                        </div>
                        <img  class="line" src="<?= ROOT?>/assets/img/images/Line.png">
                    </div>
                </div>
                <div class="setup-options">
                    <div><img class="document_icon" src="<?= ROOT?>/assets/img/images/document_icon.png"></div>
                    <div>
                        <div class="setup-options-inner">
                            <a class="v-reg" href="<?=ROOT?>/driver/vehicleRegistration">Vehicle Registration Document</a>
                            <?php if($_SESSION['regitems']['vehregistrationimg']=='0'):?>
                                <img class="arrow1" src="<?= ROOT?>/assets/img/images/Square Arrow Right.png">
                            <?php else: ?>
                                <img class="arrow1" src="<?= ROOT?>/assets/img/images/Square Tick.png">
                            <?php endif;?>
                        </div>
                        <img  class="line" src="<?= ROOT?>/assets/img/images/Line.png">
                    </div>
                </div>
                <div class="setup-options">
                    <div><img class="document_icon" src="<?= ROOT?>/assets/img/images/document_icon.png"></div>
                    <div>
                        <div class="setup-options-inner">
                            <a class="v-insurance" href="<?=ROOT?>/driver/vehicleInsurance">Vehicle Insuarance</a>
                            <?php if($_SESSION['regitems']['vehinsuranceimg']=='0'):?>
                                <img class="arrow1" src="<?= ROOT?>/assets/img/images/Square Arrow Right.png">
                            <?php else: ?>
                                <img class="arrow1" src="<?= ROOT?>/assets/img/images/Square Tick.png">
                            <?php endif;?>
                        </div>
                        <img  class="line" src="<?= ROOT?>/assets/img/images/Line.png">
                    </div>
                </div>
                <form method="post"><input type="submit" class="submit-btn" value="Submit" name="registration"></form>
            </div>
        </div>
        <script>
             document.getElementById("op1").onmouseover = function() {
                element1 = document.getElementById("sp1");
                element1.style.fontSize = '23px';
                element2 = document.getElementById("op1");
                element2.style.backgroundColor = 'grey'
            }
            document.getElementById("op1").onmouseout = function() {
                element1 = document.getElementById("sp1");
                element1.style.fontSize = '16px';
                element2 = document.getElementById("op1");
                element2.style.backgroundColor = 'white'
            }
        </script>
    </body>


</html>
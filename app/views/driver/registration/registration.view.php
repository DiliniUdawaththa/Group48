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
        <div class="header-spacing"></div>
        <div class="outer-container">
            <p class="welcome-text">Welcome, John</p>
            <p class="text1">
                Here are the steps you need to follow to set up your profile.
            </p>
            <div class="inner-container">
                <div class="setup-options" id="op1">
                    <div><img class="document_icon" src="<?= ROOT?>/assets/img/images/document_icon.png"></div>
                    <div><div class="setup-options-inner"><a class="profile" href="Profilepic.html">Profile photo</a><img class="arrow" src="<?= ROOT?>/assets/img/images/Square Arrow Right.png"></div><img  class="line" src="<?= ROOT?>/assets/img/images/Line.png"></div>
                </div>
                <div class="setup-options">
                    <div><img class="document_icon" src="<?= ROOT?>/assets/img/images/document_icon.png"></div>
                    <div><div class="setup-options-inner"><a class="d-license" href="<?=ROOT?>/driver/registration/driverLicense.html">Driving License</a><img class="arrow1" src="<?= ROOT?>/assets/img/images/Square Arrow Right.png"></div><img  class="line" src="<?= ROOT?>/assets/img/images/Line.png"></div>
                </div>
                <div class="setup-options">
                    <div><img class="document_icon" src="<?= ROOT?>/assets/img/images/document_icon.png"></div>
                    <div><div class="setup-options-inner"><a class="r-license" href="revenueLicense.html
                        ">Revenue License</a><img class="arrow" src="<?= ROOT?>/assets/img/images/Square Arrow Right.png"></div><img  class="line" src="<?= ROOT?>/assets/img/images/Line.png"></div>
                </div>
                <div class="setup-options">
                    <div><img class="document_icon" src="<?= ROOT?>/assets/img/images/document_icon.png"></div>
                    <div><div class="setup-options-inner"><a class="v-reg" href="vehicleRegistration.html">Vehicle Registration Document</a><img class="arrow" src="<?= ROOT?>/assets/img/images/Square Arrow Right.png"></div><img  class="line" src="<?= ROOT?>/assets/img/images/Line.png"></div>
                </div>
                <div class="setup-options">
                    <div><img class="document_icon" src="<?= ROOT?>/assets/img/images/document_icon.png"></div>
                    <div><div class="setup-options-inner"><a class="v-insurance" href="vechicleInsurance.html">Vehicle Insuarance</a><img class="arrow" src="<?= ROOT?>/assets/img/images/Square Arrow Right.png"></div><img  class="line" src="<?= ROOT?>/assets/img/images/Line.png"></div>
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
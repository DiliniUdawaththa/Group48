
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap-->

    <!-- Include Bootstrap JS (required for the toggle button) -->

    <title>Officer Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT?>/assets/css/officer_style2.css">
</head>

<body>
    <div class="main-div">
        <!-- large screen navbar  -->
        <div  class="div-1">
            <div class="text-center mt-3">
                <img src="<?= ROOT?>/assets/img/officer_images/logo_2.png" class="" width="200px">
            </div>
            <div class="text-center mt-2">
                <img src="<?= ROOT?>/assets/img/officer_images/driver.png" class="border" width="40%">
                <h1><?php echo $_SESSION['USER_DATA']->name; ?> - Officer</h1>
            </div>
            <div class="ms-5 mt-3 category">
                <div class="option"><a href="dashboard.vew.php">Dashboard</a></div>
                <div class="option"><a href="<?=ROOT?>/officer/officerdriverRegistration">Driver Registration</a></div>
                <div class="option" style="background-color:#091d2e;"><a href="<?=ROOT?>/officer/complains">Complains</a></div>
                <div class="option"><a href="<?=ROOT?>/officer/standardFare">Standard Fair</a></div>
                <div class="option" id="opt5" style="cursor: pointer;"><a>Logout</a></div>
            </div>
        </div>



        <div class="div-dash">
            <div class="admin-top">
                <i class="fa fa-user"></i> Complains
            </div>
            <div class="admin-midle">
                <div class="request-box">
                    <div>
                        <img src="<?= ROOT?>/assets/img/officer_images/person.jpg" style="height: 50px;width:50px;border-radius: 100%;">
                    </div>
                    <div class="destination">
                        <p style="display: block;margin: 5px;">Towards: Bandara (Driver)</p>
                        <p style="display: block;margin: 5px;">Type: Unsafe Driving</p>
                    </div>
                    <div style="width: 100px;"> 
                            <button class="btn1">Review</button>
                            <button class="btn2">Remove</button> 
                    </div>
                </div>
                <div class="request-box">
                    <div>
                        <img src="<?= ROOT?>/assets/img/officer_images/person1.png" style="height: 50px;width:50px;border-radius: 100%;">
                    </div>
                    <div class="destination">
                        <p style="display: block;margin: 5px;">Towards: Jayaweera (Passenger)</p>
                        <p style="display: block;margin: 5px;">Type: Rude or Unprofessional Behavior</p>
                    </div>
                    <div style="width: 100px;"> 
                            <button class="btn1">Review</button>
                            <button class="btn2">Remove</button> 
                    </div>
                </div>
                <div class="request-box">
                    <div>
                        <img src="<?= ROOT?>/assets/img/officer_images/person.jpg" style="height: 50px;width:50px;border-radius: 100%;">
                    </div>
                    <div class="destination">
                        <p style="display: block;margin: 5px;">Towards: Ajith (Driver)</p>
                        <p style="display: block;margin: 5px;">Type: Late or Unreliable Service</p>
                    </div>
                    <div style="width: 100px;"> 
                            <button class="btn1">Review</button>
                            <button class="btn2">Remove</button> 
                    </div>
                </div>
                
                
            </div>
            
        </div>
    </div>
    <div class="logout-container">
        <h2>Log Out</h2>
        <p class="logout-text">Are you sure you want to log out?</p>
        <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn" onclick = "window.location.href = '<?=ROOT?>/logout';">Log Out</button></div>
    </div>
    <script>
        const logout_container = document.querySelector('.logout-container')
        const cancel_button = document.querySelector('.cancel-btn')


        document.querySelector('#opt5').addEventListener('click',function (){
            logout_container.style.display = 'block';
        })

        cancel_button.addEventListener('click',function (){
            logout_container.style.display = 'none';
        })
</script>

</body>

</html>
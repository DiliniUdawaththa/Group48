<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/Report.css">
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
                <a href="<?=ROOT?>/admin/officer" class="link"><div class="linkbutton"><i class="fa-solid fa-user-tie"></i>Officer</div></a>
                <a href="<?=ROOT?>/admin/ride" class="link"><div class="linkbutton"><i class="fa-solid fa-taxi"></i>Rides</div></a>
                <a href="<?=ROOT?>/admin/report" class="link"><div class="linkbutton1"><i class="fa-solid fa-list"></i>Reports</div></a>
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
                    <center><h2>Report Categories</h2></center>
                </div>
            </div>
            <div class='report'>
                <div class='report-box'>
                    <a href="#" class="report-link"><div class="linkbtn-user">User statistics<i class="fa fa-hand-o-right" aria-hidden="true"></i></div></a>
                    <a href="<?=ROOT?>/admin/rideReport" class="report-link"><div class="linkbtn">Ride statistics<i class="fa fa-hand-o-right" aria-hidden="true"></i></div></a>
                    <a href="<?=ROOT?>/admin/customerReport" class="report-link"><div class="linkbtn">Customer reports<i class="fa fa-hand-o-right" aria-hidden="true"></i></div></a>
                    <a href="<?=ROOT?>/admin/driverReport" class="report-link"><div class="linkbtn">Driver reports<i class="fa fa-hand-o-right" aria-hidden="true"></i></div></a>
                </div>
            </div>
            <div class="report-container">
                <h3>Number of users have been registered with the system as on <?php echo date("Y-m-d"); ?> group by their role</h3>
                <div class="report-select">
                  <button class="user-btn">Preview</button> 
                  <button class="ride-btn">Download</button>
                  <button class="report-cancel-btn">Cancel</button>
                </div>
            </div>
    </div>

       
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            const report_option = document.querySelector('.linkbtn-user')
            const report_container = document.querySelector('.report-container')
            const user_button = document.querySelector('.user-btn')
            const ride_button = document.querySelector('.ride-btn')
            const report_cancel_button = document.querySelector('.report-cancel-btn')
                    report_option.addEventListener('click', ()=>{
                        report_container.style.display = 'block'
                    })
                    user_button.addEventListener('click', ()=>{
                        window.location.href = "<?=ROOT?>/report/userStatics";
                    })
                    ride_button.addEventListener('click', ()=>{
                        window.location.href = "<?=ROOT?>/report/userStaticsDownload";
                    })
                    report_cancel_button.addEventListener('click', ()=>{
                        report_container.style.display = 'none'
                    })
                  
        });
    </script>

</body>
</html>
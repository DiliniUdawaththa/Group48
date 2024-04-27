<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/RideReport.css">
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
                    <center><h2>Ride Reports</h2></center>
                </div>
            </div>
            <div class='report'>
                <form action="<?=ROOT?>/report/rideReportForm/" method="post">
                    <label for="selectField"><h4>Select Report type:</h4></label>
                    <select id="selectField" name="selectField" onchange="toggleFields()" required>
                        <option value="">Select...</option>
                        <option value="option1">Day Report</option>
                        <option value="option2">Week/month/year Report</option>
                    </select>

                    <div id="field1" style="display: none;">
                        <label for="field1Input">Select Date</label>
                        <input type="date" id="field1Input" name="field1Input">
                    </div>

                    <div id="field2" style="display: none;">
                        <label for="field2Input">Start Date</label>
                        <input type="date" id="field2Input" name="field2Input">
                    </div>

                    <div id="field3" style="display: none;">
                        <label for="field3Input">End Date</label>
                        <input type="date" id="field3Input" name="field3Input">
                    </div>

                    <input type="submit" value="Submit">
                </form>
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
                  
        });
        function toggleFields() {
            var selectedValue = document.getElementById("selectField").value;
            var field1 = document.getElementById("field1");
            var field2 = document.getElementById("field2");
            var field3 = document.getElementById("field3");

            // Show or hide fields based on the selected value
            if (selectedValue === "option1") {
            field1.style.display = "block";
            field2.style.display = "none";
            field3.style.display = "none";
            } else if (selectedValue === "option2") {
            field1.style.display = "none";
            field2.style.display = "block";
            field3.style.display = "block";
            } else {
            field1.style.display = "none";
            field2.style.display = "none";
            field3.style.display = "none";
            }
        }
    </script>

</body>
</html>
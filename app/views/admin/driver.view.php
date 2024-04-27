<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/Driver.css">
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
                <a href="<?=ROOT?>/admin/driver" class="link"><div class="linkbutton1"><i class="fa-solid fa-user-group"></i>Drivers</div></a>
                <a href="<?=ROOT?>/admin/officer" class="link"><div class="linkbutton"><i class="fa-solid fa-user-tie"></i>Officer</div></a>
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
                    <h2>DRIVERS</h2>
                </div>

                <div class="search">
                <form action="<?= ROOT ?>/admin/searchDriver" method="GET">
                    <input type="text" name="search" placeholder="Search for drivers">
                    <input type="submit" value="Search" class="srch">
                </form>
                </div>
            </div>

            <div class='detail-box'>
                <div id="chart" style="height: 40%; width:40%;">
                </div>
                <div class='chart-phase'>
                    <center><h2>Driver Counts</h2></center>
                    <table class="inner-table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Total</td>
                                <td><?php echo $total_driver_count; ?></td> <!-- Replace with actual count -->
                            </tr>
                            <tr>
                                <td>Upcoming Expire</td>
                                <td><?php echo $upcomingExpire; ?></td> <!-- Replace with actual count -->
                            </tr>
                            <tr>
                                <td>Expired</td>
                                <td><?php echo $expired; ?></td> <!-- Replace with actual count -->
                            </tr>
                        </tbody>
                    </table>
                    <button class="action-button">Send Reminder Mails</button>
                </div>

            </div>

            <div class="table1">
                <table>
                    <thead>
                        <tr>
                            <td>Customer ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Mobile</td>
                        </tr>
                    </thead>
                    <?php foreach ($rows as $row) : ?>
                        <tr class="data">
                            <td class="td_id"><?= $row->id; ?></td>
                            <td class="td_name"><?= $row->name; ?></td>
                            <td class="td_email"><?= $row->email; ?></td>
                            <td class="td_mobile"><?= $row->phone; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="mail-container">
                <h2>Send Reminder Mails</h2>
                <p class="mail-text">Are you sure you want to send send reminder mails to the drivers, whose accounts will be expired within this week?</p>
                <div class="cancel-logout"><button class="cancel-btn1">Cancel</button> <button class="ok-btn">Send</button></div>
            </div>

        </div>
    <!-- </div> -->

   
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

            const mail_option = document.querySelector('.action-button')
            const mail_container = document.querySelector('.mail-container')
            const cancel_button1 = document.querySelector('.cancel-btn1')
            const ok_button = document.querySelector('.ok-btn')
                    mail_option.addEventListener('click',()=>{
                        mail_container.style.display = 'block'
                        })

                        cancel_button1.addEventListener('click', ()=>{
                        mail_container.style.display = 'none'
                        })

                        ok_button.addEventListener('click', ()=>{
                        window.location.href = "<?=ROOT?>/admin/mail";
                        })

            const table = document.querySelector('.table1')
            const search = document.querySelector('.srch')

            var upcomingExpire = <?php echo $upcomingExpire; ?>;
            var expire = <?php echo $expired; ?>;
            var total = <?php echo $total_driver_count; ?>;
            var active = total - (expire + upcomingExpire);

            var options = {
            series: [upcomingExpire,expire,active],
            chart: {
            type: 'donut',
            },
            labels: ['Expire Recently', 'Expired', 'Totally Active'],
            responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                width: 50
                },
                legend: {
                position: 'bottom'
                }
            }
            }]
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
      
    </script>
</body>
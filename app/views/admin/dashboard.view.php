<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/Dashboard.css">
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
                <a href="<?=ROOT?>/admin" class="link"><div class="linkbutton1"><i class="fa-solid fa-gauge"></i>Dashboard</div></a>
                <a href="<?=ROOT?>/admin/customer" class="link"><div class="linkbutton"><i class="fa-solid fa-users"></i>Customers</div></a>
                <a href="<?=ROOT?>/admin/driver" class="link"><div class="linkbutton"><i class="fa-solid fa-user-group"></i>Drivers</div></a>
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
                        <h2>Admin Dashboard</h2>
                    </div>
            </div>

            <div class="values">
            <?php foreach ($roleCounts as $role => $count): ?>
                <div class="val-box">
                    <i class="fa-solid fa-users"></i>
                    <div>
                        <span><h3><?= ucfirst($role) ?></h3></span>
                        <center><h3><?= $count ?></h3></center>
                    </div>   
                </div>
            <?php endforeach; ?> 
                <!-- <div class="val-box">
                    <i class="fa-solid fa-user-group"></i>
                    <div>
                        <span>Drivers</span>
                        <h3>100</h3>
                    </div>
                </div>
                <div class="val-box">
                    <i class="fa-solid fa-user-tie"></i>
                    <div>
                        <span>Officers</span>
                        <h3>4</h3>
                    </div>
                </div>-->
                <div class="val-box">
                    <i class="fa-solid fa-taxi"></i>
                    <div>
                        <span><h3>Rides</h3></span>
                        <center><h3><?php echo $rideCount; ?></h3></center>
                    </div>

                </div> 

                <!-- </div> --> 

            </div>
            <div class = "chart_phase">
                <div class="chart_des">
                    <h3>Annual Registration</h3>
                </div>
                <div id="chart1" style="height: 80%; width:100%;">
                    <!-- <h2>Weekly rides</h2> -->
                </div>
            </div>

            <div class = "chart_phase1">
                <div id="chart" style="height: 80%; width:50%;">
                </div>
                <div id="chart2" style="height: 80%; width:50%;">
                </div>
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
        });

        var options1 = {
          series: [{
          name: 'Customers',
          type: 'column',
          data: [<?= implode(',', array_column($registrationData, 'users')) ?>]
        }, {
          name: 'Drivers',
          type: 'column',
          data: [<?= implode(',', array_column($registrationData, 'drivers')) ?>]
        }],
          chart: {
          height: '100%',
          width: '100%',
          type: 'line',
          stacked: false
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: [1, 1, 4]
        },
        // title: {
        //   text: 'User registration',
        //   align: 'left',
        //   offsetX: 110
        // },
        xaxis: {
          categories: ["January", "Feb", "March", "April", "May","June", "July", "August", "September", "October", "November", "December"],
        },
        yaxis: [
          {
            axisTicks: {
              show: true,
            },
            axisBorder: {
              show: true,
              color: '#008FFB'
            },
            labels: {
              style: {
                colors: '#008FFB',
              }
            },
            title: {
              text: "No of users",
              style: {
                color: '#008FFB',
              }
            },
            tooltip: {
              enabled: true
            }
          },
          // {
            // seriesName: 'Revenue',
            // opposite: true,
            // axisTicks: {
            //   show: true,
            // },
            // axisBorder: {
            //   show: true,
            //   color: 'green'
            // },
          //   labels: {
          //     style: {
          //       colors: 'green',
          //     },
          //   }  
          // },
        ],
        tooltip: {
          fixed: {
            enabled: true,
            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
            offsetY: 30,
            offsetX: 60
          },
        }
        // legend: {
        //   horizontalAlign: 'left',
        //   verticalAlign: 'top',
        //   offsetX: 40
        // }
        };

        var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
        chart1.render();

        const rideCountsByDay = <?= json_encode($rideCountsByDay) ?>;
        const rideCountsByMorning = <?= json_encode($rideCountsByMorning) ?>;
        const rideCountsByNight = <?= json_encode($rideCountsByNight) ?>;

        // Prepare data for the chart
        const rideCountsData = Object.values(rideCountsByDay);
        const rideCountsMorningData = Object.values(rideCountsByMorning);
        const rideCountsNightData = Object.values(rideCountsByNight);
        const weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

        var options = {
            chart: {
                type: 'bar',
                width: '90%',
                height: '90%'
            },
            series: [{
                name: 'Rides',
                data: rideCountsData
            }],
            title: {
                text: 'Weekly Rides',
                align: 'left',
                offsetX: 110
            },
            xaxis: {
                categories: weekdays
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var options2 = {
            chart: {
                type: 'line',
                width: '90%',
                height: '90%'
            },
            series: [{
                name: 'Day',
                data: rideCountsMorningData
            },
            {
                name: 'Night',
                data: rideCountsNightData
            }],
            title: {
                text: 'Weekly Rides',
                align: 'left',
                offsetX: 110
            },
            xaxis: {
                categories: weekdays
            }
        }

        var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
        chart2.render();
    </script>

</body>
</html>
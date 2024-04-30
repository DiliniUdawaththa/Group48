<!DOCTYPE html>
<html>
    <head>
        <title>
            Profile
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/driverui.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito Sans' rel='stylesheet'>
        <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
        <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script> -->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <style>
            .opt2{
                    background-color:#194672;
                    color: white;
            }
        </style>
    </head>
    <body>
        
    <?php include 'driver_side.php'; ?>



        <div class="page-container">
            <div class="body-container">
            <div class="analytics-container">
                    <div class="today-analytics">
                        <div class="t-topic"><h3>Today's Performance</h3> </div>
                        <div class="t-body">
                            <div class="t-content"><img src="<?= ROOT ?>/assets/img/images/coin.png" class="performance-img"> <p class="p-stat">LKR <?php echo $data['total_earned'] ?></p></div>
                            <div class="t-content"><img src="<?= ROOT ?>/assets/img/images/clock.png" class="performance-img"><p class="p-stat"><?php echo $data['total_distance'] ?> km</p></div>
                            <div class="t-content"><img src="<?= ROOT ?>/assets/img/images/bar-chart.png" class="performance-img"> <p class="p-stat"><?php echo $data['total_rides'] ?>  Rides</p></div>       


                        </div>

                    </div>
                    <div class="ride-history">
                        <div class="t-topic"><h3>Ride History</h3> </div>
                        <table>
                            <tr>
                                <th>Passenger</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Destination</th>
                                <th>Distance</th>
                                <th>Time</th>
                                <th>Earned fare</th>
                            </tr>
                        <?php if($data['total_rides']>0): ?>
                            <?php foreach ($data['current_rides'] as $rides) : ?>
                                <tr>
                                <td> <?php echo $rides -> date; ?></td>
                                <td> <?php echo $rides -> date; ?></td>
                                <td> <?php echo $rides -> location; ?></td>
                                <td> <?php echo $rides -> destination; ?></td>
                                <td> <?php echo $rides -> distance; ?></td>
                                <td> <?php echo $rides -> time; ?></td>
                                <td> <?php echo $rides -> fare; ?></td>
                                </tr>

                            <?php endforeach; ?>
                        <?php endif; ?>
                        </table>
                        <?php if($data['total_rides']=0): ?>
                            <p class="no-rides" style="margin:10px">No rides to display</p>
                            <?php endif; ?>

                        
                    </div>
                    <div class="charts-container">
                        <div class="chart">
                            <h3 style="text-align: center;">Daily Rides</h3>
                            <div id="chart1">
                            </div>
                        </div>

                    </div>
                </div>
                
                <script>

                var options = {
                chart: {
                    type: 'line',
                    width: 600 ,
                },
                series: [{
                    name: 'sales',
                    data: [<?php echo $data['history-count'][3]; ?>,<?php echo $data['history-count'][3]; ?>,<?php echo $data['history-count'][1]; ?>,<?php echo $data['history-count'][0]; ?>]
                }],
                xaxis: {
                    categories: ["<?php echo date('m-d', strtotime('-3 day')); ?>","<?php echo date('m-d', strtotime('-2 day')); ?>","<?php echo date('m-d', strtotime('-1 day')); ?>","<?php echo date('m-d'); ?>"]
                }
                }
                var chart = new ApexCharts(document.querySelector("#chart1"), options);
                chart.render();


                </script>
                
                <div class="logout-container">
                    <h2>Log Out</h2>
                    <p class="logout-text">Are you sure you want to log out?</p>
                    <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn" onclick = "window.location.href = '<?=ROOT?>/logout';">Log Out</button></div>
                </div>
        </div>
</div>

                

        <script>
            var status = 1
            var sidenav = 1
            const addVehBtn = document.querySelector('#add-veh-btn');
            const more = document.querySelector('.more-icon');
            const navigation = document.querySelector('.side-nav')
            const active_btn = document.querySelector('.active');
            const inactive_btn = document.querySelector('.inactive');
            const status_icon = document.getElementById('status_icon');
            const logout_option = document.querySelector('.opt4');    
            const notification_container = document.querySelector('.analytics-container')
            const activity_container = document.querySelector('.activity-container')
            const vehicles_container = document.querySelector('.vehicles-container')
            const profile_container = document.querySelector('.profile-container')
            const logout_container = document.querySelector('.logout-container')
            const cancel_button = document.querySelector('.cancel-btn')
            const logout_button = document.querySelector('.logout-btn')
            
            logout_option.addEventListener('click',function (){
                logout_container.style.display = 'block';
            })

            cancel_button.addEventListener('click',function (){
                logout_container.style.display = 'none';
            })
            
            more.addEventListener('click', function (){
                if(sidenav == 1){
                    navigation.style.display = 'none';
                    sidenav = 0
                }else{
                    navigation.style.display = 'block';
                    sidenav = 1
                }
                

            })

            active_btn.addEventListener('click',function (){
                status = 1
                status_icon.src = '<?= ROOT ?>/assets/img/images/active.png';
                active_btn.style.backgroundColor = '#162938'
                active_btn.style.color = 'white'
                inactive_btn.style.backgroundColor = '#E4E4E4'
                inactive_btn.style.color = 'black'
            })
            inactive_btn.addEventListener('click',function (){
                status = 0
                status_icon.src = '<?= ROOT ?>/assets/img/images/inactive.png';
                active_btn.style.backgroundColor = '#E4E4E4'
                active_btn.style.color = 'black'
                inactive_btn.style.backgroundColor = '#162938'
                inactive_btn.style.color = 'white'
            })

            
            function map_view(){
                document.querySelector('.map-route').style.display = 'block';
            }
            function close_map(){
                document.querySelector('.map-route').style.display = 'none';
            }


            document.querySelector('.accept-btn').addEventListener('click', function(){
                document.querySelector('.offer-container').style.display = 'block'
            })

            document.querySelector('.accept-btn1').addEventListener('click', function(){
                document.querySelector('.offer-container').style.display = 'block'
            })

            document.querySelector('.close-offer').addEventListener('click', function(){
                document.querySelector('.offer-container').style.display = 'none'
            })

            const standard_fare = document.getElementById('std-fare')
            standard_fare.addEventListener('click', function() {
                if (standard_fare.checked) {
                    document.getElementById('fare-amount').value = '600'
                    document.getElementById('fare-amount').disabled = true
                } else {
                    document.getElementById('fare-amount').disabled = false
                }
            });

            function addVehicle(){
                addVehBtn.style.display = 'none';
                document.querySelector('.add-vehicle').style.display = 'flex'
            }

            document.querySelector('.update-veh').addEventListener('click', function(){
                document.querySelector('.update-veh1').style.display = 'block'
            })

            document.querySelector('.cancel-veh-btn').addEventListener('click', function(){
                document.querySelector('.update-veh1').style.display = 'none'
            })


        </script>
    </body>
</html>


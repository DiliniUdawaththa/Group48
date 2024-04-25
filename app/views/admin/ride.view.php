<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/Ride.css">
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
                <a href="<?=ROOT?>/admin/ride" class="link"><div class="linkbutton1"><i class="fa-solid fa-taxi"></i>Rides</div></a>
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
                    <h2>RIDES</h2>
                </div>
                <div class="search">
                <form action="<?=ROOT?>/admin/searchRide" method="GET">
                    <!-- <select name="searchBy">
                        <option value="date">Date</option>
                        <option value="driver_id">Driver ID</option>
                        <option value="passenger_id">Customer ID</option>
                    </select> -->
                    <input type="date" name="search" placeholder="Search rides by date" class="input-val">
                    <input type="submit" value="Search" class="srch">
                </form>
                </div>
            </div>
            <div class="table1">
                <table>
                    <thead>
                        <tr>
                            <td>RideID</td>
                            <td>CustomerID</td>
                            <td>DriverID</td>
                            <td>Taxi type</td>
                            <td>Date</td>
                            <td>More</td>
                            <!-- <td>Option</td> -->
                        </tr>
                    </thead>
                    <?php foreach ($rows as $row) : ?>
                        <tr class="data">
                            <td class="td_rideID"><?= $row->id; ?></td>
                            <td class="td_custID"><?= $row->passenger_id; ?></td>
                            <td class="td_driverID"><?= $row->driver_id; ?></td>
                            <td class="td_taxi"><?= $row->vehicle; ?></td>
                            <td class="td_taxi"><?= $row->date; ?></td>
                            <td class="td_button">
                                <a href="<?=ROOT?>/admin/rideMore/<?= urlencode($row->id) ?>"><button class="detail_btn" data-id="<?= $row->id; ?>"><i class="fa-solid fa-circle-info" style="color: black;"></i></button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
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
                        
            const table = document.querySelector('.table1')

            // document.getElementById('searchBy').addEventListener('change', function() {
            //     console.log('Search By changed:', this.value);
            //     var selectedOption = this.value;
            //     var dateField = document.getElementById('dateField');

            //     if (selectedOption === 'date') {
            //         dateField.style.display = 'block';
            //     } else {
            //         dateField.style.display = 'none';
            //     }
            // });
        });

    </script>
</body>
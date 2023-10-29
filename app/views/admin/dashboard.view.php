<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/Dashboard.css">
</head>
<body>

    <!-- in nav bar contant -->
    <!-- we will use getemail or other data _callstatic do it -->
   <!-- echo getname() -->

    <!-- logout format -->
    <!-- <div> <li><a href="?=ROOT?>/logout">Logout</a></li> </div> -->
   
    <?php $this->view('admin/include/sidebar',$data) ?>
    <section id="interface">
        <div class="navigation">
            <div class="n1">
                <div class="search">
                    <i class="fa-solid fa-gauge"></i>
                    <h3>Admin Dashboard</h3>
                </div>
            </div>

            <div class="profile">
                <i class="fa-solid fa-bell"></i>
            </div>
        </div>

        <div class="values">
            <div class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                    <span>Customers</span>
                    <h3>1000</h3>
                </div>   
            </div>
            <div class="val-box">
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
            </div>
            <div class="val-box">
                <i class="fa-solid fa-taxi"></i>
                <div>
                    <span>Rides</span>
                    <h3>400</h3>
                </div>
            </div>
        </div>

    </section>

</body>
</html>
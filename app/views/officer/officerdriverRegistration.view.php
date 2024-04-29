<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Officer/Officer.css">

    <style>
    .error {
        border: 1px solid red;
        color: red;
    }

    .message {
        height: 50px;
        width: 100%;
        margin-bottom: 10px;
    }

    .message p {
        padding: 10px;
        font-size: 1em;
        color: #026334;
        background-color: #a7cfbc;
    }

    .con-button {
        width: 80%;
        background-color: #000000;
        color: white;
        border: none;
        border-radius: 10px;
        height: 50px;
        font-size: 20px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .none-dec {
        text-decoration: none;
    }


    .box1 {
        width: 80%;
        margin: auto;
        text-align: center;
        position: relative;
        top: 50px;
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
                <img src="<?= ROOT ?>/assets/img/person.jpg" alt="" class="userimage">
                <br>
                <H3 class="username"><?=Auth::getname();?></H3>
            </div>
            <div class="items">
                <a href="<?=ROOT?>/officer" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-gauge"></i>Dashboard</div>
                </a>
                <a href="<?=ROOT?>/officer/officerdriverRegistration" class="link">
                    <div class="linkbutton1"><i class="fa-solid fa-id-card"></i>Driver Registration</div>
                </a>
                <a href="<?=ROOT?>/officer/driver" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-user-group"></i>Drivers</div>
                </a>
                <a href="<?=ROOT?>/officer/customer" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-users"></i>Customers</div>
                </a>
                <a href="<?=ROOT?>/officer/complains" class="link">
                    <div class="linkbutton"><i class="fa-sharp fa-solid fa-circle-exclamation"></i>Complains</div>
                </a>
                <a href="<?=ROOT?>/officer/standardFare" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-tag"></i>Standard Fare</div>
                </a>
                <a href="#" class="link">
                    <div class="linkbutton2"><i class="fa-solid fa-right-from-bracket fa-rotate-180"></i>Logout</div>
                </a>
            </div>

            <div class="logout-container">
                <h2>Log Out</h2>
                <p class="logout-text">Are you sure you want to log out?</p>
                <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log
                        Out</button></div>
            </div>


        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logout_option = document.querySelector('.linkbutton2');
            const logout_container = document.querySelector('.logout-container');
            const cancel_logout_button = document.querySelector('.cancel-btn');
            const logout_button = document.querySelector('.logout-btn');

            logout_option.addEventListener('click', () => {
                logout_container.style.display = 'block';
            });

            cancel_logout_button.addEventListener('click', () => {
                logout_container.style.display = 'none';
            });

            logout_button.addEventListener('click', () => {
                window.location.href = "<?=ROOT?>/logout";
            });

            const accept_buttons = document.querySelectorAll('.accept_btn');
            const reject_buttons = document.querySelectorAll('.reject_btn');
            const accept_container = document.querySelector('.accept-container');
            const reject_container = document.querySelector('.reject-container');
            const cancel_accept_button = document.querySelector('.cancel-accept-btn');
            const cancel_reject_button = document.querySelector('.cancel-reject-btn');

            accept_buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const email = button.getAttribute('data-email');
                    accept_container.style.display = 'block';
                    document.querySelector('.ok-btn').addEventListener('click', () => {
                        window.location.href = "<?=ROOT?>/officer/renewAccept/" +
                            encodeURIComponent(email);
                    });
                });
            });
            cancel_accept_button.addEventListener('click', () => {
                accept_container.style.display = 'none';
            });

            reject_buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const email = button.getAttribute('data-email');
                    reject_container.style.display = 'block';
                    document.querySelector('.reject-btn').addEventListener('click', () => {
                        window.location.href = "<?=ROOT?>/officer/renewReject/" +
                            encodeURIComponent(email);
                    });
                });
            });
            cancel_reject_button.addEventListener('click', () => {
                reject_container.style.display = 'none';
            });


        });
        </script>

        <div class="interface">
            <div class="navi">
                <div class="navi1">
                    <h2>DRIVER REGISTRATION</h2>
                </div>

            </div>
            <div class="table1">
                <table>
                    <thead>
                        <tr>
                            <td>Profile</td>
                            <td>ID</td>
                            <td>More</td>



                        </tr>
                    </thead>
                    <?php foreach ($rows as $row) : ?>
                    <tr class="data">
                        <td><img src="<?= ROOT . '/' . $row->profileimg ?>" alt="Profile Image"
                                style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;"></td>

                        <td><?=$row->id ?>

                        <td class="td_button2">
                            <a href="<?=ROOT?>/officer/driverregistration_view/<?= urlencode($row->id) ?>"><button
                                    class="detail_btn1">
                                    <!--<i
                                        class="fa-solid fa-circle-info" style="color: black;"></i>-->
                                    DETAIL
                                </button></a>
                            <!-- <button class="suspend_btn" data-email="<?= $row->email ?>">SUSPEND</button>
                            <td class="td_button"> -->
                            <button class="accept_btn" data-id="<?= $row->id ?>">ACCEPT</button>
                            <button class="reject_btn" data-id="<?= $row->id ?>">REJECT</button>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>

            </div>
            <div class="accept-container">
                <h2>Approve renewal of driver registration</h2>
                <p class="accept-text">Are you sure you want to approve?</p>
                <div class="btn"><button class="cancel-accept-btn">Cancel</button> <button
                        class="ok-btn">Approve</button></div>
            </div>

            <div class="reject-container">
                <h2>Reject renewal of driver registration</h2>
                <p class="reject-text">Are you sure you want to reject?</p>
                <div class="btn"><button class="cancel-reject-btn">Cancel</button> <button
                        class="reject-btn">Reject</button></div>
            </div>


        </div>


</body>

</html>
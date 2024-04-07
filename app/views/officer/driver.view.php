<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/Officer.css">
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

    .detail_btn {
        background-color: rgb(82, 41, 194);
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 10px;
    }

    .delete_btn {
        background-color: red;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 10px;
    }

    .dltbutton {
        display: flex;
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
                    <div class="linkbutton"><i class="fa-solid fa-id-card"></i></i>Driver Registration</div>
                </a>
                <a href="<?=ROOT?>/officer/driver" class="link">
                    <div class="linkbutton1"><i class="fa-solid fa-users"></i>Drivers</div>
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
        const logout_option = document.querySelector('.linkbutton2')
        const logout_container = document.querySelector('.logout-container')
        const cancel_button = document.querySelector('.cancel-btn')
        const logout_button = document.querySelector('.logout-btn')
        logout_option.addEventListener('click', () => {
            logout_container.style.display = 'block'
        })

        cancel_button.addEventListener('click', () => {
            logout_container.style.display = 'none'
        })

        logout_button.addEventListener('click', () => {
            window.location.href = "<?=ROOT?>/logout";
        })
        </script>

        <div class="interface">
            <div class="navi">
                <div class="navi1">
                    <h2>DRIVERS</h2>
                </div>
                <div class="search">
                    <form action="<?= ROOT ?>/officer/driver" method="GET">
                        <input type="text" name="search" placeholder="Search for driver">
                        <input type="submit" value="Search" class="srch">
                    </form>
                </div>
            </div>

            <div class="table1">
                <table>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Mobile</td>
                            <td>More</td>
                        </tr>
                    </thead>
                    <?php foreach ($rows as $row) : ?>
                    <tr class="data">
                        <td class="td_name"><?= $row->name; ?></td>
                        <td class="td_email"><?= $row->email; ?></td>
                        <td class="td_mobile"><?= $row->phone; ?></td>
                        <td class="td_button">
                            <a href="<?=ROOT?>/officer/driver/"><button class="detail_btn"><i
                                        class="fa-solid fa-circle-info" style="color: black;"></i></button></a>
                            <a href="<?=ROOT?>/officer/driver_delete/<?=$row->id?>">
                                <div class="dltbutton"><button class="delete_btn"><i class="fa-solid fa-trash"
                                            style="color: black;"></i></div></button>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>

            </div>

        </div>
</body>

</html>
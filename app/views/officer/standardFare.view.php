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



    /* .update_btn{
    background-color: green;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px;
}*/
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
                    <div class="linkbutton"><i class="fa-solid fa-id-card"></i>Driver Registration</div>
                </a>
                <a href="<?=ROOT?>/officer/driver" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-users"></i>Drivers</div>
                </a>
                <a href="<?=ROOT?>/officer/complains" class="link">
                    <div class="linkbutton"><i class="fa-sharp fa-solid fa-circle-exclamation"></i>Complains</div>
                </a>
                <a href="<?=ROOT?>/officer/standardFare" class="link">
                    <div class="linkbutton1"><i class="fa-solid fa-tag"></i>Standard Fare</div>
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
                    <h2>STANDARD FARE</h2>
                </div>

                <div class="operation">
                    <a href="<?=ROOT?>/officer/standardFare_insert/"><button type="button" class="button-style"
                            id="plus">Add New</button></a>
                </div>
            </div>

            <div class="table1">
                <table>
                    <thead>
                        <tr>
                            <!--<td>ID</td>-->
                            <td>Fare Type</td>
                            <td>Vehicle Type</td>
                            <td>Fare (Lkr.)</td>
                            <td>Option</td>
                        </tr>
                    </thead>
                    <?php foreach ($rows as $row) : ?>
                    <tr class="data">
                        <!--<td class="td_Fid"><?= $row->Fid; ?></td>-->
                        <td class="td_faretype"><?= $row->faretype; ?></td>
                        <td class="td_vehicletype"><?= $row->vehicletype; ?></td>
                        <td class="td_fare"><?= $row->fare; ?></td>
                        <td class="td_button">
                            <a href="<?=ROOT?>/officer/standardFare_update/<?=$row->Fid?>"><button class="update_btn"><i
                                        class="fa-solid fa-pen-to-square" style="color: black;"></i></i></button></a>
                            <a href="<?=ROOT?>/officer/standardFare_delete/<?=$row->Fid?>">
                                <div class="dltbutton"><button class="delete_btn"><i class="fa-solid fa-trash"
                                            style="color: black;"></i></div></button>
                                <a href="<?=ROOT?>/officer/standardFare_View/<?= urlencode($row->Fid) ?>"><button
                                        class="detail_btn"><i class="fa-solid fa-circle-info"
                                            style="color: black;"></i></button></a>

                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="delete-container">
                <h2>Delete</h2>
                <p class="delete-text">Are you sure you want to Delete this record</p>
                <div class="cancel-delete"><button class="cancel-btn1">Cancel</button><button
                        class="dlt-btn">Delete</button></div>
            </div>



            <script>
            const delete_option = document.querySelector('.dltbutton')
            const delete_container = document.querySelector('.delete-container')
            const cancel_button1 = document.querySelector('.cancel-btn1')
            const delete_button = document.querySelector('.dlt-btn')
            delete_option.addEventListener('click', () => {
                delete_container.style.display = 'block'
            })

            cancel_button1.addEventListener('click', () => {
                delete_container.style.display = 'none'
            })

            delete_button.addEventListener('click', () => {
                window.location.href = "<?=ROOT?>/officer/standardFare_delete/<?=$row->Fid?>";
            })

            //...................................................
            const table = document.querySelector('.table1')
            const form = document.querySelector('.officer_form')
            // const skip = document.querySelector('.skip')
            const operation = document.getElementById('plus')

            // plus.addEventListener('click',()=>{
            //     form.style.display = 'block'
            //     table.style.display = 'none'
            // })

            // skip.addEventListener('click',()=>{
            //     form.style.display = 'none'
            //     table.style.display = 'block'
            // })
            </script>



        </div>


</body>

</html>
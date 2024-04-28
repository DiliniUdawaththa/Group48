<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/Officer.css">
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
                <a href="<?=ROOT?>/admin/officer" class="link"><div class="linkbutton1"><i class="fa-solid fa-user-tie"></i>Officer</div></a>
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
                    <h2>OFFICER</h2>
                </div>

                <div class="operation">
                    <a href="<?=ROOT?>/admin/officer_insert/"><button type="button" class="button-style" id="plus">Add New Officer</button></a>
                </div>
            </div>

            <div class="table1">
                <table>
                    <thead>
                        <tr>
                            <td>empID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Mobile</td>
                            <td>Option</td>
                        </tr>
                    </thead>
                    <?php foreach ($rows as $row) : ?>
                        <tr class="data">
                            <td class="td_empID"><?= $row->empID; ?></td>
                            <td class="td_name"><?= $row->name; ?></td>
                            <td class="td_email"><?= $row->email; ?></td>
                            <td class="td_mobile"><?= $row->phone; ?></td>
                            <td class="td_button">
                            <a href="<?=ROOT?>/admin/officer_update/<?=$row->empID?>"><button class="update_btn"><i class="fa-solid fa-pen-to-square" style="color: black;"></i></i></button></a>
                            <button class="delete_btn" data-email="<?= $row->empID ?>"><i class="fa-solid fa-trash" style="color: black;"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="delete-container">
                <h2>Delete</h2>
                <p class="delete-text">Are you sure you want to Delete this record</p>
                <div class="cancel-delete"><button class="cancel-btn1">Cancel</button><button class="dlt-btn">Delete</button></div>
            </div>

        </div>
    <!-- </div> -->

   
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

            const delete_buttons = document.querySelectorAll('.delete_btn');
            const delete_container = document.querySelector('.delete-container');
            const cancel_delete_button = document.querySelector('.cancel-btn1')
            delete_buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const empID = button.getAttribute('data-email');
                    delete_container.style.display = 'block';
                    document.querySelector('.dlt-btn').addEventListener('click', () => {
                        window.location.href = "<?=ROOT?>/admin/officer_delete/" + encodeURIComponent(empID);
                    });
                });
            });
            cancel_delete_button.addEventListener('click', ()=>{
                delete_container.style.display = 'none'
            })

            // const delete_option = document.querySelector('.dltbutton')
            // const delete_container = document.querySelector('.delete-container')
            // const cancel_button1 = document.querySelector('.cancel-btn1')
            //     const delete_button = document.querySelector('.dlt-btn')
            //         delete_option.addEventListener('click',()=>{
            //             delete_container.style.display = 'block'
            //             })

            //             cancel_button1.addEventListener('click', ()=>{
            //                 delete_container.style.display = 'none'
            //                 })

            //                 delete_button.addEventListener('click', ()=>{
            //                 window.location.href = "<?=ROOT?>/admin/officer_delete/<?=$row->empID?>";
            //                 })

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
        });
    </script>
</body>
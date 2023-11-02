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
   <?php $this->view('admin/include/sidebar',$data) ?>
   <section id="interface">
        <div class="navi">
            <div class="navi1">
                <h2>OFFICER</h2>
            </div>

            <div class="operation">
                <a href="<?=ROOT?>/admin/officer_insert"><button type="button" class="button-style" id="plus">+ Add Officer</button></a>
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
                        <td class="td_name"><?= $row->Name; ?></td>
                        <td class="td_email"><?= $row->Email; ?></td>
                        <td class="td_mobile"><?= $row->Mobile; ?></td>
                        <td class="td_button">
                        <a href="<?=ROOT?>/admin/officer_update/<?=$row->empID?>"><button class="update_btn"><i class="fa-solid fa-pen-to-square" style="color: #407217;"></i></i></button></a>
                            <a href="<?=ROOT?>/admin/officer_delete/<?=$row->empID?>"><button class="delete_btn"><i class="fa-solid fa-trash" style="color: #7b1417;"></i></button>
                        </td>
                     </tr>
                 <?php endforeach; ?>
                <!-- <tbody>
                    <tr>
                        <td>001</td>
                        <td>Amila Perera</td>
                        <td>amila@gmail.com</td>
                        <td>0771234567</td>
                        <td>
                            <button class="update">Update</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Nuwan Perera</td>
                        <td>nuwan@gmail.com</td>
                        <td>0771234567</td>
                        <td>
                            <button class="update">Update</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Dinithi Fernando</td>
                        <td>dinithi@gmail.com</td>
                        <td>0771234567</td>
                        <td>
                            <button class="update">Update</button>
                            <button class="delete">Delete</button>
                        </td>
                    </tr>
                </tbody> -->
            </table>
        </div>
    </section>
    <script>
        // const logout_option = document.querySelector('.linkbutton2')
        // const logout_container = document.querySelector('.logout-container')
        // const cancel_button = document.querySelector('.cancel-btn')
        //   //  const logout_button = document.querySelector('.logout-btn')
        //         logout_option.addEventListener('click',()=>{
        //             logout_container.style.display = 'block'
        //             })

        //             cancel_button.addEventListener('click', ()=>{
        //             logout_container.style.display = 'none'
        //             })

        const table = document.querySelector('.table1')
        const form = document.querySelector('.officer_form')
        const skip = document.querySelector('.skip')
        const plus = document.getElementById('plus')

        plus.addEventListener('click',()=>{
            form.style.display = 'block'
            table.style.display = 'none'
        })

        skip.addEventListener('click',()=>{
            form.style.display = 'none'
            table.style.display = 'block'
        })
    </script>
</body>
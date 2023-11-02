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
                <button type="button" class="button-style">+ Add Officer</button>
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
                <tbody>
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
                </tbody>
            </table>
        </div>
    </section>
</body>
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
                <h2>DRIVERS</h2>
            </div>
        </div>
    </section>
</body>
<!DOCTYPE html>
<html>
<head>
    <title>renew driver registration</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Driver/expireform.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
</head>
<body>
    <div class='outer'>
        <div class="wrapper">
            <a href="http://localhost/FAREFLEX/public"><span class="close"><i class="fa-solid fa-xmark"></i></span></a>
            <div class='wrapper-header'>
                <div class='image'>
                    <img src='<?= ROOT ?>/assets/img/warning.png'></img>
                </div>
                <div class='topic'>
                    <h2>YOUR REGISTRATION HAS EXPIRED!!!</h2>
                    <p>Renew your registration to continue.</p>
                </div>        
            </div>
            <div class='ok'>
                <button class="help-btn" type="submit">HELP</button>
                <button class="renew-btn" type="submit">RENEW</button>
            </div>
        </div>
    </div>
    <script>
        const help_button = document.querySelector('.help-btn') 
        const renew_button = document.querySelector('.renew-btn')
        
        help_button.addEventListener('click', ()=>{
            window.location.href = "<?=ROOT?>/Driver/renewHelp";
        })
        renew_button.addEventListener('click', ()=>{
            window.location.href = "<?=ROOT?>/Driver/renewHelp";
        })
        
    </script>
</body>
</html>
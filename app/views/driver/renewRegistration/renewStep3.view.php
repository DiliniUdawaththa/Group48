<!DOCTYPE html>
<html>
<head>
    <title>renew driver registration</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Driver/renew_form.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">

</head>
<body>
    <div class='container'>
        <center><h3>You have successfully submitted the request for renewal of registration</h3></center>
        <center><h4>Your registration will be renewed within one working day</h4></center>
        <center><h4>You will be informed by an email</h4></center>

        <div class='bttn'>
            <center><button class="ok-btn" type="submit">OK</button></center>
        </div>
    </div>

    <script>
        const ok_button = document.querySelector('.ok-btn')
        
        ok_button.addEventListener('click', ()=>{
            window.location.href = "<?=ROOT?>/Driver/expire";
        })
    </script>
</body>
</html>
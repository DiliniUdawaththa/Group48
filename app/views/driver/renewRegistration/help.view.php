<!DOCTYPE html>
<html>
<head>
    <title>renew driver registration</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Driver/expireform.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
</head>
<body>
    <div class='outer-box'>
        <div class="wrapper-box">
            <div class='wrapper-hdr'>
                <h2>HOW TO RENEW YOUR REGISTRATION</h2>
            </div>
            <div class='content'>        
                <ol>
                    <li>Click on <b>RENEW</b> button.</li>
                    <li>Download the payment slip. Use it when you are doing the payment.</li>
                    <li>Payment details.
                        <ul style="padding-left: 30px">
                            <li>Account No: <b>84662532</b></li>
                            <li>Account Name: Fareflex</li>
                            <li>Bank: Peoples' Bank - Thimbirigasyaya</li>
                            <li>Amount: <b>Rs 1500.00</b></li>
                        </ul>
                    </li>
                    <li>Fill the form and upload the company payment slip copy.</li>
                    <li>Your registration will be renewed within 1 working day. You will be notified through an email.</li>
                </ol>       
            </div>    
        </div>
        <div class='bttn'>
                <button class="back-btn" type="submit">BACK</button>
                <button class="renew-btn" type="submit">RENEW</button>
        </div>
    </div>

    <script>
        const back_button = document.querySelector('.back-btn') 
        const renew_button = document.querySelector('.renew-btn')
        
        back_button.addEventListener('click', ()=>{
            window.location.href = "<?=ROOT?>/Driver/expire";
        })
        renew_button.addEventListener('click', ()=>{
            window.location.href = "<?=ROOT?>/Driver/renew1";
        })
        
    </script>
</body>
</html>
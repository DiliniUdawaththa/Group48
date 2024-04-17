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
                <h2>Driver Registration Renew - Step 01</h2>
            </div>
            <div class='content'>        
                <ul>
                    <li>You have to pay the annual renewal fee. </li>
                    <li>Payment details.
                        <ul style="padding-left: 30px">
                            <li>Account No: <b>84662532</b></li>
                            <li>Account Name: Fareflex</li>
                            <li>Bank: Peoples' Bank - Thimbirigasyaya</li>
                            <li>Amount: <b>Rs 1500.00</b></li>
                        </ul>
                    </li>
                    <li>You can do the payment either at any branch of people's bank or using any online banking app.</li>
                    <li>If the payment is done through online banking submit a screenshot of a confirmation mail.</li>
                    <li><a href="<?=ROOT?>/Driver/downloadSlip">Download payment slip</a></li>
                </ul>       
            </div>    
        </div>
        <div class='bttn'>
                <button class="back-btn" type="submit">BACK</button>
                <button class="renew-btn" type="submit">NEXT</button>
        </div>
    </div>

    <script>
        const back_button = document.querySelector('.back-btn') 
        const renew_button = document.querySelector('.renew-btn')
        
        back_button.addEventListener('click', ()=>{
            window.location.href = "<?=ROOT?>/Driver/expire";
        })
        renew_button.addEventListener('click', ()=>{
            window.location.href = "<?=ROOT?>/Driver/renew2";
        })
        
    </script>
</body>
</html>
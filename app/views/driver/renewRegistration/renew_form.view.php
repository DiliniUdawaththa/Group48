<!DOCTYPE html>
<html>
<head>
    <title>renew driver registration</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Driver/renew_form.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">

</head>
<body>

    <div class='outer-box'>
        <center><h2>Renewal of Driver Registration</h2></center>
        <div class='renew_form'>
            <form method='post' enctype='multipart/form-data' action="<?=ROOT?>/Driver/renew_insert">
                <div class='renew_box'>
                    <div>
                        <label for="email" class="label">Email</label><br>
                    </div>
                    <span class="explanation">(Enter your valid email address, you use when login to the system)</span>
                    <input value="<?= set_value('email') ?>" type="text" name="email" required>       
                      <?php if(!empty($errors['email'])):?>
                        <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['email']?></small>
                      <?php endif;?>
                      <br>
                    
                    <div>
                        <label for="name" class="label" >Name</label><br>
                    </div>
                    <input value="<?= set_value('name') ?>" type="text" name="name" required>
                      <?php if(!empty($errors['name'])):?>
                        <small id="Firstname-error" class="signup-error" style="color: red;"> <?= $errors['name']?> </small>
                      <?php endif;?>
                      <br>
                    
                    <div>
                        <label for="pdf_file" class="label">Payment Slip</label><br>
                    </div>
                    <span class="explanation">(rename payment slip as "slip.pdf")</span>
                    <input type="file" name="pdf_file" accept=".pdf" required>
                    <?php if(!empty($errors['pdf_file'])):?>
                        <small id="Firstname-error" class="signup-error" style="color: red;"> <?= $errors['pdf_file']?> </small>
                      <?php endif;?>
                      <br>
                    
                    <div class='btn'>
                        <a href="<?=ROOT?>/Driver/expire"><small class="skip">Cancel</button></a>
                        <button type="submit" class="submit_btn">Submit</button>    
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const form = document.querySelector('.renew_form')
        const submit_bttn = document.querySelector('.submit-btn')
        
    </script>
</body>
</html>
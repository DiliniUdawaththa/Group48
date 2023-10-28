
<!DOCTYPE html>
<html>
<head>
    <style>
        .error{
            color: red;
            font-size: 1px;
        }
        .border_dangerx {
            border ;
            border: 2px solid red; /* Set the border to 2px width, solid style, and red color */
                 }
    </style>
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/signup1.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
</head>
<body>
    <header>
        <img src="<?= ROOT ?>/assets/img/logo.png" class="logo"/>
    </header>
    <div class="wrapper">
        <a href="http://localhost/FAREFLEX/public"><span class="close"><i class="fa-solid fa-xmark"></i></span></a>
        <div class="form-box login"></div>
            <h2><center>Registration</center></h2>
             

            <form action="#" method="post">
                <div class="input-box">
                    <span class="icons">
                        <i class="fa-solid fa-user"></i>
                    </span> 
                    <input name="name" value="<?= set_value('name') ?>" type="text" class="<?=!empty($errors['name']) ? 'border_danger':'';?>" required>
                    <label>Name</label>
                    <?php if(!empty($errors['name'])):?>
                        <small id="Firstname-error" class="signup-error" style="color: red;"> <?= $errors['name']?> </small>
                    <?php endif;?>
                </div>

                <div class="input-box">
                    <span class="icons">
                        <i class="fa-solid fa-mobile-retro"></i>
                    </span>
                    <input name="phone" value="<?= set_value('phone') ?>" type="text" required>
                    <label>Mobile number</label>
                    <?php if(!empty($errors['phone'])):?>
                        <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['phone']?></small>
                    <?php endif;?>
                    
                    
                </div>

                <div class="input-box">
                    <span class="icons">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input name="email" value="<?= set_value('email') ?>" type="text" required>
                    <label>Email</label>
                    <?php if(!empty($errors['email'])):?>
                        <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['email']?></small>
                    <?php endif;?>
                    

                </div>
                <div class="input-box">
                    <span class="icons">
                        <i class="fa-solid fa-lock "></i> 
                    </span>
                    <input name="password" value="<?= set_value('password') ?>" type="password" required >
                    <label>Password</label>
                    <?php if(!empty($errors['password'])):?>
                        <small id="Firstname-error" class="signup-error" style="color: red;"><?=$errors['password']?></small>
                    <?php endif;?>
                    
                </div>
                  
                <button class="btn" type="submit">Next</button>
                </div>
            </form>
    </div>

    
    <script src="./js/Login.js"></script>
</body>
</html>
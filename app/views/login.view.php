
<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/login.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
</head>
<body>
    <header>
        <img src="<?= ROOT ?>/assets/img/logo.png" class="logo"/>
    </header>
    <div class="wrapper">
       <a href="http://localhost/FAREFLEX/public"><span class="close"><i class="fa-solid fa-xmark"></i></span></a>
        <div class="form-box login"></div>
            <h2><center>Login</center></h2>

            <?php if(message()):?>
                <div><?=message('',true)?></div>
            <?php endif;?>
            <?php if(!empty($errors['email'])):?>
                <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['email']?></small>
             <?php endif;?>

            <form action="#" method="post">
                <div class="input-box">
                    <span class="icons">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="text" name="email" value="<?= set_value('email') ?>" required>
                    <label>Email</label>
                   

                </div>
                <div class="input-box">
                    <span class="icons">
                        <i class="fa-solid fa-lock "></i> 
                    </span>
                    <input type="password" value="<?= set_value('password') ?>" name="password" required>
                    <label>Password</label>
                    
                </div>
                
                                                 
                <div class="remember-forgot">
                    <label>
                        <input type="checkbox">Remember me
                    </label>
                    <a href="#">Forgot Password?</a>

                </div>
                <button class="btn" type="submit">Login</button>
                <div class="login-register">
                    <p>Don't have an account<a href="http://localhost/FAREFLEX/public/signup" class="register-link"> Register</a></p>
                </div>
            </form>
    </div>

    
    <script src="./js/Login.js"></script>
</body>
</html>
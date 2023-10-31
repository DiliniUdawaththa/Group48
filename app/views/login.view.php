
<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/login.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
    <style>
         .message{
            margin-top: 10px;
            height: 50px;
            width: 100%;
            
         }
         .message p{
            padding: 10px;
            font-size: 1em;
            color: #026334;
            background-color: #a7cfbc;
            
            
         }
         .signup-error{
            color: maroon;
            margin-top: 25px;
            height: 50px;
            width: 100%;
            background-color:#d1baba;
            padding: 10px 50px;
            border-radius: 10px;
         }
         
    </style>
</head>
<body>
    <!-- <header>
        <img src="/assets/img/logo.png" class="logo"/>
    </header> -->
    <div class="wrapper">
       <a href="http://localhost/FAREFLEX/public"><span class="close"><i class="fa-solid fa-xmark"></i></span></a>
        <div class="form-box login"></div>
            <h2><center>Login</center></h2>

            <?php if(message()):?>
                <div class="message"><center><p><?=message('',true)?></p></center></div>
            <?php endif;?>

            <?php if(!empty($errors['email'])):?>
                <center><small id="Firstname-error" class="signup-error" > <?=$errors['email']?></small></center>
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
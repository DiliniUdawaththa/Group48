
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
            color: black;
            background-color: #f66f6f;
            
            
            
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
            <h2><center>Forgot Password</center></h2>

            

            

            <form action="#" method="post">
                    <?php if(message()):?>
                        <div class="message"><center><p><?=message('',true)?></p></center></div>
                    <?php endif;?>
                <div class="input-box">
                    <span class="icons">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="text" name="email" value="<?= $rows->email; ?>"  readonly>
                    <label></label>
                   

                </div>
                <?php if(!empty($errors['email'])):?>
                <center><small id="Firstname-error" class="signup-error" > <?=$errors['email']?></small></center>
             <?php endif;?>
                <div class="input-box">
                    <span class="icons">
                    <i class="fa-solid fa-mobile-retro"></i>
                    </span>
                    <input type="text" value="<?= $rows->phone; ?>" name="phone" readonly>
                    <label></label>
                    
                </div>
                <?php if(!empty($errors['phone'])):?>
                        <small id="Firstname-error" class="signup-error" style="color: red;"> <?=$errors['phone']?></small>
                    <?php endif;?>

                    <div class="input-box">
                    <span class="icons">
                        <i class="fa-solid fa-lock "></i> 
                    </span>
                    <input name="password" value="<?= set_value('password') ?>" type="password" >
                    <label>Password</label>
                    <?php if(!empty($errors['password'])):?>
                        <small id="Firstname-error" class="signup-error" style="color: red;"><?=$errors['password']?></small>
                    <?php endif;?>
                    
                </div>

                <div class="input-box">
                    <span class="icons">
                        <i class="fa-solid fa-lock "></i> 
                    </span>
                    <input name="repassword" value="<?= set_value('repassword') ?>" type="password"  >
                    <label>Confirm Password</label>
                    <?php if(!empty($errors['password'])):?>
                        <small id="Firstname-error" class="signup-error" style="color: red;"><?=$errors['password']?></small>
                    <?php endif;?>
                    
                </div>
                
                    <button class="btn" type="submit">Submit</button>                           
                
            </form>
    </div>

    
    <script src="./js/Login.js"></script>
</body>
</html>
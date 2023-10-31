
<!DOCTYPE html>
<html>
<head>
    <style>
        .error{
            color: red;
            font-size: 1px;
        }
        

        input[type=checkbox] {
            background-color: #808694;
            border-radius: 2px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 17px;
            height: 17px;
            cursor: pointer;
             position: relative;
        }
        #checkbox{
            margin-left: 20px;
        }

    input[type=checkbox]:checked {
        background-color: #808694;
        background: #808694 url("data:image/gif;base64,R0lGODlhCwAKAIABAP////3cnSH5BAEKAAEALAAAAAALAAoAAAIUjH+AC73WHIsw0UCjglraO20PNhYAOw==") 3px 3px no-repeat;
    }
    </style>
    <title>Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/signup1.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
</head>
<body>
    <!-- <header>
        <img src="/assets/img/logo.png" class="logo"/>
    </header> -->
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
            
                    <input <?= set_value('term1') ? 'checked':''; ?> type="checkbox"  name="term1"  class="checkbox" >
                    <label for="option1">Passenger </label>
                    
                    <input <?= set_value('term2') ? 'checked':''; ?> type="checkbox" name="term2" class="checkbox"  >
                    <label for="option2"> Driver</label><br>
                    <?php if(!empty($errors['term2'])):?>
                          <small id="Firstname-error" class="signup-error" style="color: red;"><?=$errors['term2']?></small>
                        <?php endif;?><br><br>
                <button class="btn" type="submit">Next</button>
                </div>
            </form>
    </div>

    
    <script src="./js/Login.js"></script>
</body>
</html>
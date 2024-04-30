<?php

class Forgot_password1 extends Controller
{

    public function index()
    {
        $user = new User;
        $data['errors'] = [];
        $data['title'] = "Forgot";

        $data['rows']=[];
        $rows = array();
        $rows=$user->where(['id' => $_GET['data']]);
        $data['rows']=$rows[0];

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if (empty($_POST['password'])) {
                message("Password is required.");
            } elseif (strlen($_POST['password']) < 8) {
                message("Password must be at least 8 characters long.");
            } elseif ($_POST['password'] == $_POST['repassword']) {
                $_POST["password"] = password_hash($_POST['password'],PASSWORD_DEFAULT);
               $user->update($_GET['data'],$_POST);
               message("Your password is change. please login");
                redirect('Login/');
            }else{
                
                message("Passwords do not match.");
            }
        }
        $this->view('forgot_password1', $data);
    }
}
<?php

class Forgot_password extends Controller
{

    public function index()
    {
        $data['errors'] = [];
        $data['title'] = "Forgot";

        $user = new User();
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            if($user->where(['email' => $_POST['email'],'phone' => $_POST['phone']])){
                $arr = [];
                $arr=$user->where(['email' => $_POST['email'],'phone' => $_POST['phone']]);
                redirect('Forgot_password1/.php?data='.$arr[0]->id);
            }else{
                message("Email and phone number doesn't match");
            }
        }
        $this->view('forgot_password', $data);
    }
}
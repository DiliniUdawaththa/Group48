<?php

class Login extends Controller
{

    public function index()
    {
        $data['errors'] = [];
        $data['title'] = "Login";
        $user = new User();
        if($_SERVER['REQUEST_METHOD'] == "POST")
		{
            //validate
            $row = $user->first([
                "email"=> $_POST["email"],
            ]);
            //   show($row);die;
            if($row){
                  
                  if(password_verify( $_POST['password'],$row->password))
                  {
                    //authenticate
                    Auth::authenticate($row);
                    redirect('home');
                  }
            }
            $data['errors']['email'] = "wrong email or password";
        }
        $this->view('login', $data);
    }
}
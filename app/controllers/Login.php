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
                    if(Auth::is_admin())
                    {
                        redirect('admin/dashboard'); 
                    }
                    else if(Auth::is_officer())
                    {
                        redirect('officer/dashboard');
                    }
                    else if(Auth::is_driver())
                    {
                        $driverreg = new Driverregistration();
                        $row1 = $driverreg->where([
                            "email"=> $_POST["email"],
                        ]);
                        if(!isset($row1[0])){
                            redirect('driver/registration');
                        }else{
                            redirect('driver/ride');
                        }

                        
                    }
                    else{
                        redirect('customer/ride');
                    }
                  }
            }
            $data['errors']['email'] = "wrong email or password";
        }
        $this->view('login', $data);
    }
}
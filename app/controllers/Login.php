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
                            "id"=> $_POST["id"],
                        ]);
                        if(!isset($row1[0])){

                            $registrationitems = array (
                                'profileimg' => '0',
                                'driverlicenseimg' => '0',
                                'revenuelicenseimg' => '0',
                                'vehregistrationimg' => '0',
                                'vehinsuranceimg' => '0',
                            );
                
                            $_SESSION['REGISITEMS'] = $registrationitems;
                            redirect('driver/registration');
                        }else{
                            $driver = new User();
                            if($driver->isExpired($_POST["email"]))
                            {
                                redirect('driver/expire');
                            }else{
                                redirect('driver/ride');
                            }                           
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
<?php
 class Driver extends Controller{
    public function index(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];
        
       
        $data['vehicles'] = 0;
        $data['vehicledata'] = [];

        $driverreg = new Driverregistration();

        $row1 = $driverreg->where([
            "email"=> $_SESSION['USER_DATA']->email,
        ]);
        if(!isset($row1[0])){
            redirect('driver/registration');
        }
        

        $vehicle = new Vehicle();
        $owner = $_SESSION['USER_DATA']->email;
        // show($_SESSION['USER_DATA']->email);

        $row = $vehicle->where([
            "owner"=> $owner,
        ]);
        if(empty($row)){
            $data['vehicles'] = 0;
        }else{
            $data['vehicles'] = 1;
            $data['vehicledata'] = $row[0];
        }
        
        
        // show($row[0]);
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if(isset($row[0])){
                if(isset($_POST['delete'])){
                    $record = (array)$row[0];
                    $vehicle->delete($record);
                    redirect('driver/ride');
                }

                if(isset($_POST['save'])){
                    $data['newrecord'] = $row[0];
                    $data['newrecord']->owner = $_SESSION['USER_DATA']->email;
                    $data['newrecord']->licenseplate = $_POST['newlicenseplate'];
                    $data['newrecord']->type = $_POST['newtype'];
                    $data['newrecord']->color = $_POST['newcolor'];
                }
            }
            
            
            $_POST['owner'] = $_SESSION['USER_DATA']->email;
            
            // show($_POST);
            if($vehicle->validate($_POST)){
                
                // show($_POST);
                $vehicle->insert($_POST);
                redirect('driver/ride');
            }
        }

            

        $data['title'] = "Driver";
        $this->view('driver/ride',$data);
        
    }

    public function registration(){
        $data['errors'] = [];

        $driverreg = new Driverregistration();

        $row1 = $driverreg->where([
            "email"=> $_SESSION['USER_DATA']->email,
        ]);
        if(isset($row1[0])){
            redirect('driver/ride');
        }

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset($_POST['registration'])){
                    $Registerdata['email'] = $_SESSION['USER_DATA']->email;
                    $Registerdata['status'] = 1;
                    $driverreg->insert($Registerdata);
                    redirect('driver/ride');
                }

            }
            $this->view('driver/registration/registration',$data);
        
    }

    public function driverLicense(){
        $data['errors'] = [];

        $driverreg = new Driverregistration();

            $this->view('driver/registration/driverLicense',$data);
        
    }

    public function profilePicture(){
        $data['errors'] = [];

        $driverreg = new Driverregistration();

            $this->view('driver/registration/profilePicture',$data);
        
    }

    public function revenueLicense(){
        $data['errors'] = [];

        $driverreg = new Driverregistration();

            $this->view('driver/registration/revenueLicense',$data);
        
    }

    public function vehicleInsurance(){
        $data['errors'] = [];

        $driverreg = new Driverregistration();

            $this->view('driver/registration/vehicleInsurance',$data);
        
    }

    public function vehicleRegistration(){
        $data['errors'] = [];

        $driverreg = new Driverregistration();

            $this->view('driver/registration/vehicleRegistration',$data);
        
    }
 }
 //echo " sample home page";
 ?>
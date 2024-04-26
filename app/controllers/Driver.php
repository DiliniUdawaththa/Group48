<?php
require_once __DIR__ . '/../configs/config.php';

class Driver extends Controller{
    public function index(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];
        
       


        $driverreg = new Driverregistration();

        $row1 = $driverreg->where([
            "email"=> $_SESSION['USER_DATA']->email,
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

        }
        

        
        
        
       
        
       
        

            

        $data['title'] = "Driver";
        $this->view('driver/ride',$data);
         
        
    }
    public function activity(){
        $data['errors'] = [];

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
        

        $current_rides = new Current_rides();
        
        $currides = $current_rides ->findAll();
        
        $data['current_rides'] = $currides;


        $this->view('driver/activity',$data);
    }

    public function analytics(){
        $data['errors'] = [];

        $this -> view('driver/analytics',$data);
    }

    public function vehicles(){
        $data['errors'] = [];

        $data['vehicles'] = 0;
        $data['vehicledata'] = [];

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
                    redirect('driver/vehicles');
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
                redirect('driver/vehicles');
            }
        }


        $this ->view('driver/vehicles',$data);
    }

    public function request($id = null, $passenger_id = null){
        $data['error'] = [];
        $data['ids'] = $passenger_id;
        $_SESSION['ride_id'] = $id;
        $_SESSION['pass_id'] = $passenger_id;
        $cust = new User();

        $current_rides = new Current_rides();
        $row3 = $current_rides->first([
            "id"=> $id,
        ]);

        $data['ride_info'] = $row3;

        $row4 = $cust->first([
            "id"=> $passenger_id,
        ]);
        $data['customer'] = $row4;

        $offers = new Offers();

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            show($_SESSION);
            $_POST['driver_id'] = $_SESSION['USER_DATA']->id;
            $_POST['ride_id'] = $id;
            show($_POST);

            if(isset($_POST['offer_price'])){
                $row2 = $offers->where([
                    'driver_id' => $_SESSION['USER_DATA']->id,
                ]);
                if(isset($row2)){
                    foreach($row2 as $row1){
                        $record = (array)$row1;
                        $offers->delete($record);
                    }
                }
                $offers->insert($_POST);
                redirect('driver/request02');
                
                
                
                
            }

        }



        $this-> view('driver/request',$data);
        
    }

    public function request02(){
        $data['errors'] = [];

        $cust = new User();

        $row4 = $cust->first([
            "id"=> $_SESSION['pass_id'],
        ]);
        $data['customer'] = $row4;

        $current_rides = new Current_rides();
        $row3 = $current_rides->first([
            "id"=> $_SESSION['ride_id'],
        ]);

        $data['ride_info'] = $row3;

        $this->view('driver/request02',$data);
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
                    $Registerdata['profileimg'] = $_SESSION['REGISITEMS']['profileimg'];
                    $Registerdata['driverlicenseimg'] =  $_SESSION['REGISITEMS']['driverlicenseimg'];
                    $Registerdata['revenuelicenseimg'] =  $_SESSION['REGISITEMS']['revenuelicenseimg'];
                    $Registerdata['vehregistrationimg'] =  $_SESSION['REGISITEMS']['vehregistrationimg'];
                    $Registerdata['vehinsuranceimg'] =  $_SESSION['REGISITEMS']['vehinsuranceimg'];
                    $Registerdata['status'] = 1;
                    $driverreg->insert($Registerdata);
                    redirect('driver/ride');
                }

            }
            $this->view('driver/registration/registration',$data);
            show([$_SESSION]);
            
    }

    
    public function driverLicense(){
        $data['errors'] = [];

        $driverreg = new Driverregistration();

            
            if($_SERVER['REQUEST_METHOD'] == "POST"){

                $folder = "uploads/images/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                    file_put_contents($folder.'index.php', "<?php //Silence");
                    file_put_contents('uploads/index.php', "<?php //Silence");
                }

                if(isset($_POST['done'])){
                    $allowed = ['image/jpeg','image/png','image/jpg'];
                    if(!empty($_FILES['photoInput']['name'])){
                        if($_FILES['photoInput']['error'] == 0){
                            if(in_array($_FILES['photoInput']['type'],$allowed)){
                                $destination = $folder.time().$_FILES['photoInput']['name'];
                                move_uploaded_file($_FILES['photoInput']['tmp_name'],$destination);
                                show($_FILES['photoInput']);
                                $_SESSION['REGISITEMS']['driverlicenseimg']=$destination;
                                $_POST['image'] = $destination;
                                $data['errors']= [];
                                redirect('driver/registration');
                                
                            }
                            else {
                                $data['errors'][0] = "File should be a png,jpeg or jpg";
                                
                            }
                        }
                    }
                    else{
                        $data['errors'][0] = "Upload an image";
                    }
                    // echo $data['errors'][0];
                    // show($_FILES['photoInput']); //name of the input
                    // redirect('driver/registration');
                }
                
            }
        $this->view('driver/registration/driverLicense',$data);
    }

    public function profilePicture(){
        $data['errors'] = [];

        $driverreg = new Driverregistration();

        
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $folder = "uploads/images/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
                file_put_contents($folder.'index.php', "<?php //Silence");
                file_put_contents('uploads/index.php', "<?php //Silence");
            }

            if(isset($_POST['done'])){
                $allowed = ['image/jpeg','image/png','image/jpg'];
                if(!empty($_FILES['photoInput']['name'])){
                    if($_FILES['photoInput']['error'] == 0){
                        if(in_array($_FILES['photoInput']['type'],$allowed)){
                            $destination = $folder.time().$_FILES['photoInput']['name'];
                            move_uploaded_file($_FILES['photoInput']['tmp_name'],$destination);
                            show($_FILES['photoInput']);
                            $_SESSION['REGISITEMS']['profileimg']=$destination;
                            $_POST['image'] = $destination;
                            $data['errors']= [];
                            redirect('driver/registration');
                            
                        }
                        else {
                            $data['errors'][0] = "File should be a png,jpeg or jpg";
                            
                        }
                    }
                }
                else{
                    $data['errors'][0] = "Upload an image";
                }
                // echo $data['errors'][0];
                // show($_FILES['photoInput']); //name of the input
                // redirect('driver/registration');
            }
            
        }


            $this->view('driver/registration/profilePicture',$data);
        
    }

    public function revenueLicense(){
        $data['errors'] = [];

        $driverreg = new Driverregistration();

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $folder = "uploads/images/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
                file_put_contents($folder.'index.php', "<?php //Silence");
                file_put_contents('uploads/index.php', "<?php //Silence");
            }

            if(isset($_POST['done'])){
                $allowed = ['image/jpeg','image/png','image/jpg'];
                if(!empty($_FILES['photoInput']['name'])){
                    if($_FILES['photoInput']['error'] == 0){
                        if(in_array($_FILES['photoInput']['type'],$allowed)){
                            $destination = $folder.time().$_FILES['photoInput']['name'];
                            move_uploaded_file($_FILES['photoInput']['tmp_name'],$destination);
                            show($_FILES['photoInput']);
                            $_SESSION['REGISITEMS']['revenuelicenseimg']=$destination;
                            $_POST['image'] = $destination;
                            $data['errors']= [];
                            redirect('driver/registration');
                            
                        }
                        else {
                            $data['errors'][0] = "File should be a png,jpeg or jpg";
                            
                        }
                    }
                }
                else{
                    $data['errors'][0] = "Upload an image";
                }
                // echo $data['errors'][0];
                // show($_FILES['photoInput']); //name of the input
                // redirect('driver/registration');
            }
            
        }

            $this->view('driver/registration/revenueLicense',$data);
        
    }

    public function vehicleInsurance(){
        $data['errors'] = [];

        $driverreg = new Driverregistration();

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $folder = "uploads/images/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
                file_put_contents($folder.'index.php', "<?php //Silence");
                file_put_contents('uploads/index.php', "<?php //Silence");
            }

            if(isset($_POST['done'])){
                $allowed = ['image/jpeg','image/png','image/jpg'];
                if(!empty($_FILES['photoInput']['name'])){
                    if($_FILES['photoInput']['error'] == 0){
                        if(in_array($_FILES['photoInput']['type'],$allowed)){
                            $destination = $folder.time().$_FILES['photoInput']['name'];
                            move_uploaded_file($_FILES['photoInput']['tmp_name'],$destination);
                            show($_FILES['photoInput']);
                            $_SESSION['REGISITEMS']['vehinsuranceimg']=$destination;
                            $_POST['image'] = $destination;
                            $data['errors']= [];
                            redirect('driver/registration');
                            
                        }
                        else {
                            $data['errors'][0] = "File should be a png,jpeg or jpg";
                            
                        }
                    }
                }
                else{
                    $data['errors'][0] = "Upload an image";
                }
                // echo $data['errors'][0];
                // show($_FILES['photoInput']); //name of the input
                // redirect('driver/registration');
            }
            
        }

            $this->view('driver/registration/vehicleInsurance',$data);
        
    }

    public function vehicleRegistration(){
        $data['errors'] = [];

        $driverreg = new Driverregistration();

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $folder = "uploads/images/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
                file_put_contents($folder.'index.php', "<?php //Silence");
                file_put_contents('uploads/index.php', "<?php //Silence");
            }

            if(isset($_POST['done'])){
                $allowed = ['image/jpeg','image/png','image/jpg'];
                if(!empty($_FILES['photoInput']['name'])){
                    if($_FILES['photoInput']['error'] == 0){
                        if(in_array($_FILES['photoInput']['type'],$allowed)){
                            $destination = $folder.time().$_FILES['photoInput']['name'];
                            move_uploaded_file($_FILES['photoInput']['tmp_name'],$destination);
                            show($_FILES['photoInput']);
                            $_SESSION['REGISITEMS']['vehregistrationimg']=$destination;
                            $_POST['image'] = $destination;
                            $data['errors']= [];
                            redirect('driver/registration');
                            
                        }
                        else {
                            $data['errors'][0] = "File should be a png,jpeg or jpg";
                            
                        }
                    }
                }
                else{
                    $data['errors'][0] = "Upload an image";
                }
                // echo $data['errors'][0];
                // show($_FILES['photoInput']); //name of the input
                // redirect('driver/registration');
            }
            
        }

            $this->view('driver/registration/vehicleRegistration',$data);
        
    }

    public function renewHelp(){
        $this->view('driver/renewRegistration/help');
    }

    public function expire(){
        $this->view('driver/renewRegistration/expireform');
    }

    public function renew1(){
        $this->view('driver/renewRegistration/renewStep1');
    }

    public function renew2(){
        $this->view('driver/renewRegistration/renew_form');
    }

    public function renew3(){
        $this->view('driver/renewRegistration/renewStep3');
    }

    public function renew_insert(){
        $data['errors'] = [];
        $renew_driver = new renewRegistration($GLOBALS['pdo']);
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
                // $_POST['email'] =$renew_driver->email;
                // $_POST['name'] =$renew_driver->name;
                $_POST['email'] = $_POST['email'];
                $_POST['name'] = $_POST['name'];
                $_POST['status'] = 0;

                $file_name = $_FILES['pdf_file']['name'];
                $file_tmp = $_FILES['pdf_file']['tmp_name'];
                $file_type = $_FILES['pdf_file']['type'];
                $file_size = $_FILES['pdf_file']['size'];

                $mail = $_POST['email'];
                $upload_directory = "./assets/documents/paymentSlips/$mail";
                $upload_path = $upload_directory . $file_name;
                move_uploaded_file($file_tmp, $upload_path);

                $renew_driver->insert($_POST);
                redirect('driver/renew3');
        }
    }

    public function downloadSlip() {
        // Set the file path
        $pdfFilePath = "./assets/documents/paymentSlip.pdf";

        // Check if file exists
        if (file_exists($pdfFilePath)) {
            // Set headers for force download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($pdfFilePath) . '"');
            header('Content-Length: ' . filesize($pdfFilePath));

            // Read the file and output it to the browser
            readfile($pdfFilePath);

            // Terminate script after file download
            exit;
        } else {
            // Handle file not found error
            die('File not found.');
        }
    }

 }
 //echo " sample home page";
 ?>
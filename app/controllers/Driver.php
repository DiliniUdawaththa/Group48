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
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset($_POST['done'])){
                    $allowed = ['image/jpeg','image/png','image/jpg'];
                    if(!empty($_FILES['photoInput']['name'])){
                        if($_FILES['photoInput']['error'] == 0){
                            if(in_array($_FILES['photoInput']['type'],$allowed)){
                                move_uploaded_file($_FILES['photoInput']['tmp_name'],$destination);
                            }
                            else {
                                echo "wrong type";
                            }
                        }
                    }
                    show($_FILES['photoInput']);die; //name of the input
                    // redirect('driver/registration');
                }
                // echo $_POST['photoInput'];
            }
        
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
        $renew_driver = new renewRegistration();
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
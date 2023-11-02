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
 }
 //echo " sample home page";
 ?>
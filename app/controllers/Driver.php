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

        $data['registration-expire'] = 0;

        
       $user_rating = new Rating();
       $all_rates = $user_rating -> where([
        'role_id' => $_SESSION['USER_DATA']->id,
       ]);

       $total_rating = 0;
       if(isset($all_rates[0])){
         foreach($all_rates as $rate){
            $total_rating = $total_rating + $rate->rate;
            }
            $_SESSION['rating'] = 'rating' . ($total_rating / count($all_rates));
            if(($total_rating / count($all_rates)) == 0){
                $_SESSION['rating'] = 'rating1';
            }
       }else{
        $_SESSION['rating'] = 'rating3';
       }


        $driverreg = new Driverregistration();

        $row1 = $driverreg->where([
            "id"=> $_SESSION['USER_DATA']->id,
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
            sleep(2);
            

            redirect('driver/registration');

        }

        
        $user = new User();
        $row1[0] -> date;
        $dateFromRow = new DateTime($row1[0]->date);

        // Get today's date
        $todayDate = new DateTime();
        $dayDifference = $todayDate->diff($dateFromRow)->days;
        $data['dayDifference'] = $dayDifference;
        if($dayDifference > 365){
            $_SESSION['registration-expire'] = 1;
        }else{
            $_SESSION['registration-expire'] = 0;
        }
        
        $data['emailValidation'] = " ";
        $data['phoneValidation'] = " ";
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $update_flag = 0;
            
            $folder = "uploads/images/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                    file_put_contents($folder.'index.php', "<?php //Silence");
                    file_put_contents('uploads/index.php', "<?php //Silence");
                }

                if(isset($_POST['update-pic'])){
                    
                    $allowed = ['image/jpeg','image/png','image/jpg'];
                    if(!empty($_FILES['photoInput']['name'])){
                        if($_FILES['photoInput']['error'] == 0){
                            if(in_array($_FILES['photoInput']['type'],$allowed)){
                                $destination = $folder.time().$_FILES['photoInput']['name'];
                                move_uploaded_file($_FILES['photoInput']['tmp_name'],$destination);
                                $_SESSION['USER_DATA']->img_path =$destination;
                                $update_flag = 1;
                                
                                
                                
                                
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

                if(isset($_POST['update-email'])){
                    if (filter_var($_POST['new-email'], FILTER_VALIDATE_EMAIL)) {
                        $row20 = $user->first([
                            'email' => $_POST['new-email'],
                        ]);
                        if(empty($row20)){
                            $_SESSION['USER_DATA'] ->email = $_POST['new-email'];
                            $update_flag = 1;
                        }
                            else{
                                $data['emailValidation'] = "Email already exists";
                            }
                    }else{
                        $data['emailValidation'] = "Invalid email type";
                    }
                        
                      
                }
                if(isset($_POST['update-phone'])){
                    if(strlen($_POST['new-phone'])==10){
                        $row20 = $user->first([
                            'phone' => $_POST['new-phone'],
                        ]);
                        if(empty($row20)){
                            $_SESSION['USER_DATA'] ->phone = $_POST['new-phone'];
                            $update_flag = 1;
                        }else{
                            $data['phoneValidation'] = "Phone number already exists";
                        }
                        
                    }else{
                        $data['phoneValidation'] = "Phone number should consists 10 digits";
                    }
                }

                if($update_flag == 1){
                    $user->update($_SESSION['USER_DATA']->id,(array)$_SESSION['USER_DATA']);
                }

            
        }
        
       
        $data['title'] = "Driver";
        $this->view('driver/ride',$data);
         
        
    }
    public function activity(){
        $data['errors'] = [];
        $data['suspended_status'] = 0;
        $user_rating = new Rating();
        $all_rates = $user_rating -> where([
        'role_id' => $_SESSION['USER_DATA']->id,
       ]);

       $total_rating = 0;
       if(isset($all_rates[0])){
         foreach($all_rates as $rate){
            $total_rating = $total_rating + $rate->rate;
            }
            $_SESSION['rating'] = 'rating' . ($total_rating / count($all_rates));
            if(($total_rating / count($all_rates)) == 0){
                $_SESSION['rating'] = 'rating1';
            }
       }else{
        $_SESSION['rating'] = 'rating3';
       }

        $vehicle = new Vehicle();
        $owner = $_SESSION['USER_DATA']->id;
        // show($_SESSION['USER_DATA']->email);

        $row = $vehicle->where([
            "owner"=> $owner,
        ]);
        if(empty($row)){
            $data['vehicles'] = 0;
            $vehicle_type = 'auto';
        }else{
            $data['vehicles'] = 1;
            $data['vehicledata'] = $row[0];
            $vehicle_type = $row[0]->type;
            if($vehicle_type=="threewheel"){
                $vehicle_type="auto";
            }
        }
        $user = new User();
        $current_rides = new Current_rides();
        $user_rating = new Rating();
        $currides = $current_rides ->findAll();
        $count_currides = 0;
        if(isset($currides[0])){
            $count_currides = count($currides);
        }

        if($count_currides > 0) {
            foreach ($currides as &$ride) {
                    $row = $user -> first([
                        'id' => $ride->passenger_id,
                    ]);

                    $all_rates = $user_rating -> where([
                    'role_id' => $ride->passenger_id,
                    ]);
            
                   $total_rating = 0;
                   if(isset($all_rates[0])){
                     foreach($all_rates as $rate){
                        $total_rating = $total_rating + $rate->rate;
                        }
                        $ride->rating = 'rating' . ($total_rating / count($all_rates));
                        if(($total_rating / count($all_rates)) == 0){
                            $ride->rating = 'rating1';
                        }
                   }else{
                    $ride->rating = 'rating3';
                   }

                   
                
                if($row){
                    $img_path = $row->img_path;
                    $ride->img_path = $img_path;
                }else{
                    $ride->img_path = 'person.jpg';
                }
                
            }
            unset($ride); // Unset the reference to the last element to avoid unexpected behavior
        }
        
        $data['current_rides'] = $currides;
        $data['status'] = 0;

        $driverst = new Driver_status();
        

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if(isset($_POST['driver_loc'])){
                if($_POST['driver-status']=='active'){
                    $_SESSION['active-status']= 1;
                    $row5 = $driverst-> where([
                        "driver_id" => $_SESSION['USER_DATA']->id,
                    ]);
                    if(!isset($row5[0])){
                        $_POST['driver_id'] = $_SESSION['USER_DATA'] -> id;
                        $_POST['vehicle'] = $vehicle_type;
                        $_POST['lng'] = (float)$_POST['longitude'];
                        $_POST['lat'] = (float)$_POST['latitude'];
                        $_POST['status']= 1;
                        $driverst -> insert($_POST);
                    }
                }
                elseif($_POST['driver-status']=='inactive'){
                    $_SESSION['active-status']= 0;
                    $row4 = $driverst-> where([
                        "driver_id" => $_SESSION['USER_DATA']->id,
                    ]);
                    if(isset($row4[0])){
                        $data1 = (array)$row4[0];
                        $id = array();
                        $id['driver_id'] = $row4[0]->driver_id;
                        $driverst -> delete($id);
                    }

                }
                    
                

            }
        }

            $this->view('driver/activity',$data);
        
            
        


       
    }

   

    public function analytics(){
        $data['errors'] = [];
        $dateTime = new DateTime();
        $data['total_earned'] = 0;
        $data['total_rides'] = 0;
        $data['total_distance'] = 0;

        $driver_status = new Driver_status();

        $rides = new Rides();
        $allRides = $rides->where([
            'driver_id' => $_SESSION['USER_DATA']->id,
        ]);

        $array = array();
        for ($i = 0; $i < 4; $i++) {
            $allRides1 = $rides->where([
                'driver_id' => $_SESSION['USER_DATA']->id,
                'date' => date('Y-m-d', strtotime('-'.$i.' day')),
            ]);
            if(!empty($allRides1)){
                $array[$i] = count($allRides1);
            }else{
                $array[$i] = 0;
            }
            
        }
        $data['history-count'] = $array;


        $data['current_rides'] = $allRides;
        if(isset($allRides[0])){
            foreach ($allRides as $ride) {
                $data['total_earned'] += $ride->fare;
                $data['total_rides'] += 1;
                $data['total_distance'] += $ride->distance;
                $ride->date = $dateTime->format('Y-m-d');
            }

        }
        

        $this -> view('driver/analytics',$data);
    }

    public function vehicles(){
        $data['errors'] = [];

        $data['vehicles'] = 0;
        $data['vehicledata'] = [];
        $data['vehicleError'] = " ";

        $vehicle = new Vehicle();
        $owner = $_SESSION['USER_DATA']->id;
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
        $_POST['owner'] = $_SESSION['USER_DATA']->id;

         // show($row[0]);
         if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(isset($_POST['add-vehicle'])){
                

                if($vehicle->validate($_POST)){
            
                    show($_POST);
                    $vehicle->insert($_POST);
                    redirect('driver/vehicles');
                }else{
                    $data['vehicleError'] = "The numberplate is invalid or already exists";
                }
            }


            if(isset($row[0])){
                
                if(isset($_POST['delete'])){
                    $record = (array)$row[0];
                    $vehicle->delete($record);
                    redirect('driver/vehicles');
                }

                if(isset($_POST['save'])){
                    $data['newrecord'] = $row[0];
                    $data['newrecord']->owner = $_SESSION['USER_DATA']->id;
                    $data['newrecord']->licenseplate = $_POST['newlicenseplate'];
                    $data['newrecord']->type = $_POST['newtype'];
                    $data['newrecord']->color = $_POST['newcolor'];

                    
                }
            }
            
            
            
            
            // show($_POST);
            
        }


        $this ->view('driver/vehicles',$data);
    }

    public function request($id = null, $passenger_id = null){
        $data['error'] = [];
        $data['ids'] = $passenger_id;
        $_SESSION['ride_id'] = $id;
        $_SESSION['pass_id'] = $passenger_id;
        $cust = new User();
        $data['standard_fare'] = 100;

        $current_rides = new Current_rides();
        $row3 = $current_rides->first([
            "id"=> $id,
        ]);
        
        $vehicle = new Vehicle();


        $driver_veh = $vehicle -> first_veh([
            'owner' => $_SESSION['USER_DATA']->id,
        ]);

        $std_fare = new Standardfare();

        if($driver_veh-> type == "threewheel"){
            $std_fare1 = $std_fare -> where([
                'vehicletype' => "Three-Wheel", //standard fare table name
            ]);
            if(isset($std_fare1[0])){
                $data['standard_fare'] = $std_fare1[0]->fare;
            }
            
        }elseif($driver_veh-> type == "bike"){
            $std_fare1 = $std_fare -> where([
                'vehicletype' => "Bike",
            ]);
            if(isset($std_fare1[0])){
                $data['standard_fare'] = $std_fare1[0]->fare;
            }
        }elseif($driver_veh-> type == "car"){
            $std_fare1 = $std_fare -> where([
                'vehicletype' => "Car",
            ]);
            if(isset($std_fare1[0])){
                $data['standard_fare'] = $std_fare1[0]->fare;
            }
        }elseif($driver_veh-> type == "Ac-car"){
            $std_fare1 = $std_fare -> where([
                'vehicletype' => "AC-Car",
            ]);
            if(isset($std_fare1[0])){
                $data['standard_fare'] = $std_fare1[0]->fare;
            }
        }
        



        $data['ride_info'] = $row3;

        $row4 = $cust->first([
            "id"=> $passenger_id,
        ]);
        $data['customer'] = $row4;

        $offers = new Offers();

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            // show($_SESSION);
            $_POST['driver_id'] = $_SESSION['USER_DATA']->id;
            $_POST['ride_id'] = $id;
            // show($_POST);

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
        $data['negotiation_sent'] = 0;
        $cust = new User();
        $offers = new Offers();

        $current_offer = $offers->where([
            'ride_id' => $_SESSION['ride_id'],
        ]);


        $data['offer_price'] = $current_offer[0]->offer_price;
        $data['negotiation_price'] = $current_offer[0]->negotiation_price;

        
        

        $row4 = $cust->first([
            "id"=> $_SESSION['pass_id'],
        ]);
        $data['customer'] = $row4;

        $current_rides = new Current_rides();
        $row3 = $current_rides->first([
            "id"=> $_SESSION['ride_id'],
        ]);

    //    show($current_offer);

        $data['ride_info'] = $row3;

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(isset($_POST["accept-neg"])){
                $current_offer[0]->offer_price = $current_offer[0]->negotiation_price;
                $current_offer[0]->negotiation_status = 0;
                $offers->update_offer_price($_SESSION['ride_id'],$_SESSION['USER_DATA']->id,(array)$current_offer[0]);
                redirect('driver/request02');
            }
            elseif(isset($_POST['decline-neg'])){
                $current_offer[0]->negotiation_status = 0;
                $offers->update_offer_price($_SESSION['ride_id'],$_SESSION['USER_DATA']->id,(array)$current_offer[0]);
                redirect('driver/request02');
            }

            elseif(isset($_POST['cancel-offer'])){
                $offers -> delete((array)$current_offer[0]);
                redirect('driver/activity');
            }


            

                
                $current_offer = $offers->where([
                    'ride_id' => $_SESSION['ride_id'],
                ]);

                if($current_offer[0]->accept_status == 1){
                    echo "Accepted";
                }elseif($current_offer[0]->offer_price != $current_offer[0]->negotiation_price){
                    if($current_offer[0]->negotiation_status==1){
                        $output = (string)$current_offer[0]->negotiation_price;
                        echo $output;
                    }else{
                        echo "Waiting";
                    }

                }else{
                    echo "Waiting";
                }
            
            
            



        }else{

            if($current_offer[0]->accept_status == 1){
                redirect(redirect('driver/request03'));
                show($current_offer[0]);
            }
    
            if($current_offer[0]->offer_price != $current_offer[0]->negotiation_price){
                if($current_offer[0]->negotiation_status==1){
                    $data['negotiation_sent'] = 1;
                }
            }

            $this->view('driver/request02',$data);
            // show($_POST);
        }

       
    }

    public function request03(){
        $data['errors'] = [];

        $cust = new User();
        $ride = new Rides();
        $current_rides = new Current_rides();

        //Information of the current ride stored in $row3
        $row3 = $current_rides->first([
            "id"=> $_SESSION['ride_id'],
        ]);

        $data['ride_info'] = $row3;

        $current_ride = $ride->first([
            "id" => $_SESSION['ride_id'],
        ]);

        $row4 = $cust->first([
            "id"=> $_SESSION['pass_id'],
        ]);
        $data['customer'] = $row4;
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(isset($_POST['start-ride'])){
                $current_ride->ride_start = 1;
                $ride -> update($_SESSION['ride_id'], (array)$current_ride);
                redirect('driver/request04');
                

            }
            elseif(isset($_POST['cancel-s-ride'])){
                $current_ride->state="cancel";
                $ride -> update($_SESSION['ride_id'], (array)$current_ride);
                redirect('driver/activity');
            }
            else{
                if($current_ride->state=="cancel"){
                    echo "customer-cancel";
                }else{
                    echo "Waiting";
                }

            }
            
            
            
        }else{
            $this->view('driver/request03',$data);

        }
        

        
    }

    public function request04(){
        $data['errors'] = [];

        $cust = new User();
        $ride = new Rides();
        $current_ride = $ride->first([
            'id' => $_SESSION['ride_id'],
        ]);

        $row4 = $cust->first([
            "id"=> $_SESSION['pass_id'],
        ]);
        $data['customer'] = $row4;

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(isset($_POST['end-ride'])){
                $current_ride->state = 'Success';
                $ride -> update($_SESSION['ride_id'], (array)$current_ride);
                redirect('driver/request05');
            }

        }
        

        $this->view('driver/request04',$data);
    }

    public function request05(){
        $data['errors'] = [];
        $complain_status = 0;
        $complain = NULL;
        $cust = new User();
        $complaint = new Complaint();
        $rating = new Rating();

        $row4 = $cust->first([
            "id"=> $_SESSION['pass_id'],
        ]);
        $data['customer'] = $row4;
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            // show([$_POST]);
            for ($i = 1; $i <= 8; $i++) {    
                $reportName = 'report' . $i;
                if (isset($_POST[$reportName])) {
                    $complain_status = 1;
                    $complain = $complain . ucfirst($_POST[$reportName]) . '. ';
                } 
            }
            if(isset($_POST['other'])){
                if($_POST['other']!= NULL){
                    $complain_status = 1;
                    $complain = $complain . ucfirst($_POST['other']);
                }
                
            }

            if($_POST['star'] >0){
                
                $_POST['ride_id'] = $_SESSION['ride_id'];
                $_POST['role_id'] = $_SESSION['pass_id'];
                $_POST['role'] = "customer";
                $_POST['rate'] = $_POST['star'];
                show($_POST);
                $rating->insert($_POST);

            }

            if($complain_status==1){
                $_POST['complainant'] = "Driver";
                $_POST['passenger_id'] =$_SESSION['pass_id'];
                $_POST['driver_id'] = $_SESSION['USER_DATA'] -> id;
                $_POST['datetime'] = date('Y-m-d H:i:s');
                $_POST['complaint'] = $complain;
                $complaint->insert($_POST);
            }

            redirect('driver/activity');
            
        }

        $this->view('driver/request05',$data);

    }

    public function registration(){
        $data['errors'] = [];
        $data['regiserror'] = " ";
        $driverreg = new Driverregistration();
        $user = new User();

        $row1 = $driverreg->where([
            "id"=> $_SESSION['USER_DATA']->id,
        ]);

        
        

        if(isset($row1[0])){
            redirect('driver/ride');
        }

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset($_POST['registration'])){
                    if($_SESSION['REGISITEMS']['profileimg'] == '0'){
                        $data['regiserror'] = "Please upload all the files to proceed";
                    }elseif($_SESSION['REGISITEMS']['driverlicenseimg'] == '0'){
                        $data['regiserror'] = "Please upload all the files to proceed";
                    }
                    elseif($_SESSION['REGISITEMS']['revenuelicenseimg'] == '0'){
                        $data['regiserror'] = "Please upload all the files to proceed";
                    }
                    elseif($_SESSION['REGISITEMS']['vehregistrationimg'] == '0'){
                        $data['regiserror'] = "Please upload all the files to proceed";
                    }
                    elseif($_SESSION['REGISITEMS']['vehinsuranceimg'] == '0'){
                        $data['regiserror'] = "Please upload all the files to proceed";
                    }else{
        
                    $Registerdata['id'] = $_SESSION['USER_DATA']->id;
                    $Registerdata['date'] = date('Y-m-d');
                    $Registerdata['profileimg'] = $_SESSION['REGISITEMS']['profileimg'];
                    $Registerdata['driverlicenseimg'] =  $_SESSION['REGISITEMS']['driverlicenseimg'];
                    $Registerdata['revenuelicenseimg'] =  $_SESSION['REGISITEMS']['revenuelicenseimg'];
                    $Registerdata['vehregistrationimg'] =  $_SESSION['REGISITEMS']['vehregistrationimg'];
                    $Registerdata['vehinsuranceimg'] =  $_SESSION['REGISITEMS']['vehinsuranceimg'];
                    $Registerdata['status'] = 0;
                    $_SESSION['USER_DATA'] -> img_path = $_SESSION['REGISITEMS']['profileimg'];
                    $user->update($_SESSION['USER_DATA']->id,(array)$_SESSION['USER_DATA']);
                    $driverreg->insert($Registerdata);
                    redirect('driver/ride');
                    }
                }

            }
            $this->view('driver/registration/registration',$data);
            
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
                                // show($_FILES['photoInput']);
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
        $renew_driver1 = new AdminDriver();
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if($renew_driver1->validateRenew($_POST)){
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
        $data['errors'] = $renew_driver1->errors;
        $data['title'] = "Officer";
        $this->view('driver/renewRegistration/renew_form',$data);
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
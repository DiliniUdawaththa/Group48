<?php
 class Customer extends Controller{
    // public function index(){
    //     if(!Auth::logged_in())
    //     {
    //         message('please login to view the page');
    //         redirect("login");
    //     }
    //     $data['title'] = "Ride";
    //     $this->view('customer/ride_step1',$data);
    // }

    // step1 stage-----------------------------------------------------------------------------------------------------------------
    public function index(){
        if(!Auth::logged_in() )
        {
            message('please login to view the page');
            redirect('login');
        }
        else if($_SESSION['USER_DATA']->role!=='user'){
            message('please login to view the page');
            redirect('login');
        }
        $add_place = new Add_Place();
        $user = new User();
        $rating = new Rating();

        $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
        $sum = 0;

        if (is_array($rate) && count($rate) > 0) {
            foreach ($rate as $r) {
                $sum += $r->rate;
            }
            $data['rating'] = round($sum / count($rate));
        } else {
            $data['rating'] = 3;
        }
                
        // show($data);
        // $data['rating'] = $img[0];
        // show($data);

        $rows = $add_place->findAll();
        $data['rows'] = array();
        if(isset($rows[0])){
            for($i = 0;$i < count($rows); $i++)
            {
                    $data['rows'][] = $rows[$i];
            }
        }
        
        $img = array();
        $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
        $data['img'] = $img[0]->img_path;
        // show($data['img']);
        

        if ($_SERVER["REQUEST_METHOD"]=="POST") {
              $location=$_POST["location"];
              $destination=$_POST["destination"];
              $l_lat=$_POST["l_lat"];
              $l_long=$_POST["l_long"];
              $d_lat=$_POST["d_lat"];
              $d_long=$_POST["d_long"];
            //   show($_POST);
              if(!empty($location) &&   $l_lat!=='' &&    $l_long!==''  )
              {
                if( !empty($destination) && $d_lat!=='' &&  $d_long!=='') 
                {
                    redirect('customer/ride_step2/.php?location='.$location.'&l_lat='.$l_lat.'&l_long='.$l_long.'&destination='.$destination.'&d_lat='.$d_lat.'&d_long='.$d_long);
                }
                else{
                    $data['errors']['destination'] = "select the destination";
                }
              }
              else{
                $data['errors']['location'] = "select the pickup location";
              }
            }
        $data['title'] = "Ride";
        $this->view('customer/ride_step1',$data);
    }


     
    public function ride_step2(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");

        }
        $user = new User();
        $rating = new Rating();

        $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
        $sum = 0;

        if (is_array($rate) && count($rate) > 0) {
            foreach ($rate as $r) {
                $sum += $r->rate;
            }
            $data['rating'] = round($sum / count($rate));
        } else {
            $data['rating'] = 3;
        }

        $img = array();
        $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
        $data['img'] = $img[0]->img_path;

        if(empty($_GET['location'])){
            redirect("customer/ride_step1");
        }
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
            // show($_POST);
            if(!empty($_GET))
            {
                $location=$_GET['location'];
                $l_lat=$_GET['l_lat'];
                $l_long=$_GET['l_long'];
                $destination=$_GET['destination'];
                $d_lat=$_GET['d_lat'];
                $d_long=$_GET['d_long'];

                $time= $_POST['time'];
                $distance=$_POST['distance'];
                $m_lat=$_POST['m_lat'];
                $m_long=$_POST['m_long'];

                 redirect('customer/ride_step3/.php?time='.$time.'&distance='.$distance.'&location='.$location.'&l_lat='.$l_lat.'&l_long='.$l_long.'&destination='.$destination.'&d_lat='.$d_lat.'&d_long='.$d_long.'&m_lat='.$m_lat.'&m_long='.$m_long);

            }
        }
        $data['title'] = "Ride";
        $this->view('customer/ride_step2',$data);
    }

    public function ride_step3(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $user = new User();
        $current_ride = new Current_rides();
        $standardfare = new standardFare();
        $driver_status = new Driver_status();
        $arr =array();
        $rating = new Rating();

        $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
        $sum = 0;

        if (is_array($rate) && count($rate) > 0) {
            foreach ($rate as $r) {
                $sum += $r->rate;
            }
            $data['rating'] = round($sum / count($rate));
        } else {
            $data['rating'] = 3;
        }

        $img = array();
        $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
        $data['img'] = $img[0]->img_path;

        $rows = $standardfare->findAll();
        $data['rows'] = array();
        if(isset($rows[0])){

            for($i = 0;$i < count($rows); $i++)
            {
                    $data['rows'][] = $rows[$i];
            }
        }
        $rows2 = $driver_status->findAll();
        $data['rows2'] = array();
        if(isset($rows2[0])){

            for($i = 0;$i < count($rows2); $i++)
            {
                    $data['rows2'][] = $rows2[$i];
            }
        }
        // show($data['rows2']);

            $location=$_GET['location'];
            $l_lat=$_GET['l_lat'];
            $l_long=$_GET['l_long'];
            $destination=$_GET['destination'];
            $d_lat=$_GET['d_lat'];
            $d_long=$_GET['d_long'];
            $time= $_GET['time'];
            $distance=$_GET['distance'];
            $m_lat=$_GET['m_lat'];
            $m_long=$_GET['m_long'];

        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $vehicle=$_POST['vehicle'];

            $arr['passenger_id']=$_SESSION['USER_DATA']->id;
            $arr['location']=$location;
            $arr['l_lat']=$l_lat;
            $arr['l_long']=$l_long;
            $arr['destination']=$destination;
            $arr['d_lat']=$d_lat;
            $arr['d_long']=$d_long;
            $arr['vehicle']=$vehicle;
            if($m_lat!=='' && $m_long!=='')
            {
                $arr['m_lat']=$m_lat;
                $arr['m_long']=$m_long;
            }
        //    show($arr);
            $rows3 = $current_ride->findAll();
            // $data['rows'] = array();
            if(isset($rows3[0])){

                for($i = 0;$i < count($rows3); $i++)
                {
                       if($rows3[$i]->passenger_id == $_SESSION['USER_DATA']->id)
                       {
                          $id = array();
                          $id['id']=$rows3[$i]->id;
                          $current_ride->delete($id);
                       }
                }
            }
            $current_ride->insert($arr);

           
             redirect('customer/ride_step4/.php?time='.$time.'&distance='.$distance.'&location='.$location.'&l_lat='.$l_lat.'&l_long='.$l_long.'&destination='.$destination.'&d_lat='.$d_lat.'&d_long='.$d_long.'&vehicle='.$vehicle.'&m_lat='.$m_lat.'&m_long='.$m_long);
        }
        $data['title'] = "Ride";
        $this->view('customer/ride_step3',$data);
    }

    public function ride_step4(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $rides = new Rides();
        $driver_staus= new Driver_status;
        $offers = new Offers();
        $user = new User();
        $current_ride = new Current_rides();
        $rating = new Rating();

        $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
        $sum = 0;

        if (is_array($rate) && count($rate) > 0) {
            foreach ($rate as $r) {
                $sum += $r->rate;
            }
            $data['rating'] = round($sum / count($rate));
        } else {
            $data['rating'] = 3;
        }


        $img = array();
        $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
        $data['img'] = $img[0]->img_path;

        $rows = $driver_staus->findAll();
        $data['rows'] = array();
        if(isset($rows[0])){

            for($i = 0;$i < count($rows); $i++)
            {
                    $data['rows'][] = $rows[$i];
            }
        }
        
        // $rows1 = $message->findAll();
        // $data['rows1'] = array();
       
        // if(isset($rows1[0])){

        //     for($i = 0;$i < count($rows1); $i++)
        //     {
        //             $data['rows1'][] = $rows1[$i];
        //     }
        // }

        $rows2 = $offers->findAll();
        $data['rows2'] = array();
       
        if(isset($rows2[0])){

            for($i = 0;$i < count($rows2); $i++)
            {
                    $data['rows2'][] = $rows2[$i];
            }
        }
        
        $rows3 = $user->findAll();
        $data['rows3'] = array();
       
        if(isset($rows3[0])){

            for($i = 0;$i < count($rows3); $i++)
            {
                    $data['rows3'][] = $rows3[$i];
            }
        }
        $rows4 = $current_ride->findAll();
        $data['rows4'] = array();
       
        if(isset($rows4[0])){

            for($i = 0;$i < count($rows4); $i++)
            {
                    $data['rows4'][] = $rows4[$i];
            }
        }
        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
            // negotiate part
            if(isset($_POST['message_text']) && $_POST['message_text']!=="")
            {
                 $chat = array();
                 $chat['negotiation_price']=$_POST['message_text'];
                 $chat['negotiation_status'] = 1;
                $offers->update_negotiate_fare($_POST['ride_id'],$_POST['Driver_id'],$chat);
            }

            // go button click go next state
            if(isset($_POST['driver_id']))
            {
                $_POST['passenger_id']=$_SESSION['USER_DATA']->id;
                $_POST['date'] = date("Y-m-d H:i:s");
                $_POST['location']=$_GET['location'];
                $_POST['l_lat']=$_GET['l_lat'];
                $_POST['l_long']=$_GET['l_long'];
                $_POST['destination']=$_GET['destination'];
                $_POST['d_lat']=$_GET['d_lat'];
                $_POST['d_long']=$_GET['d_long'];           
                $_POST['vehicle']=$_GET['vehicle'];
                $_POST['time']=$_GET['time'];
                $_POST['distance']=$_GET['distance'];
                $_POST['state']="Reject";
               if($_GET['m_lat']!=='' && $_GET['m_long']!==''){
                    $_POST['m_lat']=$_GET['m_lat'];
                    $_POST['m_long']=$_GET['m_long'];
               }
                $rides->insert($_POST);

                //
                $accept_status= array();
                $accept_status['accept_status']=1;
                // show($accept_status);
                $offers->update_accept_status($_POST['driver_id'],$accept_status);
                if($_POST['id'] !== ''){
                   redirect('customer/ride_step5/location='.$_GET['location'].'&l_lat='.$_GET['l_lat'].'&l_long='.$_GET['l_long'].'&driver_id='.$_POST['driver_id'].'&id='.$_POST['id']);
                }
            }
        }
       
       //  back button click
        if(isset($_POST['submit']))
        {
            $id =array();
            $id = $current_ride->where(['passenger_id' => $_SESSION['USER_DATA']->id]);
            $current_ride_id['id']=$id[0]->id;
            $current_ride->delete($current_ride_id);
            $time=$_GET['time'];
            $distance=$_GET['distance'];
            $location=$_GET['location'];
            $l_lat=$_GET['l_lat'];
            $l_long=$_GET['l_long'];
            $destination=$_GET['destination'];
            $d_lat=$_GET['d_lat'];
            $d_long=$_GET['d_long'];
            $m_lat=$_GET['m_lat'];
            $m_long=$_GET['m_long'];
            redirect('customer/ride_step3/.php?time='.$time.'&distance='.$distance.'&location='.$location.'&l_lat='.$l_lat.'&l_long='.$l_long.'&destination='.$destination.'&d_lat='.$d_lat.'&d_long='.$d_long.'&m_lat='.$m_lat.'&m_long='.$m_long);

        }

        $data['title'] = "Ride";
        $this->view('customer/ride_step4',$data);
    }

    public function ride_step5(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $driver_status= new Driver_status;
        $user = new User();
        $rides = new Rides();
        $message= new Message();
        $current_ride = new Current_rides();
        $rating = new Rating();

        $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
        $sum = 0;

        if (is_array($rate) && count($rate) > 0) {
            foreach ($rate as $r) {
                $sum += $r->rate;
            }
            $data['rating'] = round($sum / count($rate));
        } else {
            $data['rating'] = 3;
        }

        $img = array();
        $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
        $data['img'] = $img[0]->img_path;

        $vehicle = array();
        $vehicle = $rides->where(['id'=>$_GET['id']]);
        $data['vehicle']=$vehicle[0]->vehicle;


        $rows = $driver_status->findAll();
        $data['rows'] = array();
        if(isset($rows[0])){

            for($i = 0;$i < count($rows); $i++)
            {
                    $data['rows'][] = $rows[$i];
            }
        }

        $rows2 = $user->findAll();
        $data['rows2'] = array();
        if(isset($rows2[0])){

            for($i = 0;$i < count($rows2); $i++)
            {
                  if($_GET['driver_id'] == $rows2[$i]->id)
                  {
                    $data['rows2'][] = $rows2[$i];
                  }
            }
        }
        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
            if(isset($_POST['message']))
            {
                $_POST['ride_id']=$_GET['id'];
                $_POST['sender']='passenger';
                $_POST['passenger_id']=$_SESSION['USER_DATA']->id;
                $_POST['driver_id']=$_GET['driver_id'];
                
                $message->insert($_POST);
            }
            if(isset($_POST['passenger_cancel']))
            {
                $_POST['state']='cancel';
                $rides->update($_GET['id'],$_POST);
                $ride_id = array();
                $ride_id['id']=$_GET['id'];
                $current_ride->delete($ride_id);
                redirect('customer/ride_step');
            }
            
        }

        $rows3 = $rides->findAll(); 
        if(isset($rows3[0])){

            for($i = 0;$i < count($rows3); $i++)
            {
                    if($rows3[$i]->id == $_GET['id']  && $rows3[$i]->ride_start==1){
                           redirect('customer/ride_step6/.php?driver_id='.$_GET['driver_id'].'&id='.$_GET['id']);
                    }
            }
        }
    
        // show($data);
        // redirect('customer/ride_step6/driver_id='.$_GET['driver_id']);
        $data['title'] = "Ride";
        $this->view('customer/ride_step5',$data);
    }

    public function ride_step6(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $rides = new Rides();
        $user = new User();
        $rating = new Rating();

        $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
        $sum = 0;

        if (is_array($rate) && count($rate) > 0) {
            foreach ($rate as $r) {
                $sum += $r->rate;
            }
            $data['rating'] = round($sum / count($rate));
        } else {
            $data['rating'] = 3;
        }


        $img = array();
        $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
        $data['img'] = $img[0]->img_path;

        $vehicle = array();
        $vehicle = $rides->where(['id'=>$_GET['id']]);
        $data['vehicle']=$vehicle[0]->vehicle;

        $rows = $rides->findAll();
        $data['rows'] = array();
        if(isset($rows[0])){

            for($i = 0;$i < count($rows); $i++)
            {
                  $data['rows'][]=$rows[$i];
                if($rows[$i]->id == $_GET['id']  && $rows[$i]->state=='Success'){
                    redirect('customer/ride_step7/.php?driver_id='.$_GET['driver_id'].'&id='.$_GET['id']);
                }
            }
        }

        $data['title'] = "Ride";
        $this->view('customer/ride_step6',$data);
    }

    public function ride_step7(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $complaint = new Complaint();
        $rating = new Rating();
        $user = new User();

        $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
        $sum = 0;

        if (is_array($rate) && count($rate) > 0) {
            foreach ($rate as $r) {
                $sum += $r->rate;
            }
            $data['rating'] = round($sum / count($rate));
        } else {
            $data['rating'] = 3;
        }


        $img = array();
        $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
        $data['img'] = $img[0]->img_path;

        $img = array();
        $driver_name = $user->where(['id'=>$_GET['driver_id']]);
        $data['driver_name'] = $driver_name[0]->name;

        $sample = array();   // sample is complaint data store array
        $sample1= array();   // sample1 is rating data story array

        $sample['complaint'] = '';
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if ($_FILES["file"]["error"] === UPLOAD_ERR_OK) {
                $targetDir = "C://wamp64/www/FAREFLEX/public/assets/img/customer/profile/"; // Directory where files will be uploaded
                $targetFile = $targetDir . basename($_FILES["file"]["name"]);
            
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                    // echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
                      $sample['file_path']=basename($_FILES["file"]["name"]);
                } else {
                //    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                // echo "File upload error: " . $_FILES["file"]["error"];
            }
            
                    
           // complaint part insert data---------------------------------------------------
                for ($i = 1; $i < 15; $i++) {
                    if (isset($_POST['report'.$i]) && $_POST['report'.$i] !== null) {
                        $sample['complaint'] .= $_POST['report'.$i] . ' , ';
                    }
                }
                $sample['complaint'] .= $_POST['other'] ;
                $sample['complaint'] = rtrim($sample['complaint'], ', ');  //tail trim
            
                $sample['passenger_id']=$_SESSION['USER_DATA']->id;
                $sample['driver_id']=3;
                $sample['complainant']='Passenger';
                $sample['datetime'] = date("Y-m-d H:i:s");
                if (!empty($sample['complaint'])){
                    // show($sample);
                    $complaint->insert($sample);
                }

                // rating part insert data--------------------------------------------------
                $sample1['ride_id']=$_GET['id'];
                $sample1["role_id"]=$_GET['driver_id'];
                $sample1['role']='Driver';
                $sample1['rate']=$_POST['star'];

                if($_POST['star']!=='0'){
                    if($rating->where(['ride_id' => $_GET['id'],'role' => 'Driver']))
                    {
                        $rate_id['ride_id']=$_GET['id'];
                        $rate_id['role']='Driver';
                          $rating->delete($rate_id);
                        // show($sample1);
                    }
                     $rating->insert($sample1);
                    // show($sample1);
                }
                redirect('customer/ride_step1');

            }
        $data['title'] = "Ride";
        $this->view('customer/ride_step7',$data);
    }

    //this is Add place page  controller
    public function add_place(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];
        $add_place = new Add_Place();
        $user = new User();
        $rating = new Rating();

        $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
        $sum = 0;

        if (is_array($rate) && count($rate) > 0) {
            foreach ($rate as $r) {
                $sum += $r->rate;
            }
            $data['rating'] = round($sum / count($rate));
        } else {
            $data['rating'] = 3;
        }

        $img = array();
        $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
        $data['img'] = $img[0]->img_path;
		
        $rows = $add_place->findAll();
        $data['rows'] = array();
       
        if(isset($rows[0])){

        for($i = 0;$i < count($rows); $i++)
         {
                   $data['rows'][] = $rows[$i];
         }
        }
        // show($rows);
        $data['title'] = "Add_Place";
        $this->view('customer/add_place',$data);
   
    }

    public function add_place_delete($id=null){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];
        $add_place = new Add_Place();
        $user = new User();
        $rating = new Rating();

        $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
        $sum = 0;

        if (is_array($rate) && count($rate) > 0) {
            foreach ($rate as $r) {
                $sum += $r->rate;
            }
            $data['rating'] = round($sum / count($rate));
        } else {
            $data['rating'] = 3;
        }

        $img = array();
        $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
        $data['img'] = $img[0]->img_path;

        $rows = $add_place->findAll();
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
                $data['rows'][] = $rows[$i];
        }
        $add_place->delete_addplace($id);
        redirect('customer/add_place');
    }
    
    public function add_place_update($id=null){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];
        $add_place = new Add_Place();
        $user = new User();
        $rating = new Rating();

        $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
        $sum = 0;

        if (is_array($rate) && count($rate) > 0) {
            foreach ($rate as $r) {
                $sum += $r->rate;
            }
            $data['rating'] = round($sum / count($rate));
        } else {
            $data['rating'] = 3;
        }

        $img = array();
        $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
        $data['img'] = $img[0]->img_path;

        $rows = $add_place->findAll();
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
            if($rows[$i]->id == $id)
                $data['rows'][] = $rows[$i];
        }

        if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			if($add_place->validate($_POST))
			{
                $_POST['date'] = date("Y-m-d H:i:s");
               
                $add_place->fit_icon($_POST);
                $_POST['icon']= $add_place ->icon;
                $_POST['id']=$id;
                $_POST['passenger_id']=$_SESSION['USER_DATA']->id;
                $add_place->update($id,$_POST);
				redirect('customer/add_place');
            }
           
        }
        
        
        $data['title'] = "Add_Place";
        $this->view('customer/add_place_update',$data);

    }
    public function add_place_insert(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];
        // show($_POST);
        $add_place = new Add_Place();
        $user = new User();
        $rating = new Rating();

        $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
        $sum = 0;

        if (is_array($rate) && count($rate) > 0) {
            foreach ($rate as $r) {
                $sum += $r->rate;
            }
            $data['rating'] = round($sum / count($rate));
        } else {
            $data['rating'] = 3;
        }

        $img = array();
        $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
        $data['img'] = $img[0]->img_path;

		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			if($add_place->validate($_POST))
			{
                $add_place->fit_icon($_POST);
                $_POST['icon'] =$add_place->icon;
                $_POST['date'] = date("Y-m-d H:i:s");
                $_POST['passenger_id']=$_SESSION['USER_DATA']->id;
                $add_place->insert($_POST);
               
                // message("Successfully Add Place");
				 redirect('customer/add_place');
            }
           
        }
        $data['errors'] = $add_place ->errors;
        $data['title'] = "Add_Place";
        $this->view('customer/add_place_form',$data);

    }
    public function Activity(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];
        $rides = new Rides();
        $user = new User();
        $rating = new Rating();

        $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
        $sum = 0;

        if (is_array($rate) && count($rate) > 0) {
            foreach ($rate as $r) {
                $sum += $r->rate;
            }
            $data['rating'] = round($sum / count($rate));
        } else {
            $data['rating'] = 3;
        }
		
        $img = array();
        $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
        $data['img'] = $img[0]->img_path;

        $rows = $rides->findAll();
        $rows2 = $user->findAll();

        $data['rows'] = array();
        $data['$rows2'] = array();

        if(isset($rows[0])){
            for($i = count($rows)-1;$i >= 0; $i--)
            {
                    $data['rows'][] = $rows[$i];
            }
        }
        if(isset($rows2[0])){
            for($i = 0;$i < count($rows2); $i++)
            {
                    $data['rows2'][] = $rows2[$i];
            }
        }
        $data['title'] = "Activity";
        $this->view('customer/activity',$data);
    }

        public function Profile(){
            if(!Auth::logged_in())
            {
                message('please login to view the page');
                redirect("login");
            }
            $user =new User();
            $rating = new Rating();

            $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
           $sum = 0;

            if (is_array($rate) && count($rate) > 0) {
                foreach ($rate as $r) {
                    $sum += $r->rate;
                }
                $data['rating'] = round($sum / count($rate));
            } else {
                $data['rating'] = 3;
            }

            $img = array();
            $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
            $data['img'] = $img[0]->img_path;

            $arr = array();
            $data['rows'] = array();

            $rows = $user->findAll();
            if(isset($rows[0])){
                for($i = count($rows)-1;$i >= 0; $i--)
                {
                        $data['rows'][] = $rows[$i];
                }
            }
           
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $targetDir = "C://wamp64/www/FAREFLEX/public/assets/img/customer/profile/"; // Folder to upload the image
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                $newFileName =  $_SESSION['USER_DATA']->id.'.'. $imageFileType; // New filename with the same extension
                $targetFile = $targetDir . $newFileName;
                if (isset($_FILES["image"]["tmp_name"]) && $_FILES["image"]["tmp_name"] != "" && getimagesize($_FILES["image"]["tmp_name"])) {
                        
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                            if($check !== false) {
                                // show("File is an image - " . $check["mime"] . ".");
                                $uploadOk = 1;
                            } else {
                                // show("File is not an image.");
                                $uploadOk = 0;
                            }


                            // Check file size
                            if ($_FILES["image"]["size"] > 500000) {
                                message("Sorry, your file is too large.");
                                $uploadOk = 0;
                            }

                            // Allow certain file formats
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif" ) {
                                message("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                                $uploadOk = 0;
                            }

                            // Check if file already exists
                            if (file_exists($targetFile)) {
                                // Delete the existing file
                                unlink($targetFile);
                                // show("Existing file deleted.");
                            }

                            // Check if $uploadOk is set to 0 by an error
                            if ($uploadOk == 0) {
                                message("Sorry, your file was not uploaded.");
                            // if everything is ok, try to upload file
                            } else {
                                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                                    // show ("The file ". basename( $_FILES["image"]["name"]). " has been uploaded.");

                                    $arr["img_path"]=$newFileName;
                                    if (!isset($_SESSION['img_path']) || $_SESSION['img_path'] !== $newFileName) {
                                        // Update session data
                                        $_SESSION['img_path'] = $newFileName;
                                        // $_SESSION['img_data'] = 'data'; // Update this with your image data
                                    }
                                    

                                }
                            }
                       }
                            // $arr["img_path"]= $_SESSION['USER_DATA']->img_path;
                            // $arr['name']=$_POST['name'];
                            // $arr['email']=$_POST['email'];
                            // $arr['phone']=$_POST['phone'];
                            $arr['address']=$_POST['address'];
                            $arr['nic']=$_POST['nic'];
                            $arr['dob']=$_POST['dob'];
                            $user->update($_SESSION['USER_DATA']->id,$arr);
                            redirect('customer/profile');
                            //  show($arr);
                            // show($_POST);

                }
                
            

            
            
            $data['title'] = "Help";
            $this->view('customer/profile',$data);
        }
    public function Help(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $user = new User();
        $rating = new Rating();

        $rate = $rating->where(['role_id'=>$_SESSION['USER_DATA']->id]);
        $sum = 0;

        if (is_array($rate) && count($rate) > 0) {
            foreach ($rate as $r) {
                $sum += $r->rate;
            }
            $data['rating'] = round($sum / count($rate));
        } else {
            $data['rating'] = 3;
        }

        $img = array();
        $img = $user->where(['id'=>$_SESSION['USER_DATA']->id]);
        $data['img'] = $img[0]->img_path;

        $data['title'] = "Help";
        $this->view('customer/help',$data);
    }
 }
 //echo " sample home page";
 ?>
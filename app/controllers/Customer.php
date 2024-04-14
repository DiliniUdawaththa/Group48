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
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
              $location=$_POST["location"];
              $destination=$_POST["destination"];
              if(!empty($location) &&  !empty($destination))
              {
                $l_lat=$_POST["l_lat"];
                $l_long=$_POST["l_long"];
                $d_lat=$_POST["d_lat"];
                $d_long=$_POST["d_long"];
                 redirect('customer/ride_step2/.php?location='.$location.'&l_lat='.$l_lat.'&l_long='.$l_long.'&destination='.$destination.'&d_lat='.$d_lat.'&d_long='.$d_long);
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
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
            show($_POST);
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

                redirect('customer/ride_step3/.php?time='.$time.'&distance='.$distance.'&location='.$location.'&l_lat='.$l_lat.'&l_long='.$l_long.'&destination='.$destination.'&d_lat='.$d_lat.'&d_long='.$d_long);

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
            $location=$_GET['location'];
            $l_lat=$_GET['l_lat'];
            $l_long=$_GET['l_long'];
            $destination=$_GET['destination'];
            $d_lat=$_GET['d_lat'];
            $d_long=$_GET['d_long'];
            $time= $_GET['time'];
            $distance=$_GET['distance'];

        if ($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $vehicle=$_POST['vehicle'];
            redirect('customer/ride_step4/.php?time='.$time.'&distance='.$distance.'&location='.$location.'&l_lat='.$l_lat.'&l_long='.$l_long.'&destination='.$destination.'&d_lat='.$d_lat.'&d_long='.$d_long.'&vehicle='.$vehicle);
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

        $rows = $driver_staus->findAll();
        $data['rows'] = array();
       
        if(isset($rows[0])){

            for($i = 0;$i < count($rows); $i++)
            {
                    $data['rows'][] = $rows[$i];
            }
        }

        
        if ($_SERVER["REQUEST_METHOD"]=="POST")
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
            $_POST['fare']=500;
            $_POST['state']="Reject";
            // show($_POST);
            $rides->insert($_POST);
            redirect('customer/ride_step5/location='.$_GET['location'].'&l_lat='.$_GET['l_lat'].'&l_long='.$_GET['l_long'].'&driver_id='.$_POST['driver_id']);
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

        $rows = $driver_status->findAll();
        $data['rows'] = array();
        if(isset($rows[0])){

            for($i = 0;$i < count($rows); $i++)
            {
                    $data['rows'][] = $rows[$i];
            }
        }
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
        $data['title'] = "Ride";
        $this->view('customer/ride_step6',$data);
    }

    public function ride_step7(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
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
		
        $rows = $add_place->findAll();
        $data['rows'] = array();
       
        if(isset($rows[0])){

        for($i = 0;$i < count($rows); $i++)
         {
                   $data['rows'][] = $rows[$i];
         }
        
        // show($rows);
        $data['title'] = "Add_Place";
        $this->view('customer/add_place',$data);
        }
    }

    public function add_place_delete($id=null){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];
        $add_place = new Add_Place();
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
        $add_place = new Add_Place();
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			if($add_place->validate($_POST))
			{
                $add_place->fit_icon($_POST);
                $_POST['icon'] =$add_place->icon;
                $_POST['date'] = date("Y-m-d H:i:s");
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

    public function Help(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['title'] = "Help";
        $this->view('customer/help',$data);
    }
 }
 //echo " sample home page";
 ?>
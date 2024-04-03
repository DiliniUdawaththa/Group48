<?php
 class Customer extends Controller{
    public function index(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['title'] = "Ride";
        $this->view('customer/ride_step1',$data);
    }

    // step1 stage
    public function ride_step1(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        // if ($_SERVER["REQUEST_METHOD"]=="POST") {
             // Access individual POST parameters
            //  show($_POST);
            // $name = $_POST["name1"];

            // // Use the retrieved POST data
            // show($name);
            // }
        $data['title'] = "Ride";
        $this->view('customer/ride_step1',$data);
    }

    // public function ride_stepa(){
    //     // if(!Auth::logged_in())
    //     // {
    //     //     message('please login to view the page');
    //     //     redirect("login");
    //     // }
    //     // if ($_SERVER["REQUEST_METHOD"]) {
    //     //      show($_GET(name));
    //     // }
    //     // $this->view('customer/ride_stepa');
    //     // $data['title'] = "Ride";
    //     // $this->view('customer/ride_step1',$data);
    // }
     
    public function ride_step2(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
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
        $data['title'] = "Ride";
        $this->view('customer/ride_step3',$data);
    }

    public function ride_step4(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
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
        // $data['errors'] = [];
        // $message = new Message();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $address=$_POST["address"];
            show($address);
         }
        // show($_POST);
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
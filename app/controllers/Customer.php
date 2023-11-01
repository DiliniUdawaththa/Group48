<?php
 class Customer extends Controller{
    public function index(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['title'] = "Ride";
        $this->view('customer/ride',$data);
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
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			if($add_place->validate($_POST))
			{
                $add_place->fit_icon($_POST);
                $_POST['icon'] =$add_place->icon;
                $_POST['date'] = date("Y-m-d H:i:s");
                $add_place->insert($_POST);
                // message("Your profile was sucessfuly created. please login");
				// redirect('customer/add_place');
            }
           
        }
        $rows = $add_place->findAll();
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
                $data['rows'][] = $rows[$i];
        }
        
        // show($rows);

        $data['title'] = "Add_Place";
        $this->view('customer/add_place',$data);
    }

    // public function Activity(){
    //     if(!Auth::logged_in())
    //     {
    //         message('please login to view the page');
    //         redirect("login");
    //     }
    //     $data['title'] = "Activity";
    //     $this->view('customer/activity',$data);
    // }
    // public function Help(){
    //     if(!Auth::logged_in())
    //     {
    //         message('please login to view the page');
    //         redirect("login");
    //     }
    //     $data['title'] = "Help";
    //     $this->view('customer/help',$data);
    // }
 }
 //echo " sample home page";
 ?>
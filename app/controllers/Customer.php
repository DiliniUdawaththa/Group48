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
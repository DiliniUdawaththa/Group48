<?php
 class Admin extends Controller{
    public function index(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['title'] = "Dashboard";
        $this->view('admin/dashboard',$data);
    } 
    // customer profile controller
     public function customer(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['title'] = "Customer";
        $this->view('admin/customer',$data);
    }

    // officer profile controller
    public function officer(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['errors'] = [];
        $add_officer = new officer();
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			if($add_officer->validate($_POST))
			{
                // $_POST['empID'] =$add_officer->empID;
                // $_POST['Name'] =$add_officer->Name;
                // $_POST['Email'] =$add_officer->Email;
                // $_POST['Mobile'] =$add_officer->Mobile;
                // $_POST['date'] = date("Y-m-d H:i:s");
                $add_officer->insert($_POST);
                // message("Your profile was sucessfuly created. please login");
				// redirect('customer/add_place');
            }
           
        }
        $rows = $add_officer->findAll();
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
        }
        
        // show($rows);

        $data['title'] = "Officer";
        $this->view('admin/officer',$data);
    }

    // profile page
    public function profile($id=null)
    {
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $user = new User();
        $id = $id ?? Auth::getid();

        $data['title'] = "Profile";
        $this->view('admin/profile',$data);
    }


 }
 //echo " sample home page";
 ?>
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
    //  public function customer(){
    //     if(!Auth::logged_in())
    //     {
    //         message('please login to view the admin section');
    //         redirect("login");
    //     }

    //     $add_customer = new AdminCustomer();

    //     $data = [
    //         'role' => "customer"
    //     ];

    //     $rows = $add_customer->where($data);
    //     $data['rows'] = array();

    //     for($i = 0;$i < count($rows); $i++)
    //     {
    //         $data['rows'][] = $rows[$i];
    //     }

    //     $data['title'] = "Customer";
    //     $this->view('admin/customer',$data);
    // }

    public function customer() {
        if (!Auth::logged_in()) {
            message('please login to view the admin section');
            redirect("login");
        }
    
        $add_customer = new AdminCustomer();
    
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : null;
    
        $data = [
            'role' => 'customer',
        ];
    
        if ($searchTerm !== null) {
            // If a search term is provided, perform a search
            $rows = $add_customer->where1($data, $searchTerm);
        } else {
            // Otherwise, retrieve all customers
            $rows = $add_customer->where($data);
        }
    
        $data['rows'] = is_array($rows) ? $rows : [];
    
        $data['title'] = "Customer";
        $this->view('admin/customer', $data);
    }
    

    // ride profile controller
    public function ride(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['title'] = "Rides";
        $this->view('admin/ride',$data);
    }

    // driver profile controller
    public function driver(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }

        $add_driver = new AdminDriver();

        $data = [
            'role' => "driver"
        ];

        $rows = $add_driver->where($data);
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
        }

        $data['title'] = "Drivers";
        $this->view('admin/driver',$data);
    }


    // officer profile controller
    public function officer(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['errors'] = [];
        $add_officer = new AdminOfficer();

        $rows = $add_officer->findAll();
        $data['rows'] = array();

        if(isset($rows[0])){
        for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
        }
        
        // show($rows);
        $data['title'] = "Officer";
        $this->view('admin/officer',$data);
        }
    }

    public function officer_insert(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['errors'] = [];
        $add_officer = new AdminOfficer();
        if($_SERVER['REQUEST_METHOD'] == "POST")
		{
            
			if($add_officer->validate($_POST))
			{
                //  show($add_officer->Name);
                $_POST['empID'] =$add_officer->empID;
                $_POST['name'] =$add_officer->name;
                $_POST['email'] =$add_officer->email;
                $_POST['phone'] =$add_officer->phone;
                // $_POST['date'] = date("Y-m-d H:i:s");
                $add_officer->insert($_POST);
                // message("Your profile was sucessfuly created. please login");
				redirect('admin/officer');
            }
        }
        $data['errors'] = $add_officer ->errors;
        $data['title'] = "Officer";
        $this->view('admin/officer_form',$data);

    }

    public function officer_delete($empID=null){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['errors'] = [];
        $add_officer = new AdminOfficer();

        $rows = $add_officer->findAll();
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
                $data['rows'][] = $rows[$i];
        }

        $add_officer->delete_addofficer($empID);
        
        redirect('admin/officer');
    }

    public function officer_update($empID=null){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['errors'] = [];
        $add_officer = new AdminOfficer();
        $rows = $add_officer->findAll();
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
            if($rows[$i]->empID == $empID)
                $data['rows'][] = $rows[$i];
        }
        // show($_POST);
        if($_SERVER['REQUEST_METHOD'] == "POST")
		{
            // show($_POST);
            
            // if($add_officer->validate($_POST))
			// {    
                $_POST['empID']=$empID;            
                $add_officer->update_addofficer($empID,$_POST);
                // message("Your profile was sucessfuly created. please login");

                redirect('admin/officer');
            // }
           
        }

        $data['title'] = "Officer";
        $this->view('admin/officer_update',$data);
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

    // Searchbar
    public function search() {
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $model = new AdminCustomer();
            // $searchTerm = isset($_GET['search']) ? $_GET['search'] : null;
    
            $data = [
                'role' => 'customer',
            ];
            $data = $model->where1($data, $searchTerm);
            include 'customer.view.php';
        } else {
            // Redirect or handle the absence of search term
        }
    }


 }
 //echo " sample home page";
 ?>
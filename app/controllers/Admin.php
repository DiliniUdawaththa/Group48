<?php
 class Admin extends Controller{
    public function index(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }

        $model = new AdminDashboard();
        $roleCounts = $model->getRoleCounts();

        // $usersData = $model->countUsersByMonth();
        // $driversData = $model->countDriversByMonth();

        // $userRegistrationData = [];
        // $driverRegistrationData = [];

        // // Loop through the user data and organize it by month
        // foreach ($usersData as $userData) {
        //     $userRegistrationData[$userData['month']] = $userData['user_count'];
        // }

        // // Loop through the driver data and organize it by month
        // foreach ($driversData as $driverData) {
        //     $driverRegistrationData[$driverData['month']] = $driverData['driver_count'];
        // }

        // // Fill in any missing months with 0 registrations
        // for ($i = 1; $i <= 12; $i++) {
        //     if (!isset($userRegistrationData[$i])) {
        //         $userRegistrationData[$i] = 0;
        //     }
        //     if (!isset($driverRegistrationData[$i])) {
        //         $driverRegistrationData[$i] = 0;
        //     }
        // }

        // // Sort the data by month
        // ksort($userRegistrationData);
        // ksort($driverRegistrationData);

        // // Combine user and driver data into a single array
        // $registrationData = [
        //     'users' => array_values($userRegistrationData),
        //     'drivers' => array_values($driverRegistrationData)
        // ];

        $data = [
            'title' => "Dashboard",
            'roleCounts' => $roleCounts,
            // 'registrationData' => $registrationData
        ];
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
            'role' => 'user',
        ];
    
        $rows = $add_customer->where($data);
    
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
        // $data['errors'] = [];
        $add_officer = new User();

        $data = [
            'role' => "officer"
        ];


        $rows = $add_officer->where($data);
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
        $add_officer1 = new AdminOfficer();
        $add_officer = new User();
        if($_SERVER['REQUEST_METHOD'] == "POST")
		{
            
			if($add_officer->validate_officer($_POST))
			{
                //  show($add_officer->Name);
                $_POST['empID'] =$add_officer->empID;
                $_POST['name'] =$add_officer->name;
                $_POST['email'] =$add_officer->email;
                $_POST['phone'] =$add_officer->phone;
                $_POST['role'] = "officer";
                $p_word = $add_officer->generatePassword();

                if($add_officer->sendMail($_POST['email'],$p_word)){
                    $_POST['password'] = password_hash($p_word,PASSWORD_DEFAULT);
                }

                $_POST['date'] = date("Y-m-d H:i:s");
                $add_officer->insert($_POST);

                //add officer detail to the addofficer table
                if($add_officer1->addOfficerTable($_POST)){
                    $add_officer1->insert($_POST);
                }
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
        $add_officer = new User();

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
        $add_officer = new User();
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

    // Searchbar in customer page
    public function search() {

        $noMatchFound = false;

        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $add_customer = new AdminCustomer();
            $data = [
                'role' => 'user',
                'name' => strtolower($searchTerm)
            ];
    
            if ($searchTerm !== '') {
                $rows = $add_customer->whereLike($data, $searchTerm);
            } else {
                unset($data['name']);
                $rows = $add_customer->where($data);
            }
    
            $data['rows'] = is_array($rows) ? $rows : [];

            if (empty($data['rows'])) {
                $noMatchFound = true;
            }
    
    
            $data['title'] = "Customer";
            $data['noMatchFound'] = $noMatchFound;
            $this->view('admin/customer_search', $data);
        }
    }

    // Searchbar in driver page
    public function searchDriver() {

        $noMatchFound = false;

        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $add_driver = new AdminDriver();
            $data = [
                'role' => 'driver',
                'name' => strtolower($searchTerm)
            ];
    
            if ($searchTerm !== '') {
                $rows = $add_driver->whereLike($data, $searchTerm);
            } else {
                unset($data['name']);
                $rows = $add_driver->where($data);
            }
    
            $data['rows'] = is_array($rows) ? $rows : [];

            if (empty($data['rows'])) {
                $noMatchFound = true;
            }
    
    
            $data['title'] = "Customer";
            $data['noMatchFound'] = $noMatchFound;
            $this->view('admin/driver_search', $data);
        }
    }
    
    // public function mail(){
    //     $newMail = new reminderMail();
    //     $newMail->selectDriver();
    // }


 }
 //echo " sample home page";
 ?>
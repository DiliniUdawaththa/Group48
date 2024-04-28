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

        $model1 = new AdminRide();
        $rideCountsByDay = $model1->countRidesByDay();
        $rideCountsByMorning = $model1->countRidesByMorning();
        $rideCountsByNight = $model1->countRidesByNight();
        $rideCount = $model1->countRide();

        $userRegistrationData = $model->countUsersByMonth();
        $driverRegistrationData = $model->countDriversByMonth();

        // Merge the counts by month
        $registrationData = [];
        foreach ($userRegistrationData as $month => $userCount) {
            $registrationData[$month]['users'] = $userCount;
        }
        foreach ($driverRegistrationData as $month => $driverCount) {
            if (!isset($registrationData[$month])) {
                $registrationData[$month] = [];
            }
            $registrationData[$month]['drivers'] = $driverCount;
        }

        // Fill in any missing months with 0 registrations
        for ($i = 1; $i <= 12; $i++) {
            if (!isset($registrationData[$i])) {
                $registrationData[$i] = ['users' => 0, 'drivers' => 0];
            }
        }

        // Sort the data by month
        ksort($registrationData);

        $data = [
            'title' => "Dashboard",
            'roleCounts' => $roleCounts,
            'registrationData' => $registrationData,
            'rideCountsByDay' => $rideCountsByDay,
            'rideCountsByMorning' => $rideCountsByMorning,
            'rideCountsByNight' => $rideCountsByNight,
            'rideCount' => $rideCount
        ];

        $this->view('admin/dashboard',$data);
    }

    // Reports profile controller
     public function report(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }

        $add_report = new AdminDashboard();

        // $data = [
        //     'role' => "customer"
        // ];

        // $rows = $add_customer->where($data);
        // $data['rows'] = array();

        // for($i = 0;$i < count($rows); $i++)
        // {
        //     $data['rows'][] = $rows[$i];
        // }

        $data['title'] = "Report";
        $this->view('admin/report',$data);
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
        $add_customer1 = new AdminRide();
    
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : null;
    
        $data = [
            'role' => 'user',
        ];
    
        $rows = $add_customer->where($data);

        $rides_counts = [];
        foreach ($rows as $row) {
            $rides_counts[$row->id] = $add_customer1->countRideByCustomer($row->id);
        }
    
        $data['rows'] = is_array($rows) ? $rows : [];
        $data['rides_counts'] = $rides_counts;
        $data['add_customer1'] = $add_customer1;
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

        $model = new AdminRide();
        $rows = $model->findAll();
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
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
        $add_driver1 = new AdminRide();
        $add_driver2 = new AdminDashboard();

        $data = [
            'role' => "driver"
        ];

        $upcomingExpire = $add_driver->countExpiringDrivers();
        $expired = $add_driver1->expiredDriverCount();
        $total_driver = $add_driver2->getRoleCounts();
        $total_driver_count = $total_driver['driver']; 

        $rows = $add_driver->where($data);

        $rides_counts = [];
        foreach ($rows as $row) {
            $rides_counts[$row->id] = $add_driver1->countRideByDriver($row->id);
        }

        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
        }

        $data['rides_counts'] = $rides_counts;
        $data['add_driver1'] = $add_driver1;
        $data['upcomingExpire'] = $upcomingExpire;
        $data['expired'] = $expired;
        $data['total_driver_count'] = $total_driver_count;
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
            $add_customer1 = new AdminRide();
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

            $rides_counts = [];
            foreach ($rows as $row) {
                $rides_counts[$row->id] = $add_customer1->countRideByCustomer($row->id);
            }
    
            $data['rows'] = is_array($rows) ? $rows : [];

            if (empty($data['rows'])) {
                $noMatchFound = true;
            }
    
            $data['rides_counts'] = $rides_counts;
            $data['add_customer1'] = $add_customer1;
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
            $add_driver1 = new AdminRide();
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

            $rides_counts = [];
            foreach ($rows as $row) {
                $rides_counts[$row->id] = $add_driver1->countRideByDriver($row->id);
            }

            if (empty($data['rows'])) {
                $noMatchFound = true;
            }
    
            $data['rides_counts'] = $rides_counts;
            $data['add_driver1'] = $add_driver1;
            $data['title'] = "Customer";
            $data['noMatchFound'] = $noMatchFound;
            $this->view('admin/driver_search', $data);
        }
    }

    public function searchRide(){
        $noMatchFound = false;
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            if(isset($_GET['search'])){
                $searchTerm = $_GET['search'];
                
                $ride = new AdminRide();
                if ($searchTerm !== '') {
                    $rows = $ride->searchRides($searchTerm);
                } else {
                    $rows = $ride->findAll();
                }

                $data['rows'] = is_array($rows) ? $rows : [];

                if (empty($data['rows'])) {
                    $noMatchFound = true;
                }

                $data['title'] = "Ride";
                $data['noMatchFound'] = $noMatchFound;
                $this->view('admin/ride_search', $data);
            }
        }
    }

    public function rideMore($id){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $ride = new AdminRide();
        $user = new User();

        $data = [
            'id' => $id
        ];
        $rows = $ride->where($data);
        $row = (object) $rows[0];

        $customer = $row->passenger_id;
        $data1 = [
            'id' => $customer
        ];
        $rows1 = $user->where($data1);
        $row1 = null;
        if (is_array($rows1) && count($rows1) > 0) {
            $row1 = (object) $rows1[0];
        }

        $driver = $row->driver_id;
        $data2 = [
            'id' => $driver
        ];
        $rows2 = $user->where($data2);
        $row2 = null;
        if (is_array($rows2) && count($rows2) > 0) {
            $row2 = (object) $rows2[0];
        }

        $data = [
            'title' => "Rides",
            'row' => $row,
            'row1' => $row1,
            'row2' => $row2,
        ];

        $this->view('admin/rideMore',$data);
    }

    public function rideReport(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }

        $this->view('admin/ride_report');

    }

    public function customerReport(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }

        $this->view('admin/customer_report');

    }

    public function driverReport(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }

        $this->view('admin/driver_report');

    }

    
    public function mail(){
        $newMail = new reminderMail();
        $newMail->selectDriver();
    }


 }
 //echo " sample home page";
 ?>
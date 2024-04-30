<?php
require_once __DIR__ . '/../configs/config.php';

class officer extends Controller{
    public function index(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['title'] = "Officer";
        $this->view('Officer/dashboard',$data);
    }
    /*public function officerdriverRegistration(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];
        $add_standardFare = new Driverregistration();
        $rows = $add_standardFare->findAll();
        $data['rows'] = array();

        if(isset($rows[0])){
        for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
        }

        $data['title'] = "Officer";
        $this->view('Officer/officerdriverRegistration',$data);
    }*/


    //---------------------------Diver registration---------------------------
    public function officerdriverRegistration() {
        if (!Auth::logged_in()) {
            message('please login to view the admin section');
            redirect("login");
        }
    
        $add_driverregistration = new Driverregistration();
    
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : null;
    
        $data = [
            'status' => '0',
        ];
    
        if ($searchTerm !== null) {
            // If a search term is provided, perform a search
            $rows = $add_driverregistration->where1($data, $searchTerm);
        } else {
            // Otherwise, retrieve all drivers
            $rows = $add_driverregistration->where($data);
        }
    
        $data['rows'] = is_array($rows) ? $rows : [];
    
        $data['title'] = "officer";
        $this->view('Officer/officerdriverRegistration', $data);
    }

   /* public function driverregistrationDetail($id) {
        if(!Auth::logged_in()) {
            message('please login to view the admin section');
            redirect("login");
        }
        
        $driverregistration = new Driverregistration();
        $user = new User();
    
        // Build SQL query with join
        $sql = "SELECT dr.*, u.name 
                FROM driverregistration dr
                LEFT JOIN users u ON dr.id = u.id 
                WHERE dr.status = 0";
    
        // Execute the query
        $rows = $driverregistration->query($sql);
    
        // Check if rows are returned
        if (!$rows) {
            echo "No data found for driver registrations with status = 0";
            // Handle this case as needed, like redirecting or showing a message
        } else {
            // Proceed only if rows are not empty
            $data = [
                'title' => "driverRegistration",
                'rows' => $rows, // Pass the rows directly to the view
            ];
    
            $this->view('officer/officerdriverRegistration', $data);
        }
    }
    */
    
    
    
    
    



    

    public function driverregistrationDetail($id){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $driverregistration = new Driverregistration();
        $user = new User();

        $data = [
            'id' => $id
        ];
        $rows = $driverregistration->where($data);
        $row = (object) $rows[0];

        $driver = $row->id;
        $data2 = [
            'id' => $driver
        ];
        $rows2 = $user->where($data2);
        $row2 = null;
        if (is_array($rows2) && count($rows2) > 0) {
            $row2 = (object) $rows2[0];
        }

        $data = [
            'title' => "driverRegistration",
            'row' => $row,
            'row2' => $row2,
        ];

        $this->view('officer/officerdriverRegistration',$data);
        
    }


    

    
        /* if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];

        $add_standardFare = new standardFare();

        $rows = $add_standardFare->findAll();
        $data['rows'] = array();

        if(isset($rows[0])){
        for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
        }

        $data['title'] = "standardFare";
        $this->view('Officer/standardFare',$data);
        } */
    

    public function driverregistration_view($id){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $driverregistration = new Driverregistration();
        $user = new User();

        $data = [
            'id' => $id
        ];
        $rows = $driverregistration->where($data);
        $row = (object) $rows[0];

        /*$customer = $row->passenger_id;
        $data1 = [
            'id' => $customer
        ];
        $rows1 = $user->where($data1);
        $row1 = null;
        if (is_array($rows1) && count($rows1) > 0) {
            $row1 = (object) $rows1[0];
        }*/



        $driver = $row->id;
        $data2 = [
            'id' => $driver
        ];
        $rows2 = $user->where($data2);
        $row2 = null;
        if (is_array($rows2) && count($rows2) > 0) {
            $row2 = (object) $rows2[0];
        }

        $data = [
            'title' => "driverRegistration",
            'row' => $row,
            'row2' => $row2,
        ];

        $this->view('officer/officerDriverRegistration_view',$data);
        
    }

    public function RegistrationAccept($id){
        $new_driver = new OfficerDriverRegistration($GLOBALS['pdo']);
        $user = new OfficerDriver();

        $new_driver->updateDriverStatus($id);

        $data = [
            'id' => $id
        ];
        $rows = $new_driver->where($data);
        $row = (object) $rows[0];

        
        $driver = $row->id;
        $data2 = [
            'id' => $driver
        ];
        $rows2 = $user->where($data2);
        $row2 = null;
        if (is_array($rows2) && count($rows2) > 0) {
            $row2 = (object) $rows2[0];
        }

        $data = [
            'title' => "driverRegistration",
            'row' => $row,
            'row2' => $row2,
        ];


        $email = $row2->email;
        
        $new_driver->OfficerAcceptEmail($email);

        redirect('officer/officerdriverRegistration');

    }

    public function RegistrationReject($id){
        $new_driver = new OfficerDriverRegistration($GLOBALS['pdo']);
        $user = new OfficerDriver();

        $data = [
            'id' => $id
        ];
        $rows = $new_driver->where($data);
        $row = (object) $rows[0];

        
        $driver = $row->id;
        $data2 = [
            'id' => $driver
        ];
        $rows2 = $user->where($data2);
        $row2 = null;
        if (is_array($rows2) && count($rows2) > 0) {
            $row2 = (object) $rows2[0];
        }

        $data = [
            'title' => "driverRegistration",
            'row' => $row,
            'row2' => $row2,
        ];


        $email = $row2->email;
        $new_driver->officerrejectEmail($email);
        $new_driver->delete_rec($id);

        redirect('officer/officerdriverRegistration');
    }



    //-----------------Standard Fare--------------------------
    public function standardFare(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];

        $add_standardFare = new standardFare();

        $rows = $add_standardFare->findAll();
        $data['rows'] = array();

        if(isset($rows[0])){
        for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
        }

        $data['title'] = "standardFare";
        $this->view('Officer/standardFare',$data);
        }
    }


    public function standardFare_insert(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['errors'] = [];

        $add_standardFare = new standardFare();

        if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			if($add_standardFare->validate($_POST))
			{
                // $_POST['Fid'] =$add_standardFare->$Fid;
                // $_POST['faretype'] =$add_standardFare->$faretype;
                // $_POST['vehicletype'] =$add_standardFare->vehicletype;
                //  $_POST['fare'] =$add_standardFare->fare;
                //  $_POST['updatedby'] =$add_standardFare->updatedby;
                //  $_POST['date'] = $add_standardFare->date;
<<<<<<< HEAD
                 //$_POST['date'] = date("Y-m-d H:i:s");
=======
                 $_POST['date'] = date("Y-m-d H:i:s");
>>>>>>> main
                $add_standardFare->insert($_POST);
				redirect('officer/standardFare');
            }
        }
        $data['errors'] = $add_standardFare ->errors;
        $data['title'] = "standardFare";
        $this->view('officer/standardFare_form',$data);

    }

    public function standardFare_delete($Fid=null){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['errors'] = [];
        $add_standardFare = new standardFare();  

        $rows = $add_standardFare->findAll();
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
                $data['rows'][] = $rows[$i];
        }

        $add_standardFare->delete_standardFare($Fid);
        
        redirect('officer/standardFare');
    }



    public function standardFare_update($Fid=null){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['errors'] = [];
        $add_standardFare = new standardFare();
        $rows = $add_standardFare->findAll();
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
            if($rows[$i]->Fid == $Fid)
                $data['rows'][] = $rows[$i];
        }
        // show($_POST);
        if($_SERVER['REQUEST_METHOD'] == "POST")
		{
            
			if($add_standardFare->validate($_POST))
			{    
                // show($_POST);
                $_POST['Fid']=$Fid; 
                // show($_POST);           
                $add_standardFare->update_standardFare($Fid, $_POST);
                redirect('officer/standardFare');
            }
           
        }

        $data['title'] = "standardFare";
        $this->view('officer/standardFare_update',$data);
    }


    public function standardFare_View($Fid){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        
        $standardFare = new standardFare();

        $data = [
            'Fid' => $Fid
        ];
        $rows = $standardFare->where($data);
        $row = null;
        if (is_array($rows) && count($rows) > 0) {
            $row = (object) $rows[0];
        }
        

        $data = [
            'title' => "standardFare",
            'row' => $row,
            
        ];

        $this->view('officer/standardFare_view',$data);
    }

    
    public function getStandardFare($vehicleType) {
        
        $currentTime = date('H:i');

        
        $fareTimeRanges = [
            'traffic_time' => [
                ['start' => '06:30', 'end' => '09:00'],
                ['start' => '16:00', 'end' => '18:00'],
                ['start' => '12:00', 'end' => '14:00']
            ],
            'normal_time' => [
                ['start' => '09:00', 'end' => '12:00'],
                ['start' => '14:00', 'end' => '16:00'],
                ['start' => '18:00', 'end' => '22:00']
            ],
            'early_morning' => [
                ['start' => '00:00', 'end' => '06:30']
            ],
            'late_night' => [
                ['start' => '23:00', 'end' => '23:59']
            ]
        ];

        
        $fareType = '';
        foreach ($fareTimeRanges as $type => $ranges) {
            for ($i = 0; $i < count($ranges); $i += 2) {
                if ($currentTime >= $ranges[$i] && $currentTime <= $ranges[$i + 1]) {
                    $fareType = $type;
                    break 2;
                }
            }
        }

        
        $fareModel = new standardFare();
        $standardFare = $fareModel->getFareByTypeAndVehicle($fareType, $vehicleType);

        $this->view('officer/standardFare_view',$standardFare);
    }

    

    
/*----------------------------------*/


    /*     public function driver(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }

        $add_OfficerDriver = new OfficerDriver();

        $data = [
            'role' => "driver"
        ];

        $rows = $add_OfficerDriver->where($data);
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
        }

        $data['title'] = "Drivers";
        $this->view('officer/driver',$data);
    }*/

/*--------------------------complaint-----------------------------*/
    // public function complains(){
    //     if(!Auth::logged_in())
    //     {
    //         message('please login to view the page');
    //         redirect("login");
    //     }
    //     $data['errors'] = [];

    //     $add_complaint = new complaint();

    //     $rows = $add_complaint->findAll();
    //     $data['rows'] = array();

    //     if(isset($rows[0])){
    //     for($i = 0;$i < count($rows); $i++)
    //     {
    //         $data['rows'][] = $rows[$i];
    //     }

    //     }
    //     $data['title'] = "complains";
    //     $this->view('officer/complains',$data);
    // }


    public function complains(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }

        $add_complaint = new Complaint();

        $search = isset($_GET['sarch']) ? $_GET['search'] : null;

        $data = [
            'status_check' => "0",
        ];

        if($search !== null){
            $rows = $add_complaint->where2($data , $search);
        }else {
            // Otherwise, retrieve all
            $rows = $add_complaint->where($data);
        }

        $data['rows'] = is_array($rows) ? $rows : [];

       
        $data['title'] = "complaint";
        $this->view('officer/complains',$data);
        
    }

    // public function complains1(){
    //     if(!Auth::logged_in())
    //     {
    //         message('please login to view the admin section');
    //         redirect("login");
    //     }

    //     $add_complaint = new Complaint();

    //     $search = isset($_GET['sarch']) ? $_GET['search'] : null;

    //     $data = [
    //         'status_check' => "1",
    //     ];

    //     if($search !== null){
    //         $rows = $add_complaint->where2($data , $search);
    //     }else {
    //         // Otherwise, retrieve all
    //         $rows = $add_complaint->where($data);
    //     }

    //     $data['rows'] = is_array($rows) ? $rows : [];

       
    //     $data['title'] = "complaint";
    //     $this->view('officer/complains',$data);
        
    // }



    public function complainView($cmt_id){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $complaint = new Complaint();
        $user = new User();

        $data = [
            'cmt_id' => $cmt_id
        ];
        $rows = $complaint->where($data);
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
            'title' => "complaint",
            'row' => $row,
            'row1' => $row1,
            'row2' => $row2,
        ];

        $this->view('officer/complaint_view',$data);
    }

    public function complainViewI($cmt_id){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $complaint = new Complaint();
        $user = new User();

        $data = [
            'cmt_id' => $cmt_id
        ];
        $rows = $complaint->where($data);
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
            'title' => "complaint",
            'row' => $row,
            'row1' => $row1,
            'row2' => $row2,
        ];

        $this->view('officer/complaint_viewI',$data);
    }

    public function complainViewR($cmt_id){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $complaint = new Complaint();
        $user = new User();

        $data = [
            'cmt_id' => $cmt_id
        ];
        $rows = $complaint->where($data);
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
            'title' => "complaint",
            'row' => $row,
            'row1' => $row1,
            'row2' => $row2,
        ];

        $this->view('officer/complaint_viewR',$data);
    }


    public function add_comment($cmt_id=null){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['errors'] = [];
        $add_comment = new Complaint();
        $rows = $add_comment->findAll();
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
            if($rows[$i]->cmt_id == $cmt_id)
                $data['rows'][] = $rows[$i];
        }
        // show($_POST);
        if($_SERVER['REQUEST_METHOD'] == "POST")
		{
            
			if($add_comment->validate($_POST))
			{    
                // show($_POST);
                $_POST['cmt_id']=$cmt_id; 
                // show($_POST);           
                $add_comment->add_comment($cmt_id, $_POST);
                redirect('officer/complains');
            }
           
        }

        $data['title'] = "complaint";
        $this->view('officer/complaint_comment',$data);
    }

    public function add_commentI($cmt_id=null){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['errors'] = [];
        $add_comment = new Complaint();
        $rows = $add_comment->findAll();
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
            if($rows[$i]->cmt_id == $cmt_id)
                $data['rows'][] = $rows[$i];
        }
        // show($_POST);
        if($_SERVER['REQUEST_METHOD'] == "POST")
		{
            
			if($add_comment->validate($_POST))
			{    
                // show($_POST);
                $_POST['cmt_id']=$cmt_id; 
                // show($_POST);           
                $add_comment->add_comment($cmt_id, $_POST);
                redirect('officer/Icomplains');
            }
           
        }

        $data['title'] = "complaint";
        $this->view('officer/complaint_commentI',$data);
    }
    
    public function investigate($cmt_id){
        $investigate_complaint = new OfficerComplaint($GLOBALS['pdo']);

        $cmt_id = $cmt_id;
        $investigate_complaint->updateStatus($cmt_id);
        

        redirect('officer/complains');

    }


    public function reject($cmt_id){
        $reject_complaint = new OfficerComplaint($GLOBALS['pdo']);
        

        $cmt_id = $cmt_id;
        $reject_complaint->RejectUpdateStatus($cmt_id);
        
        

        redirect('officer/complains');

    }


    public function complainAnalays() {
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        
        $add_complaint = new Complaint();

        $pending = $add_complaint->getPendingCount();
        $investigated = $add_complaint->getInvestigatedCount();
        $rejected = $add_complaint->getRejectedCount();
        $total = $add_complaint->getCount();

        $data['pending'] = $pending;
        $data['investigated'] = $investigated;
        $data['rejected'] = $rejected;
        $data['total'] = $total;
        
        $this->view('officer/complainAnalys',$data);

    }

    public function rejectComplaint(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }

        $add_complaint = new Complaint();

        $search = isset($_GET['sarch']) ? $_GET['search'] : null;

        $data = [
            'status_check' => "2"
        ];

        if($search !== null){
            $rows = $add_complaint->where2($data , $search);
        }else {
            // Otherwise, retrieve all
            $rows = $add_complaint->where($data);
        }

        $data['rows'] = is_array($rows) ? $rows : [];

       
        $data['title'] = "complaint";
        $this->view('officer/rejectComplaint',$data);
        
    }

    public function investigatedComplaint(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }

        $add_complaint = new Complaint();

        $search = isset($_GET['sarch']) ? $_GET['search'] : null;

        $data = [
            'status_check' => "1"
        ];

        if($search !== null){
            $rows = $add_complaint->where2($data , $search);
        }else {
            // Otherwise, retrieve all
            $rows = $add_complaint->where($data);
        }

        $data['rows'] = is_array($rows) ? $rows : [];

       
        $data['title'] = "complaint";
        $this->view('officer/IComplaints',$data);
        
    }


    


    



        /*if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];

        $add_standardFare = new standardFare();

        $rows = $add_standardFare->findAll();
        $data['rows'] = array();

        if(isset($rows[0])){
        for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
        }

        $data['title'] = "standardFare";
        $this->view('Officer/standardFare_view',$data);
        }*/
    

    /*public function handleComplaint($passenger_id) {
        // Instantiate the Complain model
        $complainModel = new Complain();

        // Get passenger name from the model
        $passengerName = $complainModel->getpassengername($passenger_id);
    }*/

    /*---------------CUSTOMER-----------------------*/
    public function customer(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }

        $add_OfficerCustomer = new OfficerCustomer();

        $search = isset($_GET['sarch']) ? $_GET['search'] : null;

        $data = [
            'role' => "user"
        ];

        if($search !== null){
            $rows = $add_OfficerCustomer->where2($data , $search);
        }else {
            // Otherwise, retrieve all customers
            $rows = $add_OfficerCustomer->where($data);
        }

        

        //$rows = $add_OfficerDriver->where($data);
        //$data['rows'] = array();
        $data['rows'] = is_array($rows) ? $rows : [];

        /*for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
        }*/

        $data['title'] = "customers";
        $this->view('officer/customer',$data);
        
    }

    public function customer_View($id){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        
        $user = new User();
        $registration = new Driverregistration();

        $data = [
            'id' => $id
        ];
        $rows = $user->where($data);
        $row = null;
        if (is_array($rows) && count($rows) > 0) {
            $row = (object) $rows[0];
        }

        $customer = $row->id;
        $data1 = [
            'id' => $customer
        ];
        $rows1 = $registration->where($data1);
        $row1 = null;
        if (is_array($rows1) && count($rows1) > 0) {
            $row1 = (object) $rows1[0];
        }
        

        $data = [
            'title' => "driverreg",
            'row' => $row,
            'row1' => $row1,
            
        ];

        $this->view('officer/customer_view',$data);
    }

   
    
    /*public function driverdetail_view($id) {
        if (!Auth::logged_in()) {
            message('Please login to view the admin section');
            redirect("login");
        }
    
        // Fetch driver details from the user table
        $user = new User();
        $driver_data = $user->find($driver_id); // Assuming 'id' is the primary key in the user table
    
        if (!$driver_data) {
            // Handle case when driver does not exist
            message('Driver not found');
            redirect("some_page");
        }
    
        // Fetch complaints for the particular driver from the complain table
        $complaint = new Complain();
        $complaints = $complaint->where(['id' => $driver_id])->findAll();
    
        // Prepare data to pass to the view
        $data = [
            'driver_data' => $driver_data, // Driver details
            'complaints' => $complaints,   // Complaints for the driver
        ];
    
        $this->view('officer/driver_detail_view', $data);
    }*/

        



    public function customer_complain($id){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }

        $complaint = new Complaint();
    
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : null;
    
        $data = [
            'passenger_id' => $id,
        ];
    
        $rows = $complaint->where($data);
    
        $data['rows'] = is_array($rows) ? $rows : [];
    
        $data['title'] = "customercomplain";
        $this->view('officer/customer_complain', $data);
    }

    /* public function customer() {
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
    }*/
   
    


    


    
   

    /*public function search() {
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $model = new OfficerDriver();
            // $searchTerm = isset($_GET['search']) ? $_GET['search'] : null;
    
            $data = [
                'role' => 'driver',
            ];
            $data = $model->where1($data, $searchTerm);
            include 'driver.view.php';
        } else {
            // Redirect or handle the absence of search term
        }
    }*/

    public function searchCustomer() {

        $noMatchFound = false;

        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $add_customer = new OfficerCustomer();
            $data = [
                'role' => 'customer',
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
    
    
            $data['title'] = "customer";
            $data['noMatchFound'] = $noMatchFound;
            $this->view('officer/customerSearch', $data);
        }
    }

    public function suspendCustomer($email){
        $suspend_customer = new OfficerCustomerAction($GLOBALS['pdo']);

        $email = $email;
        $suspend_customer->updateCustomerStatus($email);
        //$suspend_driver->updateRegDate($email);
        $suspend_customer->OfficerConfirmEmail($email);

        redirect('officer/suspendCustomer2');

    }

    public function suspendCustomer2(){
        // if(!Auth::logged_in())
        // {
        //     message('please login to view the Officer section');
        //     redirect("login");
        // }

        $renew_customer = new OfficerCustomerAction($GLOBALS['pdo']);

        $data = [
            'role' => 'user'
        ];

        $rows = $renew_customer->where($data);
        $data['rows'] = array();

        if(isset($rows[0])){
            for($i = 0;$i < count($rows); $i++)
            {
                $data['rows'][] = $rows[$i];
            }

        $this->view('officer/customer',$data);
        }
    }
    


    
    /*-------------------DRIVER------------------------*/
    public function driver(){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }

        $add_OfficerDriver = new OfficerDriver();

        $search = isset($_GET['sarch']) ? $_GET['search'] : null;

        $data = [
            'role' => "driver"
        ];

        if($search !== null){
            $rows = $add_OfficerDriver->where2($data , $search);
        }else {
            // Otherwise, retrieve all customers
            $rows = $add_OfficerDriver->where($data);
        }

        

        //$rows = $add_OfficerDriver->where($data);
        //$data['rows'] = array();
        $data['rows'] = is_array($rows) ? $rows : [];

        /*for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
        }*/

        $data['title'] = "Drivers";
        $this->view('officer/driver',$data);
        
    }

   
    
    /*public function driverdetail_view($id) {
        if (!Auth::logged_in()) {
            message('Please login to view the admin section');
            redirect("login");
        }
    
        // Fetch driver details from the user table
        $user = new User();
        $driver_data = $user->find($driver_id); // Assuming 'id' is the primary key in the user table
    
        if (!$driver_data) {
            // Handle case when driver does not exist
            message('Driver not found');
            redirect("some_page");
        }
    
        // Fetch complaints for the particular driver from the complain table
        $complaint = new Complain();
        $complaints = $complaint->where(['id' => $driver_id])->findAll();
    
        // Prepare data to pass to the view
        $data = [
            'driver_data' => $driver_data, // Driver details
            'complaints' => $complaints,   // Complaints for the driver
        ];
    
        $this->view('officer/driver_detail_view', $data);
    }*/

    public function driver_View($id){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        
        $user = new User();
        $registration = new Driverregistration();

        $data = [
            'id' => $id
        ];
        $rows = $user->where($data);
        $row = null;
        if (is_array($rows) && count($rows) > 0) {
            $row = (object) $rows[0];
        }

        $driver = $row->id;
        $data1 = [
            'id' => $driver
        ];
        $rows1 = $registration->where($data1);
        $row1 = null;
        if (is_array($rows1) && count($rows1) > 0) {
            $row1 = (object) $rows1[0];
        }
        

        $data = [
            'title' => "driverreg",
            'row' => $row,
            'row1' => $row1,
            
        ];

        $this->view('officer/driver_view',$data);
    }


    public function driver_complain($id){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }

        $complaint = new Complaint();
    
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : null;
    
        $data = [
            'driver_id' => $id,
        ];
    
        $rows = $complaint->where($data);
    
        $data['rows'] = is_array($rows) ? $rows : [];
    
        $data['title'] = "drivercomplain";
        $this->view('officer/driver_complain', $data);
    }

    /* public function customer() {
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
    }*/
   
    


    


    
    public function driver_delete($id=null){
        if(!Auth::logged_in())
        {
            message('please login to view the admin section');
            redirect("login");
        }
        $data['errors'] = [];
        $add_OfficerDriver = new OfficerDriver();  

        $rows = $add_OfficerDriver->findAll();
        $data['rows'] = array();

        for($i = 0;$i < count($rows); $i++)
        {
                $data['rows'][] = $rows[$i];
        }

        $add_OfficerDriver->delete_driver($id);
        
        redirect('officer/driver');
    }

    /*public function search() {
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $model = new OfficerDriver();
            // $searchTerm = isset($_GET['search']) ? $_GET['search'] : null;
    
            $data = [
                'role' => 'driver',
            ];
            $data = $model->where1($data, $searchTerm);
            include 'driver.view.php';
        } else {
            // Redirect or handle the absence of search term
        }
    }*/

    public function searchDriver() {

        $noMatchFound = false;

        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $add_driver = new OfficerDriver();
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
    
    
            $data['title'] = "driver";
            $data['noMatchFound'] = $noMatchFound;
            $this->view('officer/driverSearch', $data);
        }
    }

    public function suspend($email){
        $suspend_driver = new OfficerDriverAction($GLOBALS['pdo']);

        $email = $email;
        $suspend_driver->updateDriverStatus($email);
        //$suspend_driver->updateRegDate($email);
        $suspend_driver->OfficerConfirmEmail($email);

        redirect('officer/suspendDriver');

    }

    public function suspendDriver(){
        // if(!Auth::logged_in())
        // {
        //     message('please login to view the Officer section');
        //     redirect("login");
        // }

        $renew_driver = new OfficerDriverAction($GLOBALS['pdo']);

        $data = [
            'role' => 'driver'
        ];

        $rows = $renew_driver->where($data);
        $data['rows'] = array();

        if(isset($rows[0])){
            for($i = 0;$i < count($rows); $i++)
            {
                $data['rows'][] = $rows[$i];
            }

        $this->view('officer/driver',$data);
        }
    }


    /*------------------------------------Renewal of driver registration---------------------------------------*/

    public function renewRegistration(){
        // if(!Auth::logged_in())
        // {
        //     message('please login to view the Officer section');
        //     redirect("login");
        // }

        $renew_driver = new renewRegistration($GLOBALS['pdo']);

        $data = [
            'status' => 0
        ];

        $rows = $renew_driver->where($data);
        $data['rows'] = array();

        if(isset($rows[0])){
            for($i = 0;$i < count($rows); $i++)
            {
                $data['rows'][] = $rows[$i];
            }

        $this->view('officer/driverRegistrationRenew',$data);
        }
    }

    public function openSlip($email){
        $pdfFileName = './assets/documents/paymentSlips/' . $email . 'slip.pdf';

        if (file_exists($pdfFileName)) {
            // Set the appropriate headers for PDF file
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . $email . '.pdf"');
            header('Content-Length: ' . filesize($pdfFileName));

            // Output the PDF file
            readfile($pdfFileName);
            exit;
        } else {
            // PDF file not found, handle error accordingly
            echo "PDF file not found for email: $email";
        }
    }

    public function renewAccept($email){
        $renew_driver = new renewRegistration($GLOBALS['pdo']);

        $email = $email;

        $renew_driver->updateStatus($email);
        $renew_driver->updateRegDate($email);
        $renew_driver->updateDate($email);
        $renew_driver->confirmEmail($email);

        redirect('officer/renewRegistration');

    }

    public function renewReject($email){
        $renew_driver = new renewRegistration($GLOBALS['pdo']);

        $renew_driver->rejectEmail($email);
        $renew_driver->deleteRequest($email);

        redirect('officer/renewRegistration');
    }



    

}

 //echo " sample home page";
 ?>
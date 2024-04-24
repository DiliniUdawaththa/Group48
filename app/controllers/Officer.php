<?php
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
    public function officerdriverRegistration(){
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
    }
    /*public function complains(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['title'] = "Officer";
        $this->view('Officer/complains',$data);
    }*/




    //Standard Fare
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
                /*$_POST['Fid'] =$add_standardFare->Fid;
                //$_POST['faretype'] =$add_standardFare->faretype;
                //$_POST['vehicletype'] =$add_standardFare->vehicletype;
                $_POST['fare'] =$add_standardFare->fare;
                $_POST['updatedby'] =$add_standardFare->updatedby;
                $_POST['date'] = $add_standardFare->date;
                // $_POST['date'] = date("Y-m-d H:i:s");*/
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


   public function standardFare_view($Fid){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];

        $add_standardFare = new standardFare();

        $rows = $add_standardFare->view_standardFare($Fid);
        $data['rows'] = array();

        if(isset($rows[0])){
        for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
        }
    }

        /*if($_SERVER['REQUEST_METHOD'] == "POST")
		{
            
			if($add_standardFare->validate($_POST))
			{    
                // show($_POST);
                $_POST['Fid']=$Fid; 
                // show($_POST);           
                $add_standardFare->view_standardFare($Fid);
                redirect('officer/standardFare');
            }
           
        }*/


        $data['title'] = "standardFare";
        $this->view('Officer/standardFare_view',$data);
        /*}*/
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

    public function complains(){
        if(!Auth::logged_in()) 
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['errors'] = [];

        $add_complain = new complain();

        $rows = $add_complain->getcomplaindetails();
        $data['rows'] = array();

        /*if(isset($rows[0])){
        for($i = 0;$i < count($rows); $i++)
        {
            $data['rows'][] = $rows[$i];
        }*/

        $data['title'] = "Officer";
        $this->view('Officer/complains',$data);
        
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

    
    public function customer_complain($passenger_id){
        if(!Auth::logged_in()) 
        {
            message('please login to view the page');
            redirect("login");
        }
        

        $data['title'] = "Officer";
        $this->view('Officer/customer_complains',$data);
    }

    public function driver_complain(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['title'] = "Officer";
        $this->view('Officer/driver_complain',$data);
    }


    
    
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
    } */

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

    public function search() {
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
    }

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

}

 //echo " sample home page";
 ?>
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
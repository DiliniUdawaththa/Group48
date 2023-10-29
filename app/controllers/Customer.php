<?php
 class Customer extends Controller{
    public function index(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['title'] = "Customer";
        $this->view('customer/ride',$data);
    }
 }
 //echo " sample home page";
 ?>
<?php
 class Driver extends Controller{
    public function index(){
        if(!Auth::logged_in())
        {
            message('please login to view the page');
            redirect("login");
        }
        $data['title'] = "Driver";
        $this->view('driver/ride',$data);
    }
 }
 //echo " sample home page";
 ?>
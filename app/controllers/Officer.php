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
 }
 //echo " sample home page";
 ?>
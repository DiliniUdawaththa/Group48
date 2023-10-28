<?php
 class Home extends Controller{
    public function index(){

      $db = new Database();
      $db->create_tables();
   
        $data['title'] = "HOME";
        $this->view('home',$data);
    }
 }
 //echo " sample home page";
 ?>
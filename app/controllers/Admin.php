<?php
 class Admin extends Controller{
    public function index(){

        $data['title'] = "ADMIN";
        $this->view('admin',$data);
    }
 }
 //echo " sample home page";
 ?>
<?php

class Login extends Controller
{
   public function index()
    {
          Auth::logout();
          redirect('home');
    }

}
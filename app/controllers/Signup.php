<?php 

/**
 * signup class
 */
class Signup extends Controller
{
	
	public function index()
	{
	
		$data['errors'] = [];

		$user = new User();
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			if($user->validate($_POST))
			{
				$_POST['role'] =$user->role;
				
				$_POST['date'] = date("Y-m-d H:i:s");
				$_POST["password"] = password_hash($_POST['password'],PASSWORD_DEFAULT);
				$user->insert($_POST);
			    message("Your profile was sucessfuly created. please login");
				redirect('login');
			}
		}
		$data['errors'] = $user->errors;
		$data['title'] = "Signup";

		$this->view('signup',$data);
	}
	
}
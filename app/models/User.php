<?php 

/**
 * users model
 */
class User extends Model
{
	
	public $errors = [];
	protected $table = "users";

	protected $allowedColumns = [

		'name',
		'phone',
		'email',
		'password',
		'term1',
		'term2',	
		'role',
		'date',
	];

	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['name']))
		{
			$this->errors['name'] = " name is required";
		}

		if(empty($data['phone']))
		{
			$this->errors['phone'] = "phone is required";
		}

		if(empty($data['email']) && FILTER_VALIDATE_EMAIL)
		{
			$this->errors['email'] = "Email is not valid";
		}else
		if($this->where(['email'=>$data['email']]))
		{
			$this->errors['email'] = "That email already exists";
		}

		if(empty($data['password']))
		{
			$this->errors['password'] = "A password is required";
		}

		// if($data['password'] !== $data['retype_password'])
		// {
		// 	$this->errors['password'] = "Passwords do not match";
		// }
		if(empty($data['term1']))
		{
			if(empty($data['term2']))
			    {$this->errors['term2'] = "Please accept the terms and conditions";}
		}
		if(!empty($data['term1']))
		{
			if(!empty($data['term2']))
			    {$this->errors['term2'] = "Please select one term";}
		}
		
		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

  
	
}
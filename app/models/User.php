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
		// 'term1',
		// 'term2',	
		'role',
		'date',
	];

	public function validate($data)
	{
		$this->role ='';
		$this->errors = [];

		
        if (empty($data['name'])) {
            $this->errors['name'] = "A  name is required.";
        } elseif (!preg_match("/^[a-zA-Z]+$/", trim($data['name']))) {
            $this->errors['name'] = "name can only have letters.";
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid.";
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

            $this->errors['email'] = "Email is not valid.";
        } elseif ($this->where(['email'=> $data['email']])) {
            $this->errors['email'] = "Email already exist.";
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required.";
        } elseif (strlen($data['password']) < 8) {
            $this->errors['password'] = "Password must be at least 8 characters long.";
        // } elseif ($data['Password'] !== $data['Password2']) {
        //     $this->errors['Password'] = "Passwords do not match.";
        }


		if (empty($data['phone'])) {
			$this->errors['phone'] = "Contact number is required.";
		} elseif (!preg_match("/^[0-9]+$/", $data['phone'])) {
			$this->errors['phone'] = "Contact number can only have numbers.";
		} elseif (strlen($data['phone']) < 10) {
			$this->errors['phone'] = "Contact number must be  10 digits long.";
		} elseif (strlen($data['phone']) >10) {
			$this->errors['phone'] = "Contact number must be  10 digits long.";
		}
		


		// show($data['term1']);
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
		if(empty($data['term1']))
		{
			  $this->role = 'driver';
		}
		if(empty($data['term2']))
		{
			$this->role = 'user';

		}
		// show($this->role);
		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

  
	
}
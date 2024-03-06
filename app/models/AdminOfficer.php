<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'emails/src/Exception.php';
// require 'emails/src/PHPMailer.php';
// require 'emails/src/SMTP.php';


class AdminOfficer extends Model{
    public $errors = [];
	protected $table = "addofficer";

	protected $allowedColumns = [

		'empID',
		'name',
		'email',
		'phone',
	];

    public function addOfficerTable($data)
	{
		$this->errors = [];

        // show($data['empID']);
        $this->empID = $data['empID'];
        $this->Name = $data['name'];
        $this->Email = $data['email'];
        $this->Mobile = $data['phone'];

       // show($this->empID);

        if ($this->where(['empID'=> $data['empID']])) {
            $this->errors['empID'] = "Employee ID already exist.";
        }

        if (!preg_match("/^[a-zA-Z\s]+$/", trim($data['name']))) {
             $this->errors['name'] = "name can only have letters.";
        }
        // elseif ($this->where(['Name'=> $data['Name']])) {
        //      $this->errors['Name'] = "name already exist.";
        // }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid.";
        } elseif ($this->where(['email'=> $data['email']])) {
            $this->errors['email'] = "Email already exist.";
        }

        if (empty($data['phone'])) {
			$this->errors['phone'] = "Contact number is required.";
		} elseif (!preg_match("/^[0-9]+$/", $data['phone'])) {
			$this->errors['phone'] = "Contact number can only have numbers.";
		} elseif (strlen($data['phone']) < 10) {
			$this->errors['phone'] = "Contact number must be  10 digits long.";
		} elseif (strlen($data['phone']) >10) {
			$this->errors['phone'] = "Contact number must be  10 digits long.";
		} elseif ($this->where(['phone'=> $data['phone']])) {
             $this->errors['phone'] = "Mobile number already exist.";
        }

        if(empty($this->errors))
		{
            // show($_POST);
			return true;
		}
        // show($_POST);
		return false;
	}

    


}
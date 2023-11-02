<?php

class Officer extends Model{
    public $errors = [];
	protected $table = "addofficer";

	protected $allowedColumns = [

		'empID',
		'Name',
		'Email',
		'Mobile',
	];

    public function validate($data)
	{
		$this->errors = [];

        if (!preg_match("/^[a-zA-Z]+$/", trim($data['Name']))) {
             $this->errors['Name'] = "name can only have letters.";
        }elseif ($this->where(['Name'=> $data['Name']])) {
             $this->errors['Name'] = "name already exist.";
        }

        if (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['Email'] = "Email is not valid.";
        }

        if (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {

            $this->errors['Email'] = "Email is not valid.";
        } elseif ($this->where(['Email'=> $data['Email']])) {
            $this->errors['Email'] = "Email already exist.";
        }

        if (empty($data['Mobile'])) {
			$this->errors['Mobile'] = "Contact number is required.";
		} elseif (!preg_match("/^[0-9]+$/", $data['Mobile'])) {
			$this->errors['Mobile'] = "Contact number can only have numbers.";
		} elseif (strlen($data['Mobile']) < 10) {
			$this->errors['Mobile'] = "Contact number must be  10 digits long.";
		} elseif (strlen($data['Mobile']) >10) {
			$this->errors['Mobile'] = "Contact number must be  10 digits long.";
		}

        if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

    public function delete_addofficer($empID = null)
    {
        $query = "delete from $this->table where empID = :empID;";

        return $this->query($query,['empID' => $empID]);
    }


}
<?php

class AdminOfficer extends Model{
    public $errors = [];
	protected $table = "addofficer";

	protected $allowedColumns = [

		'empID',
		'name',
		'email',
		'phone',
        'password',
	];

    public function validate($data)
	{
		$this->errors = [];

        // show($data['empID']);
        $this->empID = $data['empID'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->password = '12345678';

       // show($this->empID);

        // if ($this->where(['empID'=> $data['empID']])) {
        //     $this->errors['empID'] = "Employee ID already exist.";
        // }

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

    public function delete_addofficer($empID = null)
    {
        $query = "delete from $this->table where empID = :empID;";

        return $this->query($query,['empID' => $empID]);
    }

    public function update_addofficer($empID, $data)
    {
        // $query = $this->update($empID, $data);
        // $conditions = ['empID' => $empID];
        // $query = $this->update($conditions, $data);
        // return $query;
        
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
    
        $keys = array_keys($data);
        // $id = array_search($id, $data);
    
        $query = "update " . $this->table . " set ";
        foreach ($keys as $key) {
            $query .= $key . "=:" . $key . ",";
        }
        $query = trim($query, ",");
        $query .= " where empID = :empID";
        // print_r($query);	
    
    
        $this->query($query, $data);
        
    }


}
<?php 

class standardFare extends Model
{
	
	public $errors = [];
	protected $table = "standardFare";

	protected $allowedColumns = [
        'Fid',
        'faretype',
        'vehicletype',
        'fare',
        'updatedby',
        'date',
	];

    public function validate($data)
	{
		$this->errors = [];

        /*if(empty($data['faretype'])) {
            $this->errors['faretype'] = "Fare type is required.";
        } elseif(!in_array($data['faretype'], $this->getAvailableFareTypes())) {
            $this->errors['faretype'] = "Invalid fare type selected.";
        }
        
        if(empty($data['vehicletype'])) {
            $this->errors['vehicletype'] = "Vehicle type is required.";
        } elseif(!in_array($data['vehicletype'], $this->getAvailableVehicleTypes())) {
            $this->errors['vehicletype'] = "Invalid Vehicle type selected.";
        }

        if(empty($data['fare'])) {
            $this->errors['fare'] = "Fare is required.";
        } elseif(!is_numeric($data['fare'])) {
            $this->errors['fare'] = "Fare must be a numeric value.";
        }

        if (!filter_var($data['updatedby'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['updatedby'] = "Email is not valid.";
        } elseif ($this->where(['updatedby'=> $data['updatedby']])) {
            $this->errors['updatedby'] = "Email already exist.";
        }*/

        if(empty($this->errors))
		{
            // show($_POST);
			return true;
		}
        // show($_POST);
		return false;
	}

    /*public function getAvailableFareTypes()
    {
        return['Heavy Trafic Time', 'Trafic Time', 'Late Night & Early Morning', 'Normal'];
    }

    public function getAvailableVehicleTypes()
    {
        return['Bike', 'Three-Weel', 'Car(Non A/C)', 'Car(A/C)', 'Mini-Van'];
    }*/

    public function delete_standardFare($Fid = null)
    {
        $query = "delete from $this->table where Fid = :Fid;";

        return $this->query($query,['Fid' => $Fid]);
    }

    public function update_standardFare($Fid, $data)
	{
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {
				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		// $Fid = array_search($Fid, $data);

		$query = "update " . $this->table . " set ";
		foreach ($keys as $key) {
			$query .= $key . "=:" . $key . ",";
		}
		$query = trim($query, ",");
		$query .= " where Fid = :Fid";
		// print_r($query);	


		$this->query($query, $data);
	}

    public function view_standardFare($Fid)
    {
       
        
        $query = "SELECT * FROM " . $this->table . " where Fid = :Fid";
        $params = array(":Fid" => $Fid);
        

        $result = $this->query($query, $params);

        return $result;
        
    
    }

}
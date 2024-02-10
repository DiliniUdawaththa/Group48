<?php 

class standardFare extends Model
{
	
	public $errors = [];
	protected $table = "standardFare";

	protected $allowedColumns = [

        'id'
		'faretype',
		'vehicletype',
        'fare',
        'updatedby',
        'date',
	];

	public function validate($data)
	{
		$this->errors = [];

        if(empty($data['faretype'])) {
            $this->errors['faretype'] = "Fare type is required.";
        } elseif(!in_array($data['faretype'], $this->getavAilableFareTypes())) {
            $this->errors['faretype'] = "Invalid fare type selected.";
        }
        
        if(empty($data['vehicletype'])) {
            $this->errors['vehicletype'] = "Vehicle type is required.";
        } elseif(!in_array($data['vehicletype'], $this->getavAilableVehicleTypes())) {
            $this->errors['vehicletype'] = "Invalid Vehicle type selected.";
        }

        if(empty($data['fare'])) {
            $this->errors['fare'] = "Fare is required.";
        } elseif(!is_numeric($data['fare'])) {
            $this->errors['fare'] = "Fare must be a numeric value.";
        }

        if (!filter_var($data['updatedby'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['updatedby'] = "Email is not valid.";
        }
        if (!filter_var($data['updatedby'], FILTER_VALIDATE_EMAIL)) {

            $this->errors['updatedby'] = "Email is not valid.";
        } elseif ($this->where(['updatedby'=> $data['updatedby']])) {
            $this->errors['updatedby'] = "Email already exist.";
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
            // show($_POST);
			return true;
		}
        // show($_POST);
		return false;
	}

    public function getavAilableFareTypes()
    {
        return['Heavy Trafic time', 'Trafic Time', 'Late Night & Early Morning', 'Normal'];
    }

    public function getavAilableVehicleTypes()
    {
        return['Bike', 'Three-Weel', 'Car(Non A/C)', 'Car(A/C)', 'Mini Van'];
    }

    public function delete_standardFare($id = null)
    {
        $query = "delete from $this->table where id = :id;";

        return $this->query($query,['id' => $id]);
    }

    public function update_standardFare($id, $data)
    {
        $query = $this->update($id, $data);
        return $query;
        
    }


}

}
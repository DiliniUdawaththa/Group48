<?php 

/**
 * vehicle model
 */
class Vehicle extends Model
{
    protected $table = "vehicle";

    protected $allowedColumns = [

		'licenseplate',
		'owner',
		'type',
		'color',

	];
    public function validate($data)
	{
		$this->role ='';
		$this->errors = [];

		if(empty($data['licenseplate']))
		{
			$this->errors['licenseplate'] = "License Plate number is required";
		}else 
		if($this->where(['licenseplate'=>$data['licenseplate']]))
		{
			$this->errors['licenseplate'] = "That vehicle already exists";
		}elseif(strlen(str_replace(' ', '', $data['licenseplate'])) != 6){
			$this->errors['licenseplate'] = "Invalid License plate";
		}

		if(empty($data['type']))
		{
			$this->errors['type']= "Type is required";
		}
		

	
		// show($this->role);
		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

	public function first_veh($data)
	{

		$keys = array_keys($data);

		$query = "select * from ".$this->table." where ";

		foreach ($keys as $key) {
			$query .= $key . "=:" . $key . " && ";
		}
 
 		$query = trim($query,"&& ");
 		$query .= " order by licenseplate desc limit 1";

		$res = $this->query($query,$data);

		if(is_array($res))
		{
			return $res[0];
		}

		return false;

	}




}
	
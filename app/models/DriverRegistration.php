<?php 

/**
 * users model
 */
class Driverregistration extends Model
{
	
	public $errors = [];
	protected $table = "driverregistration";

	protected $allowedColumns = [

		'id',
		'date',
		'profileimg',
		'driverlicenseimg',
		'revenuelicenseimg',
		'vehregistrationimg',
		'vehinsuranceimg',
		'status',
	];

	public function findTop5() {
		$sql = "SELECT * FROM $this->table ORDER BY reg_id DESC LIMIT 5";
		return $this->query($sql);
	}

	public function findById($id) {
		$sql = "SELECT * FROM $this->table WHERE reg_id = ?";
		$params = [$id];
		$result = $this->query($sql, $params);

		if($result && count($result)>0) {
			return $result[0];
		} else {
			return false;
		}
	}


}
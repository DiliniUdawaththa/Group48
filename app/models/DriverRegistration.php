<?php 

/**
 * users model
 */
class Driverregistration extends Model
{
	
	public $errors = [];
	protected $table = "driverregistration";

	protected $allowedColumns = [

		'email',
		'profileimg',
		'driverlicenseimg',
		'revenuelicenseimg',
		'vehregistrationimg',
		'vehinsuranceimg',
		'status',
		'id',
	];

	public function findTop5() {
		$sql = "SELECT * FROM $this->table WHERE status = 0 ORDER BY id DESC LIMIT 3";
		return $this->query($sql);
	}

	public function getPendingRCount() {
		$result = $this->query("SELECT COUNT(*) as count FROM driverregistration WHERE status = '0';");
		return $result[0]->count;
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
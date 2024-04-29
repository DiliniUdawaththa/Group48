<?php 

class Complaint extends Model
{
	
	public $errors = [];
	protected $table = "complaint";

	protected $allowedColumns = [
        'cmt_id',
        'complainant',
        'passenger_id',
        'driver_id',
        'datetime',
        'complaint',
        'status_check',
        'file_path',
		'officerCmnt', 
	];

    public function validate($data)
	{
		$this->errors = [];

		if(empty($this->errors))
		{
            // show($_POST);
			return true;
		}
        // show($_POST);
		return false;

    }

    public function findTop5() {
      $sql = "SELECT * FROM $this->table ORDER BY cmt_id DESC LIMIT 5";
      return $this->query($sql);
    }

	public function getPendingCount() {
		$result = $this->query("SELECT COUNT(*) as count FROM complaint WHERE status_check = '0';");
		return $result[0]->count;
	  }

	  public function getInvestigatedCount() {
		$result = $this->query("SELECT COUNT(*) as count1 FROM complaint WHERE status_check = '1';");
	
		return $result[0]->count1;
	}

	public function getRejectedCount() {
		$result = $this->query("SELECT COUNT(*) as count2 FROM complaint WHERE status_check = '2';");
	
		return $result[0]->count2;
	}
	
	public function getCount() {
		$result = $this->query("SELECT COUNT(*) as count3 FROM complaint;");
	
		return $result[0]->count3;
	} 
	 
	 
	 

    public function add_comment($cmt_id, $data)
	{
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {
				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}


		$keys = array_keys($data);
		// $cmt_id = array_search($cmt_id, $data);

		$query = "update " . $this->table . " set ";
		foreach ($keys as $key) {
			$query .= $key . "=:" . $key . ",";
		}
		$query = trim($query, ",");
		$query .= " where cmt_id = :cmt_id";
		// print_r($query);	


		$this->query($query, $data);
	}

	//new-------------


}
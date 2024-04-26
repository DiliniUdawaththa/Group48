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
	];

    public function validate($data)
	{
		$this->errors = [];

    }

    public function findTop5() {
      $sql = "SELECT * FROM $this->table ORDER BY cmt_id DESC LIMIT 3";
      return $this->query($sql);
    }

}
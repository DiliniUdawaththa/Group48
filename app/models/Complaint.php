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
	];

    public function validate($data)
	{
		$this->errors = [];

    }

}
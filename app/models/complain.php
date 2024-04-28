<?php 

class complain extends Model
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

        if(empty($this->errors))
		{
            // show($_POST);
			return true;
		}
        // show($_POST);
		return false;
	}



}
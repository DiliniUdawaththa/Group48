<?php 


class rating extends Model
{
	
	public $errors = [];
	protected $table = "rating";

	protected $allowedColumns = [
        'rate_id',
        'role_id',
        'role',
        'rate',
	];

    public function validate($data)
	{
		$this->errors = [];

    }

}
<?php 

/**
 * users model
 */
class Add_Place extends Model
{
	
	public $errors = [];
	protected $table = "message";

	protected $allowedColumns = [
        'id',
        'role',
        'message',
	];

    public function validate($data)
	{
		$this->errors = [];

    }

}
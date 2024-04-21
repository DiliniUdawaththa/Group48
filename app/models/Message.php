<?php 

/**
 * users model
 */
class Message extends Model
{
	
	public $errors = [];
	protected $table = "message";

	protected $allowedColumns = [
        'ride_id',
        'sender',
		'passenger_id',
		'driver_id',
        'message',
	];

    public function validate($data)
	{
		$this->errors = [];

    }

}
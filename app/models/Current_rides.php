<?php 

/**
 * users model
 */
class Current_rides extends Model
{
	
	public $errors = [];
	protected $table = "current_rides";

	protected $allowedColumns = [
        'id',
        'passenger_id',
		'location',
		'l_lat',
		'l_long',
		'destination',
        'd_lat',
        'd_long',
        'vehicle',
	];

    public function validate($data)
	{
		
	}
   
}
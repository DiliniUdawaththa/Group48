<?php 

/**
 * users model
 */
class Rides extends Model
{
	
	public $errors = [];
	protected $table = "rides";

	protected $allowedColumns = [
        'id',
        'passenger_id',
		'driver_id',
        'date',
		'location',
		'l_lat',
		'l_long',
		'destination',
        'd_lat',
        'd_long',
        'vehicle',
		'time',
		'distance',
        'fare',
        'state',
	];

    public function validate($data)
	{
		
	}
   
}
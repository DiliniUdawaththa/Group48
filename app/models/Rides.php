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
		'm_lat',
        'm_long',
        'vehicle',
		'time',
		'distance',
        'fare',
        'state',
		'passenger_cancel',
		'driver_cancel',
	];

    public function validate($data)
	{
		
	}
   
}
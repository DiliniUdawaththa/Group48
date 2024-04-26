<?php 

/**
 * users model
 */
class Offers extends Model
{
	
	public $errors = [];
	protected $table = "offers";

	protected $allowedColumns = [
        'ride_id',
		'driver_id',
        'offer_price',
		'negotiation_status',
		'negotiation_price',
	];

    public function validate($data)
	{
		
	}
   
}
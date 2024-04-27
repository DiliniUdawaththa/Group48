<?php 


class offers extends Model
{
	
	public $errors = [];
	protected $table = "offers";

	protected $allowedColumns = [
        'ride_id',
        'driver_id',
        'offer_price',
        'negotiation_status',
        'negotiation_price',
        'accept_status'
	];

    public function validate($data)
	{
		$this->errors = [];

    }

}
<?php 

/**
 * users model
 */
class Driverregistration extends Model
{
	
	public $errors = [];
	protected $table = "driverregistration";

	protected $allowedColumns = [

		'email',
		'profileimg',
		'driverlicenseimg',
		'revenuelicenseimg',
		'vehregistrationimg',
		'vehinsuranceimg',
		'status',
	];


}
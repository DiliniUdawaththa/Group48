<?php 

/**
 * users model
 */
class Driverregistration extends Model
{
	
	public $errors = [];
	protected $table = "driverregistrationdetails";

	protected $allowedColumns = [

		'reg_id',
		'driverName',
		'email',
		'contactNumber',
		'address',
		'dob',
		'nicNo',
		'licenceNo',
		'nicCopy',
		'licenceCopy',
		'policeReport',
		'status',
	];


}
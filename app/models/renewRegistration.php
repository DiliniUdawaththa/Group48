<?php

class renewRegistration extends Model{
    public $errors = [];
	protected $table = "renewregistration";

	protected $allowedColumns = [

		'email',
        'name',
		'status',
	];

}
<?php 

/**
 * users model
 */
class Profile extends Model
{
	
	public $errors = [];
	protected $table = "profile";

	protected $allowedColumns = [
        'id',
        'image_path',
        'uploaded_on',
	];

    public function validate($data)
	{
		
	}
   
}
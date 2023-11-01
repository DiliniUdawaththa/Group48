<?php 

/**
 * users model
 */
class Add_Place extends Model
{
	
	public $errors = [];
	protected $table = "addplace";

	protected $allowedColumns = [

		'name',
		'category',
		'icon',
		'address',
		'date',
	];

    public function validate($data)
	{
		$this->errors = [];

        if (!preg_match("/^[a-zA-Z]+$/", trim($data['name']))) {
            $this->errors['name'] = "name can only have letters.";
        }elseif ($this->where(['name'=> $data['name']])) {
            $this->errors['name'] = "name already exist.";
        }

        

        if(empty($this->errors))
		{
			return true;
		}

		return false;
	}
    public function fit_icon($data){
        $this->icon='';
        if($data['category']=="Home"){
            $this->icon= "fa-solid fa-house";
        }elseif($data["category"]== "Food & Drink"){
            $this->icon= "fa-solid fa-utensils";
        }else if($data['category']=="Shopping"){
            $this->icon= "fa-solid fa-bag-shopping";
        }elseif($data["category"]== "Education"){
            $this->icon= "fa-solid fa-graduation-cap";
        }else if($data['category']=="Religion"){
            $this->icon= "<fa-solid fa-hands-praying";
        }elseif($data["category"]== "Hotels & lodging"){
            $this->icon= "fa-solid fa-hotel";
        }else if($data['category']=="Hospital"){
            $this->icon= "fa-solid fa-hospital";
        }elseif($data["category"]== "Bank"){
            $this->icon= "fa-solid fa-building-columns";
        }else if($data['category']=="Office"){
            $this->icon= "fa-solid fa-briefcase";
        }elseif($data["category"]== "Other"){
            $this->icon= "fa-solid fa-globe";
        }
       
    }

}
<?php

class officerrenew extends Model{
    public $errors = [];

	protected $table = "renewregistration";

    public function renewcount() {
        $results = $this->query("SELECT COUNT(*) as count FROM renewregistration WHERE status = '0';");
    
        return $results[0]->count;

    }

    

}
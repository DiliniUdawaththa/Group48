<?php

class OfficerDriver extends Model{
    protected $table = "users";
    
    public function delete_driver($id = null)
    {
        $query = "delete from $this->table where id = :id;";
    
        return $this->query($query,['id' => $id]);
    }

}
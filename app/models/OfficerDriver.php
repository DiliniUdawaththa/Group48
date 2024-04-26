<?php


class OfficerDriver extends Model{
    public $errors = [];

    protected $table = "users";

   

    public function getDriverCount() {
        $results = $this->query("SELECT COUNT(*) as count FROM users WHERE role = 'driver';");
    
        return $results[0]->count;
    }
    
    public function delete_driver($id = null)
    {
        $query = "delete from $this->table where id = :id;";
    
        return $this->query($query,['id' => $id]);
    }

    public function whereLike($data, $searchTerm)
    {
        $keys = array_keys($data);
        $query = "SELECT * FROM " . $this->table . " WHERE role = 'driver' AND (";

        if (!empty($keys) && !empty($searchTerm)) {
            foreach ($keys as $key) {
                // Construct the condition for case-insensitive and partial matching
                $query .= "LOWER(" . $key . ") LIKE '%" . strtolower($searchTerm) . "%' OR ";
            }
            $query = rtrim($query, "OR ") . ")";
        } else {
            // If no search term provided, return all records
            $query .= "1=1";
        }

        // Execute the query
        $res = $this->query($query);

        if (is_array($res)) {
            return $res;
        }
        return false;

        //echo "No matching results found.." ;
    }

  

}
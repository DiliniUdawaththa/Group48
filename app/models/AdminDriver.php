<?php

class AdminDriver extends Model{
    protected $table = "users";

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
        echo("No matching results found..");
    }

    public function countExpiringDrivers() {
        $data = [
            'role' => "driver"
        ];
    
        $drivers = $this->where($data);
        $expiringDriverCount = 0;
    
        // Calculate the reminder date as 7 days ahead of the current date
        $reminderDate = date('Y-m-d', strtotime('+7 days'));
    
        // Loop through each driver to calculate deadline
        foreach ($drivers as $driver) {
            $deadline = date('Y-m-d', strtotime('+1 year', strtotime($driver->date)));
    
            // Check if the deadline is within the next seven days
            if ($deadline >= date('Y-m-d') && $deadline <= $reminderDate) {
                $expiringDriverCount++;
            }
        }
    
        return $expiringDriverCount;
    }
    

    
}
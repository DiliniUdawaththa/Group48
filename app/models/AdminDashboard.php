<?php

class AdminDashboard extends Model{
    protected $table = "users";
    protected $table1 = "driverregistration";

    public function getRoleCounts() {
        $results = $this->query("SELECT role, COUNT(*) as count FROM users GROUP BY role;");
        
        $roleCounts = [
            'admin' => 0,
            'customer' => 0,
            'driver' => 0,
            'officer' => 0
        ];
    
        foreach ($results as $result) {
            $role = $result->role;
            $count = $result->count;
    
            $roleLabels = [
                'admin' => 'admin',
                'user' => 'customer',
                'driver' => 'driver',
                'officer' => 'officer'
            ];
    
            $roleLabel = $roleLabels[$role] ?? $role;
    
            $roleCounts[$roleLabel] = $count;
        }
    
        return $roleCounts;
    }

    public function countUsersByMonth() {
        $currentYear = date('Y');
        $query = "SELECT COUNT(*) as user_count, MONTH(date) as month 
                  FROM users 
                  WHERE role = 'user' 
                  AND YEAR(date) = :year
                  GROUP BY MONTH(date)";
        
        $params = [':year' => $currentYear];
        $results = $this->query($query, $params);
    
        $userCounts = [];
    
        if($results !== false){
            foreach ($results as $result) {
                $month = $result->month;
                $count = $result->user_count;
        
                $userCounts[$month] = $count;
            }
        }
    
        return $userCounts;
    }
    

    public function countDriversByMonth() {
        $currentYear = date('Y');
        $query = "SELECT COUNT(*) as driver_count, MONTH(date) as month 
                  FROM driverregistration
                  WHERE YEAR(date) = :year
                  GROUP BY MONTH(date)";
        
        $params = [':year' => $currentYear];
        $results = $this->query($query, $params);
    
        // Check if $results is a valid result set
        if ($results !== false) {
            $driverCounts = [];
    
            foreach ($results as $result) {
                $month = $result->month;
                $count = $result->driver_count;
    
                $driverCounts[$month] = $count;
            }
    
            return $driverCounts;
        } else {
            // Handle the case where the query failed
            return [];
        }
    }
    
    
    
    
}
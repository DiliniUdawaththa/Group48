<?php

class AdminDashboard extends Model{
    protected $table = "users";

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
        $query = "SELECT COUNT(*) as user_count, MONTH(date) as month 
                  FROM users 
                  WHERE role = 'user' 
                  GROUP BY MONTH(date)";
        
        $results = $this->query($query);
    
        $userCounts = [];
    
        foreach ($results as $result) {
            $month = $result->month;
            $count = $result->user_count;
    
            $userCounts[$month] = $count;
        }
    
        return $userCounts;
    }
    

    public function countDriversByMonth() {
        $query = "SELECT COUNT(*) as driver_count, MONTH(date) as month 
                  FROM users 
                  WHERE role = 'driver' 
                  GROUP BY MONTH(date)";
        $results = $this->query($query);
    
        $driverCounts = [];
    
        foreach ($results as $result) {
            $month = $result->month;
            $count = $result->driver_count;
    
            $driverCounts[$month] = $count;
        }
    
        return $driverCounts;
    }
    
    
    
}
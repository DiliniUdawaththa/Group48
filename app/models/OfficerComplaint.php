<?php

class OfficerComplaint extends Model{
    protected $table = "complaint";

    public function countcomplaint(){
        $result = $this->query("SELECT COUNT(*) as complaint_count FROM complaint");
        if ($result && isset($result[0]->complaint_count)) {
            return $result[0]->complaint_count; 
        } else {
            return 0; 
        }
    }
    
    public function countComplaintByDay() {
        $startDate = date('Y-m-d', strtotime('last sunday'));
    
        $endDate = date('Y-m-d', strtotime('next sunday'));
    
        $query = "SELECT COUNT(*) as complaint_count, 
                  CASE 
                      WHEN DAYOFWEEK(date) = 1 THEN 1
                      ELSE DAYOFWEEK(date)
                  END as weekday 
                  FROM complaint 
                  WHERE date >= :startDate AND date <= :endDate
                  GROUP BY WEEKDAY(date)";
    
        // Bind parameters to prevent SQL injection
        $params = [
            ':startDate' => $startDate,
            ':endDate' => $endDate
        ];
    
        $results = $this->query($query, $params);
    
        $complaintCounts = [];
    
        // Initialize rideCounts array with counts initialized to 0 for all weekdays
        for ($i = 0; $i < 7; $i++) {
            $complaintCounts[$i + 1] = 0;
        }
    
        // Populate rideCounts with counts from the database results
        foreach ($results as $result) {
            $weekday = $result->weekday;
            $count = $result->ride_count;
    
            $rideCounts[$weekday] = $count;
        }
    
        return $complaintCounts;
    }
    
    

    public function searchComplaint($date) {
        $result = $this->query("SELECT * FROM complaint WHERE DATE(date) = :date", array(':date' => $date));

        if ($result) {
            return $result;
        } else {
            return []; 
        }
    }

    public function countRideByDate($date){
        $result = $this->query("SELECT COUNT(*) as ride_count FROM rides WHERE DATE(date) = :date", array(':date' => $date));

        if ($result && isset($result[0]->ride_count)) {
            return $result[0]->ride_count;
        } else {
            return 0;
        }
    }
           
}
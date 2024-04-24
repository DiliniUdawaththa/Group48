<?php

class AdminRide extends Model{
    protected $table = "rides";

    public function countRide(){
        $result = $this->query("SELECT COUNT(*) as ride_count FROM rides");
        if ($result && isset($result[0]->ride_count)) {
            return $result[0]->ride_count; 
        } else {
            return 0; 
        }
    }
    
    public function countRidesByDay() {
        $startDate = date('Y-m-d', strtotime('last sunday'));
    
        $endDate = date('Y-m-d', strtotime('next sunday'));
    
        $query = "SELECT COUNT(*) as ride_count, 
                  CASE 
                      WHEN DAYOFWEEK(date) = 1 THEN 1
                      ELSE DAYOFWEEK(date)
                  END as weekday 
                  FROM rides 
                  WHERE date >= :startDate AND date <= :endDate
                  GROUP BY WEEKDAY(date)";
    
        // Bind parameters to prevent SQL injection
        $params = [
            ':startDate' => $startDate,
            ':endDate' => $endDate
        ];
    
        $results = $this->query($query, $params);
    
        $rideCounts = [];
    
        // Initialize rideCounts array with counts initialized to 0 for all weekdays
        for ($i = 0; $i < 7; $i++) {
            $rideCounts[$i + 1] = 0;
        }
    
        // Populate rideCounts with counts from the database results
        foreach ($results as $result) {
            $weekday = $result->weekday;
            $count = $result->ride_count;
    
            $rideCounts[$weekday] = $count;
        }
    
        return $rideCounts;
    }
    
    public function countRidesByMorning() {
        // Define start and end times for the day period
        $dayStart = '06:00:00';
        $dayEnd = '18:00:00';
    
        $startDate = date('Y-m-d', strtotime('last sunday'));
        $endDate = date('Y-m-d', strtotime('next sunday'));
    
        $query = "SELECT 
                      CASE 
                          WHEN DAYOFWEEK(date) = 1 THEN 1
                          ELSE DAYOFWEEK(date)
                      END as weekday,
                      SUM(CASE WHEN TIME(date) BETWEEN :dayStart AND :dayEnd THEN 1 ELSE 0 END) as day_count
                  FROM rides 
                  WHERE date >= :startDate AND date <= :endDate
                  GROUP BY WEEKDAY(date)";
    
        $params = [
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':dayStart' => $dayStart,
            ':dayEnd' => $dayEnd
        ];
    
        $results = $this->query($query, $params);
    
        $rideCounts = [];
    
        // Initialize rideCounts array to 0 for all weekdays
        for ($i = 0; $i < 7; $i++) {
            $rideCounts[$i + 1] = 0;
        }
    
        foreach ($results as $result) {
            $weekday = $result->weekday;
            $dayCount = $result->day_count;
    
            $rideCounts[$weekday] = $dayCount;
        }
    
        return $rideCounts;
    }
    
    public function countRidesByNight() {
        // Define start and end times for the night period
        $nightStart = '18:00:01';
        $nightEnd = '23:59:59';
        $midNight = '00:00:00';
        $morningStart = '05:59:59';
    
        $startDate = date('Y-m-d', strtotime('last sunday'));
        $endDate = date('Y-m-d', strtotime('next sunday'));
    
        $query = "SELECT 
                      CASE 
                          WHEN DAYOFWEEK(date) = 1 THEN 1
                          ELSE DAYOFWEEK(date)
                      END as weekday,
                      SUM(
                          CASE 
                              WHEN (TIME(date) BETWEEN :nightStart AND :nightEnd) OR 
                                   (TIME(date) BETWEEN :midNight AND :morningStart) 
                              THEN 1 
                              ELSE 0 
                          END
                      ) as night_count
                  FROM rides 
                  WHERE date >= :startDate AND date <= :endDate
                  GROUP BY WEEKDAY(date)";
    
        $params = [
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':nightStart' => $nightStart,
            ':nightEnd' => $nightEnd,
            ':midNight' => $midNight,
            ':morningStart' => $morningStart
        ];
    
        $results = $this->query($query, $params);
    
        $rideCounts = [];
    
        // Initialize rideCounts array to 0 for all weekdays
        for ($i = 0; $i < 7; $i++) {
            $rideCounts[$i + 1] = 0;
        }
    
        foreach ($results as $result) {
            $weekday = $result->weekday;
            $nightCount = $result->night_count;
    
            $rideCounts[$weekday] = $nightCount;
        }
    
        return $rideCounts;
    }

    public function searchRides($date) {
        $result = $this->query("SELECT * FROM rides WHERE DATE(date) = :date", array(':date' => $date));

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
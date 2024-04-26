<?php

class AdminRide extends Model{
    protected $table = "rides";
    protected $table1 = "users";

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

    public function dayRideCount($date){
        $dayStart = '06:00:00';
        $dayEnd = '18:00:00';

        $result = $this->query("SELECT COUNT(*) as ride_count FROM rides WHERE DATE(date) = :date 
                                AND TIME(date) BETWEEN :dayStart AND :dayEnd", 
                                array(':date' => $date, ':dayStart' => $dayStart, ':dayEnd' => $dayEnd));

        if ($result && isset($result[0]->ride_count)) {
            return $result[0]->ride_count;
        } else {
            return 0;
        }
    }

    public function nightRideCount($date){
        $nightStart = '18:00:01';
        $nightEnd = '23:59:59';
        $midStart = '00:00:00';
        $midEnd = '05:59:59';

        $result = $this->query("SELECT COUNT(*) as ride_count 
                        FROM rides 
                        WHERE DATE(date) = :date 
                        AND ((TIME(date) BETWEEN :nightStart AND :nightEnd) OR 
                             (TIME(date) BETWEEN :midStart AND :midEnd))", 
                        array(
                            ':date' => $date, 
                            ':nightStart' => $nightStart, 
                            ':nightEnd' => $nightEnd,
                            ':midStart' => $midStart, 
                            ':midEnd' => $midEnd
                        ));
        
        if ($result && isset($result[0]->ride_count)) {
            return $result[0]->ride_count;
        } else {
                return 0;
        }

    }

    public function countRidesByDate($startDate, $endDate) {
        $result = $this->query("SELECT COUNT(*) as ride_count  
                                FROM rides 
                                WHERE date >= :startDate AND date < :endDate",
                                array(
                                    ':startDate' => $startDate, 
                                    ':endDate' => date('Y-m-d', strtotime($endDate . ' + 1 day'))
                                ));
        if ($result && isset($result[0]->ride_count)) {
            return $result[0]->ride_count;
        } else {
            return 0;
        }
    }
    

    public function searchRidesForRange($startDate,$endDate) {
        $result = $this->query( "SELECT * FROM rides
                    WHERE date >= :startDate AND date < :endDate",
                    array(
                        ':startDate' => $startDate, 
                        ':endDate' => date('Y-m-d', strtotime($endDate . ' + 1 day'))
                    ));

        if ($result) {
            return $result;
        } else {
            return []; 
        }
    }

    public function dayRidesCount($startDate,$endDate){
        $dayStart = '06:00:00';
        $dayEnd = '18:00:00';

        $result = $this->query("SELECT COUNT(*) as ride_count FROM rides WHERE date >= :startDate AND date < :endDate 
                                AND TIME(date) BETWEEN :dayStart AND :dayEnd", 
                                array(':startDate' => $startDate, ':endDate' => date('Y-m-d', strtotime($endDate . ' + 1 day')),':dayStart' => $dayStart, ':dayEnd' => $dayEnd));

        if ($result && isset($result[0]->ride_count)) {
            return $result[0]->ride_count;
        } else {
            return 0;
        }
    }

    public function nightRidesCount($startDate,$endDate){
        $nightStart = '18:00:01';
        $nightEnd = '23:59:59';
        $midStart = '00:00:00';
        $midEnd = '05:59:59';

        $result = $this->query("SELECT COUNT(*) as ride_count FROM rides WHERE date >= :startDate AND date < :endDate  
                        AND ((TIME(date) BETWEEN :nightStart AND :nightEnd) OR 
                             (TIME(date) BETWEEN :midStart AND :midEnd))", 
                        array(
                            ':startDate' => $startDate,
                            ':endDate' => date('Y-m-d', strtotime($endDate . ' + 1 day')), 
                            ':nightStart' => $nightStart, 
                            ':nightEnd' => $nightEnd,
                            ':midStart' => $midStart, 
                            ':midEnd' => $midEnd
                        ));
        
        if ($result && isset($result[0]->ride_count)) {
            return $result[0]->ride_count;
        } else {
                return 0;
        }

    }

    public function customers(){
        $currentYear = date('Y');
        $result = $this->query("SELECT * FROM users WHERE role = 'user' AND YEAR(date) = :current_year",array(':current_year' => $currentYear));

        if ($result) {
            return $result;
        } else {
            return []; 
        }
    }

    public function customerByYear(){
        $currentYear = date('Y');
        $lastYear = $currentYear - 1;
    
        $result = $this->query("
            SELECT 
                YEAR(date) AS year, 
                COUNT(*) AS user_count 
            FROM 
                users 
            WHERE 
                role = 'user' 
                AND YEAR(date) IN (:current_year, :last_year)
            GROUP BY 
                YEAR(date)
        ", array(
            ':current_year' => $currentYear,
            ':last_year' => $lastYear
        ));
    
        $userCounts = [];
        foreach ($result as $row) {
            $rowArray = (array)$row; // Cast stdClass object to array
            $userCounts[$rowArray['year']] = $rowArray['user_count'];
        }

        return $userCounts;
    }

    public function searchCustomer($id) {
        $result = $this->query("SELECT * FROM users WHERE id = :id", array(':id' => $id));

        if ($result) {
            return $result;
        } else {
            return []; 
        }
    }

    public function rideCountOfCustomer($id){
        $str = "Reject";
        $result = $this->query("SELECT COUNT(*) as ride_count FROM rides WHERE passenger_id = :id AND state = :str", array(':id' => $id, ':str' => $str));

        if ($result && isset($result[0]->ride_count)) {
            return $result[0]->ride_count;
        } else {
            return 0;
        }
    }

    public function countRideByCustomer($id){
        $result = $this->query("SELECT COUNT(*) as ride_count FROM rides WHERE passenger_id = :id", array(':id' => $id));

        if ($result && isset($result[0]->ride_count)) {
            return $result[0]->ride_count;
        } else {
            return 0;
        }
    }

    public function drivers(){
        $currentYear = date('Y');
        $result = $this->query("SELECT * FROM users WHERE role = 'driver' AND YEAR(date) = :current_year",array(':current_year' => $currentYear));

        if ($result) {
            return $result;
        } else {
            return []; 
        }
    }

    public function driverByYear(){
        $currentYear = date('Y');
        $lastYear = $currentYear - 1;
    
        $result = $this->query("
            SELECT 
                YEAR(date) AS year, 
                COUNT(*) AS user_count 
            FROM 
                users 
            WHERE 
                role = 'driver' 
                AND YEAR(date) IN (:current_year, :last_year)
            GROUP BY 
                YEAR(date)
        ", array(
            ':current_year' => $currentYear,
            ':last_year' => $lastYear
        ));
    
        $userCounts = [];
        foreach ($result as $row) {
            $rowArray = (array)$row; // Cast stdClass object to array
            $userCounts[$rowArray['year']] = $rowArray['user_count'];
        }

        return $userCounts;
    }

    public function expiredDriverCount(){
        $oneYearAgo = date('Y-m-d', strtotime('-1 year'));

        $result = $this->query("SELECT COUNT(*) as count FROM users WHERE role = 'driver' AND date < :oneYearAgo ",
                                array(':oneYearAgo' => $oneYearAgo));

        if ($result && isset($result[0]->count)) {
            return $result[0]->count;
        } else {
            return 0;
        }
    }

    public function countRideByDriver($id){
        $result = $this->query("SELECT COUNT(*) as ride_count FROM rides WHERE driver_id = :id", array(':id' => $id));

        if ($result && isset($result[0]->ride_count)) {
            return $result[0]->ride_count;
        } else {
            return 0;
        }
    }

    
           
}
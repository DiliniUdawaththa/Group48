<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'emails/src/Exception.php';
require 'emails/src/PHPMailer.php';
require 'emails/src/SMTP.php';

class OfficerComplaint extends Model{

    public $errors = [];

    protected $table = "complaint";

    protected $pdo; // PDO object to contact with the database directly

	public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

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


    public function updateStatus($cmt_id){
		$sql = "UPDATE {$this->table} SET status_check = 1 WHERE cmt_id = :cmt_id";

		$stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cmt_id', $cmt_id, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
	}  

    public function RejectUpdateStatus($cmt_id){
		$sql = "UPDATE {$this->table} SET status_check = 2 WHERE cmt_id = :cmt_id";

		$stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cmt_id', $cmt_id, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
	}  
    
    /*public function rejectEmail($email){
		$mail = new PHPMailer(true);
    
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'diliniudawaththa@gmail.com';
                $mail->Password = 'tmsv httn hads xtwy';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
    
                $mail->setFrom('diliniudawaththa@gmail.com', 'FAREFLEX Admin User');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Complaint rejected';
				$mail->Body = "We are sorry to inform you that your renewal request has been rejected. Make sure that you rename the payment slip as 'slip.pdf' and submit the form again.<br>Thank You.";
                // $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                
                $mail->send();
                return true;
            } catch (Exception $e) {
                return false;
            }
	}*/
}
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'emails/src/Exception.php';
require 'emails/src/PHPMailer.php';
require 'emails/src/SMTP.php';

class renewRegistration extends Model{
    public $errors = [];
	protected $table = "renewregistration";
	protected $table1 = "users";
    protected$table2 = "driverregistration";

	protected $allowedColumns = [
		'email',
        'name',
		'status',
	];

	protected $pdo; // PDO object to contact with the database directly

	public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

	public function validateAddRenewTable($data){
		$this->errors = [];

		$this->name = $data['name'];
        $this->email = $data['email'];

		// Check if the email is provided
		if (empty($data['email'])) {
			$this->errors['email'] = "Email is required.";
		} else {
			// Check if the email exists in the users table with the role "driver"
			$user = $this->where(['email' => $data['email'], 'role' => 'driver'], $this->table1);
			if (!$user) {
				$this->errors['email'] = "Email does not exist or user does not have the role 'driver'.";
			}
		}

		if(empty($this->errors)) {
			return true;
		}
		return false;
	}

	public function updateStatus($email){
		$sql = "UPDATE {$this->table} SET status = 1 WHERE email = :email";

		$stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
	}

	public function updateRegDate($email){
		$sql = "UPDATE {$this->table1} SET date = CURRENT_DATE() WHERE email = :email";

		$stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
	}

    public function updateDate($email){
        $userQuery = "SELECT id FROM users WHERE email = :email";
        $userStmt = $this->pdo->prepare($userQuery);
        $userStmt->bindParam(':email', $email, PDO::PARAM_STR);
        
        try {
            $userStmt->execute();
            $userId = $userStmt->fetchColumn(); // Fetch the ID
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }

        $sql = "UPDATE {$this->table2} SET date = CURRENT_DATE() WHERE id = :userId";

		$stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

	public function confirmEmail($email){
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
                $mail->Subject = 'Registration renewal done';
				$mail->Body = "We are happy to inform you that your account has been renewed successfully. Now you can login to the system using previous username and password.<br>Thank You.";
                // $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                
                $mail->send();
                return true;
            } catch (Exception $e) {
                return false;
            }
    }

	public function rejectEmail($email){
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
                $mail->Subject = 'Renewal of registration is rejected';
				$mail->Body = "We are sorry to inform you that your renewal request has been rejected. Make sure that you rename the payment slip as 'slip.pdf' and submit the form again.<br>Thank You.";
                // $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                
                $mail->send();
                return true;
            } catch (Exception $e) {
                return false;
            }
	}

	public function deleteRequest($email)
    {
        $query = "delete from $this->table where email = :email;";

        return $this->query($query,['email' => $email]);
    }

}
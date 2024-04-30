<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'emails/src/Exception.php';
require 'emails/src/PHPMailer.php';
require 'emails/src/SMTP.php';

class OfficerDriverRegistration extends Model{
    public $errors = [];

    protected $table = "driverregistration";

    protected $pdo; // PDO object to contact with the database directly

	public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    
    public function delete_rec($id = null)
    {
        $query = "delete from $this->table where id = :id;";
    
        return $this->query($query,['id' => $id]);
    }


    public function updateDriverStatus($id){
		$sql = "UPDATE {$this->table} SET status = 1 WHERE id = :id";

		$stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $this->errors[] = $e->getMessage();
            return false;
        }
	}

    public function OfficerAcceptEmail($email){
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
                $mail->Subject = 'Accepted Notice';
				$mail->Body = "We are happy to inform, you have accepted to our system.<br>Welcome to FAREFLEX!<br>Thank You.";
                // $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                
                $mail->send();
                return true;
            } catch (Exception $e) {
                return false;
            }
    }

    public function officerrejectEmail($email){
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
                $mail->Subject = 'Registration is rejected';
				$mail->Body = "We are sorry to inform you that your registration request has been rejected. Make sure to check the documents again and submit the form again.<br>Thank You.";
                // $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                
                $mail->send();
                return true;
            } catch (Exception $e) {
                return false;
            }
	}

}
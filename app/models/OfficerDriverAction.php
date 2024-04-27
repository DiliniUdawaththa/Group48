<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'emails/src/Exception.php';
require 'emails/src/PHPMailer.php';
require 'emails/src/SMTP.php';

class OfficerDriverAction extends Model{
    public $errors = [];

    protected $table = "users";

    protected $pdo; // PDO object to contact with the database directly

	public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    
    public function delete_driver($id = null)
    {
        $query = "delete from $this->table where id = :id;";
    
        return $this->query($query,['id' => $id]);
    }


    public function updateDriverStatus($email){
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

    public function OfficerConfirmEmail($email){
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
                $mail->Subject = 'Suspended Notice';
				$mail->Body = "we are sorry to inform you have suspended acording to your action.<br>Thank You.";
                // $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                
                $mail->send();
                return true;
            } catch (Exception $e) {
                return false;
            }
    }

}
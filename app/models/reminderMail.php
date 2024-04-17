<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'emails/src/Exception.php';
require 'emails/src/PHPMailer.php';
require 'emails/src/SMTP.php';

class reminderMail extends Model{

    protected $table = "users";

	protected $allowedColumns = [

		'empID',
		'name',
		'email',
		'phone',
        'password',
        'role',
		'date',
	];

    public function sendreminderEmail($email, $name, $deadline, $otp){
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
                $mail->Subject = 'Registration renewal reminder';
                $mail->Body =  'Hello ' . $name . '<br> Your account will be expired on : ' . $deadline . '<br> To verify use this OTP: ' . $otp ;
                // $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                
                $mail->send();
                return true;
            } catch (Exception $e) {
                return false;
            }
    }

    public function calculateRenewalDeadline($registrationDate) {
        return date('Y-m-d', strtotime('+1 year', strtotime($registrationDate)));
    }

    function generateOTP() {
        // Generate a random 4-digit number
        $otp = (mt_rand(0, 9999));
        
        return $otp;
    }
    
    public function selectDriver(){
        $data = [
            'role' => "driver"
        ];

        $drivers = $this->where($data);

        // Loop through each driver to calculate deadline
        foreach ($drivers as $driver){
            $deadline = $this->calculateRenewalDeadline($driver->date);
            // calculate the reminder date
            $reminderDate = date('Y-m-d', strtotime('-1 week', strtotime($deadline)));

            if (date('Y-m-d') === $reminderDate) {
                // Generate OTP
                $otp = $this->generateOTP();
                // Send reminder mail
                $this->sendreminderEmail($driver->email, $driver->name, $deadline, $otp);
            } else {
                echo 'No reminder needed today';
            }
        }
    }


}


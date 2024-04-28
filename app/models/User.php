<?php 

/**
 * users model
 */

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 
 require 'emails/src/Exception.php';
 require 'emails/src/PHPMailer.php';
 require 'emails/src/SMTP.php';
 

class User extends Model
{
	
	public $errors = [];
	protected $table = "users";

	protected $allowedColumns = [

		'empID',
		'name',
		'phone',
		'email',
		'password',
		// 'term1',
		// 'term2',	
		'role',
		'date',
        'img_path',
        'address',
        'nic',
        'dob',
	];

	public function validate($data)
	{
		$this->role ='';
		$this->errors = [];

		
        if (empty($data['name'])) {
            $this->errors['name'] = "A  name is required.";
        } elseif (!preg_match("/^[a-zA-Z]+$/", trim($data['name']))) {
            $this->errors['name'] = "name can only have letters.";
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid.";
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

            $this->errors['email'] = "Email is not valid.";
        } elseif ($this->where(['email'=> $data['email']])) {
            $this->errors['email'] = "Email already exist.";
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required.";
        } elseif (strlen($data['password']) < 8) {
            $this->errors['password'] = "Password must be at least 8 characters long.";
        // } elseif ($data['Password'] !== $data['Password2']) {
        //     $this->errors['Password'] = "Passwords do not match.";
        }


		if (empty($data['phone'])) {
			$this->errors['phone'] = "Contact number is required.";
		} elseif (!preg_match("/^[0-9]+$/", $data['phone'])) {
			$this->errors['phone'] = "Contact number can only have numbers.";
		} elseif (strlen($data['phone']) < 10) {
			$this->errors['phone'] = "Contact number must be  10 digits long.";
		} elseif (strlen($data['phone']) >10) {
			$this->errors['phone'] = "Contact number must be  10 digits long.";
		}elseif ($this->where(['phone'=> $data['phone']])) {
            $this->errors['phone'] = "mobile number already exist.";
        }
		


		// show($data['term1']);
		if(empty($data['term1']))
		{
			if(empty($data['term2']))
			    {$this->errors['term2'] = "Please select your role";}
		}
		if(!empty($data['term1']))
		{
			if(!empty($data['term2']))
			    {$this->errors['term2'] = "Please select one role";}
		}
		if(empty($data['term1']))
		{
			  $this->role = 'driver';
		}
		if(empty($data['term2']))
		{
			$this->role = 'user';

		}
		// show($this->role);
		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

	public function validate_officer($data)
	{
		$this->errors = [];
        
        $this->empID = $data['empID'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];

       // show($this->empID);

        if (!preg_match("/^[1-9][0-9]{3}$/", $data['empID'])) {
            $this->errors['empID'] = "Employee ID must be a 4-digit number and cannot start with 0.";
        } elseif ($this->where(['empID' => $data['empID']])) {
            $this->errors['empID'] = "Employee ID already exists.";
        }

        if (!preg_match("/^[a-zA-Z\s]+$/", trim($data['name']))) {
             $this->errors['name'] = "name can only have letters.";
        }
        // elseif ($this->where(['Name'=> $data['Name']])) {
        //      $this->errors['Name'] = "name already exist.";
        // }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid.";
        } elseif ($this->where(['email'=> $data['email']])) {
            $this->errors['email'] = "Email already exist.";
        }

        if (empty($data['phone'])) {
			$this->errors['phone'] = "Contact number is required.";
		} elseif (!preg_match("/^[0-9]+$/", $data['phone'])) {
			$this->errors['phone'] = "Contact number can only have numbers.";
		} elseif (strlen($data['phone']) < 10) {
			$this->errors['phone'] = "Contact number must be  10 digits long.";
		} elseif (strlen($data['phone']) >10) {
			$this->errors['phone'] = "Contact number must be  10 digits long.";
		} elseif ($this->where(['phone'=> $data['phone']])) {
             $this->errors['phone'] = "Mobile number already exist.";
        } elseif (!preg_match("/^07[0-9]{8,9}$/", $data['phone'])) {
            $this->errors['phone'] = "Mobile number must be in a valid mobile number format.";
        }

        if(empty($this->errors))
		{
            // show($_POST);
			return true;
		}
        // show($_POST);
		return false;
	}

    
    public function sendMail($toMail,$pWord){
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
            $mail->addAddress($toMail);
            $mail->isHTML(true);
            $mail->Subject = 'Your username and password';
            $mail->Body = 'username: ' . $toMail . '<br> password: ' . $pWord;
            $mail->AltBody = 'Body in plain text for non-HTML mail clients';
            
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function isExpired($email){
        $data = [
            'email' => $email
        ];
    
        $drivers = $this->where($data);
        
        // If no drivers found, return false
        if (empty($drivers)) {
            return false;
        }
    
        foreach ($drivers as $driver){
            $deadline = date('Y-m-d', strtotime('+1 year', strtotime($driver->date)));
    
            // If any of the drivers are expired, return true
            if(date('Y-m-d') > $deadline){
                return true;
            }
        }
    
        // If none of the drivers are expired, return false
        return false;
    }
    
}
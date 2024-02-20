<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'emails/src/Exception.php';
require 'emails/src/PHPMailer.php';
require 'emails/src/SMTP.php';


class AdminOfficer extends Model{
    public $errors = [];
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

    public function validate($data)
	{
		$this->errors = [];
        
        $this->empID = $data['empID'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];

       // show($this->empID);

        // if ($this->where(['empID'=> $data['empID']])) {
        //     $this->errors['empID'] = "Employee ID already exist.";
        // }

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
        }

        if(empty($this->errors))
		{
            // show($_POST);
			return true;
		}
        // show($_POST);
		return false;
	}

    public function delete_addofficer($empID = null)
    {
        $query = "delete from $this->table where empID = :empID;";

        return $this->query($query,['empID' => $empID]);
    }

    public function update_addofficer($empID, $data)
    {
        // $query = $this->update($empID, $data);
        // $conditions = ['empID' => $empID];
        // $query = $this->update($conditions, $data);
        // return $query;
        
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
    
        $keys = array_keys($data);
        // $id = array_search($id, $data);
    
        $query = "update " . $this->table . " set ";
        foreach ($keys as $key) {
            $query .= $key . "=:" . $key . ",";
        }
        $query = trim($query, ",");
        $query .= " where empID = :empID";
        // print_r($query);	
    
    
        $this->query($query, $data);
        
    }


    public function generatePassword() {
        // Define the character set to be used in the password
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
    
        // Get the total number of characters in the character set
        $charLength = strlen($chars);
    
        // Initialize the password variable
        $password = '';
    
        // Generate random characters until the password reaches the desired length
        for ($i = 0; $i < 8; $i++) {
            // Generate a random index within the character set
            $randomIndex = mt_rand(0, $charLength - 1);
    
            // Append the randomly selected character to the password
            $password .= $chars[$randomIndex];
        }
    
        // Return the generated password
        return $password;
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


}
<?php 


/**
 * database class
 */
class Database
{
	
	private function connect()
	{
		$str = DBDRIVER.":hostname=".DBHOST.";dbname=".DBNAME;
		return new PDO($str,DBUSER,DBPASS);

	}

	public function query($query,$data = [],$type = 'object')
	{
		$con = $this->connect();

		$stm = $con->prepare($query);
		if($stm)
		{
			$check = $stm->execute($data);
			if($check)
			{
				if($type == 'object')
				{
					$type = PDO::FETCH_OBJ;
				}else{
					$type = PDO::FETCH_ASSOC;
				}

				$result = $stm->fetchAll($type);

				if(is_array($result) && count($result) > 0)
				{
					return $result;
				}
			}
		}

		return false;
	}

	public function create_tables()
	{
		//users table
		$query = "

			CREATE TABLE IF NOT EXISTS `users` (
			 `id` int(11) NOT NULL AUTO_INCREMENT,
			 `name` varchar(100) NOT NULL,
			 `phone` varchar(30) NOT NULL,
			 `email` varchar(100) NOT NULL,
			 `password` varchar(255) NOT NULL,
			 `role` varchar(20) NOT NULL,
			 `empID` int(10) UNIQUE,
			 `date` date DEFAULT NULL,
			 PRIMARY KEY (`id`),
			 KEY `email` (`email`),
			 KEY `name` (`email`),
			 KEY `phone` (`email`),
			 KEY `date` (`date`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4

		";

		$this->query($query);

		$query = "
			CREATE TABLE IF NOT EXISTS `vehicle` (
			`licenseplate` varchar(100) NOT NULL,
			`owner` varchar(100) NOT NULL,
			`type` varchar(20) NOT NULL,
			`color` varchar(10) DEFAULT NULL,
			PRIMARY KEY (`licenseplate`)
		   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
		   
		   ";
		$this->query($query);

		//add officer table
		$query = "
			CREATE TABLE IF NOT EXISTS `addofficer` (
			`empID` int(10) NOT NULL,
			`name` text NOT NULL,
			`email` text NOT NULL,
			`phone` text NOT NULL,
			 PRIMARY KEY (`empID`)
		   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
		   
		   ";
		$this->query($query);


	    $query= "
			CREATE TABLE IF NOT EXISTS `addplace` (
			`id` int(255) NOT NULL AUTO_INCREMENT,
			`name` varchar(100) NOT NULL,
			`category` varchar(100) NOT NULL,
			`icon` varchar(100) NOT NULL,
			`address` varchar(255) NOT NULL,
			`date` datetime NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
			";
		
		$this->query($query);

		$query= "
			CREATE TABLE IF NOT EXISTS `driverregistration` (
			`email` varchar(50) NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`email`)
		   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
			";
		
		$this->query($query);

	}
	

	
}
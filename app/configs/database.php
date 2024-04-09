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
			 `empID` int(10),
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
			`password` varchar(255) NOT NULL,
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

		$query= "
		  DROP TABLE IF EXISTS `driver_status`;
		  CREATE TABLE IF NOT EXISTS `driver_status` (
			`driver_id` int(11) NOT NULL,
			`vehicle` varchar(10) NOT NULL,
			`lat` float NOT NULL,
			`long` float NOT NULL,
			`status` tinyint(1) NOT NULL,
			PRIMARY KEY (`driver_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		
		";
		
		$this->query($query);

		$query= "
		CREATE TABLE IF NOT EXISTS `rides` (
			`id` int(10) NOT NULL AUTO_INCREMENT,
			`passenger_id` int(10) NOT NULL,
			`driver_id` int(10) NOT NULL,
			`date` datetime NOT NULL,
			`location` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
			`l_lat` float NOT NULL,
			`l_long` float NOT NULL,
			`destination` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
			`d_lat` float NOT NULL,
			`d_long` float NOT NULL,
			`vehicle` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
			`time` varchar(20) NOT NULL,
			`distance` varchar(20) NOT NULL,
			`fare` float NOT NULL,
			`state` varchar(10) NOT NULL,
			PRIMARY KEY (`id`),
			KEY `fk_passenger` (`passenger_id`),
			KEY `fk_driver` (`driver_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
		  
		  INSERT INTO `driver_status` (`driver_id`, `vehicle`, `lat`, `long`, `status`) VALUES
		  (1, 'bike', 6.90353, 79.8626, 1),
		  (2, 'bike', 6.90579, 79.8589, 1),
		  (3, 'bike', 6.90259, 79.8579, 1),
		  (4, 'bike', 6.90822, 79.8578, 1),
		  (5, 'auto', 6.90003, 79.8601, 1),
		  (6, 'auto', 6.90179, 79.8579, 1),
		  (7, 'auto', 6.90859, 79.8529, 1),
		  (8, 'auto', 6.90622, 79.8508, 1),
		  (9, 'car', 6.905, 79.865, 1),
		  (10, 'car', 6.906, 79.854, 1),
		  (11, 'car', 6.902, 79.855, 1),
		  (12, 'car', 6.905, 79.858, 1),
		  (13, 'Ac-car', 6.903, 79.862, 1),
		  (14, 'Ac-car', 6.905, 79.858, 1),
		  (15, 'Ac-car', 6.902, 79.857, 1),
		  (16, 'Ac-car', 6.908, 79.857, 1);
		  
			";
		
		$query="
			CREATE TABLE IF NOT EXISTS `standardFare` (
			`id` int(255) NOT NULL AUTO_INCREMENT,
			`faretype` varchar(20) NOT NULL,
			`vehicletype` varchar(20) NOT NULL,
			`fare` int(255) NOT NULL,
			`updatedby` varchar(50) DEFAULT NULL,
			`date`datetime NOT NULL,
			PRIMARY KEY (`id`)
		)ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
		";

		$this->query($query);

	}
	

	
}
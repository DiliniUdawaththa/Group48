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
		  `date` date DEFAULT NULL,
		  `img_path` varchar(70) NOT NULL DEFAULT 'person.jpg',
		  `address` varchar(100) NOT NULL DEFAULT '',
		  `nic` varchar(12) NOT NULL DEFAULT '',
		  `dob` varchar(16) NOT NULL DEFAULT '',
		  PRIMARY KEY (`id`),
		  KEY `email` (`email`),
		  KEY `name` (`email`),
		  KEY `phone` (`email`),
		  KEY `date` (`date`)
		) ENGINE=InnoDB AUTO_INCREMENT=1019 DEFAULT CHARSET=utf8mb4;
		

		INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `role`, `date`) VALUES
		(1001, 'shanthos', '0770000001', 'shanthos@gmail.com', '$2y$10$89s0w3Dnk4.XX4t9VJ3BBeGSSnzauy6tk1rxPBa9RhIky4AlcfEnq', 'driver', '2024-04-09'),
		(1002, 'kokul', '0770000002', 'kokul@gmail.com', '$2y$10$?TWlA8AuYDOwNjmtTnBpTruXovf/HMphxKyWNdEw6bynXh1VcReb96', 'driver', '2024-04-09'),
		(1003, 'Nimal', '0770000003', 'nimal@gmail.com', '$2y$10$?m4kqtvFWJpRvEZ5grftoc.UzMRHm0gEUwPP6OjVI92nxm0Mt4FqOW', 'driver', '2024-04-09'),
		(1004, 'Kamal', '0770000004', 'kamal@gmail.com', '$2y$10$7ooUnODaPxfLlD8Smelg8eGfstvkyimf2pbp/Run2VYnwYM9RSBgi', 'driver', '2024-04-09'),
		(1005, 'Saru', '0770000000', 'saru@gmail.com', '$2y$10$?x2dY3zAS9wZYj2YZzfoCzeoS85nQhm5OqPvn6qZfU/e6rU0HhaHnG', 'driver', '2024-04-10'),
		(1006, 'Raguram', '0770000005', 'raguram@gmail.com', '$2y$10$?ZJq/uRed/ubWPymiNWcbrO/.niFHL9kxmzEH1V3mf8NVlxAf78kKO', 'driver', '2024-04-10'),
		(1007, 'Gayan', '0770000006', 'gayan@gmail.com', '$2y$10$5CGd55W9U.zjyfQp1K5WzuDlri3Hpd6Ap4rzNzN2zGGHkz0YXbfOW', 'driver', '2024-04-10'),
		(1008, 'Shansi', '0770000007', 'shansi@gmail.com', '$2y$10$12jzqPpjllk5kdC9/RcNh.bsP3ZdlKxnINuo5HHuVkZKBcBWIbs76', 'driver', '2024-04-10'),
		(1009, 'Samar', '0770000008', 'samar@gmail.com', '$2y$10$?N/Ssesy3h0r/KHBHg/JM5.8O07OUQsr4jqFOlkJAnBD0W13hBgvx2', 'driver', '2024-04-10'),
		(1010, 'Mithilan', '0770000009', 'mithilan@gmail.com', '$2y$10$?vg0rcqJHre9CcX5cm0rTDepa5GKKij1hx8DeYERQsquinlMZGMiZy', 'driver', '2024-04-10'),
		(1011, 'Karththi', '0770000010', 'karthi@gmail.com', '$2y$10$?C.c/JD.XYthPRVoZpus4jOIlxfRtxa8v1uZhdx0Au8aRmxkcgN0OO', 'driver', '2024-04-10'),
		(1012, 'Jathu', '0770000011', 'jathu@gmail.com', '$2y$10$?kGCer0IZrcGjoN3t7myeaOOzWr0pobcuowp3AEjXZwYVd2OV8HgaW', 'driver', '2024-04-10'),
		(1013, 'Rajee', '0770000012', 'rajee@gmail.com', '$2y$10$?yz2jB4/xveKdOUNKT9PePuwuwnHkVuB7CwmtNTfrO9m5Bhuz9pmyS', 'driver', '2024-04-10'),
		(1014, 'Abiram', '0770000013', 'abiram@gmail.com', '$2y$10$?i6/MOKsKUiqD4tZ8JSlsYuB10ZcWaIgKzkrEujnnGNaThVTEO3mma', 'driver', '2024-04-10'),
		(1015, 'Achchu', '0770000014', 'achchu@gmail.com', '$2y$10$/LhWDXuewCg6DkEm1XjFD.c80V50yYQVl3LBj6lk9FLyLvkcM9fW.', 'driver', '2024-04-10'),
		(1016, 'Thinesh', '0770000015', 'thinesh@gmail.com', '$2y$10$3OKnptX.0re7g36he00cReJKVbmPvPW6.Fq6LTbqUfZt8jFfue8v2', 'driver', '2024-04-10');
		COMMIT;
			

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
		  `passenger_id` int(11) DEFAULT NULL,
		  `name` varchar(100) NOT NULL,
		  `category` varchar(100) NOT NULL,
		  `icon` varchar(100) NOT NULL,
		  `location` varchar(255) NOT NULL,
		  `lat` double NOT NULL,
		  `lng` double NOT NULL,
		  `date` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
		
			";
		
		$this->query($query);

		// $query= "
		// 	CREATE TABLE IF NOT EXISTS `driverregistration` (
		// 	`email` varchar(50) NOT NULL,
		// 	`profileimg` varchar(50),
		// 	`driverlicenseimg` varchar(50),
		// 	`revenuelicenseimg` varchar(50),
		// 	`vehregistrationimg` varchar(50),
		// 	`vehinsuranceimg` varchar(50),
		// 	`status` int(2) NOT NULL,
		// 	PRIMARY KEY (`email`)
		//    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
		// 	";
		
		$query= "
			CREATE TABLE IF NOT EXISTS `driverregistration` (
			`email` varchar(50) NOT NULL,
			`profileimg` varchar(100) NOT NULL,
			`driverlicenseimg` varchar(100) DEFAULT NULL,
			`revenuelicenseimg` varchar(100) DEFAULT NULL,
			`vehregistrationimg` varchar(100) DEFAULT NULL,
			`vehinsuranceimg` varchar(100) DEFAULT NULL,
			`status` int(2) NOT NULL
		   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
		";
		
		
		$this->query($query);

		$query= "
		  CREATE TABLE IF NOT EXISTS `driver_status` (
			`driver_id` int(11) NOT NULL,
			`vehicle` varchar(10) NOT NULL,
			`lat` float NOT NULL,
			`long` float NOT NULL,
			`status` tinyint(1) NOT NULL,
			PRIMARY KEY (`driver_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;

		INSERT INTO `driver_status` (`driver_id`, `vehicle`, `lat`, `long`, `status`) VALUES
			(1001, 'bike', 6.90353, 79.8626, 1),
			(1002, 'bike', 6.90579, 79.8589, 1),
			(1003, 'bike', 6.90259, 79.8579, 1),
			(1004, 'bike', 6.90822, 79.8578, 1),
			(1005, 'auto', 6.90003, 79.8601, 1),
			(1006, 'auto', 6.90179, 79.8579, 1),
			(1007, 'auto', 6.90859, 79.8529, 1),
			(1008, 'auto', 6.90622, 79.8508, 1),
			(1009, 'car', 6.905, 79.865, 1),
			(1010, 'car', 6.906, 79.854, 1),
			(1011, 'car', 6.902, 79.855, 1),
			(1012, 'car', 6.905, 79.858, 1),
			(1013, 'Ac-car', 6.903, 79.862, 1),
			(1014, 'Ac-car', 6.905, 79.858, 1),
			(1015, 'Ac-car', 6.902, 79.857, 1),
			(1016, 'Ac-car', 6.908, 79.857, 1);
			COMMIT;
		
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
		`m_lat` float DEFAULT NULL,
		`m_long` float DEFAULT NULL,
		`vehicle` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
		`time` varchar(20) NOT NULL,
		`distance` varchar(20) NOT NULL,
		`fare` float NOT NULL,
		`ride_start` tinyint(1) NOT NULL DEFAULT '0',
		`state` varchar(10) NOT NULL,
		PRIMARY KEY (`id`),
		KEY `fk_passenger` (`passenger_id`),
		KEY `fk_driver` (`driver_id`)
		) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;


			";
			$this->query($query);
		
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

		INSERT INTO `standardfare` (`id`, `faretype`, `vehicletype`, `fare`, `updatedby`, `date`) VALUES
		(1, 'Std', 'bike', 70, 'thusi', '2024-04-24 19:03:19'),
		(2, 'Std', 'auto', 100, 'thusi', '2024-04-24 19:04:59'),
		(3, 'std', 'car', 150, 'thusi', '2024-04-24 19:05:31'),
		(4, 'Std', 'Ac-car', 170, 'thusi', '2024-04-24 19:06:10');
		COMMIT;

		";

		$this->query($query);

		$query= "
			CREATE TABLE IF NOT EXISTS `renewregistration` (
			`email` varchar(50) NOT NULL,
			`name` text NOT NULL,
			`status` int(2) NOT NULL,
			PRIMARY KEY (`email`)
		   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
			";
		
		$this->query($query);

		$query="
		CREATE TABLE IF NOT EXISTS `complaint` (
		  `cmt_id` int(11) NOT NULL AUTO_INCREMENT,
		  `complainant` text NOT NULL,
		  `passenger_id` int(11) NOT NULL,
		  `driver_id` int(11) NOT NULL,
		  `datetime` datetime NOT NULL,
		  `complaint` text NOT NULL,
		  `status_check` tinyint(1) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`cmt_id`)
		) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
		
		";

		$this->query($query);

		$query="
		CREATE TABLE IF NOT EXISTS `rating` (
		`rate_id` int(11) NOT NULL AUTO_INCREMENT,
		`role_id` int(11) NOT NULL,
		`role` varchar(20) NOT NULL,
		`rate` int(11) NOT NULL,
		PRIMARY KEY (`rate_id`)
		) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;	
		";

		$this->query($query);

		$query="
		CREATE TABLE IF NOT EXISTS `current_rides` (
		`id` int(10) NOT NULL AUTO_INCREMENT,
		`passenger_id` int(10) NOT NULL,
		`location` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
		`l_lat` float NOT NULL,
		`l_long` float NOT NULL,
		`destination` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
		`d_lat` float NOT NULL,
		`d_long` float NOT NULL,
		`m_lat` float DEFAULT NULL,
		`m_long` float DEFAULT NULL,
		`vehicle` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
		PRIMARY KEY (`id`),
		KEY `fk_passenger` (`passenger_id`)
		) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

		INSERT INTO `current_rides` (`id`, `passenger_id`, `location`, `l_lat`, `l_long`, `destination`, `d_lat`, `d_long`, `vehicle`) VALUES
		(14, 1017, ' Kandoori', 6.87848, 79.8581, ' My Home', 6.87313, 79.868, 'auto');
		COMMIT;

		";

		$this->query($query);

		$query="
		CREATE TABLE IF NOT EXISTS `message` (
		`message_id` int(11) NOT NULL AUTO_INCREMENT,
		`ride_id` int(11) NOT NULL,
		`sender` varchar(10) NOT NULL,
		`passenger_id` int(11) NOT NULL,
		`driver_id` int(11) NOT NULL,
		`message` varchar(255) NOT NULL,
		PRIMARY KEY (`message_id`)
		) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
		COMMIT;
	
		";

		$this->query($query);

		
	}
	

	
}
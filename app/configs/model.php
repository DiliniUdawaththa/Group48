<?php 

/**
 * main model class
 */
class Model extends Database
{
	
	protected $table = "";

	public function insert($data)
	{

		//remove unwanted columns
		if(!empty($this->allowedColumns))
		{
			foreach ($data as $key => $value) {
				if(!in_array($key, $this->allowedColumns))
				{
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);

		$query = "insert into " . $this->table;
		$query .= " (".implode(",", $keys) .") values (:".implode(",:", $keys) .")";
        // show($query);		show($query);

        // show($query);
		$this->query($query,$data);

	}

	public function where($data)
	{

		$keys = array_keys($data);

		$query = "select * from ".$this->table." where ";

		foreach ($keys as $key) {
			$query .= $key . "=:" . $key . " && ";
		}
 
 		$query = trim($query,"&& ");
		$res = $this->query($query,$data);

		if(is_array($res))
		{
			return $res;
		}

		return false;

	}

	// public function getColumns()
	// {
	// 	$query = "DESCRIBE " . $this->table;
	// 	$result = $this->query($query);

	// 	$columns = [];
	// 	foreach ($result as $row) {
	// 		$columns[] = $row['Field'];
	// 	}

	// 	return $columns;
	// }


	// public function searchData($searchTerm)
    // {
    //     $keys = $this->getColumns();; // Assuming you have a method to get table columns

    //     $query = "SELECT * FROM " . $this->table . " WHERE ";

    //     foreach ($keys as $key) {
    //         $query .= $key . " LIKE '%" . $searchTerm . "%' OR ";
    //     }

    //     $query = rtrim($query, "OR ");

    //     $res = $this->query($query);

    //     if (is_array($res)) {
    //         return $res;
    //     }

    //     return false;
    // }


	public function where1($data, $searchTerm = null)
	{
		$keys = array_keys($data);
		$query = "SELECT * FROM " . $this->table . " WHERE ";

		// If $searchTerm is provided, include it in the WHERE clause
		if ($searchTerm !== null) {
			$query .= "(";
			foreach ($keys as $key) {
				$query .= $key . " LIKE '%" . $searchTerm . "%' OR ";
			}
			// $query = $query . ") AND ";
			$query = rtrim($query, "OR ") . ") AND ";
		}

		foreach ($keys as $key) {
			$query .= $key . "=:" . $key . " AND ";
		}

		$query = rtrim($query, "AND ");
		$res = $this->query($query, $data);

		if (is_array($res)) {
			return $res;
		}

		return false;
	}

	public function first($data)
	{

		$keys = array_keys($data);

		$query = "select * from ".$this->table." where ";

		foreach ($keys as $key) {
			$query .= $key . "=:" . $key . " && ";
		}
 
 		$query = trim($query,"&& ");
 		$query .= " order by id desc limit 1";

		$res = $this->query($query,$data);

		if(is_array($res))
		{
			return $res[0];
		}

		return false;

	}
	public function delete($data)
	{

		$keys = array_keys($data);

		$query = "delete from ".$this->table." where ";

		foreach ($keys as $key) {
			$query .= $key . "=:" . $key . " && ";
		}
 
 		$query = trim($query,"&& ");
		$res = $this->query($query,$data);

		if(is_array($res))
		{
			return $res;
		}

		return false;

	}
// ------------------------------------------------------------------------------------------------------------------------------
	public function update($id, $data)
	{
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
		$query .= " where id = :id";
		// print_r($query);	


		$this->query($query, $data);
	}
	public function findAll()
	{
		$query = "select * from $this->table;";
		return $this->query($query);
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
	
	

	public function officerupdate($Fidd, $data)
	{
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {
				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		// $Fid = array_search($Fid, $data);

		$query = "update " . $this->table . " set ";
		foreach ($keys as $key) {
			$query .= $key . "=:" . $key . ",";
		}
		$query = trim($query, ",");
		$query .= " where Fid = :Fid";
		// print_r($query);	


		$this->query($query, $data);
	}


	/*public function searchByEmail($email)
{
    $query = "SELECT * FROM " . $this->table . " WHERE email LIKE :email";
    $data = array('email' => '%' . $email . '%');
    $res = $this->query($query, $data);

    if (is_array($res)) {
        return $res;
    }

    return false;
}*/


public function where2($data, $search = null)
	{
		$keys = array_keys($data);
		$query = "SELECT * FROM " . $this->table . " WHERE ";

		// If $searchTerm is provided, include it in the WHERE clause
		if ($search !== null) {
			$query .= "(";
			foreach ($keys as $key) {
				$query .= $key . " LIKE '%" . $search . "%' OR ";
			}
			// $query = $query . ") AND ";
			$query = rtrim($query, "OR ") . ") AND ";
		}

		foreach ($keys as $key) {
			$query .= $key . "=:" . $key . " AND ";
		}

		$query = rtrim($query, "AND ");
		$res = $this->query($query, $data);

		if (is_array($res)) {
			return $res;
		}

		return false;
	}

}
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
		show($query);

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
	
	public function update($data, $where)
	{
		// $data is an associative array containing the new values to update
		// $where is an associative array containing the condition for updating

		$updateColumns = array_keys($data);
		$whereColumns = array_keys($where);

		$updateQuery = "UPDATE " . $this->table . " SET ";
		$updateValues = [];

		foreach ($updateColumns as $column) {
			$updateQuery .= $column . " = :" . $column . ", ";
			$updateValues[":" . $column] = $data[$column];
		}

		$updateQuery = rtrim($updateQuery, ', '); // Remove the trailing comma

		$whereQuery = " WHERE ";
		foreach ($whereColumns as $column) {
			$whereQuery .= $column . " = :" . $column . " AND ";
			$updateValues[":" . $column] = $where[$column];
		}

		$whereQuery = rtrim($whereQuery, ' AND ');

		$query = $updateQuery . $whereQuery;
		show($query);
		$res = $this->query($query, $updateValues);

		if (is_array($res)) {
			return $res;
		}

		return false;
	}


	

}
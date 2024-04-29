<?php 


class offers extends Model
{
	
	public $errors = [];
	protected $table = "offers";

	protected $allowedColumns = [
        'ride_id',
        'driver_id',
        'offer_price',
        'negotiation_status',
        'negotiation_price',
        'accept_status'
	];

    public function validate($data)
	{
		$this->errors = [];

    }

    public function update_negotiate_fare($id1,$id2, $data)
	{
		// show($data);
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {
				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		// $id = array_search($id, $data);
        // show($data);
		$query = "update " . $this->table . " set ";
		foreach ($keys as $key) {
			$query .= $key . "= :" . $key . ",";
		}
		$query = trim($query, ",");
		$query .= " where ride_id =".$id1;
		$query .= " 	&& driver_id =".$id2;
		// print_r($query);	


		$this->query($query, $data);
	}

	public function update_accept_status($id, $data)
	{
		// show($data);
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {
				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		// $id = array_search($id, $data);
        // show($data);
		$query = "update " . $this->table . " set ";
		foreach ($keys as $key) {
			$query .= $key . "= :" . $key . ",";
		}
		$query = trim($query, ",");
		$query .= " where driver_id =".$id;
		// print_r($query);	


		$this->query($query, $data);
	}
	public function update_offer_price($id, $data)
	{
		// show($data);
		if (!empty($this->allowedColumns)) {
			foreach ($data as $key => $value) {
				if (!in_array($key, $this->allowedColumns)) {
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		// $id = array_search($id, $data);
        // show($data);
		$query = "update " . $this->table . " set ";
		foreach ($keys as $key) {
			$query .= $key . "= :" . $key . ",";
		}
		$query = trim($query, ",");
		$query .= " where ride_id =".$id;
		// print_r($query);	


		$this->query($query, $data);
	}

}
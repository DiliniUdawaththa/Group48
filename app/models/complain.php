<?php 

class complain extends Model
{
	
	public $errors = [];
	protected $table = "complaint";

	protected $allowedColumns = [
        'cmt_id',
        'complainant',
        'passenger_id',
        'driver_id',
        'datetime',
        'complaint',
        'status_check',
        'file_path',
	];

    public function validate($data)
	{
		$this->errors = [];

        if(empty($this->errors))
		{
            // show($_POST);
			return true;
		}
        // show($_POST);
		return false;
	}



}<?php 

class complain extends Model
{
	
	public $errors = [];
	protected $table = "complaint";

	protected $allowedColumns = [
        'cmt_id',
        'complainant',
        'passenger_id',
        'driver_id',
        'datetime',
        'complaint',
        'status_check',
	];

    public function validate($data)
	{
		$this->errors = [];

        if(empty($this->errors))
		{
            // show($_POST);
			return true;
		}
        // show($_POST);
		return false;
	}

    public function getcomplaindetails() 
    {
        $query = "SELECT c.cmt_id, c.complainant, c.datetime, c.status_check, u1.name AS passenger_name, u2.name AS driver_name,
        FROM complaints c
        INNER JOIN users u1 ON c.passenger_id = u1.id
        INNER JOIN users u2 ON c.driver_id = u2.id";

    return $this->query($query); /*,['passenger_id' => $passenger_id]);*/
    }

    /*public function delete_standardFare($Fid = null)
    {
        $query = "delete from $this->table where Fid = :Fid;";

        return $this->query($query,['Fid' => $Fid]);
    }

    public function update_standardFare($Fid, $data)
    {
        $this->update($Fid, $data);
            
    }*/

}
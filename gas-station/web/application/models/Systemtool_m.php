<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.


Class Systemtool_m extends CI_Model {
	protected $_table_name = 'users';
	protected $_order_by = 'username';
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	
	public function printState($state) 
	{
		$this->db->select('name');	
		$this->db->where("state_id = $state");
		$result = $this->get_data('state');		
		$data = $result->result();
		
		return $data->name;		
	}


	public function selectState($country_id=113){	
		$this->db->select('id, name');	
		$this->db->where("country_id = $country_id");
		$result = $this->get_data('state');
		
		$data = $result->result();
		$array = array(0 => 'Select State');
		if(count($data)){
			foreach ($data as $state) {
				$array[$state->id] = $state->name;
			}
		}
		return $array;						
	}

	public function selectCountry()
	{	
		$this->db->select('id, name');	
		$result = $this->get_data('country');		
		$data = $result->result();
		$array = array(0 => 'Select Country');
		if(count($data)){
			foreach ($data as $country) {
				$array[$country->id] = $country->name;
			}
		}
		return $array;						
	}
	
	
	

}
?>
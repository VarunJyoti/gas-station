<?php 
class State_model extends CI_Model {
	protected $_table_name = 'state';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'name', 'country_id','state_code');
	
	
	
	
	
	public $id;
	public $name; 
	public $state_code; 
	public $country_id; 
	
	public function __construct()	{
		$this->load->database(); 
	}
	
	public function getStateByCountryId($id)
 
    {
		
        $this->db->select('id,name')->from('state');
 
        $this->db->where(array('country_id'=>$id));
 
        $query = $this->db->get();
		//print_r($query->result());die('test');
        return $query->result();
 
    }
	
	public function save($id=NULL,$table='state')
	{
		
		$data 					= $this->array_from_post(self::$db_fields);	
		
		
		if($id)
		{	
			$this->db->where('id', $id);
			$last_id = $this->db->update($table ,$data);
			if($last_id !== 0){
				return true;
			}else{
				return false;
			}
			//$this->save($data, $id);

		} else {
			$this->db->insert($table ,$data);
			$last_id = $this->db->insert_id();
							
			
		}
	
		
			
	}
	public function getState($start=0,$limit=0,$status=1) 
	{
		if($status)
			$this->db->where("status = {$status}");

		//$this->db->order_by("created_date","desc");

		if($limit)
			$state = $this->get3($limit,$start);
		else
			$state = $this->get2();
		return $state;
	}
	
	public function deleteState($id)
	{
		$result = $this->delete($id);
		return $result;

	}
	public function statedrop($id=null){
		$state = $this->State_model->get();
		$option = '';
		foreach($state as $state_row){
			$select = '';
			if($id == $state_row->id)
				$select = 'selected';
			$option .= "<option id='state' {$select} value='{$state_row->id}'>{$state_row->name}</option>";
			
		}
		return $option;
	}
	
	public function get_state($id) {
		if($id != FALSE) {
			$query = $this->db->get_where($this->_table_name, array('id' => $id));
			$state = $query->result();
			return $state[0]->name;
		}
		else {
			return FALSE;
		}
	}
	
	public function getStateCode($id) {
		if($id != FALSE) {
			$query = $this->db->get_where($this->_table_name, array('id' => $id));
			$state = $query->result();
			return $state[0]->state_code;
		}
		else {
			return FALSE;
		}
	}
	public function stateCode($id=null){
		$state = $this->State_model->get();
		$option = '';
		foreach($state as $state_row){
			$select = '';
			if($id == $state_row->id)
				$select = 'selected';
			$option .= "<option id='state' {$select} value='{$state_row->id}'>{$state_row->state_code}</option>";
			
		}
		return $option;
	}

}
?>
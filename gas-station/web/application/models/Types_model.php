<?php 
class Types_model extends CI_Model{
	protected $_table_name = 'user_types';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'name','created_date','modified_date','status');
	
	public $id;
	public $name; 
	public $created_date; 
	public $modified_date;	
	public $status; 	
	
	public function __construct()	{
		$this->load->database(); 
	}
	
	
	public function save($id=NULL)
	{
		
		$data = $this->array_from_post(self::$db_fields);	
		
		if($id)
		{
			$data['status'] 	=	$data['status'];
			$data['modified_date']	=	date('Y-m-d:H:i:s');		
			$this->db->where('id', $id);
			$this->db->update($this->_table_name ,$data);
			
		} else {
			$data['status'] 	=	$data['status'];
			$data['created_date']	=	date('Y-m-d:H:i:s');			
			$this->db->insert($this->_table_name ,$data);
			$id = $this->db->insert_id();
		}
		$obj = $this->get2($id);			
		return $obj;
			
	}
	public function getTypes($start=0,$limit=0,$status=1) 
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
	
	public function deleteTypes($id)
	{
		$result = $this->delete($id);
		return $result;

	}
	public function get_types($id) {
		if($id != FALSE) {
			$query = $this->db->get_where($this->_table_name, array('id' => $id,'status'=>1));
			//return $query->row_array();
			$types = $query->result();
			return $types[0]->name;
		}
		else {
			return FALSE;
		}
	}
	
	public function typesDrop($id=null,$status=1){
		
			$this->db->where("status = '{$status}'");
			$types = $this->get2();
		
		$option = '';
		foreach($types as $row){
			$select = '';
			if(is_numeric($id) == $row->id)
				$select = 'selected';
			
			$option .= "<option id='row' {$select} value='{$row->id}'>{$row->name}</option>";
			
		}
			
		
		return $option;
	}
	public function name_exists($name,$id=null){
		if($id)
			$this->db->where("id != {$id} and name = '{$name}'");
		else
			$this->db->where('name', $name);
		return $this->db->count_all_results($this->_table_name);
		
	}
	

}
?>
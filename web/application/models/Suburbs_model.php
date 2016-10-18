<?php 
class Suburbs_model extends CI_Model {
	protected $_table_name = 'suburbs';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'name','city_id','status','created_date','modified_date');
	
	
	
	
	
	public $id;
	public $name; 
	public $city_id; 
	public $created_date; 
	public $modified_date;	
	public $status; 	
	
	
	public function __construct(){
		$this->load->database(); 
	}
	
	
	
	
	public function getSuburbByCityId($id)
	{
 
        $this->db->select('id,name')->from($this->_table_name);
 
        $this->db->where(array('city_id'=>$id));
 
        $query = $this->db->get();
		return $query->result();
 
    }
	
	
	
	public function save($id=NULL)
	{
		
		$data = $this->array_from_post(self::$db_fields);	
		$data['status'] = $this->input->post('status');
		
		if($id)
		{
			$data['modified_date']	=	date('Y-m-d:H:i:s');		
			$this->db->where('id', $id);
			$this->db->update($this->_table_name ,$data);
			
		} else {
			$data['created_date']	=	date('Y-m-d:H:i:s');			
			$this->db->insert($this->_table_name ,$data);
			$id = $this->db->insert_id();
		}
		return $id;
			
	}
	
	public function get_suburbs($id) {
		if($id != FALSE) {
			$query = $this->db->get_where($this->_table_name, array('id' => $id));
			//return $query->row_array();
			$city = $query->result();
			return $city[0]->name;
		}
		else {
			return FALSE;
		}
	}
	
	public function suburbsDrop($id=null,$cityId=null,$status=1){
		if(!empty($cityId)){
			$this->db->where("city_id={$cityId} and status = '{$status}'");		
			$city = $this->get2();
		}else{
			$this->db->where("status = '{$status}'");
			$city = $this->suburbs_model->get();
		}	
		$option = '';
		foreach($city as $row){
			$select = '';
			if($id == $row->id)
				$select = 'selected';
			$option .= "<option id='row' {$select} value='{$row->id}'>{$row->name}</option>";
			
		}
		return $option;
	}
	public function suburbsname_exists($name,$id=null){
		if($id)
			$this->db->where("id != {$id} and name = '{$name}'");
		else
			$this->db->where('name', $name);
		return $this->db->count_all_results($this->_table_name);
		
	}
	
	public function del($id) {
		$this->delete($id);
		return true;
	}
	public function getSuburbs($city_id) {
		if($city_id != FALSE) {
			$query = $this->db->get_where($this->_table_name, array('city_id' => $city_id));
			$subcity = $query->result();
			return $subcity;
		}
		else {
			return FALSE;
		}
	}
	
}
?>
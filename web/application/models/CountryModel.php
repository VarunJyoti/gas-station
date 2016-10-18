<?php 
class CountryModel extends My_Model {
	protected $_table_name = 'country';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'name');
	
	
	
	
	
	public $id;
	public $name; 
	
	
	public function __construct()	{
		$this->load->database(); 
	}
	public function getCountry()
    {
        $this->db->select('id,name')->from('country');
 
        $query = $this->db->get();
		
        return $query->result();
    }
}
?>	
	
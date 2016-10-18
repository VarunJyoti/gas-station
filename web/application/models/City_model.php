<?php 
class City_model extends CI_Model {
	protected $_table_name = 'city';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'name','city_code', 'image','state_id','meta_description',
	'meta_content','title','meta_title','meta_keyword','created_date','modified_date','status','slug');
	
	
	
	
	
	public $id;
	public $name;
	public $city_code; 	
	public $image; 
	public $state_id; 
	public $meta_description; 
	public $meta_content; 
	public $title; 
	public $meta_keyword; 
	public $meta_title;
	public $created_date; 
	public $modified_date;	
	public $status; 	
	public $slug;
	
	public function __construct(){
		$this->load->database(); 
	}
	
	
	
	
	public function getCityByStateId($id)
 
    {
 
        $this->db->select('id,name')->from($this->_table_name);
 
        $this->db->where(array('state_id'=>$id));
 
        $query = $this->db->get();
		//print_r($query->result());die('test');
        return $query->result();
 
    }
	
	public function getCityByStId($id)
	{
 
        $this->db->select('id,name')->from($this->_table_name);
 
        $this->db->where(array('state_id'=>$id));
 
        $query = $this->db->get();
		//print_r($query->result());die('test');
        return $query->result();
 
    }
	
	public function save($id=NULL)
	{
		
		$name 			=	$this->input->post("name");
		$data = $this->array_from_post(self::$db_fields);	
		//print_r($_FILES["image"]['name'] );die('test');
		if($_FILES["image"]["error"]==0) {
			$this->gallery_path = DOCUMENT_ROOT_UPLOADS_FOLDER_PATH.'/city_image/';//realpath($this->gallery_path."/uploads/city_image");			
			$this->load->model('gallery_model');
			$data['image'] = $this->gallery_model->do_upload($this->gallery_path,"image");
		}
		else if($_FILES["image"]["error"]!=4)
		{ 
			$this->session->set_flashdata('error', 'Server Error, Please Try After Some Time');			
			return false;
		}
		if(empty($_FILES["image"]['name']))
			unset($data['image']);
		if($id)
		{
			//$this->save($data, $id);
			$data['modified_date']	=	date('Y-m-d:H:i:s');		
			$this->db->where('id', $id);
			$this->db->update($this->_table_name ,$data);
			
		} else {
			//$data['status'] 	=	1;
			//$id 				=	$this->save($data,NULL);
			$data['slug'] 	=	$this->create_unique_slug($name);			
			$data['created_date']	=	date('Y-m-d:H:i:s');			
			$this->db->insert($this->_table_name ,$data);
			$id = $this->db->insert_id();
		}
		$obj = $this->get2($id);			
		return $obj;
			
	}
	/*public function getCity($start=0,$limit=0,$status=1) 
	{
		if($status)
			$this->db->where("status = {$status}");

		//$this->db->order_by("created_date","desc");

		if($limit)
			$state = $this->get3($limit,$start);
		else
			$state = $this->get2();
		return $state;
	}*/
	public function getCity($start=0,$limit=0,$status=1,$show=0,$showheader=0,$showfooter=0) 
	{
		if($status)
			$this->db->where("status = {$status}");

		if($show){
		    if($showheader)
			  $this->db->where("show_header={$showheader}");
          
            if($showfooter)
			  $this->db->where("show_footer={$showfooter}");
			
			
		}	
			
		//$this->db->order_by("created_date","desc");
		$this->db->order_by('name','ASC');
		if($limit)
			$state = $this->get3($limit,$start);
		else
			$state = $this->get2();
		
		
		return $state;
	}
	public function deleteCity($id)
	{
		$result = $this->delete($id);
		return $result;

	}
	public function get_city($id) {
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
	
	/*
	** Get city for fronted when status is 1 
	*/
	public function cityFrontend() {
		
		$query = $this->db->get_where($this->_table_name, array('status' => 1));
		$city = $query->result();
		return $city;
		
	}
	
	
	public function getCityCode($id) {
		if($id != FALSE) {
			$query = $this->db->get_where($this->_table_name, array('id' => $id));
			$city = $query->result();
			return $city[0]->city_code;
		}
		else {
			return FALSE;
		}
	}
	
	public function cityDrop($id=null,$state_id=null,$status=1){
		if(!empty($state_id)){
			$this->db->where("state_id={$state_id} and status = '{$status}'");		
			$city = $this->get2();
		}else{
			$this->db->where("status = '{$status}'");
			$city = $this->get();
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
	public function cityname_exists($name,$id=null){
		if($id)
			$this->db->where("id != {$id} and name = '{$name}'");
		else
			$this->db->where('name', $name);
		return $this->db->count_all_results($this->_table_name);
		
	}
	public function print_image() {		
		return $image = site_url("uploads/city_image")."/".$this->image;
		
	}

	public function show_thumb($width=100,$height=100,$aspectRatio=TRUE) 
	{		
		$path =  DOCUMENT_ROOT_UPLOADS_FOLDER_PATH.'city_image';//realpath($this->gallery_path."/uploads/city_image/");
		$path .="/{$this->image}";
		return $path;
	}
	public function deleteFolderAndEmpty($id) {
		$path =  DOCUMENT_ROOT_UPLOADS_FOLDER_PATH.'/city_image/';//realpath($this->gallery_path."/uploads/city_image/");
		$city = $this->get2($id);
		$path .="/{$city->image}";
		
		unlink($path);
		//$this->delete($id);
		$data['image'] = '';
		$this->db->where('id', $id);
		$this->db->update($this->_table_name ,$data);
		return true;

	}
	
	public function del($id) {
		$path =  DOCUMENT_ROOT_UPLOADS_FOLDER_PATH.'/city_image/';//realpath($this->gallery_path."/uploads/city_image/");
		$city = $this->get2($id);
		$path .="/{$city->image}";
		
		unlink($path);
		$this->delete($id);
		return true;

	}
	
	// Get City details like name , image
	public function getCityImage($id) {
		if($id != FALSE) {
			$items = $this->db->select('name, image', false);
			$query = $this->db->get_where($this->_table_name, array('id' => $id));
			$city = $query->result();
			return $city;
		}
		else {
			return FALSE;
		}
	}
	
	/*
	** City drop down for slug code
	*/
	public function get_city_slug($id=null,$state_id=null,$status=1){
		if(!empty($state_id)){
			$this->db->where("state_id={$state_id} and status = '{$status}'");		
			$city = $this->get2();
		}else{
			$this->db->where("status = '{$status}'");
			$city = $this->get();
		}	
		$option = '';
		foreach($city as $row){ 
			$select = '';
			if($id == $row->id)
				$select = 'selected';
			$option .= "<option id='row' {$select} value='{$row->slug}'>{$row->name}</option>";
			
		}
		return $option;
	}
	/*
	** get city id from slug
	*/
	public function get_city_id($slug=null,$status=1){
		if(!empty($slug)){
			$this->db->where("slug='{$slug}' and status = '{$status}'");		
			$city = $this->get2();
			return $city[0]->id;
		}else{
			return false;
		}
	}
	
	/*
	** get city id from city name
	*/
	public function get_city_id_by_name($name=null,$status=1){
		if(!empty($name)){
			$this->db->where("name='{$name}' and status = '{$status}'");		
			$city = $this->get2();
			
			return $city[0]->id;
		}else{
			return false;
		}
	}
	
	/*
	** get city from autocomplete
	*/
	public function getautoCompleteCity($q){

		$this->db->select('a.name as city_name,b.*');
		$this->db->from('city a'); 
		$this->db->like('a.name',$q);
		$this->db->join('state b', 'a.state_id=b.id', 'left');
		$this->db->where('a.status','1');
		$this->db->order_by('a.name','asc');         
		$query = $this->db->get(); 
		if($query->num_rows() != 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	
	
}
?>
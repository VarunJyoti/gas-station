<?php 
class Email_model extends CI_Model {
	protected $_table_name = 'email_template';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'template_name','content','reg_step',
	'attach','from_to','subject','created_date','modified_date','status','slug');
	
	
	
	
	
	public $id;
	public $template_name;
	public $content; 	
	public $subject; 
	public $reg_step;
	public $from_to;
	public $created_date; 
	public $modified_date;	
	public $status; 	
	public $slug;
	public $attach;
	
	public function __construct(){
		$this->load->database(); 
	}
	
	public function save($id=NULL)
	{
		
		$name 			=	$this->input->post("template_name");
		$data = $this->array_from_post(self::$db_fields);
		$data['from_to'] 			=	$this->input->post("from_to");
		$data['subject'] 			=	$this->input->post("subject");
		$data['content'] 			=	$this->input->post("meta_content");
		$attach 					= 	$this->input->post("attach");
		
		if(!empty($attach[0])){
			$attach						=	serialize($attach);
			$data['attach'] 			=	$attach;
		}else{
			unset($data['attach']);
		}	
		//print_r($data);die('hello');
		if($id)
		{
			//$this->save($data, $id);
			$data['modified_date']	=	date('Y-m-d:H:i:s');		
			$data['status']  =  $this->input->post('status');
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
	
	public function tempname_exists($name,$id=null){
		if($id)
			$this->db->where("id != {$id} and template_name = '{$name}'");
		else
			$this->db->where('template_name', $name);
		return $this->db->count_all_results($this->_table_name);
		
	}
	/*
	** Get Templete by reg_step id 
	*/
	
	public function getTemplateByRegStep($reg_step)
	{	
		$query = $this->db->get_where($this->_table_name, array('reg_step' => $reg_step,'status'=>'1'));
		$rest = $query->result();
		return $rest[0];
		
	}
	public function deleteCity($id)
	{
		$result = $this->delete($id);
		return $result;

	}
	
	/**** Page title list *****/
	public function PageTitleList($id=null,$status=1){
		
		$query = $this->db->get_where($this->_table_name);
		$result = $query->result();
		//print_r($result);die('hello');
		$reg_step = '';
		foreach($result as $row){
			$reg_step .=  $row->reg_step.',';
		}
		$rtrim =  rtrim($reg_step,',');
		$arr_pagetitle_id = explode(',',$rtrim);
		
		
		$types = $this->StepNameArr();
		$option = '';
		foreach($types as $key=>$val){
			$select = '';
			if(!in_array($key,$arr_pagetitle_id)){	
				if(is_numeric($id) == $key)
					$select = 'selected';
				
				$option .= "<option id='row' {$select} value='{$key}'>{$val}</option>";
			}
		}
			
		
		return $option;
	}
	
	public function show_thumb($image,$path,$width=100,$height=100,$aspectRatio=TRUE) 
	{		
		$path =  DOCUMENT_ROOT_UPLOADS_FOLDER_PATH.$path;//realpath($this->gallery_path."/uploads/city_image/");
		$path .="/{$image}";
		return $path;
	}
	
	public function deleteFolderAndEmpty($id) {
		$path =  DOCUMENT_ROOT_UPLOADS_FOLDER_PATH.'/templates/';//realpath($this->gallery_path."/uploads/city_image/");
		$template = $this->get2($id);
		$path .="/{$template->attach}";
		
		unlink($path);
		//$this->delete($id);
		$data['image'] = '';
		$this->db->where('id', $id);
		$this->db->update($this->_table_name ,$data);
		return true;

	}
	
}
?>
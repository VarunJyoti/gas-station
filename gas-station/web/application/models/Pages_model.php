<?php
class Pages_model extends CI_Model{
	protected $_table_name = 'pages';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'title','position', 'html_title', 'slug', 'heading', 'meta_title', 'meta_keyword', 'meta_description',
	'images', 'content', 'createtime', 'modifytime', 'status');
	
	public $id;
	public $title; 
	public $html_title; 
	public $slug; 
	public $heading; 
	public $meta_title; 
	public $meta_keyword; 
	public $meta_description;
	public $images;
	public $content;
	public $position;
	public $createtime; 
	public $modifytime; 
	public $status;	
	
	//public $delete_status; //1 if delte

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function savePage($id=NULL,$table='pages')
	{
		
		$data 					= $this->array_from_post(self::$db_fields);	
		
		$data['content'] 	=	$this->input->post("_content");		
		$title 			=	$this->input->post("title");
		
		
		//upload image
		if($_FILES["images"]["error"]==0) 
		{
		 	$this->load->model("gallery_model");		 	
		 	$path = $this->gallery_path."/uploads/pages/";
			//$path 		=	realpath($this->gallery_path."/uploads/pages/");
		 	
		 	$data['images'] =	$this->gallery_model->do_upload($path,"images");
		 	
			if(!empty($data['images'])){
		 		return false;
			}	
			
		}
		else if($_FILES["images"]["error"]!=4) {
			$this->session->set_flashdata('error', 'Image Upload Error');
			return false;
		}
		
		if($id)
		{
			$data['modifytime'] 	=	time();	
			$status 			=	$this->input->post("status");		
			if($status != 1)
				$data['status'] = 0;

			$this->db->where('id', $id);
			$last_id = $this->db->update($table ,$data);
			if($last_id !== 0){
				return true;
			}else{
				return false;
			}
			//$this->save($data, $id);

		} else {
			$data['slug'] 	=	$this->create_unique_slug($title);			
			$data['status']			=	1;
			$data['createtime']		=	time();			
			
			//$this->save($data, $id);
			$last_id = $this->db->insert($table ,$data);
			if($last_id !== 0){
				return true;
			}else{
				return false;
			}
			//$id = (empty($id)) ? $this->db->insert_id() : $id; 					
			
		}
		//$obj = $this->get2($id);			
		//return true;			
	}


	public function getUsers($account_type = "All") 
	{
		if($account_type != "All"){			
			$this->db->where("account_type = '{$account_type}' and delete_status = 0");
		} else {
			$this->db->where("delete_status = 0");
		}
		$users = $this->get2(NULL,false);
		return $users;
	}

	public function getPage($slug) 
	{
		$this->db->where("slug = '{$slug}'");		
		$page = $this->get();
		
		return $page[0];
	}
	
	public function getallPage() 
	{
		$this->db->where("status = '1'");
		$this->db->order_by("position",'ASC');
		$page = $this->get2();
		return $page;
	}

	public function printStatus()
	{
		switch($this->status)
		{
			case 1: 
				return "Active";
			default:
				return "Disabled";
		}
	}

	public function deletePage($id)
	{
		$result = $this->delete($id);
		return $result;

	}

	public function printImage()
	{
		
		$url=site_url("uploads/pages/{$this->images}");
		return $url;
	}
	


	
}


?>
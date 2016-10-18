<?php
class Banner_model extends CI_Model
{
	protected $_table_name = 'banners';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'name', 'image', 'heading', 'description', 'order', 'status', 'created_date','modified_date');
	public $id;
	public $name;
	public $heading;
	public $description;
	public $order;
	public $status;
	public $created_date;
	public $image;
	public $modified_date;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	


	public function getBanner($total=100) {
		$this->db->where('status = 1');
		$categories 	=	$this->get2();//$this->get3(0,$total);		
		return $categories;
	}


	


	public function saveBanner($id=NULL,$table='banners')
	{
		$data = $this->array_from_post(self::$db_fields);	

		if($_FILES["image"]["error"]==0) {
			$this->gallery_path=realpath($this->gallery_path."/uploads/banner_image");			
			$this->load->model('gallery_model');
			$data['image'] = $this->gallery_model->do_upload($this->gallery_path,"image");
		}
		else if($_FILES["image"]["error"]!=4)
		{ 
			$this->session->set_flashdata('error', 'Server Error, Please Try After Some Time');			
			return false;
		}
		if($id)
		{
			//$this->save($data, $id);
			$data['modified_date']	=	date('Y-m-d:H:i:s');		
			$this->db->where('id', $id);
			$this->db->update($table ,$data);
			
		} else {
			$data['status'] 	=	1;
			//$id 				=	$this->save($data,NULL);
			$data['created_date']	=	date('Y-m-d:H:i:s');			
			$this->db->insert($table ,$data);
			$id = $this->db->insert_id();
		}
		$obj = $this->get2($id);			
		return $obj;

	}


	

	public function del($id) {
		$path =  realpath($this->gallery_path."/uploads/banner_image/");
		$banner = $this->get2($id);
		$path .="/{$banner->image}";
		
		unlink($path);
		$this->delete($id);
		return true;

	}
		
	public function print_image() {		
		return $image = site_url("uploads/banner_image")."/".$this->image;
		
	}

	public function show_thumb($width=100,$height=100,$aspectRatio=TRUE) 
	{		
		$path =  realpath($this->gallery_path."/uploads/banner_image/");
		$path .="/{$this->image}";
		return $path;
	}


	public function printStatus()
	{
		switch($this->status) {
	 		case 1: 
	 			return "Show";
	 		case 2:
	 			return "Hide";
	 		default:
	 			return "Deleted";
	 	}
	}

	public function deleteFolderAndEmpty($id,$table='banners') {
		$path =  realpath($this->gallery_path."/uploads/banner_image/");
		$banner = $this->get2($id);
		$path .="/{$banner->image}";
		
		unlink($path);
		//$this->delete($id);
		$data['image'] = '';
		$this->db->where('id', $id);
		$this->db->update($table ,$data);
		return true;

	}
	

	

	
}



















?>
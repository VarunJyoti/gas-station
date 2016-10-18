<?php
class Setting_model extends CI_Model {
	protected $_table_name = 'settings';
	protected $_order_by = 'id';
	protected static $db_fields = array('id','website_title','site_logo_image','site_favicon_icon', 'from_email', 'address', 'address2', 'city','status',
	'pincode', 'contact_no', 'fb_url', 'twitter_url','created_date','modified_date','google_plus_url','you_tube');
	
	public $id;
	public $website_title;
	public $site_logo_image;
	public $site_favicon_icon;
	public $from_email;
	public $address;
	public $address2;
	public $city; 
	public $pincode; 
	public $contact_no; 
	public $fb_url;
	public $twitter_url;
	public $created_date;
	public $modified_date;
	public $google_plus_url;
	public $you_tube;
	public $status;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('cookie');
		$this->load->helper('date');
		
	}
	
	/*
	** save contact method
	*/
	public function save($id=NULL){
		$data = $this->array_from_post(self::$db_fields);
		
		$data['fb_url'] 			= 	$this->input->post('fb_url');
		$data['twitter_url'] 		= 	$this->input->post('twitter_url');
		$data['google_plus_url'] 	= 	$this->input->post('google_plus_url');
		$data['you_tube'] 			= 	$this->input->post('you_tube');
		
		if(isset($data['id']))
			$id = $data['id'];
		if($id)
			$data['modified_date']	=	date("Y-m-d:H:i:s");
		else
			$data['created_date']	=	date("Y-m-d:H:i:s");
		
		
		//print_r($_FILES);die('test');
		$config = array(
            'upload_path'   => DOCUMENT_ROOT_UPLOADS_FOLDER_PATH.'images/',
            'allowed_types' => 'gif|jpg|png',
            'max_size'      => '100',
            'max_width'     => '1024',
            'max_height'    => '768',
            'encrypt_name'  => true,
        );
	
		//print_r($config);
        $this->load->library('upload', $config);
		if($_FILES['site_logo_image']['name']){
			$upload = $this->upload->do_upload("site_logo_image");
			if($upload === FALSE) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error', $error['error']);
				return false;	
			}else {
				$upload_data = $this->upload->data();
				$data_ary = array(
					'title'     => $upload_data['client_name'],
					'file'      => $upload_data['file_name'],
					'width'     => $upload_data['image_width'],
					'height'    => $upload_data['image_height'],
					'type'      => $upload_data['image_type'],
					'size'      => $upload_data['file_size'],
					'date'      => time(),
				);
				$data['site_logo_image']	=	$upload_data['file_name'];
				
			}
        }
		if($_FILES['site_favicon_icon']['name']){
			if (!$this->upload->do_upload('site_favicon_icon')) {
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('error', $error['error']);
				return false;
			} else {
				$upload_data = $this->upload->data();
				
				$data_ary = array(
					'title'     => $upload_data['client_name'],
					'file'      => $upload_data['file_name'],
					'width'     => $upload_data['image_width'],
					'height'    => $upload_data['image_height'],
					'type'      => $upload_data['image_type'],
					'size'      => $upload_data['file_size'],
					'date'      => time(),
				);
				$data['site_favicon_icon']	=	$upload_data['file_name'];
				//print_r($data_ary);die('test');
			}
        }
		
		//print_r($data);die('test');
		
		$this->db->where('id', $id);
		$last_id = $this->db->update($this->_table_name,$data);
		if($last_id)
			return true;
		else
			return false;
		
	}
	
	/*
	** Setting Get
	*/
	public function get_setting_admin(){
		$data	=	$this->get();
		return $data[0];
	}
	
}


?>
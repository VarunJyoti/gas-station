<?php  
class Email extends Admin_Controller
{ 

	
	function __construct()
	{
		parent::__construct();	
		$this->load->model('Email_model');
		$this->load->library("ckeditor");
		
		
	}
	
	/****temp list *****/
	
	function index()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Template List";
		
		$totalcat = $this->Email_model->get();		
		$this->config->load('pagination2', TRUE);
		$config = $this->config->item('pagination2');		
		$config['base_url'] 	=	site_url('admin/email/list');
		$config['total_rows'] 	=	count($totalcat);
		$config['per_page'] 	= 10;
		$config['uri_segment']  = 4;		
		
		//pagination
		
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		
		$page =($this->uri->segment(4)?$this->uri->segment(4):0);	

		
		//$this->db->where("status = 1");
		$city = $this->Email_model->get3($config['per_page'],$page);
		
		$data['totalrow'] =	count($totalcat);
		$data['per_page'] = $config['per_page'];

		$data['email_data'] 	=	$city;
		$data['page'] 			=	$page;
		
		$this->layout('email/list',$data); 
			
		

	}
	
	
	function add()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add New Template";
		$data['name'] = "";
		$data['description'] ="";	
		$data['error']		=	"";
		$this->layout('email/add',$data); 
	}
	
	/***save****/
	
	public function save() 
	{ 
		if($this->input->post('save_template') || $this->input->post('edit_template'))
		{ 
			$this->form_validation->set_error_delimiters('<p class="error help-block"><span class="label label-important">','</span></p>');
			$this->form_validation->set_rules('reg_step', 'Page display', 'required');
			//$this->form_validation->set_rules('from_to', 'From', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			//$this->form_validation->set_rules('title', 'Title', 'required');
			//$this->form_validation->set_rules($image, 'Image', "file_required|file_min_size[10KB]|file_max_size[500KB]|file_allowed_type[image]|file_image_mindim[50,50]|file_image_maxdim[400,300]");
			$id =  $this->input->post('id');
			
			
			if ($this->form_validation->run() == FALSE) {  	
				if($this->input->post('save_template'))
					$this->add();
				else
					redirect("admin/email/edit/{$id}");
			} else { 
				$id =  $this->input->post('id');
				
								
				if($id){
					$city =  $this->Email_model->save($id);					
					$this->session->set_flashdata('success', 'Email Template updated SuccessFully');
				} else {
					$city =  $this->Email_model->save($id);
					$this->session->set_flashdata('success', 'Email Template Add SuccessFully');				
				}
				redirect("admin/email");
					
			}
		} else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/email/list");
		}
	}
	
	/*
	** Edit city 
	*/

	function edit()
	{
		$data['admin'] = $this->admin;
		$id = $this->uri->segment(4, 0);
		
		if($id){
			$city = $this->Email_model->get2($id);			
			if($city){
				$SITE_TITLE = SITE_TITLE;
				$data['title'] = "$SITE_TITLE Admin || Edit email";
				$data['page'] = $city;
				$data['error'] = "";
				$data['template_name'] = "";
				$data['description'] ="";
				$data['error'] = "";
				$this->layout('email/edit',$data); 
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/email");
			}
		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/email");

		}	

	
	}
	
	/*
	*
	delete
	*
	*/
	
	function delete() {
		$id = $this->uri->segment(4, 0);
		
		if($id){
			//$this->db->where("slug = '{$id}'");
			$rslts = $this->Email_model->get2($id);				
			if($rslts){
				$this->Email_model->deleteCity($rslts->id);
				$this->session->set_flashdata('success', 'Email Delete SuccessFully');
				redirect("admin/email");
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/email");
			}
					

		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/email");

		}	

	}
	
	
	public function checkdublicate()
	{
		$name = trim($this->input->post('template_name'));
		// if the name exists return a 1 indicating true
		$rst = $this->Email_model->tempname_exists($name);
		if ($rst) {
			echo '1';
			exit;
		}
	}
	/*
	** Show Thumbs image
	*/
	public function thumbs()
	{
		//$this->load->library('easyphpthumbnail');
	
		$image = $this->input->get("image");

		$new_height = $this->input->get("h");

		$new_width = $this->input->get("w");


		list($originalWidth, $originalHeight) = getimagesize($image);

		$v_fact = $new_height / $originalHeight;
		$h_fact = $new_width / $originalWidth;

		$im_fact    =  min($v_fact, $h_fact);
		$thumb_w    =  floor($originalWidth * $im_fact);
	    $thumb_h    =  floor($originalHeight * $im_fact);  

		$thumb = new easyphpthumbnail;
		//$thumb -> Inflate = true;

		
		$thumb -> Thumbwidth = $thumb_w;		
		$thumb -> Thumbheight = $thumb_h;


		$thumb -> Createthumb($image);

		
	}
	/*
	** Delete email template attachment
	*/
	function deleTeteplateImages() {
		$id = $this->uri->segment(4, 0);
		$img_name = $this->uri->segment(5, 0);
		
		if($id){
			$city = $this->Email_model->get2($id);				
			if($city){
				$this->Email_model->deleteFolderAndEmpty($city->id);
				$this->session->set_flashdata('success', 'City Delete SuccessFully');
				redirect("admin/email/edit/$id");
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/email/edit/$id");
			}
					

		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/email");

		}	

	}
	
	/*
	*** load CkEditor
	*/
	public function loadEditorByAjax(){
		$this->load->view('admin/email/loadEditorByAjax');
	}
	


}
<?php
class Banner extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();	
		$this->load->model('banner_model');
		$this->load->library("ckeditor");
	
	}
	/*
	** List Banner 
	*/
	function index()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || banner List";
		$totalcat = $this->banner_model->get();		
		$this->config->load('pagination2', TRUE);
		$config = $this->config->item('pagination2');		
		$config['base_url'] 	=	site_url('admin/banner/bannerlist');
		$config['total_rows'] 	=	count($totalcat);
		$config['per_page'] 	= 10;
		$config['uri_segment']  = 4;		
		
		//pagination
		
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		
		$page =($this->uri->segment(4)?$this->uri->segment(4):0);	

		
		//$this->db->where("status = 1");
		$banner = $this->banner_model->get3($config['per_page'],$page);
		
		$data['totalrow'] =	count($totalcat);
		$data['per_page'] = $config['per_page'];

		$data['banner_data'] 	=	$banner;
		$data['page'] 			=	$page;
		$this->layout('banner/list',$data); 

	}
	/*
	** Add Banner Page
	*/
	function add()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add New banner";
		$data['name'] = "";
		$data['description'] ="";	
		$data['error']		=	"";
		$this->layout('banner/add',$data);
	}

	/*
	** Save Banner
	*/
	public function save() 
	{
		if($this->input->post('save_banner') || $this->input->post('edit_banner'))
		{	
			$image =  $this->input->post('image');	
			$this->form_validation->set_error_delimiters('<p class="error help-block"><span class="label label-important">','</span></p>');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules($image, 'Image', "file_required|file_min_size[10KB]|file_max_size[500KB]|file_allowed_type[image]|file_image_mindim[50,50]|file_image_maxdim[400,300]");
			if ($this->form_validation->run() == FALSE) {
				if($this->input->post('save_banner'))
					$this->add();
				else
					$this->edit();
			} else {
				$id =  $this->input->post('id');			
				if($id) {
					//$result = $this->banner_model->checkbannerExist($id);
					$banner =  $this->banner_model->saveBanner($id);					
					$this->session->set_flashdata('success', 'Banner update SuccessFully');
				} else {
					$banner =  $this->banner_model->saveBanner($id);
					$this->session->set_flashdata('success', 'banner Add SuccessFully');				
				}
				redirect("admin/banner/view/{$banner->id}");
			}
		} else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/banner");
		}
	}

	/*
	** Edit Banner Page
	*/
	function edit()
	{
		$id = $this->uri->segment(4, 0);
		if($id){
			$banner = $this->banner_model->get2($id);			
			if($banner){
				$SITE_TITLE = SITE_TITLE;
				$data['title'] = "$SITE_TITLE Admin || Edit banner";
				$data['banner'] = $banner;
				$data['error'] = "";
				$data['name'] = "";
				$data['description'] ="";
				$data['error'] = "";

				$this->layout('banner/edit',$data);
				
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/banner");
			}
		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/banner");

		}	

	
	}

	/*
	** View Banner
	*/
	function view() 
	{
		$id = $this->uri->segment(4, 0);
		if($id){
			$banner = $this->banner_model->get2($id);			
			if($banner){
				$SITE_TITLE = SITE_TITLE;
				$data['title'] = "$SITE_TITLE Admin || View banner";
				$data['banner'] = $banner;	
				$this->layout('banner/view',$data);	
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/banner");			}
		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/banner");
		}	

	}

	/*
	** Delete banner
	*/
	function delete() {
		$id = $this->uri->segment(4, 0);
		
		if($id){
			//$this->db->where("slug = '{$id}'");
			$banner = $this->banner_model->get2($id);				
			if($banner){
				$this->banner_model->del($banner->id);
				$this->session->set_flashdata('success', 'banner Delete SuccessFully');
				redirect("admin/banner");
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/banner");
			}
					

		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/banner");

		}	

	}
	/*
	** Delete banner image
	*/
	function deleteBannerImages() {
		$id = $this->uri->segment(4, 0);
		$img_name = $this->uri->segment(5, 0);
		
		if($id){
			$banner = $this->banner_model->get2($id);				
			if($banner){
				$this->banner_model->deleteFolderAndEmpty($banner->id);
				$this->session->set_flashdata('success', 'banner Delete SuccessFully');
				redirect("admin/banner/edit/$id");
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/banner/edit/$id");
			}
					

		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/banner");

		}	

	}



}
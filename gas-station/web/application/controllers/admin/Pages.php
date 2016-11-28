<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();			
		
		$this->load->model('pages_model','',TRUE);
		$this->load->model('systemtool_m');	
		$this->load->library("ckeditor");

		
	}
	/*
	** List Pages
	*/
	public function index()
	{		$usr_type = loginUser();		if($usr_type =='super')		{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Page Managment";
		$data['pages']		=	$this->pages_model->get2();
		$data['admin'] = $admin;
		$data['title'] = "Wowrooms Admin || Edit Subadmin Profile";
		$this->layout('pages/list',$data);
		}		else{							redirect("admin/login/logout");		}
	}
	/*
	** Add Page
	*/
	public function add()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		$data['error'] = "";
		$this->layout('pages/add',$data);
		
	}

	/*
	** Save Page
	*/
	public function save()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		if($this->input->post('save_page'))
		{
			
			$id 	=	$this->input->post("id")?$this->input->post("id"):NULL;
			
			if($id)
			{
				$page 	=	$this->pages_model->savePage($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/pages/{$page->slug}");

			} else {
				$page 	=	$this->pages_model->savePage(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Page Add SuccesFully</span></div> ');			
				redirect("admin/pages/{$page->slug}");
			}			
			
		} else {
			redirect("admin/pages/");
		}
	}
	/*
	** View Page
	*/
	public function view($slug) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		$page 			=	$this->pages_model->getPage($slug);
		if($page) {
			$data['page']	=	$page;
			$this->layout('pages/view',$data);
			
		} else {
			redirect("admin/pages");
		}
	}

	
	/*
	** Edit Page
	*/
	public function edit($slug) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->pages_model->getPage($slug);
		if($page) {
			$data['page']	=	$page;
			$this->layout('pages/edit',$data);
				
		} else {
			redirect("admin/pages");
		}
	}
	/*
	** Delete page 
	*/
	public function delete($slug)
	{
		if($slug)
		{			
			$page 			=	$this->pages_model->getPage($slug);
			if($page)
			{
				$result 			=	$this->pages_model->deletePage($page->id);
				//$this->session->set_flashdata('success', 'Record Deleted SuccesFully');
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');			
				
				redirect("admin/pages");
			} 
		}		

	}

}

/* End of file Pages.php */
/* Location: ./application/controllers/admin/pages.php */
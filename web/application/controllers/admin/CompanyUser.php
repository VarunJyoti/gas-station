<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();			
		
		$this->load->model('enduser_model','',TRUE);
		$this->load->model('systemtool_m');	
		$this->load->library("ckeditor");
		$this->load->helper('email');
		$this->load->helper('url');
		

		
	}
	/*
	** List Company
	*/
	public function index()
	{
		 
		echo $user_type = loginUser();
		if ($user_type == 'super')
       {
		
		

		
		
		
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || End User Managment";//die('5');
		
       
		
		  $start = ($this->uri->segment(4)?$this->uri->segment(4):0); //start


        $total                  =   10; //items on a page


		$q = '';

		// search

 		if($this->input->get('search')){

			$q = trim($this->input->get("q"));

			$data['q'] = $q;

		}
		
		if(!empty($q)){

			$total_company     	=   $this->company_model->get3($q);

            $company			  	= 	$this->company_model->get3($q,$total,$start);


		}else{

			$total_company         	=   $this->company_model->get3(0,0,0);
			

			$company              	=   $this->company_model->get3($total,$start,0);  //start,$limit,status

		}

      

		 $data['company']			=	$company;

		$data['total_company']	=   count($total_company);
		

        $data['start']       	=   $start;

		

		//pagination

		$this->load->library('pagination');

		$this->config->load('pagination2', TRUE);

		$config 				= 	$this->config->item('pagination2'); 

		$config['uri_segment']  =   4;  //uri segment

        	

		$config['base_url'] 	= 	site_url("admin/company/index/");

		$config['total_rows']   =   count($total_company);

        $config['per_page']     =   $total;



		$this->pagination->initialize($config); 



		$this->pagination->create_links();
		
		$this->layout('company/list',$data);
	}
	
	elseif($user_type == 'admin')
        {
			
       $SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page1 	=	$this->company_model->getCompanyId();
		$p=$page1['0']->c_id;
		//print_r($page1) ;
		//die('error');
		$page 	=	$this->company_model->getPage($p);
		//print_r($page);
		
		if($page) {
			
			$data['page']	=	$page;
			$this->layout('company/edit',$data);
				
		} else {
			redirect("admin/company");
		}
		
            }
		
		else
		{
			
			
		}
		
}
		
	/*
	** Add Company
	*/
	public function add()
	{
		
		$usr_type = loginUser();

		if($usr_type =='super')
		{
		//$this->company_model->getallProduct();	
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		$data['error'] = "";
	
		 $data['products'] = $this->company_model->getallProduct(); 
		 //print_r($data['products']);
		// die('error');	
		 $this->layout('company/add',$data);
		}
		else{
	redirect("admin/login/logout");
	}
		
	}

	/*
	** Save Page
	*/
	public function save()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		if($this->input->post('save_page'))
		{
			//print_r($this->input->post());
		//	die("error");
			$id 	=	$this->input->post("id")?$this->input->post("id"):NULL;
			
			if($id)
			{
				$page 	=	$this->company_model->savePage($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/company/{$page->id}");

			} else {
				$page 	=	$this->company_model->savePage(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Company Add SuccesFully</span></div> ');			
				redirect("admin/company/{$page->id}");
			}			
			
		} else {
			redirect("admin/company/");
		}
	}
	/*
	** View Page
	*/
	public function view($slug) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		$page 	=	$this->pages_model->getPage($slug);
		
		if($page) {
			$data['page']	=	$page;
			$this->layout('company/view',$data);
			
		} else {
			redirect("admin/company");
		}
		
	}

	
	/*
	** Edit Page
	*/
	public function edit($id) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->company_model->getPage($id);
		$data['products'] = $this->company_model->getallProduct(); 
		
		if($page) {
			
			$data['page']	=	$page;
			$this->layout('company/edit',$data);
				
		} else {
			redirect("admin/company");
		}
	}
	/*
	** Delete page  
	*/
	public function delete($id)
	{
		if($id)
		{			
			/*$page 			=	$this->company_model->getPage($id);
			if($page)
			{*/
				$result 			=	$this->company_model->deletePage($id);
				//$this->session->set_flashdata('success', 'Record Deleted SuccesFully');
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Deleted SuccesFully</span></div> ');			
				
				redirect("admin/company");
			//} 
		}		

	}
	
	
	
	/*
	** Edit Profile
	*/
	
	

}

/* End of file Pages.php */
/* Location: ./application/controllers/admin/company.php */
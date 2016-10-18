<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();			
		
		$this->load->model('company_model','',TRUE);
		$this->load->model('systemtool_m');	
		$this->load->model('mainproduct_model');
        $this->load->model('gasolinereceived_model');
        $this->load->model('daily_shift_model');		
		$this->load->library("ckeditor");
		$this->load->helper('login');
		$this->load->helper('email');
		$this->load->helper('url');
		$this->load->library('user_agent');
	}
	/*
	** List Company
	*/
	public function index()
	{
		 
		$user_type = loginUser();
		if ($user_type == 'super')
       {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Company Managment";//die('5');
		$start          =   $this->input->get("per_page");	 //start
		$total                  =   10; //items on a page
		$q = '';
		// search
 		if($this->input->get('q')){
			$q = trim($this->input->get("q"));
			$data['q'] = $q;
           
		}
		$select_val				=	$this->input->get("select_val");
		$order_by				=	'date_created desc';
		
		
		if(($select_val) || ($q)){ 
				
            $company			  	= 	$this->company_model->get3($q,$total,$start,'',$order_by,$select_val);
			$total_company     	=   $this->company_model->get3($q,'','','','',$select_val);


		}
		
		else{
			
			$total_company         	=   $this->company_model->get3('',0,0,0,'');
			$company              	=   $this->company_model->get3('',$total,$start,0,$order_by);  
		
		} 
		$data['company']			=	$company;
		$data['total_company']	=   count($total_company);
		$data['start']       	=   $start;

		//pagination

		$this->load->library('pagination');
		$this->config->load('pagination2', TRUE);
		$config 				= 	$this->config->item('pagination2'); 
		$config['uri_segment']  =   4;  //uri segment
		$config['page_query_string']    =   TRUE;
	    $config['base_url'] 	= 	site_url("admin/company/index?q={$q}&select_val={$select_val}");
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
		$page 	=	$this->company_model->getPage($p);
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
			
		$username =  $this->input->post('username');
        $SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		$data['error'] = "";
	
		 $data['products'] = $this->company_model->getallProduct(); 
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
	** Save Price
	*/
	public function saveprice()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		if($this->input->post('save_page'))
		{
			$id 	=	$this->input->post("p_id")?$this->input->post("p_id"):NULL;
			
			if($id)
			{
				
				$page 	=	$this->mainproduct_model->savePage($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/company/mainproduct");

			} 		
			
		} else {
			redirect("admin/company/mainproduct");
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
	
	** Gasoline View Page start ---------------------------------------------------------
	*/
	public function records() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		
		  $data['shiftNo'] 	=	$this->company_model->getShiftNo();
		  $data['shiftDate'] 	=	$this->company_model->getShiftDate();
			if($this->input->get('find')){
			$shift = $this->input->get("shift");
			
			$date = $this->input->get("date");
			print_r($shift); 
			print_r($date);
			$data['Gasoline_Record'] 	=	$this->company_model->getGasolineRecordByShift($date,$shift);
			
			$data['pid1'] 	=	$this->daily_shift_model->getProductId();
           
		}

			$this->layout('company/records',$data);
			
		}
		
		

	/*
	
	** Gasoline View Page ends ---------------------------------------------------------
	*/


	
	/*
	** Edit Page
	*/
	public function edit($id) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->company_model->getPage($id);
		
 
		$data['products'] = $this->company_model->getallProduct(); 
		$data['products_name'] = $this->company_model->getProductName($id); 
		if($page) {
			   
			$data['page']	=	$page;
			
			$this->layout('company/edit',$data);
				
		} else {
			redirect("admin/company");
		}
	}
	
	/*
	** Edit Main Product Price
	*/
	public function editprice($id) {
		
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->mainproduct_model->getPage($id);
		//print_r($page);die;
		if(!$page) {
		 $this->load->model('product_model');
		 
		 $data['page']	=	$this->product_model->getProductName($id);
				
		} else {
			$data['page']	=	$page ;
		}
			$this->layout('company/editprice',$data);
	}
	
	/*
	** Manage Main Product Page
	*/
	public function mainproduct() {
		
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page1 	=	$this->company_model->getCompanyId();
		$p=$page1['0']->c_id;
		$this->load->model('product_model');
		$page1=	$this->company_model->getMainProducts();
		$data['page1']	=	$page1; 
		if($page1) {
			$data['page1']	=	$page1;
			$this->layout('company/mainproduct',$data);
				
		} else {
			redirect("admin/company");
		}
	
		
	}
	/*
	
	** Delete page  
	*/
	public function delete($email)
	{
		if($email)
		{			
			$result 			=	$this->company_model->deletePage($email);
			$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Deleted SuccesFully</span></div> ');			
			//redirect("admin/company");
				
			
		}
			redirect($this->agent->referrer());		

	}
	
	/*
	** Check email availablity
	*/
	function check_email_availablity()
      {
		$email = $this->input->post('email');
		$this->load->model('company_model');
	    $get_result = $this->company_model->check_email_available($email);
		print_r($get_result);
	  }
	  function check_username_availablity()
      {
		$username = $this->input->post('username');
		$this->load->model('company_model');
	    $get_result = $this->company_model->check_username_available($username);
		print_r($get_result);
	  }
	
	
	

}

/* End of file Pages.php */
/* Location: ./application/controllers/admin/company.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();			
		
		$this->load->model('product_model','',TRUE);
		$this->load->model('systemtool_m');	
		$this->load->model('gallery_model');	
		$this->load->library("ckeditor");
		$this->load->helper('email');
		$this->load->helper('url');
		

		
	}
	/*
	** List Company
	*/
	public function index()
	{
		
	
		
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Product Managment";//die('5');
		$start          =   $this->input->get("per_page");	 //start
		$total                  =   10; //items on a page
		$q = '';
		if($this->input->get('q')){
			$q = trim($this->input->get("q"));
			$data['q'] = $q;

		}
		
		$select_val				=	$this->input->get("select_val");
		$order_by				=	'date_created desc';
	
		
		if(($select_val) || ($q)){ 
				
            $product			  	= 	$this->product_model->getproducts($q,$total,$start,'',$order_by,$select_val);
			
			$total_product   	=   $this->product_model->getproducts($q,'','','','',$select_val);


		}
		else{

			$total_product         	=   $this->product_model->getproducts('',0,0,0);
			$product              	=   $this->product_model->getproducts('',$total,$start,0);  //start,$limit,status

		} 
      

		 $data['product']			=	$product;

		$data['total_product']	=   count($total_product);
		

        $data['start']       	=   $start;

		

		//pagination

		$this->load->library('pagination');

		$this->config->load('pagination2', TRUE);

		$config 				= 	$this->config->item('pagination2'); 

		$config['uri_segment']  =   4;  //uri segment

        	
		$config['page_query_string']    =   TRUE;
		$config['base_url'] 	= 	site_url("admin/product/index/");

		$config['total_rows']   =   count($total_product);

        $config['per_page']     =   $total;



		$this->pagination->initialize($config); 



		$this->pagination->create_links();

		$this->layout('product/list',$data);

		
	}
	

		
	/*
	** Add Company
	*/
	public function add()
	{ 
		$usr_type = loginUser();

		if($usr_type =='super' OR $usr_type =='admin')
		{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		$data['error'] = "";
		$this->layout('product/add',$data);
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
				$page 	=	$this->product_model->savePage($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/product/{$page->id}");

			} else {
				$page 	=	$this->product_model->savePage(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Product Add SuccesFully</span></div> ');			
				redirect("admin/product/{$page->id}");
			}			
			
		} else {
				redirect("admin/product/");
		}
	}
	/*
	** View Page
	*/
	public function view($slug) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		$page 			=	$this->product_model->getPage($slug);
		if($page) {
			$data['page']	=	$page;
			$this->layout('product/view',$data);
			
		} else {
			redirect("admin/product");
		}
		
	}

	
	/*
	** Edit Page
	*/
	public function edit($id) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->product_model->getPage($id);
		if($page) {
			
			$data['page']	=	$page;
			$this->layout('product/edit',$data);
				
		} else {
			redirect("admin/product");
		}
	}
	
	
	
	public function editStoreProduct($id) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->product_model->getStoreProductPage($id);
		if($page) {
			
			$data['page']	=	$page;
			$this->layout('product/edit',$data);
				
		} else {
			redirect("admin/product");
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
				$result 			=	$this->product_model->deletePage($id);
				//$this->session->set_flashdata('success', 'Record Deleted SuccesFully');
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Deleted SuccesFully</span></div> ');			
				
				redirect("admin/product");
			//} 
		}		

	}

}

/* End of file Pages.php */
/* Location: ./application/controllers/admin/company.php */
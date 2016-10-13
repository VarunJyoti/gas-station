<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Enduser extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();			
		
		$this->load->model('enduser_model','',TRUE);
		$this->load->model('systemtool_m');	
		$this->load->model('dropspayouts_model');
		$this->load->model('gasolinereceived_model');
		$this->load->model('admin_login_model');
		$this->load->model('store_sales_model');
		$this->load->model('daily_shift_model');
		$this->load->library("ckeditor");
		$this->load->helper('email');
		$this->load->helper('url');
		

		
	}
	/*
	** List Company
	*/
	public function index()
	{
		 
		 $user_type = loginUser();
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || End User Managment";//die('5');
		$data['enduser']  = $this->enduser_model->getallUserPage();
		$start = ($this->uri->segment(4)?$this->uri->segment(4):0); //start


        $total                  =   10; //items on a page


		$q = '';
		$whr='enduser';
		// search

 		if($this->input->get('search')){

			$q = trim($this->input->get("q"));

			$data['q'] = $q;

		}
		
		if(!empty($q)){

			$total_enduser     	=   $this->enduser_model->get_end_users($q,'',$whr);

            $enduser			  	= 	$this->enduser_model->get_end_users($q,$total,$start,$whr);


		}else{  
			$total_enduser         	=   $this->enduser_model->get_end_users(0,0,$whr);
			

			$enduser              	=   $this->enduser_model->get_end_users($total,$start,$whr);  //start,$limit,status

		}
		//print_r($enduser);die;

     

		 $data['enduser']			=	$enduser;

		$data['total_enduser']	=   count($total_enduser);
		

        $data['start']       	=   $start;

		

		//pagination

		$this->load->library('pagination');

		$this->config->load('pagination2', TRUE);

		$config 				= 	$this->config->item('pagination2'); 

		$config['uri_segment']  =   4;  //uri segment

        	

		$config['base_url'] 	= 	site_url("admin/enduser/index/");

		$config['total_rows']   =   count($total_enduser);

        $config['per_page']     =   $total;



		$this->pagination->initialize($config); 



		$this->pagination->create_links();
		
		$this->layout('enduser/list',$data);
	
	
		
}
		
	/*
	** Add Company
	*/
	public function add()
	{
		
		$usr_type = loginUser();

		if($usr_type =='admin')
	{
		//$this->company_model->getallProduct();	
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		$data['error'] = "";
	
		$data['endusers'] = $this->enduser_model->getallProduct(); 
		 //print_r($data['products']);
		// die('error');	
		 $this->layout('enduser/add',$data);
		}
	else{
	redirect("admin/login/logout");
	}
		
	}
	
	
	public function form()
	{
		
			
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		$data['error'] = "";
	   $page2 	        =	$this->enduser_model->getallDrops();
	   $data['page2']	=	$page2;
	   $data['drops']	 =	$this->enduser_model->getallDropsReceived();
	
	   $data['payouts']   =	$this->enduser_model->getallPayoutCash();
	  
	   $page5 	=	$this->enduser_model->getallPayoutCredit();
	   $data['page5']	=	$page5;
	   
		//print_r($page6);
		//die('error');
	   $data['page6']	=	$this->enduser_model->getSumPayoutCredit();
	   $data['page7']	=	$this->enduser_model->getSumPayoutCash();
	   $data['page8']	=	$this->enduser_model->getSumDropsreceived();
		$this->layout('enduser/form',$data);  
	
		
	}
	
	
		
/*
	** View Gasoline received
	*/
	public function gasoline_received_form()
	{
		
			
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		$data['error'] = "";
	    $data['pid1'] 	=	$this->daily_shift_model->getProductId();
		$data['drops_total']  =	$this->daily_shift_model->getSumDropsReceived();
		$data['payouts_total']  =	$this->daily_shift_model->getSumPayoutsReceived();
		$data['received_total']  =	$this->daily_shift_model->getSumGasolineReceived();
		$data['total_store_sales']  =	$this->store_sales_model->getTotalStoreSales();
		$data['sale_total']  =	$this->daily_shift_model->getSumGasolineSale();
		$data['Vroot_total']  =	$this->daily_shift_model->getSumGasolineVroot();
		$data['Records']  =	$this->daily_shift_model->getGasolineRecords();
		$data['RowId']  =	$this->daily_shift_model->getRowId();
		$data['product_price']  =	$this->daily_shift_model->getProductPrice();
	  
		$this->layout('enduser/gasoline_received_form',$data);
	
		
	}
	
	
	
	public function Last3records() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		
			if($this->input->get('find')){
			$daily_no = $this->input->get("daily_no");
			
			$data['Gasoline_Last3Record'] 	=	$this->enduser_model->getGasolineRecordByDaily($daily_no);
			           
		}

			$this->layout('enduser/Last3records',$data);
			
		}
		
		
		
		public function viewLast3records() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		
			if($this->input->get('find')){
			$daily_no = $this->input->get("daily_no");
			
			$data['Gasoline_Last3Record'] 	=	$this->enduser_model->getGasolineEndRecordByDaily($daily_no);
			           
		}

			$this->layout('enduser/viewLast3records',$data);
			
		}

	
	
	/*
	** View Gasoline received
	*/
	public function store_sales()
	{
		
			
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		$data['error'] = "";
		
	    $data['pid1'] 	=	$this->store_sales_model->getStoreProductId(); 
		
		$data['store_sales_data']  =	$this->store_sales_model->getAllStoreProductRow();
		
		$this->layout('enduser/store_sales',$data);
	
		
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
				$page 	=	$this->enduser_model->savePage($id);
				
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/enduser/{$page->id}");

			} else {
				$page 	=	$this->enduser_model->savePage(NULL);
				//print_r($page); die('err');
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>User Add SuccesFully</span></div> ');			
				redirect("admin/home");
			}			
			
		} else {
			redirect("admin/enduser/");
		}
	}
	
	public function savedrops()
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
				$page 	=	$this->dropspayouts_model->savePage($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/enduser/form");

			} else {
				$page 	=	$this->dropspayouts_model->savePage(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Entry Add SuccesFully</span></div> ');			
				redirect("admin/enduser/form");
			}			
			
		} else {
			redirect("admin/enduser/");
		}
	}
	
	
	public function save_store_sales()
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
				$page 	=	$this->store_sales_model->savePage($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/enduser/store_sales");

			} else {
				$page 	=	$this->store_sales_model->savePage(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Entry Add SuccesFully</span></div> ');			
				redirect("admin/enduser/store_sales");
			}			
			
		} else {
			redirect("admin/enduser/");
		}
	}

	
	
	
	
	
	public function savedaily_shift()
	{
		
		//print_r($this->input->post()); die('sdfs');
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
				$page 	=	$this->daily_shift_model->savePage($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/enduser/gasoline_received_form");

			} else {
				$page 	=	$this->daily_shift_model->savePage(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Entry Add SuccesFully</span></div> ');			
				redirect("admin/enduser/gasoline_received_form");
			}			
			
		} else {
			redirect("admin/enduser/");
		}
	}
	
	
	public function closedaily_shift()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		if($this->input->post('close_page'))
		{
			//print_r($this->input->post());
		//	die("error");
			$id 	=	$this->input->post("id")?$this->input->post("id"):NULL;
			
			if($id)
			{
				$page 	=	$this->daily_shift_model->closePage($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/enduser/{$page->id}");

			} else {
				$page 	=	$this->daily_shift_model->closePage(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Entry Add SuccesFully</span></div> ');			
				redirect("admin/enduser/{$page->id}");
			}			
			
		} else {
			redirect("admin/enduser/");
		}
	}
	
	
	public function closedaily()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		if($this->input->post('close_page'))
		{
			//print_r($this->input->post());
		//	die("error");
			$id 	=	$this->input->post("id")?$this->input->post("id"):NULL;
			
			if($id)
			{
				$page 	=	$this->daily_shift_model->CloseDaily($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/enduser/{$page->id}");

			} else {
				$page 	=	$this->daily_shift_model->CloseDaily(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Entry Add SuccesFully</span></div> ');			
				redirect("admin/enduser/{$page->id}");
			}			
			
		} else {
			redirect("admin/enduser/");
		}
	}
	
	
	
	/*
	** Save Gasoline received
	*/
	public function savegasoline()
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
				$page 	=	$this->gasolinereceived_model->savePage($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/enduser/view_gasolinereceived/{$page->id}");

			} else {
				$page 	=	$this->gasolinereceived_model->savePage(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Entry Add SuccesFully</span></div> ');			
				redirect("admin/enduser/gasoline_received_form");
			}			
			
		} else {
			redirect("admin/enduser/");
		}
	}
	/*
	** View Page
	*/
	public function view($slug) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		$page 	=	$this->enduser_model->getPage($slug);
		//$data['endusers'] = $this->enduser_model->getallUserPage();
		
		if($page) {
			$data['page']	=	$page;
			$this->layout('enduser/view',$data);
			
		} else {
			redirect("admin/enduser");
		}
		
	}
	
	
	/*
	** View Drops & Payouts
	*/
	public function view_drops_payouts() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
        $page	=	$this->dropspayouts_model->getdropspayouts();
		
		//$data['endusers'] = $this->enduser_model->getallUserPage();
		
		if($page) {
			$data['page']	=	$page;
			$this->layout('enduser/view_drops_payouts',$data);
			
		} else {
			redirect("admin/enduser");
		}
		
	}
	
	/*
	** View Gasoline Received Data
	*/
	public function view_gasolinereceived() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
        $page	=	$this->gasolinereceived_model->getgasolinereceived();
		
		//$data['endusers'] = $this->enduser_model->getallUserPage();
		
		if($page) {
			$data['page']	=	$page;
			 
			$this->layout('enduser/view_gasolinereceived',$data);
			
		} else {
			redirect("admin/enduser");
		}
		
	}

	
	/*
	** Edit Page
	*/
	public function edit($id) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->enduser_model->getPage($id);
		//$data['enduser'] = $this->enduser_model->getallProduct(); 
		
		if($page) {
			
			$data['page']	=	$page;
			$this->layout('enduser/edit',$data);
				
		} else {
			redirect("admin/enduser");
		}
	}
	
		/*
	** Edit drops_payouts
	*/
	public function edit_drops_payouts($id) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->dropspayouts_model->getPage($id);
		//$data['enduser'] = $this->enduser_model->getallProduct(); 
		
		if($page) {
			
			$data['page']	=	$page;
			$this->layout('enduser/edit_drops_payouts',$data);
				
		} else {
			redirect("admin/enduser");
		}
	}
	
	/*
	** Edit Gasoline Received
	*/
	public function edit_gasolinereceived($id) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->gasolinereceived_model->getPage($id);
		//$data['enduser'] = $this->enduser_model->getallProduct(); 
		
		if($page) {
			
			$data['page']	=	$page;
			$this->layout('enduser/edit_gasolinereceived',$data);
				
		} else {
			redirect("admin/enduser");
		}
	}
	
	
	
	public function edit_store_sales($id) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->store_sales_model->getPage($id);
		//$data['enduser'] = $this->enduser_model->getallProduct(); 
		
		if($page) {
			
			$data['page']	=	$page;
			$this->layout('enduser/edit_store_sales',$data);
				
		} else {
			redirect("admin/enduser");
		}
	}
		
	/*
	** Delete page  
	*/
	public function delete($id)
	{
		if($id)
		{		
				$result 			=	$this->enduser_model->deletePayoutEntry($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Deleted SuccesFully</span></div> ');$this->load->library('user_agent');
				redirect($this->agent->referrer());
		
		}		

	}
	
	
	
	public function deleteEnd($id)
	{
		if($id)
		{		
				$result 			=	$this->enduser_model->deleteEnduser($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Deleted SuccesFully</span></div> ');$this->load->library('user_agent');
				redirect($this->agent->referrer());
		
		}		

	}
	
	
	public function deletestore_sales($id)
	{
		if($id)
		{		
				$result 			=	$this->store_sales_model->deleteStoreSales($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Deleted SuccesFully</span></div> ');$this->load->library('user_agent');
				redirect($this->agent->referrer());
		
		}		

	}

	
	
	
	/*
	** Edit Profile
	*/
	
	

}

/* End of file Pages.php */
/* Location: ./application/controllers/admin/company.php */
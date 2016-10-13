<?php
class Settings extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();	
		$this->load->helper('url');
		$this->load->model('Admin_Login_model');
		$this->load->model('types_model');
	}
	/*
	** Profile edit page
	*/
	function index(){
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || List";
		$start                  =   ($this->uri->segment(4)?$this->uri->segment(4):0); //start
        $total                  =   10; //items on a page
		$q = '';
		// search
 		if($this->input->get('search')){
			$q = trim($this->input->get("q"));
			$data['q'] = $q;
		}
		
		if(!empty($q)){
			$total_sbadmin     	=   $this->Admin_Login_model->getSubAdmin($q);
            $sbadmin			  	= 	$this->Admin_Login_model->getSubAdmin($q,$total,$start);
		}else{
			$total_sbadmin         	=   $this->Admin_Login_model->getSubAdmin(0,0,0);
			$sbadmin              	=   $this->Admin_Login_model->getSubAdmin($start,$total,0);  //start,$limit,status
		}
       
		$data['sbadmin']			=	$sbadmin;
		$data['total_sbadmin']	=   count($total_sbadmin);
        $data['start']       	=   $start;
		
		//pagination
		$this->load->library('pagination');
		$this->config->load('pagination2', TRUE);
		$config 				= 	$this->config->item('pagination2'); 
		$config['uri_segment']  =   4;  //uri segment
        	
		$config['base_url'] 	= 	site_url("admin/settings/index/");
		$config['total_rows']   =   count($total_sbadmin);;
        $config['per_page']     =   $total;

		$this->pagination->initialize($config); 

		$this->pagination->create_links();
		$this->layout('settings/list',$data);
		
	}
	
	/*
	** Profile edit page
	*/
	function edit(){
		
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Profile";
		$sess = $this->session->userdata('admin');
		$ar = unserialize($sess);
		$data['id'] = $ar['id'];
		$admin = $this->admin_login_model->get($ar['id']);
		$data['admin'] = $admin;
		$this->layout('settings/edit',$data);
		

	}
	/*
	** Profile save 
	*/
	function save() 
	{	
		if($this->input->post('add_profile') || $this->input->post('edit_profile'))
        {	
			$this->form_validation->set_error_delimiters('<p class="error help-block"><span class="label label-important">','</span></p>');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$id=  $this->input->post('id');
			/*if(empty($id))  
				$this->form_validation->set_rules('type', 'Type', 'required');*/
			
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			//$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			
			if ($this->form_validation->run() == FALSE) {
				if($this->input->post('add_profile'))
					$this->add();
				else
					$this->edit();
			} else {
				
				if($id)  {
					$result =  $this->admin_login_model->updateUser($id);    
					if($result) {	
						$this->session->set_flashdata('success', 'Your Profile has been updated successfully. ');			
						redirect("admin/settings/edit"); 						
					} 	else {
							$this->session->set_flashdata('error', 'Your Profile is not updated. ');				
							$this->edit();
					}
					
				}
				else {
					$result =  $this->admin_login_model->register();    
					if($result) {	
						$this->session->set_flashdata('success', 'User has been created successfully.');			
						redirect("admin/settings"); 						
					} 	else {
							$this->session->set_flashdata('error', 'User is not created.');				
							$this->add();
					}
				}
			}	
		}else{
			redirect("admin/settings/add"); 	
		}
			
	}
	
	
	
	
	/*
	** Check email
	*/
	public function checkEmail()
	{
		$email = $this->input->post('email');
		$id = $this->input->post('id');
		if ($this->admin_login_model->check_email_available($email,$id) >0) {
			echo '2';
		}else{
			echo '1';
		}
		exit;
	}
	/*
	** Setting contact
	*/
	public function contact(){
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Contact";
		$this->load->model('setting_model');
		$contact = $this->setting_model->get2();
		//ini_set("memory_limit","12M");
		$data['contact'] = $contact[0];
		if($this->input->post('edit_contact')){
			//$this->form_validation->set_error_delimiters('<p class="error help-block"><span class="label label-important">','</span></p>');
			$//this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$id=  $this->input->post('id');
			//$this->form_validation->set_rules('address', 'Address', 'required');
			//$this->form_validation->set_rules('city', 'City', 'required');
			//$this->form_validation->set_rules('pincode', 'Pincode', 'required');
			//$this->form_validation->set_rules('contact_no', 'Contact no.', 'required');
			/*if ($this->form_validation->run() == FALSE) {
				$this->contact();
			}else{*/
				$result =  $this->setting_model->save($id);    
				if($result) {	
					$this->session->set_flashdata('success', 'Contact has been updated successfully. ');			
				} else {
						$this->session->set_flashdata('error', 'Contact is not updated. ');				
				}
				redirect("admin/settings/contact"); 
			//}
		}
		$this->layout('settings/contact',$data);
		
	}
	/*
	** Create Thumb image
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
}
<?php
class AdminUser extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();	
		$this->load->helper('url');
		$this->load->helper('login');
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
        	
		$config['base_url'] 	= 	site_url("admin/adminUser/index/");
		$config['total_rows']   =   count($total_sbadmin);;
        $config['per_page']     =   $total;

		$this->pagination->initialize($config); 

		$this->pagination->create_links();
		$this->layout('adminuser/list',$data);
		
		
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
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
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
						redirect("admin/adminUser/edit"); 						
					} 	else {
							$this->session->set_flashdata('error', 'Your Profile is not updated. ');				
							$this->edit();
					}
					
				}
				else {
					$result =  $this->admin_login_model->register();    
					if($result) {	
						$this->session->set_flashdata('success', 'User has been created successfully.');			
						redirect("admin/adminUser"); 						
					} 	else {
							$this->session->set_flashdata('error', 'User is not created.');				
							$this->add();
					}
				}
			}	
		}else{
			redirect("admin/adminUser/add"); 	
		}
			
	}
	
	/*
	** Super admin add subadmin 
	*/
	function add($id=null) 
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Subadmin";
		$this->layout('adminuser/add',$data);
		
	}
	
	/*
	** Super admin add subadmin 
	*/
	function sub_edit($id=null) 
	{	
		$admin = $this->admin_login_model->get($id);
		$data['admin'] = $admin;
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Subadmin";
		$this->layout('adminuser/sub_edit',$data);
	}
	/*
	**  Edit Subadmin  
	*/
	function save_edit() 
	{	
		$id=  $this->input->post('id');
		if($this->input->post('edit_profile'))
        {	
			$this->form_validation->set_error_delimiters('<p class="error help-block"><span class="label label-important">','</span></p>');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			//$this->form_validation->set_rules('type', 'Type', 'required');
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			$email = $this->input->post('email');
			$id=  $this->input->post('id');
			if ($this->form_validation->run() == FALSE) { 
				redirect("admin/adminUser/sub_edit/{$id}");
			} else {
				$rspn = $this->admin_login_model->check_email_available($email,$id);
				if ($rspn == 0) {
					
					if($id)  {
						$result =  $this->admin_login_model->updateUser($id);    
						if($result) {	
							$this->session->set_flashdata('success', 'Profile has been updated successfully');			
							redirect("admin/adminUser/"); 						
						} 	else {
								$this->session->set_flashdata('error', 'Profile is not updated.');				
								redirect("admin/adminUser/sub_edit/{$id}");
						}
						
					}
					else {
						$this->session->set_flashdata('error', 'Your Profile is not updated.');				
						redirect("admin/adminUser/"); 
					}
				}else{
					$this->session->set_flashdata('error', 'Email Already exit.');				
					redirect("admin/adminUser/sub_edit/{$id}");
					
				}
			}	
		}else{
			if(!empty($id)){
				redirect("admin/adminUser/"); 
			}else{
				redirect("admin/adminUser/sub_edit/{$id}"); 	
			}
			
		}
			
	}
	/*
	** delete subadmin
	*/
	public function delete(){
		$id       =     $this->uri->segment(4, 0);
		if($id){
			$result = $this->admin_login_model->delete($id);
			if($result)
				$this->session->set_flashdata('success', 'Subadmin has been delete successfully.');			
			else
				$this->session->set_flashdata('error', 'Your request is invalid. ');				
				
			redirect("admin/adminUser");				
		}
		else{
			$this->session->set_flashdata('error', 'Your request is invalid. ');				
			redirect("admin/adminUser");	
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
	
}
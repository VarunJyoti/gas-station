<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Admin_Controller {

	function __construct() 	{
		parent::__construct();	
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('cookie');
		// load model
		$this->load->model('admin_login_model');
        $this->load->model('daily_shift_model');		
		$this->load->model('setting_model');
	}
	/*
	** Admin login page method
	*/
	public function index()
	{	
		
		$data['login_display'] = 'block';
		$data['forgot_display'] = 'none';
		$this->admin_login_model->loggedin() == FALSE || redirect("admin/home");
		
		$email_cookie 		= 	$this->input->cookie('email_cookie', TRUE);
		$password_cookie 	= 	$this->input->cookie('password_cookie', TRUE);
		if(!empty($email_cookie) && !empty($password_cookie)){
			$data['email'] 		= $email_cookie;
			$data['password'] 	= $password_cookie;
		}else{
			$data['email'] = '';
			$data['password'] = '';
		}
		// Get Setting Data
		$get_settings			=	$this->setting_model->get_setting_admin();
		$data['get_settings']	=	$get_settings;
		$this->load->view('admin/login',$data);
	}
	/*
	** login Authentication 
	*/
	public function authentication() {
		
		$this->form_validation->set_error_delimiters('<label generated="true" class="error">','</label>');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			//$this->session->set_flashdata('error', 'Please Enter Email and Password');
			$this->index();
		} else 	{			
				
			$result = $this->admin_login_model->login();
			//print_r($result);die;
			if($result) {
				      // enduser shift authentication starts 
					   $user_type = loginUser();
					   //print_r($user_type );
					   if($user_type=='enduser')
					   {
						$result1 = $this->admin_login_model->enduserlogin(); 
                          if($result1 == false)
						  {
							 $this->session->set_flashdata('logout_success', '<div class="alert alert-success display-hide" style="display: block;"><button class="close" data-close="alert"></button><span>Successfull<strong></strong>has been logout.</span></div> ');				
			                redirect('/admin/login/logout');
						  }
                          				   
					  }
					   // enduser shift authentication ends
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide" style="display: block;"><button class="close" data-close="alert"></button><span>Welcome admin </span></div> ');			
				// if remember me
				if($this->input->post('remember')){
					$email = $this->input->post('email'); 
					$password = $this->input->post('password'); 
					// set cookie
					
					$this->input->set_cookie('email_cookie', $this->input->post('email'), time()+86500); 	
					$this->input->set_cookie('password_cookie', $this->input->post('password'), time()+86500); 
					
				}else{
					delete_cookie("email_cookie");
					delete_cookie("password_cookie");
				}
				//$this->session->set_userdata($data);
				redirect("admin/home");							
					
			} 	else {
					$this->session->set_flashdata('login_error', '<div class="alert alert-danger display-hide" style="display: block;"><button class="close" data-close="alert"></button><span>Invalid email and/or password.</span></div> ');				
					$this->index();

			}
		}
	}
	/*
	** lost password recovery email 
	*/
	public function forgot(){
		$email =  $this->input->post('email');
		if ($this->admin_login_model->check_email_available($email) >0) {
			$result = $this->admin_login_model->lost($email);
			if($result)
				echo "<div class='alert alert-success display-hide' style='display:block;'><button class='close' data-close='alert'></button><span>Password Recovery Email Sent to {$email} Check your email for the link to reset your password.</span></div>";
			else
				echo '<div class="alert alert-danger display-hide" style="display:block;"><button class="close" data-close="alert"></button><span>Failed password recovery request. Please try again!</span></div>';
		}else{
			echo '<div class="alert alert-danger display-hide" style="display:block;"><button class="close" data-close="alert"></button><span>Invalid email id.</span></div>';
		}
		
	}
	/*
	** Reset password method 
	*/
	
	public function resetpassword(){
		$this->admin_login_model->loggedin() == FALSE || redirect("admin/home");	
		$id       	=   $this->uri->segment(4, 0);
        $code     	=   $this->uri->segment(5, 0);
		$result 	= 	$this->admin_login_model->verify_code($id,$code);
		// Get Setting Data
		$get_settings			=	$this->setting_model->get_setting_admin();
		$data['get_settings']	=	$get_settings;
		if($result){
			$SITE_TITLE = SITE_TITLE;
			$data['title'] = "$SITE_TITLE Admin ||Reset Password";	
			$data['id'] 	= $id;
			$data['code'] 	= $code;
			$this->load->view('admin/resetpassword',$data);
		}
		else{
			$this->session->set_flashdata('error', '<div class="alert alert-error display-hide"><span>Your request is invalid.</span></div> ');				
			redirect("admin/login");	
		}			
	}
	/*
	** Update password
	*/
	public function updatepassword()
    {
        $id		=  $this->input->post('id');
		$code	=  $this->input->post('code');
		
		if($this->input->post('update')){
			$this->form_validation->set_error_delimiters('<p class="error help-block"><span class="label label-important">','</span></p>');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			
			$id=  $this->input->post('id');
			if ($this->form_validation->run() == FALSE) { 
				$data['title'] 	= 'Reset Password';	
				$data['id'] 	= $id;
				$data['code'] 	= $code;
				$this->load->view('admin/resetpassword',$data);
			} else {
				$admin =  $this->admin_login_model->resetpassword($id); 
				$this->session->set_flashdata('logout_success', '<div class="alert alert-success display-hide" style="display:block;"><button class="close" data-close="alert"></button><span>Your Password is updated. Please Login</span></div>');
				redirect("admin/login"); 
			}	
           
        }  else {
            $this->session->set_flashdata('logout_success', '<div class="alert alert-error display-hide"><button class="close" data-close="alert"></button><span>You Can not access this area directly</span></div>');
			redirect("admin/login");     
        }      

    }
	
	/*
	** check email is exist or not
	*/
	public function checkavailability()
	{	
		$email =  $this->input->post('email');
		$this->admin_login_model->check_email_username_available('email',$email);
		if ($this->admin_login_model->check_email_username_available('email',$email) >0) {
			echo "<p style='color:green'>Email is available!</p>";
		}else{
			echo 'Email is not available!';
		}
	}	
	/*
	** Admin logout method
	*/
	public function logout() {
		
		if($this->admin_login_model->loggedin()) {
			$this->session->set_flashdata('logout_success', '<div class="alert alert-success display-hide" style="display: block;"><button class="close" data-close="alert"></button><span>Successfully <strong></strong>has been logout.</span></div> ');				
			$this->admin_login_model->logout();
			//$this->session->sess_destroy();
			//$this->load->view('admin/login');
			redirect('/admin/login', 'refresh');
		}else{
			$this->session->set_flashdata('logout_success', '<div class="alert alert-success display-hide" style="display: block;"><button class="close" data-close="alert"></button><span>Successfully <strong></strong>has been logout.</span></div> ');				
			redirect('/admin/login');
		}
		
		
	}
}

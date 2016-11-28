<?php 
class Admin_Controller extends CI_Controller{
    public $admin = array();
	
	
	public function __construct(){
        parent::__construct();
		
				$this->load->helper('login');
        $this->load->library('session'); // loading session class
		$this->load->helper('form');
		$this->load->library('form_validation');		
		$this->data['meta_title'] = 'Admin Dashboard';
		$this->load->model('admin_login_model');
		$this->load->model('setting_model');
        //$this->load->library('my_custom_library'); // loading library class
		$exception_uris  = array('login');
		$this->load->helper('url');
		
		$arr_url = explode('/',uri_string());
		
		
		
		if(!(in_array('login',$arr_url))){
			if(in_array(uri_string(), $exception_uris) == FALSE) {	//die('test');
				if($this->admin_login_model->loggedin() == FALSE)
					redirect('admin/login');
			}
		}
		
		if($ar['type']=="admin") {
			$this->admin= array(
				'loggedin_time'	=>	$ar['loggedin_time'],
				'first_name' 	=>	$ar['first_name'],
				'last_name' 	=>	$ar['last_name'],
				'id' 			=>	$ar['id'],
				'loggedin' 		=>	TRUE,
				'type' 	=>	$ar['type'],
				'email'			=>	$ar['email'],
				'status'		=>	$ar['status'],
			);

		} else { 
			//$this->admin_login_model->logout();
			//redirect('admin/login/logout');
		}
		
	
	}
	
	public function login_name(){
		$sess = $this->session->userdata('admin');
		$ar = unserialize($sess);
		if(!empty($ar)){
			return $ar;
		}
	}
	/*
	** Layout method
	*/
	public function layout($view,$data){
		
		$ar = $this->login_name();
		//$data['first_name'] = $ar['first_name'];
		//$data['last_name'] 	= $ar['last_name'];
		
		// Get Setting Data
		$get_settings			=	$this->setting_model->get_setting_admin();
		
		$ge_admin_data			=	$this->admin_login_model->get($ar['id']);
		$data['first_name'] 	= 	$ge_admin_data->first_name;
		$data['last_name'] 		= 	$ge_admin_data->last_name;
		$data['get_settings']	=	$get_settings;
		$data['title'] 			= 	$get_settings->website_title." Admin || Dashboard";
		$this->load->view('admin/templates/header',$data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view("admin/{$view}",$data); 
		$this->load->view('admin/templates/footer');	
	}
}
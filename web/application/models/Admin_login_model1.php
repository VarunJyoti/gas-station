<?php
class Admin_login_model extends CI_Model {
	protected $_table_name = 'admins';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'first_name', 'last_name', 'email', 'password',
	'dob', 'gender', 'type', 'status','created_dated','modified_date','login_activity','verification_code');
	
	public $id;
	public $first_name;
	public $last_name;
	public $email;
	public $password; 
	public $dob; 
	public $gender; 
	public $type;
	public $status;
	public $created_dated;
	public $modified_date;
	public $login_activity;
	public $verification_code;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('cookie');
		$this->load->helper('date');
		
	}
	/*
	** Check admin login 
	*/
	public function login()
	{		
		$user = $this->get_by(array(
			'email' => $this->input->post('email'),
			'password' => $this->hash($this->input->post('password')),
			'status' => '1'
			), TRUE);
		
		if(count($user)){
			//User Exists Logg him in
			$data = array(
				'first_name' 	=> $user->first_name,
				'last_name' 	=> $user->last_name,
				'id' 			=> $user->id,
				'loggedin' 		=> TRUE,
				'type' 			=> $user->type,
				'status' 		=> $user->status,
				'email'			=> $user->email,
				'loggedin_time'	=> time()
				);
			$this->session->set_userdata('admin', serialize($data));
			return true;
		}
	}
	
	
	public function enduserlogin()
	{		
		$user = $this->get_by(array(
			'email' => $this->input->post('email'),
			'password' => $this->hash($this->input->post('password')),
			'status' => '1'
			), TRUE);
		
		if(count($user)){
	   
		$cid = $this->daily_shift_model->getCompanyId();
		$c_id =  $cid['0']->c_id;
		$statusss = $this->daily_shift_model->check_ShiftUser();
		
		$shiftss =  $statusss['access_module'];
		
		$this->db->select('*');
        $this->db->from('daily_shift');
        $this->db->where("c_id",$c_id);
		//$this->db->order_by("shift",'DESC');
		$this->db->order_by('login_time','DESC');
		$page = $this->db->get();
		$page1 = $page->row_array();
		//$query1 = $this->db->last_query($page1);

		
		 if(!empty($page1))
	       {  
	       
	            $date1= $page1['login_time'];
				$date = date('Y-m-d',strtotime($date1));
				$current_date= date('Y-m-d');
				
				$status= $page1['status'];
				
				$shifts= $page1['shift'];
			
				$id= $page1['id'];
			 
			if(($date != $current_date) && ($status == 'close') && ($shiftss == 1))
			   {
				   
				 $table = "daily_shift";
							  
							  $userid = unserialize($this->session->userdata('admin'));
		                      $user_id = $userid['id'];
							  $cid = $this->daily_shift_model->getCompanyId();
		                      $c_id =  $cid['0']->c_id;
							  
							  $login_time = date("Y-m-d H:i:s", time());
							  
							  $shift = $shiftss;
							  $status = "open";
							  $data = array('id'=> NULL, 'login_time'=> $login_time,	'logout_time'=> "",	'user_id'=> $user_id,	'c_id'=> $c_id,	'shift'=>$shift,	'status'=> $status);
							  $this->db->insert($table,$data);  
				   
			   }
			   
			    else if(($date == $current_date) && ($status == 'close') && ($shiftss == $shifts+1 )) 
			   {
				  
				    $table = "daily_shift";
				              $userid = unserialize($this->session->userdata('admin'));
		                      $user_id = $userid['id'];
							  $cid = $this->daily_shift_model->getCompanyId();
		                      $c_id =  $cid['0']->c_id;
							  
							  $login_time = date("Y-m-d H:i:s", time());
							  
							  $shift = $shifts+1;
							  $status = "open";
							  $data = array('id'=> NULL, 'login_time'=> $login_time,	'logout_time'=> "",	'user_id'=> $user_id,	'c_id'=> $c_id,	'shift'=>$shift,	'status'=> $status);
							  $this->db->insert($table,$data);    
				   
			   }
			   
			   else if(($date == $current_date) && ($status == 'open') && ($shiftss == $shifts )) 
			   {
				  
                  return true;
				   
			   }
			   
			   
			   else{
				   $this->session->set_flashdata('login_error', '<div class="alert alert-danger display-hide" style="display: block;"><button class="close" data-close="alert"></button><span>Current Shift is not Closed! So you cant login<strong></strong>.</span></div> ');		
				   
				   $this->admin_login_model->logout();
				   redirect('/admin/login');
				   
				   

			   }
			  
			  
			
							   
			     }
		  
                         else 
		           { 
					
					
						
						
							  $table = "daily_shift";
							  
							  $userid = unserialize($this->session->userdata('admin'));
		                      $user_id = $userid['id'];
							 
							  $cid = $this->daily_shift_model->getCompanyId();
		                      $c_id =  $cid['0']->c_id;
							  
							  $login_time = date("Y-m-d H:i:s", time());
							 
							  $shift = 1;
							  $status = "open";
							  $data = array('id'=> NULL, 'login_time'=> $login_time,	'logout_time'=> "",	'user_id'=> $user_id,	'c_id'=> $c_id,	'shift'=>$shift,	'status'=> $status);
							  $this->db->insert($table,$data);
						     
						
			         }
			 }
	}
	
	/*
	** Edit profile method
	*/
	public function updateUser($id=NULL){
		$data = $this->array_from_post(self::$db_fields);
		//print_r($data);die;
		$data['status']		=	$this->input->post('status');
		$old_password	=	$this->input->post('old_password');
		if(	$this->input->post('password') == $old_password){
			$data['password']		=	$this->input->post('old_password');
		}
		else{
			$data['password']		=	$this->hash($this->input->post('password'));
		}
		if(isset($data['id']))
			$id = $data['id'];
		
		if($id)
			$data['modified_date']	=	date("Y-m-d:H:i:s");
		else
			$data['created_dated']	=	date("Y-m-d:H:i:s");
		
		unset($data['id']);
		$this->db->where('id', $id);
		$last_id = $this->db->update($this->_table_name ,$data);
		
		if($last_id !== 0){
			return true;
		}else{
			return false;
		}
	}
	/*
	** delete user
	*/
	public function delete($id){
		$this->db->where('id', $id)->delete($this->_table_name);
        return $this->db->affected_rows();
	}
	/*
	** Admin logout method 
	*/
	public function logout()
	{		
		$this->session->unset_userdata('admin');
	}

	/*
	** Function for Checking a User is logged in or Not
	*/
	public function loggedin()
	{
		$sess = $this->session->userdata('admin');
		$ar = unserialize($sess);
		return (bool) $ar['loggedin'];
		//return (bool) $this->session->userdata('loggedin');
	}

	/*
	** Function for Hashing a Password
	*/
	public function hash($string){
		return md5($string);//hash('sha512', $string . config_item('encryption_key'));
	}
	/*
	** Check duplicate email in database
	*/
	public function check_email_available($data,$id=null)
	{	
		if($id)
			$this->db->where("email='{$data}' and id !={$id}");
		else
			$this->db->where('email', $data);
		$rest = $this->db->count_all_results($this->_table_name);
	//print_r($rest);die('hello');
		return $rest;
		
	}
	/*
	** Add User
	*/
	public function register(){
		$data = $this->array_from_post(self::$db_fields);
		$data['created_dated']	=	date("Y-m-d:H:i:s");
		$data['password']		=	$this->hash($this->input->post('password'));
		//print_r($data);die('test');
		$last_id = $this->db->insert($this->_table_name ,$data);
		if($last_id !== 0){
			return true;
		}else{
			return false;
		}

	}
	public function lost()
	{	
		$user = $this->get_by(array(
			'email' => $this->input->post('email')
			), TRUE);
		
		if(count($user)){
			//User Exists Logg him in
			
			$data = array(
				'first_name' 	=> $user->first_name,
				'last_name' 	=> $user->last_name,
				'id' 			=> $user->id,
				'password'		=> $user->password,
				'type' 			=> $user->type,//$user->user_type,
				'status' 		=> $user->status,
				'email'			=> $user->email,
				
				);
				
			$data['verification_code'] 	= 	md5($this->get_rand_sn(3));
			//$data['password']			=	$this->hash($data['password']);			
			
			//$id 						=	$this->save($data,$data['id']);			
			
			$this->db->where('id', $user->id);
			$id	 = $this->db->update($this->_table_name ,$data);
			$this->load->model('setting_model');
			$contact = $this->setting_model->get2();
			$this->load->model('mail_model');
			$data['id'] 				= 	$id;	
			$site_url					=	site_url();
			$mailer['to']				=	$data['email'];
			$mailer['from']				=	$contact[0]->from_email;
			$mailer['subject'] 			=	"Forgot Password Confirmation"	;
			$message 					=	"Dear Admin,<br/> Someone requested that the password be reset for the following account: {$site_url}\n\r<br/>";
			$message 					.=	"<br/>If this was a mistake, just ignore this email and nothing will happen.\n\r";
			$message 					.=	"<br/>To reset your password, visit the following address:\n\r<br/>";
		 	$message 					.=	site_url("admin/login/resetpassword/{$id}/{$data['verification_code']}")."\n\r";
			$mailer['message'] 			= 	$message;
			$result 					= 	$this->mail_model->sendEmail($mailer);
			$this->session->set_userdata('admin', serialize($data));
			
			return true;
		}
	}
	public function verify_code($id,$code)
	{
		//echo "id = $id and verification_code = '{$code}'";die('test');
		$this->db->where("id = $id and verification_code = '{$code}'");
		$obj = $this->get2();
	
		if($obj) {
			return true;
		} else 
			return false;
	}
	public function resetpassword($id,$verification_code=null)
	{	
		
		$user = $this->get_by(array(
			'id' => $this->input->post('id')
			), TRUE);
		
		if(count($user)){
			//User Exists Logg him in
			
			$data['password']		=	$this->hash($this->input->post('password'));
			
			$data['modified_date'] 	= 	date('Y-m-d:h:i:s');
			$data['verification_code'] 	= '';
			$data['id']				=	$this->input->post('id');
			//$id 					=	$this->save($data,$data['id']);
			$this->db->where('id', $id);
			$id = $this->db->update($this->_table_name ,$data);
			$data['id'] 			= 	$id;	
			return true;
		}else{
			return false;	
		}
	}
	
	
	public function getSubAdmin($start=0,$limit=0,$status=1) 
	{
		$this->db->where("type != 'super'");
		$this->db->order_by("created_dated","desc");

		if($limit)
			$hotels = $this->get3($limit,$start);
		else
			$hotels = $this->get2();
		return $hotels;
	}	
		


	

	public function getAll() {
		return $this->db->from($this->_table_name)->get()->result_array();
	}
	public function printStatus() {
		$status		=	$this->status;
		switch($status){
			case 1:
				return 'Live';
				break;
			default:
				return 'Suspend';
				break;
		}		
	}	
	
}



















?>
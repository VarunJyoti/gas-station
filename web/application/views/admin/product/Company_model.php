<?php
class Company_model extends CI_Model{
	protected $_table_name = 'cd_company';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'name','email', 'address', 'pin', 'contact', 'date_created', 'date_modified', 'status','username','password');
	
	public $id;
	public $name; 
	public $email; 
	public $address; 
	public $pin; 
	public $contact; 
	public $date_created; 
	public $date_modified;
	public $status;
	public $username;
	public $password;
		
	
	//public $delete_status; //1 if delte

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function savePage($id=NULL,$table='company')
	{
		
		
		$data 	= $this->array_from_post(self::$db_fields);	
		
		
		
		
		
		if($id)
		{
			
			$data['date_modified'] 	=	time();	
			$data['date_modified']  = date("Y-m-d H:i:s", time());
		
			$status =	$this->input->post("status");	
            		 
			if($status != 1)
				$data['status'] = 0;

			$this->db->where('id', $id);
			$last_id = $this->db->update($table ,$data);
			
			// update code for users table starts here
			
			$table1 = 'admins';
		
			$username1 =	$this->input->post("username");
			$password1 =	$this->input->post("password");
			$password1 =	md5($password1);
			$email1 =	$this->input->post("email");
			$phone1 =	$this->input->post("contact");
			$pin1 =	$this->input->post("pin");
			$status1 =	$this->input->post("status");
			$modified_date= date("Y-m-d H:i:s", time());
			
	
	 // Function for  IP address starts here		
			
function getRealIpAddress()
{
if (!empty($_SERVER['HTTP_CLIENT_IP']))
//check ip from internet
{
$ipadd=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
//check ip proxy
{
$ipadd=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
$ipadd=$_SERVER['REMOTE_ADDR'];
}
return $ipadd;
}
$ip_addr = getRealIpAddress(); 

      // Function for  IP address ends here	

		
			$data1 = array('email'=> $email1,	'username'=> $username1,	'password'=> $password1,	'phone'=> $phone1,	'status'=> $status1,'pin'=> $pin1, 'ip'=> $ip_addr,	'modified_date'=> $modified_date);
			$this->db->where('c_id', $id);
			$this->db->update($table1, $data1); 
		    $sql1= $this->db->last_query();
			
			// update code for users table starts here
			
			if($last_id !== 0){
				return true;
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');
			}else{
				return false;
			}
			//$this->save($data, $id);

		} else {
		
			//$data['slug'] 	=	$this->create_unique_slug($title);			
			//$data['status']			=	'1';
			$status =	$this->input->post("status");	
			$data['date_created']		=	time();
            $data['date_created']  = date("Y-m-d H:i:s", time());			
			//$this->save($data, $id);
			$last_id = $this->db->insert($table ,$data);
			$sql= $this->db->last_query();
		    $insert_id = $this->db->insert_id();
// insert code for users table starts here
			$table1 = 'admins';
		
			$username1 =	$this->input->post("username");
			$password1 =	$this->input->post("password");
			$password1 =	md5($password1);
			$email1 =	$this->input->post("email");
			$phone1 =	$this->input->post("contact");
			$pin1 =	$this->input->post("pin");
			$status1 =	$this->input->post("status");
			$created_date= date("Y-m-d H:i:s", time());
			
	
	 // Function for  IP address starts here		
			
function getRealIpAddress()
{
if (!empty($_SERVER['HTTP_CLIENT_IP']))
//check ip from internet
{
$ipadd=$_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
//check ip proxy
{
$ipadd=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
$ipadd=$_SERVER['REMOTE_ADDR'];
}
return $ipadd;
}
$ip_addr = getRealIpAddress(); 

      // Function for  IP address ends here	

		
			//$data1 = array('id' =>NULL, 'c_id'=>$insert_id,	'first_name'=> "",	'last_name'=> "",	'email'=> $email1,	'username'=> $username1,	'password'=> $password1,	'phone'=> $phone1,	'status'=> $status1,	'state_id'=> "",	'city_id'=> "",	'pincode'=> $pin1,	'verification_code'=> "", 'ip'=> $ip_addr,	'one_time_verify_pin'=>"",	'mobile_verify'=>"", 'created'=> $created_date,	'modified'=> "",	'user_type'=> 'admin');
						$data1 = array('id'=> NULL,	'first_name'=> "",	'last_name'=> "",	'email'=> $email1,	'password'=> $password1,	'dob'=> "",	'gender'=> "",	'type'=> 'admin',	'created_dated'=> $created_date,	'modified_date'=> "",	'login_activity'=> "",	'status'=> $status1,	'verification_code'=> "",	'access_module'=> "",	'location_access'=> "",	'c_id'=> $insert_id,	'username'=> $username1,	'phone'=> $phone1,	'state_id'=> "",	'city_id'=> "",	'pin'=> $pin1,	'ip'=> $ip_addr);
			
			$this->db->insert($table1, $data1); 
		    $sql1= $this->db->last_query();
// insert code for users table starts here
		
			if($last_id !== 0){
				return true;
			}else{
				return false;
			}
			//$id = (empty($id)) ? $this->db->insert_id() : $id; 					
			
		}
		//$obj = $this->get2($id);			
		//return true;			
	}


	public function getUsers($account_type = "All") 
	{
		if($account_type != "All"){			
			$this->db->where("account_type = '{$account_type}' and delete_status = 0");
		} else {
			$this->db->where("delete_status = 0");
		}
		$users = $this->get2(NULL,false);
		return $users;
	}

	public function getPage($id) 
	{
		$this->db->where("id = '{$id}'");		
		$page = $this->get();
		
		return $page[0];
	}
	
	public function getallPage() 
	{
		$this->db->where("status = '1'");
		$this->db->order_by("position",'ASC');
		$page = $this->get2();
		return $page;
	}

	public function printStatus()
	{
		switch($this->status)
		{
			case 1: 
				return "Active";
			default:
				return "Disabled";
		}
	}

	public function deletePage($id)
	{
		$result = $this->delete($id);
		return $result;

	}

	
	


	
}


?>
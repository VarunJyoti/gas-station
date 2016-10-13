<?php
class Enduser_model extends CI_Model{
	protected $_table_name = 'admins`';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'first_name', 'last_name', 'email', 'password', 'dob', 'gender',	'type',	'created_dated', 'modified_date', 'login_activity', 'status', 'verification_code',	'access_module', 'location_access',	'c_id',	'username',	'phone', 'state_id', 'city_id',	'pin',	'ip');
	
	public $id;
	public $first_name; 
	public $last_name; 
	public $email; 
	public $password; 
	public $dob; 
	public $gender; 
	public $type;
	public $created_dated;
	public $modified_date;
	public $login_activity;
	public $status;
	public $verification_code;
	public $access_module;
	public $location_access;
	public $c_id;
	public $username;
	public $phone;
	public $state_id;
	public $city_id;
	public $pin;
	public $ip;
		
	
	//public $delete_status; //1 if delte

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function savePage($id=NULL,$table='admins')
	{
		
		
		$data 	= $this->array_from_post(self::$db_fields);	
		
		
		
		
		
		if($id)
		{
			
			$data['modified_date'] 	=	time();	
			$data['modified_date']  = date("Y-m-d H:i:s", time());
		
			$status =	$this->input->post("status");	
           if($status != 1)
				$data['status'] = 0;

			$this->db->where('id', $id);
			$last_id = $this->db->update($table ,$data);
			
			// update code for users table starts here
			
			$table1 = 'admins';
		
			$first_name  =	$this->input->post("first_name");
			$username1 =	$this->input->post("username");
			$password1 =	$this->input->post("password");
			$shift =	$this->input->post("shift");
			$password1 =	md5($password1);
			$email1 =	$this->input->post("email");
			$phone1 =	$this->input->post("phone");
			$pin1 =	$this->input->post("pin");
			$status1 =	$this->input->post("status");
			$modified_date= date("Y-m-d H:i:s", time());
			
			$ip_addr = $this->getRealIpAddress(); 

      // Function for  IP address ends here	

		
			$data1 = array('first_name'=> $first_name,	'email'=> $email1,	'username'=> $username1,	'password'=> $password1,	'access_module'=> $shift,	'phone'=> $phone1,	'status'=> $status1,'pin'=> $pin1, 'ip'=> $ip_addr,	'modified_date'=> $modified_date);
			$this->db->where('id', $id);
			$this->db->update($table1, $data1); 
		    $sql1= $this->db->last_query();
		
			
			if($last_id !== 0){
				return true;
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');
			}else{
				return false;
			}
			//$this->save($data, $id);

		} 
		else {
			
			$Company_id = $this->getCompanyId();
			$comp_id = $Company_id['0']->c_id;
			
			$name = $this->input->post("first_name");
			$username =	$this->input->post("username"); 
			$password =	$this->input->post("password");
			$password =	md5($password);
			$email =	$this->input->post("email");
            $phone =	$this->input->post("contact");
			$pin =	$this->input->post("pin");
		    $user_type =	$this->input->post("role");
			$status =	$this->input->post("status");
	        $created_date = date("Y-m-d H:i:s", time());
			 
            
// insert code for users table starts here
			$table1 = 'admins';
	
			$ip_addr = $this->getRealIpAddress(); 

      // Function for  IP address ends here	

		
			$data1 = array('id'=> NULL,	'first_name'=> "$name",	'last_name'=> "",	'email'=> $email,	'password'=> $password,	'dob'=> "",	'gender'=> "",	'type'=> 'enduser',	'created_dated'=> $created_date,	'modified_date'=> "",	'login_activity'=> "",	'status'=> $status,	'verification_code'=> "",	'access_module'=> $user_type,	'location_access'=> "",	'c_id'=> $comp_id, 'username'=> $username,	'phone'=> $phone,	'state_id'=> "",	'city_id'=> "",	'pin'=> $pin,	'ip'=> $ip_addr);
			
			$this->db->insert($table1, $data1); 
		    $sql= $this->db->last_query();
			
			
// insert code for users table ends here
		
			if($last_id !== 0){
			
				return true;
			}
			else{
				return false;
			}
			//$id = (empty($id)) ? $this->db->insert_id() : $id; 					
			
		}
		//$obj = $this->get2($id);			
		//return true;			
	}

	
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
	

	public function getallProduct() 
	{
	$query = $this->db->query("select * from `cd_product`");

		foreach ($query->result_array() as $row)
		{
		   //$cat.= '<option value="'.$row['p_name'].'">'.$row['p_name'].'</option>';
		   $cat.= '<input type="checkbox" name="p_id[]" value="'.$row['id'].'"><label>'.$row['p_name'].'</label><br/>';
		   
		}
		
		return $cat;
	}
	
	
	
	
	public function getCompanyId() 
	{
		
		 $Company_id = unserialize($this->session->userdata('admin'));
		    $cid1 = $Company_id['id'];
			
             $this->db->select('c_id');
             $this->db->from('admins');
             $this->db->where("id = $cid1");
		     $page = $this->db->get();
		
		      return $page->result();
			 // $query1 = $this->db->last_query();
			  
	}
	
	
	
		public function getallUserPage() 
	{ 
          $Company_id = unserialize($this->session->userdata('admin'));
		  $cid1 = $Company_id['id'];	
		 $this->db->where('type','enduser');
		 $this->db->where('c_id', $cid1);
		 $query = $this->db->get('admins')->result();
	   return $query;
	   
	}
	
	public function getallDrops() 
	{  
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->where('shift	','1');
		 $this->db->where("created_date > DATE_SUB(CURDATE(), INTERVAL 0 DAY)");
		 $query = $this->db->get('drops_payout')->result();
	   
	   //$query = $this->db->query("select * from `cd_admins` where type = 'enduser'  ");
	  // echo "kjlkj";
	   return $query;
	   // return $page;
	}
	
	public function getallDropsReceived() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->daily_shift_model->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 $daily_no = $shiftdata['daily_no'];
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->where('shift',$shift_id );
		 $this->db->where('c_id',$cid1);
		 $this->db->where('daily_no',$daily_no);
		 $this->db->where('user_id',$user_id);
		// $this->db->where("created_date > DATE_SUB(CURDATE(), INTERVAL 0 DAY)");
		 $this->db->where('type	','received');
		 $this->db->order_by('created_date','DESC');
		 $query = $this->db->get('drops_payout')->result();
	     $q=$this->db->last_query($query );
		// print_r($q); die('err');
	   return $query;
	  
	}
	
	public function getallPayoutCash() 
	{  
         $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->daily_shift_model->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 $daily_no = $shiftdata['daily_no'];
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->where('shift',$shift_id );
		 $this->db->where('c_id',$cid1);
		 $this->db->where('daily_no',$daily_no);
		 $this->db->where('user_id',$user_id);
		// $this->db->where("created_date > DATE_SUB(CURDATE(), INTERVAL 0 DAY)");
		 $this->db->where('type	','cash');
		 $this->db->order_by('created_date','DESC');
		 $query = $this->db->get('drops_payout')->result();
	     
	  return $query;
	   
	}
	
	public function getallPayoutCredit() 
	{  
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->where('shift	','1');
		 $this->db->where("created_date > DATE_SUB(CURDATE(), INTERVAL 0 DAY)");
		 $this->db->where('type	','credit');
		 $query = $this->db->get('drops_payout')->result();
	   
	   //$query = $this->db->query("select * from `cd_admins` where type = 'enduser'  ");
	  // echo "kjlkj";
	   return $query;
	   // return $page;
	}
	
	
	public function getSumPayoutCredit() 
	{  
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(amount) AS credit_amount', FALSE);
		 $this->db->where('shift	','1');
		 $this->db->where("created_date > DATE_SUB(CURDATE(), INTERVAL 0 DAY)");
		 $this->db->where('type	','credit');
		 $query = $this->db->get('drops_payout')->result();
	   
	  
	   return $query;
	   
	}
	
	public function getSumPayoutCash() 
	{  
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(amount) AS cash_amount', FALSE);
		 $this->db->where('shift	','1');
		 $this->db->where("created_date > DATE_SUB(CURDATE(), INTERVAL 0 DAY)");
		 $this->db->where('type	','cash');
		 $query = $this->db->get('drops_payout')->result();
	   
	   return $query;
	   
	}
	
	public function getSumDropsReceived() 
	{  
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(amount) AS received_amount', FALSE);
		 $this->db->where('shift	','1');
		 $this->db->where("created_date > DATE_SUB(CURDATE(), INTERVAL 0 DAY)");
		 $this->db->where('type	','received');
		 $query = $this->db->get('drops_payout')->result();
	   
	  
	   return $query;
	   
	}
	
	function get_end_users($q=null,$total=null,$start=null,$whr=null){
		$get_user_id=$this->getCompanyId();
		
		$this->db->where("type ",'enduser');
		$this->db->where("c_id",$get_user_id[0]->c_id);
        $query = $this->db->get('admins');
        $result = $query->result();
		
		return $result;
	}
	public function deletePayoutEntry($id)
	{
		$result = $this->db->delete('drops_payout', array('id' => $id)); 
		return $result;

	}
	
	
	public function deleteEnduser($id)
	{
		$result = $this->db->delete('admins', array('id' => $id)); 
		return $result;

	}
	
	
	public function getGasolineRecordByDaily($daily_no) 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->daily_shift_model->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 $this->db->select('*');
		 
		 $this->db->where('daily_shift_id', $shift_id);
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('user_id',$user_id);
		 $this->db->where('daily_no', $daily_no);
		 $this->db->order_by('date','DESC');
		 $query = $this->db->get('daily_entry')->result();
		 $query1=$this->db->last_query($query);
	  // print_r($query1); die('err');
	  
	   return $query;
	   
	}
	
	
	
	public function getGasolineEndRecordByDaily($daily_no) 
	{  
	     $statusss = $this->daily_shift_model->check_ShiftUser();
		
		 $shift_id =  $statusss['access_module'];
		 $user_id = $statusss['id'];
		 $cid1 = $statusss['c_id'];
		 $this->db->select('*');
		 
		 $this->db->where('daily_shift_id', $shift_id);
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('user_id',$user_id);
		 $this->db->where('daily_no', $daily_no);
		 $this->db->order_by('date','DESC');
		 $query = $this->db->get('daily_entry')->result();
		 $query1=$this->db->last_query($query);
	  // print_r($query1); die('err');
	  
	   return $query;
	   
	}
	
}
 

?>
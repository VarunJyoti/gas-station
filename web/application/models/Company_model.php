<?php
class Company_model extends MY_Model{
	protected $_table_name = 'cd_company';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'name','email', 'address', 'pin', 'contact', 'date_created', 'date_modified', 'status','username','password', 'p_id', 'shift');
	
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
	public $p_id;
	public $shift;
		
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
		
			$data['status'] =	$this->input->post("status");	
           
		   $p = $this->input->post("p_id");
			
			$data['p_id'] = serialize($p);
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
			
			$ip_addr = $this->getRealIpAddress(); 

			$data1 = array('email'=> $email1,	'username'=> $username1,	'password'=> $password1,	'phone'=> $phone1,	'status'=> $status1,'pin'=> $pin1, 'ip'=> $ip_addr,	'modified_date'=> $modified_date);
			$this->db->where('c_id', $id);
			$this->db->update($table1, $data1); 
		    $sql1= $this->db->last_query();
			if($last_id !== 0){
				return true;
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');
			}else{
				return false;
			}
			//$this->save($data, $id);

		} else {
		
			$status =	$this->input->post("status");	
			$data['date_created']		=	time();
            $data['date_created']  = date("Y-m-d H:i:s", time());
			$p = $this->input->post("p_id");
			
		    $data['p_id'] = serialize($p);  
			$last_id = $this->db->insert($table ,$data);
			$sql= $this->db->last_query();
		    $insert_id = $this->db->insert_id();
			$table1 = 'admins';
		
			$username1 =	$this->input->post("username");
			$password1 =	$this->input->post("password");
			$password1 =	md5($password1);
			$email1 =	$this->input->post("email");
			$phone1 =	$this->input->post("contact");
			$pin1 =	$this->input->post("pin");
			$status1 =	$this->input->post("status");
			$created_date= date("Y-m-d H:i:s", time());
			
	

			$ip_addr = $this->getRealIpAddress(); 
			$data1 = array('id'=> NULL,	'first_name'=> "",	'last_name'=> "",	'email'=> $email1,	'password'=> $password1,	'dob'=> "",	'gender'=> "",	'type'=> 'admin',	'created_dated'=> $created_date,	'modified_date'=> "",	'login_activity'=> "",	'status'=> $status1,	'verification_code'=> "",	'access_module'=> "",	'location_access'=> "",	'c_id'=> $insert_id,	'username'=> $username1,	'phone'=> $phone1,	'state_id'=> "",	'city_id'=> "",	'pin'=> $pin1,	'ip'=> $ip_addr);
			
			$this->db->insert($table1, $data1); 
		    $sql1= $this->db->last_query();
			$pp_id = $this->input->post("p_id");
			$cc_id = $insert_id;
			$id= NULL;
			$price = 'ooo.oo';
			$i = 0;
			$data['date_created']		=	time();
			$date_created = date("Y-m-d H:i:s", time());	
			$date_modified = "";
			/*foreach($pp_id as $row => $value){
				$data2['id'] = $pp_id[$row[p_id]];
				$data2['pid'] =$value;
				$data2['price'] = $price[$i];
				$data2['c_id'] = $cc_id;
				$data2['date_created'] = $date_created;
				$data2['date_modified'] = $date_modified;
				$this->db->insert("cd_price",$data2);
				$sql2= $this->db->last_query();
				$i++;
			}*/
			if($last_id !== 0){
				return true;
			}
			else{
				return false;
			}
			
		}			
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

	public function deletePage($email)
	{
	    $row =$this->getCID($email);
		$c_id = $row[c_id];
		$id = $row[id];
		$page = $this->CheckDailyEnry($c_id);
		if(empty($page))
		{
			
		$result = $this->db->where('email', $email)->delete('cd_company');
		$this->db->where('email', $email)->delete('cd_admins');
		return $result;
		}
		
		else if(!empty($page))
		{    
	         // print_r($id); die('not empty');
			
			$table1= 'cd_admins';
			
			$data1 = array('status'=> '0');
			$this->db->where('c_id', $c_id);
			$result = $this->db->update($table1, $data1);
			
			$table2= 'cd_company';
			$data2 = array('status'=> '0');
			$this->db->where('id', $c_id);
			$result1 = $this->db->update($table2, $data2);
			return $result1;
		}
		

	}
	
	public function getCID($email)
	{
	
		   $this->db->where("email",$email);
			
            $query = $this->db->get('admins');
            $page1 = $query->row_array();
            return $page1;

	}
	
	
	public function CheckDailyEnry($c_id)
	{
	
		$this->db->select('*');
        $this->db->from('daily_entry');
       // $this->db->where("c_id",$c_id);
		$this->db->where("c_id", $c_id);
		//$this->db->order_by('login_time','DESC');
		$page = $this->db->get();
		$page1 = $page->row_array();
        return $page1;
	}
	

	public function getallProduct() 
	{
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where("p_cat = 'main'");	
		$this->db->where("status = '1'");	
		$query = $this->db->get();
		$page = $query->result();
		return $page;
	}
	
	public function getCompanyId() 
	{
		
		$Company_id = unserialize($this->session->userdata('admin'));
		$cid1 = $Company_id['id'];
		$query = $this->db->query("select c_id from `cd_admins` where id = $cid1");
			return $query->result();
	}
	public function getCompanyLoginId() 
	{
		
		$Company_id = unserialize($this->session->userdata('admin'));
		$cid1 = $Company_id['id'];
		$query = $this->db->query("select c_id from `cd_admins` where id = $cid1");
			return $query->row_object()->c_id;
	}
	
	
	
	public function getallProductPrice() 
	{
			$Company_id = unserialize($this->session->userdata('admin'));
		    $cid1 = $Company_id['id'];
			$query = $this->db->query("SELECT cd_product.p_name, cd_price.p_id, cd_price.price FROM cd_product INNER JOIN cd_price ON cd_product.id = cd_price.p_id where cd_price.c_id = $cid1");

		foreach ($query->result_array() as $row)
		{
		  $cat.= '<input type="text" name="p_price" value="'.$row['price'].'"><label>'.$row['p_name'].'</label><br/>';
		   
		}
		
		return $cat;
	}
	
	
	
	public function getPrice($id) 
	{
			$this->db->join('price', 'price.pid = product.id');
			$this->db->where("price.c_id = '{$id}'");
            $query = $this->db->get('product');
            $page1 = $query->result();
            //$page1 = $this->db->last_query();
            return $page1;

     }
	 public function getMainProducts() 
		{
			$c_id = $this->company_model->getCompanyLoginId();
			$p_id = unserialize($this->getPage($c_id)->p_id);
			$ids = join(', ', $p_id);
			$this->db->where("p_cat" , "main");
			$this->db->where("status" , '1');
			$this->db->where("id in ($ids)");
            $query = $this->db->get('product');
            $page1 = $query->result();
			//print_r($page1);die;
		   return $page1;

     }
	 
	 public function getProductName($id) 
	{
	
			$Company_id = unserialize($this->session->userdata('admin'));
		    $cid1 = $Company_id['id'];
			$this->db->select('*');
            $this->db->from('price');
            $this->db->join('product', 'product.id = price.pid');
			$this->db->where("cd_price.c_id = '{$id}'");
            $query = $this->db->get();
			$query1 = $this->db->last_query($query);
			$page1 = $query->result();
            return $page1;

     }
	 
	 
	 public function check_email_available($email)
      {
	    $this->db->where('email',$email);
	    $query= $this->db->get('admins');
	
	     if($query->num_rows() == 0)
		 {
			return 'true';
		 }
	     else
		 {
	     return 'false';
		 }
		 
      }
	  public function check_username_available($username)
      {
	    $this->db->where('username',$username);
	    $query= $this->db->get('admins');
	
	     if($query->num_rows() > 0)
		 {
			return 'false';
		 }
	     else
		 {
	     return 'true';
		 }
		 
      }
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
		
		
		
		/*
		Gasoline view page starts
		*/
	public function getGasolineRecordByShift($daily_no,$shift) 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
          
		  $this->db->select('*');
		 
		 $this->db->where('daily_shift_id', $shift);
		 
		// $this->db->where('date	',$date);
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('daily_no', $daily_no);
		 $this->db->order_by('date','DESC');
		 $query = $this->db->get('daily_entry')->result();
		 $query1=$this->db->last_query($query);
	     //print_r($query1); die('err');
	  
	   return $query;
	   
	}
	
	
	
	public function getShiftNo() 
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
          
	  
	 	  $this->db->distinct();

          $this->db->select('daily_shift_id');
 
		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('date','DESC');
		 $query = $this->db->get('daily_entry')->result();
		
	   return $query;
	   
	}
	
	
	public function getDaily_no() 
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
          
	  
	 	  $this->db->distinct();

          $this->db->select('daily_no');
 
		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('date','DESC');
		 $query = $this->db->get('daily_entry')->result();
		
	   return $query;
	   
	}
	
	
	
	public function getShiftDate() 
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
        
          $this->db->select('date');
		 
		 $this->db->where('c_id	',$cid1);

		 $this->db->group_by('date(date)');
		 $query = $this->db->get('daily_entry')->result();
		
	   return $query;
	   
	}
	
	
			/*
		Gasoline view page ends
		*/
	
}
 

?>
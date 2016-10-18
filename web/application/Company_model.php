<?php
class Dailyentry_model extends CI_Model{
	protected $_table_name = 'drops_payout';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'amount',	'name',	'created_date',	'modified_date', 'shift', 'type');
	
	public $id;
	public $amount; 
	public $name; 
	public $created_date; 
	public $modified_date; 
	public $shift; 
	public $type; 
	
		
	
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
            $p = $this->input->post("p_id");
			
			$data['p_id'] = serialize($p);
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
			
	// update code for price table for admin starts here
	
	
	// update code for price table for admin  starts here
			
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
			//$status =	$this->input->post("status");	
			$data['date_created']		=	time();
            $data['date_created']  = date("Y-m-d H:i:s", time());
			$p = $this->input->post("p_id");
			
		    $data['p_id'] = serialize($p);  
			//$pid = unserialize($p);
			//foreach($pid as $pro)
			//{
			//print_r $pid;
				
			//}
			 
            
//print_r($pid);
//die('error');			
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

 
	 
//price table insert starts

	  
	  
 $pp_id = $this->input->post("p_id");

    $cc_id = $insert_id;
	$id= NULL;
    $price = 'ooo.oo';
    $i = 0;
	$data['date_created']		=	time();
	$date_created = date("Y-m-d H:i:s", time());	
	$date_modified = "";
    foreach($pp_id as $row => $value){
		// print_r($row);
//print_r($value);
// die('error');
		$data2['id'] = $pp_id[$row[p_id]];
        $data2['pid'] =$value;
		$data2['price'] = $price[$i];
        $data2['c_id'] = $cc_id;
        $data2['date_created'] = $date_created;
		$data2['date_modified'] = $date_modified;
        $this->db->insert("cd_price",$data2);
		$sql2= $this->db->last_query();
        $i++;
      }

	 
//price table insert ends
		
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
	
	
	
	public function saveprice1($id=NULL,$table='price')
	{
		$data 	= $this->array_from_post();	
		//print_r($data);
		//die('error');
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
		
	/*	
$this->db->select('name,c_id,email,address,pin,contact,status,username,password,pid,price');
$this->db->from('company');
$this->db->join('price', 'price.c_id = company.id', 'left');
$this->db->where("company.id = '{$id}'");
$query = $this->db->get();
//$query1 = $this->db->last_query();
$page = $query->result();
return $page[0];
//print_r($query1);
//die('error');
*/
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
			$query = $this->db->query("select c_id from `cd_admins` where id = $cid1");
			
            
			//$query = "select c_id from `cd_admins` where id = $cid";
			//$page = $this->db->query($query);
	
	       // echo "hello";
		
		      return $query->result();
	}
	
	
	
	public function getallProductPrice() 
	{
			$Company_id = unserialize($this->session->userdata('admin'));
		    $cid1 = $Company_id['id'];
	$query = $this->db->query("SELECT cd_product.p_name, cd_price.p_id, cd_price.price FROM cd_product INNER JOIN cd_price ON cd_product.id = cd_price.p_id where cd_price.c_id = $cid1");

		foreach ($query->result_array() as $row)
		{
		   //$cat.= '<option value="'.$row['p_name'].'">'.$row['p_name'].'</option>';
		   $cat.= '<input type="text" name="p_price" value="'.$row['price'].'"><label>'.$row['p_name'].'</label><br/>';
		   
		}
		
		return $cat;
	}
	
	
	
	public function getPrice($id) 
	{
	/*	$this->db->where("id = '{$id}'");		
		$page = $this->get();
		
		return $page[0];
		*/
					$Company_id = unserialize($this->session->userdata('admin'));
		    $cid1 = $Company_id['id'];
			
			
			$this->db->select('*');
$this->db->from('price');
$this->db->join('product', 'product.id = price.pid');
			
			
//$this->db->select('*');
//$this->db->from('price');

$this->db->where("cd_price.c_id = '{$id}'");
$query = $this->db->get();
//$query1 = $this->db->last_query();
$page1 = $query->result();

return $page1;
//$query = $this->db->get();


	}
	


}
 

?>
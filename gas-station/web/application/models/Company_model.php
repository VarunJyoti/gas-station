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

		} 
		else 
		{
		
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
			if($last_id !== 0)
			{
				return true;
			}
			else
			{
				return false;
			}
			
		}			
	}
	
	
	
	public function SaveCreditCustomer($id=NULL,$table='credit_customer')
	{
		
		
		if($id)
		{
			
			$name =	$this->input->post("name");	
			$email =	$this->input->post("email");	
			$phone =	$this->input->post("phone");	
			$credit_limit =	$this->input->post("credit_limit");	
			$c_id = $this->getCompanyLoginId() ;
            //$date_created = ;
			$date = date('Y-m-d');
            $date_modified = date("Y-m-d H:i:s", time());
			
			$data = array('name'=> $name,	'email'=> $email,	'phone'=> $phone,	'credit_limit'=> $credit_limit,	'date_modified'=> $date_modified);

			$this->db->where('id', $id);
			$last_id = $this->db->update($table ,$data);
			
		    if($last_id !== 0){
				return true;
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');
			}
			else{
				return false;
			}
		
			//$this->save($data, $id);

		}
		else 
		{
		
			$name =	$this->input->post("name");	
			$email =	$this->input->post("email");	
			$phone =	$this->input->post("phone");	
			$credit_limit =	$this->input->post("credit_limit");	
			$c_id = $this->getCompanyLoginId() ;
            $date_created = date("Y-m-d H:i:s", time());
			$date = date('Y-m-d');
            $date_modified = '0';
			
			$data = array('id'=> NULL,	'name'=> $name,	'email'=> $email,	'phone'=> $phone,	'credit_limit'=> $credit_limit,	'date_created'=> $date_created,	'date_modified'=> $date_modified,	'date'=> $date,	'c_id'=> $c_id);
		     
			$last_id = $this->db->insert($table ,$data);
			$sql= $this->db->last_query();
		    $insert_id = $this->db->insert_id();
			
			if($last_id !== 0){
				return true;
			}
			else{
				return false;
			}
			
		}			
	}
	
	
	
	public function SaveAmountReceived($id=NULL,$table='amount_received')
	{
		
		
		if($id)
		{
			
			$date =	$this->input->post("date");	
			$amount =	$this->input->post("amount");	
			$mode =	$this->input->post("mode");	
			//$credit_limit =	$this->input->post("credit_limit");	
			//$c_id = $this->getCompanyLoginId() ;
            //$date_created = ;
			//$date = date('Y-m-d');
            $date_modified = date("Y-m-d H:i:s", time());
			
			$data = array('date'=> $date,	'amount'=> $amount, 'mode'=> $mode, 'date_modified'=> $date_modified);

			$this->db->where('id', $id);
			$last_id = $this->db->update($table ,$data);
			
		    if($last_id !== 0){
				return true;
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');
			}
			else{
				return false;
			}
		
			//$this->save($data, $id);

		}
		else 
		{
		
			$name =	$this->input->post("name");	
			$amount =	$this->input->post("amount");	
			$date =	$this->input->post("date");	
			$mode =	$this->input->post("mode");	
			$c_id = $this->getCompanyLoginId() ;
            $date_created = date("Y-m-d H:i:s", time());
			//$date = date('Y-m-d');
            $date_modified = '0';
			
			$data = array('id'=> NULL, 'date'=> $date,	'amount'=> $amount,	'name'=> $name,	'mode'=> $mode,	'c_id'=> $c_id,	'date_created'=> $date_created,	'date_modified'=> $date_modified);
		     
			$last_id = $this->db->insert($table ,$data);
			$sql= $this->db->last_query();
		    $insert_id = $this->db->insert_id();
			
			if($last_id !== 0){
				return true;
			}
			else{
				return false;
			}
			
		}			
	}
	
	
	
//##############################Expancess Starts ################################################################
	              //########################### Main Cat Starts ###############################
	
	public function SaveExpcat($id=NULL,$table='expcat')
	{
		
		
		if($id)
		{
			
			$cat_name =	$this->input->post("cat_name");	
			
			
			$data = array('cat_name'=> $cat_name);

			$this->db->where('id', $id);
			$last_id = $this->db->update($table ,$data);
			
		    if($last_id !== 0){
				return true;
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');
			}
			else{
				return false;
			}
		
		}
		else 
		{
		
			$cat_name =	$this->input->post("cat_name");	
				
			$c_id = $this->getCompanyLoginId() ;
           
			$data = array('id'=> NULL, 'cat_name'=> $cat_name,	'c_id'=> $c_id);
		     
			$last_id = $this->db->insert($table ,$data);
			$sql= $this->db->last_query();
		    $insert_id = $this->db->insert_id();
			
			if($last_id !== 0){
				return true;
			}
			else{
				return false;
			}
			
		}			
	}
                        //################################# Main Cat Ends ##########################
							  
							  
							  //############ Sub Cat Starts ###############
							  
	 public function SaveExpSubcat($id=NULL,$table='expsubcat')
	{
		
		
		if($id)
		{
			
			$cat_name =	$this->input->post("cat_name");
            $subcat_name =	$this->input->post("subcat_name");			
            $frequency =	$this->input->post("frequency");			
            $fixed_variable =	$this->input->post("fixed_variable");			
			
			
			$data = array('subcat_name'=> $subcat_name, 'cat_name'=> $cat_name,'frequency'=> $frequency,'fixed_variable'=> $fixed_variable);

			$this->db->where('id', $id);
			$last_id = $this->db->update($table ,$data);
			
		    if($last_id !== 0){
				return true;
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');
			}
			else{
				return false;
			}
		
		}
		else 
		{
		
			$cat_name =	$this->input->post("cat_name");	
			$subcat_name =	$this->input->post("subcat_name");
			$frequency =	$this->input->post("frequency");			
            $fixed_variable =	$this->input->post("fixed_variable");
				
			$c_id = $this->getCompanyLoginId() ;
           
			
			$data = array('id'=> NULL, 'subcat_name'=> $subcat_name, 'cat_name'=> $cat_name, 'frequency'=> $frequency, 'fixed_variable'=>$fixed_variable, 'c_id'=> $c_id);
		     
			$last_id = $this->db->insert($table ,$data);
			$sql= $this->db->last_query();
		    $insert_id = $this->db->insert_id();
			
			if($last_id !== 0){
				return true;
			}
			else{
				return false;
			}
			
		}			
	}
							  //############ Sub Cat Ends ###############
							  
							  
		//############################## Expenceses Entry Starts ####################################			  
							  
	 public function SaveExpData($id=NULL,$table='expenses')
	{
		
		
		if($id)
		{
			
			$cat_name =	$this->input->post("cat_name");	
			$subcat_name =	$this->input->post("subcat_name");	
			$exp_amount =	$this->input->post("exp_amount");
            $date_modified = date("Y-m-d H:i:s", time());
            $date = $this->input->post("exp_date");			
				
			$c_id = $this->getCompanyLoginId() ;
           
			
			$data = array('exp_amount'=> $exp_amount, 'exp_subcat'=> $subcat_name, 'exp_cat'=> $cat_name,	'c_id'=> $c_id, 'date'=> $date, 'date_modified'=>$date_modified);

			$this->db->where('id', $id);
			$last_id = $this->db->update($table ,$data);
			
		    if($last_id !== 0){
				return true;
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');
			}
			else{
				return false;
			}
		
			

		}
		else 
		{
		
			$cat_name =	$this->input->post("cat_name");	
			$subcat_name =	$this->input->post("subcat_name");	
			$exp_amount =	$this->input->post("exp_amount");
            $date_created = date("Y-m-d H:i:s", time());
            $date = $this->input->post("exp_date");			
				
			$c_id = $this->getCompanyLoginId() ;
           
			
			$data = array('id'=> NULL, 'exp_amount'=> $exp_amount, 'exp_subcat'=> $subcat_name, 'exp_cat'=> $cat_name,	'c_id'=> $c_id, 'date'=> $date, 'date_created'=> $date_created, 'date_modified'=> '');
		     
			$last_id = $this->db->insert($table ,$data);
			$sql= $this->db->last_query();
		    $insert_id = $this->db->insert_id();
			
			if($last_id !== 0){
				return true;
			}
			else{
				return false;
			}
			
		}			
	}
	
	
	
	/*
	  ** Get Expancess Main Category
	*/
	
	public function getallMainExpCat() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 
		 $this->db->where('c_id',$cid1);
		 
		 //$this->db->order_by('date_created','DESC');
		 $query = $this->db->get('expcat')->result();
	     $q=$this->db->last_query($query );
		// print_r($q); die('err');
	   return $query;
	  
	}
	
	
	/*
	  ** Get Total Expancess DateWise
	*/
	public function getTotalExpensesByDate($date)
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
        $this->db->select('SUM(exp_amount) as total_exp', FALSE);
		$this->db->like('date', $date);
		// $this->db->where('date <=', $date);
		// $this->db->where('date >=', $date);
        // $this->db->where('date <=', $date2);
      
		 $this->db->where('c_id	',$cid1);
		// $this->db->where('pid',$pid);
		 //$this->db->group_by('cc_type'); 
		 $query = $this->db->get('expenses')->row_array();
		 $q= $this->db->last_query($query);
		 //print_r($q); die();
	     return $query['total_exp'];
	   
	}
	
	
	 //########################### Expenceses Entry Ends #################################	
							  
//############################################## Expenceses Ends ########################################################
	

//############################## SavePuechased  Starts ####################################			  
							  
	 public function SavePuechasedData($id=NULL,$table='purchase')
	{
		
		
		if($id)
		{
			
			$cat_name =	$this->input->post("cat_name");	
			$subcat_name =	$this->input->post("subcat_name");	
			$exp_amount =	$this->input->post("exp_amount");
            $date_modified = date("Y-m-d H:i:s", time());
            $date = $this->input->post("exp_date");			
				
			$c_id = $this->getCompanyLoginId() ;
           
			
			$data = array('exp_amount'=> $exp_amount, 'exp_subcat'=> $subcat_name, 'exp_cat'=> $cat_name,	'c_id'=> $c_id, 'date'=> $date, 'date_modified'=>$date_modified);

			$this->db->where('id', $id);
			$last_id = $this->db->update($table ,$data);
			
		    if($last_id !== 0){
				return true;
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');
			}
			else{
				return false;
			}
		
		}
		else
		{
		
			$purchased_date =	$this->input->post("purchased_date");	
			$supplier_name =	$this->input->post("supplier_name");	
			$p_name =	$this->input->post("p_name");
			$gallons_amount =	$this->input->post("gallons_amount");
			$purchased_price =	$this->input->post("purchased_price");
			$total_amount_to_paid =	$this->input->post("total_amount_to_paid");
            $date_created = date("Y-m-d H:i:s", time());
            	
			$c_id = $this->getCompanyLoginId() ;
           
			$data = array('id'=> NULL, 'p_id'=> $p_name, 'gallons_received'=> $gallons_amount, 'purchased_price'=> $purchased_price,	'amount_to_paid'=> $total_amount_to_paid, 'c_id'=> $c_id, 'date'=> $purchased_date, 'date_created'=>$date_created, 'date_modified'=>'', 'supplier_name'=>$supplier_name);
		     
			$last_id = $this->db->insert($table ,$data);
			$sql= $this->db->last_query();
		    $insert_id = $this->db->insert_id();
			
			if($last_id !== 0){
				return true;
			}
			else{
				return false;
			}
			
		}			
	}
	
	 //########################### SavePuechased  Ends #################################	

	
	
	public function getUsers($account_type = "All") 
	{
		if($account_type != "All"){			
			$this->db->where("account_type = '{$account_type}' and delete_status = 0");
		} 
		else {
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
	
	
		public function getPages($id) 
	{
		$this->db->where("id = '{$id}'");		
		$page = $this->db->get('credit_customer')->row_array();
		
		return $page;
		
	}
	
	public function getReceivedAmountPages($id) 
	{
		$this->db->where("id = '{$id}'");		
		$page = $this->db->get('amount_received')->row_array();
		
		return $page;
		
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
			$table1= 'cd_admins';
			
			$data1 = array('status'=> '0');
			$this->db->where('c_id', $c_id);
			$result = $this->db->update($table1, $data1);
			
			$table2= 'cd_company';
			$data2 = array('status'=> '0');
			$this->db->where('id', $c_id);
			$result = $this->db->update($table2, $data2);
			$result = 0;
			return $result;
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
	 
	public function getProductName() 
	{
	
			$cid = $this->gasolinereceived_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			$this->db->select('*');
            $this->db->from('price');
            $this->db->join('product', 'product.id = price.pid');
			$this->db->where("cd_price.c_id = '{$cid1}'");
            $query = $this->db->get();
			$query1 = $this->db->last_query($query);
			$page1 = $query->result();
			
            return $page1;

    }
	 
	public function getPName() 
	{
	
			$cid = $this->gasolinereceived_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			$this->db->select('*');
            $this->db->from('price');
            $this->db->join('product', 'product.id = price.pid');
			$this->db->where("cd_price.c_id = '{$cid1}'");
			$this->db->where("cd_product.p_cat = 'main'");
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
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('daily_no', $daily_no);
		 $this->db->order_by('date','DESC');
		 $query = $this->db->get('daily_entry')->result();
		 $query1=$this->db->last_query($query);
	   
	  
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
	
	
	
	public function getDate() 
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
          
	  
	 	  $this->db->distinct();

          $this->db->select('date');
 
		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('date','DESC');
		 $query = $this->db->get('daily_entry')->result();
		
	   return $query;
	   
	}
	
	
	public function getDailyEntryBtwn2Dates($first_date,$second_date) 
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('*');
		 $this->db->where('date >=', $first_date);
         $this->db->where('date <=', $second_date);

		 $this->db->where('c_id	',$cid1);
		 $this->db->group_by('daily_shift_id'); 
		 $query = $this->db->get('daily_entry')->result();
		 $q= $this->db->last_query($query);
		 //print_r($q); die('er');
		
	   return $query;
	   
	}
	
	public function getDataBtwn2Dates($first_date,$second_date) 
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('*');
		 $this->db->where('date >=', $first_date);
         $this->db->where('date <=', $second_date);

		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('date'); 
		 $query = $this->db->get('daily_entry')->result();
		 //$q= $this->db->last_query($query);
		
	   return $query;
	   
	}
	
	
	public function getSumDataBtwn2Dates($first_date,$second_date,$pid) 
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('SUM(sale + old_sale) as total', FALSE);
		 $this->db->where('date >=', $first_date);
         $this->db->where('date <=', $second_date);

		 $this->db->where('c_id	',$cid1);
		 $this->db->where('pid	',$pid);
		 $this->db->order_by('date'); 
		 $query = $this->db->get('daily_entry')->row_array();
		 $q= $this->db->last_query($query);
		 //print_r($q); die('errr'); 
	   return $query['total'];
	   
	}
	
	
	public function getSumOfDiffBtwn2Dates($first_date,$second_date,$pid) 
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('SUM(diff) as total', FALSE);
		 $this->db->where('date >=', $first_date);
         $this->db->where('date <=', $second_date);

		 $this->db->where('c_id	',$cid1);
		 $this->db->where('pid	',$pid);
		 $this->db->order_by('date'); 
		 $query = $this->db->get('daily_entry')->row_array();
		 $q= $this->db->last_query($query);
		 //print_r($q); die('errr'); 
	   return $query['total'];
	   
	}
	
	
	public function getSumOfTotalBtwn2Dates($first_date,$second_date,$pid) 
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('SUM(total) as total', FALSE);
		 $this->db->where('date >=', $first_date);
         $this->db->where('date <=', $second_date);

		 $this->db->where('c_id	',$cid1);
		 $this->db->where('pid	',$pid);
		 $this->db->order_by('date'); 
		 $query = $this->db->get('daily_entry')->row_array();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query['total'];
	   
	}
	
	
	
	
	
	public function getSumOfSaleDateWise($date,$pid) 
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('SUM(sale + old_sale) as total', FALSE);
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('pid	',$pid);
		 $this->db->order_by('date'); 
		 $query = $this->db->get('daily_entry')->row_array();
		 $q= $this->db->last_query($query);
		 //print_r($q); die();
	   return $query['total'];
	   
	}
	
	
	
	public function getSumOfTotalDateWise($date,$pid)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('SUM(total) as total', FALSE);
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('pid	',$pid);
		 $this->db->order_by('date'); 
		 $query = $this->db->get('daily_entry')->row_array();
		 $q= $this->db->last_query($query);
		 //print_r($q); die();
	   return $query['total'];
	   
	}
	
	
	public function getDateWiseRecords($date)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('*');
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		 //$this->db->where('pid	',$pid);
		 $this->db->group_by('daily_shift_id'); 
		 $query = $this->db->get('daily_entry')->result();
		 $q= $this->db->last_query($query);
		// print_r($q); die();
	   return $query;
	   
	}
	
	
	public function getCCardDateWiseRecords($date)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('cc_type, SUM(amount) as due_amount,SUM(pending) as pending_amount,SUM(received_amount) as received_amount,SUM(balance) as balance_amount', FALSE);
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		 //$this->db->where('pid	',$pid);
		 $this->db->group_by('cc_type'); 
		 $query = $this->db->get('ccard_entry')->result();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query;
	   
	}
	
	
	
	public function getCCardTypeWiseRecords($date,$ctype)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('cc_type, SUM(amount) as due_amount,SUM(pending) as pending_amount,SUM(received_amount) as received_amount,SUM(balance) as balance_amount', FALSE);
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('cc_type',$ctype);
		 $this->db->group_by('cc_type'); 
		 $query = $this->db->get('ccard_entry')->result();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	    return $query;
	   
	}
	
	
	public function getCAccountRecordsByDate($date,$customer)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('SUM(amount) as TotalCredit_amount', FALSE);
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('name',$customer);
		 $this->db->group_by('name'); 
		 $query = $this->db->get('creditamount_entry')->row_array();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query['TotalCredit_amount'];
	   
	}
	
	
	public function getCReceivedAmountByDate($date,$customer)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('SUM(amount) as TotalCreditReceived_amount', FALSE);
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('name',$customer);
		 $this->db->group_by('name'); 
		 $query = $this->db->get('amount_received')->row_array();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query['TotalCreditReceived_amount'];
	   
	}
	
	
	
	public function getCReceivedModeByDate($date,$customer)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('mode');
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('name',$customer);
		 $this->db->group_by('name'); 
		 $query = $this->db->get('amount_received')->row_array();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query['mode'];
	   
	}
	
	
	public function getTotalCAmountUpToDate($date,$date2,$customer)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('SUM(amount) as TotalCredit_amount', FALSE);
		// $this->db->where('date <=', $date);
		 $this->db->where('date >=', $date);
         $this->db->where('date <=', $date2);
         $this->db->where('c_id	',$cid1);
		 $this->db->where('name',$customer);
		 $this->db->group_by('name'); 
		 $query = $this->db->get('creditamount_entry')->row_array();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query['TotalCredit_amount'];
	   
	}
	
	
	
	public function getPLRecordsBydate($date)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('SUM(open) as open,SUM(received) as purchased,SUM(sale + old_sale) as sale,SUM(balance) as balance', FALSE);
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		// $this->db->where('pid',$pid);
		 //$this->db->group_by('cc_type'); 
		 $query = $this->db->get('daily_entry')->row_array();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query;
	   
	}
	
	/* old function
	public function getPLRecords($date,$pid)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('SUM(open) as open,SUM(received) as purchased,SUM(sale + old_sale) as sale,SUM(balance) as balance', FALSE);
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('pid',$pid);
		 //$this->db->group_by('cc_type'); 
		 $query = $this->db->get('daily_entry')->row_array();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query;
	   
	}
	*/
	
	
	public function getPLRecords($date,$pid)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('SUM(open) as open,SUM(received) as purchased,SUM(sale) as sale,SUM(old_sale) as old_sale,SUM(balance) as balance', FALSE);
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('pid',$pid);
		 //$this->db->group_by('cc_type'); 
		 $query = $this->db->get('daily_entry')->row_array();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query;
	   
	}
	
	
	public function getPLRecordss($date,$pid)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('SUM(open) as open,SUM(received) as purchased,SUM(sale) as sale,SUM(old_sale) as old_sale,SUM(balance) as balance', FALSE);
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('pid',$pid);
		 //$this->db->group_by('cc_type'); 
		 $query = $this->db->get('daily_entry')->row_array();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query;
	   
	}
	
	
	public function getPLStoreSalesRecordss($date)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('store_sales');
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		  //$this->db->limit('1');
		// $this->db->where('pid',$pid);
		 $this->db->group_by('daily_shift_id'); 
		 $query = $this->db->get('daily_entry')->result();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query;
	   
	}
	
	public function getPLRecordsUpToDate($date,$date2,$pid)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
        $this->db->select('SUM(open) as open,SUM(received) as purchased,SUM(sale + old_sale) as sale,SUM(balance) as balance', FALSE);
		// $this->db->where('date <=', $date);
		 $this->db->where('date >=', $date);
         $this->db->where('date <=', $date2);
      
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('pid',$pid);
		 //$this->db->group_by('cc_type'); 
		 $query = $this->db->get('daily_entry')->row_array();
		 $q= $this->db->last_query($query);
		 //print_r($q); die();
	     return $query;
	   
	}
	
	
	
	
	
	
	public function getSumOfAllDateWise($date,$pid)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('SUM(open) as total_open,SUM(received) as total_received,SUM(sale + old_sale) as total_sale,SUM(balance) as total_balance,SUM(vroot) as total_vroot,SUM(diff) as total_diff', FALSE);
		 $this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('pid	',$pid);
		 $this->db->order_by('date'); 
		 $query = $this->db->get('daily_entry')->row_array();
		 $q= $this->db->last_query($query);
		 //print_r($q); die();
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
	
	public function getallCreditCustomers() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 
		 $this->db->where('c_id',$cid1);
		 
		 $this->db->order_by('date_created','DESC');
		 $query = $this->db->get('credit_customer')->result();
	     $q=$this->db->last_query($query );
		// print_r($q); die('err');
	   return $query;
	  
	}
	
	
	public function getallReceivedAmount() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $date = date('Y-m-d');
		 $this->db->where('c_id',$cid1);
		 $this->db->where('date',$date);
		 
		 $this->db->order_by('date_created','DESC');
		 $query = $this->db->get('amount_received')->result();
	     $q=$this->db->last_query($query );
		// print_r($q); die('err');
	   return $query;
	  
	}
	
	
}
 

?>
<?php
class Store_sales_model extends CI_Model{
	protected $_table_name = 'store_sales';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'pid', 'p_price',	'quantity',	'total_price', 'c_id', 'user_id','shift','daily_id', 'date_created', 'date_modified', 'date');
	
	public $id;
	public $pid; 
	public $p_price; 
	public $quantity; 
	public $total_price; 
	public $c_id; 
	public $user_id;
    public $shift; 
    public $daily_id;
    public $date_created;
    public $date_modified;
    public $date; 	
	
		
	
	//public $delete_status; //1 if delte

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function savePage($id=NULL,$table='store_sales')
	{
		
		
		$data 	= $this->array_from_post(self::$db_fields);	
		
		
		
		
		if($id)
		{
			
				
			$data['date_modified']  = date("Y-m-d H:i:s", time());
		    $quantity = $this->input->post("quantity");
			$p_price = $this->input->post("p_price");
			$pid = $this->input->post("pid");
		
			$data['total_price'] = (($quantity)*($p_price));
            $data['pid'] = $pid;
			$this->db->where('id', $id);
			$last_id = $this->db->update($table ,$data);
			
			
			
			
			
			if($last_id !== 0){
				return true;
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');
			}else{
				return false;
			}
			

		} 
		else {
		     
			$shiftdata = $this->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
			$daily_no = $shiftdata['daily_no'];
			$cid = $this->daily_shift_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			 
			$date =	date('Y-m-d');
            $data['date_created']  = date("Y-m-d H:i:s", time());
			
			$pid = $this->input->post("pid");
			
			
            $quantity = $this->input->post("quantity");
            $type = $this->input->post("type");
			$i = 0;
        foreach($pid as $row){
		$price = $this->daily_shift_model->getProductPrice($row);
        $data['p_price'] = $price;		
        $data['quantity'] = $quantity[$i];
		$data['total_price'] = ($data['p_price'] * $data['quantity']);
        $data['pid'] = $pid[$i];
		$data['date_created']  = date("Y-m-d H:i:s", time());
		$data['date_modified']  ="0000-00-00 00:00:00";
        $data['daily_no'] = $daily_no;
		$data['date'] = $date;
		$data['shift'] = $shift_id;
		$data['user_id'] = $user_id;
		$data['c_id'] = $cid1;
        $this->db->insert($table,$data);
        $i++;
    }
		
			if($last_id !== 0){
				return true;
			}else{
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

	public function deletePage($id)
	{
		$result = $this->delete($id);
		return $result;

	}

	
	
	public function deleteStoreSales($id)
	{
		$result = $this->db->delete('store_sales', array('id' => $id)); 
		return $result;

	}
	
	
	
	
	
	
    public function getProductName($pid) 
	    {
	         
			
			$this->db->select('p_name');
            $this->db->from('product');
           
			$this->db->where("id",$pid);
            $query = $this->db->get();
            $page1 = $query->result();
            return $page1[0]->p_name;

         }
		 
	public function getUserShiftData() 
	    {
	        $company_id = $this->getCompanyId();
			$cid =  $company_id['0']->c_id;
			
            $this->db->where("c_id",$cid);
			$this->db->where("status",'open');
			$this->db->order_by("login_time",'DESC');
            $query = $this->db->get('daily_shift');
            $page1 = $query->row_array();
            return $page1;

         }
		 
		 public function getCompanyId() 
	{
		
		 $Company_id = unserialize($this->session->userdata('admin'));
		    $cid1 = $Company_id['id'];
			
             $this->db->select('c_id');
             $this->db->from('admins');
             $this->db->where("id",$cid1);
		     $page = $this->db->get();
		
		      return $page->result();
			  $query1 = $this->db->last_query();
			  
	}
	
	
	
	public function getStoreProductId() 
	{
	         $company_id = $this->getCompanyId();
			
			$cid =  $company_id['0']->c_id;
			$this->db->select('id');
            $this->db->from('product');
          
			$this->db->where("c_id", $cid);
			$this->db->where("p_cat", 'company');
		    $query = $this->db->get();
			$query1 = $this->db->last_query($query);
		
             $page1 = $query->result();
			 return $page1;

     }
	 
	 
	 public function getAllStoreProductRow() 
	{
	         $shiftdata = $this->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
			$daily_no = $shiftdata['daily_no'];
			$cid = $this->daily_shift_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			
			$this->db->select('*');
            $this->db->from('store_sales');
          
			$this->db->where("c_id", $cid1);
			$this->db->where("user_id", $user_id);
			$this->db->where("shift", $shift_id);
			$this->db->where("daily_no", $daily_no);
		    $query = $this->db->get();
			$query1 = $this->db->last_query($query);
		
             $page1 = $query->result();
			 
             return $page1;

     }
	 
	 
	 public function getTotalStoreSales() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 $daily_no = $shiftdata['daily_no'];
		 
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(total_price) as total_store_sales', FALSE);
		 $this->db->where('shift',$shift_id);
		 $this->db->where('daily_no',$daily_no);
		 
		 $this->db->where("user_id", $user_id);
		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('date_created','DESC');
		 $query = $this->db->get('store_sales')->row_object();
	   
	  
	   return $query;
	   
	}

}

  
 

?>
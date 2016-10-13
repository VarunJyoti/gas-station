<?php
class Dropspayouts_model extends CI_Model{
	protected $_table_name = 'drops_payout';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'amount',	'name',	'created_date',	'modified_date', 'shift', 'type','user_id','c_id','daily_no');
	
	public $id;
	public $amount; 
	public $name; 
	public $created_date; 
	public $modified_date; 
	public $shift; 
	public $type;
    public $user_id; 
    public $c_id;
    public $daily_no;  	
	
		
	
	//public $delete_status; //1 if delte

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function savePage($id=NULL,$table='drops_payout')
	{
		
		
		$data 	= $this->array_from_post(self::$db_fields);	
		
		
		
		
		if($id)
		{
			
			$data['modified_date'] 	=	time();	
			$data['modified_date']  = date("Y-m-d H:i:s", time());
		
			

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
			 
			$data['created_date']		=	time();
            $data['created_date']  = date("Y-m-d H:i:s", time());
			//$data['shift']  = 1;
			$name = $this->input->post("name");
            $amount = $this->input->post("amount");
            $type = $this->input->post("type");
			$i = 0;
    foreach($name as $row){
        $data['amount'] = $amount[$i];
        $data['name'] = $name[$i];
		$data['created_date']  = date("Y-m-d H:i:s", time());
		$data['modified_date']  ="0000-00-00 00:00:00";
        $data['type'] = $type[$i];
		$data['shift'] = $shift_id;
		$data['user_id'] = $user_id;
		$data['c_id'] = $cid1;
		$data['daily_no'] = $daily_no;
        $this->db->insert($table,$data);
        $i++;
    }
		//print_r($type);
	
		
			//die('error');
			
		   	
		
			//$last_id = $this->db->insert($table ,$data);
			//$sql= $this->db->last_query();
		    //$insert_id = $this->db->insert_id();


 
	 

			if($last_id !== 0){
				return true;
			}else{
				return false;
			}
							
			
		}
				
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
	
	
	
	
	public function getdropspayouts() 
	{

        $this->db->select('*');
        $this->db->from('drops_payout');
        $this->db->where("shift = '1'");
		$this->db->order_by("id",'ASC');
		$page = $this->db->get();
		$page1 = $page->result();
		//$query1 = $this->db->last_query();
		
		return $page1;
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

}
 

?>
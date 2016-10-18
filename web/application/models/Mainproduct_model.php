<?php
class Mainproduct_model extends CI_Model{
	protected $_table_name = 'price';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'pid', 'price', 's_price', 'old_price', 'c_id', 'date_created', 'date_modified');
	
	public $id;
	public $pid; 
	public $price; 
	public $s_price; 
	public $old_price; 
	public $c_id; 
	public $date_created; 
	public $date_modified; 
	 
	
		
	
	//public $delete_status; //1 if delte

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function savePage($id=NULL,$table='price')
	{
		
		
		$data 	= $this->array_from_post(self::$db_fields);	
		
		
		if($id)
		{
			
			$user_type = loginUser();
            
			$table = 'price';
		    
			$price = $this->input->post("price");
			$old_price = $this->input->post("old_price");
			
			$c_id  = $this->company_model->getCompanyLoginId();
			 
			
			// price change code starts
			
			$PriceBeforeChange=$this->getProductPriceByIDandCID($id,$c_id)->s_price;
			
			if($price != $PriceBeforeChange)
			{
			$old_price = $PriceBeforeChange;	
			}
			
			if(($user_type = 'enduser') && ($price != $PriceBeforeChange))
	     {
			 $result = $this->CheckPidExist($c_id,$id);
			 if(empty($result))
			 {
		    $EndRowId = $this->getEnduserData($c_id)->id;
			$EndRowPid = $this->getEnduserData($c_id)->pid;
			$total_no_of_pid = substr_count($EndRowPid, ',')+1; 
			$company_pid = count(unserialize($this->CountNoOfPId($c_id)->p_id));
			
			if($total_no_of_pid < $company_pid)
			{
				 
			
			$pid1= $EndRowPid;
			$pid2= $id;
			if($pid1 =='') 
			{
			$pid= $pid2;
			}
			else{
				$pid= $pid1.",".$pid2;
				
			}
			
			$data1 = array('price_change_status' =>'0', 'pid'=>$pid);
			$this->db->where('id', $EndRowId);
            $this->db->update('daily_shift', $data1);
			
			$this->db->delete('price', array('pid' => $id,'c_id'=>$c_id));
			$s_price = $this->input->post("price");
		
		    $modified_date  = date("Y-m-d H:i:s", time());
		
			$modified_date= date("Y-m-d H:i:s", time());
			
			$data = array('pid'=> $id,'c_id'=> $c_id,'price'=> $price, 's_price'=> $s_price, 'old_price'=> $old_price,  'date_modified'=> $modified_date);
			
			$insert=$this->db->insert($table ,$data);
			
			 }
			 
			 else{
				
			$data1 = array('price_change_status' =>'1', 'pid'=>$EndRowPid);
			$this->db->where('id', $EndRowId);
            $this->db->update('daily_shift', $data1); 
			 }
			 
			    }
		 else{
			 
			$EndRowId = $this->getEnduserData($c_id)->id;
			$EndRowPid = $this->getEnduserData($c_id)->pid;
			$data2 = array('price_change_status' =>'1', 'pid'=>$EndRowPid);
			$this->db->where('id', $EndRowId);
            $this->db->update('daily_shift', $data2);
			 
		    redirect("admin/enduser/pricechange"); 
				 
		}
			
	 }
			 // price change code ends
			 
			 else if($user_type = 'admin')
				 
				 {
			 
			$this->db->delete('price', array('pid' => $id,'c_id'=>$c_id));
			$s_price = $this->input->post("price");
		
		    $modified_date  = date("Y-m-d H:i:s", time());
		
			$modified_date= date("Y-m-d H:i:s", time());
			
			$data = array('pid'=> $id,'c_id'=> $c_id,'price'=> $price, 's_price'=> $s_price, 'old_price'=> $old_price,  'date_modified'=> $modified_date);
			
			$insert=$this->db->insert($table ,$data);
			
          
				 }
			
			if($insert !== 0){
				return true;
				
			}else{
				return false;
			}

		} 
		
				
	}
	
	
	public function price_insert($data) {
		
$data1 = array(
           'price' => $data,
        );
 // Query to insert data in database
  $this->db->where('id', '1');
  $this->db->update('price', $data1);
  if ($this->db->affected_rows() > 0) {
     return true;
    }
   else {
   return false;
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
		$c_id = $this->company_model->getCompanyLoginId();
		$this->db->join('price', 'product.id = price.pid');
		$this->db->where("product.id = '{$id}'");		
		$this->db->where("price.c_id = '{$c_id}'");		
		$page = $this->db->get('product');
		$page1 = $page->row_object();
		//$page1 =  $this->db->last_query();
		//print_r($page1);die;
		return $page1;
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
		$this->db->delete('product', array('id' => $id));
		$this->db->delete('price', array('pid' => $id));

		return $result;
		
		//$this->db->where('p_id', $id);
        //$result1=$this->db->delete('price');


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

$this->db->where("cd_price.c_id = '{$cid1}'");
$query = $this->db->get();
//$query1 = $this->db->last_query();
$page = $query->result();

return $page;
//$query = $this->db->get();


	}
	
	
	public function getProductPriceByIDandCID($id,$cid) 
	{	
		$this->db->where("pid",$id);
		$c_id = $this->company_model->getCompanyLoginId();
		$this->db->where("c_id",$cid);
		$page = $this->db->get('price')->row_object();
		$q = $this->db->last_query($page);
		

		return $page;
	}
	
	public function getEnduserData($cid) 
	{	
	    $userid = unserialize($this->session->userdata('admin'));
		$user_id = $userid['id'];
		//print_r($user_id); die('errr');
		$this->db->where("user_id",$user_id);
		$this->db->where("c_id",$cid);
		$this->db->where("status",'open');
		
		$this->db->order_by("daily_no", 'DESC');
		$page = $this->db->get('daily_shift')->row_object();
		$q = $this->db->last_query($page);
		

		return $page;
	}
	
	public function CheckPidExist($cid,$pid) 
	{	
	    $userid = unserialize($this->session->userdata('admin'));
		$user_id = $userid['id'];
		//print_r($user_id); die('errr');
		$this->db->where("user_id",$user_id);
		$this->db->where("c_id",$cid);
		$this->db->where("status",'open');
		$this->db->like("pid", $pid);
		
		$this->db->order_by("daily_no", 'DESC');
		$page = $this->db->get('daily_shift')->row_object();
		$q = $this->db->last_query($page);
		//print_r($q); die('errrrrr');

		return $page;
	}
	
	
	public function CountNoOfPId($cid) 
	{	
	    $userid = unserialize($this->session->userdata('admin'));
		$user_id = $userid['id'];
	
		$this->db->where("id",$cid);
		
		$query = $this->db->get('company')->row_object();;
		
		$q = $this->db->last_query($query);
		

		return $query;
	}
	
	
	
}


?>
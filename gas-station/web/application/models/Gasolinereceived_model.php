<?php
class Gasolinereceived_model extends CI_Model{
	protected $_table_name = 'gasoline_received';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'pid', 'received', 'received_price', 'date_created', 'date_modified', 'shift', 'c_id', 'daily_no', 'user_id', 'date', 'bol_no', 'p_image');
	
	public $id;
	public $pid; 
	public $received;
    public $received_price;	
	public $date_created; 
	public $date_modified; 
	public $shift;
    public $c_id;
    public $daily_no;
    public $user_id;
    public $date;
    public $bol_no; 	
    public $p_image; 	
	
	
		
	
	//public $delete_status; //1 if delte

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function savePage($id=NULL,$table='gasoline_received')
	{
		
		
		$data 	= $this->array_from_post(self::$db_fields);	
		
		
		
		// image upload codes starts here
		
		
		//$data['p_desc'] 	=	$this->input->post("_p_desc");
        
		//upload image ends
		
		$config = array(
            'upload_path'   => FCPATH.'uploads/product',
            'allowed_types' => 'gif|jpg|png',
            'quality'      => '10%',
            'max_size'      => '10000',
            'max_width'     => '10240',
            'max_height'    => '7680',
            'encrypt_name'  => true,
        );
	
		//print_r($config);die('--test');
				
        $this->load->library('upload', $config);
		if($_FILES['p_image']['name']){
			$upload = $this->upload->do_upload("p_image");
			
			if($upload === FALSE) {
				$error = array('error' => $this->upload->display_errors());
				return $error['error'];	
			}else {
				$upload_data = $this->upload->data();
				$data_ary = array(
					'title'     => $upload_data['client_name'],
					'file'      => $upload_data['file_name'],
					'width'     => $upload_data['image_width'],
					'height'    => $upload_data['image_height'],
					'type'      => $upload_data['image_type'],
					'size'      => $upload_data['file_size'],
					'date'      => time(),
				);
				if($this->input->post('h_image')){
					$old_path	=	$config['upload_path'].'/'.$this->input->post('h_image');
					unlink($old_path);
				}
				$data['p_image']	=	$upload_data['file_name'];
				 $configer = array(
                            'image_library' => 'gd2',
                            'source_image' => $upload_data['full_path'],
                            'create_thumb' => FALSE,//tell the CI do not create thumbnail on image
                            'maintain_ratio' => TRUE,
                            'quality' => '40%', //tell CI to reduce the image quality and affect the image size
                            'width' => 200,//new size of image
                            'height' => 200,//new size of image
                        );
                    $this->image_lib->clear();
                    $this->image_lib->initialize($configer);
                    $this->image_lib->resize();
			}
        }
		
		
		// image upload codes ends here

		
		
		
		
		if($id)
		{
			
			$data['date_modified'] 	=	time();	
			$data['date_modified']  = date("Y-m-d H:i:s", time());
		
			

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
		
			$pid = $this->input->post("pid");
			
			$amount = $this->input->post("received");
			$received_price = $this->input->post("received_price");
			$date = $this->input->post("date");
			$bol_no = $this->input->post("bol_no");
			$p_image = $this->input->post("p_image");
			$snap = $this->input->post("snap");
			$shiftdata = $this->dropspayouts_model->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
			$daily_no = $shiftdata['daily_no'];
			$cid = $this->gasolinereceived_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			
		   	$i = 0;
        foreach($amount as $row){
        
		$data['pid'] = $pid[$i];
        $data['received'] = $amount[$i];
        $data['received_price'] = $received_price[$i];
        $data['date_created']  = date("Y-m-d H:i:s", time());
		$data['date_modified']  ="0000-00-00 00:00:00";
        $data['shift'] = $shift_id;
		$data['c_id'] = $cid1;
		$data['daily_no'] = $daily_no;
		$data['user_id'] = $user_id;
		$data['date'] = $date[$i];
		$data['bol_no'] = $bol_no[$i];
		$data['p_image'] = $snap[$i];
        $this->db->insert($table,$data);
        $i++;
    }    
	    $this ->db ->where('user_id', $user_id);
		$this ->db->delete('webcam');
			

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

	public function getCompanyId() 
	{
		
		 $Company_id = unserialize($this->session->userdata('admin'));
		    $cid1 = $Company_id['id'];
			
             $this->db->select('c_id');
             $this->db->from('admins');
             $this->db->where("id = $cid1");
		     $page = $this->db->get();
		
		      return $page->result();
			  $query1 = $this->db->last_query();
			  
	}
	
	
	
	
	public function getgasolinereceived() 
	{

        $this->db->select('*');
        $this->db->from('gasoline_received');
        $this->db->where("shift = '1'");
		$this->db->order_by("id",'ASC');
		$page = $this->db->get();
		$page1 = $page->result();
		//$query1 = $this->db->last_query();
		
		return $page1;
	}
	
	public function getSumGasolineSuper($pid) 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(received) AS received_amount', FALSE);
		 $this->db->where('shift','1');
		 $this->db->where("date_created > DATE_SUB(CURDATE(), INTERVAL 0 DAY)");
		 $this->db->where("pid", $pid);
		 $this->db->where('c_id	',$cid1);
		 $query = $this->db->get('gasoline_received')->result();
	   
	  
	   return $query;
	   
	}
	
	public function getSumGasolineRegular() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(received) AS received_amount', FALSE);
		 $this->db->where('shift	','1');
		 $this->db->where("date_created > DATE_SUB(CURDATE(), INTERVAL 0 DAY)");
		 $this->db->where('pid	','regular');
		 $this->db->where('c_id	',$cid1);
		 $query = $this->db->get('gasoline_received')->result();
	   
	  
	   return $query;
	   
	}
	
	public function getSumGasolineDiesel() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(received) AS received_amount', FALSE);
		 $this->db->where('shift	','1');
		 $this->db->where("date_created > DATE_SUB(CURDATE(), INTERVAL 0 DAY)");
		 $this->db->where('pid	','diesel');
		 $this->db->where('c_id	',$cid1);
		 $query = $this->db->get('gasoline_received')->result();
	   
	  
	   return $query;
	   
	}
	
	public function getSumGasolinePropane() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(received) AS received_amount', FALSE);
		 $this->db->where('shift	','1');
		 $this->db->where("date_created > DATE_SUB(CURDATE(), INTERVAL 0 DAY)");
		 $this->db->where('pid	','propane');
		 $this->db->where('c_id	',$cid1);
		 $query = $this->db->get('gasoline_received')->result();
	   
	  
	   return $query;
	   
	}
	
	public function getProductId() 
	{
	         $company_id = $this->getCompanyId();
			
			 $cid =  $company_id['0']->c_id;
			
		   
			
			
			$this->db->select('p_id');
            $this->db->from('company');
          
			$this->db->where("id = '{$cid}'");
		
			
            $query = $this->db->get();
			$query1 = $this->db->last_query($query1);
		
             $page1 = $query->result();
			 
		     $page = unserialize($page1[0]->p_id); 
			 //print_r($page); die('error');
            return $page;

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
		 
		  public function getLastShiftEntry($pid) 
	    {
	         $cid = $this->gasolinereceived_model->getCompanyId();
		     $cid1 = $cid['0']->c_id;
			 $this->db->select('*');
             $this->db->from('daily_entry');
             $this->db->where("c_id", $cid1);
		     $this->db->order_by("id",'DESC');
			 $this->db->limit(1);
		     $page = $this->db->get();
		     $page1 = $page->result();

         }



}
 

?>
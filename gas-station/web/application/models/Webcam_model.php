<?php
class Webcam_model extends CI_Model{
	protected $_table_name = 'webcam';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'user_id', 'cam_img');
	
	public $id;

	public $user_id; 
	public $cam_img; 
	
   	
	
	
		
	
	//public $delete_status; //1 if delte

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function snapp_img($table='webcam')
	{
		
		
		$data 	= $this->array_from_post(self::$db_fields);	
		$shiftdata = $this->daily_shift_model->getUserShiftData();
	    $user_id = $shiftdata['user_id'];
	    $cam_img = $this->input->post('snapp');
		
		$this->db->insert($table,$data);
		
		
   
		    
			if($last_id !== 0){
				return true;
				 
			}else{
				return false;
			}
			
	}
				
	
	
	
	
	
		
		 
     public function check_ShiftUser()  
	    {
	         $user_id = unserialize($this->session->userdata('admin'));
		     $user_id = $user_id['id'];
             $company_id = $this->getCompanyId();
			 $cid =  $company_id['0']->c_id;
			
            $this->db->where("id",$user_id);
			$this->db->where("c_id",$cid);
			
            $query = $this->db->get('admins');
            $page1 = $query->row_array();
            return $page1;

         }
		 
		 
		
		 
		public function getsnapimage() 
	    {
	    
		$snapimg = $this->input->post('snapp');
       	
	
            echo $snapimg;

         }
		 
		 
	
		


}
 

?>
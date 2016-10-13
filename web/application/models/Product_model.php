<?php

class Product_model extends CI_Model{
	protected $_table_name = 'product';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'p_name',	'p_cat', 'p_image', 'p_desc', 'p_price', 'date_created', 'date_modified', 'status', 'c_id');
	
	public $id;
	public $p_name; 
	public $p_cat; 
	public $p_image; 
	public $p_desc; 
	public $p_price; 
	public $date_created; 
	public $date_modified; 
    public $status;
	public $c_id; 
	
		
	
	//public $delete_status; //1 if delte

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function savePage($id=NULL,$table='product')
	{
		
		$user_type = loginUser();
		$data 	= $this->array_from_post(self::$db_fields);	
		$data['p_desc'] 	=	$this->input->post("_p_desc");
        
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
		
		if($id)
		{
			
			if($user_type =='admin')
			{
				$row_id =	$this->input->post("id");
				//die($row_id);
				
			$data['date_modified'] 	=	time();	
			$data['date_modified']  = date("Y-m-d H:i:s", time());
		
			$data['status'] =	$this->input->post("status");
            $cid = $this->getCompanyId();
		    $cid1 = $cid['0']->c_id;
            $data['c_id']		= $cid1;			
            $im = $this->input->post("p_image");
			$m=$this->db->where('id', $id);
			
			$last_id = $this->db->update($table ,$data);
			
			
			$table1='price';
			$price =	$this->input->post("p_price");
			$s_price =	$this->input->post("p_price");
			
			$pid =	$this->input->post("pid");
			$modified_date = date("Y-m-d H:i:s", time());
			$data1 = array('pid'=> $pid,	'price'=> $price, 's_price'=> $s_price,	'c_id'=> $cid1, 'date_modified'=> $modified_date);
			$this->db->where('pid', $pid);
			
			$last_id = $this->db->update($table1 ,$data1);	
			
			}
			
			else
			{
			$data['date_modified'] 	=	time();	
			$data['date_modified']  = date("Y-m-d H:i:s", time());
		
			$data['status'] =	$this->input->post("status");
            $comp_id = $Company_id['id'];
            $data['c_id']		= $comp_id;			
            $im = $this->input->post("p_image");
			
			//if($status != 1)
		   // $data['status'] = 0;

			$m=$this->db->where('id', $id);
			
			$last_id = $this->db->update($table ,$data);
			}
						
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
			if($user_type == 'admin')
			{
				//die('err');
			$status =	$this->input->post("status");
		
			$data['date_created']		=	time();
            $data['date_created']  = date("Y-m-d H:i:s", time());	
            $cid = $this->getCompanyId();
		    $cid1 = $cid['0']->c_id;
            $data['c_id']		= $cid1;			
			//$this->save($data, $id);
			$last_id = $this->db->insert($table ,$data);
			$sql= $this->db->last_query();
		    $insert_id = $this->db->insert_id();
			$table1='price';
			$price =	$this->input->post("p_price");
			$s_price =	$this->input->post("p_price");
			
			$created_date= date("Y-m-d H:i:s", time());
			
			$data1 = array('id'=> NULL,	'pid'=> $insert_id,	'price'=> $price, 's_price'=> $s_price,	'c_id'=> $cid1 ,	'date_created'=> $created_date, 'date_modified'=> "");
			
			$this->db->insert($table1, $data1);
			$insert_id = $this->db->insert_id();
			}
			else
			{
				
			$status =	$this->input->post("status");
		
			$data['date_created']		=	time();
            $data['date_created']  = date("Y-m-d H:i:s", time());	
            $Company_id = unserialize($this->session->userdata('admin'));
			$comp_id = $Company_id['id'];
            $data['c_id']		= $comp_id;			
			//$this->save($data, $id);
			$last_id = $this->db->insert($table ,$data);
			$sql= $this->db->last_query();
		    $insert_id = $this->db->insert_id();
			
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
		$this->db->join('product', 'price.pid = product.id');
		$this->db->where("product.id = '{$id}'");
        $query = $this->db->get('price');
        $result = $query->row_object();
		//print_r($this->db->last_query());die;
		return $result;
	}
	
	public function getallPage() 
	{
		$this->db->where("status = '1'");
		$this->db->order_by("position",'ASC');
		$page = $this->get2();
		return $page;
	}
	
		public function getStoreProductPage($id) 
	{	
		$this->db->join('product', 'price.pid = product.id');
		$this->db->where("product.id = '{$id}'");
        $query = $this->db->get('price');
        $result = $query->row_object();
		//print_r($this->db->last_query($result));die;
		return $result;
	}

	public function getProductName($id) 
	{
		$this->db->where("id",$id);
		$page = $this->db->get('product')->row_object();
		return $page->p_name;
	}

	public function getProductPriceByID($id) 
	{	
		$this->db->where("pid",$id);
		$c_id = $this->company_model->getCompanyLoginId();
		$this->db->where("c_id",$c_id);
		$page = $this->db->get('price')->row_object();
		return $page;
	}

	 public function deletePage($id)
	{
		$result = $this->delete($id);
		$this->db->delete('product', array('id' => $id));
		$this->db->delete('price', array('pid' => $id));

		return $result;
		
	
	

	}
	public function getproducts($q,$limit,$start,$whr,$order=null,$select_val=null){
		  $usr_type = loginUser();
		  $user_id = unserialize($this->session->userdata('admin'))['id'];
		  $cid = $this->getCompanyId();
		  $cid1 = $cid['0']->c_id;
		 if($select_val==2){
			 $select_val='0';
		 }
		 if($select_val ||  $select_val=='0'){
			 
		 $this->db->where('status',$select_val);
		 }
		

		if( $usr_type =='admin')
		{ 
			$this->db->where('p_cat','company');
			$this->db->where('c_id',$cid1);
		}
		else{
			$this->db->where('p_cat','main');
		}
		if($q){
			$this->db->like('p_name',$q);
			
		}
		if($order){
			$this->db->order_by($order);
		}
		$this->db->limit($limit,$start);
		
		$query =  $this->db->get($this->_table_name);
		$res=$query ->result();
		//print_r($this->db->last_query());die;
		 return $res;
	
   
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
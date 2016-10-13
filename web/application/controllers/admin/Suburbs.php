<?php
class Suburbs extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();	
		$this->load->model('City_model');
		$this->load->model('suburbs_model');
	
	}
	/*
	** Location List
	*/
	function index()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Location List";
		$totalcat = $this->suburbs_model->get();		
		$this->config->load('pagination2', TRUE);
		$config = $this->config->item('pagination2');		
		$config['base_url'] 	=	site_url('admin/suburbs/');
		$config['total_rows'] 	=	count($totalcat);
		$config['per_page'] 	= 10;
		$config['uri_segment']  = 4;		
		
		//pagination
		
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		
		$page =($this->uri->segment(4)?$this->uri->segment(4):0);	

		
		//$this->db->where("status = 1");
		$suburbs = $this->suburbs_model->get3($config['per_page'],$page);
		
		$data['totalrow'] =	count($totalcat);
		$data['per_page'] = $config['per_page'];

		$data['suburbs_data'] 	=	$suburbs;
		$data['page'] 			=	$page;
		
		$this->layout('suburbs/list',$data); 
			
		

	}
	/*
	** Add Location
	*/
	function add()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add New Location";
		$data['name'] = "";
		$data['description'] ="";	
		$data['error']		=	"";
		$this->layout('suburbs/add',$data); 
	}

	/*
	** Save Location
	*/
	public function save() 
	{
		if($this->input->post('save_suburbs') || $this->input->post('edit_suburbs'))
		{	
			$this->form_validation->set_error_delimiters('<p class="error help-block"><span class="label label-important">','</span></p>');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('city_id', 'City', 'required');
			$id =  $this->input->post('id');
			
			
			if ($this->form_validation->run() == FALSE) {
				if($this->input->post('save_suburbs'))
					$this->add();
				else
					redirect("admin/suburbs/edit/{$id}");
			} else {
				$id =  $this->input->post('id');
				
				$name = trim($this->input->post('name'));
				// if the name exists return a 1 indicating true
				$rst = $this->suburbs_model->suburbsname_exists($name,$id);
				
				if($rst) {
					$this->session->set_flashdata('error', 'Location Name is already taken. Please enter another.');				
					
					if($this->input->post('save_suburbs'))
						$this->add();
					else
						redirect("admin/suburbs/edit/{$id}");
					
					
				}else{
								
					if($id) {
						$suburbs =  $this->suburbs_model->save($id);					
						$this->session->set_flashdata('success', 'Location update SuccessFully');
						if($suburbs)
							redirect("admin/suburbs/");
						else
							redirect("admin/suburbs/edit/{$id}");
					} else {
						$suburbs =  $this->suburbs_model->save($id);
						$this->session->set_flashdata('success', 'Location Add SuccessFully');				
						if($suburbs)
							redirect("admin/suburbs/");
						else
							redirect("admin/suburbs/add/");
					}
					
				}	
			}
		} else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/suburbs");
		}
	}

	/*
	** Edit Location
	*/
	function edit()
	{
		$id = $this->uri->segment(4, 0);
		
		if($id){
			$suburbs = $this->suburbs_model->get2($id);			
			if($suburbs){
				$SITE_TITLE = SITE_TITLE;
				$data['title'] = "$SITE_TITLE Admin || Edit Location";
				$data['suburbs'] = $suburbs;
				$this->layout('suburbs/edit',$data); 
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/suburbs");
			}
		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/suburbs");

		}	

	
	}

	/*
	** Delete Location
	*/
	function delete() {
		$id = $this->uri->segment(4, 0);
		
		if($id){
			$suburbs = $this->suburbs_model->get2($id);				
			if($suburbs){
				$this->suburbs_model->del($suburbs->id);
				$this->session->set_flashdata('success', 'Location Delete SuccessFully');
				redirect("admin/suburbs");
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/suburbs");
			}
					

		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/suburbs");

		}	

	}
	
	
	
	/*
	** Check duplicate Location name
	*/
	public function checkdublicate()
	{
		$name = trim($this->input->post('name'));
		// if the name exists return a 1 indicating true
		$rst = $this->suburbs_model->suburbsname_exists($name);
		if ($rst) {
			echo '1';
			exit;
		}
	}
	
	/*
	** get Location name by city id 
	*/
	public function getSuburbByCityId()
	{
		
		$cityId = $this->input->post('id');
		if($cityId != ''){
			$suburbslist = $this->suburbs_model->getSuburbByCityId($cityId);
			$output = null;  	
			if(is_array($suburbslist) && !empty($suburbslist)){
				foreach ($suburbslist as $row) 
				{
					//here we build a dropdown item line for each query result  
					$output .= "<option value='".$row->id."'>".$row->name."</option>";  
				}
	 
				echo $output; 
			}	
			else{
				echo $output = "<option value=''>No city found</option>";  
			}
		}else{
			echo $output = "<option value=''>No city found</option>";  
		}
	}

}
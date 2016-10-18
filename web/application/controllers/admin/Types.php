<?php
class Types extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();	
		$this->load->model('types_model');
		
	}
	/*
	** Subadmin type list
	*/
	function index()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Type List";
		$totalcat = $this->types_model->get();		
		$this->config->load('pagination2', TRUE);
		$config = $this->config->item('pagination2');		
		$config['base_url'] 	=	site_url('admin/types/bannerlist');
		$config['total_rows'] 	=	count($totalcat);
		$config['per_page'] 	= 10;
		$config['uri_segment']  = 4;		
		
		//pagination
		
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		
		$page =($this->uri->segment(4)?$this->uri->segment(4):0);	

		
		//$this->db->where("status = 1");
		$types = $this->types_model->get3($config['per_page'],$page);
		
		$data['totalrow'] =	count($totalcat);
		$data['per_page'] = $config['per_page'];

		$data['types_data'] 	=	$types;
		$data['page'] 			=	$page;
		$this->layout('types/list',$data);
		
	}
	/*
	** add type for subadmin
	*/
	function add()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add New Types";
		$this->layout('types/add',$data);
		
	}

	/*
	** Types save
	*/
	public function save() 
	{
		if($this->input->post('save_banner') || $this->input->post('edit_banner'))
		{	
			$image =  $this->input->post('image');	
			$this->form_validation->set_error_delimiters('<p class="error help-block"><span class="label label-important">','</span></p>');
			$this->form_validation->set_rules('name', 'Type Name', 'required');
			$id =  $this->input->post('id');
			
			
			if ($this->form_validation->run() == FALSE) {
				if($this->input->post('save_banner'))
					$this->add();
				else
					redirect("admin/types/edit/{$id}");
			} else {
				$id =  $this->input->post('id');
				
				$name = trim($this->input->post('name'));
				// if the name exists return a 1 indicating true
				$rst = $this->types_model->name_exists($name,$id);
				if($rst) {
					$this->session->set_flashdata('error', 'Types Name is already taken. Please enter another.');				
					
					if($this->input->post('save_banner'))
						$this->add();
					else
						redirect("admin/types/edit/{$id}");
					
					
				}else{
								
					if($id) {
						$type =  $this->types_model->save($id);					
						$this->session->set_flashdata('success', 'Types update SuccessFully');
					} else {
						$type =  $this->types_model->save($id);
						$this->session->set_flashdata('success', 'Types Add SuccessFully');				
					}
					redirect("admin/types");
				}	
			}
		} else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/types");
		}
	}

	/*
	** Edit Type page
	*/
	function edit()
	{
		$id = $this->uri->segment(4, 0);
		
		if($id){
			$types = $this->types_model->get2($id);			
			if($types){
				$SITE_TITLE = SITE_TITLE;
				$data['title'] = "$SITE_TITLE Admin || Edit Types";
				$data['types'] = $types;
				$this->layout('types/edit',$data);
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/types");
			}
		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/types");

		}	

	
	}

	/*
	** Delete types
	*/
	function delete() {
		$id = $this->uri->segment(4, 0);
		
		if($id){
			$types = $this->types_model->get2($id);				
			if($types){
				$this->types_model->deleteTypes($types->id);
				$this->session->set_flashdata('success', 'Types Delete SuccessFully');
				redirect("admin/types");
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/types");
			}
					

		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/types");

		}	

	}
	
	
	/*
	** Check duplicate city name
	*/
	public function checkdublicate()
	{
		$name = trim($this->input->post('name'));
		// if the name exists return a 1 indicating true
		$rst = $this->types_model->name_exists($name);
		if ($rst) {
			echo '1';
			exit;
		}
	}


}
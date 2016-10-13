<?php
class City extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();	
		$this->load->model('city_model');
		$this->load->model('State_model');
		
		
	}
	/*
	** List city 
	*/
	function index()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || City List";
		
		$totalcat = $this->city_model->get();		
		$this->config->load('pagination2', TRUE);
		$config = $this->config->item('pagination2');		
		$config['base_url'] 	=	site_url('admin/city/bannerlist');
		$config['total_rows'] 	=	count($totalcat);
		$config['per_page'] 	= 10;
		$config['uri_segment']  = 4;		
		
		//pagination
		
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		
		$page =($this->uri->segment(4)?$this->uri->segment(4):0);	

		
		//$this->db->where("status = 1");
		$city = $this->city_model->get3($config['per_page'],$page);
		
		$data['totalrow'] =	count($totalcat);
		$data['per_page'] = $config['per_page'];

		$data['city_data'] 	=	$city;
		$data['page'] 			=	$page;
		
		$this->layout('city/list',$data); 
			
		

	}
	/*
	** Add city
	*/
	function add()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add New City";
		$data['name'] = "";
		$data['description'] ="";	
		$data['error']		=	"";
		$this->layout('city/add',$data); 
	}
	/*
	** Save City 
	*/

	public function save() 
	{
		if($this->input->post('save_banner') || $this->input->post('edit_banner'))
		{	
			$image =  $this->input->post('image');	
			$this->form_validation->set_error_delimiters('<p class="error help-block"><span class="label label-important">','</span></p>');
			$this->form_validation->set_rules('name', 'City Name', 'required');
			$this->form_validation->set_rules('city_code', 'City Code', 'required');
			$this->form_validation->set_rules('state_id', 'State', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			//$this->form_validation->set_rules($image, 'Image', "file_required|file_min_size[10KB]|file_max_size[500KB]|file_allowed_type[image]|file_image_mindim[50,50]|file_image_maxdim[400,300]");
			$id =  $this->input->post('id');
			
			 
			if ($this->form_validation->run() == FALSE) {
				if($this->input->post('save_banner'))
					$this->add();
				else
					redirect("admin/city/edit/{$id}");
			} else {
				$id =  $this->input->post('id');
				
				$name = trim($this->input->post('name'));
				// if the name exists return a 1 indicating true
				$rst = $this->city_model->cityname_exists($name,$id);
				if($rst) {
					if($this->input->post('save_banner'))
						$this->add();
					else
						redirect("admin/city/edit/{$id}");
					
					$this->session->set_flashdata('error', 'City Name is already taken. Please enter another.');				
					
				}else{
								
					if($id) {
						$city =  $this->city_model->save($id);					
						$this->session->set_flashdata('success', 'City update SuccessFully');
					} else {
						$city =  $this->city_model->save($id);
						$this->session->set_flashdata('success', 'City Add SuccessFully');				
					}
					redirect("admin/city/view/{$city->id}");
				}	
			}
		} else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/city");
		}
	}
	/*
	** Edit city 
	*/

	function edit()
	{
		$data['admin'] = $this->admin;
		$id = $this->uri->segment(4, 0);
		
		if($id){
			$city = $this->city_model->get2($id);			
			if($city){
				$SITE_TITLE = SITE_TITLE;
				$data['title'] = "$SITE_TITLE Admin || Edit City";
				$data['city'] = $city;
				$data['error'] = "";
				$data['name'] = "";
				$data['description'] ="";
				$data['error'] = "";
				$this->layout('city/edit',$data); 
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/city");
			}
		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/city");

		}	

	
	}
	/*
	** View City 
	*/

	function view() 
	{
		$SITE_TITLE = SITE_TITLE;
		$id = $this->uri->segment(4, 0);
		if($id){
			$city = $this->city_model->get2($id);		
			
			if($city){
				$data['title'] = "$SITE_TITLE Admin || View city";
				$data['city'] = $city;				
				$this->layout('city/view',$data); 
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/city");			}
		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/city");
		}	

	}

	

	/*
	** Delete City
	*/
	

	function delete() {
		$id = $this->uri->segment(4, 0);
		
		if($id){
			//$this->db->where("slug = '{$id}'");
			$city = $this->city_model->get2($id);				
			if($city){
				$this->city_model->del($city->id);
				$this->session->set_flashdata('success', 'City Delete SuccessFully');
				redirect("admin/city");
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/city");
			}
					

		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/city");

		}	

	}
	
	/*
	** Delete city Image
	*/
	function deleteCityImages() {
		$id = $this->uri->segment(4, 0);
		$img_name = $this->uri->segment(5, 0);
		
		if($id){
			$city = $this->city_model->get2($id);				
			if($city){
				$this->city_model->deleteFolderAndEmpty($city->id);
				$this->session->set_flashdata('success', 'City Delete SuccessFully');
				redirect("admin/city/edit/$id");
				
			} else {
				$this->session->set_flashdata('error', 'You can not direct access this area');
				redirect("admin/city/edit/$id");
			}
					

		}else {
			$this->session->set_flashdata('error', 'You can not direct access this area');
			redirect("admin/city");

		}	

	}
	
	/*
	** Check duplicate city name
	*/
	public function checkdublicate()
	{
		$name = trim($this->input->post('name'));
		// if the name exists return a 1 indicating true
		$rst = $this->city_model->cityname_exists($name);
		if ($rst) {
			echo '1';
			exit;
		}
	}


}
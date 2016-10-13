<?php
class Main_Controller extends CI_Controller
{
	
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	
	/*
	** Layout method
	*/
	public function layout($view='home',$data){
		 // loading session class
		
		$login = $this->loginCheck();
		if($login){
			if(!empty($login['hotel_user_id'])){
				$data['login_user'] = $login['hotel_user_id'];
				$data['email'] = $login['email'];
				$arr_url = explode('/',uri_string());
				if(in_array('registration',$arr_url)){
					redirect('hotel_rooms');
				}
			}
		
		}
		$register_id = $this->session->userdata('register_id');
		$register_id = unserialize($register_id);
		$data['user_id'] = $register_id['id'];
		if(!empty($register_id['id'])){
			$data['login_user'] = $register_id['id'];
			$data['email'] = $register_id['email'];
		}
		$this->load->model('setting_model');
		$this->load->model('city_model');
		
		// Get All city
		
		//$cityForHeaderFooter = $this->city_model->cityFrontend();
		
		//$data['cityForHeaderFooter'] = $cityForHeaderFooter;
		$city=$this->city_model->getCity('0','10','1','1','0','1');
		$data['footer_city'] = $city;
		$headercity=$this->city_model->getCity('0','0','1','1','1','0');
		$data['header_city'] = $headercity;
		
		
		$contact = $this->settings_model->get2();
		$data['contact'] = $contact[0];
		$this->load->view('templates/header',$data);
		if($view == 'home')
			$this->load->view('templates/slider_home',$data);
		
		if($view == 'search/details')
			$this->load->view('templates/hotel-details-slider',$data);
		$this->load->view($view,$data);
		$this->load->view('templates/footer');
	}
	/*
	** Check login or not 
	*/
	public function loginCheck(){
		$sess = $this->session->userdata('hotel_login_session');
		$ar = unserialize($sess);
		//print_r($ar);die('test');
		if(!empty($ar)){
			return $ar;
		}
	}
	
	################ pagination function #########################################
	function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
	{
		$pagination = '';
		if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
			$pagination .= '<nav class="pagination-nav"><ul class="pagination list-inline">';
			
			$right_links    = $current_page + 3; 
			$previous       = $current_page - 3; //previous link 
			$next           = $current_page + 1; //next link
			$first_link     = true; //boolean var to decide our first link
			
			if($current_page > 1){
				$previous_link = ($previous==0)?1:$previous;
				$pagination .= '<li class="first"><a href="#" data-page="1" title="First"><span>&laquo;</span></a></li>'; //first link
				$pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous"><span>Prev</span></a></li>'; //previous link
					for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
						if($i > 0){
							$pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'"><span>'.$i.'</span></a></li>';
						}
					}   
				$first_link = false; //set first link to false
			}
			
			if($first_link){ //if current active page is first link
				$pagination .= '<li class="first active"><span>'.$current_page.'</span></li>';
			}elseif($current_page == $total_pages){ //if it's the last active link
				$pagination .= '<li class="last active"><span>'.$current_page.'</span></li>';
			}else{ //regular current link
				$pagination .= '<li class="active"><span>'.$current_page.'</span></li>';
			}
					
			for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
				if($i<=$total_pages){
					$pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'"><span>'.$i.'</span></a></li>';
				}
			}
			if($current_page < $total_pages){ 
					$next_link = ($i > $total_pages)? $total_pages : $i;
					$pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next"><span aria-hidden="true">Next</span></a></li>'; //next link
					$pagination .= '<li class="last"><a href="#" data-page="'.$total_pages.'" title="Last"><span>&raquo;</span></a></li>'; //last link
			}
			
			$pagination .= '</ul></nav>'; 
		}
		return $pagination; //return pagination links
	}
}
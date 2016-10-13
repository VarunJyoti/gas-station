<?php
class Home extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();	
		$this->load->helper('url');
		
	}
	/*
	** Admin Dashboard
	*/
	function index(){ 	
		$this->layout('home',$data);
	}

	
}
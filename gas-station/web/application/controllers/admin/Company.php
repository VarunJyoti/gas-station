<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();			
		
		$this->load->model('company_model','',TRUE);
		$this->load->model('systemtool_m');	
		$this->load->model('mainproduct_model');
        $this->load->model('gasolinereceived_model');
        $this->load->model('daily_shift_model');		
		$this->load->library("ckeditor");
		$this->load->helper('login');
		$this->load->helper('email');
		$this->load->helper('url');
		$this->load->library('user_agent');
	}
	/*
	** List Company
	*/
	public function index()
	{
		 
		$user_type = loginUser();
		if ($user_type == 'super')
       {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Company Managment";//die('5');
		$start          =   $this->input->get("per_page");	 //start
		$total                  =   10; //items on a page
		$q = '';
		// search
 		if($this->input->get('q')){
			$q = trim($this->input->get("q"));
			$data['q'] = $q;
           
		}
		$select_val				=	$this->input->get("select_val");
		$order_by				=	'date_created desc';
		
		
		if(($select_val) || ($q)){ 
				
            $company			  	= 	$this->company_model->get3($q,$total,$start,'',$order_by,$select_val);
			$total_company     	=   $this->company_model->get3($q,'','','','',$select_val);


		}
		
		else{
			
			$total_company         	=   $this->company_model->get3('',0,0,0,'');
			$company              	=   $this->company_model->get3('',$total,$start,0,$order_by);  
		
		} 
		$data['company']			=	$company;
		$data['total_company']	=   count($total_company);
		$data['start']       	=   $start;

		//pagination

		$this->load->library('pagination');
		$this->config->load('pagination2', TRUE);
		$config 				= 	$this->config->item('pagination2'); 
		$config['uri_segment']  =   4;  //uri segment
		$config['page_query_string']    =   TRUE;
	    $config['base_url'] 	= 	site_url("admin/company/index?q={$q}&select_val={$select_val}");
		$config['total_rows']   =   count($total_company);
        $config['per_page']     =   $total;
		$this->pagination->initialize($config); 
		$this->pagination->create_links();
		$this->layout('company/list',$data);
	}
	
	elseif($user_type == 'admin')
        { 
	
       $SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page1 	=	$this->company_model->getCompanyId();
		
		$p=$page1['0']->c_id;
		$page 	=	$this->company_model->getPage($p);
		if($page) {
			
			$data['page']	=	$page;
			$this->layout('company/edit',$data);
				
		} else {
			redirect("admin/company");
		}
		
            }
		
		else
		{
			
			
		}
		
}
		
	/*
	** Add Company
	*/
	public function add()
	{
		$usr_type = loginUser();

		if($usr_type =='super')
		{
			
		$username =  $this->input->post('username');
        $SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		$data['error'] = "";
	
		 $data['products'] = $this->company_model->getallProduct(); 
		 $this->layout('company/add',$data);
		}
		else{
	redirect("admin/login/logout");
	}
		
	}

	/*
	** Save Page
	*/
	public function save()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		if($this->input->post('save_page'))
		{
			$id 	=	$this->input->post("id")?$this->input->post("id"):NULL;
			
			if($id)
			{
				$page 	=	$this->company_model->savePage($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/company/{$page->id}");

			} else {
				$page 	=	$this->company_model->savePage(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Company Add SuccesFully</span></div> ');			
				redirect("admin/company/{$page->id}");
			}			
			
		} else {
			redirect("admin/company/");
		}
	}
	/*
	** Save Price
	*/
	public function saveprice()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		if($this->input->post('save_page'))
		{
			$id 	=	$this->input->post("p_id")?$this->input->post("p_id"):NULL;
			
			if($id)
			{
				
				$page 	=	$this->mainproduct_model->savePage($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/company/mainproduct");

			} 		
			
		} else {
			redirect("admin/company/mainproduct");
		}
	}
	/*
	
	** Save Price
	*/
	public function savecreditcustomer()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		if($this->input->post('save_page'))
		{
			$id 	=	$this->input->post("id")?$this->input->post("id"):NULL;
			
			if($id)
			{
				$page 	=	$this->company_model->SaveCreditCustomer($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/company/add_credit_customer");

			} else {
				$page 	=	$this->company_model->SaveCreditCustomer(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Customer Add SuccesFully</span></div> ');			
				redirect("admin/company/add_credit_customer");
			    }	
			
		} else {
			$this->session->set_flashdata('success', '<div class="alert alert-error "><span>Not Performed any task!</span></div> ');			
			redirect("admin/company/add_credit_customer");
		}
	}
	/*
	
	** Save Received Amount
	*/
	public function SaveAmountReceived()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		if($this->input->post('save_page'))
		{
			$id 	=	$this->input->post("id")?$this->input->post("id"):NULL;
			
			if($id)
			{
				$page 	=	$this->company_model->SaveAmountReceived($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/company/paymentreceived");

			} else {
				$page 	=	$this->company_model->SaveAmountReceived(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Customer Add SuccesFully</span></div> ');			
				redirect("admin/company/paymentreceived");
			    }	
			
		} else {
			$this->session->set_flashdata('success', '<div class="alert alert-error "><span>Not Performed any task!</span></div> ');			
			redirect("admin/company/paymentreceived");
		}
	}
	/*
	
	
	
	** View Page
	*/
	public function view($slug) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		$page 	=	$this->pages_model->getPage($slug);
		
		if($page) {
			$data['page']	=	$page;
			$this->layout('company/view',$data);
			
		} else {
			redirect("admin/company");
		}
		
	}
	
	
	
	/*
	
	** Gasoline View Page start ---------------------------------------------------------
	*/
	public function records() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		
		  $data['shiftNo'] 	=	$this->company_model->getShiftNo();
		  $data['Daily_no'] 	=	$this->company_model->getDaily_no();
			if($this->input->get('find')){
			$shift = $this->input->get("shift");
			
			$date = $this->input->get("date");
			print_r($shift); 
			print_r($date);
			$data['Gasoline_Record'] 	=	$this->company_model->getGasolineRecordByShift($date,$shift);
			
			$data['pid1'] 	=	$this->daily_shift_model->getProductId();
           
		}

			$this->layout('company/records',$data);
			
		}
		
	
    public function sales_reports() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		
		  $data['dates'] 	=	$this->company_model->getDate();
		  $data['pname'] 	=	$this->company_model->getPName();
		  $data['pid1'] 	=	$this->daily_shift_model->getProductId();
		// $data['Gasoline_Record'] 	=	$this->company_model->getDailyEntryBtwn2Dates($from_date,$to_date);
			
			if($this->input->get('find')){
			$from_date = $this->input->get("from_date");
			$frm_date = strtotime(date("Y-m-d", strtotime($from_date)) . " -1 day");
			$date1 = date("Y-m-d",$frm_date);

			$to_date = $this->input->get("to_date");
			$too_date = strtotime(date("Y-m-d", strtotime($to_date)) . " +1 day");
			$date2 = date("Y-m-d",$too_date);
			
			$pro_id = $this->input->get("pid");
			if($pro_id == 'all')
			{
			$pid2=	$this->daily_shift_model->getProductId();	
			}
			else
			{
			$pid2 = $pro_id;
           // print_r($pid2); die('hh');			
			}
			//$data['Gasoline_Record'] 	=	$this->company_model->getDailyEntryBtwn2Dates($from_date,$to_date);
			//$data['Gasoline_Data'] 	=	$this->company_model->getDataBtwn2Dates($from_date,$to_date);
			
			
			
			
			$dateRange = $this->createDateRangeArray($from_date,$to_date);
			foreach ($dateRange as $date)
             {
				 if($pro_id == 'all')
				 {
			       foreach ($pid2 as $pid)
                   { 
			 // print_r($pid2); die('hh');
			       $name     =   $this->gasolinereceived_model->getProductName($pid);
			       $dateWiseRow[$name] 	=	$this->company_model->getSumOfSaleDateWise($date,$pid);	 	 
			 
			       }
				 }
                 else
				 {
			      $name     =   $this->gasolinereceived_model->getProductName($pro_id);
			      $dateWiseRow[$name] 	=	$this->company_model->getSumOfSaleDateWise($date,$pro_id); 
				 }					 
			 $rowData[]=array('date'=>$date,'sale'=>$dateWiseRow);
			 }
			
			$data['dateWiseRow'] = $rowData;
			
			
		if($pro_id == 'all')
		{
			 foreach ($pid2 as $pid)
             {
				 
				$sale	=	$this->company_model->getSumDataBtwn2Dates($from_date,$date2,$pid);
 			    $name     =   $this->gasolinereceived_model->getProductName($pid);
				$out[]=array('pname'=>$name,'sale'=>$sale);
			}
	    }
	  else
	    {
		        $sale = $this->company_model->getSumDataBtwn2Dates($from_date,$date2,$pro_id);
 			    $name = $this->gasolinereceived_model->getProductName($pro_id);
				$out[]= array('pname'=>$name,'sale'=>$sale);  
	    }
			//print_r($out);die;
			$data['sale'] = $out;
			
           
		}

			$this->layout('company/sales_reports',$data);
			
		}
	
	
	 public function purchased_reports() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		
		  $data['dates'] 	=	$this->company_model->getDate();
		  $data['pname'] 	=	$this->company_model->getPName();
		  $data['pid1'] 	=	$this->daily_shift_model->getProductId();
		
			
			if($this->input->get('find')){
			$from_date = $this->input->get("from_date");
			$frm_date = strtotime(date("Y-m-d", strtotime($from_date)) . " -1 day");
			$date1 = date("Y-m-d",$frm_date);

			$to_date = $this->input->get("to_date");
			$too_date = strtotime(date("Y-m-d", strtotime($to_date)) . " +1 day");
			$date2 = date("Y-m-d",$too_date);
			
			$pro_id = $this->input->get("pid");
			
			if($pro_id == 'all')
			  {
			  $pid2=	$this->daily_shift_model->getProductId();	
			  }
			else
			   {
			
			   $pid2= $pro_id;
			   }
			
			$dateRange = $this->createDateRangeArray($from_date,$to_date);
			foreach ($dateRange as $date)
             {
				 if($pro_id == 'all')
			  {
			    foreach ($pid2 as $pid)
                { 
			     $name     =   $this->gasolinereceived_model->getProductName($pid);
			     $dateWiseRow[$name] 	=	$this->company_model->getSumOfTotalDateWise($date,$pid);	 	 
			 
			     }	
			  }
               else
			   {
				$name     =   $this->gasolinereceived_model->getProductName($pro_id);
			    $dateWiseRow[$name] 	=	$this->company_model->getSumOfTotalDateWise($date,$pro_id);   
				   
			   }				   
			 $rowData[]=array('date'=>$date,'sale'=>$dateWiseRow);
			 }
			//print_r($rowData); die;
			//$data['dates'] = $dateRange;
			$data['dateWiseRow'] = $rowData;
			
			
			if($pro_id == 'all')
			  {
			    foreach ($pid2 as $pid)
               {
				 
				 $sale	= $this->company_model->getSumOfTotalBtwn2Dates($from_date,$date2,$pid);
 			     $name  = $this->gasolinereceived_model->getProductName($pid);
				 $out[] = array('pname'=>$name,'sale'=>$sale);
			    }
			  }
			  
		      else
			  {
			     $sale	= $this->company_model->getSumOfTotalBtwn2Dates($from_date,$date2,$pro_id);
 			     $name  = $this->gasolinereceived_model->getProductName($pro_id);
				 $out[] = array('pname'=>$name,'sale'=>$sale);	  
			  }
			
			$data['sale'] = $out;
			
           
		}

			$this->layout('company/purchased_reports',$data);
			
		}
		
		
		
		
		public function inventory_reports() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		/*
		  $data['dates'] 	=	$this->company_model->getDate();
		  $data['pname'] 	=	$this->company_model->getPName();
		*/
			
			if($this->input->get('find')){
			$month = $this->input->get("month");
			$frm_date = strtotime(date("Y-m-d", strtotime($month)) . " -1 day");
			$date1 = date("Y-m-d",$frm_date);

			$year = $this->input->get("year");
			$total_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			$from_date = $year."-".$month."-01";
			
			$to_date = $year."-".$month."-".$total_day;
			$too_date = strtotime(date("Y-m-d", strtotime($to_date)) . " +1 day");
			$date2 = date("Y-m-d",$too_date);
			
			$pid = $this->input->get("pid");
			
			$dateRange = $this->createDateRangeArray($from_date,$to_date);
			$sale	=	$this->company_model->getSumDataBtwn2Dates($from_date,$date2,$pid);
			$diff	=	$this->company_model->getSumOfDiffBtwn2Dates($from_date,$date2,$pid);
			foreach ($dateRange as $date)
           {
			
			 //$name     =   $this->gasolinereceived_model->getProductName($pid);
			 $dateWiseRow 	=	$this->company_model->getSumOfAllDateWise($date,$pid);	 	 
			 
			 $rowData[]=array('date'=>$date,'inventory'=>$dateWiseRow);
			 }
			//print_r($date2); die();
			}
			$data['dateWiseRow'] = $rowData;
			$data['sale']=$sale;
			$data['diff']=$diff;
			//print_r($rowData); die('err');
			/*
			//$data['Gasoline_Record'] 	=	$this->company_model->getDailyEntryBtwn2Dates($from_date,$to_date);
			//$data['Gasoline_Data'] 	=	$this->company_model->getDataBtwn2Dates($from_date,$to_date);
			
			$data['pid1'] 	=	$this->daily_shift_model->getProductId();
			$pid2=	$this->daily_shift_model->getProductId();
			
			$dateRange = $this->createDateRangeArray($from_date,$to_date);
			foreach ($dateRange as $date)
             {
			foreach ($pid2 as $pid)
             { 
			$name     =   $this->gasolinereceived_model->getProductName($pid);
			$dateWiseRow[$name] 	=	$this->company_model->getSumOfTotalDateWise($date,$pid);	 	 
			 
			}	 
			 $rowData[]=array('date'=>$date,'sale'=>$dateWiseRow);
			 }
			//print_r($rowData); die;
			//$data['dates'] = $dateRange;
			$data['dateWiseRow'] = $rowData;
			
			
			
			 foreach ($pid2 as $pid)
             {
				 
				$sale	=	$this->company_model->getSumOfTotalBtwn2Dates($from_date,$date2,$pid);
 			
				$name     =   $this->gasolinereceived_model->getProductName($pid);
				//$old_sale[] 	=	$this->company_model->getSumOldSaleBtwn2Dates($from_date,$to_date,$pid); 
				 $out[]=array('pname'=>$name,'sale'=>$sale);
			}
			//print_r($out);die;
			$data['sale'] = $out;
			//$data['name'] = $name;
			//print_r($data['sale']); die('piid');
           */
		
		
            $data['pid1'] 	=	$this->daily_shift_model->getProductId();
			$this->layout('company/inventory_reports',$data);
			
		}
		
		
		
		public function creditcard_reports() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		/*
		  $data['dates'] 	=	$this->company_model->getDate();
		  $data['pname'] 	=	$this->company_model->getPName();
		*/
			
			if($this->input->get('find')){
			$month = $this->input->get("month");
			$frm_date = strtotime(date("Y-m-d", strtotime($month)) . " -1 day");
			$date1 = date("Y-m-d",$frm_date);

			$year = $this->input->get("year");
			$total_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			$from_date = $year."-".$month."-01";
			
			$to_date = $year."-".$month."-".$total_day;
			$too_date = strtotime(date("Y-m-d", strtotime($to_date)) . " +1 day");
			$date2 = date("Y-m-d",$too_date);
			
			$pid2 = $this->input->get("cc_type");
           
			
			$dateRange = $this->createDateRangeArray($from_date,$to_date);
			//print_r($dateRange); die('rt');
			if($pid2 == 'all')
			   {
				foreach ($dateRange as $date)
           {
			
			 //$name     =   $this->gasolinereceived_model->getProductName($pid);
			 $dateWiseRow 	=	$this->company_model->getCCardDateWiseRecords($date);
			 //$dateWiseRowss 	=	$this->company_model->getCCardTypeWiseRecords($date);
			 $dateWiseRows 	=	$this->company_model->getCCardDateWiseRecords($date);
		
        			 
			
			 $rowData[]=array('date'=>$date,'row1'=>$dateWiseRow);
			 }
			   }
			   else
			   {
				$pid = $pid2; 
              
                	foreach ($dateRange as $date)
                  {
			
			 //$name     =   $this->gasolinereceived_model->getProductName($pid);
			        //$dateWiseRow 	=	$this->company_model->getCCardDateWiseRecords($date);
			        $dateWiseRow 	=	$this->company_model->getCCardTypeWiseRecords($date,$pid);
			        $dateWiseRows 	=	$this->company_model->getCCardTypeWiseRecords($date);
		
        			 
			
			       $rowData[]=array('date'=>$date,'row1'=>$dateWiseRow);
			 }			  
				   
			   }
				
			//$diff	=	$this->company_model->getSumOfDiffBtwn2Dates($from_date,$date2,$pid);
			
			//print_r($rowData); die('err');
			//print_r($dateWiseRows); die('err');
			}
			
			$data['dateWiseRow'] = $rowData;
			
			
		
		
            $data['dateWiseRows'] 	=	$dateWiseRows;
			$this->layout('company/creditcard_reports',$data);
			
		}
		
		
		
	/*Credit Account Reports starts */
	
		public function creditaccount_reports() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		
			if($this->input->get('find'))
			{
			$month = $this->input->get("month");
			$frm_date = strtotime(date("Y-m-d", strtotime($month)) . " -1 day");
			$date1 = date("Y-m-d",$frm_date);

			$year = $this->input->get("year");
			$total_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			$from_date = $year."-".$month."-01";
			
			$to_date = $year."-".$month."-".$total_day;
			$too_date = strtotime(date("Y-m-d", strtotime($to_date)) . " +1 day");
			$date2 = date("Y-m-d",$too_date);
			
			$pid2 = $this->input->get("customer_name");
            $credit_customers	 =	$this->company_model->getallCreditCustomers();
			$total_credits =	$this->company_model->getCAccountRecordsByDate();
			$dateRange = $this->createDateRangeArray($from_date,$to_date);
			//print_r($to_date); die('rt');
			if($pid2 == 'all')
			   {
				foreach ($dateRange as $date)
           {  
		   
		      foreach ($credit_customers as $pid)
                { 
			     $name[]     =  $pid->name;
			     $dateWiseCredit[]=	$this->company_model->getCAccountRecordsByDate($date,$name);
				 $dateWiseTotalReceivedAmount[]	=	$this->company_model->getCReceivedAmountByDate($date,$name);	 	 
				 $TotalCreditUptoDate[]	=	$this->company_model->getTotalCAmountUpToDate($from_date,$date,$name);			 
			     }	
			
			
		
        	$rowcredit[] = array('credit'=>$dateWiseCredit);		 
        	$rowreceived[] = array('received'=>$dateWiseTotalReceivedAmount);		 
        	$rowTotalCredit[] = array('total_credit'=>$TotalCreditUptoDate);
			
        	$rows[$name] = array('credit'=>$rowcredit, 'received'=>$rowreceived, 'total_credit'=>$rowTotalCredit);		 
			
			$rowData[]=array('date'=>$date,'name'=>$rows);
			 }
			   }
			   else
			   {
				$name = $pid2; 
              
                	foreach ($dateRange as $date)
                  {
			
			         $dateWiseCredit=	$this->company_model->getCAccountRecordsByDate($date,$name);
					  $dateWiseTotalReceivedAmount	=	$this->company_model->getCReceivedAmountByDate($date,$name);	 	 
					  $TotalCreditUptoDate	=	$this->company_model->getTotalCAmountUpToDate($from_date,$date,$name);	 	 
					  $mode	=	$this->company_model->getCReceivedModeByDate($date,$name);	 	 
			        
			
			       $rowData[]=array('date'=>$date,'credit'=>$dateWiseCredit, 'total_credit'=>$TotalCreditUptoDate, 'ReceivedAmount'=>$dateWiseTotalReceivedAmount, 'mode'=>$mode);
			 }			  
				   
			   }
			
			}
			
			$data['dateWiseRow'] = $rowData;
		   // $data['dateWiseRows'] 	=	$dateWiseRows;
			
			$data['credit_customers']	 =	$this->company_model->getallCreditCustomers();
			
			$this->layout('company/creditaccount_reports',$data);
			
		}
		
/*Credit Account Reports ends */	


/*Profit Loss Reports starts */
	
		public function profit_loss_reports() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		
			if($this->input->get('find'))
			{ //echo $this->input->get('report_type'); die('kk');
				if($this->input->get('report_type') == 'daily')
				{
					$from_date = $this->input->get('daily_date');
					$to_date = $this->input->get('daily_date');
					//$to_date = strtotime(date("Y-m-d", strtotime($to_date)) . " +1 day");
					//$to_date = date("Y-m-d",$to_date);
				}
				
				
			  elseif($this->input->get('report_type') == 'monthly')
				{
					$month = $this->input->get("month");
			        $frm_date = strtotime(date("Y-m-d", strtotime($month)) . " -1 day");
			        $date1 = date("Y-m-d",$frm_date);

			        $year = $this->input->get("year");
			        $total_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			        $from_date = $year."-".$month."-01";
			
			        $to_date = $year."-".$month."-".$total_day;
			        $too_date = strtotime(date("Y-m-d", strtotime($to_date)) . " +1 day");
			        $date2 = date("Y-m-d",$too_date);
				}
				
				
				elseif($this->input->get('report_type') == 'fromDate_toDate')
				{
					$from_date = $this->input->get('from_date');
					$to_date = $this->input->get('to_date');
				}
				
				elseif($this->input->get('report_type') == 'mid_monthly')
				{
					$month = $this->input->get("month");
			        $frm_date = strtotime(date("Y-m-d", strtotime($month)) . " -1 day");
			        $date1 = date("Y-m-d",$frm_date);

			        $year = $this->input->get("year");
			        $total_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			        $from_date = $year."-".$month."-01";
			
			        $to_date = $year."-".$month."-15";
			        $too_date = strtotime(date("Y-m-d", strtotime($to_date)) . " +1 day");
			        $date2 = date("Y-m-d",$too_date);
				}
				
				elseif($this->input->get('report_type') == 'yearly')
				{
					///$month = $this->input->get("month");
			        //$frm_date = strtotime(date("Y-m-d", strtotime($month)) . " -1 day");
			        //$date1 = date("Y-m-d",$frm_date);

			        $year = $this->input->get("year");
			        //$total_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			        $from_date = $year."-01-01";
					$frm_date = strtotime(date("Y-m-d", strtotime($from_date)) . " -1 day");
			        $date1 = date("Y-m-d",$frm_date);
			
			        $to_date = $year."-12-31";
			        $too_date = strtotime(date("Y-m-d", strtotime($to_date)) . " +1 day");
			        $date2 = date("Y-m-d",$too_date);
				}
				
			
			$pidd =	$this->daily_shift_model->getProductId();
			$pid2 = $this->input->get("pid");
            $credit_customers	 =	$this->company_model->getallCreditCustomers();
			$total_credits =	$this->company_model->getCAccountRecordsByDate();
			
			$dateRange = $this->createDateRangeArray($from_date,$to_date);
			//print_r($dateRange); die('rt');
			if($pid2 == 'all')
			   {
				foreach ($dateRange as $date)
           {  
		   
		    $dates = strtotime(date("Y-m-d", strtotime($date)) . " +1 day");
			$datess = date("Y-m-d",$dates);
		         $open = 0 ;
			     $purchased = 0;
			     $sale = 0;
			     $old_sale = 0;
				 $UptoDateSale = 0;
			     $closing = 0;
				 $total_sale=0;
				 
				    
				   $open1=0;
				   $purchased1=0;
				   $sale1=0;
				   $old_sale1=0;
				   $closing1=0;
				   $total_sale1=0;
				   
				   
				 
				 
				 foreach ($pidd as $pid)
                  {
				 $price = $this->GetPprice($pid,$date);
				 $old_price = $this->GetOldPprice($pid,$date);
				 $purchase_price = $this->GetPurchasePrice($pid,$date);
				
			     $datewisedata=$this->company_model->getPLRecords($date,$pid);
			     $datewisedataUptodate=$this->company_model->getPLRecordsUpToDate($from_date,$datess,$pid);
					   
			     $open += (($datewisedata['open'])*$purchase_price);
			     $purchased += (($datewisedata['purchased'])*$purchase_price);
			     $sale += (($datewisedata['sale'])*$price);
			     $old_sale += (($datewisedata['old_sale'])*$old_price);
			     $UptoDateSale += (($datewisedataUptodate['sale'])*$price);
			     $closing += (($datewisedata['balance'])*$purchase_price); 
                 $total_sale = $sale+$old_sale;	
				 
                  //##################
				  
				   
				   
                  $dateRange2 = $this->createDateRangeArray($from_date,$date);
				  foreach ($dateRange2 as $datesss)
                { 
				 $price1 = $this->GetPprice($pid,$datesss);
				 $old_price1 = $this->GetOldPprice($pid,$datesss);
				
			     $datewisedata1=$this->company_model->getPLRecordss($datesss,$pid);
				 
				 $open1 += (($datewisedata1['open'])*$price1);
			     $purchased1 += (($datewisedata1['purchased'])*$price1);
			     $sale1 += (($datewisedata1['sale'])*$price1);
			     $old_sale1 += (($datewisedata1['old_sale'])*$old_price1);
			     //$UptoDateSale1 += (($datewisedataUptodate['sale'])*$price);
			     $closing1 += (($datewisedata1['balance'])*$price1); 
                 $total_s = $sale1+$old_sale1;
		        }
					
				 //###################
					  
				  }
				  
				  //###########daily store sale ##############
				  $store_salesss = $this->company_model->getPLStoreSalesRecordss($date);
				  $store_sal = 0;
				  foreach($store_salesss as $storesale)
				  {
					$store_sal += $storesale->store_sales;  
				  }
				  
				  
		          $totalExp = $this->company_model->getTotalExpensesByDate($date);
				  
				  //###########Upto datestore sale ##############
				   $dateRange3 = $this->createDateRangeArray($from_date,$date);
				   $store_sale = 0;
				   foreach ($dateRange3 as $datessss)
				   {
				  
		          $store_saless = $this->company_model->getPLStoreSalesRecordss($datessss);
				  
				  foreach($store_saless as $store)
				  {
					$store_sale += $store->store_sales;  
				  }
				  //$store_sale += $store_sale;
				 
				   }
			$total_sales = ($total_s+$store_sale); 
			$total_sale = $total_sale+$store_sal;
			//$rowData[]=array('date'=>$date,'open'=>$open,'purchased'=>$purchased,'sale'=>$sale, 'closing'=>$closing);
			$rowData[]=array('date'=>$date,'open'=>$open,'purchased'=>$purchased,'sale'=>$total_sale,'uptodatesale'=>$total_s,'new_sale'=>$sale,'old_sale'=>$old_sale,'store_sale'=>$store_sale, 'closing'=>$closing, 'UpToDateSale'=>$total_sales, 'TotaExpenses'=>$totalExp, 'price'=>$price, 'old_price'=>$store_sal);
			 }
			
			   }
			   else
			   {
				$pid = $pid2; 
              
                	foreach ($dateRange as $date)
                  {
				$dates = strtotime(date("Y-m-d", strtotime($date)) . " +1 day");
			    $datess = date("Y-m-d",$dates);	  
					  
			     $price = $this->GetPprice($pid,$date);
				 $old_price = $this->GetOldPprice($pid,$date);
				 $purchase_price = $this->GetPurchasePrice($pid,$date);
				 
				 $datewisedataUptodate=$this->company_model->getPLRecordsUpToDate($from_date,$datess,$pid);
			     $datewisedata=$this->company_model->getPLRecords($date,$pid);
					   
			     $open = (($datewisedata['open'])*$purchase_price);
			     $purchased = (($datewisedata['purchased'])*$purchase_price);
			     $new_sale = (($datewisedata['sale'])*$price);
			     $old_sale = (($datewisedata['old_sale'])*$old_price);
				 $UptoDateSale = (($datewisedataUptodate['sale'])*$price);
			     $closing = (($datewisedata['balance'])*$purchase_price);
				 $totalExp = $this->company_model->getTotalExpensesByDate($date);
				 $sale= ($new_sale+old_sale);
				 
				 
				  $dateRange2 = $this->createDateRangeArray($from_date,$date);
				  foreach ($dateRange2 as $datesss)
                { 
				 $price1 = $this->GetPprice($pid,$datesss);
				 $old_price1 = $this->GetOldPprice($pid,$datesss);
				
			     $datewisedata1=$this->company_model->getPLRecordss($datesss,$pid);
				 
				 $open1 += (($datewisedata1['open'])*$price1);
			     $purchased1 += (($datewisedata1['purchased'])*$price1);
			     $sale1 += (($datewisedata1['sale'])*$price1);
			     $old_sale1 += (($datewisedata1['old_sale'])*$old_price1);
			     //$UptoDateSale1 += (($datewisedataUptodate['sale'])*$price);
			     $closing1 += (($datewisedata1['balance'])*$price1); 
                 $total_s = $sale1+$old_sale1;
		        }
				 
				$store_saless = $this->company_model->getPLStoreSalesRecordss($date);
				  $store_sal = 0;
				  foreach($store_saless as $store)
				  {
					$store_sal += $store->store_sales;  
				  }
				  
				  
				  //###########Upto datestore sale ##############
				   $dateRange3 = $this->createDateRangeArray($from_date,$date);
				   $store_sale = 0;
				   foreach ($dateRange3 as $datessss)
				   {
				  
		          $store_saless = $this->company_model->getPLStoreSalesRecordss($datessss);
				  
				  foreach($store_saless as $store)
				  {
					$store_sale += $store->store_sales;  
				  }
				  //$store_sale += $store_sale;
				 
				   }
			   $total_sales = ($total_s+$store_sale); 
			   $sale = $sale+$store_sal;
			
				  //$total_sales = $total_sales+$store_sale; 
				  //$sale = $sale+$store_sale; 
				 
				 
			
			
			$rowData[]=array('date'=>$date,'open'=>$open,'purchased'=>$purchased,'sale'=>$sale, 'closing'=>$closing, 'UpToDateSale'=>$total_sales, 'TotaExpenses'=>$totalExp, 'price'=>$price);
			 }			  
				   
			   }
			
			}
			//print_r($price); die('err');
			$data['dateWiseRow'] = $rowData;
			//print_r($dateRange2);  print_r($dateRange); die('err');
			//print_r($data['dateWiseRow']); die('err');
		   // $data['dateWiseRows'] 	=	$dateWiseRows;
			
			
			$data['pid1'] 	=	$this->daily_shift_model->getProductId();
			$this->layout('company/profit_loss_reports',$data);
			
		}
		
/* Profit Loss Reports ends */


/*
########################### Expenses Reports Starts here ################################################
*/
public function expense_reports() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Expenses Reports";
		
			if($this->input->get('find')){
			$exp_date = $this->input->get("exp_date");
			$exp_cat = $this->input->get("cat");
			$datas 	=  $this->getExpensesRowsByCat_Date($exp_date,$exp_cat);
			$total_exp 	=  $this->getSumOfExpensesByCat_Date($exp_date,$exp_cat);
			$data['records'] 	= $datas;
			$data['total_exp'] 	= $total_exp;
           
		    }
            $data['exp_cat'] 	=	$this->company_model->getallMainExpCat();
           
			$this->layout('company/expense_reports',$data);
			
		}
		
		
		
		/*
	  ** Get Expancess Rows Date & Cat Wise
	*/
	public function getExpensesRowsByCat_Date($date,$cat)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
        //$this->db->select('SUM(exp_amount) as total_exp', FALSE);
		$this->db->like('date', $date);
		$this->db->where('c_id	',$cid1);
		$this->db->where('exp_cat',$cat);
		 
		$query = $this->db->get('expenses')->result();
		$q= $this->db->last_query($query);
		 //print_r($q); die();
	     return $query;
	   
	}
	
	
	  /*
	 ** Get SUM Of Expancess Date & Cat Wise
	*/
	public function getSumOfExpensesByCat_Date($date,$cat)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
        $this->db->select('SUM(exp_amount) as total_exp', FALSE);
		$this->db->like('date', $date);
		$this->db->where('c_id	',$cid1);
		$this->db->where('exp_cat',$cat);
		 
		$query = $this->db->get('expenses')->row_array();
		$q= $this->db->last_query($query);
		 //print_r($q); die();
	     return $query['total_exp'];
	   
	}

/*
########################### Expenses Reports Ends here ################################################
*/
		

		
		public function creditcardreconcilitaion() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		    $data['ccardRow'] = $this->GetCcardRow();
			//print_r($data['ccardRow']); die();
            $data['pid1'] 	=	$this->daily_shift_model->getProductId();
			$this->layout('company/creditcardreconcilitaion',$data);
			
		}


		
		public function add_credit_customer() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		   
		    $data['credit_customers']	 =	$this->company_model->getallCreditCustomers();
			$this->layout('company/add_credit_customer',$data);
			
		}
		
		
		public function paymentreceived() {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		   
		    $data['credit_customers']	 =	$this->company_model->getallCreditCustomers();
		    $data['ReceivedAmount']	 =	$this->company_model->getallReceivedAmount();
			$this->layout('company/paymentreceived',$data);
			
		}
		
//#################################### Expancess Category Management starts#################################
		
		           //################main cat starts ##############################
	/*
	  ** View add_expcat
	 */
		public function add_expcat() 
		{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		   
		   // $data['credit_customers']	 =	$this->company_model->getallCreditCustomers();
		    $data['MainCat']	 =	$this->getallMainExpCat();
			$this->layout('company/add_expcat',$data);
			
		}
		
	/*
	  ** Save SaveExpcat
	*/
	public function SaveExpcat()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		if($this->input->post('save_page'))
		{
			$id 	=	$this->input->post("id")?$this->input->post("id"):NULL;
			
			if($id)
			{
				$page 	=	$this->company_model->SaveExpcat($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/company/add_expcat");

			} else {
				$page 	=	$this->company_model->SaveExpcat(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Category Added SuccesFully</span></div> ');			
				redirect("admin/company/add_expcat");
			    }	
			
		} else {
			$this->session->set_flashdata('success', '<div class="alert alert-error "><span>Not Performed any task!</span></div> ');			
			redirect("admin/company/add_expcat");
		}
	}
	
	
	 /*
	** Edit Expancess Main Category
	*/
	public function edit_expcat($id) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->getExpCatPages($id);
		//print_r($page); die('rrr');
		//$data['enduser'] = $this->enduser_model->getallProduct(); 
		
		if($page) {
			
			$data['page']	= $page;
			$this->layout('company/edit_expcat',$data);
				
		} else {
			redirect("admin/company");
		}
	}
	
	
	/*
	  ** Get Expancess Main Category Row
	*/
	
	public function getallMainExpCat() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 
		 $this->db->where('c_id',$cid1);
		 
		 //$this->db->order_by('date_created','DESC');
		 $query = $this->db->get('expcat')->result();
	     $q=$this->db->last_query($query );
		// print_r($q); die('err');
	   return $query;
	  
	}
	
	/*
	  ** Get Expancess Main Category Pages
	*/
	public function getExpCatPages($id) 
	   {
		$this->db->where("id = '{$id}'");		
		$page = $this->db->get('expcat')->row_array();
		
		return $page;
		
	    }
		
	/*
	  ** Delete Page
	*/
		
		public function DeleteExpCat($id)
	{
		if($id)
		{		
          $this->db->where('id', $id)->delete('expcat');	
		  $this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Deleted SuccesFully</span></div> ');			
		}
		else
		 {
		  $this->session->set_flashdata('success', '<div class="alert alert-error "><span>Record Cant be Deleted!</span></div> ');				
		 }
		  redirect($this->agent->referrer());		

	  }
	                 //#########################main cat ends ############################
					 
					 
					 //########################### sub cat starts #########################
					 
	/*
	  ** View add_subexpcat
	 */
		public function add_expsubcat() 
		{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		   
		    $data['SubCat']	 =	$this->getallSubExpCat();
		    $data['MainCat']	 =	$this->getallMainExpCat();
			$this->layout('company/add_expsubcat',$data);
			
		}
		
	/*
	  ** Save 
	*/
	public function SaveSubcat()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		if($this->input->post('save_page'))
		{
			$id 	=	$this->input->post("id")?$this->input->post("id"):NULL;
			
			if($id)
			{
				$page 	=	$this->company_model->SaveExpSubcat($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/company/add_expsubcat");

			} else {
				$page 	=	$this->company_model->SaveExpSubcat(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Category Added SuccesFully</span></div> ');			
				redirect("admin/company/add_expsubcat");
			    }	
			
		} else {
			$this->session->set_flashdata('success', '<div class="alert alert-error "><span>Not Performed any task!</span></div> ');			
			redirect("admin/company/add_expsubcat");
		}
	}
	
	
	 /*
	** Edit Expancess Main Category
	*/
	public function edit_expsubcat($id) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->getExpSubCatPages($id);
		//print_r($page); die('rrr');
		//$data['enduser'] = $this->enduser_model->getallProduct(); 
		
		if($page) {
			
			$data['page']	= $page;
			$data['MainCat']	 =	$this->getallMainExpCat();
			$this->layout('company/edit_expsubcat',$data);
				
		} else {
			redirect("admin/company");
		}
	}
	
	
	/*
	  ** Get Expancess Sub Category Row
	*/
	
	public function getallSubExpCat() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 
		 $this->db->where('c_id',$cid1);
		 
		 //$this->db->order_by('date_created','DESC');
		 $query = $this->db->get('expsubcat')->result();
	     $q=$this->db->last_query($query );
		// print_r($q); die('err');
	   return $query;
	  
	}
	
	/*
	  ** Get Expancess Sub Category Pages
	*/
	public function getExpSubCatPages($id) 
	   {
		$this->db->where("id = '{$id}'");		
		$page = $this->db->get('expsubcat')->row_array();
		
		return $page;
		
	    }
		
	/*
	  ** Delete Page
	*/
		
		public function DeleteExpSubCat($id)
	{
		if($id)
		{		
          $this->db->where('id', $id)->delete('expsubcat');	
		  $this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Deleted SuccesFully</span></div> ');			
		}
		else
		 {
		  $this->session->set_flashdata('success', '<div class="alert alert-error "><span>Record Cant be Deleted!</span></div> ');				
		 }
		  redirect($this->agent->referrer());		

	  }
					 
					 
					 
		             //########################### sub cat ends #########################

//############################################ Expancess Category Management Ends #######################################################

//############################################ Expancess Entry Starts #############################################



//#################################### Controller Codes of Purchased starts#################################
		
		          
	/*
	  ** View add_expcat
	 */
		public function add_purchased() 
		{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		   
		   $data['PurchaseRow']	 =	$this->getPurchasedRow();
		    //$data['MainCat']	 =	$this->getallMainExpCat();
			$data['pid1'] = $this->daily_shift_model->getProductId();
			$this->layout('company/add_purchased',$data);
			
		}
		
		/*
	  ** Save 
	*/
	public function SavePurchased()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		if($this->input->post('save_page'))
		{
			$id 	=	$this->input->post("id")?$this->input->post("id"):NULL;
			
			if($id)
			{
				$page 	=	$this->company_model->SavePuechasedData($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/company/add_purchased");

			} else {
				$page 	=	$this->company_model->SavePuechasedData(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Data Added SuccesFully</span></div> ');			
				redirect("admin/company/add_purchased");
			    }	
			
		} else {
			$this->session->set_flashdata('success', '<div class="alert alert-error "><span>Not Performed any task!</span></div> ');			
			redirect("admin/company/add_purchased");
		}
	}
	
	
	public function getPurchasedRow() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 
		 $this->db->where('c_id',$cid1);
		 
		 $this->db->order_by('date','DESC');
		 $this->db->limit('30');
		 $query = $this->db->get('purchase')->result();
	     $q=$this->db->last_query($query );
		// print_r($q); die('err');
	   return $query;
	  
	}
	
	
	public function DeletePurchasedRow($id)
	{
		if($id)
		{		
          $this->db->where('id', $id)->delete('purchase');	
		  $this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Deleted SuccesFully</span></div> ');			
		}
		else
		 {
		  $this->session->set_flashdata('success', '<div class="alert alert-error "><span>Record Cant be Deleted!</span></div> ');				
		 }
		  redirect($this->agent->referrer());		

	  }
		
	

//############################################ Controller Codes of Purchased Ends #############################################















     /*
	  ** View 
	 */
		public function add_expenses() 
		{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || View page";
		   
		   // $data['credit_customers']	 =	$this->company_model->getallCreditCustomers();
		    $data['MainCat']	 =	$this->getallMainExpCat();
		    $data['expenses']	 =	$this->getallExpenses();
			$this->layout('company/add_expenses',$data);
			
		}
		
	/*
	  ** Get Sub Cat for Ajax Call 
	 */
		
		public function getallExpSubCat() 
	{  
	     $cat_name = $_POST['categoryId'];
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 
		 $this->db->where('c_id',$cid1);
		 $this->db->where('cat_name',$cat_name);
		
		 $query = $this->db->get('expsubcat')->result();
	     $q=$this->db->last_query($query );
		
		 foreach($query as $rows)
        {
			
		echo '<option value="'.$rows->subcat_name.'">'.ucfirst($rows->subcat_name).'</option>';
      
        }
	  
	}
	
	
	/*
	  ** Save SaveAddExpenses
	*/
	public function SaveExpenses()
	{
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Add Page";
		if($this->input->post('save_page'))
		{
			$id 	=	$this->input->post("id")?$this->input->post("id"):NULL;
			
			if($id)
			{
				$page 	=	$this->company_model->SaveExpData($id);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Updated SuccesFully</span></div> ');			
				
				redirect("admin/company/add_expenses");

			} else {
				$page 	=	$this->company_model->SaveExpData(NULL);
				$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Category Added SuccesFully</span></div> ');			
				redirect("admin/company/add_expenses");
			    }	
			
		} else {
			$this->session->set_flashdata('success', '<div class="alert alert-error "><span>Not Performed any task!</span></div> ');			
			redirect("admin/company/add_expenses");
		}
	}
	
	/*
	  ** Get Expancess Data Row
	*/
	
	public function getallExpenses() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 
		 $this->db->where('c_id',$cid1);
		 
		 //$this->db->order_by('date_created','DESC');
		 $query = $this->db->get('expenses')->result();
	     $q=$this->db->last_query($query );
		// print_r($q); die('err');
	   return $query;
	  
	}
	

//############################################ Expancess Entry Ends #############################################
		
	
		
	
	
    /*
	** Edit Credit Customer
	*/
	public function edit_creditcustomer($id) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->company_model->getPages($id);
		//print_r($page); die('rrr');
		//$data['enduser'] = $this->enduser_model->getallProduct(); 
		
		if($page) {
			
			$data['page']	= $page;
			$this->layout('company/edit_creditcustomer',$data);
				
		} else {
			redirect("admin/company");
		}
	}
	
	
	 /*
	** Edit Received Amount
	*/
	public function edit_receivedamount($id) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->company_model->getReceivedAmountPages($id);
		//print_r($page); die('rrr');
		//$data['enduser'] = $this->enduser_model->getallProduct(); 
		
		if($page) {
			
			$data['page']	= $page;
			$data['credit_customers']	 =	$this->company_model->getallCreditCustomers();
			$this->layout('company/edit_receivedamount',$data);
				
		} else {
			redirect("admin/company");
		}
	}

	
	/*
	** Edit Page
	*/
	public function edit($id) {
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->company_model->getPage($id);
		
 
		$data['products'] = $this->company_model->getallProduct(); 
		$data['products_name'] = $this->company_model->getProductName($id); 
		if($page) {
			   
			$data['page']	=	$page;
			
			$this->layout('company/edit',$data);
				
		} else {
			redirect("admin/company");
		}
	}
	
	/*
	** Edit Main Product Price
	*/
	public function editprice($id) {
		
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page 			=	$this->mainproduct_model->getPage($id);
		//print_r($page);die;
		if(!$page) {
		 $this->load->model('product_model');
		 
		 $data['page']	=	$this->product_model->getProductName($id);
				
		} else {
			$data['page']	=	$page ;
		}
			$this->layout('company/editprice',$data);
	}
	
	/*
	** Manage Main Product Page
	*/
	public function mainproduct() {
		
		$SITE_TITLE = SITE_TITLE;
		$data['title'] = "$SITE_TITLE Admin || Edit Page";
		$page1 	=	$this->company_model->getCompanyId();
		$p=$page1['0']->c_id;
		$this->load->model('product_model');
		$page1=	$this->company_model->getMainProducts();
		$data['page1']	=	$page1; 
		if($page1) {
			$data['page1']	=	$page1;
			$this->layout('company/mainproduct',$data);
				
		} else {
			redirect("admin/company");
		}
	
		
	}
	/*
	
	** Delete page  
	*/
	public function delete($email)
	{
		if($email)
		{			
			$result 			=	$this->company_model->deletePage($email);
			if($result == 0)
			{
			$this->session->set_flashdata('error', '<div class="alert alert-success "><span style="color:red;">User Blocked SuccesFully. This User can not be Deleted!!</span></div> ');				
			}
			else{
			$this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Deleted SuccesFully</span></div> ');			
			}
				
			
		}
			redirect($this->agent->referrer());		

	}
	
	
	public function DeleteCreditCustomer($id)
	{
		if($id)
		{		
          $this->db->where('id', $id)->delete('credit_customer');	
		  $this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Deleted SuccesFully</span></div> ');			
		}
		else
		 {
		  $this->session->set_flashdata('success', '<div class="alert alert-error "><span>Record Cant be Deleted!</span></div> ');				
		 }
		  redirect($this->agent->referrer());		

	  }
	  
	  
	  public function DeleteReceivedAmount($id)
	{
		if($id)
		{		
          $this->db->where('id', $id)->delete('amount_received');	
		  $this->session->set_flashdata('success', '<div class="alert alert-success "><span>Record Deleted SuccesFully</span></div> ');			
		}
		else
		 {
		  $this->session->set_flashdata('success', '<div class="alert alert-error "><span>Record Cant be Deleted!</span></div> ');				
		 }
		  redirect($this->agent->referrer());		

	  }
	
	/*
	** Check email availablity
	*/
	function check_email_availablity()
      {
		$email = $this->input->post('email');
		$this->load->model('company_model');
	    $get_result = $this->company_model->check_email_available($email);
		print_r($get_result);
	  }
	  function check_username_availablity()
      {
		$username = $this->input->post('username');
		$this->load->model('company_model');
	    $get_result = $this->company_model->check_username_available($username);
		print_r($get_result);
	  }
	  
	  
  public function createDateRangeArray($strDateFrom,$strDateTo)
   {
    

    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
  }
  
  
  
  public function GetCcardRow()  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('*');
		 //$this->db->like('date', $date);
      
		 $this->db->where('c_id	',$cid1);
		 //$this->db->where('pid	',$pid);
		// $this->db->group_by('daily_shift_id'); 
		 $query = $this->db->get('ccard_entry')->result();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query;
	   
	}
	
	
	
	public function GetPprice($pid,$date)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('s_price');
		
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('pid	',$pid);
		 $this->db->like('date_created', $date);
		 $this->db->order_by("date_created", "DESC");
		 $this->db->limit('1');
		// $this->db->group_by('daily_shift_id'); 
		 $query = $this->db->get('price')->row_array();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query['s_price'];
	   
	}
	
	
	public function GetOldPprice($pid,$date)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('old_price');
		
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('pid	',$pid);
		 $this->db->like('date_created', $date);
		 $this->db->order_by("date_created", "DESC");
		 $this->db->limit('1');
		// $this->db->group_by('daily_shift_id'); 
		 $query = $this->db->get('price')->row_array();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query['old_price'];
	   
	}
	
	public function GetPurchasePrice($pid,$date)  
	
	{
	    $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
         
         $this->db->select('purchased_price');
		
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('p_id	',$pid);
		 $this->db->like('date_created', $date);
		 $this->db->order_by("date_created", "DESC");
		 $this->db->limit('1');
		// $this->db->group_by('daily_shift_id'); 
		 $query = $this->db->get('purchase')->row_array();
		 $q= $this->db->last_query($query);
		//print_r($q); die();
	   return $query['purchased_price'];
	   
	}
	
	
	

}

/* End of file Pages.php */
/* Location: ./application/controllers/admin/company.php */
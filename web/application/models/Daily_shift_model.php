<?php
class Daily_shift_model extends CI_Model{
	protected $_table_name = 'daily_entry';
	protected $_order_by = 'id';
	protected static $db_fields = array('id', 'pid', 'user_id', 'daily_shift_id', 'c_id', 'open', 'received', 'total', 'sale', 'old_sale', 'balance', 'vroot', 'diff', 'total_gallons_sold', 'old_total_gallons_sold', 'gas_sales', 'old_gas_sales', 'store_sales', 'propane_sales', 'old_propane_sales', 'amount_required', 'credit_cards', 'drops_total', 'payouts', 'amount_available', 'overshort', 'date', 'daily_no');
	
	public $id;
	public $pid; 
	public $user_id; 
	public $daily_shift_id; 
	public $c_id;
    public $open;
    public $received;
    public $total;
    public $sale;
    public $old_sale;
    public $balance;
    public $vroot;
    public $diff;
    public $total_gallons_sold;
    public $old_total_gallons_sold;
    public $gas_sales;
    public $old_gas_sales;
    public $store_sales;
    public $propane_sales;
    public $old_propane_sales;
    public $amount_required;
    public $credit_cards;
    public $drops_total;
    public $payouts;
    public $amount_available;
    public $overshort;
	public $date;
	public $daily_no;
   	
	
	
		
	
	//public $delete_status; //1 if delte

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function savePage($id=NULL,$table='daily_entry')
	{
		
		
		$data 	= $this->array_from_post(self::$db_fields);	
		
	
		if($id)
		{
			
		
			$shiftdata = $this->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
			$uid = $shiftdata['id'];
			$daily_no = $shiftdata['daily_no'];
			$login_time = $shiftdata['login_time'];
			$price_change_status = $shiftdata['price_change'];
			$end_pid= $shiftdata['pid'];
			$logout_time = date("Y-m-d H:i:s", time());
			$id = $this->input->post("id");
			$pid = $this->input->post("pid");
			$checkNewprice = $this->getNewPrice();
			$open = $this->input->post("open");

			$received = $this->input->post("received");
			
			$total = $this->input->post("total");
			if(!empty($checkNewprice))
			{
				
				$old_sale = $this->input->post("old_sale");
				$old_total_gallons_solds = array_sum($old_sale);
				//die($old_sale);
			}
			$sale = $this->input->post("sale");
			$total_gallons_solds = array_sum($sale);
			$balance = $this->input->post("balance");
			$vroot = $this->input->post("vroot");
			$diff = $this->input->post("diff");
			$store_sales = $this->input->post("store_sales");
			$credit_cards = $this->input->post("credit_cards");
			$drops_total = $this->input->post("drops_total");
			$payouts = $this->input->post("payouts");
			$cid = $this->daily_shift_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			
			$TotalGasSales  = $this->TotalGasSales($shift_id,$daily_no,$user_id)->gas_sales;
			
			
			$TotalPropaneSales  = $this->TotalGasSales($shift_id,$daily_no,$user_id)->propane_sales;
			
			$old_propane_sales  = $this->TotalGasSales($shift_id,$daily_no,$user_id)->old_propane_sales;
			
			$total_gallons_soldss  = $this->TotalGasSales($shift_id,$daily_no,$user_id)->total_gallons_sold;
			
		foreach(array_combine($pid,$sale) as $row1=> $sales){
			$product_price  =	$this->getProductPrice($row1);
			$product_old_price  = $this->getProductOldPrice($row1);
			
			$propane_product_price  =	$this->getProductPrice(64);
			$propane_product_old_price  =	$this->getProductOldPrice(64);
			
		
			if(!empty($checkNewprice))
			{
				
			 if($row1 != 64)
				{
			  $gas_sales += (($sale[$row1])*($product_price));
			  $old_gas_sales += (($old_sale[$row1])*($product_old_price));
		
				}
				
				else
		      {
			  $propane_sales = (($sale[64])*($propane_product_price));
			  $old_propane_sales = (($old_sale[64])*($propane_product_old_price));
		    
		       }
	
			}
			
		else{
				
				 if($row1 != 64)
				{
			  $gas_sales += (($sale[$row1])*($product_price));
		
				}
				
				else
		      {
			  $propane_sales = (($sale[64])*($propane_product_price));
		    
		       }
                     			   
		}
			
			}
			
		$amount_required = ($gas_sales+$propane_sales+$store_sales);
		if(!empty($checkNewprice))
	  {
		$amount_required = ($gas_sales+$old_gas_sales+$propane_sales+$old_propane_sales+$store_sales);
	   }
		$amount_available = ($credit_cards+$drops_total+$payouts);
		$overshort = ($amount_available-$amount_required);
			
       
		foreach(array_combine($id,$pid) as $product_id=> $row){

       
	     $receiveds = $received[$row];
		 $opens = $open[$row];
		
		 $sales = $sale[$row];
		 $total_sales += $sale[$row];
	     $totals= ($opens+$receiveds);
		 $vroots= $vroot[$row];
		 $product_price  =	$this->getProductPrice($row);
       
	if(!empty($checkNewprice))
	{
		$old_sales = $old_sale[$row];
		$data['old_sale'] = $old_sale[$row];
		$data['old_total_gallons_sold'] = $old_total_gallons_solds;
		$data['old_gas_sales'] = $old_gas_sales;
		$data['old_propane_sales'] = $old_propane_sales;
       if($row==64)
		 {
			$balances=($totals+$sales+$old_sales); 
		 }
		 else{
			$balances=($totals-($sales+$old_sales));  
			 
		 }			
			       }
	else
	{
		 if($row==64)
		 {
			$balances=($totals+$sales); 
		 }
		 else{
			$balances=($totals-$sales);  
			 
		 }
		 
		       } 
			   
		 $diffs= ($vroots-$balances);
		 
		 
		 
		 $data['id'] = $product_id;
		 $data['pid'] = $pid[$row];
		 $data['open'] = $open[$row];
		
		$data['received'] = $received[$row];
		$data['total'] = $totals;
		$data['sale'] = $sale[$row];
		$data['balance'] = $balances;
		$data['vroot'] = $vroot[$row];
		$data['diff'] = $diffs;
		$data['total_gallons_sold'] = $total_gallons_solds;
		
		$data['gas_sales'] = $gas_sales;
		
		$data['propane_sales'] = $propane_sales;
		
		$data['store_sales'] = $store_sales;
		$data['amount_required'] = $amount_required;
		$data['credit_cards'] = $credit_cards;
		$data['drops_total'] = $drops_total;
		$data['payouts'] = $payouts;
		$data['amount_available'] = $amount_available;
		$data['overshort'] = $overshort;
		
        $data['user_id'] = $user_id;
        
           $data['daily_shift_id'] = $shift_id ;
		   $data['c_id'] = $cid1;
		   $data['date'] = $logout_time;

			$this->db->where('id', $product_id);
			
			$last_id = $this->db->update($table ,$data);
			
			}
		
			if($last_id !== 0)
			{ 
				return true;
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');
			 }
			 
			else{
				return false;
			    }
		} 
		
		else {
		
			$shiftdata = $this->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
			$uid = $shiftdata['id'];
			$daily_no = $shiftdata['daily_no'];
			$login_time = $shiftdata['login_time'];
			$logout_time = date("Y-m-d H:i:s", time());
			
			$pid = $this->input->post("pid");
			$open = $this->input->post("open");
			$received = $this->input->post("received");
			$total = $this->input->post("total");
			$sale = $this->input->post("sale");
			$total_gallons_solds = array_sum($sale);
			$balance = $this->input->post("balance");
			$vroot = $this->input->post("vroot");
			$diff = $this->input->post("diff");
			$store_sales = $this->input->post("store_sales");
			$drops = $this->input->post("drops_total");
			$payouts = $this->input->post("payouts");
			$credit_cards = $this->input->post("credit_cards");
			
			
		    $amount_available = ($credit_cards+$drops+$payouts);
		   
			$cid = $this->daily_shift_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			
			foreach($pid as $row1)
			{
				$product_price2  =	$this->getProductPrice($row1);
				 if($row1 != 64)
		      {
		      $gas_sales += (($sale[$row1])*($product_price2));
		
		         }
				
				}
		 	$product_price1  =	$this->getProductPrice(64);
	        $propane_sales = (($sale[64])*($product_price1));
		    $amount_required = ($gas_sales+$propane_sales+$store_sales);
	        $overshort = ($amount_available-$amount_required);
        foreach($pid as $row){
       
		$data['pid'] = $pid[$row];
		$data['open'] = $this->daily_shift_model->getLastEntryRecord($row)->balance;
		$opens = $this->daily_shift_model->getLastEntryRecord($row)->balance;
		$receiveds = $received[$row];
		$totals = ($opens +$receiveds);
		$sales = $sale[$row];
		$vroots = $vroot[$row];
		if($row==64)
		 {
			$balances=($totals+$sales); 
		 }
		 else{
			$balances=($totals-$sales);  
			 
		 }
		$diffs= ($vroots-$balances);
		
		
		$data['received'] = $received[$row];
	
		$data['total'] = $totals;
		$data['sale'] = $sale[$row];
		$data['balance'] = $balances;
		$data['vroot'] = $vroot[$row];
		$data['diff'] = $diffs;
	
        $data['user_id'] = $user_id;
        $data['store_sales'] = $store_sales;
        $data['gas_sales'] = $gas_sales;
        $data['propane_sales'] = $propane_sales;
        $data['amount_required'] = $amount_required;
        $data['amount_available'] = $amount_available;
        $data['overshort'] = $overshort;
        $data['total_gallons_sold'] = $total_gallons_solds;
        
        $data['daily_shift_id'] = $shift_id ;
		$data['c_id'] = $cid1;
		$data['date'] = $logout_time;
		$data['daily_no'] = $daily_no;
        $this->db->insert($table,$data);
		
    }
		    
			if($last_id !== 0){
				return true;
				 $this->admin_login_model->logout();
				 redirect('/admin/login');
			}else{
				return false;
			}
			
		}
				
	}
	
	
	
	public function closeShift($id=NULL,$table='daily_entry')
	 {
		
		$data 	= $this->array_from_post(self::$db_fields);	
	
		if($id)
		{
			
		
			$shiftdata = $this->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
			$uid = $shiftdata['id'];
			$daily_no = $shiftdata['daily_no'];
			$login_time = $shiftdata['login_time'];
			$price_change_status = $shiftdata['price_change'];
			$end_pid= $shiftdata['pid'];
			$logout_time = date("Y-m-d H:i:s", time());
			$id = $this->input->post("id");
			$pid = $this->input->post("pid");
			$checkNewprice = $this->getNewPrice();
			$open = $this->input->post("open");

			$received = $this->input->post("received");
			
			$total = $this->input->post("total");
			if(!empty($checkNewprice))
			{
				
				$old_sale = $this->input->post("old_sale");
				$old_total_gallons_solds = array_sum($old_sale);
				//die($old_sale);
			}
			$sale = $this->input->post("sale");
			$total_gallons_solds = array_sum($sale);
			$balance = $this->input->post("balance");
			$vroot = $this->input->post("vroot");
			$diff = $this->input->post("diff");
			$store_sales = $this->input->post("store_sales");
			$credit_cards = $this->input->post("credit_cards");
			$drops_total = $this->input->post("drops_total");
			$payouts = $this->input->post("payouts");
			$cid = $this->daily_shift_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			
			$TotalGasSales  = $this->TotalGasSales($shift_id,$daily_no,$user_id)->gas_sales;
			
			
			$TotalPropaneSales  = $this->TotalGasSales($shift_id,$daily_no,$user_id)->propane_sales;
			
			$old_propane_sales  = $this->TotalGasSales($shift_id,$daily_no,$user_id)->old_propane_sales;
			
			$total_gallons_soldss  = $this->TotalGasSales($shift_id,$daily_no,$user_id)->total_gallons_sold;
			
		foreach(array_combine($pid,$sale) as $row1=> $sales){
			$product_price  =	$this->getProductPrice($row1);
			$product_old_price  = $this->getProductOldPrice($row1);
			
			$propane_product_price  =	$this->getProductPrice(64);
			$propane_product_old_price  =	$this->getProductOldPrice(64);
			
		
			if(!empty($checkNewprice))
			{
				
			 if($row1 != 64)
				{
			  $gas_sales += (($sale[$row1])*($product_price));
			  $old_gas_sales += (($old_sale[$row1])*($product_old_price));
		
				}
				
				else
		      {
			  $propane_sales = (($sale[64])*($propane_product_price));
			  $old_propane_sales = (($old_sale[64])*($propane_product_old_price));
		    
		       }
	
			}
			
		else{
				
				 if($row1 != 64)
				{
			  $gas_sales += (($sale[$row1])*($product_price));
		
				}
				
				else
		      {
			  $propane_sales = (($sale[64])*($propane_product_price));
		    
		       }
                     			   
		}
			
			}
			
		$amount_required = ($gas_sales+$propane_sales+$store_sales);
		if(!empty($checkNewprice))
	  {
		$amount_required = ($gas_sales+$old_gas_sales+$propane_sales+$old_propane_sales+$store_sales);
	   }
		$amount_available = ($credit_cards+$drops_total+$payouts);
		$overshort = ($amount_available-$amount_required);
			
       
		foreach(array_combine($id,$pid) as $product_id=> $row){

       
	     $receiveds = $received[$row];
		 $opens = $open[$row];
		
		 $sales = $sale[$row];
		 $total_sales += $sale[$row];
	     $totals= ($opens+$receiveds);
		 $vroots= $vroot[$row];
		 $product_price  =	$this->getProductPrice($row);
       
	if(!empty($checkNewprice))
	{
		$old_sales = $old_sale[$row];
		$data['old_sale'] = $old_sale[$row];
		$data['old_total_gallons_sold'] = $old_total_gallons_solds;
		$data['old_gas_sales'] = $old_gas_sales;
		$data['old_propane_sales'] = $old_propane_sales;
       if($row==64)
		 {
			$balances=($totals+$sales+$old_sales); 
		 }
		 else{
			$balances=($totals-($sales+$old_sales));  
			 
		 }			
			       }
	else
	{
		 if($row==64)
		 {
			$balances=($totals+$sales); 
		 }
		 else{
			$balances=($totals-$sales);  
			 
		 }
		 
		       } 
			   
		 $diffs= ($vroots-$balances);
		 
		 
		 
		 $data['id'] = $product_id;
		 $data['pid'] = $pid[$row];
		 $data['open'] = $open[$row];
		
		$data['received'] = $received[$row];
		$data['total'] = $totals;
		$data['sale'] = $sale[$row];
		$data['balance'] = $balances;
		$data['vroot'] = $vroot[$row];
		$data['diff'] = $diffs;
		$data['total_gallons_sold'] = $total_gallons_solds;
		
		$data['gas_sales'] = $gas_sales;
		
		$data['propane_sales'] = $propane_sales;
		
		$data['store_sales'] = $store_sales;
		$data['amount_required'] = $amount_required;
		$data['credit_cards'] = $credit_cards;
		$data['drops_total'] = $drops_total;
		$data['payouts'] = $payouts;
		$data['amount_available'] = $amount_available;
		$data['overshort'] = $overshort;
		
        $data['user_id'] = $user_id;
        
           $data['daily_shift_id'] = $shift_id ;
		   $data['c_id'] = $cid1;
		   $data['date'] = $logout_time;

			$this->db->where('id', $product_id);
			
			$last_id = $this->db->update($table ,$data);
			
			}
			
			// daily_shift close code starts here
			$shiftdata = $this->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
			$uid = $shiftdata['id'];
			$login_time = $shiftdata['login_time'];
			$logout_time = date("Y-m-d H:i:s", time());
			
			$table2 = "daily_shift";
			$data2 = array('logout_time'=> $logout_time, 'status'=>'close');	
            $this->db->where('id', $uid);
			$last_id = $this->db->update($table2 ,$data2);
			// daily_shift close code starts here
		
			if($last_id !== 0)
			{ 
				return true;
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');
			 }
			 
			else{
				return false;
			    }
		} 
		
		else {
		
			$shiftdata = $this->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
			$uid = $shiftdata['id'];
			$daily_no = $shiftdata['daily_no'];
			$login_time = $shiftdata['login_time'];
			$logout_time = date("Y-m-d H:i:s", time());
			
			$pid = $this->input->post("pid");
			$open = $this->input->post("open");
			$received = $this->input->post("received");
			$total = $this->input->post("total");
			$sale = $this->input->post("sale");
		
			$balance = $this->input->post("balance");
			$vroot = $this->input->post("vroot");
			$diff = $this->input->post("diff");
			$cid = $this->daily_shift_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			$store_sales  =	$this->store_sales_model->getTotalStoreSales()->total_store_sales;
		   
        foreach($pid as $row){
       
		$data['pid'] = $pid[$row];
		$data['open'] = $this->daily_shift_model->getLastEntryRecord($row)->balance;
		
		$data['received'] = $received[$row];
		$data['total'] = $total[$row];
		$data['sale'] = $sale[$row];
		$data['balance'] = $balance[$row];
		$data['vroot'] = $vroot[$row];
		$data['diff'] = $diff[$row];
	
        $data['user_id'] = $user_id;
        $data['store_sales'] = $store_sales;
        
        $data['daily_shift_id'] = $shift_id ;
		$data['c_id'] = $cid1;
		$data['date'] = $logout_time;
		$data['daily_no'] = $daily_no;
        $this->db->insert($table,$data);
		
    }
	
	       // daily_shift close code starts here
			$shiftdata = $this->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
			$uid = $shiftdata['id'];
			$login_time = $shiftdata['login_time'];
			$logout_time = date("Y-m-d H:i:s", time());
			
			$table2 = "daily_shift";
			$data2 = array('logout_time'=> $logout_time, 'status'=>'close');	
            $this->db->where('id', $uid);
			$last_id = $this->db->update($table2 ,$data2);
			// daily_shift close code starts here
	
		    
			if($last_id !== 0){
				return true;
				 $this->admin_login_model->logout();
				 redirect('/admin/login');
			}else{
				return false;
			}
			
		}
			
	}
	
	
	
	
	public function CloseDaily($id=NULL,$table='daily_entry')
	{
		
		$data 	= $this->array_from_post(self::$db_fields);	
	
		if($id)
	{
			
		
			$shiftdata = $this->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
			$uid = $shiftdata['id'];
			$daily_no = $shiftdata['daily_no'];
			$login_time = $shiftdata['login_time'];
			$price_change_status = $shiftdata['price_change'];
			$end_pid= $shiftdata['pid'];
			$logout_time = date("Y-m-d H:i:s", time());
			$id = $this->input->post("id");
			$pid = $this->input->post("pid");
			$checkNewprice = $this->getNewPrice();
			$open = $this->input->post("open");

			$received = $this->input->post("received");
			
			$total = $this->input->post("total");
			if(!empty($checkNewprice))
			{
				
				$old_sale = $this->input->post("old_sale");
				$old_total_gallons_solds = array_sum($old_sale);
				//die($old_sale);
			}
			$sale = $this->input->post("sale");
			$total_gallons_solds = array_sum($sale);
			$balance = $this->input->post("balance");
			$vroot = $this->input->post("vroot");
			$diff = $this->input->post("diff");
			$store_sales = $this->input->post("store_sales");
			$credit_cards = $this->input->post("credit_cards");
			$drops_total = $this->input->post("drops_total");
			$payouts = $this->input->post("payouts");
			$cid = $this->daily_shift_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			
			$TotalGasSales  = $this->TotalGasSales($shift_id,$daily_no,$user_id)->gas_sales;
			
			
			$TotalPropaneSales  = $this->TotalGasSales($shift_id,$daily_no,$user_id)->propane_sales;
			
			$old_propane_sales  = $this->TotalGasSales($shift_id,$daily_no,$user_id)->old_propane_sales;
			
			$total_gallons_soldss  = $this->TotalGasSales($shift_id,$daily_no,$user_id)->total_gallons_sold;
			
		foreach(array_combine($pid,$sale) as $row1=> $sales){
			$product_price  =	$this->getProductPrice($row1);
			$product_old_price  = $this->getProductOldPrice($row1);
			
			$propane_product_price  =	$this->getProductPrice(64);
			$propane_product_old_price  =	$this->getProductOldPrice(64);
			
		
			if(!empty($checkNewprice))
			{
				
			 if($row1 != 64)
				{
			  $gas_sales += (($sale[$row1])*($product_price));
			  $old_gas_sales += (($old_sale[$row1])*($product_old_price));
		
				}
				
				else
		      {
			  $propane_sales = (($sale[64])*($propane_product_price));
			  $old_propane_sales = (($old_sale[64])*($propane_product_old_price));
		    
		       }
	
			}
			
		else{
				
				 if($row1 != 64)
				{
			  $gas_sales += (($sale[$row1])*($product_price));
		
				}
				
				else
		      {
			  $propane_sales = (($sale[64])*($propane_product_price));
		    
		       }
                     			   
		}
			
			}
			
		$amount_required = ($gas_sales+$propane_sales+$store_sales);
		if(!empty($checkNewprice))
	  {
		$amount_required = ($gas_sales+$old_gas_sales+$propane_sales+$old_propane_sales+$store_sales);
	   }
		$amount_available = ($credit_cards+$drops_total+$payouts);
		$overshort = ($amount_available-$amount_required);
			
       
		foreach(array_combine($id,$pid) as $product_id=> $row){

       
	     $receiveds = $received[$row];
		 $opens = $open[$row];
		
		 $sales = $sale[$row];
		 $total_sales += $sale[$row];
	     $totals= ($opens+$receiveds);
		 $vroots= $vroot[$row];
		 $product_price  =	$this->getProductPrice($row);
       
	if(!empty($checkNewprice))
	{
		$old_sales = $old_sale[$row];
		$data['old_sale'] = $old_sale[$row];
		$data['old_total_gallons_sold'] = $old_total_gallons_solds;
		$data['old_gas_sales'] = $old_gas_sales;
		$data['old_propane_sales'] = $old_propane_sales;
       if($row==64)
		 {
			$balances=($totals+$sales+$old_sales); 
		 }
		 else{
			$balances=($totals-($sales+$old_sales));  
			 
		 }			
			       }
	else
	{
		 if($row==64)
		 {
			$balances=($totals+$sales); 
		 }
		 else{
			$balances=($totals-$sales);  
			 
		 }
		 
		       } 
			   
		 $diffs= ($vroots-$balances);
		 
		 
		 
		 $data['id'] = $product_id;
		 $data['pid'] = $pid[$row];
		 $data['open'] = $open[$row];
		
		$data['received'] = $received[$row];
		$data['total'] = $totals;
		$data['sale'] = $sale[$row];
		$data['balance'] = $balances;
		$data['vroot'] = $vroot[$row];
		$data['diff'] = $diffs;
		$data['total_gallons_sold'] = $total_gallons_solds;
		
		$data['gas_sales'] = $gas_sales;
		
		$data['propane_sales'] = $propane_sales;
		
		$data['store_sales'] = $store_sales;
		$data['amount_required'] = $amount_required;
		$data['credit_cards'] = $credit_cards;
		$data['drops_total'] = $drops_total;
		$data['payouts'] = $payouts;
		$data['amount_available'] = $amount_available;
		$data['overshort'] = $overshort;
		
        $data['user_id'] = $user_id;
        
           $data['daily_shift_id'] = $shift_id ;
		   $data['c_id'] = $cid1;
		   $data['date'] = $logout_time;

			$this->db->where('id', $product_id);
			
			$last_id = $this->db->update($table ,$data);
			
			}			
			// daily close code starts here
			$shiftdata = $this->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
			$uid = $shiftdata['id'];
			$rowOfDailyNo = $this->admin_login_model->getDailyNo();
            $daily_nos = $rowOfDailyNo->daily_no;
			$daily_no_row_id = $rowOfDailyNo->id;
            $daily_no_status = $rowOfDailyNo->status;
			
			$login_time = $shiftdata['login_time'];
			$logout_time = date("Y-m-d H:i:s", time());
			
			$table2 = "daily_shift";
			$data2 = array('logout_time'=> $logout_time, 'status'=>'close');	
            $this->db->where('id', $uid);
			$last_id1 = $this->db->update($table2 ,$data2);
			
			$table3 = "daily_number";
			$data3 = array('status'=>'close');	
            $this->db->where('id', $daily_no_row_id);
			$last_id = $this->db->update($table3 ,$data3);
			// daily close code starts here
		
			if($last_id !== 0)
			{ 
				return true;
				$this->session->set_flashdata('success', '<div class="alert alert-success display-hide"><span>Record Deleted SuccesFully</span></div> ');
			 }
			 
			else{
				return false;
			    }
		} 
		
		else {
		
			$shiftdata = $this->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
			$uid = $shiftdata['id'];
			$daily_no = $shiftdata['daily_no'];
			$login_time = $shiftdata['login_time'];
			$logout_time = date("Y-m-d H:i:s", time());
			
			$pid = $this->input->post("pid");
			$open = $this->input->post("open");
			$received = $this->input->post("received");
			$total = $this->input->post("total");
			$sale = $this->input->post("sale");
			//$total_gallons_solds = array_sum($sale);
			$balance = $this->input->post("balance");
			$vroot = $this->input->post("vroot");
			$diff = $this->input->post("diff");
			$cid = $this->daily_shift_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			$store_sales  =	$this->store_sales_model->getTotalStoreSales()->total_store_sales;
		   
        foreach($pid as $row){
       
		$data['pid'] = $pid[$row];
		$data['open'] = $this->daily_shift_model->getLastEntryRecord($row)->balance;
		
		$data['received'] = $received[$row];
		$data['total'] = $total[$row];
		$data['sale'] = $sale[$row];
		$data['balance'] = $balance[$row];
		$data['vroot'] = $vroot[$row];
		$data['diff'] = $diff[$row];
	
        $data['user_id'] = $user_id;
        $data['store_sales'] = $store_sales;
        
        $data['daily_shift_id'] = $shift_id ;
		$data['c_id'] = $cid1;
		$data['date'] = $logout_time;
		$data['daily_no'] = $daily_no;
        $this->db->insert($table,$data);
		
    }
	
	       // daily close code starts here
			$shiftdata = $this->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
			$uid = $shiftdata['id'];
			$rowOfDailyNo = $this->admin_login_model->getDailyNo();
            $daily_nos = $rowOfDailyNo->daily_no;
			$daily_no_row_id = $rowOfDailyNo->id;
            $daily_no_status = $rowOfDailyNo->status;
			
			$login_time = $shiftdata['login_time'];
			$logout_time = date("Y-m-d H:i:s", time());
			
			$table2 = "daily_shift";
			$data2 = array('logout_time'=> $logout_time, 'status'=>'close');	
            $this->db->where('id', $uid);
			$last_id1 = $this->db->update($table2 ,$data2);
			
			$table3 = "daily_number";
			$data3 = array('status'=>'close');	
            $this->db->where('id', $daily_no_row_id);
			$last_id = $this->db->update($table3 ,$data3);
			// daily close code starts here
	
		    
			if($last_id !== 0){
				return true;
				 $this->admin_login_model->logout();
				 redirect('/admin/login');
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
             $this->db->where("id",$cid1);
		     $page = $this->db->get();
		
		      return $page->result();
			  $query1 = $this->db->last_query();
			  
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
	
	public function getSumDropsReceived() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 $daily_no = $shiftdata['daily_no'];
		 
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(amount) as Drops_total', FALSE);
		 $this->db->where('shift',$shift_id);
		 $this->db->where('type','received');
		 $this->db->where("user_id", $user_id);
		 $this->db->where('daily_no	',$daily_no);
		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('created_date','DESC');
		 $query = $this->db->get('drops_payout')->row_object();
	   
	  
	   return $query;
	   
	}
	
		public function getSumPayoutsReceived() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 $daily_no = $shiftdata['daily_no'];
		 
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(amount) as Payouts_total', FALSE);
		 $this->db->where('shift',$shift_id);
		 $this->db->where('type','cash');
		 $this->db->where("user_id", $user_id);
		 $this->db->where('daily_no	',$daily_no);
		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('created_date','DESC');
		 $query = $this->db->get('drops_payout')->row_object();
	   
	  
	   return $query;
	   
	}
	
	public function getSumgasolineOpen($pid) 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->getUserShiftData();
			$user_id = $shiftdata['user_id'];
			$shift_id = $shiftdata['shift'];
		 
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('open');
		 $this->db->where('shift',$shift_id);
		 
		 $this->db->where("user_id", $user_id);
		 $this->db->where('c_id	',$cid1);
		 $query = $this->db->get('daily_entry')->result();
	   
	  
	   return $query;
	   
	}
	
	
		public function getSumGasolineReceived($pid) 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 $daily_no = $shiftdata['daily_no'];
		 
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(received) as received_total', FALSE);
		 $this->db->where('shift',$shift_id);
		 $this->db->where('daily_no',$daily_no);
		 $this->db->where('pid', $pid);
		 $this->db->where("user_id", $user_id);
		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('date_created','DESC');
		 $query = $this->db->get('gasoline_received')->row_object();
	   
	  
	   return $query;
	   
	}
	
	
	
		public function getSumStoreSales() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 $daily_no = $shiftdata['daily_no'];
		 
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(total_price) as store_total', FALSE);
		 $this->db->where('shift',$shift_id);
		 $this->db->where('daily_no',$daily_no);
		// $this->db->where('pid', $pid);
		 $this->db->where("user_id", $user_id);
		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('date_created','DESC');
		 $query = $this->db->get('store_sales')->row_object();
	     $q = $this->db->get->last_query($query);
	     print_r($q); die();
	   return $query;
	   
	}
	
	
	
	
		public function getSumGasolineSale($pid) 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 $daily_no = $shiftdata['daily_no'];
		 
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(sale) as sale_total', FALSE);
		 $this->db->where('daily_shift_id',$shift_id);
		 $this->db->where('pid', $pid);
		 $this->db->where("user_id", $user_id);
		 $this->db->where('daily_no	',$daily_no);
		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('date','DESC');
		 $query = $this->db->get('daily_entry')->row_object();
	   
	  
	   return $query;
	   
	}
	
	
	
		public function getSumGasolineVroot($pid) 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 $daily_no = $shiftdata['daily_no'];
		 
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(vroot) as vroot_total', FALSE);
		 $this->db->where('daily_shift_id',$shift_id);
		 $this->db->where('pid', $pid);
		 $this->db->where("user_id", $user_id);
		 $this->db->where('daily_no	',$daily_no);
		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('date','DESC');
		 $query = $this->db->get('daily_entry')->row_object();
	   
	  
	   return $query;
	   
	}
	
		public function getGasolineRecords() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 $daily_no = $shiftdata['daily_no'];
		  
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('*');
		 $this->db->where('daily_shift_id',$shift_id);
		 
		 $this->db->where("user_id", $user_id);
		 $this->db->where('daily_no	',$daily_no);
		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('date','DESC');
		  $this->db->limit(0, 1);
		 $query = $this->db->get('daily_entry')->row_object();
		 $s= $this->db->last_query($query);
	   // print_r($s); die('err');
	  
	   return $query;
	   
	}
	
	
	
		public function getGasolineBalance($pid) 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 $daily_no = $shiftdata['daily_no'];
		  
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('*');
		 $this->db->where('daily_shift_id',$shift_id);
		 
		 $this->db->where("user_id", $user_id);
		 $this->db->where('daily_no	',$daily_no);
		 $this->db->where('c_id	',$cid1);
		 $this->db->where('pid	',$pid);
		 $this->db->order_by('date','DESC');
		  $this->db->limit(0, 1);
		 $query = $this->db->get('daily_entry')->row_object();
		 $s= $this->db->last_query($query);
	   // print_r($s); die('err');
	  
	   return $query;
	   
	}
	
	
	
	
		public function getGallonsSold($pid) 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('SUM(sale) as sale_total', FALSE);
		 $this->db->where('daily_shift_id',$shift_id);
		 $this->db->where('pid', $pid);
		 $this->db->where("user_id", $user_id);
		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('date','DESC');
		 $query = $this->db->get('daily_entry')->row_object();
	    $q=$this->db->last_query($query);
	    // print_r($query); die('err');
	   return $query;
	   
	}

	
	
	
	public function getLastEntryRecord($pid) 
	{  
	      $cid = $this->gasolinereceived_model->getCompanyId();
		  $cid1 = $cid['0']->c_id;
		  $shiftdata = $this->getUserShiftData();
		  $user_id = $shiftdata['user_id'];
		  $shift_id = $shiftdata['shift'];
			
		  $this->db->select('*');
          $this->db->from('daily_shift');
          $this->db->join('daily_entry', 'daily_entry.c_id = daily_shift.c_id');
		
		 
		  $this->db->where('daily_shift.status','close');
		  $this->db->where('daily_shift.c_id',$cid1);
		  $this->db->where('daily_entry.pid',$pid);
		 // $this->db->group_by('daily_entry.pid');
		  $this->db->order_by('cd_daily_entry.daily_no' ,'DESC');
		  $this->db->order_by('daily_shift_id ','DESC');

		  //$this->db->order_by('daily_shift.login_time','DESC');
		  $this->db->limit(1); 
		
		  $query = $this->db->get();
		  $q = $this->db->last_query($query);
		  $page=$query->row_object();
	      
		  return $page;
	   
	}
	
	
		public function getRowId() 
	{  
	     $cid = $this->gasolinereceived_model->getCompanyId();
		 $cid1 = $cid['0']->c_id;
		 $shiftdata = $this->getUserShiftData();
		 $user_id = $shiftdata['user_id'];
		 $shift_id = $shiftdata['shift'];
		 $daily_no = $shiftdata['daily_no'];
		 
	     $created_date=  date("Y-m-d H:i:s", time());
		 $this->db->select('*');
		 
		 $this->db->where('daily_shift_id', $shift_id);
		 $this->db->where("user_id", $user_id);
		 $this->db->where("daily_no", $daily_no);
		 $this->db->where('c_id	',$cid1);
		 $this->db->order_by('date','DESC');
		 $query = $this->db->get('daily_entry')->result();
		// $query1=$this->db->last_query($query);
	     // print_r($query1); die('err');
	  
	   return $query;
	   
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
		 
		 
		 	 public function getProductPrice($pid) 
	    {
	         
			$cid = $this->gasolinereceived_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			$this->db->select('s_price');
            $this->db->from('price');
           
			$this->db->where("pid",$pid);
			$this->db->where("c_id",$cid1);
            $query = $this->db->get();
            $page1 = $query->result();
			
            return $page1[0]->s_price;

         }
		 
		 
		  	 public function getProductOldPrice($pid) 
	    {
	         
			$cid = $this->gasolinereceived_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			$current_date = date('Y-m-d');
			$this->db->select('old_price');
            $this->db->from('price');
           
			$this->db->where("pid",$pid);
			$this->db->where("c_id",$cid1);
			$this->db->like('date_modified', $current_date );
            $query = $this->db->get();
            $page1 = $query->result();
			//$q=$this->db->last_query($query);
			//print_r($q);
            return $page1[0]->old_price;

         }
		 
		public function TotalGasSales($shift,$daily_no,$user_id) 
	    {
	         
			$cid = $this->gasolinereceived_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			//$this->db->select('gas_sales');
            //$this->db->from('daily_entry');
            $this->db->where("c_id",$cid1);
			//$this->db->where("pid",$pid);
			$this->db->where("daily_shift_id",$shift);
			$this->db->where("daily_no",$daily_no);
			
			$this->db->where("user_id",$user_id);
            $query = $this->db->get('daily_entry');
            $page1 = $query->row_object();
			
            return $page1;
            
         }
		 
	/*	 
		 public function OldTotalGasSales($shift,$daily_no,$user_id) 
	    {
	         
			$cid = $this->gasolinereceived_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			$this->db->select('gas_sales');
            $this->db->from('daily_entry');
            $this->db->where("c_id",$cid1);
			//$this->db->where("pid",$pid);
			$this->db->where("daily_shift_id",$shift);
			$this->db->where("daily_no",$daily_no);
			
			$this->db->where("user_id",$user_id);
            $query = $this->db->get();
            $page1 = $query->result();
			
            return $page1[0]->old_gas_sales;

         }
		 
		 
		 public function TotalPropaneSales($shift,$daily_no,$user_id) 
	    {
	         
			$cid = $this->gasolinereceived_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			$this->db->select('old_propane_sales');
            $this->db->from('daily_entry');
            $this->db->where("c_id",$cid1);
			//$this->db->where("pid",$pid);
			$this->db->where("daily_shift_id",$shift);
			$this->db->where("daily_no",$daily_no);
			
			$this->db->where("user_id",$user_id);
            $query = $this->db->get();
            $page1 = $query->result();
			
            return $page1[0]->propane_sales;

         }
		 
		 
		  public function OldTotalPropaneSales($shift,$daily_no,$user_id) 
	    {
	         
			$cid = $this->gasolinereceived_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			$this->db->select('old_propane_sales');
            $this->db->from('daily_entry');
            $this->db->where("c_id",$cid1);
			//$this->db->where("pid",$pid);
			$this->db->where("daily_shift_id",$shift);
			$this->db->where("daily_no",$daily_no);
			
			$this->db->where("user_id",$user_id);
            $query = $this->db->get();
            $page1 = $query->result();
			
            return $page1[0]->old_propane_sales;

         }
		 
		 
		  public function TotalGallonsSold($shift,$daily_no,$user_id) 
	    {
	         
			$cid = $this->gasolinereceived_model->getCompanyId();
		    $cid1 = $cid['0']->c_id;
			$this->db->select('total_gallons_sold');
            $this->db->from('daily_entry');
            $this->db->where("c_id",$cid1);
			//$this->db->where("pid",$pid);
			$this->db->where("daily_shift_id",$shift);
			$this->db->where("daily_no",$daily_no);
			
			$this->db->where("user_id",$user_id);
            $query = $this->db->get();
            $page1 = $query->result();
			
            return $page1[0]->total_gallons_sold;

         }
		 
		 */
		 
		 
		 
		 public function getShiftId($pid) 
	    {
	         
			
			$this->db->select('p_name');
            $this->db->from('product');
           
			$this->db->where("id",$pid);
            $query = $this->db->get();
            $page1 = $query->result();
            return $page1[0]->p_name;

         }
		 
		 
		  public function getUserShiftData() 
	    {
	         $company_id = $this->getCompanyId();
			 $cid =  $company_id['0']->c_id;
			
			
            $this->db->where("c_id",$cid);
			$this->db->where("status",'open');
			$this->db->order_by("login_time",'DESC');
            $query = $this->db->get('daily_shift');
            $page1 = $query->row_array();
            return $page1;

         }
		 
		  public function getEndShiftData() 
	    {
	         $company_id = $this->getCompanyId();
			 $cid =  $company_id['0']->c_id;
			
			
            $this->db->where("c_id",$cid);
			$this->db->where("status",'close');
			$this->db->order_by("login_time",'DESC');
            $query = $this->db->get('daily_shift');
            $page1 = $query->row_array();
            return $page1;

         }
		 
		 
		   public function check_InsertUpdate() 
	    {
	         $company_id = $this->getCompanyId();
			 $cid =  $company_id['0']->c_id;
			
			
            $this->db->where("c_id",$cid);
			$this->db->where("status",'open');
			$this->db->order_by("login_time",'DESC');
            $query = $this->db->get('daily_shift');
            $page1 = $query->row_array();
            return $page1;

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
		 
		 
		   public function getNewPrice() 
	    {
	         $company_id = $this->getCompanyId();
			 $cid =  $company_id['0']->c_id;
			 $current_date = date('Y-m-d');
			
          $this->db->select('*');
          $this->db->from('price');
          $this->db->join('product', 'product.id = price.pid');
		
		 
		  $this->db->where('price.c_id', $cid);
		  $this->db->like('price.date_modified', $current_date );
		  
            $query = $this->db->get();
			$q= $this->db->last_query($query);
			//print_r($q); die('errrr');
            $page1 = $query->row_array();
            return $page1;

         }
		 
		 
		 
		   public function getUserPassword() 
	    {
	         $company_id = $this->getCompanyId();
			 $cid =  $company_id['0']->c_id;
			 $shiftdata = $this->getUserShiftData();
		      $user_id = $shiftdata['user_id'];
			  $this->db->select('*');
           
            $this->db->where("id",$user_id);
			$this->db->where("c_id",$cid);
			
            $query = $this->db->get('admins');
			$p = $this->db->last_query( $query);
			
            $page1 = $query->row_array();
            return $page1;

         }
		 
		 
	
		


}
 

?>
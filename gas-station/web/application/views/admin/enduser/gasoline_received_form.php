<?php    
$statusss = $this->admin_login_model->CheckEnduser();
$status = $statusss->status;

if ($status != 'close')
{
	$checkNewprice = $this->daily_shift_model->getNewPrice();
	$c_id  = $this->company_model->getCompanyLoginId();
    $price_change = $this->mainproduct_model->getEnduserData($c_id)->price_change;
?>

<style>
html, body {
    padding-top: 20px;
}

[data-role="dynamic-fields"] > .form-inline + .form-inline {
    margin-top: 0.5em;
}

[data-role="dynamic-fields"] > .form-inline [data-role="add"] {
    display: none;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="add"] {
    display: inline-block;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="remove"] {
    display: none;
}
.ts
{
width:30%;	
}


   .tdwidth
   {width:20%;
   }

</style>


<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left"> 
                <h3>
				&nbsp;<small></small><span style="float:left;"><small><span style="color:BLUE;"><b>Daily No:</b></span>&nbsp;<b><?php echo $this->admin_login_model->getDailyNo()->daily_no;?></b>&nbsp;&nbsp;&nbsp;<span style="color:BLUE;"><b>Date:</b></span>&nbsp;<b><?php echo date('Y-m-d');?></b></small></span>
				</h3>
			<?php if($this->session->flashdata('error')) { ?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $this->session->flashdata('error') ;?>
	</div>
	<?php } 
	if($this->session->flashdata('success')) { ?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">×</button>
		<?php echo $this->session->flashdata('success') ;?>
	</div>
	<?php } 
	if($this->session->flashdata('info')) { ?>
	<div class="alert alert-info">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $this->session->flashdata('info') ;?>
	</div>
	<?php } ?>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
				<!--
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                  </div>
				  -->
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Gasoline Received Entry<small></small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				   
                 <form class="form-horizontal" action="<?php echo base_url('admin/enduser/savegasoline');?>" id="edit_page" name="edit_page"  method="post" autocomplete="off">
	<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div data-role="dynamic-fields">
                <div class="form-inline">
                 
				 <div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="field-value">Image</label>
                        <input  class="form-control" id="p_image[]" name="p_image[]" type="hidden" value='<?php echo set_value('p_image');?>'/>
						<input readonly type="text" name="snap[]" id="snap[]" placeholder="Take Photo" class="form-control" value="<?php echo  $this->daily_shift_model->getSnapImage()['cam_img'];?>" onclick="return popupSnap();">&nbsp;&nbsp;&nbsp;<image src="<?php echo  $this->daily_shift_model->getSnapImage()['cam_img'];?>" width="50px" height="50px"/>
						
                    </div><br/><br/>
				 
				 <div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="field-value">Date</label>
                        <input type="text" readonly required="required" class="form-control" id="datepicker" name="date[]" max=""  required="required" value="<?php echo date('Y-m-d');?>" placeholder="Date">
						
                    </div>
					<div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="field-value">Bol Number</label>
                        <input type="text" class="form-control"   id="bol_no[]" name="bol_no[]" required="required" value="" placeholder="BOL Number">
						
                    </div>
                    
                    <div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="field-value">Amount</label>
                        <input type="number" class="form-control"  max="9999" id="received[]" name="received[]" required="required" value="" placeholder="Quantity">
						
                    </div>
					
					
                        <input type="hidden" class="form-control" id="received_price[]" name="received_price[]" required="required" value="00.00" placeholder="Received Price">
						
                 
					 
					 <div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="field-value">Drops Type</label>
						<select class="form-control" name="pid[]">
						<?php 
					
						foreach ($pid1 as $product)
						{
							
						?>
						
						<option value="<?php echo $product;?>" selected="selected"><?php echo $this->gasolinereceived_model->getProductName($product); ?></option>
						
						
						<?php } ?>
						</select>
						<!-- 
                        <input class="form-control" type="radio" name="type[]" id="type[]"  checked="checked" value="drops">Drops&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-control" type="radio" name="type[]" id="type[]" value="payout">Payout
                   -->
				   </div>
				   
				   
				    
				   <!--
                    <button class="btn btn-danger" data-role="remove">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <button class="btn btn-primary" data-role="add">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
					-->
                </div>  <!-- /div.form-inline -->
            </div>  <!-- /div[data-role="dynamic-fields"] -->
        </div>  <!-- /div.col-md-12 -->
    </div>  <!-- /div.row -->  
	<div>&nbsp;</div>
	<center><button type="submit" name='save_page' value='Save' class="btn btn-success"><i></i>Add</button></center>
</div>
	</form>
	<div style="height:10%;">&nbsp;</div>
	<div class="x_title">
	<h2>Daily Entry<small></small></h2>
	<ul class="nav navbar-right panel_toolbox">
                      
					  
					  
                      
                    </ul>
                    <div class="clearfix"></div>
	</div>
	<div <div style="overflow-x:auto;">
	<form class="form-horizontal" action="<?php echo base_url('admin/enduser/savedaily_shift');?>" id="add_page" name="add_page" method="post" autocomplete="off">
	<table class="footable table table-striped table-bordered table-white table-primary" width="100%"> 
<tr>
	<td>
	<table  style="margin-top:10px;">
	<tr><td><u>&nbsp;</u></td></tr>
	<tr><td><input readonly  type="text"   value="OPEN"></td></tr>
	<tr><td><input readonly  type="text"   value="RECEIVED"></td></tr>
	<tr><td><input readonly  type="text"   value="TOTAL"></td></tr>
	<?php
	if((!empty($checkNewprice)) && ($price_change == 1)) 
	{
	?>
	<tr><td><input readonly  type="text"   value="OLD SALE"></td></tr>
	<?php
	}
	?>
	<tr><td><input readonly  type="text"   value="SALE"></td></tr>
	<tr><td><input readonly  type="text"   value="SALE TAX"></td></tr>
	<tr><td><input readonly  type="text"   value="BALANCE"></td></tr>
	<tr><td><input readonly  type="text"   value="VEEDER ROOT"></td></tr>
	<tr><td><input readonly  type="text"   value="DIFFERENCE"></td></tr>
	
	</table>
	</td>
	<?php 
	$store_sales  =	$this->store_sales_model->getTotalStoreSales()->total_store_sales;
	$store_sale  =  number_format(round((float)$store_sales,2),2);
	$old_gas_sales = $this->daily_shift_model->getGasolineRecords()->old_gas_sales;
	$gas_sales = $this->daily_shift_model->getGasolineRecords()->gas_sales;
	$total_gas_sales = ($gas_sales+$old_gas_sales);
	
	$old_propane_sales = $this->daily_shift_model->getGasolineRecords()->old_propane_sales;
	$propane_sales = $this->daily_shift_model->getGasolineRecords()->propane_sales;
	$total_propane_sales = ($propane_sales+$old_propane_sales);
	
	//$total_store_sale=$this->daily_shift_model->getSumStoreSales->store_total;
	$Credit_cards_totals = $this->daily_shift_model->getSumOfCcard()->ccard_total;
	$old_total_gallons_sold = $this->daily_shift_model->getGasolineRecords()->old_total_gallons_sold;
	$Credit_cards_total  =  number_format(round((float)$Credit_cards_totals,2),2);
	$credit_total = $this->dropspayouts_model->getSumOfAllCreditAmount();
	$credit_totals = $credit_total['total'];
	
	$Drops_totals = $this->daily_shift_model->getSumDropsReceived()->Drops_total;
	
	$Drops_total  =  number_format(round((float)$Drops_totals,2),2);
	$Payouts_totals = $this->daily_shift_model->getSumPayoutsReceived()->Payouts_total;
	$Payouts_total = number_format(round((float)$Payouts_totals,2),2);
	$Amount_availables = ($Credit_cards_totals+$credit_totals+$Drops_totals+$Payouts_totals);
	$Amount_available = number_format(round((float)$Amount_availables,2),2);
	
	$rcount= count($pid1);
    $rcount1= count($pid1)+1;
    $total_gallons_solds = 0;
  foreach ($pid1 as $product)
 {
	 
	 $merged=$this->daily_shift_model->getMergedByPid($product);
     /*
	##------------------- Opens codes starts here ---------------------------------##
   */	
	 $opens = $this->daily_shift_model->getLastEntryRecord($product)->balance;
	// $opens= $data['data'];
	 $open = number_format(round((float)$opens,2),2);
	 $openn =$this->daily_shift_model->getGasolineBalance($product)->open;
	 $opennn = number_format(round((float)$openn,2),2);
	
   
     /*
	##------------------- Received codes starts here ---------------------------------##
   */
	 $receiveds=$this->daily_shift_model->getSumGasolineReceived($product)->received_total;
	 $receivedd = number_format(round((float)$receiveds,2),2);
	 
	 /*
	##------------------- Totals codes starts here ---------------------------------##
   */
     $totals=($opens+$receiveds);
     $total= number_format(round((float)$totals,2),2);	
     $totl = $this->daily_shift_model->getGasolineBalance($product)->total;
	 $totll= number_format(round((float)$totl,2),2);
	 
	 /*
	##------------------- Sales codes starts here ---------------------------------##
   */
	 
	 $old_sale = $this->daily_shift_model->getGasolineBalance($product)->old_sale;
	 
	 $product_price  =	$this->daily_shift_model->getProductPrice($product);
     
     $sales=$this->daily_shift_model->getSumGasolineSale($product)->sale_total;
    
	 $sale= number_format(round((float)$sales,2),2);
	 
	    if($product != 64)
		  {
		    $gas_sales = (($sales)*($product_price));
			$gas_sale += $gas_sales;
		 
		  }
		else
		 {
			if($product == 64)
			{
			$propane_sales = (($sales)*($product_price));
		    }
		}
	
	 $amount_required = ($gas_sale+$store_sales+$propane_sales);
     
	 
	 if($product==64){
		$balances = ($totals+$sales);
	}
	 else{
		 
		$balances = ($totals-$sales);
		 
	 }
	 
	  /*
	##------------------- Sales codes ends here ---------------------------------##
   */
	 $balance= number_format(round((float)$balances,2),2);	

     $vroots=$this->daily_shift_model->getSumGasolineVroot($product)->vroot_total;
     $vroot= number_format(round((float)$vroots,2),2);
     $diff = ($vroots-$balances);
     $different= number_format(round((float)$diff,2),2);
	 $get_gallons_value=$this->daily_shift_model->getGallonsSold($product)->sale_total;
	    
		if($get_gallons_value){
			$total_gallons_solds += $get_gallons_value; 
		}
		$total_gallons = ($total_gallons_solds+$old_total_gallons_sold);
		
		
	 
	?>
	<td>
	<table>
	<tr><td><u><span style="<?php  if($merged == 0){echo 'color:black;';} else{echo'color:blue;';} ?>"><b><?php echo strtoupper($this->gasolinereceived_model->getProductName($product)); ?></b></span></u></td></tr>
	 
	<tr><td><input style="width:90%;"  type="hidden"  name="pid[<?php echo $product ?>]"  value="<?php echo $product ?>">
	<input style="width:90%;"  readonly     value="<?php if($this->daily_shift_model->getGasolineBalance($product)->open == 0.000){ echo '';} else {$this->daily_shift_model->NumberFormat($this->daily_shift_model->getGasolineBalance($product)->open);} ?>" placeholder="<?php ?>"><input type="hidden" style="width:90%;"  readonly   name="open[<?php echo $product ?>]"  value="<?php echo $this->daily_shift_model->getGasolineBalance($product)->open; ?>" placeholder="<?php echo $open;?>"></td></tr>
	<tr><td><input style="width:90%;" readonly type="number" step="0.01"    value="<?php if($this->daily_shift_model->getSumGasolineReceived($product)->received_total == 0.000){echo '';} else{$this->daily_shift_model->NumberFormat($this->daily_shift_model->getSumGasolineReceived($product)->received_total);}?>" placeholder="<?php ?>"><input style="width:90%;" readonly type="hidden" step="0.01"  name="received[<?php echo $product ?>]"  value="<?php echo $this->daily_shift_model->getSumGasolineReceived($product)->received_total;?>" placeholder="<?php echo $receivedd;?>"></td></tr>
	<tr><td><input style="width:90%;"  type="text" readonly     value="<?php if($this->daily_shift_model->getGasolineBalance($product)->total == 0.000){ echo '';}else{ $this->daily_shift_model->NumberFormat($this->daily_shift_model->getGasolineBalance($product)->total);}?>"><input style="width:90%;"  type="hidden" readonly  name="total[<?php echo $product ?>]"   value="<?php echo $this->daily_shift_model->getGasolineBalance($product)->total;?>"></td></tr>
	<?php
	if((!empty($checkNewprice)) && ($price_change == 1))
	{
	?>
	<tr><td><input style="width:90%;"  type="number" step="0.01" min="0" max="<?php echo $totals;?>"   name="old_sale[<?php echo $product ?>]"  value="<?php  $osl=$this->daily_shift_model->getGasolineBalance($product)->old_sale; if($osl==0.000){echo '';} else{echo $osl;}?>" placeholder="<?php echo $sale;?>"></td></tr>
	<?php
	}
	?>
	<tr><td><input style="width:90%;"  type="number" step="0.01" min="0" max="<?php echo $totals;?>"   name="sale[<?php echo $product ?>]"  value="<?php $sl = $this->daily_shift_model->getGasolineBalance($product)->sale; if($sl == 0.00){echo '';}else{echo $sl;}?>" placeholder="<?php ?>"></td></tr>
	<tr><td><input style="width:90%;"  type="number" step="0.01"    name="sale_tax[<?php echo $product ?>]"  value="<?php $sl = $this->daily_shift_model->getGasolineBalance($product)->sale_tax; if($sl == 0.00){echo '';}else{echo $sl;}?>" placeholder="<?php ?>"></td></tr>
	<tr><td><input style="width:90%;"  type="text" readonly    value="<?php if($this->daily_shift_model->getGasolineBalance($product)->balance == 0.000){echo '';}else{$this->daily_shift_model->NumberFormat($this->daily_shift_model->getGasolineBalance($product)->balance);} ?>"><input style="width:90%;"  type="hidden" readonly  name="balance[<?php echo $product ?>]"  value="<?php echo $this->daily_shift_model->getGasolineBalance($product)->balance; ?>"></td></tr>
	<?php if($merged!=1){   ?>
	<tr><td><input style="width:90%;"    type="number" step="0.01"  name="vroot[<?php echo $product ?>]"  value="<?php $vr=$this->daily_shift_model->getGasolineBalance($product)->vroot; if($vr == 0.00){echo '';}else{echo $vr;} ?>" placeholder="<?php ?>"></td></tr>
	<tr><td><input style="width:90%;"  type="text" readonly    value="<?php if($this->daily_shift_model->getGasolineBalance($product)->diff == 0.000){echo '';}else{$this->daily_shift_model->NumberFormat($this->daily_shift_model->getGasolineBalance($product)->diff);}?>"><input style="width:90%;"  type="hidden" readonly  name="diff[<?php echo $product ?>]"  value="<?php echo $this->daily_shift_model->getGasolineBalance($product)->diff;?>"></td></tr>
	<?php } ?>
	</table>
	</td>
	<?php 
						}
	$overshort = ($Amount_availables-$amount_required);
						?>
	<td>
	<table>
	<?php
	if((!empty($checkNewprice)) && ($price_change == 1))
	{
	?>
	<tr><td><input readonly  type="text"   value="OLD GAS SALES"></td></tr>
	<?php
	}
	?>
	<tr><td><input style="font-weight:bold; width:100%;" readonly  type="text"   value="GAS SALES"></td></tr>
	<?php
	if((!empty($checkNewprice)) && ($price_change == 1))
	{
	?>
	<tr><td><input style="font-weight:bold; width:100%;" readonly  type="text"   value="TOTAL GAS SALES"></td></tr>
	<?php
	}
	?>
	<tr><td><input readonly  type="text"   value="STORE SALES"></td></tr>
	<?php
	if((!empty($checkNewprice)) && ($price_change == 1))
	{
	?>
	<tr><td><input readonly  type="text"   value="OLD PROPANE SALES"></td></tr>
	<?php
	}
	?>
	<tr><td><input style="font-weight:bold; width:100%;" readonly  type="text"   value="PROPANE SALES"></td></tr>
	<?php
	if((!empty($checkNewprice)) && ($price_change == 1))
	{
	?>
	<tr><td><input style="font-weight:bold; width:100%;" readonly  type="text"   value="TOTAL PROPANE SALES"></td></tr>
	<?php
	}
	?>
	<tr><td><input style="font-weight:bold; width:100%;" readonly  type="text"   value="AMOUNT REQUIRED"></td></tr>
	<tr><td><input  readonly  type="text"   value="CREDIT TOTAL"></td></tr>
	<tr><td><input  readonly  type="text"   value="DROPS TOTAL"></td></tr>
	<tr><td><input readonly  type="text"   value="CREDIT CARDS"></td></tr>
	
	<tr><td><input  readonly  type="text"   value="PAY-OUTS"></td></tr>
	<tr><td><input style="font-weight:bold; width:100%;" readonly  type="text"   value="AMOUNT AVAILABLE"></td></tr>
	
	</table>
	</td>
	
	<td>
	<table>
	<?php
	if((!empty($checkNewprice)) && ($price_change == 1))
	{
	?>
	<tr><td><input style="width:80%;"  type="text" readonly   value="<?php if($this->daily_shift_model->getGasolineRecords()->old_gas_sales == 0.000){echo '';}else{$this->daily_shift_model->NumberFormat($this->daily_shift_model->getGasolineRecords()->old_gas_sales);} ?>"><input style="width:80%;"  type="hidden" readonly name="old_gas_sales"  value="<?php  echo $this->daily_shift_model->getGasolineRecords()->old_gas_sales; ?>"></td></td></tr>
	<?php
	}
	?>
	<tr><td><input style="width:80%;"  type="text" readonly   value="<?php if($this->daily_shift_model->getGasolineRecords()->gas_sales == 0.000){echo '';}else{ $this->daily_shift_model->NumberFormat($this->daily_shift_model->getGasolineRecords()->gas_sales);}?>"><input style="width:80%;"  type="hidden" readonly name="gas_sales"  value="<?php echo $this->daily_shift_model->getGasolineRecords()->gas_sales;?>"></td></td></tr>
	<?php
	if((!empty($checkNewprice)) && ($price_change == 1))
	{
	?>
	<tr><td><input style="width:80%;"  type="text" readonly   value="<?php $this->daily_shift_model->NumberFormat($total_gas_sales);?>"><input style="width:80%;"  type="hidden" readonly name="total_gas_sales"  value="<?php echo $total_gas_sales;?>"></td></td></tr>
	<?php
	}
	?>
	<tr><td><input style="width:80%;"  type="text" readonly  value="<?php if($store_sales == 0.000){echo '';}else{$this->daily_shift_model->NumberFormat($store_sales);}?>" placeholder="<?php echo $store_sales;?>"><input style="width:80%;"  type="hidden" readonly name="store_sales"  value="<?php echo $store_sales;?>" placeholder="<?php echo $store_sales;?>"></td></tr>
	<?php
	if((!empty($checkNewprice)) && ($price_change == 1))
	{
	?>
	<tr><td><input style="width:80%;"  type="text" readonly   value="<?php if($this->daily_shift_model->getGasolineRecords()->old_propane_sales == 0.000){echo '';}else{$this->daily_shift_model->NumberFormat($this->daily_shift_model->getGasolineRecords()->old_propane_sales);}?>"><input style="width:80%;"  type="hidden" readonly name="old_propane_sales"  value="<?php echo $this->daily_shift_model->getGasolineRecords()->old_propane_sales;?>"></td></tr>
	<?php
	}
	?>
	<tr><td><input style="width:80%;"  type="text" readonly   value="<?php if($this->daily_shift_model->getGasolineRecords()->propane_sales == 0.000){echo '';}else{$this->daily_shift_model->NumberFormat($this->daily_shift_model->getGasolineRecords()->propane_sales);} ?>"><input style="width:80%;"  type="hidden" readonly name="propane_sales"  value="<?php echo $this->daily_shift_model->getGasolineRecords()->propane_sales; ?>"></td></tr>
	<?php
	if((!empty($checkNewprice)) && ($price_change == 1))
	{
	?>
	<tr><td><input style="width:80%;"  type="text" readonly   value="<?php $this->daily_shift_model->NumberFormat($total_propane_sales); ?>"><input style="width:80%;"  type="hidden" readonly name="total_propane_sales"  value="<?php echo $total_propane_sales; ?>"></td></tr>
	<?php
	}
	?>
	<tr><td><input style="width:80%;"  type="text" readonly   value="<?php if($this->daily_shift_model->getGasolineRecords()->amount_required == 0.000){echo '';}else{$this->daily_shift_model->NumberFormat($this->daily_shift_model->getGasolineRecords()->amount_required);}?>"><input style="width:80%;"  type="hidden" readonly name="amount_required"  value="<?php echo $this->daily_shift_model->getGasolineRecords()->amount_required;?>"></td></tr>
	<tr><td><input style="width:80%;"  type="text" readonly   value="<?php if($credit_totals == 0.000){ echo '';}else{ $this->daily_shift_model->NumberFormat($credit_totals);}?>"><input style="width:80%;"  type="hidden" readonly name="credit_total"  value="<?php echo $credit_totals;?>"></td></tr>
	<tr><td><input style="width:80%;"  type="text" readonly   value="<?php if($Drops_totals == 0.000){ echo '';}else{ $this->daily_shift_model->NumberFormat($Drops_totals);}?>"><input style="width:80%;"  type="hidden" readonly name="drops_total"  value="<?php echo $Drops_totals;?>"></td></tr>
	<tr><td><input style="width:80%;"  type="text" readonly   value="<?php if($Credit_cards_totals == 0.00){echo '';} else{echo $Credit_cards_total;} ?>"><input style="width:80%;"  type="hidden"  name="credit_cards"  value="<?php echo $Credit_cards_totals; ?>"></td></tr>
	
	<tr><td><input style="width:80%;"  type="text" readonly   value="<?php if($Payouts_totals == 0.000){echo '';}else{ $this->daily_shift_model->NumberFormat($Payouts_totals);} ?>"><input style="width:80%;"  type="hidden" readonly name="payouts"  value="<?php echo $Payouts_totals; ?>"></td></tr>
	<tr><td><input style="width:80%;"  type="text" readonly   value="<?php if($Amount_availables == 0.000){ echo '';}else{$this->daily_shift_model->NumberFormat($Amount_availables);}?>"><input style="width:80%;"  type="hidden" readonly name="amount_available"  value="<?php echo $Amount_availables;?>"></td></tr>
	
	</table>
	</td>
	
	</tr>
	<tr><td><span style="color:green;">TOTAL GALLONS SOLD:</span></td><td colspan="<?php echo $rcount; ?>"><input  type="text" style="width:20%;" readonly name="total_gallons_sold"  value="<?php 
	if($total_gallons == 0.000){echo '';} else {echo $this->daily_shift_model->NumberFormat($total_gallons); } ?>"></td><td><b><span style="color:green;">OVER</span><span style="color:red;">SHORT</span></b></td><td><input  type="text" readonly   value="<?php if ($this->daily_shift_model->getGasolineRecords()->overshort == 0.000){echo '';} else{$this->daily_shift_model->NumberFormat($this->daily_shift_model->getGasolineRecords()->overshort);}?>"><input  type="hidden" readonly name="overshort"  value="<?php echo $this->daily_shift_model->getGasolineRecords()->overshort;?>"></td></tr>
	<tr><td colspan="<?php echo $rcount1; ?>"><center><button type="submit" name='save_page' value='Save' class="btn btn-success"><i></i>Save Entry</button></center></td><td colspan="2"><center></center></td></tr>
 <?php  foreach ($RowId as $row)
	  {  ?>
		<input type="hidden" name="id[]" value="<?php echo $row->id;?>">
	  <?php }?>
	  <br/>
	  <table width="100%">
	  <tr>
	<td>
	<center><button type="submit" id="close_shift" name='close_shift' value='Save' class="btn btn-primary" onClick="return popupWindow();"><i></i>Close Shift</button></center>
	</td>
	<td> 
	
	<input type="hidden" name="val" id="val1" value="">
	
<center><button type="submit" id="close_daily" name='close_daily' value='Save' class="btn btn-primary" onClick="return popupsWindow();"><i></i>Close Daily</button></center>
	
	</td>
	</tr>
	  </table>
	  <br/>
	</table>
	</form>
	
	
	

	<!-- // Table END -->
	</div>

                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

	<?php
}
	?>
	
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>

	
<script type="text/javascript">

$(document).ready(function(){
 $('#datepicker').daterangepicker({
	 
	
      format: 'YYYY-MM-DD',
          
          singleDatePicker: true,
          showDropdowns: true,
		  calender_style: "picker_4",
		  
		  
        })
		
	$('#datepicker1').daterangepicker({
	 
	
      format: 'YYYY-MM-DD',
          
          singleDatePicker: true,
          showDropdowns: true,
		  calender_style: "picker_4",
		  
		  
        })
		
		
var doc = new jsPDF();
var specialElementHandlers = {
'#editor': function (element, renderer) {
return true;
}
};	
$('#btn').click(function () {
doc.fromHTML($('#content').html(), 15, 15, {
'width': 170,
'elementHandlers': specialElementHandlers
});
doc.save('P/L_reports.pdf');
});

		
		
});

function page_delete(id){
			var r = confirm("Are you sure you want to delete the record?");
			if (r == true) {
			location.href = '<?php echo base_url("admin/enduser/delete");?>/'+id;
			} else {
				return false;
			}
			
	}
	
 
	
function doconfirm()
{
    job=confirm("Are you sure to Close Daily?");
    if(job!=true)
    {
        return false;
    }
}

function doconfirms()
{
    job=confirm("Are you sure to Close Shift?");
    if(job!=true)
    {
        return false;
    }
}

function popupsWindow(){

window.open('<?php echo base_url("admin/enduser/enter_password");?>','popUpWindow','height=400,width=500,left=300,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
return false;
};

  
function popupWindow(){

window.open('<?php echo base_url("admin/enduser/confirm_password");?>','popUpWindow','height=400,width=500,left=300,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
return false;
};

function popupSnap(){

window.open('<?php echo base_url("admin/enduser/camera");?>','popUpWindow','height=400,width=700,left=300,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
return false;
};



function Print()
{
	window.print();
}

 

</script>

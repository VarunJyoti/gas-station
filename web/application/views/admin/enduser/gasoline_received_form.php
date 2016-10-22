<?php    
$statusss = $this->admin_login_model->CheckEnduser();
$status = $statusss->status;

if ($status != 'close')
{
	$checkNewprice = $this->daily_shift_model->getNewPrice();
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

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">	
	
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
	<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Gasoline Receipt Entry<small></small><span style="float:right;"><small><span style="color:BLUE;"><b>Daily No:</b></span>&nbsp;<b><?php echo $this->admin_login_model->getDailyNo()->daily_no;?></b>&nbsp;&nbsp;&nbsp;<span style="color:BLUE;"><b>Date:</b></span>&nbsp;<b><?php echo date('Y-m-d');?></b></small></span>
			</h3>
			<div class="page-bar">

	<!-- Widget -->
	<!--div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body center">
			<p class="lead margin-none">Unlimited Columns &amp; Expandable Rows. Tables for Desktop, Tablet &amp; Mobile. Resize your browser to try them.</p>
		</div>
	</div-->
		
	<h5 class="text-uppercase strong separator bottom margin-none"></h5>
	
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
	<button type="submit" name='save_page' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>Add</button>
</div>
	</form>
	
	<div>&nbsp;</div>
	<div <div style="overflow-x:auto;">
	<form class="form-horizontal" action="<?php echo base_url('admin/enduser/savedaily_shift');?>" id="add_page" name="add_page" method="post" autocomplete="off">
	<table class="footable table table-striped table-bordered table-white table-primary" width="100%"> 
<tr>
	<td>
	<table>
	<tr><td><u>&nbsp;</u></td></tr>
	<tr><td><input readonly  type="text"   value="OPEN"></td></tr>
	<tr><td><input readonly  type="text"   value="RECEIVED"></td></tr>
	<tr><td><input readonly  type="text"   value="TOTAL"></td></tr>
	<?php
	if(!empty($checkNewprice))
	{
	?>
	<tr><td><input readonly  type="text"   value="OLD SALE"></td></tr>
	<?php
	}
	?>
	<tr><td><input readonly  type="text"   value="SALE"></td></tr>
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
	$Credit_cards_totals = $this->daily_shift_model->getGasolineRecords()->credit_cards;
	$old_total_gallons_sold = $this->daily_shift_model->getGasolineRecords()->old_total_gallons_sold;
	$Credit_cards_total  =  number_format(round((float)$Credit_cards_totals,2),2);
	$Drops_totals = $this->daily_shift_model->getSumDropsReceived()->Drops_total;
	$Drops_total  =  number_format(round((float)$Drops_totals,2),2);
	$Payouts_totals = $this->daily_shift_model->getSumPayoutsReceived()->Payouts_total;
	$Payouts_total = number_format(round((float)$Payouts_totals,2),2);
	$Amount_availables = ($Credit_cards_totals+$Drops_totals+$Payouts_totals);
	$Amount_available = number_format(round((float)$Amount_availables,2),2);
	
	$rcount= count($pid1);
    $rcount1= count($pid1)+1;
 
  foreach ($pid1 as $product)
 {
	 $opens = $this->daily_shift_model->getLastEntryRecord($product)->balance;
	// $opens= $data['data'];
	 $open = number_format(round((float)$opens,2),2);
	 $receiveds=$this->daily_shift_model->getSumGasolineReceived($product)->received_total;
	
     $totals=($opens+$receiveds);
     $total= number_format(round((float)$totals,2),2);	
     
	 
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
	<tr><td><u><span style="color:black;"><b><?php echo $this->gasolinereceived_model->getProductName($product); ?></b></span></u></td></tr>
	 
	<tr><td><input style="width:90%;"  type="hidden"  name="pid[<?php echo $product ?>]"  value="<?php echo $product ?>">
	<input style="width:90%;"  readonly   name="open[<?php echo $product ?>]"  value="<?php echo $this->daily_shift_model->getGasolineBalance($product)->open; ?>" placeholder="<?php echo $opens;?>"></td></tr>
	<tr><td><input style="width:90%;" readonly type="number" step="0.01"  name="received[<?php echo $product ?>]"  value="<?php echo $receiveds;?>" placeholder="<?php echo $received;?>"></td></tr>
	<tr><td><input style="width:90%;"  type="text" readonly  name="total[<?php echo $product ?>]"   value="<?php echo $this->daily_shift_model->getGasolineBalance($product)->total;?>"></td></tr>
	<?php
	if(!empty($checkNewprice))
	{
	?>
	<tr><td><input style="width:90%;"  type="number" step="0.01" min="0" max="<?php echo $totals;?>"   name="old_sale[<?php echo $product ?>]"  value="<?php echo $this->daily_shift_model->getGasolineBalance($product)->old_sale;?>" placeholder="<?php echo $sale;?>"></td></tr>
	<?php
	}
	?>
	<tr><td><input style="width:90%;"  type="number" step="0.01" min="0" max="<?php echo $totals;?>"   name="sale[<?php echo $product ?>]"  value="<?php echo $this->daily_shift_model->getGasolineBalance($product)->sale;?>" placeholder="<?php echo $sale;?>"></td></tr>
	<tr><td><input style="width:90%;"  type="text" readonly  name="balance[<?php echo $product ?>]"  value="<?php echo $this->daily_shift_model->getGasolineBalance($product)->balance;?>"></td></tr>
	<?php if($product!=64){   ?>
	<tr><td><input style="width:90%;"    type="number" step="0.01"  name="vroot[<?php echo $product ?>]"  value="<?php echo $this->daily_shift_model->getGasolineBalance($product)->vroot;?>" placeholder="<?php echo $vroot;?>"></td></tr>
	<tr><td><input style="width:90%;"  type="text" readonly  name="diff[<?php echo $product ?>]"  value="<?php echo $this->daily_shift_model->getGasolineBalance($product)->diff;?>"></td></tr>
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
	if(!empty($checkNewprice))
	{
	?>
	<tr><td><input readonly  type="text"   value="OLD GAS SALES"></td></tr>
	<?php
	}
	?>
	<tr><td><input style="font-weight:bold; width:100%;" readonly  type="text"   value="GAS SALES"></td></tr>
	<?php
	if(!empty($checkNewprice))
	{
	?>
	<tr><td><input style="font-weight:bold; width:100%;" readonly  type="text"   value="TOTAL GAS SALES"></td></tr>
	<?php
	}
	?>
	<tr><td><input readonly  type="text"   value="STORE SALES"></td></tr>
	<?php
	if(!empty($checkNewprice))
	{
	?>
	<tr><td><input readonly  type="text"   value="OLD PROPANE SALES"></td></tr>
	<?php
	}
	?>
	<tr><td><input style="font-weight:bold; width:100%;" readonly  type="text"   value="PROPANE SALES"></td></tr>
	<?php
	if(!empty($checkNewprice))
	{
	?>
	<tr><td><input style="font-weight:bold; width:100%;" readonly  type="text"   value="TOTAL PROPANE SALES"></td></tr>
	<?php
	}
	?>
	<tr><td><input style="font-weight:bold; width:100%;" readonly  type="text"   value="AMOUNT REQUIRED"></td></tr>
	<tr><td><input  readonly  type="text"   value="DROPS TOTAL"></td></tr>
	<tr><td><input readonly  type="text"   value="CREDIT CARDS"></td></tr>
	
	<tr><td><input  readonly  type="text"   value="PAY-OUTS"></td></tr>
	<tr><td><input style="font-weight:bold; width:100%;" readonly  type="text"   value="AMOUNT AVAILABLE"></td></tr>
	
	</table>
	</td>
	
	<td>
	<table>
	<?php
	if(!empty($checkNewprice))
	{
	?>
	<tr><td><input style="width:80%;"  type="text" readonly name="old_gas_sales"  value="<?php echo $this->daily_shift_model->getGasolineRecords()->old_gas_sales;?>"></td></td></tr>
	<?php
	}
	?>
	<tr><td><input style="width:80%;"  type="text" readonly name="gas_sales"  value="<?php echo $this->daily_shift_model->getGasolineRecords()->gas_sales;?>"></td></td></tr>
	<?php
	if(!empty($checkNewprice))
	{
	?>
	<tr><td><input style="width:80%;"  type="text" readonly name="total_gas_sales"  value="<?php echo $total_gas_sales;?>"></td></td></tr>
	<?php
	}
	?>
	<tr><td><input style="width:80%;"  type="text" readonly name="store_sales"  value="<?php echo $store_sales;?>" placeholder="<?php echo $store_sales;?>"></td></tr>
	<?php
	if(!empty($checkNewprice))
	{
	?>
	<tr><td><input style="width:80%;"  type="text" readonly name="old_propane_sales"  value="<?php echo $this->daily_shift_model->getGasolineRecords()->old_propane_sales;?>"></td></tr>
	<?php
	}
	?>
	<tr><td><input style="width:80%;"  type="text" readonly name="propane_sales"  value="<?php echo $this->daily_shift_model->getGasolineRecords()->propane_sales;?>"></td></tr>
	<?php
	if(!empty($checkNewprice))
	{
	?>
	<tr><td><input style="width:80%;"  type="text" readonly name="total_propane_sales"  value="<?php echo $total_propane_sales;?>"></td></tr>
	<?php
	}
	?>
	<tr><td><input style="width:80%;"  type="text" readonly name="amount_required"  value="<?php echo $this->daily_shift_model->getGasolineRecords()->amount_required;?>"></td></tr>
	<tr><td><input style="width:80%;"  type="text" readonly name="drops_total"  value="<?php echo $Drops_totals;?>"></td></tr>
	<tr><td><input style="width:80%;"  type="text" name="credit_cards"  value="<?php echo $Credit_cards_totals;?>"></td></tr>
	
	<tr><td><input style="width:80%;"  type="text" readonly name="payouts"  value="<?php echo $Payouts_totals;?>"></td></tr>
	<tr><td><input style="width:80%;"  type="text" readonly name="amount_available"  value="<?php echo $Amount_availables;?>"></td></tr>
	
	</table>
	</td>
	
	</tr>
	<tr><td><span style="color:green;">TOTAL GALLONS SOLD:</span></td><td colspan="<?php echo $rcount; ?>"><input  type="text" style="width:20%;" readonly name="total_gallons_sold"  value="<?php 
			$total_gallons_sold = number_format(round((float)$total_gallons,2),2);	
			echo $total_gallons_sold; ?>"></td><td><b><span style="color:green;">OVER</span><span style="color:red;">SHORT</span></b></td><td><input  type="text" readonly name="overshort"  value="<?php echo $this->daily_shift_model->getGasolineRecords()->overshort;?>"></td></tr>
	<tr><td colspan="<?php echo $rcount1; ?>"><center><button type="submit" name='save_page' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>Save Entry</button></center></td><td colspan="2"><center></center></td></tr>
 <?php  foreach ($RowId as $row)
	  {  ?>
		<input type="hidden" name="id[]" value="<?php echo $row->id;?>">
	  <?php }?>
	  <br/>
	  <table width="100%">
	  <tr>
	<td>
	<center><button type="submit" id="close_shift" name='close_shift' value='Save' class="btn green btn-primary glyphicons circle_ok" onClick="return popupWindow();"><i></i>Close Shift</button></center>
	</td>
	<td> 
	
	<input type="hidden" name="val" id="val1" value="">
	
<center><button type="submit" id="close_daily" name='close_daily' value='Save' class="btn green btn-primary glyphicons circle_ok" onClick="return popupsWindow();"><i></i>Close Daily</button></center>
	
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
	<?php
}
	?>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	
	
<script type="text/javascript">
/*
$(function() {
    // Remove button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
        function(e) {
            e.preventDefault();
            $(this).closest('.form-inline').remove();
        }
    );
    // Add button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
        function(e) {
            e.preventDefault();
            var container = $(this).closest('[data-role="dynamic-fields"]');
            new_field_group = container.children().filter('.form-inline:first-child').clone();
            new_field_group.find('input').each(function(){
                $(this).val('');
            });
            container.append(new_field_group);
        }
    );
});

*/ 

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


$(function() {
    $( "#datepicker" ).datepicker({ minDate: -3, maxDate: "0" ,dateFormat: 'yy-mm-dd'});
	
  });
  
  

</script>
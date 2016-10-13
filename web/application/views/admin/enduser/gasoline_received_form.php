<?php    
$statusss = $this->admin_login_model->CheckEnduser();
$status = $statusss->status;
if ($status != 'close')
{
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
	
<form class="form-horizontal" action="<?php echo base_url('admin/enduser/savegasoline');?>" id="edit_page" method="post" autocomplete="off">
	<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div data-role="dynamic-fields">
                <div class="form-inline">
                 
				 <div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="field-value">Date</label>
                        <input type="date" class="form-control" id="date[]" name="date[]" required="required" value="<?php echo date('Y-m-d');?>" placeholder="Date">
						
                    </div>
					<div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="field-value">Bol Number</label>
                        <input type="text" class="form-control" id="bol_no[]" name="bol_no[]" required="required" value="" placeholder="BOL Number">
						
                    </div>
                    
                    <div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="field-value">Amount</label>
                        <input type="number" class="form-control" id="received[]" name="received[]" required="required" value="" placeholder="Received amount in gallons">
						
                    </div>
					
					<div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="received_price">Received Price</label>
                        <input type="number" class="form-control" id="received_price[]" name="received_price[]" required="required" value="" placeholder="Received Price">
						
                    </div>
					 
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
				   
                    <button class="btn btn-danger" data-role="remove">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <button class="btn btn-primary" data-role="add">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
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
	<form class="form-horizontal" action="<?php echo base_url('admin/enduser/savedaily_shift');?>" id="add_page" method="post" autocomplete="off">
	<table class="footable table table-striped table-bordered table-white table-primary" width="100%"> 
<tr>
	<td>
	<table>
	<tr><td><u>&nbsp;</u></td></tr>
	<tr><td><input readonly  type="text"   value="OPEN"></td></tr>
	<tr><td><input readonly  type="text"   value="RECEIVED"></td></tr>
	<tr><td><input readonly  type="text"   value="TOTAL"></td></tr>
	<tr><td><input readonly  type="text"   value="SALE"></td></tr>
	<tr><td><input readonly  type="text"   value="BALANCE"></td></tr>
	<tr><td><input readonly  type="text"   value="VEEDER ROOT"></td></tr>
	<tr><td><input readonly  type="text"   value="DIFFERENCE"></td></tr>
	
	</table>
	</td>
	<?php 
	$store_sales  =	$this->store_sales_model->getTotalStoreSales()->total_store_sales;
	$store_sale  =  number_format(round((float)$store_sales,2),2);
	$Credit_cards_totals = $this->daily_shift_model->getGasolineRecords()->credit_cards;
	
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
	 $data['data'] 	=	$this->daily_shift_model->getLastEntryRecord($product)->balance;
	 $opens= $data['data'];
	 $open = number_format(round((float)$opens,2),2);
	 $receiveds=$this->daily_shift_model->getSumGasolineReceived($product)->received_total;
	 $received= number_format(round((float)$receiveds,2),2);
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
	?>
	<td>
	<table>
	<tr><td><u><?php echo $this->gasolinereceived_model->getProductName($product); ?></u></td></tr>
	 
	<tr><td><input  type="hidden"  name="pid[<?php echo $product ?>]"  value="<?php echo $product ?>">
	<input    readonly   name="open[<?php echo $product ?>]"  value="<?php echo $opens; ?>"></td></tr>
	<tr><td><input readonly type="number" step="0.01"  name="received[<?php echo $product ?>]"  value="<?php echo $receiveds;?>" placeholder="<?php echo $received;?>"></td></tr>
	<tr><td><input  type="text" readonly  name="total[<?php echo $product ?>]"   value="<?php echo $totals;?>"></td></tr>
	<tr><td><input  type="number" step="0.01" min="0" max="<?php echo $totals;?>"   name="sale[<?php echo $product ?>]"  value="<?php echo $sales;?>" placeholder="<?php echo $sale;?>"></td></tr>
	<tr><td><input  type="text" readonly  name="balance[<?php echo $product ?>]"  value="<?php echo $balances;?>"></td></tr>
	<?php if($product!=64){   ?>
	<tr><td><input  type="number" step="0.01"  name="vroot[<?php echo $product ?>]"  value="<?php echo $vroots;?>" placeholder="<?php echo $vroot;?>"></td></tr>
	<tr><td><input  type="text" readonly  name="diff[<?php echo $product ?>]"  value="<?php echo $diff;?>"></td></tr>
	<?php } ?>
	</table>
	</td>
	<?php 
						}
	$overshort = ($Amount_availables-$amount_required);
						?>
	<td>
	<table>
	<tr><td><input readonly  type="text"   value="GAS SALES"></td></tr>
	<tr><td><input readonly  type="text"   value="STORE SALES"></td></tr>
	<tr><td><input readonly  type="text"   value="PROPANE SALES"></td></tr>
	<tr><td><input readonly  type="text"   value="AMOUNT REQUIRED"></td></tr>
	<tr><td><input readonly  type="text"   value="CREDIT CARDS"></td></tr>
	<tr><td><input readonly  type="text"   value="DROPS TOTAL"></td></tr>
	<tr><td><input readonly  type="text"   value="PAY-OUTS"></td></tr>
	<tr><td><input readonly  type="text"   value="AMOUNT AVAILABLE"></td></tr>
	
	</table>
	</td>
	
	<td>
	<table>
	<tr><td><input  type="text" readonly name="gas_sales"  value="<?php echo $gas_sale;?>"></td></td></tr>
	<tr><td><input  type="text" readonly name="store_sales"  value="<?php echo $store_sales;?>"></td></tr>
	<tr><td><input  type="text" readonly name="propane_sales"  value="<?php echo $propane_sales;?>"></td></tr>
	<tr><td><input  type="text" readonly name="amount_required"  value="<?php echo $amount_required;?>"></td></tr>
	<tr><td><input  type="text" name="credit_cards"  value="<?php echo $Credit_cards_totals;?>"></td></tr>
	<tr><td><input  type="text" readonly name="drops_total"  value="<?php echo $Drops_totals;?>"></td></tr>
	<tr><td><input  type="text" readonly name="payouts"  value="<?php echo $Payouts_totals;?>"></td></tr>
	<tr><td><input  type="text" readonly name="amount_available"  value="<?php echo $Amount_availables;?>"></td></tr>
	
	</table>
	</td>
	
	</tr>
	<tr><td>TOTAL GALLONS SOLD:</td><td colspan="<?php echo $rcount; ?>"><input  type="text" readonly name="total_gallons_sold"  value="<?php 
			$total_gallons_sold = number_format(round((float)$total_gallons_solds,2),2);	
			echo $total_gallons_sold; ?>"></td><td>OVERSHORT</td><td><input  type="text" readonly name="overshort"  value="<?php echo $overshort;?>"></td></tr>
	<tr><td colspan="<?php echo $rcount1; ?>"><center><button type="submit" name='save_page' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>Save</button></center></td><td colspan="2"><center></center></td></tr>
 <?php  foreach ($RowId as $row)
	  {  ?>
		<input type="hidden" name="id[]" value="<?php echo $row->id;?>">
	  <?php }?>
	</table>
	</form>
	<table width="100%">
	<tr>
	<td><form class="form-horizontal" action="<?php echo base_url('admin/enduser/closedaily_shift');?>" id="add_page" method="post" autocomplete="off">
	<center><button type="submit" name='close_page' value='Save' class="btn green btn-primary glyphicons circle_ok" onClick="return doconfirms();"><i></i>Save Final data</button></center>
	</form></td>
	<td> 
	
	
	<form class="form-horizontal" action="<?php echo base_url('admin/enduser/closedaily');?>" id="add_page" method="post" autocomplete="off">
<center><button type="submit" name='close_page' value='Save' class="btn green btn-primary glyphicons circle_ok" onClick="return doconfirm();"><i></i>Close Daily</button></center>
	</form>
	</td>
	<tr>
	</table>
	<br/>

	<!-- // Table END -->
	</div>
	
	
</div>
</div>
</div>
	<?php
}
	?>
<script type="text/javascript">
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

		
		
</script>	
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
			Gasoline Daily Entry records<small></small>
			</h3>
			<div style="overflow-x:auto;">
<div style="float:right;">
     <form class="navbar-form"  action="<?php echo base_url('admin/enduser/viewLast3records');?>" method="GET">
  <tr>
  
    
	  <select name="daily_no" required="required">
	  <option value="">SELECT DAILY</option>
     <?php 
	 
	 $daily = $this->daily_shift_model->getEndShiftData();
	 $daily_no= $daily['daily_no'];
	 print_r($daily_no); 
     for($i=1; $i<= 3; $i++)
     {
		 if ($daily_no == 0) {
          break;
          }

	  ?>  
	  <option value='<?php echo $daily_no;?>'><?php echo $daily_no;?></option>
	 <?php
    $daily_no--;
	
    }
    ?>
    </select>
 </td>
  <td>
   <input type="submit" name="find" value="search">
  </td>
  </tr>
</form>
</div>
	<!-- Widget -->
	<!--div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body center">
			<p class="lead margin-none">Unlimited Columns &amp; Expandable Rows. Tables for Desktop, Tablet &amp; Mobile. Resize your browser to try them.</p>
		</div>
	</div-->
		
	<h5 class="text-uppercase strong separator bottom margin-none"></h5>
	
	
	<div>&nbsp;</div>
	<div style="width:100%;">
	<?php 
	if($Gasoline_Last3Record)
	{
	?>
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
	
    $rcount= count($Gasoline_Last3Record);
    $rcount1= count($Gasoline_Last3Record)+1;
	foreach($Gasoline_Last3Record as $row)
	{

	?>
	<td>
	<table>
	<tr><td><u><?php echo $this->gasolinereceived_model->getProductName($row->pid); ?></u></td></tr>
	 
	<tr><td><input  type="hidden"  name="pid[<?php echo $product ?>]"  value="<?php echo $product ?>">
	<input    readonly   name="open[<?php echo $row->open; ?>]"  value="<?php echo $row->open; ?>"></td></tr>
	<tr><td><input type="number" step="0.01"  readonly name="received"  value="<?php echo $row->received; ?>" placeholder=""></td></tr>
	<tr><td><input  type="text" readonly  name="total"  value="<?php echo $row->total; ?>"></td></tr>
	<tr><td><input  type="number" step="0.01" readonly  name="sale"  value="<?php echo $row->sale;  ?>" placeholder=""></td></tr>
	<tr><td><input  type="text" readonly  name="balance"  value="<?php echo $row->balance; ?>"></td></tr>
	<?php if($row->pid!=64){   ?>
	<tr><td><input  type="number" step="0.01" readonly name="vroot"  value="<?php echo $row->vroot; ?>" placeholder=""></td></tr>
	<tr><td><input  type="text" readonly  name="diff"  value="<?php echo  $row->diff;  ?>"></td></tr>
	<?php } ?>
	</table>
	</td>
	<?php 
						}
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
	<tr><td><input  type="text" readonly name="gas_sales"  value="<?php echo $row->gas_sales; ?>"></td></td></tr>
	<tr><td><input  type="text" readonly name="store_sales"  value="<?php echo $row->store_sales; ?>"></td></tr>
	<tr><td><input  type="text" readonly name="propane_sales"  value="<?php echo $row->propane_sales; ?>"></td></tr>
	<tr><td><input  type="text" readonly name="amount_required"  value="<?php echo $row->amount_required; ?>"></td></tr>
	<tr><td><input  type="text" readonly name="credit_cards"  value="<?php echo $row->credit_cards; ?>"></td></tr>
	<tr><td><input  type="text" readonly name="drops_total"  value="<?php echo $row->drops_total; ?>"></td></tr>
	<tr><td><input  type="text" readonly name="payouts"  value="<?php echo $row->payouts; ?>"></td></tr>
	<tr><td><input  type="text" readonly name="amount_available"  value="<?php echo $row->amount_available; ?>"></td></tr>
	
	</table>
	</td>
	
	</tr>
	<tr><td>TOTAL GALLONS SOLD:</td><td colspan="<?php echo $rcount; ?>"><input  type="text" readonly name="total_gallons_sold"  value="<?php echo $row->total_gallons_sold; ?>"></td><td>OVERSHORT</td><td><input  type="text" readonly name="overshort"  value="<?php echo $row->overshort; ?>"></td></tr>
	 
	</table>
	<?php 
	}
	
	else
	{
	echo "Records Not Found!";	
		
	}
	
	?>
	<br/>

	<!-- // Table END -->
	</div>
	
	
</div>
</div>
</div>
	
	
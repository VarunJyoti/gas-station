<!-- BEGIN CONTENT -->
<?php
if ($status != 'close')
{
	$c_id  = $this->company_model->getCompanyLoginId();
    $price_change_status = $this->mainproduct_model->getEnduserData($c_id)->price_change_status;
	$checkNewprice = $this->daily_shift_model->getNewPrice();
	$price_change = $this->mainproduct_model->getEnduserData($c_id)->price_change;
?>
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
			  Main Product<small></small>
			</h3>
			<div class="page-bar">

	<!-- Widget -->
	<!--div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body center">
			<p class="lead margin-none">Unlimited Columns &amp; Expandable Rows. Tables for Desktop, Tablet &amp; Mobile. Resize your browser to try them.</p>
		</div>
	</div-->
		
	<h5 class="text-uppercase strong separator bottom margin-none"></h5>
	
	
	
	
	
	
	
	<form class="form-horizontal" action="<?php echo base_url('admin/enduser/saveprice');?>" id="edit_page"  method="post" autocomplete="off">
	
	<table class="footable table table-striped table-bordered table-white table-primary">
	
		<!-- Table heading -->
		<thead>
			<tr>
				<th>Sr.</th>
				<th data-class="Title">Product Name</th>
				
				<th data-hide="Heading,tablet">Old Price</th>
				
			    <th data-hide="Heading,tablet">Price</th>
				
				
			</tr>
		</thead>
	
	
	<tbody>
		
			<!-- Table row -->
			 <?php
			 
			
					$s_no =1;
					
					$pid=$this->product_model->getProductID()->pid;
					foreach($page1 as $page)
					{	
						  $price_id=$this->product_model->getProductPriceByID($page->id)->id;
						 $price=$this->product_model->getProductPriceByID($page->id)->price;
						if($price==''){
							$price='00.00';
						}
						$s_price= $this->product_model->getProductPriceByID($page->id)->s_price;
						if($s_price==''){
							$s_price='00.00';
						}
						$old_price= $this->product_model->getProductPriceByID($page->id)->old_price;
						if($old_price==''){
							$old_price='00.00';
						}
						$strtotime = $comp->createtime;
						$date = date('d M Y',$strtotime);
					?>
					
						
						<tr class="gradeX">
						<td><?php echo $s_no; ?></td>
						<td><?php echo $page->p_name; ?></td>
						<input type="hidden"  name="oldd_price[<?php echo $price_id; ?>]"  value="<?php echo $s_price; ?>" placeholder="<?php echo $s_price; ?>">
						<td><input readonly   name="old_price[<?php echo $price_id; ?>]"  value="<?php echo $old_price; ?>" placeholder="<?php echo $old_price; ?>"></td>
						<td><input  name="price[<?php echo $price_id; ?>]"  value="<?php echo $s_price; ?>" placeholder="<?php echo $s_price; ?>"></td>
					    <input type="hidden" name="id[]" value="<?php echo $price_id;?>">
					   
					   
						
					    
						
					<?php
						$s_no++;
					}
				
			 ?> 
<?php
if($price_change_status == 0)
{
?>			 
			<tr><td colspan="4"><center><button type="submit" name='save_page' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>UPDATE</button></center></td></tr>
			<?php
			}
			?>
			<!-- // Table row END -->
			
			
		</tbody>
		<!-- // Table body END -->
		
	</table>
	
	</form>
	

</div>
</div>
</div>
	</div>
	
	<?php

  }
	?>
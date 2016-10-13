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
			Drops & Payouts Entry<small></small>
			</h3>
			<div class="page-bar">

	<!-- Widget -->
	<!--div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body center">
			<p class="lead margin-none">Unlimited Columns &amp; Expandable Rows. Tables for Desktop, Tablet &amp; Mobile. Resize your browser to try them.</p>
		</div>
	</div-->
	
	<h5 class="text-uppercase strong separator bottom margin-none"></h5>

	<form class="form-horizontal" action="<?php echo base_url('admin/enduser/savedrops');?>" id="edit_page" method="post" autocomplete="off">
		
	<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div data-role="dynamic-fields">
                <div class="form-inline">
                    <div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="field-name">Name</label>
                        <input type="text" required="required" class="form-control" id="name[]" name="name[]" value="" placeholder="Name">
                    </div>
					
                    
                    <div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="field-value">Amount</label>
                        <input type="text" required="required" class="form-control" id="amount[]" name="amount[]" value="" placeholder="Amount">
                    </div>
					 
					 <div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="field-value">Drops Type</label>
						<select class="form-control" name="type[]" id="type[]">
						<option value="received" selected="selected">Drops (Cash Received)</option>
						<option value="cash">Payouts (Cash, Credit)</option>
						
						</select>
						
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
	<div>
	<table class="footable table table-striped table-bordered table-white table-primary">
	
		<!-- Table heading -->
		<thead>
			<tr>
				<th>Drops</th>
				<th data-class="Title">Amount</th>
				<th data-hide="Heading,tablet">name</th>
				<th data-hide="Heading,tablet" colspan="2">Pay-Outs & Credits</th>
				
				<th data-hide="Heading,tablet">Amount</th>
				
				
			
				
				
			</tr>
		</thead>
		<!-- // Table heading END -->
		
		<!-- Table body -->
		<tbody>
	
			<!-- Table row -->
			 <?php
				
				$drop_count=count($drops);
				$payout_count=count($payouts);
				
					
				
					
					$row_counter=($drop_count > $payout_count)?$drop_count:$payout_count;
					
					
						for($row_count=0;$row_count<$row_counter;$row_count++){
						
						$strtotime = $comp->createtime;
						$date = date('d M Y',$strtotime);
						
						$drops_total+=$drops[$row_count]->amount;
						$payouts_total+=$payouts[$row_count]->amount;
						
						
						echo ' <tr class="gradeX">';
						
						echo " <td>".($row_count+1)."</td>";
						echo " <td>";
						if(!empty($drops[$row_count]->name)){
						echo number_format(round($drops[$row_count]->amount,2),2);
						}
						echo "</td>";
						echo " <td>";
						if(!empty($drops[$row_count]->name)){
						echo $drops[$row_count]->name."<br>
						<a class='' href='".base_url("admin/enduser/edit_drops_payouts/".$drops[$row_count]->id."/")."'>Edit</a>
							<a class='' href='javascript:void(0)' onclick='page_delete(".$drops[$row_count]->id.")' ><i class='icon-trash icon-white'></i> Delete</a>
					";
						}
						echo "</td>";
						echo " <td></td>";
						echo " <td>";
						if(!empty($payouts[$row_count]->name)){
						echo $payouts[$row_count]->name."<br>
						<a class='' href='".base_url("admin/enduser/edit_drops_payouts/".$payouts[$row_count]->id."/")."'>Edit</a>
							<a href='javascript:void(0)' onclick='page_delete(".$payouts[$row_count]->id.")' ><i class='icon-trash icon-white'></i> Delete</a>
					
						";
						}
						echo "</td>";
						echo " <td>";
						if(!empty($payouts[$row_count]->name)){
						echo number_format(round($payouts[$row_count]->amount,2),2);
						}
						echo "</td>";
						
						
						echo " </tr>";
						
					}
					
					
						
						
						?>    
						<tr>
						<td>Drops Total:</td><td><b><?php  echo number_format(round((float)$drops_total,2),2); ?></b></td><td>&nbsp;</td>
						<td colspan="2">Payouts Total:</td><td><b><?php  echo number_format(round((float)$payouts_total,2),2); ?></b></td>
						</tr>
			
			<!-- // Table row END -->
			
			
		</tbody>
		<!-- // Table body END -->
		
	</table>
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
		
		
</script>
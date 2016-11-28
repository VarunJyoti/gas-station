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

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left"> 
                <h3>Entry Management</h3>
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
                    <h2>Store Sales Entry<small></small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <form class="form-horizontal" action="<?php echo base_url('admin/enduser/save_store_sales');?>" id="edit_page" method="post" autocomplete="off">
		
	<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div data-role="dynamic-fields">
                <div class="form-inline">
                    <div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="field-value">Quantity</label>
                        <input type="number" class="form-control" id="quantity[]" name="quantity[]" required="required" value="" placeholder="Quantity">
						
                    </div>
					 
					 <div class="form-group" style="padding: 0 20px 0 20px;">
                        <label class="sr-only" for="field-value">Product Name</label>  
						<select class="form-control" name="pid[]">
						
						<?php 
					     
						foreach ($pid1 as $product)
						{
							
						?>
						
						<option value="<?php echo $product->id;?>" selected="selected"><?php echo $this->gasolinereceived_model->getProductName($product->id); ?></option>
						
						
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
	<button type="submit" name='save_page' value='Save' class="btn btn-success"><i></i>Add</button>
</div>
	</form>
	<div>&nbsp;</div>
	<div>
	<table class="footable table table-striped table-bordered table-white table-primary">
	
		<!-- Table heading -->
		<thead>
			<tr>
				<th>Sr. No.</th>
				<th data-class="Title">Product Name</th>
				<th data-hide="Heading,tablet">Product Price</th>
				<th data-hide="Heading,tablet">Quantity</th>
				<th data-hide="Heading,tablet">Total Amount</th>
				<th data-hide="Heading,tablet">Action</th>
				
				
				
			
				
				
			</tr>
		</thead>
		<!-- // Table heading END -->
		
		<!-- Table body -->
		<tbody>
	
			<!-- Table row -->
			 <?php
			 $i= 1;
				foreach ($store_sales_data as $row)
						
						{
							$total_store_sales += $row->total_price ;
				?>
					
				
					
					 <tr class="gradeX">
						
              <td><?php echo $i;?></td><td><?php echo $this->gasolinereceived_model->getProductName($row->pid); ?></td><td><?php echo $row->p_price;?></td><td><?php echo $row->quantity;?></td><td><?php echo $row->total_price;?></td><td><?php echo "<a class='' href='".base_url("admin/enduser/edit_store_sales/".$row->id."/")."'>Edit</a>"; ?>&nbsp; <?php echo "<a class='' href='javascript:void(0)' onclick='page_delete(".$row->id.")' ><i class='icon-trash icon-white'></i> Delete</a>";?></td>
						
						</tr>
						
					
					
					<?php 
						$i++;
						}
					?>
						
						
						   
						<tr>
						<td colspan="4"> <span style="float:right;">Total store sales:</span></td><td><b><?php echo number_format(round((float)$total_store_sales,2),2); ?></b></td><td></td>
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
            </div>
          </div>
        </div>
        <!-- /page content -->


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
			location.href = '<?php echo base_url("admin/enduser/deletestore_sales");?>/'+id;
			} else {
				return false;
			}
			
	}
		
		
</script>
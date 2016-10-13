<style>
	.alert{
		background:red;
	}
	.error{
		color: red !important;
	}
	.txtleft{
		margin-left:10px;
		width:80px;
		align:center;
	}
	</style>
<?php
$usr_type = loginUser();
?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">	
	
<?php
if($this->session->flashdata('error')) {
	echo $this->session->flashdata('error');
}elseif($this->session->flashdata('success')) {
	echo $this->session->flashdata('success');
}elseif($this->session->flashdata('info')) {
	echo $this->session->flashdata('info');
}?>

<h3 class="page-title">
Edit Company  <small></small>
</h3>
<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>admin/page/">Company Management</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<!--li>
						<a href="#">Data Tables</a>
						<i class="fa fa-angle-right"></i>
					</li-->
					<li>
						<a href="#">Edit Company</a>
					</li>
				</ul>
				
			</div>
<div class="row">
	<div class="col-md-12">
	<!-- BEGIN VALIDATION STATES-->
	<div class="portlet box blue">
	<div class="portlet-title">
	<div class="caption">
	<i class="fa fa-gift"></i>Edit Company
	</div>

	</div>
	<div class="portlet-body form">				
	<!-- Form -->
	<form class="form-horizontal" action="<?php echo base_url('admin/company/save');?>" id="edit_page" method="post" autocomplete="off">
		<input class="form-control" id="id" name="id" type="hidden" value='<?php echo $page->id;?>'/>
		<!-- Widget -->
		<div class="form-body">
							
		<div class="form-group">
			<label class="control-label col-md-3" for="title">Name<span class="required">* </span></label>
			<div class="col-md-4"><input class="form-control" id="name" value="<?php echo $page->name;?>" name="name" type="text" /><?php echo form_error('title'); ?></div>
		</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="html_title">Email<span class="required">* </span></label>
							<div class="col-md-4"><input readonly class="form-control" id="email" name="email" type="email" value='<?php echo $page->email;?>'/><?php echo form_error('email'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<?php	
				if($usr_type == 'super')
				{
					?>
						<div class="form-group">
							<label class="control-label col-md-3" for="p_id[]">Gasoline products<span class="required">* </span></label>
							<div class="col-md-4">
							
						
						     <b> All product</b><br/>
						
							<?php 
							$selected_products= unserialize($page->p_id);
							foreach ($products as $all_pname) {
							$product_id=$all_pname->id;
							?>
								<input type="checkbox"  name="p_id[]" value="<?php echo $all_pname->id;?>"   <?php if ((in_array($product_id, $selected_products)  )){echo 'checked';} ?> ><label><?php echo $all_pname->p_name ; ?></label>
						   <?php  }?>
							
							
							</div> 
						</div>
						   
						
						<!-- Group >
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">No. of shift<span class="required">* </span></label>
							<div class="col-md-4">
							<select name="shift" id="shift" class="form-control">
							<option value="1" selected="selected">1</option>
							<option value="2">2</option>
							<option value="2">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							</select>
							</div>
						</div-->
						<!-- // Group END -->
						
						
			<?php } ?>
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Address</label>
							<div class="col-md-4"><input class="form-control" id="address" name="address" type="text" value='<?php echo $page->address;?>'/><?php echo form_error('heading'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Pin<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="pin" name="pin" type="text" value='<?php echo $page->pin;?>'/><?php echo form_error('heading'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Contact<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="contact" name="contact" type="text" value='<?php echo $page->contact;?>'/><?php echo form_error('heading'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Username<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" readonly  id="username" name="username" type="text" value='<?php echo $page->username;?>'/><?php echo form_error('heading'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Password<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control"  id="password" name="password" type="password" value='<?php echo $page->password;?>'/><?php echo form_error('password'); ?></div>
						</div>
						<!-- // Group END -->

						<!-- Group -->
						<?php	
				if($usr_type == 'super')
				{
					?>
						<div class="form-group">
							<label class="control-label col-md-3">Status :</label>
							<div class="col-md-4">
								<label><input type="radio" name="status" id="status" value="1" <?php if($page->status==1) echo 'checked="checked"';?>/>
									Active </label>
									<label><input type="radio" name="status" value="0" id="status" <?php if($page->status==0) echo 'checked="checked"';?>/>
										Disable </label>
							</div>
						</div>
			<?php } ?>
						<!-- // Group END -->
						
						<!-- Group -->
						<?php	
				if($usr_type == 'admin')
					{
						?>
						<div class="form-group">
							<label class="control-label col-md-3">Status :</label>
							<div class="col-md-4">
							<label>
							<?php
							if($page->status==1) 
							{
							echo '<input type="radio" name="status" id="status" value="1" checked="checked"/>Active';	
							}
							else
							{
								echo '<input type="radio" name="status" value="0" id="status" checked="checked"/>Disable';
							}
							?>
								
							</div>
						</div>
						<?php
}
?>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					
					
				
				<!-- // Row END -->
			
				<!-- Row -->
				<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" name='save_page' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>Edit</button>
						<a href="<?php echo base_url('/admin/company');?>"><button type="button" class="btn btn-icon btn-default glyphicons circle_remove" ><i></i>Cancel</button></a>
					</div>
					</div>
				</div>
				
		
	</form>
	<!-- // Form END -->
	</div>
		</div>
		<!-- // Widget END -->
			
</div>	
</div>	
</div>	
</div>	
<script src="<?php echo base_url('/common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js');?>"></script>
       
<script>
$(document).ready(function(){  


    $("#edit_page").validate({
        rules: {
            
			"name": {
                required: true
            } ,
			"pin": {
                required: true
            },
			"contact": {
                required: true,
				number: true,
				maxlength: 12,
				minlength:8
            },
			"p_id[]": {
                required: true
            },
			"shift": {
                required: true
            }
        }
    });

});




</script>
	
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">	


<h3 class="page-title">
Edit User  <small></small>
</h3>
	
<?php
if($this->session->flashdata('error')) {
	echo $this->session->flashdata('error');
}?>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo base_url();?>admin/adminUser/">Admin Management</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<!--li>
			<a href="#">Data Tables</a>
			<i class="fa fa-angle-right"></i>
		</li-->
		<li>
			<a href="#">Edit Sub Admin</a>
		</li>
	</ul>
	
</div>
<div class="row">
<div class="col-md-12">
	<!-- BEGIN VALIDATION STATES-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-gift"></i>Edit User
			</div>
			
		</div>
		<div class="portlet-body form">	
		<form class="form-horizontal margin-none" action="<?php echo base_url('admin/adminUser/save_edit');?>" id="validateSubmitForm" method="post" autocomplete="off">
			<input class="span12" id="id" name="id" type="hidden" value='<?php echo $admin->id;?>'/>
			<div class="form-body">
				<div class="form-group">
					<label class="control-label col-md-3" for="first_name">First name <span class="required">* </span></label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="first_name" value="<?php echo $admin->first_name;?>" name="first_name"/>
						<?php echo form_error('first_name'); ?>
						<!--span class="help-block">
						Something may have gone wrong </span-->
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="last_name">Last name <span class="required">* </span></label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="last_name" value="<?php echo $admin->last_name;?>" name="last_name"/>
						<?php echo form_error('last_name'); ?>
						<!--span class="help-block">
						Something may have gone wrong </span-->
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="email">E-mail <span class="required">* </span></label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="email" value='<?php echo $admin->email;?>' name="email"/>
						<?php echo form_error('email'); ?>
						<!--span class="help-block">
						Something may have gone wrong </span-->
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="password">Password <span class="required">* </span></label>
					<div class="col-md-4">
						<input type="password" class="form-control" id="password" value="test_password" name="password"/>
						<?php echo form_error('password'); ?>
						<!--span class="help-block">
						Something may have gone wrong </span-->
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="confirm_password">Confirm Password <span class="required">* </span></label>
					<div class="col-md-4">
						<input type="password" class="form-control" id="confirm_password" value="test_password" name="confirm_password"/>
						<?php echo form_error('confirm_password'); ?>
						<!--span class="help-block">
						Something may have gone wrong </span-->
					</div>
				</div>
				
						<!-- Group -->
						<!--div class="control-group">
							<label class="control-label" for="type">User Type</label>
							
							<div class="controls">
								<select class="span12" id="type" name="type" type="type">
								<option value=''>Select Type</option>
								<?php // echo $this->types_model->typesDrop($admin->type);?>
								</select>
								<?php //echo form_error('type'); ?>
							</div>
						</div-->
						<!-- // Group END -->
					<div class="form-group">
						<label class="control-label col-md-3">Status <span class="required">* </span>
						</label>
						<?php
						$status = $admin->status;
						$status_arr = array(1=>'Live',0=>'Suspend');
						?>
						<div class="col-md-4 has-success">
							<select class="form-control" name="status">
								<?php foreach($status_arr as $key=>$row){
								$select = '';
								if($status == $key)
									$select = 'selected';
								?>
								<option <?php echo $select; ?> value='<?php echo $key; ?>'><?php echo $row; ?></option>
								<?php }?>
							</select>
						</div>
					</div>	
				</div>
					
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" name='edit_profile' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>Save</button>
							<button type="button" class="btn default" onClick="window.location='<?php echo base_url('admin/adminUser/');?>';">cancel</button>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>	
	</div>
</div>
</div>
	<script>
$(function()
{
	// validate signup form on keyup and submit
	$("#validateSubmitForm").validate({
		rules: {
			first_name: "required",
			last_name: "required",
			
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			}
			
		},
		messages: {
			first_name: "Please enter your firstname",
			last_name: "Please enter your lastname",
			
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: "Please enter a valid email address"
			
		},
		errorClass: "help-block help-block-error",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        }
	});

});

$(document).ready(function(){
	$("#email").blur(function(){
		var email = $(this).val();
		var id = '<?php echo $admin->id ;?>';
		$.post(BASE_URL+'admin/adminUser/checkEmail',
			{ 'email':email,'id':id },
		// when the Web server responds to the request
			function(result) {
				// clear any message that may have already been written
				//$('#email').replaceWith('');
				
				// if the result is TRUE write a message to the page
				if (result == '2') {
				  $('#email').val('');
				  $('#email').after('<div id="bad_name" style="color:red;">' +
					'<p>(Email already exists. Please use other email address.)</p></div>');
				}else{
					$('#bad_name').replaceWith();
					
				}
			}
		);		
	});
});

	</script>

	
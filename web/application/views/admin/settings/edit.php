<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">	
	
<?php
if($this->session->flashdata('error')) {
	echo $this->session->flashdata('error');
}?>

<h3 class="page-title">
Edit Profile  <small></small>
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
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo base_url();?>admin/home/">Dashboard</a>
			<i class="fa fa-angle-right"></i>
		</li>
		
		<li>
			<a href="#">Edit Profile</a>
		</li>
	</ul>
	
</div>
<div class="row">
<div class="col-md-12">
	<!-- BEGIN VALIDATION STATES-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-gift"></i>Edit Profile
			</div>
			
		</div>
		<div class="portlet-body form">	
	<!-- Form -->
	<form class="form-horizontal" action="<?php echo base_url('admin/settings/save');?>" id="validateSubmitForm" method="post" autocomplete="off">
		<input class="span12" id="id" name="id" type="hidden" value='<?php echo $admin->id;?>'/>
		<input class="span12" id="status" name="status" type="hidden" value='<?php echo $admin->status;?>'/>
		
		<div class="form-body">
				<div class="form-group">
					<label class="control-label col-md-3" for="first_name">Name <span class="required">* </span></label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="first_name" value="<?php echo $admin->first_name;?>" name="first_name"/>
						<?php echo form_error('first_name'); ?>
						<!--span class="help-block">
						Something may have gone wrong </span-->
					</div>
				</div>
				<!--div class="form-group">
					<label class="control-label col-md-3" for="last_name">Last name <span class="required">* </span></label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="last_name" value="<?php echo $admin->last_name;?>" name="last_name"/>
						<?php echo form_error('last_name'); ?>
						
					</div>
				</div-->
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
						<input type="password" class="form-control" id="password" value="<?php echo $admin->password;?>" name="password"/>
						<?php echo form_error('password'); ?>
						<input type="hidden" class="form-control" id="old_password" value="<?php echo $admin->password;?>" name="old_password"/>
						<!--span class="help-block">
						Something may have gone wrong </span-->
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="confirm_password">Confirm Password <span class="required">* </span></label>
					<div class="col-md-4">
						<input type="password" class="form-control" id="confirm_password" value="<?php echo $admin->password;?>" name="confirm_password"/>
						<?php echo form_error('confirm_password'); ?>
						<!--span class="help-block">
						Something may have gone wrong </span-->
					</div>
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" name='edit_profile' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>Save</button>
							<button type="reset" class="btn default">Reset</button>
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
	</script>

	
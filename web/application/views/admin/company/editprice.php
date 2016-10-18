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
	<form class="form-horizontal" action="<?php echo base_url('admin/company/saveprice');?>" id="edit_page" method="post" autocomplete="off">
		<input class="form-control" id="p_id" name="p_id" type="hidden" value='<?php echo $this->uri->segment(4);?>'/>
		<!-- Widget -->
		<div class="form-body">
							
				<!-- // Group END -->
						
						
						
						<!-- Group -->
						<?php	
				if($usr_type == 'admin')
   {
				?>
						<div class="form-group">
							<label class="control-label col-md-3" for="pro_name">Product Name <span class="required">* </span></label>
							<div class="col-md-4">
				<div class="col-md-4"><input class="form-control" readonly  value="<?php if($page->p_name){echo $page->p_name;}else{echo $page;}?>" name="pro_name" type="text" /><?php echo form_error('title'); ?></div>
							
							</div>
						</div>
					<div class="form-group">
							<label class="control-label col-md-3" for="title">Price<span class="required">* </span></label>
							<div class="col-md-4">
				<div class="col-md-4"><input class="form-control" id="price" value="<?php echo $page->price;?>" name="price" type="text" /><?php echo form_error('title'); ?></div>
							
							</div>
						</div>
						
						<input class="form-control" id="old_price"  value="<?php echo $page->old_price;?>" name="old_price" type="hidden" />
						
				<?php
   }
?>				
					</div>
					<!-- // Column END -->
					
					
					
				
				<!-- // Row END -->
			
				<!-- Row -->
				<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" name='save_page' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>Edit</button>
						<a href="<?php echo base_url('admin/company/');?>"><button type="button" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>Cancel</button></a>
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

            
$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
    
    //$('select').select2();  
    
    // Form Validation
    $("#edit_page").validate({
        rules: {
            name: "required",
            email: "required",
            pin: "required", 
			username: "required",

password: {

				required: true,

				minlength: 5

			}, 

confirm_password: {

				required: true,

				minlength: 5,

				equalTo: "#password"

			},			

        },
        messages: {
            name: "Please Enter Name",
            email: "Please enter Email",
            pin: "Please enter Pin",
            username: "Please enter username",			

    
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
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('error');
            $(element).parents('.form-group').addClass('success');
        }
    });


});

</script>		
	
	
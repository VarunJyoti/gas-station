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
	.txt1{
		
		width:60%;
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
Edit Gasoline Received  <small></small>
</h3>
<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>admin/enduser/">Gasoline Received</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<!--li>
						<a href="#">Data Tables</a>
						<i class="fa fa-angle-right"></i>
					</li-->
					<li>
						<a href="#">Edit Entry</a>
					</li>
				</ul>
				
			</div>
<div class="row">
	<div class="col-md-12">
	<!-- BEGIN VALIDATION STATES-->
	<div class="portlet box blue">
	<div class="portlet-title">
	<div class="caption">
	<i class="fa fa-gift"></i>Edit Entry
	</div>

	</div>
	<div class="portlet-body form">				
	<!-- Form -->
	<form class="form-horizontal" action="<?php echo base_url('admin/enduser/savegasoline');?>" id="edit_page" method="post" autocomplete="off">
	<input class="form-control" id="id" name="id" type="hidden" value='<?php echo $page->id;?>'/>
	<!-- Table -->
	<table class="footable table table-striped table-bordered table-white table-primary">
	
		<!-- Table heading -->
		<thead>
		<tr>
				<th></th>
				
			
				
				<th></th>
				
				
				
			</tr>
			<tr>
				
				<th data-class="Title">Amount</th>
				<th data-hide="Heading,tablet">Product name</th>
				<th data-hide="Heading,tablet">Product name</th>
				
				
			
				
				
			</tr>
		</thead>
		<!-- // Table heading END -->
		
		<!-- Table body -->
		<tbody>
		
			<!-- Table row -->
			
						
						<tr class="gradeX">
						
						 <td><input class="txt" type="text" name="received" id="received" placeholder="Amount" value="<?php echo $page->received;?>"></td>
						<td>
						
						<select name="pid" class="txt1">
						<option value="<?php echo $page->pid;?>" selected="selected"><?php echo $page->pid;?></option>
						<option value="1">Regular</option>
						<option value="2">Super</option>
						<option value="3">Diesel</option>
						<option value="4">propane</option>
						
						</select>
						</td>
						
						
						 
						
						
						
						
						
					
				 <tr class="gradeX">
					<td>
					<button type="submit" name='save_page' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>Update</button>
						</td>
						
					</tr>
				
			
			<!-- // Table row END -->
			
			
		</tbody>
		<!-- // Table body END -->
		
	</table>
	<!-- // Table END -->
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
	
	
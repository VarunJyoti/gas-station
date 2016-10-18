<?php 
$CKEditor = new CKEditor(base_url()."ckeditor/");  
//$CKEditor->config['height'] = 200;
										
$CKEditor->config['width'] = '@@screen.width * 0.6';                           
										
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
Add New Product  <small></small>
</h3>
<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>admin/product/">Product Management</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<!--li>
						<a href="#">Data Tables</a>
						<i class="fa fa-angle-right"></i>
					</li-->
					<li>
						<a href="#">Add product</a>
					</li>
				</ul>
				
			</div>
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN VALIDATION STATES-->
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i>Add product
					</div>
					
				</div>
				<div class="portlet-body form">			
	<!-- Form -->
	<!--<form class="form-horizontal margin-none" ng-controller="FrmController" id="validateSubmitForm" method="post" autocomplete="off">
	 --><form class="form-horizontal" action="<?php echo base_url('admin/product/save');?>" id="add_page" method="post" enctype="multipart/form-data">
		<div class="form-body">
		<input class="form-control" id="id" name="id" type="hidden" value=''/>
		<!-- Widget -->
		
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="title">Product Name<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="p_name" value="<?php echo set_value('p_name');?>" name="p_name" type="text" /><?php echo form_error('p_name'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="title">Product Category<span class="required">* </span></label>
							<div class="col-md-4"><select name="p_cat" id="p_cat">
							<option value="o" selected>Select Product Category</option>
							<option value="Cat 1">cat 1</option>
							<option value="cat 2">cat 2</option>
							<option value="Cat 3">cat 3</option>
							<option value="cat 4">cat 4</option>
							</select>
							
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="title">Product Price<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="p_price" value="<?php echo set_value('p_price');?>" name="p_price" type="text" /><?php echo form_error('p_price'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="html_title">Product Image<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="p_image" name="p_image" type="file" value='<?php echo set_value('p_image');?>'/><?php echo form_error('p_image'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Product Description</label>
							
							<div class="col-md-4">

								   <div>

									<?php 

										$CKEditor->config['width'] = '@@screen.width * 0.5';                           

											

										$CKEditor->editor("_p_desc", "<p></p>"); 

									?> 





								   </div>

								</div>
							
						</div>
						<!-- // Group END -->
						
						
						
						
						<!--
						div class="form-group">
							<label class="control-label col-md-3">Image :</label>
								<div class="col-md-4">
								  <input type="file" id="images" name="images" />
								</div>
						</div-->
						
						
						
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3">Status :</label>
							<div class="col-md-4">
								<label><input type="radio" name="status" id="status" value="1" checked="checked"/>
									Active </label>
									<label><input type="radio" name="status" value="0" id="status"/>
										Disable </label>
							</div>
						</div>
						<!-- // Group END -->
						//<input type="hidden" name="c_id" id="c_id" value="<?php  ?>">
						
					</div>
				<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" name='save_page' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>Save</button>
						<button type="reset" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>Cancel</button>
					</div>
					</div>
				</div>	
				
				<!-- // Form actions END -->
				
		
		
	</form>
	<!-- // Form END -->
	
</div>	
</div>	
</div>	
	</div>
		</div>
		</div>
		<!-- // Widget END -->
	<script type="text/javascript" src="<?php echo base_url('/common/theme/scripts/plugins/forms/jquery-validation/dist/jquery.validate.min.js');?>"></script>
   

       
       
       
<script>
$(document).ready(function(){  

            
$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
    
    //$('select').select2();  
    
    // Form Validation
    $("#add_page").validate({
        rules: {
            p_name: "required",
            p_image: "required",
			
			
            
			
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
            p_name: "Please Enter Product Name",
            p_image: "Please upload product Image",
			
		
            
            
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

	
		
	
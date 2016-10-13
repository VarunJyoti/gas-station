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
Add New Page  <small></small>
</h3>
<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>admin/page/">Page Management</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<!--li>
						<a href="#">Data Tables</a>
						<i class="fa fa-angle-right"></i>
					</li-->
					<li>
						<a href="#">Add Page</a>
					</li>
				</ul>
				
			</div>
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN VALIDATION STATES-->
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i>Add Page
					</div>
					
				</div>
				<div class="portlet-body form">			
	<!-- Form -->
	<!--<form class="form-horizontal margin-none" ng-controller="FrmController" id="validateSubmitForm" method="post" autocomplete="off">
	 --><form class="form-horizontal" action="<?php echo base_url('admin/pages/save');?>" id="add_page" method="post">
		<div class="form-body">
		<input class="form-control" id="id" name="id" type="hidden" value=''/>
		<!-- Widget -->
		
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="title">Page Title</label>
							<div class="col-md-4"><input class="form-control" id="title" value="<?php echo set_value('title');?>" name="title" type="text" /><?php echo form_error('title'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="html_title">HTML Title</label>
							<div class="col-md-4"><input class="form-control" id="html_title" name="html_title" type="text" value='<?php echo set_value('html_title');?>'/><?php echo form_error('html_title'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Heading</label>
							<div class="col-md-4"><input class="form-control" id="heading" name="heading" type="text" value='<?php echo set_value('heading');?>'/><?php echo form_error('heading'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="meta_title">Meta Title</label>
							<div class="col-md-4"><input class="form-control" id="meta_title" name="meta_title" type="text" value='<?php echo set_value('meta_title');?>'/><?php echo form_error('meta_title'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="meta_keyword">Meta Keyword</label>
							<div class="col-md-4"> <textarea id="meta_keyword" name="meta_keyword"><?php echo set_value('meta_keyword');?></textarea><?php echo form_error('meta_keyword'); ?></div>
						</div>
						<!-- // Group END -->
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="meta_description">Meta Description</label>
							<div class="col-md-4"> <textarea id="meta_description" name="meta_description"><?php echo set_value('meta_description');?></textarea><?php echo form_error('meta_description'); ?></div>
						</div>
						<!-- // Group END -->
						<div class="form-group">
							<label class="control-label col-md-3">Page Content :</label>
								<div class="col-md-4">
								   <div>
									<?php 
										$CKEditor->config['width'] = '@@screen.width * 0.5';                           
											
										$CKEditor->editor("_content", "<p></p>"); 
									?> 


								   </div>
								</div>
                        </div>
						
						
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
            title: "required",
            heading: "required", 

        },
        messages: {
            title: "Please Enter title of Page",
            heading: "Please enter heading of page",                   
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

	
		
	
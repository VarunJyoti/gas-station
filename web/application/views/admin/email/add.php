<style>
.li_image_class{
	float:left;
}
.image_list_ul{list-style:none;}
.radio input[type="radio"], .checkbox input[type="checkbox"] {
  float: left;
  margin-left: 0px;
}
.attach_class{
	background: url(<?php echo base_url();?>assets/img/attachment.png);
	background-repeat: no-repeat;
	width: 14px;
	height: 14px;
	content: '';
	display: inline-block;
	margin: 0px 5px 0px 0px;
	vertical-align: middle;
	background-size: 100%;
}
</style>
<?php 
$CKEditor = new CKEditor(base_url()."ckeditor/");  
//$CKEditor->config['height'] = 200;
										
$CKEditor->config['width'] = '@@screen.width * 0.6';                           
										
?>
<ul class="breadcrumb">
<li>Add New Template Management</li>
<li><a href="<?php echo base_url('/admin/email');?>" class="glyphicons dashboard"> List</a></li>
<li class="divider"><i class="icon-caret-right"></i></li>
<li>Add New Template</li>
</ul>
<div class="innerLR">
<?php
	$check_tittle = $this->Email_model->PageTitleList();
	if(!empty($check_tittle)){?>
	<h1>Add New Template</h1>  
	<?php if($this->session->flashdata('error')) { ?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Error!</strong> <?php echo $this->session->flashdata('error') ;?>
	</div>
	<?php } 
	if($this->session->flashdata('success')) { ?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">×</button>
		<strong>Success!</strong> <?php echo $this->session->flashdata('success') ;?>
	</div>
	<?php } 
	if($this->session->flashdata('info')) { ?>
	<div class="alert alert-info">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<strong>Success ! </strong> <?php echo $this->session->flashdata('info') ;?>
	</div>
	<?php }?>
	<form class="form-horizontal margin-none" enctype="multipart/form-data" action="<?php echo base_url('admin/email/save');?>" name="basic_validate" id="add_template" novalidate="novalidate" method="post">
		<input type="hidden" name="id" id="id" value="<?php echo $page->id;?>"/>
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"></h4>
			</div>
			
			
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row-fluid">
				
					<!-- Column -->
					<div class="span6">
								
						<div class="control-group">
							<label class="control-label">Select Display Page :</label>
							<div class="controls">
								<select name='reg_step'>
								<option value=''>Choose Display Page</option>
								<?php 
									echo $this->Email_model->PageTitleList();
								?>
								</select>
								<?php echo form_error('reg_step'); ?>
							</div>
						</div>
						<!-- // Group END -->
												
						<!-- Group -->
						<!--div class="control-group">
							<label class="control-label" for="From">From</label>
							<div class="controls"><input class="span12" id="from_to" name="from_to" type="text" value='<?php echo $page->from_to;?>' style='width: 218px;'/><?php echo form_error('from_to'); ?></div>
						</div-->
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="Subject">Subject</label>
							<div class="controls"> <textarea id="subject" name="subject"><?php echo $page->subject;?></textarea><?php echo form_error('subject'); ?></div>
						</div>
						<!-- // Group END -->
						
						<div class="control-group">
							<label class="control-label">Mail Content :</label>
								<div class="controls">
								   <div>
									
									<?php   
										                          
										$CKEditor->editor("meta_content", $page->content); 
									?> 


								   </div>
								</div>
                        </div>
						
						
						<div class="control-group">
							<label class="control-label">Attachment :</label>
								<div class="controls">
								<input accept='jpeg|jpg|png|gif|pdf|doc' type="text" readonly name="attach[]" id='attach' style='width: 200px;'>
								&nbsp; <span class='attach_class' onClick="uploadpop('attach','templates');"></span>
								</div>
								<div id='attach_1' class='image_u'></div>
								<div class="control-group attach_1"></div>
						</div>
						
						<div id="imagePreview"></div>    
						<?php $image_start = 1;?>
						<div class="control-group">
							<label class="control-label"> &nbsp;</label>
							<div class="controls">
								<span onClick="add_more_image();" style='cursor: pointer;'>Add More Attachment</span>
							</div>
						</div>
						
						<input type="hidden" id="admore_cnt" value='<?php echo $image_start; ?>'/>
						
						
						<!-- Group -->
						<div class="control-group">
							<label class="control-label">Status :</label>
							<div class="controls">
								<label><input type="radio" name="status" id="status" value="1" checked/>
									Active 
								</label>
								<label><input type="radio" name="status" value="0" id="status"/>
										Disable 
								</label>
							</div>
						</div>
						<!-- // Group END -->
					</div>
					<!-- // Column END -->
				
				</div>
				<!-- // Row END -->	
				<!-- // Row END -->	
						<!-- // Group END -->
					<div class="row-fluid uniformjs">	
						<hr class="separator" />
				
						<!-- Form actions -->
						<div class="form-actions">
							<button type="submit" name='save_template' value='Save' class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
							<button type="reset" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>Cancel</button>
						</div>
					</div>
			</div>
				
		</div> 				<!-- // Form actions END -->
	</form>
	<?php }else{?>
			<div class="widget-head">
				<h3 class="heading">We have already added all page email template.</h3>
			</div>
			<?php }?>
</div>                            
 <script type="text/javascript" src='<?php echo base_url();?>common/js/file.uploader.js'></script>   
 
<script>
$(document).ready(function(){  
$('input[type=checkbox],input[type=radio]').uniform();
    
  
    
    // Form Validation
    $("#add_template").validate({
    rules: {        
        reg_step: "required", 
		meta_content: "required",
		from_to: "required",
		subject: "required"
		
        /*image: {
            required : true,
            accept: "png|jpe?g"    
            } */
    },
    messages: {           
        reg_step: "This field is required",
		from_to: "This field is required",
		meta_content: "Please enter mail content",
		subject: "This field is required",
		 /*image: {
            required : "Please Select City Image",
            accept: "Only JPEG and PNG images allowed"
            }   */   
       
    } ,
         
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

});


</script>
	<script type="text/javascript" src="<?php echo base_url('/common/js/jquery.validate.js');?>"></script>
   

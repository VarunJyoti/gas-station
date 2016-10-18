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
<li>Edit Template Management</li>
<li><a href="<?php echo base_url('/admin/email');?>" class="glyphicons dashboard"> List</a></li>
<li class="divider"><i class="icon-caret-right"></i></li>
<li>Edit Template</li>
</ul>
<div class="innerLR">
	<h1>Edit Template</h1>  
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
							<label class="control-label">Display Page :</label>
							<div class="controls">
								<?php echo $page->printStepName($page->reg_step);?>
								<input type='hidden' name='reg_step' value="<?php echo $page->reg_step;?>">
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
						<?php 
						$attach = $page->attach;
						$unserialize_attach = unserialize($attach);
						$count_attach = count($unserialize_attach);
						if($count_attach > 0){
						?>
						<div class="control-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<label class="control-label">&nbsp;</label>
							<div class="controls">
							<ul class='image_list_ul'>
							<?php 
							
							foreach($unserialize_attach as $row){
								if(!empty($row)){
									$folder_name = 'templates';
									$img_name = $row;
									$attach_arr =  explode(".",$row);

									if($attach_arr[1] == 'pdf'){
									$filepath = base_url()."uploads/templates/{$row}";
					
									?>
									<object height="250" width='100%' data="<?php echo $filepath;?>" type="application/pdf" width="860"></object>
					
									<?php }else{
										
										$gallery_path = DOCUMENT_ROOT_UPLOADS_FOLDER_PATH;
										$img_path = site_url("admin/email/thumbs?image={$this->Email_model->show_thumb($row,$folder_name)}&h=100&w=100");
									
										echo '<li class="li_image_class" style="padding:10px;">';
										echo $img=(!empty($img_name) && file_exists("$gallery_path/$folder_name/$img_name"))?"<img src='$img_path'>":'';
									}?>
									<!--<a onclick='attachDeleteDb(<?php echo $page->id;?>,"<?php echo $img_name;?>")'><span class='collapse-toggle' style='cursor:pointer'><img src='<?php echo base_url();?>common/bootstrap/img/remove-icon-small.png' style='vertical-align: top;'></span></a></li>
									-->
									
							<input type="hidden" name="attach[]" id="attachs" value="<?php echo $row;?>"/>
				
							<?php 
							}
							}
							?>
							</ul>	
							</div>
							
						</div>
						<?php }?>
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

function attachDeleteDb(id,img_name){
	var r = confirm("Are you sure you want to delete the image?");
	if (r == true) { 
		location.href = BASE_URL+'email/deleTeteplateImages/'+id+'/'+img_name;
	} else {
		
		return false;
	}
	
}
</script>
	<script type="text/javascript" src="<?php echo base_url('/common/js/jquery.validate.js');?>"></script>
   

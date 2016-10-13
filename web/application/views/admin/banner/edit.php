<ul class="breadcrumb">
		<li>Banner Management</li>
		<li><a href="<?php echo base_url('/admin/banner');?>" class="glyphicons dashboard"> List</a></li>
		<li class="divider"><i class="icon-caret-right"></i></li>
		<li>Edit Banner</li>
</ul>
<div class="innerLR">
	<h1>Edit Banner</h1>
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
	<form class="form-horizontal margin-none" enctype="multipart/form-data" action="<?php echo base_url('admin/banner/save');?>" name="basic_validate" id="add_banner" novalidate="novalidate" method="post">
		<!-- Widget -->
		<input type="hidden" name="id" id="id" value="<?php echo $banner->id;?>"/>
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
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="title">Banner Name</label>
							<div class="controls"><input class="span12" id="name" value="<?php echo $banner->name;?>" name="name" type="text" /><?php echo form_error('name'); ?></div>
						</div>
						<!-- // Group END -->
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="title">Banner Heading</label>
							<div class="controls"><input class="span12" id="heading" value="<?php echo $banner->heading;?>" name="heading" type="text" /><?php echo form_error('heading'); ?></div>
						</div>
						<!-- // Group END -->	
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="description">Description</label>
							<div class="controls"> 
							<?php   
								$CKEditor = new CKEditor(base_url()."ckeditor/");  
								//$CKEditor->config['height'] = 200;
								$CKEditor->config['width'] = '@@screen.width * 0.6';                           
								$CKEditor->editor("description",$banner->description); 
							?> 
							<?php echo form_error('description'); ?></div>
						</div>		
                        <!-- Group -->
						<div class="control-group">
							<label class="control-label" for="order">Order</label>
							<div class="controls"><input class="span12" id="order" value="<?php echo $banner->order;?>" name="order" type="text" /><?php echo form_error('order'); ?></div>
						</div>
						<!-- // Group END -->
                        <!-- Group -->
						<div class="control-group">
							<label class="control-label" for="image">Image(990px X 344px)</label>
							<div class="controls"><input class="span12" id="image" value="<?php echo set_value('image');?>" name="image" type="file" accept="image/*"/><?php echo form_error('image'); ?>
							<?php if(!empty($banner->image)){?>
							<img style="" alt="User" src="<?php echo site_url("main/thumbs?image={$banner->show_thumb()}&h=80&w=120");?>" />
							<a onclick='DeleteBannerImage(<?php echo $banner->id;?>,"<?php echo $banner->image;?>")'><span class='collapse-toggle' style='cursor:pointer'><img src='<?php echo base_url();?>common/bootstrap/img/remove-icon-small.png' style='vertical-align: top;'></span></a></li>
							<?php }?>	
							</div>
						</div>
						<!-- // Group END --> 
                        <!-- Group -->
						<div class="control-group">
							<label class="control-label">Status :</label>
							<div class="controls">
								<label><input type="radio" name="status" id="status4" value="1" <?php if($banner->status == 1)echo 'checked="checked"';?>/>
									Active </label>
									<label><input type="radio" name="status" value="0" id="status" <?php if($banner->status == 0)echo 'checked="checked"';?>/>
										Disable </label>
							</div>
						</div>

					</div>
				
				</div>
				<!-- // Row END -->	
				<!-- // Row END -->	
						<!-- // Group END -->
					<div class="row-fluid uniformjs">	
						<hr class="separator" />
				
						<!-- Form actions -->
						<div class="form-actions">
							<button type="submit" name='edit_banner' value='Save' class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
							<button type="reset" class="btn btn-icon btn-default glyphicons circle_remove"><i></i>Cancel</button>
						</div>
					</div>
			</div>   	
		</div> 				<!-- // Form actions END -->
	</form>
</div>                            
       
<script>
$(document).ready(function(){  
$('input[type=checkbox],input[type=radio]').uniform();
    
   
    
    // Form Validation
    $("#add_banner").validate({
    rules: {        
        name: "required",  
        
    },
    messages: {           
        name: "Please enter a Banner Name",           
       
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
function DeleteBannerImage(id,img_name){
	var r = confirm("Are you sure you want to delete the image?");
	if (r == true) { 
		location.href = BASE_URL+'admin/banner/deleteBannerImages/'+id+'/'+img_name;
	} else {
		
		return false;
	}
	
} 
</script>
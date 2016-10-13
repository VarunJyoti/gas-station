
<ul class="breadcrumb">
		<li>City Management</li>
		<li><a href="<?php echo base_url('/admin/city');?>" class="glyphicons dashboard"> List</a></li>
		<li class="divider"><i class="icon-caret-right"></i></li>
		<li>Edit City</li>
</ul>
<div class="innerLR">
	<h1>Edit City</h1>  
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
	<form class="form-horizontal margin-none" enctype="multipart/form-data" action="<?php echo base_url('admin/city/save');?>" name="basic_validate" id="add_banner" novalidate="novalidate" method="post">
		<input type="hidden" name="id" id="id" value="<?php echo $city->id;?>"/>
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
					
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="name">City Name</label>
							<div class="controls"><input class="span12" id="name" value="<?php echo $city->name;?>" name="name" type="text" /><?php echo form_error('name'); ?></div>
						</div>
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="city_code">City Code</label>
							<div class="controls"><input class="span12" id="city_code" value="<?php echo $city->city_code;?>" name="city_code" type="text" /><?php echo form_error('city_code'); ?></div>
						</div>
						<!-- // Group END -->
						<div class="control-group">
							<label class="control-label">Select State :</label>
							<div class="controls"> 
							<select name='state_id' class="form-control" id='state_id'>
							<option value="">Choose</option> 
							<?php echo $this->State_model->statedrop($city->state_id);?>
							</select>
							<?php echo form_error('state_id'); ?> 
							</div>
							 
						</div>
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="title">City Title</label>
							<div class="controls"><input class="span12" id="title" value="<?php echo $city->title;?>" name="title" type="text" /><?php echo form_error('title'); ?></div>
						</div>
						<!-- // Group END -->
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="meta_title">Meta Title</label>
							<div class="controls"><input class="span12" id="meta_title" name="meta_title" type="text" value='<?php echo $city->meta_title;?>'/><?php echo form_error('meta_title'); ?></div>
						</div>
						<!-- // Group END -->
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="meta_keyword">Meta Keyword</label>
							<div class="controls"> <textarea id="meta_keyword" name="meta_keyword"><?php echo $city->meta_keyword;?></textarea><?php echo form_error('meta_keyword'); ?></div>
						</div>
						<!-- // Group END -->
						<!-- Group -->
						<div class="control-group">
							<label class="control-label" for="meta_description">Meta Description</label>
							<div class="controls"> <textarea id="meta_description" name="meta_description"><?php echo $city->meta_description;?></textarea><?php echo form_error('meta_description'); ?></div>
						</div>
						<!-- // Group END -->
						<!-- Group -->
						<!--div class="control-group">
							<label class="control-label" for="description">Description</label>
							<div class="controls"> 
							<?php   
								//$CKEditor = new CKEditor(base_url()."ckeditor/");  
								//$CKEditor->config['height'] = 200;
								//$CKEditor->config['width'] = '@@screen.width * 0.6';                           
								//$CKEditor->editor("description", "<p></p>"); 
							?> 
							<?php //echo form_error('description'); ?></div>
						</div-->
						<!-- // Group END -->
						
                        <!-- Group -->
						<div class="control-group">
							<label class="control-label" for="image">Image(990px X 344px)</label>
							<div class="controls"><input class="span12" id="image" value="<?php echo $city->image;?>" name="image" type="file"/><?php echo form_error('image'); ?>
							<?php if(!empty($city->image)){?>
							<img style="" alt="User" src="<?php echo site_url("main/thumbs?image={$city->show_thumb()}&h=80&w=120");?>" />
							<a onclick='DeleteBannerImage(<?php echo $city->id;?>,"<?php echo $city->image;?>")'><span class='collapse-toggle' style='cursor:pointer'><img src='<?php echo base_url();?>common/bootstrap/img/remove-icon-small.png' style='vertical-align: top;'></span></a></li>
							<?php }?>	
							</div>
						</div>
						<!-- // Group END -->
                        <!-- Group -->
						<div class="control-group">
							<label class="control-label">Status :</label>
							<div class="controls">
								<label><input type="radio" name="status" id="status" value="1" <?php if($city->status == 1)echo 'checked="checked"';?>/>
									Active </label>
									<label><input type="radio" name="status" value="0" id="statuss" <?php if($city->status == 0)echo 'checked="checked"';?>/>
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
		state_id: "required",
		title: "required",
		city_code: "required",
		
        /*image: {
            required : true,
            accept: "png|jpe?g"    
            } */
    },
    messages: {           
        name: "Please enter a City Name",
		state_id: "Please select a state",
		title: "Please enter a title",
		city_code: "Please enter city code",
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
$(document).ready(function (){
	$('#name').change(function (){
		var  name = $(this).val();
		$.post(BASE_URL+'admin/city/checkdublicate',
			{ 'name':name },
			
			// when the Web server responds to the request
			function(result) {
				// clear any message that may have already been written
				//$('#name').replaceWith('');
				
				// if the result is TRUE write a message to the page
				if (result) {
				  $('#name').val('');
				  $('#name').after('<div id="bad_name" style="color:red;">' +
					'<p>(City Name is already taken. Please enter another.)</p></div>');
				}else{
					$('#bad_name').replaceWith('');
				}
			}
		);	
	});
});

function DeleteBannerImage(id,img_name){
	var r = confirm("Are you sure you want to delete the image?");
	if (r == true) { 
		location.href = BASE_URL+'admin/city/deleteCityImages/'+id+'/'+img_name;
	} else {
		
		return false;
	}
	
} 
</script>
	<script type="text/javascript" src="<?php echo base_url('/common/js/jquery.validate.js');?>"></script>
   

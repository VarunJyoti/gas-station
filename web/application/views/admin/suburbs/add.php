
<ul class="breadcrumb">
		<li>Location Management</li>
		<li><a href="<?php echo base_url('/admin/suburbs');?>" class="glyphicons dashboard"> List</a></li>
		<li class="divider"><i class="icon-caret-right"></i></li>
		<li>Add Location</li>
</ul>
<div class="innerLR">
	<h1>Add New Location</h1>  
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
	<form class="form-horizontal margin-none" enctype="multipart/form-data" action="<?php echo base_url('admin/suburbs/save');?>" name="basic_validate" id="add_banner" novalidate="novalidate" method="post">
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
							<label class="control-label" for="name">Location Name</label>
							<div class="controls"><input class="span12" id="name" value="<?php echo set_value('name');?>" name="name" type="text" /><?php echo form_error('name'); ?></div>
						</div>
						<!-- // Group END -->
						<div class="control-group">
							<label class="control-label">Select City :</label>
							<div class="controls"> 
							<select name='city_id' class="form-control" id='city_id'>
							<option value="">Choose</option> 
							<?php echo $this->City_model->cityDrop();?>
							</select>
							<?php echo form_error('city_id'); ?> 
							</div>
							 
						</div>
						
						<div class="control-group">
							<label class="control-label">Status :</label>
							<div class="controls">
								<label><input type="radio" name="status" id="statusa" value="1" checked="checked"/>
									Active </label>
									<label><input type="radio" name="status" value="0" id="status"/>
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
							<button type="submit" name='save_suburbs' value='Save' class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
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
		city_id: "required"
	},
    messages: {           
        name: "Please enter a Suburbs Name",
		city_id: "Please select a City"
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
		$.post(BASE_URL+'admin/suburbs/checkdublicate',
			{ 'name':name },
			
			// when the Web server responds to the request
			function(result) {
				// clear any message that may have already been written
				//$('#name').replaceWith('');
				
				// if the result is TRUE write a message to the page
				if (result) {
				  $('#name').val('');
				  $('#name').after('<div id="bad_name" style="color:red;">' +
					'<p>(Location Name is already taken. Please enter another.)</p></div>');
				}else{
					$('#bad_name').replaceWith('');
				}
			}
		);	
	});
});
</script>
	<script type="text/javascript" src="<?php echo base_url('/common/js/jquery.validate.js');?>"></script>
   

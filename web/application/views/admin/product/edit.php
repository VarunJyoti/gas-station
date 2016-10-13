<style>
	.alert{
		background:red;
	}
	.error{
		color: red !important;
	}
	</style>

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
Edit Product  <small></small>
</h3>
<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>admin/page/">Product Management</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<!--li>
						<a href="#">Data Tables</a>
						<i class="fa fa-angle-right"></i>
					</li-->
					<li>
						<a href="#">Edit Product</a>
					</li>
				</ul>
				
			</div>
<div class="row">
	<div class="col-md-12">
	<!-- BEGIN VALIDATION STATES-->
	<div class="portlet box blue">
	<div class="portlet-title">
	<div class="caption">
	<i class="fa fa-gift"></i>Edit Product
	</div>

	</div>
	<div class="portlet-body form">				
	<!-- Form -->
	<form class="form-horizontal" action="<?php echo base_url('admin/product/save');?>" id="edit_page" method="post" enctype="multipart/form-data" autocomplete="off">
		<input class="form-control" id="id" name="id" type="hidden" value='<?php echo $page->id;?>'/>
		<input class="form-control" id="pid" name="pid" type="hidden" value='<?php echo $page->pid;?>'/>
		<!-- Widget -->
		<div class="form-body">
							
		<div class="form-group">
			<label class="control-label col-md-3" for="title">Product Name<span class="required">* </span></label>
			<div class="col-md-4"><input class="form-control" id="p_name" value="<?php echo $page->p_name;?>" name="p_name" type="text" /><?php echo form_error('title'); ?></div>
		</div>
						<!-- // Group END -->
						<?php
						 $usr_type = loginUser();
						if( $usr_type =='admin')
						{ ?>
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="price">Product Price</label>
							<div class="col-md-4"><input class="form-control" id="p_price" value="<?php echo $page->price;?>" name="p_price" type="text" /><?php echo form_error('price'); ?></div>
						</div><!-- // Group END -->
						<!-- Group -->
						<!--
						<div class="form-group">
							<label class="control-label col-md-3" for="s_price">Selling Price</label>
							<div class="col-md-4"><input class="form-control" id="s_price" value="<?php echo $page->s_price;?>" name="s_price" type="text" /><?php echo form_error('s_price'); ?></div>
						</div>
						-->
						<!-- // Group END -->
						<?php }	?>
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="html_title">Product Image</label>
							<div class="col-md-4"><input class="form-control" id="p_image" name="p_image" type="file" value='<?php echo set_value('p_image');?>'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($page->p_image){?>
								<img src="<?php echo base_url()?>/uploads/product/<?php echo $page->p_image?>" height="50px" weight="50px">
							<?php } ?>
							</div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Product Description</label>
							
							<div class="col-md-4">

								   <div>

									<?php 
                                        $CKEditor = new CKEditor(base_url()."ckeditor/"); 
										$CKEditor->config['width'] = '@@screen.width * 0.5';                           

										$CKEditor->editor("_p_desc", $page->p_desc); 										

									?> 

                                       </div>

								</div>
							
						</div>


                     <!-- // Group END -->
						
						
						
						
						<!--div class="form-group">
							<label class="control-label col-md-3">Image :</label>
								<div class="col-md-4">
								  <input type="file" id="images" name="images" />
								</div>
						</div-->
						
						
						
						
						<!-- Group -->

						<div class="form-group">

							<label class="control-label col-md-3">Status :</label>

							<div class="col-md-4">

								<label><input type="radio" name="status" id="status" value="1" <?php if($page->status==1) echo 'checked="checked"';?>/>

									Active </label>

									<label><input type="radio" name="status" value="0" id="status" <?php if($page->status==0) echo 'checked="checked"';?>/>

										Disable </label>

							</div>

						</div>

						<!-- // Group END -->
					</div>
					<!-- // Column END -->
					
					
					
				
				<!-- // Row END -->
				
				
				
				<!-- Row -->
				<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" name='save_page' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>Edit</button>
						<button type="button" class="btn btn-icon btn-default glyphicons circle_remove" onClick="window.location='.base_url(admin/product);?>';"><i></i>Cancel</button>
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
    $("#edit_page").validate({
        rules: {
            p_name: "required"	

        },
        messages: {
            p_name: "Please Enter Name"		

    
			
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
	
	
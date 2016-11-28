<?php 
$CKEditor = new CKEditor(base_url()."ckeditor/");  
//$CKEditor->config['height'] = 200;
										
$CKEditor->config['width'] = '@@screen.width * 0.6';   
 $user_type = loginUser();
                       
										
?>


<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left"> 
                <h3>Dashboard</h3>
			<?php
if($this->session->flashdata('error')) {
	echo $this->session->flashdata('error');
}elseif($this->session->flashdata('success')) {
	echo $this->session->flashdata('success');
}elseif($this->session->flashdata('info')) {
	echo $this->session->flashdata('info');
}?>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
				<!--
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                          </span>
                  </div>
				  -->
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Product Management<small>Add Product</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <form class="form-horizontal" action="<?php echo base_url('admin/product/save');?>" id="add_page" method="post" enctype="multipart/form-data">
		<div class="form-body">
		<input class="form-control" id="id" name="id" type="hidden" value=''/>
		<!-- Widget -->
		
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="title">Product Name<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="p_name"  value="<?php echo set_value('p_name');?>" name="p_name" type="text" /><?php echo form_error('p_name'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						
							<div class="col-md-4"><input class="form-control" id="p_cat" value="main" name="p_cat" type="hidden" /></div>
						   <div class="col-md-4"><input class="form-control" id="p_price" value="0.000" name="p_price" type="hidden" /></div>
						    <div class="col-md-4"><input class="form-control" id="s_price" value="0.000" name="s_price" type="hidden" /></div>
						<!-- // Group END -->
						
						
						
						<?php
						if($user_type == 'admin')
						{
							
						?>
						
						<input class="form-control" id="p_cat" value="company" name="p_cat" type="hidden" />
					     <!-- Group -->
						 
						<div class="form-group">
							<label class="control-label col-md-3" for="title">Price<span class="required">* </span></label>
							<div class="col-md-4"><input  class="form-control" id="p_price" value="<?php echo set_value('p_price');?>" name="p_price" type="text" /><?php echo form_error('p_price'); ?></div>
						</div>
						
						<!-- // Group END -->
						
						 <!-- Group -->
						 <!--
						<div class="form-group">
							<label class="control-label col-md-3" for="title">Selling Price<span class="required">* </span></label>
							<div class="col-md-4"><input  class="form-control" id="s_price" value="<?php echo set_value('s_price');?>" name="s_price" type="text" /><?php echo form_error('p_price'); ?></div>
						</div>
						-->
						
						<!-- // Group END -->
						<?php
						}
						?>
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="html_title">Product Image</label>
							<div class="col-md-4"><input class="form-control" id="p_image" name="p_image" type="file" value='<?php echo set_value('p_image');?>'/></div>
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
						
						
						<?php
						if($user_type == 'super')
						{
							
						?>
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="merged">Merged :<span class="required"></span></label>
							<div class="col-md-4">
							<label><input type="radio" name="merged" id="status" value="1" />
									Y </label>
									<label><input type="radio" name="merged" value="0" id="status" checked="checked"/>
										N </label>
							</div>
						</div>
						<!-- // Group END -->
						
						<?php
						}
						?>
						
						
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
						<button type="submit" name='save_page' value='Save' class="btn btn-success"><i></i>Save</button>
						<a href="<?php echo base_url('admin/product');?>"> <button type="button" class="btn btn-primary" ><i></i>Cancel</button></a>
					</div>
					</div>
				</div>	
				
				<!-- // Form actions END -->
				
		
		
	</form>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
   <style>
   .help-inline{color:red;}
   </style>
       
<script>


$(document).ready(function(){  
  //$('select').select2();  
    
    // Form Validation
    $("#add_page").validate({
        rules: {
            p_name: "required",
			p_price: "required",
            
			
			
            
			
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
			 p_price: "Please Enter Product Price",
           
			
		
            
            
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

	
		
	
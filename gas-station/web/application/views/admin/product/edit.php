<style>
	.alert{
		background:red;
	}
	.error{
		color: red !important;
	}
	</style>

	
	
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
                    <h2>Product Management<small>Edit Product</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
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
						
						<?php
						$usr_type = loginUser();
						if($usr_type == 'super')
						{
							
						?>
						
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="merged">Merged :<span class="required"></span></label>
							<div class="col-md-4">
							<label><input type="radio" name="merged" id="merged" value="1" <?php if($page->merged == 1) echo 'checked="checked"';?> />
									Y </label>
									<label><input type="radio" name="merged" value="0" id="merged" <?php if($page->merged == 0) echo 'checked="checked"';?>/>
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
						<button type="submit" name='save_page' value='Save' class="btn btn-success"><i></i>Edit</button>
						<button type="button" class="btn btn-primary" onClick="window.location='.base_url(admin/product);?>';"><i></i>Cancel</button>
					</div>
					</div>
				</div>
				
		
	</form>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
	
	
	
<script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>	
	
<script>
$(document).ready(function(){  

            

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
	
	
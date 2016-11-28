<style>
	.alert{
		background:red;
	}
	.error{
		color: red !important;
	}
	.txtleft{
		margin-left:10px;
		width:80px;
		align:center;
	}
	</style>
<?php
$usr_type = loginUser();
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
                    <h2>Admin Management<small>Add Admin</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <form class="form-horizontal" action="<?php echo base_url('admin/enduser/save');?>" id="edit_page" method="post" autocomplete="off">
		<input class="form-control" id="id" name="id" type="hidden" value='<?php echo $page->id;?>'/>
		<!-- Widget -->
		<div class="form-body">
							
		<div class="form-group">
			<label class="control-label col-md-3" for="first_name">Name<span class="required">* </span></label>
			<div class="col-md-4"><input class="form-control" id="first_name" value="<?php echo $page->first_name;?>" name="first_name" type="text" /><?php echo form_error('first_name'); ?></div>
		</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="html_title">Email<span class="required">* </span></label>
							<div class="col-md-4"><input readonly class="form-control" id="email" name="email" type="email" value='<?php echo $page->email;?>'/><?php echo form_error('email'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
	
   
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Pin<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="pin" name="pin" type="text" value='<?php echo $page->pin;?>'/><?php echo form_error('heading'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Contact<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="phone" name="phone" type="text" value='<?php echo $page->phone;?>'/><?php echo form_error('phone'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Username<span class="required">* </span></label>
							<div class="col-md-4"><input readonly class="form-control" id="username" name="username" type="text" value='<?php echo $page->username;?>'/><?php echo form_error('heading'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Password<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="password" name="password" type="password" value='<?php echo $page->password;?>'/><?php echo form_error('password'); ?></div>
						</div>
						<!-- // Group END -->

						<div class="form-group">
							<label class="control-label col-md-3" for="shift">Shift No<span class="required">* </span></label>
							<div class="col-md-4">
							
							<select name="shift" id="shift" class="form-control">
							<option value="1" <?php if($page->access_module==1 ){echo 'selected';}?>>1</option>
							<option value="2" <?php if($page->access_module==2 ){echo 'selected';}?>>2</option>
							<option value="3" <?php if($page->access_module==3 ){echo 'selected';}?>>3</option>
							<option value="4" <?php if($page->access_module==4 ){echo 'selected';}?>>4</option>
							<option value="5" <?php if($page->access_module==5 ){echo 'selected';}?>>5</option>
							<option value="6" <?php if($page->access_module==6 ){echo 'selected';}?>>6</option>
							</select>
							
							</div>
						</div>
						
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
						
				 
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
					
					
				
				<!-- // Row END -->
			
				<!-- Row -->
				<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" name='save_page' value='Save' class="btn btn-success"><i></i>Edit</button>
						<a href="<?php echo base_url('admin/enduser/');?>"><button type="button" class="btn btn-primary"><i></i>Cancel</button></a>
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



<script>
$(document).ready(function(){  


    $("#edit_page").validate({
        rules: {
            
			"first_name": {
                required: true
            } ,
			"pin": {
                required: true
            },
			"phone": {
                required: true,
				number: true,
				maxlength: 12,
				minlength:8
            }
        }
    });

});




</script>
	
<?php 
$CKEditor = new CKEditor(base_url()."ckeditor/");  
//$CKEditor->config['height'] = 200;
										
$CKEditor->config['width'] = '@@screen.width * 0.6';                           
										
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
                    <h2>Enduser Management<small>Add User</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <form class="form-horizontal" action="<?php echo base_url('admin/enduser/save');?>" id="add_page" method="post">
		<div class="form-body">
		<input class="form-control" id="id" name="id" type="hidden" value=''/>
		<!-- Widget -->
		
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="first_name">Name<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="first_name" value="<?php echo set_value('first_name');?>" name="first_name" type="text" /><?php echo form_error('first_name'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="html_title">Email<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="email" name="email" type="email" value='<?php echo set_value('email');?>'/><?php echo form_error('email'); ?></div>
						</div>
						<!-- // Group END -->
						
						

						

						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Pin<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="pin" name="pin" type="text" value='<?php echo set_value('pin');?>'/><?php echo form_error('heading'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Contact<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="contact" name="contact" type="text" value='<?php echo set_value('contact');?>'/><?php echo form_error('heading'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Username<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="username" name="username" type="text" value='<?php echo set_value('username');?>'/><?php echo form_error('heading'); ?></div>
						</div>
						<!-- // Group END -->
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="heading">Password<span class="required">* </span></label>
							<div class="col-md-4"><input class="form-control" id="password" name="password" type="password" value='<?php echo set_value('password');?>'/><?php echo form_error('password'); ?></div>
						</div>
						<!-- // Group END -->
						
						
						<!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3" for="html_title">Shift No<span class="required">* </span></label>
							<div class="col-md-4">
							
							<select name="role" id="role" class="form-control">
							<option value="1" selected="selected">1</option>
							<option value="2">2</option>
							<option value="2">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							</select>
							
							</div>
						</div>
						<!-- // Group END -->
						
						
						
						
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
						<button type="button" class="btn btn-primary" onClick="window.location='<?php echo base_url('admin/enduser/');?>';"><i></i>Cancel</button>
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

      
<script> 
$(document).ready(function(){  
$('#add_page').attr('autocomplete','off');
        $.validator.addMethod("checkUserName", 
        function(value, element) {
            var result = false;
            $.ajax({
                type:"POST",
                async: false,
                url: "<?php echo base_url('admin/company/check_username_availablity')?>", 
                data: {username: value},
                success: function(data) {
					if(data=='true'){
						result =true;
					}
					else{
							result= false;
					}
					
					//console.log(result);
					
                }
            });
            // return true if username is exist in database
            return result; 
        }, 
        "This username is already taken! Try another."
    );
	$.validator.addMethod("checkEmail", 
        function(value, element) {
            var result = false;
            $.ajax({
                type:"POST",
                async: false,
                url: "<?php echo base_url('admin/company/check_email_availablity')?>", 
                data: {email: value},
                success: function(data) {
					if(data=='true'){
						result =true;
					}
					else{
							result= false;
					}
					
					//console.log(data);
					
                }
            });
            return result; 
        }, 
        "This Email is already taken! Try another."
    );

    $("#add_page").validate({
        rules: {
            "username": {
                required: true,
                checkUserName: true
            } ,
			"first_name": {
                required: true
            } ,
			"email": {
                required: true,
                email: true,
                checkEmail: true
            },
			"pin": {
                required: true 
            },
			"contact": {
                required: true,
				number: true,
				maxlength: 12,
				minlength:8
            },
			"password": {
                required: true,
				minlength:5
            } 
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
		
	
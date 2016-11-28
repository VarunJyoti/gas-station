
<?php $page_url = (explode('/', current_url()));$usr_type = loginUser();?>

	 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left"> 
                <h3>Dashboard</h3>
			 <?php
           if($this->session->flashdata('error')) {
	           echo $this->session->flashdata('error');
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
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
					  <!--
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
					  -->
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <form class="form-horizontal" action="<?php echo base_url('admin/adminUser/save');?>" id="validateSubmitForm" method="post">
					<input class="span12" id="id" name="id" type="hidden" value=''/>
						<div class="form-body">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">First name <span class="required">* </span></label>
								<div class="col-md-4">
									<input type="text" class="form-control col-md-7 col-xs-12" id="first_name" value="<?php echo set_value('first_name');?>" name="first_name"/>
									<?php echo form_error('first_name'); ?>
									<!--span class="help-block">
									Something may have gone wrong </span-->
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3" for="last_name">Last name <span class="required">* </span></label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="last_name" value="<?php echo set_value('last_name');?>" name="last_name"/>
									<?php echo form_error('last_name'); ?>
									<!--span class="help-block">
									Something may have gone wrong </span-->
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3" for="email">E-mail <span class="required">* </span></label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="email" value="<?php echo set_value('email');?>" name="email"/>
									<?php echo form_error('email'); ?>
									<!--span class="help-block">
									Something may have gone wrong </span-->
								</div>
							</div>
						
							<div class="form-group">
								<label class="control-label col-md-3" for="password">Password <span class="required">* </span></label>
								<div class="col-md-4">
									<input type="password" class="form-control" id="password" value="<?php echo set_value('password');?>" name="password"/>
									<?php echo form_error('password'); ?>
									<!--span class="help-block">
									Something may have gone wrong </span-->
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3" for="confirm_password">Confirm Password <span class="required">* </span></label>
								<div class="col-md-4">
									<input type="password" class="form-control" id="confirm_password" value="<?php echo set_value('confirm_password');?>" name="confirm_password"/>
									<?php echo form_error('confirm_password'); ?>
									<!--span class="help-block">
									Something may have gone wrong </span-->
								</div>
							</div>
							<!--div class="form-group">
								<label class="control-label col-md-3">User Type <span class="required">
								* </span>
								</label>
								<div class="col-md-4">
									<select class="form-control" name="type">
										<option value="">Select Type...</option>
										<?php  //echo $this->types_model->typesDrop();?>
									</select>
									<?php //echo form_error('type'); ?>
								</div>
							</div-->
						
							<div class="form-group">
								<label class="control-label col-md-3">Status <span class="required">* </span>
								</label>
								<div class="col-md-4 has-success">
									<select class="form-control" name="status">
										<option value='1'>Live</option>
										<option value='0'>Suspend</option>
									</select>
								</div>
							</div>
						
					</div>
					
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" name='add_profile' value='Save' class="btn btn-success"><i></i>Save</button>
								<button type="button" class="btn btn-primary" onClick="window.location='<?php echo base_url('admin/adminUser/');?>';">cancel</button>
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
	
	
	<!-- BEGIN CONTENT -->

			
<script>
$(function()
{
	// validate signup form on keyup and submit
	$("#validateSubmitForm").validate({
		rules: {
			first_name: "required",
			last_name: "required",
			/*type: {
				required: true
			},*/
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			first_name: "Please enter your firstname",
			last_name: "Please enter your lastname",
			/*type: {
				required: "Please choose type of user"
			},*/
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
		errorClass: "help-block help-block-error",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        }
	});
});

	</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#email").blur(function(){
		var email = $(this).val();
		
		$.post(BASE_URL+'admin/adminUser/checkEmail',
			{ 'email':email },
		// when the Web server responds to the request
			function(result) {
				// clear any message that may have already been written
				//$('#email').replaceWith('');
				
				// if the result is TRUE write a message to the page
				if (result == '2') {
				  $('#email').val('');
				  $('#email').after('<div id="bad_name" style="color:red;">' +
					'<p>(Email already exists. Please use other email address.)</p></div>');
				}else{
					$('#bad_name').replaceWith();
					
				}
			}
		);		
	});
});

</script>

	
		
	
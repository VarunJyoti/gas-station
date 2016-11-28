<?php 
$CKEditor = new CKEditor(base_url()."ckeditor/");  
//$CKEditor->config['height'] = 200;
										
$CKEditor->config['width'] = '@@screen.width * 0.4'; 

 
?>
<style>
html, body {
    padding-top: 20px;
}

[data-role="dynamic-fields"] > .form-inline + .form-inline {
    margin-top: 0.5em;
}

[data-role="dynamic-fields"] > .form-inline [data-role="add"] {
    display: none;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="add"] {
    display: inline-block;
}

[data-role="dynamic-fields"] > .form-inline:last-child [data-role="remove"] {
    display: none;
}
</style>


<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left"> 
                <h3>Credit Customer</h3>
			<?php if($this->session->flashdata('error')) { ?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $this->session->flashdata('error') ;?>
	</div>
	<?php } 
	if($this->session->flashdata('success')) { ?>
	<div class="alert alert-success">
		<button class="close" data-dismiss="alert">×</button>
		<?php echo $this->session->flashdata('success') ;?>
	</div>
	<?php } 
	if($this->session->flashdata('info')) { ?>
	<div class="alert alert-info">
		<a href="#" class="close" data-dismiss="alert">&times;</a>
		<?php echo $this->session->flashdata('info') ;?>
	</div>
	<?php } ?>
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
                    <h2>Edit<small></small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 
				 <form class="form-horizontal" action="<?php echo base_url('admin/company/savecreditcustomer');?>" id="edit_page" method="post" autocomplete="off">
		<input class="form-control" id="id" name="id" type="hidden" value='<?php echo $page['id'];?>'/>
		<div class="form-body">
		
		<div class="form-group">
		  <label class="control-label col-md-3">Name:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <input type="text"   required="required" class="form-control" id="name" name="name" value="<?php echo $page['name'];?>" placeholder="Name">
		  
		  </div>
		  </div>
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Email:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <input type="email"  required="required" class="form-control" id="email" name="email" value="<?php echo $page['email'];?>" placeholder="Email Id">
		  </div>
		  </div>
		  
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Phone No:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <input class="form-control" id="phone" name="phone" type="number" value="<?php echo $page['phone'];?>" required="required"/>
		  </div>
		  </div>
		  
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Credit Limit:</label>
		  <div class="col-md-4">
		  <input class="form-control" id="credit_limit" name="credit_limit" type="number" value="<?php echo $page['credit_limit'];?>"/>
		  </div>
		  </div>
		  <!--
		  <div class="form-group">
		  <label class="control-label col-md-3">Description:</label>
		  <div class="col-md-4">
		   <?php 

										$CKEditor->config['width'] = '@@screen.width * 0.4';                           

											

										$CKEditor->editor("_p_desc", "<p></p>"); 

									?> 
		  </div>
		  </div>
		  -->
		  
		  
		  <div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" name='save_page' value='Save' class="btn btn-success"><i></i>Update</button>
						<a href="<?php echo base_url('/admin/company/add_credit_customer');?>"><button type="button" class="btn btn-primary" ><i></i>Cancel</button></a>
					</div>
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


	

<script type="text/javascript">
$(document).ready(function(){  

    // Form Validation
    $("#edit_page").validate({
        rules: {
            name: "required",
			email: "required",
			phone: "required",
		        },
			
		
        messages: {
            name: "Please Enter  Name",
            name: "Please Enter  Email",
            phone: "Please Enter  Phone No",
      
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
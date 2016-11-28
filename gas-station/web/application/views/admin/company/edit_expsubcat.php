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
                <h3>Expenses Management</h3>
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
                    <h2>Sub Category<small>Edit</small></h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <form class="form-horizontal" action="<?php echo base_url('admin/company/SaveSubcat');?>" id="edit_page" method="post" autocomplete="off">
		<input class="form-control" id="id" name="id" type="hidden" value='<?php echo $page['id'];?>'/>
		<div class="form-body">
		
		<div class="form-group">
		  <label class="control-label col-md-3">Main Cat.:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <select name= "cat_name" class="form-control">
		  <option value="" >SELECT MAIN CATEGORY</option>
		  <?php
		  foreach($MainCat as $row)
					{
		  ?>
		  
		   <option value="<?php echo $row->cat_name?>" <?php if($row->cat_name == $page['cat_name']){echo 'selected="selected"';}?>><?php echo ucfirst($row->cat_name)?></option>
		  <?php
					}
		  ?>
		  </select>
		  
		 
		  </div>
		  </div>
		  
		
		
		
		<div class="form-group">
		  <label class="control-label col-md-3"> Sub Cat. Name:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <input type="text"   required="required" class="form-control" id="subcat_name" name="subcat_name" value="<?php echo $page['subcat_name'];?>" placeholder="Sub Cat.Name">
		 </div>
		  </div>


         <div class="form-group">
		  <label class="control-label col-md-3">Frequency:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <select name= "frequency" class="form-control" required="required">
		  <option value="weekly" <?php if(($page['frequency']) == 'weekly') {echo 'selected="selected"';}?>>Weekly</option>
		  <option value="daily" <?php if(($page['frequency']) == 'daily') {echo 'selected="selected"';}?>>Daily</option>
		  <option value="mid_monthly" <?php if(($page['frequency']) == 'mid_monthly') {echo 'selected="selected"';}?>>Mid Monthly</option>
		  <option value="monthly" <?php if(($page['frequency']) == 'monthly') {echo 'selected="selected"';}?>>Monthly</option>
		  <option value="yearly" <?php if(($page['frequency']) == 'yearly') {echo 'selected="selected"';}?>>Yearly</option>
		  </select>
		  </div>
		  </div>
		  
		 
		  
		  <!-- Group -->
						<div class="form-group">
							<label class="control-label col-md-3">Fixed/Variable :</label>
							<div class="col-md-4">
								<label><input type="radio" name="fixed_variable" id="fixed_variable" value="0" <?php if($page['fixed_variable'] == 0) {echo 'checked="checked"';}?>/>
									NO </label>
									<label><input type="radio" name="fixed_variable" value="1" id="fixed_variable" <?php if($page['fixed_variable'] == 1) {echo 'checked="checked"';}?>/>
										YES </label>
							</div>
						</div>
						<!-- // Group END -->
				  
		  
		  <div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" name='save_page' value='Save' class="btn btn-success"><i></i>Update</button>
						<a href="<?php echo base_url('/admin/company/add_expsubcat');?>"><button type="button" class="btn btn-primary" ><i></i>Cancel</button></a>
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
            cat_name: "required",
            subcat_name: "required",
			
		        },
			
		
        messages: {
            cat_name: "Please Select Cat.Name",
            subcat_name: "Please Enter  Name",
            
      
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
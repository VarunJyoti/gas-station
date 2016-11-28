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
                    <h2>Company<small>Edit Main Product Price</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <form class="form-horizontal" action="<?php echo base_url('admin/company/saveprice');?>" id="edit_page" method="post" autocomplete="off">
		<input class="form-control" id="p_id" name="p_id" type="hidden" value='<?php echo $this->uri->segment(4);?>'/>
		<input type="hidden"  value="<?php echo $page->id;?>" name="row_id" />
		<!-- Widget -->
		<div class="form-body">
							
				<!-- // Group END -->
						
						
						
						<!-- Group -->
						<?php	
				if($usr_type == 'admin')
   {
				?>
						<div class="form-group">
							<label class="control-label col-md-3" for="pro_name">Product Name <span class="required">* </span></label>
							<div class="col-md-4">
				<div class="col-md-4"><input class="form-control" readonly  value="<?php if($page->p_name){echo $page->p_name;}else{echo $page;}?>" name="pro_name" type="text" /><?php echo form_error('pro_name'); ?></div>
							
							</div>
						</div>
					<div class="form-group">
							<label class="control-label col-md-3" for="title">Price<span class="required">* </span></label>
							<div class="col-md-4">
				<div class="col-md-4"><input type="number" step="0.01" class="form-control" id="price" value="<?php echo $page->price;?>" name="price"   required="required" /><?php echo form_error('title'); ?></div>
							
							</div>
						</div>
						
						<input class="form-control" id="old_price"  value="<?php echo $page->s_price;?>" name="old_price" type="hidden" />
						
				<?php
   }
?>				
					</div>
					<!-- // Column END -->
					
					
					
				
				<!-- // Row END -->
			
				<!-- Row -->
				<div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" name='save_page' value='Save' class="btn btn-success"><i></i>Edit</button>
						<a href="<?php echo base_url('admin/company/');?>"><button type="button" class="btn btn-primary"><i></i>Cancel</button></a>
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

            

    //$('select').select2();  
    
    // Form Validation
    $("#edit_page").validate({
        rules: {
            pro_name: "required",
            price: "required",
           

        },
        messages: {
            pro_name: "Please Enter Product Name",
            price: "Please enter Price",
            
    

			},
	
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
	
	
<?php    
$statusss = $this->admin_login_model->CheckEnduser();
$status = $statusss->status;
if ($status != 'close')
{
?>
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
                <h3>Store Sales</h3>
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
                    <h2>Edit<small></small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <form class="form-horizontal" action="<?php echo base_url('admin/enduser/save_store_sales');?>" id="edit_page" method="post" autocomplete="off">
	<input class="form-control" id="id" name="id" type="hidden" value='<?php echo $page->id;?>'/>
	<!-- Table -->
	<table class="footable table table-striped table-bordered table-white table-primary">
	
		<!-- Table heading -->
		<thead>
		
			<tr>
				
				<th data-class="Title">Product Name</th>
				<th data-hide="Heading,tablet">Quantity</th>
				
			
				
				
			</tr>
		</thead>
		<!-- // Table heading END -->
		
		<!-- Table body -->
		<tbody>
		
			<!-- Table row -->
			
						
						<tr class="gradeX">
						
						 <td><input type="hidden" name="pid" value="<?php echo $page->pid;?>"> <input type="hidden" name="p_price" value="<?php echo $page->p_price;?>"><input class="txt" type="text" readonly name="p_name" id="p_name" placeholder="Product Name" value="<?php echo $this->gasolinereceived_model->getProductName($page->pid); ?>"></td>
						<td><input class="txt1" type="text" name="quantity" id="quantity" placeholder="Enter Particles" value="<?php echo $page->quantity;?>"></td>
						
					
				 <tr class="gradeX">
					<td colspan="2"><button type="submit" name='save_page' value='Save' class="btn btn-success"><i></i>Update</button>
						</td>
						
					</tr>
				
			
			<!-- // Table row END -->
			
			
		</tbody>
		<!-- // Table body END -->
		
	</table>
	<!-- // Table END -->
	</form>   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


	
<?php 
}
?>

<script>
$(document).ready(function(){  

    // Form Validation
    $("#edit_page").validate({
        rules: {
            name: "required",
            email: "required",
            pin: "required", 
			username: "required",

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
            name: "Please Enter Name",
            email: "Please enter Email",
            pin: "Please enter Pin",
            username: "Please enter username",			

    
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
	
	
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
                    <h2>Add C.Customer<small></small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 

     <form class="form-horizontal" action="<?php echo base_url('admin/company/savecreditcustomer');?>" id="edit_page" method="post" autocomplete="off">
		
		<div class="form-body">
		
		<div class="form-group">
		  <label class="control-label col-md-3">Name:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <input type="text"   required="required" class="form-control" id="name" name="name" value="" placeholder="Name">
		  <input type="hidden"  class="form-control" id="type" name="type" value="received">
		  </div>
		  </div>
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Email:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <input type="email"  required="required" class="form-control" id="email" name="email" value="" placeholder="Email Id">
		  </div>
		  </div>
		  
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Phone No:<span class="required">* </span></label>
		  <div class="col-md-4">
		  <input class="form-control" id="phone" name="phone" type="number" value="" required="required"/>
		  </div>
		  </div>
		  
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Credit Limit:</label>
		  <div class="col-md-4">
		  <input class="form-control" id="credit_limit" name="credit_limit" type="number" value=""/>
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
						<button type="submit" name='save_page' value='Save' class="btn btn-success"><i></i>Add</button>
						
					</div>
					</div>
				</div>	
		  
		
		
		
		</div>
		
		
		

	</form>
	<div>&nbsp;</div>
	<div>
	<table class="footable table table-striped table-bordered table-white table-primary">
	
		<!-- Table heading -->
		<thead>
			<tr>
				<th>Sr.No</th>
				<th data-class="Title">Name</th>
				<th data-hide="Heading,tablet">Email</th>
				<th data-hide="Heading,tablet">Phone No</th>
				<th data-hide="Heading,tablet">Credit Limit</th>
				<th data-hide="Heading,tablet">Date</th>
				<th data-hide="Heading,tablet">Action</th>
				
				
			
				
				
			</tr>
		</thead>
		<!-- // Table heading END -->
		
		<!-- Table body -->
		<tbody>
	
			<!-- Table row -->
			
			
			 <?php
				//$total = $this->daily_shift_model->getSumDropsReceived()->Drops_total;
				if(!empty($credit_customers)){
					
					$s_no =1;
					$a="$";
					if($start)
					{
					$s_no =$start+$s_no;
										
					}
					foreach($credit_customers as $pro)
					{
						//$drops_total+=count($pro->amount);
						//$strtotime = $pro->createtime;
						//$date = date('d M Y',$strtotime);
						
						echo ' <tr class="gradeX">';
						echo " <td>{$s_no}</td>";
						echo " <td>{$pro->name}</td>";
						echo " <td>{$pro->email}</td>";
						echo " <td>{$pro->phone}</td>";
						
						
						echo " <td>{$pro->credit_limit}</td>";
						echo " <td>{$pro->date_created}</td>";
						

						
						?>
						
						<td class="center"><a class='btn btn-primary btn-mini' href='<?php echo  base_url("admin/company/edit_creditcustomer/{$pro->id}");?>'><i class='icon-edit icon-white'></i> Edit </a>
						<button onclick='page_delete("<?php echo $pro->id;?>")' class='btn btn-primary btn-mini'><i class='icon-trash icon-white'></i> Delete</button> 
						
						
						
						</td>
					<?php
						$s_no++;
					}
				}else{
					echo ' <tr class="gradeX">';
					echo " <td>No record found</td>";
					echo "</tr>";
				}
				
			 ?>    
			
			

			
			
			
			 
				
						
			
			<!-- // Table row END -->
			
			
		</tbody>
		<!-- // Table body END -->
		
	</table>
	<!-- // Table END -->
	</div>				 
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









	function page_delete(id){
			var r = confirm("Are you sure you want to delete the record?");
			if (r == true) {
			location.href = '<?php echo base_url("admin/company/DeleteCreditCustomer");?>/'+id;
			} else {
				return false;
			}
			
	}
		
		
</script>
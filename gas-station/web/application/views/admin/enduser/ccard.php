<?php 
$CKEditor = new CKEditor(base_url()."ckeditor/");  
//$CKEditor->config['height'] = 200;
										
$CKEditor->config['width'] = '@@screen.width * 0.4'; 

 $userid = unserialize($this->session->userdata('admin'));
 $user_id = $userid['id'];
$user_id = $this->enduser_model->getUserNameById($user_id); 
$statusss = $this->admin_login_model->CheckEnduser();
$status = $statusss->status;
if ($status != 'close')
{
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
                <h3>Entry Management</h3>
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
                    <h2>Credit Card Entry<small></small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                 <form class="form-horizontal" action="<?php echo base_url('admin/enduser/saveccard');?>" id="edit_page" method="post" autocomplete="off">
		
		<div class="form-body">
		
		<div class="form-group">
		  <label class="control-label col-md-3">Name:</label>
		  <div class="col-md-4">
		  <input type="text" readonly  required="required" class="form-control" id="name" name="name" value="<?php echo $user_id;?>" placeholder="Name">
		  <input type="hidden"  class="form-control" id="type" name="type" value="received">
		  </div>
		  </div>
		  
		  
		   <div class="form-group">
		  <label class="control-label col-md-3">Select Card Type:</label>
		  <div class="col-md-4">
		  <select name="cc_type" class="form-control" required="required">
		  <option value="" selected>SELECT CARD</option>
		  <option value="mcard">Master Card</option>
		  <option value="visa">Visa</option>
		  <option value="citgo">Citgo</option>
		  <option value="discover">Discover</option>
		  <option value="wex">Wex</option>
		  <option value="voyager">Voyager</option>
		  </select>
		  
		  </div>
		  </div>
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Amount:</label>
		  <div class="col-md-4">
		  <input type="number"  required="required" class="form-control" id="amount" name="amount" value="<?php echo set_value('amount');?>" placeholder="Amount">
		  </div>
		  </div>
		  
		 
		  
		  <!--
		  <div class="form-group">
		  <label class="control-label col-md-3">Upload Photo:</label>
		  <div class="col-md-4">
		  <input class="form-control" id="p_image" name="p_image" type="file" value='<?php echo set_value('p_image');?>'/>
		  </div>
		  </div>
		  
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
				<th data-class="Title">Card Name</th>
				<th data-hide="Heading,tablet">Amount</th>
				
				<th data-hide="Heading,tablet">Date Time</th>
				<th data-hide="Heading,tablet">Action</th>
				
				
			
				
				
			</tr>
		</thead>
		<!-- // Table heading END -->
		
		<!-- Table body -->
		<tbody>
	
			<!-- Table row -->
			
			
			 <?php
				$total = $this->daily_shift_model->getSumOfCcard()->ccard_total;
				if(!empty($ccard)){
					
					$s_no =1;
					$a="$";
					if($start)
					{
					$s_no =$start+$s_no;
										
					}
					foreach($ccard as $pro)
					{
						$ccard_total+=count($pro->amount);
						$strtotime = $pro->createtime;
						$date = date('d M Y',$strtotime);
						
						echo ' <tr class="gradeX">';
						echo " <td>{$s_no}</td>";
						echo " <td>{$pro->cc_type}</td>";
						echo " <td>{$pro->amount}</td>";
						
						//echo " <td>&dollar;{$pro->p_price}</td>";
						
						
						
						echo " <td>{$pro->created_date}</td>";
						

						
						?>
						
						<td class="center"><a class='btn btn-primary btn-mini' href='<?php echo  base_url("admin/enduser/edit_ccardentry/{$pro->id}");?>'><i class='icon-edit icon-white'></i> Edit </a>
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
			
			
			<tr>
						<td colspan="2">Cards Total:</td><td colspan="5"><b><?php  echo number_format(round((float)$total,2),2); ?></b></td>
						
						</tr>
			
			
			
			 
				
						
			
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

<?php 
}
?>
<script type="text/javascript">
$(document).ready(function(){  

    // Form Validation
    $("#edit_page").validate({
        rules: {
            p_name: "required",
		        },
			
		
        messages: {
            p_name: "Please Enter Product Name",
      
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
			location.href = '<?php echo base_url("admin/enduser/deleteccard");?>/'+id;
			} else {
				return false;
			}
			
	}
		
		
</script>
<?php 
$CKEditor = new CKEditor(base_url()."ckeditor/");  
//$CKEditor->config['height'] = 200;
										
$CKEditor->config['width'] = '@@screen.width * 0.4'; 

 $userid = unserialize($this->session->userdata('admin'));
 $user_id = $userid['id'];   
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
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">	
	
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
	<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Drops Entry<small></small>
			</h3>
			<div class="page-bar">

	<!-- Widget -->
	<!--div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body center">
			<p class="lead margin-none">Unlimited Columns &amp; Expandable Rows. Tables for Desktop, Tablet &amp; Mobile. Resize your browser to try them.</p>
		</div>
	</div-->
	
	<h5 class="text-uppercase strong separator bottom margin-none"></h5>

	<form class="form-horizontal" action="<?php echo base_url('admin/enduser/savedrops');?>" id="edit_page" method="post" autocomplete="off">
		
		<div class="form-body">
		
		<div class="form-group">
		  <label class="control-label col-md-3">Name:</label>
		  <div class="col-md-4">
		  <input type="text" readonly  required="required" class="form-control" id="name" name="name" value="<?php echo $user_id;?>" placeholder="Name">
		  <input type="hidden"  class="form-control" id="type" name="type" value="received">
		  </div>
		  </div>
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Amount:</label>
		  <div class="col-md-4">
		  <input type="number"  required="required" class="form-control" id="amount" name="amount" value="<?php echo set_value('amount');?>" placeholder="Amount">
		  </div>
		  </div>
		  
		  
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
		  
		  
		  
		  <div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" name='save_page' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>Add</button>
						
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
				<th>Drops</th>
				<th data-class="Title">User id</th>
				<th data-hide="Heading,tablet">Amount</th>
				<th data-hide="Heading,tablet">Photo</th>
				<th data-hide="Heading,tablet">Description</th>
				<th data-hide="Heading,tablet">Date Time</th>
				<th data-hide="Heading,tablet">Action</th>
				
				
			
				
				
			</tr>
		</thead>
		<!-- // Table heading END -->
		
		<!-- Table body -->
		<tbody>
	
			<!-- Table row -->
			
			
			 <?php
				$total = $this->daily_shift_model->getSumDropsReceived()->Drops_total;
				if(!empty($drops)){
					
					$s_no =1;
					$a="$";
					if($start)
					{
					$s_no =$start+$s_no;
										
					}
					foreach($drops as $pro)
					{
						$drops_total+=count($pro->amount);
						$strtotime = $pro->createtime;
						$date = date('d M Y',$strtotime);
						
						echo ' <tr class="gradeX">';
						echo " <td>{$s_no}</td>";
						echo " <td>{$pro->name}</td>";
						echo " <td>{$pro->amount}</td>";
						
						//echo " <td>&dollar;{$pro->p_price}</td>";
						
						$path =FCPATH."/uploads/product/".$pro->p_image;
						 if($pro->p_image){
						if(file_exists($path))
						{
						echo " <td><img src='".base_url()."uploads/product/{$pro->p_image}' height='50px' weight='50px'></td>";	
						 }
							else{
							echo " <td><img src='".base_url()."uploads/product/default-product.jpg' height='50px' weight='50px'></td>";	
							}
						}
						else{
						echo " <td><img src='".base_url()."uploads/product/default-product.jpg' height='50px' weight='50px'></td>";	
						}
						echo " <td>{$pro->p_desc}</td>";
						echo " <td>{$pro->created_date}</td>";
						

						
						?>
						
						<td class="center"><a class='btn btn-primary btn-mini' href='<?php echo  base_url("admin/enduser/edit_drops/{$pro->id}");?>'><i class='icon-edit icon-white'></i> Edit </a>
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
						<td colspan="2">Drops Total:</td><td colspan="5"><b><?php  echo number_format(round((float)$total,2),2); ?></b></td>
						
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
	
<?php 
}
?>
<script type="text/javascript">
$(document).ready(function(){  

            
$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
    
    //$('select').select2();  
    
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
			location.href = '<?php echo base_url("admin/enduser/delete");?>/'+id;
			} else {
				return false;
			}
			
	}
		
		
</script>
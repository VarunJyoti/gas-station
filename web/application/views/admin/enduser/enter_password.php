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
			Confirm your Password<small></small>
			</h3>
			<div class="page-bar">

	<!-- Widget -->
	<!--div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body center">
			<p class="lead margin-none">Unlimited Columns &amp; Expandable Rows. Tables for Desktop, Tablet &amp; Mobile. Resize your browser to try them.</p>
		</div>
	</div-->
	
	<h5 class="text-uppercase strong separator bottom margin-none"></h5>

	<form class="form-horizontal" action="<?php echo base_url('admin/enduser/closedaily_shift');?>" id="close_page" name="close_page" method="post" onsubmit="return check_password();" autocomplete="off">
		
		<div class="form-body">
		
		<div class="form-group">
		  <label class="control-label col-md-3">Enter Your Password:</label>
		  <div class="col-md-4">
		  <input type="password"   required="required" class="form-control" id="password" name="password" value="">
		 
		  </div>
		  </div>
		
		  
		  
		  
		  <div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" name='close_page' value='OK' class="btn green btn-primary glyphicons circle_ok"><i></i>Submit</button>
						
					</div>
					</div>
				</div>	
		  
		
		
		
		</div>
		
		
		

	</form>
	<div>&nbsp;</div>
	<div>
	
	</div>
</div>
</div>
</div>
	
<?php 
}
?>
<script type="text/javascript">
function check_password()
{
var password = $('#password').val();
$.ajax({
	url:'<?php echo base_url('admin/enduser/ConfirmDailyPassword');?>',
	method: "POST",
 
  data: { password: password },
  success: function(result){
	  if(result == 'ok')
	  {
		  window.opener.document.getElementById("val1").value = "close_daily";
		 var button=window.opener.document.getElementById('add_page');
		    button.submit();
			window.close();
		 //alert(result); 
	  }
	  else{
		 alert(result);  
	  }
	 
	  
  }
})
return false;
}		
		
</script>
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
			Drops & Payouts Entry<small></small>
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
		<input class="form-control" id="id" name="id" type="hidden" value='<?php echo $page->id;?>'/>
		<div class="form-body">
		
		<div class="form-group">
		  <label class="control-label col-md-3">Name:</label>
		  <div class="col-md-4">
		  <input type="text" readonly  required="required" class="form-control" id="name" name="name" value="<?php echo $page->name;?>" placeholder="Name">
		  <input type="hidden"  class="form-control" id="type" name="type" value="<?php echo $page->type;?>">
		  </div>
		  </div>
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Amount:</label>
		  <div class="col-md-4">
		  <input type="number"  required="required" class="form-control" id="amount" name="amount" value="<?php echo $page->amount;?>" placeholder="Amount">
		  </div>
		  </div>
		  
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Upload Photo:</label>
		  <div class="col-md-4">
		  <input class="form-control" id="p_image" name="p_image" type="file" value='<?php echo set_value('p_image');?>'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($page->p_image){?>
								<img src="<?php echo base_url()?>/uploads/product/<?php echo $page->p_image?>" height="50px" weight="50px">
							<?php } ?>
		  </div>
		  </div>
		  
		  <div class="form-group">
		  <label class="control-label col-md-3">Description:</label>
		  <div class="col-md-4">
		   <?php 
                                        $CKEditor = new CKEditor(base_url()."ckeditor/"); 
										$CKEditor->config['width'] = '@@screen.width * 0.5';                           

										$CKEditor->editor("_p_desc", $page->p_desc); 										

									?> 
		  </div>
		  </div>
		  
		  
		  
		  <div class="form-actions">
					<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" name='save_page' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>Update</button>
						
					</div>
					</div>
				</div>	
		  
		
		
		
		</div>
		
		
		

	</form>
	<div>&nbsp;</div>
	<div>
	
	<!-- // Table END -->
	</div>
</div>
</div>
</div>
	
<?php 
}
?>
<script type="text/javascript">
$(function() {
    // Remove button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
        function(e) {
            e.preventDefault();
            $(this).closest('.form-inline').remove();
        }
    );
    // Add button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
        function(e) {
            e.preventDefault();
            var container = $(this).closest('[data-role="dynamic-fields"]');
            new_field_group = container.children().filter('.form-inline:first-child').clone();
            new_field_group.find('input').each(function(){
                $(this).val('');
            });
            container.append(new_field_group);
        }
    );
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
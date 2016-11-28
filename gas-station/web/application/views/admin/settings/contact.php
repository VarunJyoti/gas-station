<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">	
	
<?php
if($this->session->flashdata('error')) {
	echo $this->session->flashdata('error');
}?>

<h3 class="page-title">
Edit Site Setting  <small></small>
</h3>
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
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo base_url();?>admin/home/">Dashboard</a>
			<i class="fa fa-angle-right"></i>
		</li>
		
		<li>
			<a href="#">Edit Site Setting</a>
		</li>
	</ul>
	
</div>
<div class="row">
<div class="col-md-12">
	<!-- BEGIN VALIDATION STATES-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-gift"></i>Edit Site Setting
			</div>
			
		</div>
		<div class="portlet-body form">	
	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?php echo base_url('admin/settings/contact');?>" id="validateSubmitForm" method="post" enctype="multipart/form-data" novalidate="novalidate">
		<input class="span12" id="id" name="id" type="hidden" value='<?php echo $contact->id;?>'/>
		
		<div class="form-body">
				<div class="form-group">
					<label class="control-label col-md-3" for="website_title">Website Title</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="website_title" value="<?php echo $contact->website_title;?>" name="website_title"/>
					</div>
					
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="site_logo_image">Site Logo</label>
					<div class="col-md-4">
						<input type="file" class="form-control" id="site_logo_image" value="<?php echo $contact->site_logo_image;?>" name="site_logo_image"/>
					</div>
					<?php 
					$site_logo_image	=	 $contact->site_logo_image;
					if($site_logo_image){
						$docs_path_site_logo	=	DOCUMENT_ROOT_UPLOADS_FOLDER_PATH.'images/'.$site_logo_image;
						if(file_exists($docs_path_site_logo)){
							 $img_path =site_url("admin/settings/thumbs?image={$docs_path_site_logo}&h=100&w=100");
							echo "<img src='{$img_path}'>";
						}
					}
					
					?>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="site_favicon_icon">Site FavIcon Icon</label>
					<div class="col-md-4">
						<input type="file" class="form-control" id="site_favicon_icon" value="<?php echo $contact->site_favicon_icon;?>" name="site_favicon_icon"/>
					</div>
					<?php 
					$site_favicon_icon	=	 $contact->site_favicon_icon;
					if($site_favicon_icon){
						$docs_path_site_icon	=	DOCUMENT_ROOT_UPLOADS_FOLDER_PATH.'images/'.$site_favicon_icon;
						if(file_exists($docs_path_site_icon)){
							 $img_path =site_url("admin/settings/thumbs?image={$docs_path_site_icon}&h=100&w=100");
							echo "<img src='{$img_path}'>";
						}
					}
					
					?>
				</div>
				
				<div class="form-group">
					<label class="control-label col-md-3" for="fb_url">Facebook url</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="fb_url" value="<?php echo $contact->fb_url;?>" name="fb_url"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-md-3" for="twitter_url">Twitter url</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="twitter_url" value="<?php echo $contact->twitter_url;?>" name="twitter_url"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="you_tube">YouTube url</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="you_tube" value="<?php echo $contact->you_tube;?>" name="you_tube"/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3" for="from_email">From Email</label>
					<div class="col-md-4">
						<input type="text" class="form-control" id="from_email" value="<?php echo $contact->from_email;?>" name="from_email"/>
					</div>
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" name='edit_contact' value='Save' class="btn green btn-primary glyphicons circle_ok"><i></i>Save</button>
							<button type="reset" class="btn default">Reset</button>
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
<script>
$(function()
{
	// validate signup form on keyup and submit
	$("#validateSubmitForm").validate({
		rules: {
			website_title: "required",
			from_email: {
				required: true,
				email: true
			},
			
			
		},
		messages: {
			website_title: "required *",
			from_email: "required *"
			
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


	
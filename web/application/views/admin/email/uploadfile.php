<html>
<head>
<script src="<?php echo base_url();?>common/js/jquery-latest.js"></script>
<script src="<?php echo base_url();?>common/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>common/js/jquery.select.js"></script>
</head>
<body bgcolor="#f7fbff">
<form method="post" action="<?php echo base_url('admin/uploadfile/file_upload');?>" name ="upload_image" id="upload_image" class="required" enctype="multipart/form-data">
	<table width="100%" cellspacing="0" cellpadding="5" style='padding-left:30px;'>  
	<input type='hidden' id='id_image_filed' name='id_image_filed' value='<?php echo $id; ?>'>
	<input type='hidden' id='path' name='path' value='<?php echo $path; ?>'>
	
	<tr>
		<td><p style='color:#52758c;'>Select File:</p></td> 
		<td>
		<input type='file' name='userfile' id='upload_file' class="required" accept='jpeg|jpg|png|gif|pdf|doc' title='please select valid image'>
		</td>
	</tr>
	<span style='color:red;'><?php echo $error['error']; ?></span>
	<tr>
		<td></td>
		<td><input type='submit'  name='upload' value='upload'></td>
	</tr>
	<tr>
		<td colspan="2" style='color:#52758c;'>
</form>

	<script>
	  $(document).ready(function(){
		$("#upload_image").validate();
	  });
	</script>
	
	
		</td>
	</tr>
    </table>
</body>
</html>

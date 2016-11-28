	<?php 
				$CKEditor = new CKEditor(base_url()."ckeditor/");  
				//$CKEditor->config['height'] = 200;
														
				$CKEditor->config['width'] = '@@screen.width * 0.6';                           
														
				?>
<?php   
$CKEditor->editor("Email_content", $page->Email_content); 
?> 
<?php
class Uploadfile extends Admin_Controller
{
	var $original_path;
	var $resized_path;
	var $thumbs_path;
	
	function __construct()
	{
		parent::__construct();	
		$this->load->helper('url');
		$this->load->library('image_lib');  
	}	

	function index()
	{	
		$data['id'] = $this->uri->segment(4); 
		$this->load->view('admin/uploadfile',$data); // home
	}
	public function do_upload(){
		//return the full path of the directory
		//make sure these directories have read and write permessions
		$this->original_path = $_SERVER['DOCUMENT_ROOT']. "/uploads/room_images/";
		//$this->resized_path = $_SERVER['DOCUMENT_ROOT']. "/uploads/hotels/medium/";
		//$this->thumbs_path = $_SERVER['DOCUMENT_ROOT']. "/uploads/hotels/thumbs/";
	
		$id_image_filed = $this->input->post('id_image_filed');
	
		$data['id'] = $id_image_filed;
		if($this->input->post('upload')){
			$config = array(
				'upload_path'   => $this->original_path,
				'allowed_types' => 'gif|jpg|png',
				'max_size'      => '2048', //2MB max
				'max_width'     => '1000000',
				'max_height'    => '1000000',
				'encrypt_name'  => true,
			);

			$this->load->library('upload', $config);
			
			
			if (!$this->upload->do_upload()) {
				$data['error'] = array('error' => $this->upload->display_errors());
				//$this->load->view('upload_form', $error);
				//print_r($data);die('test');
				$this->load->view('admin/uploadfile',$data);
			} else {
				$upload_data = $this->upload->data();//upload the image
				
				//your desired config for the resize() function
				/*$config = array(
				'source_image'      => $upload_data['full_path'], //path to the uploaded image
				'new_image'         => $this->resized_path, //path to
				'maintain_ratio'    => true,
				'width'             => 128,
				'height'            => 128
				);*/
			 
				//this is the magic line that enables you generate multiple thumbnails
				//you have to call the initialize() function each time you call the resize()
				//otherwise it will not work and only generate one thumbnail
				//$this->image_lib->initialize($config);
				//$this->image_lib->resize();
			
				/*$config = array(
				'source_image'      => $upload_data['full_path'],
				'new_image'         => $this->thumbs_path,
				'maintain_ratio'    => true,
				'width'             => 36,
				'height'            => 36
				);*/
				//here is the second thumbnail, notice the call for the initialize() function again
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			
			
			
				$data_ary = array(
					'title'     => $upload_data['client_name'],
					'file'      => $upload_data['file_name'],
					'width'     => $upload_data['image_width'],
					'height'    => $upload_data['image_height'],
					'type'      => $upload_data['image_type'],
					'size'      => $upload_data['file_size'],
					'date'      => time(),
				);
				$file_name = $upload_data['file_name'];
				$id_show_image = $id_image_filed.'_1';
				$img_path = VIEW_UPLOADS_FOLDER_IMAGES.'room_images/'.$file_name;
				$SITE_URL = SITE_URL.'common/bootstrap/img/remove-icon-small.png';
				$function_parmeter = '"'.$file_name.'"'.','.'"'.$id_show_image.'"';
				$function_name = 'imageDelete('.$function_parmeter.')';
				echo "<script>
				var image_html ='<div class=\"control-group $id_show_image\">';
					image_html +='<label class=\"control-label\">Image :</label>';
					image_html +='<div class=\"controls\"><ul class=\"image_list_ul\">';
					image_html +='<li class=\"li_image_class\" style=\"width:100px;height:100px;\">';
					image_html +='<img src=".$img_path.">';
					image_html +='<a onclick=\'$function_name\'><span class=\"collapse-toggle\" style=\"cursor:pointer;float: right;  margin: -85px -14px 0 13px;\"><img src=\"$SITE_URL\" style=\"vertical-align: top;\"></span></a></li>';
					image_html +='</ul></div>';
					image_html +='</div>'; 
				window.opener.document.getElementById('$id_image_filed').value='$file_name';
				window.opener.document.getElementById('$id_show_image').innerHTML = image_html;
				window.close();
				</script> ";
				//print_r($upload_data);die('test');
			}
		}
	} 
	// delete image form folder
	public function deleteImageFromFolder(){
		$img_name = $this->input->post('img_name');
		$directory = DOCUMENT_ROOT_HOTELS_IMAGES.$img_name;
		$directory_thumbs = DOCUMENT_ROOT_HOTELS_IMAGES.'thumbs/'.$img_name;
		$directory_medium = DOCUMENT_ROOT_HOTELS_IMAGES.'medium/'.$img_name;
		
		if(file_exists($directory)){
			@unlink($directory);
			@unlink($directory_thumbs);
			@unlink($directory_medium);
			
		}	
		die('1');
		exit;
	}
	
	/*** File upload for all type like this pdf, docs, img ***/
	function fileupload()
	{	
		$data['id'] = $this->uri->segment(4);
		$data['path'] = $this->uri->segment(5);	
		
		$this->load->view('admin/email/uploadfile',$data); // home
		
	}
	
	/*** File upload action perform ****/
	
	public function file_upload(){
		//return the full path of the directory
		//make sure these directories have read and write permessions
		
		//$this->resized_path = $_SERVER['DOCUMENT_ROOT']. "/uploads/hotels/medium/";
		//$this->thumbs_path = $_SERVER['DOCUMENT_ROOT']. "/uploads/hotels/thumbs/";
	
		$id_image_filed = $this->input->post('id_image_filed');
		$path = $this->input->post('path');
		$data['id'] = $id_image_filed;
		$data['path'] = $path;
		//print_r($this->input->post());die('hello');
		if(!empty($path))
			$this->original_path = $_SERVER['DOCUMENT_ROOT']. "/uploads/{$path}/";
		else
			$this->original_path = $_SERVER['DOCUMENT_ROOT']. "/uploads/templates/";
		if($this->input->post('upload')){
			$config = array(
				'upload_path'   => $this->original_path,
				'allowed_types' => 'gif|jpg|png|pdf|doc',
				'max_size'      => '2048', //2MB max
				'max_width'     => '1000000',
				'max_height'    => '1000000',
				'encrypt_name'  => true,
			);

			$this->load->library('upload', $config);
			
			
			if (!$this->upload->do_upload()) {
				$data['error'] = array('error' => $this->upload->display_errors());
				$this->load->view('admin/email/uploadfile',$data);
			} else {
				$upload_data = $this->upload->data();//upload the image
				$data_ary = array(
					'title'     => $upload_data['client_name'],
					'file'      => $upload_data['file_name'],
					'width'     => $upload_data['image_width'],
					'height'    => $upload_data['image_height'],
					'type'      => $upload_data['image_type'],
					'size'      => $upload_data['file_size'],
					'date'      => time(),
				);
				$file_name = $upload_data['file_name'];
				$id_show_image = $id_image_filed.'_1';
					
				
				$this->load->model('hotel_details_model');
									
				if(!empty($path)){
					$img_path =site_url("main/thumbs?image={$this->hotel_details_model->show_thumb($file_name,$path)}&h=100&w=100");
					//$img_path = VIEW_UPLOADS_FOLDER_IMAGES.$path.'/'.$file_name;
				}
				else{ 
					$path = 'bank';
					$img_path =site_url("main/thumbs?image={$this->hotel_details_model->show_thumb($file_name,$path)}&h=100&w=100");
					$img_path = VIEW_UPLOADS_FOLDER_IMAGES.'bank/'.$file_name;
				}
				$file_ext = $upload_data['file_ext'];
				//|| $file_ext == '.doc'
				if($file_ext == '.pdf'){
					$SITE_URL = SITE_URL.'common/bootstrap/img/remove-icon-small.png';
					$function_parmeter = '"'.$file_name.'"'.','.'"'.$id_show_image.'"'.','.'"'.$path.'"';
					$function_name = 'imageDelete('.$function_parmeter.')';
					$filepath = base_url()."uploads/templates/{$file_name}";
					echo "<script>
					var image_html ='<div class=\"control-group $id_show_image\">';
						image_html +='<label class=\"control-label\"></label>';
						image_html +='<div class=\"controls\"><ul class=\"image_list_ul\">';
						image_html +='<li class=\"li_image_class\">';
						image_html +='<object height=\"200\" width=\"100%\" data=\"$filepath\" type=\"application/pdf\" width=\"200\"></object>';
						image_html +='<a title=\"delete\" onclick=\'$function_name\'><span class=\"collapse-toggle\" style=\"cursor:pointer\"><img src=\"$SITE_URL\" style=\"vertical-align: top;\"></span></a></li>';
						image_html +='</ul></div>';
						image_html +='</div>'; 
					window.opener.document.getElementById('$id_image_filed').value='$file_name';
					window.opener.document.getElementById('$id_show_image').innerHTML = image_html;
					window.close();
					</script> ";
					
					/*echo "<script>
						window.opener.document.getElementById('$id_image_filed').value='$file_name';
						window.close();
						</script> ";*/
				}else{
					$SITE_URL = SITE_URL.'common/bootstrap/img/remove-icon-small.png';
					$function_parmeter = '"'.$file_name.'"'.','.'"'.$id_show_image.'"'.','.'"'.$path.'"';
					$function_name = 'imageDelete('.$function_parmeter.')';
					echo "<script>
					var image_html ='<div class=\"control-group $id_show_image\">';
						image_html +='<label class=\"control-label\"></label>';
						image_html +='<div class=\"controls\"><ul class=\"image_list_ul\">';
						image_html +='<li class=\"li_image_class\">';
						image_html +='<img src=".$img_path.">';
						image_html +='<a title=\"delete\" onclick=\'$function_name\'><span class=\"collapse-toggle\" style=\"cursor:pointer\"><img src=\"$SITE_URL\" style=\"vertical-align: top;\"></span></a></li>';
						image_html +='</ul></div>';
						image_html +='</div>'; 
					window.opener.document.getElementById('$id_image_filed').value='$file_name';
					window.opener.document.getElementById('$id_show_image').innerHTML = image_html;
					window.close();
					</script> ";
				}	
				
				//print_r($upload_data);die('test');
			}
		}
	} 
	
	
}
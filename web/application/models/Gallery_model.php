<?php
class Gallery_model extends My_Model {
	
	function Gallery_model() {
	parent::__construct();
		$this->load->library('image_lib');
		//$this->load->library('easyphpthumbnail');
		
	}
	
	function do_upload($path,$file,$type="jpg|jpeg|gif|png") 
	{	
		$config = array(
			'allowed_types' => $type,
			'upload_path' => $path,
			'max_size' => 2000
		);		
		
		if(!file_exists ($path)) {
			mkdir($path,0777,true);
		}
		
		$this->load->library('image_lib');
		$this->load->library('upload', $config);
		$this->upload->do_upload($file);
		
		if($this->upload->data())
		{
			$image_data = $this->upload->data();	
			//print_r($image_data);die('123');
			$this->image_lib->clear();
			return $image_data['file_name'];
		} else {//print_r($config);die('else');
			$this->session->set_flashdata('error',  $this->image_lib->display_errors());
			return false;
		}

		
	}


	function do_thumb($path,$file_path) {

		$config = array(
			'source_image' => $file_path,
			'new_image' => $path . '/thumbs',
			'maintain_ration' => true,
			'width' => 100,
			'height' => 150
		);
		
		 if(!file_exists ($config['new_image'])) {
			mkdir($config['new_image'],0777);
		}
		$this->load->library('image_lib', $config);
		if(!$this->image_lib->resize())
		 $this->image_lib->display_errors();
	}


	function watermark($path,$file_path)
	{		
		$config = array(
			'source_image' => $file_path,
			'new_image' => $path.'watermark',
			'image_library' => 'GD2',

			// 'wm_text'=> 'ART RAGA Gallery Copyright',
			// 'wm_type'=> 'text',
			// 'wm_font_size'	=> '25',
			// 'wm_font_color'=> 'ffffff',
			// 'wm_vrt_alignment'=> 'bottom',
			// 'wm_hor_alignment'=> 'right',
			// 'wm_padding'=> '0',
			// 'wm_font_path'=> 'web/system/fonts/texb.ttf'
			'wm_type'=> 'overlay',
			'wm_overlay_path' => 'image/logo.png', //logo.jpg
			'wm_vrt_alignment' => 'middle',
			'wm_hor_alignment' => 'center'

		);  


		 if(!file_exists ($config['new_image'])) {
			mkdir($config['new_image'],0777,true);
		}

		
        $this->image_lib->initialize($config);
        if($this->image_lib->watermark())
        {
        } else {
        	$errror =  $this->image_lib->display_errors();
        	$this->session->set_flashdata('error', $error);

        }       	
	
        $this->image_lib->clear();
    }


 function do_crop($path,$file_path,$x,$y,$w,$h){		
		$config['image_library'] = 'gd2';
	    $config['source_image'] = $file_path;
	    $config['new_image'] = $path.'crop';	   
	    $config['maintain_ratio'] = FALSE;
	    $config['x_axis'] = $x;
	    $config['y_axis'] = $y;
	    $config['width'] = $w;
	    $config['height'] = $h;
	    $config['dynamic_output'] = FALSE;
	    if(!file_exists ($config['new_image'])) {
			mkdir($config['new_image'],0777);
		}
		$this->load->library('image_lib');
        $this->image_lib->initialize($config);
       	$this->image_lib->crop();  	
	
        $this->image_lib->clear();
}


public function viewThumb($path,$width=100,$height=100,$aspeectRation=true)
{
	
	//$url = realpath($this->gallery_path."/temp/images");
	//$dir = str_replace(chr(92),chr(47),$path);


	//echo $dir.$name;

	$config['image_library'] 	=	'gd2';
	$config['source_image'] 	=	$path;
	//$config['new_image'] 		=	$url;
	$config['maintain_ratio'] 	=	TRUE;
	$config['width'] 			=	$width;
	$config['height'] 			= 	$height;
	$config['dynamic_output']	=	TRUE;

	$this->image_lib->initialize($config);

	if($this->image_lib->resize())
	{
				
		$this->image_lib->clear();


	} else {
		echo $this->image_lib->display_errors();
	}
	// die;


}

public function data($index = NULL)
	{
		$data = array(
				'file_name'		=> $this->file_name,
				'file_type'		=> $this->file_type,
				'file_path'		=> $this->upload_path,
				'full_path'		=> $this->upload_path.$this->file_name,
				'raw_name'		=> str_replace($this->file_ext, '', $this->file_name),
				'orig_name'		=> $this->orig_name,
				'client_name'		=> $this->client_name,
				'file_ext'		=> $this->file_ext,
				'file_size'		=> $this->file_size,
				'is_image'		=> $this->is_image(),
				'image_width'		=> $this->image_width,
				'image_height'		=> $this->image_height,
				'image_type'		=> $this->image_type,
				'image_size_str'	=> $this->image_size_str,
			);

		if ( ! empty($index))
		{
			return isset($data[$index]) ? $data[$index] : NULL;
		}

		return $data;
	}


	public function is_image()
	{
		// IE will sometimes return odd mime-types during upload, so here we just standardize all
		// jpegs or pngs to the same file type.

		$png_mimes  = array('image/x-png');
		$jpeg_mimes = array('image/jpg', 'image/jpe', 'image/jpeg', 'image/pjpeg');

		if (in_array($this->file_type, $png_mimes))
		{
			$this->file_type = 'image/png';
		}
		elseif (in_array($this->file_type, $jpeg_mimes))
		{
			$this->file_type = 'image/jpeg';
		}

		$img_mimes = array('image/gif',	'image/jpeg', 'image/png');

		return in_array($this->file_type, $img_mimes, TRUE);
	}
	
	

	
}




		//
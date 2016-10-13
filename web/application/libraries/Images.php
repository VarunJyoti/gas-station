<?php 
class Images extends My_Model {
	
	function __construct()
	{
		parent::__construct();	
		$this->load->helper('url');
		$this->load->database();
		
	}
	public function test()
	{	
		$query  =  $this->db->get('admin');
		// print_r($query->result());
		return 'hello world';
	}
	function do_upload($property_id=null,$table='room_images')
	{ 
   
		foreach ($_FILES['images']['name'] as $name => $value){
			if(is_uploaded_file($_FILES['images']['tmp_name'][$name])) {
				$sourcePath = $_FILES['images']['tmp_name'][$name];
				$directory = $_SERVER['DOCUMENT_ROOT']. "/uploads/hotels";
				
				$image_name = $_FILES['images']['name'][$name];
				$temp = explode(".", $image_name);
				$extension = end($temp);
				$a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','Ð','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','?','?','J','j','K','k','L','l','L','l','L','l','?','?','L','l','N','n','N','n','N','n','?','O','o','O','o','O','o','Œ','œ','R','r','R','r','R','r','S','s','S','s','S','s','Š','š','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Ÿ','Z','z','Z','z','Ž','ž','?','ƒ','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','?','?','?','?','?','?');
				$b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');
				$image_names = strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'),array('','-',''),str_replace($a,$b,$temp[0])));
				
				$filename = $image_names.time();
				
				$targetPath = $directory.$filename.'.'.$extension;
				
				// Replace underscores delimiter with slash
				$dir = str_replace ("___", "/", $directory);
				
				if (!file_exists($dir)) {
					mkdir($dir, 0777, true);
				}
				
				$targetPath = $directory. DS .$filename.'.'.$extension;
				
				if(move_uploaded_file($sourcePath,$targetPath)) {
					$image = $filename.'.'.$extension;
					$data['property_id']		=	$property_id;
					$data['image']				=	$image;	
					//	print_r($data);die('hello');
					$last_id = $this->db->insert($table ,$data);
						
					
				}else{
					return false;
				}
			}
		}
		return true;
	}
}
/*$dir_property_detail = $directory.'propertImage_'.$property_detail_id;
				if (!file_exists($dir_property_detail)) {
					$dir_property_detail = mkdir($dir_property_detail, 0777, true);
				}*/
?> 
<?php
class Mail_model extends CI_Model {
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
	
	}

	
	
	public function sendEmail($mailer){			
		// Email configuration
		$config = Array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'ssl://smtp.gmail.com',
			  'smtp_port' => 465,
			  'smtp_user' => 'rahul.sptech@gmail.com', // change it to yours
			  'smtp_pass' => '8950858031@1234', // change it to yours
			  'mailtype' => 'html',
			  'charset' => 'iso-8859-1',
			  'wordwrap' => TRUE
		);	
		
		
		
		
		$this->load->library('email', $config);
		
		$this->email->from($mailer['from'], "rahul.sptech@gmail.com");
		$this->email->to($mailer['to']);
		//$this->email->cc($mailer['from']);
		$this->email->subject($mailer['subject']);
		$this->email->message($mailer['message']);
		if(!empty($mailer['attach'])){
			$count = count($mailer['attach']);
			if($count > 0){
				foreach($mailer['attach'] as $attach){
					$path = DOCUMENT_ROOT_UPLOADS_FOLDER_PATH.'templates/'.$attach;
					$this->email->attach($path);
				}
			}
			
		}
		
		//$this->email->attach($mailer['subject']);
		
		
		$this->email->set_mailtype("html");	
		$data['message'] = "Sorry Unable to send email...";	
		if($this->email->send()){					
			// echo "send"		;
			// echo $this->email->print_debugger();
			return true;
			
		} else {
			
			return false;
		}	
		 				
		
	}


	






	


		
}
















?>
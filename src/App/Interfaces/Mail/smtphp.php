<?php
	namespace App\Interfaces\Mail;	
	class smtphp extends \App\handlers\configurator{
		private $config,$mailer;
		function init($config){
			$this->config = $config;
			$this->create();
		}
		
		function __construct(){
			parent::__construct("mail");
		}
		
		public function create(){
            $this->mailer = new \PHPMailer(true);
            $this->mailer->IsSMTP();
            $this->mailer->SMTPAuth   = $this->config->SMTPAuth;
            $this->mailer->Host       = $this->config->Host;
            $this->mailer->Port       = $this->config->Port;
            $this->mailer->Username   = $this->config->Username;
            $this->mailer->Password   = $this->config->Password;
            
		}
		
		function send ($sender=null,$recipient=null,$subject="",$message="") {
		    if ($sender==null||!isset($sender['address'])||!isset($sender['name'])){
		        $sender['name'] = $this->config->Sender->name;
		        $sender['address'] = $this->config->Sender->address;
		    }
		    if ($recipient==null||!isset($recipient['address'])||!isset($recipient['name'])){
		        return false;
		    }
		    
		    $this->mailer->SetFrom($sender['address'], $sender['name']);
            $this->mailer->AddAddress($recipient['address'], $recipient['name']);
            $this->mailer->Subject    = $subject;
            $this->mailer->MsgHTML($message);
            
            return $this->mailer->Send()? true: $this->mailer->ErrorInfo;
		}
	}			
?>
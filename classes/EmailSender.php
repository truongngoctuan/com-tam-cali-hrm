<?php
/*
This file is part of iCE Hrm.

iCE Hrm is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

iCE Hrm is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with iCE Hrm. If not, see <http://www.gnu.org/licenses/>.

------------------------------------------------------------------

Original work Copyright (c) 2012 [Gamonoid Media Pvt. Ltd]  
Developer: Thilina Hasantha (thilina.hasantha[at]gmail.com / facebook.com/thilinah)
 */
abstract class EmailSender{
	var $settings = null;
	public function __construct($settings){
		$this->settings	= $settings;	
	}
	
	public function sendEmail($subject, $toEmail, $template, $params){
		
		$body = $template;	

		foreach($params as $k=>$v){
			$body = str_replace("#_".$k."_#", $v, $body);	
		}
		$fromEmail = "ICE Hrm <".$this->settings->getSetting("Email: Email From").">";
		$this->sendMail($subject, $body, $toEmail, $fromEmail);
	}	
	
	protected  abstract function sendMail($subject, $body, $toEmail, $fromEmail);
}


class SNSEmailSender extends EmailSender{
	var $ses = null;
	public function __construct($settings){
		parent::__construct($settings);
		$this->ses = new AmazonSES($this->settings->getSetting('Email: Amazon SNS Key'),$this->settings->getSetting('Email: Amazone SNS Secret'));
	}
	
	protected  function sendMail($subject, $body, $toEmail, $fromEmail) {

        $toArray = array('ToAddresses' => array($toEmail),
        				'CcAddresses' => null,
        				'BccAddresses' => null);
        $message = array( 
	        'Subject' => array(
	            'Data' => $subject,
	            'Charset' => 'iso-8859-1'
	        ),
	        'Body' => array(
	            'Html' => array(
	                'Data' => $body,
	                'Charset' => 'iso-8859-1'
	            )
	        )
    	);
    	
    	$response = $ses->send_email($fromEmail, $toArray, $message);
    	
    	return $response->isOK();
    	
    }
}


class SMTPEmailSender extends EmailSender{
	
	public function __construct($settings){
		parent::__construct($settings);
	}
	
	protected  function sendMail($subject, $body, $toEmail, $fromEmail) {

		$host = $this->settings->getSetting("Email: SMTP Host");
		$username = $this->settings->getSetting("Email: SMTP User");
		$password = $this->settings->getSetting("Email: SMTP Password");
		
		if($this->settings->getSetting("Email: SMTP Authentication Required") == "0"){
			$auth = array ('host' => $host,
     		'auth' => false);	
		}else{
			$auth = array ('host' => $host,
     		'auth' => true,
     		'username' => $username,
     		'password' => $password);	
		}
		
		
		$smtp = Mail::factory('smtp',$auth);

		$headers = array ('MIME-Version' => '1.0',
  		'Content-type' => 'text/html',
  		'charset' => 'iso-8859-1',
  		'From' => $fromEmail,
  		'To' => $toEmail,
   		'Subject' => $subject);
		
		$mail = $smtp->send($toEmail, $headers, $body);
		return true;
    }
}
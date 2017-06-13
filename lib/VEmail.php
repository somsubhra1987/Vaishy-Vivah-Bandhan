<?php
/**
* Description: Library function for send email
* Added in version: 1.0
*/ 
namespace app\lib;
use Yii;
use yii\helpers\Html;
use app\lib\Core;

class VEmail extends Core
{
	public function sendHtmlEmail($email, $subject, $fromName, $fromEmail, $cc=false, $bcc=false,  $body)
	{
		$name = '=?UTF-8?B?'.base64_encode($fromName).'?=';
		$subject = '=?UTF-8?B?'.base64_encode($subject).'?=';
		$headers = "From: $name <{$fromEmail}>\r\n";
		if(strlen($cc)) $headers .= "Cc: " .$cc. "\r\n";;
		if(strlen($bcc)) $headers .= "Bcc: " .$bcc. "\r\n";
		$headers .= "Reply-To: {$fromEmail}\r\n".
			"MIME-Version: 1.0\r\n".
			"Content-Type: text/html; charset=UTF-8" . "\r\n" . 
			"X-Mailer: PHP/" . phpversion();
		mail($email, $subject, $body, $headers);
	}

	public function sendNewRegisterMail($model){
		$subject = "Thank you for Register in Vivah Bandhan";
		
		$content = "Thanks for create your account in  Vivah Bandhan. <br/>
		Here is you credentials to login Vivah Bandhan.<br/>
		User ID : [[EMAIL]] <br/> Password : [[PASSWORD]]";
		$content = str_replace("[[EMAIL]]", $model->email, $content);
		$content = str_replace("[[PASSWORD]]", $model->userPassword, $content);
		
		$senderName = "VaishyVivahBandhan";
		$senderEmail = "noreply@vaishyvivahbandhan.com";
		$toEmail = $model->email;
		$cc = '';
		$bcc = '';				
		self::sendHtmlEmail($toEmail, $subject, $senderName, $senderEmail, $cc, $bcc, $content);
	}
}

?>
<?php
namespace app\lib;

use Yii;

class Sms
{
	private $smsBaseUrl = 'https://malert.in/api/api_http.php';
	private $smsUserName = 'vvbandhan';
	private $smsPassword = 'vvbandhan@2018';
	private $smsSenderID = 'VVIVAH';
	private $smsBody = array('afterRegistration' => 'Welcome to  www.vaishyvivahbandhan.com. Stay connected to view new & updated matches. Upgrade your membership for more verified matches with personal details.', 'otpRequired' => 'Please enter OTP XXXXXX to complete procedure.');
	private $smsRoute = 'Transaction';
	private $smsType = 'text';
	
	public function sendSms($mobileNumber, $isdCode, $smsTextType)
	{
		$mobileNumber = $isdCode.$mobileNumber;
		$smsText = $this->smsBody[$smsTextType];
		if($smsTextType == 'otpRequired')
		{
			$smsText = str_replace('XXXXXX', rand(111111, 999999),$smsText);
		}
		$url = $this->smsBaseUrl.'?username='.$this->smsUserName.'&password='.$this->smsPassword.'&senderid='.$this->smsSenderID.'&to='.$mobileNumber.'&text='.rawurlencode($smsText).'&route='.$this->smsRoute.'&type='.$this->smsType;
		
		#$url = http_build_query(array('username' => $this->smsUserName, 'password' => $this->smsPassword, 'senderid' => $this->smsSenderID, 'to' => $mobileNumber, 'text' => $smsText, 'route' => $this->route, 'type' => $this->smsType));
		//return $url;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
		$curlResponse=curl_exec($ch);
		curl_close($ch);
		
		return json_encode(array($curlResponse, $smsText));
	}
}
?>
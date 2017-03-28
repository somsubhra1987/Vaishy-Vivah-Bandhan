<?php

namespace app\lib;

use Yii;
use yii\db\Command;

class Core
{
	function printR($var, $exit=true)
	{
		echo "<pre>";
		print_r($var);
		echo "</pre>";
		
		if($exit) exit();
	}
	
	public function getAssoc($sql)
	 {
	 	$arr = array();
	 	$rows = Yii::$app->db->createCommand($sql)
            ->queryAll();
		foreach($rows as $row)
		{
			$arr[$row['id']] = $row['name'];
		}
		
		return $arr;
	 }

	 public function getLoggedUserID()
	 {
	 	if(!isset(Yii::$app->user->getIdentity()->id) || !Yii::$app->user->getIdentity()->id) return 0;

	    return Yii::$app->user->getIdentity()->id;
	 }

	function getLoggedUser()
    {
	    $userID = self::getLoggedUserID();	    
	    $user = self::getUser($userID);	    
	    return $user;
    }

    function getUser($userID)
    {
    	$db = Yii::$app->db;
	    $user = new \StdClass();
	    
	    if(!$userID) return $user;
	    
	    $user->userID = $userID;
	    
	    $sql = "SELECT
	    			userID as id, 
	    			firstName as name,
	    			gender	    			 	    				    		
	   			FROM user_master
	    		WHERE userID = :userID ";
	    $cmd = $db->createCommand($sql);
	    $cmd->bindValue(':userID', $user->userID);
	    $row = $cmd->queryOne();
	    $user->id =$row['id'];	    
	    $user->name =$row['name'];
	    $user->gender =$row['gender'];
	    return $user;
	}

	public function getUploadedPath()
	{
		$uploadedPath = Yii::$app->basePath."/web/datafiles";
		return $uploadedPath;
	}

	public function getRootUrl()
	{
		$rootUrl = Yii::$app->request->baseUrl;
		return $rootUrl;
	}
	public function getDatafilesUrl()
	{
	  $url = self::getRootUrl() . "/datafiles";
	  return $url;
	}
	public function getUploadedUrl()
	{
	  $url = self::getDatafilesUrl();
	  return $url;
	}

	function getFileExtension($localFileName)
	{
		$localFileExt = strrchr($localFileName,".");
		$localFileExt = strtolower($localFileExt);
		return $localFileExt;
	}

	public function createErrorlist($errorArr)
	{
$errorAssoc = $errorArr;

$error = <<<EOF
<div class="error-summary">
	<p>Please fix the following errors:</p>
	<ul>
EOF;
		foreach ($errorAssoc as $key) {
			$errorData = $key[0];
$error .= <<<EOF
<li>$errorData</li>
EOF;
		}
$error .= <<<EOF
	</ul>
</div>
EOF;
return $error;
	}



	function getData($sql, $placeholders=false)
	{
		$db = Yii::$app->db;
		$cmd = $db->createCommand($sql);
		if(is_array($placeholders))
		{
			foreach($placeholders as $name=>$value)
			{
				$name = trim($name);
				if(substr($name, 0, 1) != ":") $name = ":" . $name;
			
				$cmd->bindValue($name, $value);	
			}
		}
		$data = $cmd->queryScalar();
		
		return $data;
	}

	function getRows($sql, $placeholders=false)
	{
		$db = Yii::$app->db;
		$cmd = $db->createCommand($sql);
		
		if(is_array($placeholders))
		{
			foreach($placeholders as $name=>$value)
			{
				$name = trim($name);
				if(substr($name, 0, 1) != ":") $name = ":" . $name;
			
				$cmd->bindValue($name, $value);	
			}
		}
				
		$rows = $cmd->queryAll();		
		
		return $rows;
	}

	public function getFilePath($refID, $refTable, $filethumb = true){
		$uploadedPath = self::getUploadedUrl();
	  	$uploadedPath .=  "/".$refTable."/";
	  	if($filethumb){
	  	$uploadedPath .= "thumb/thumb_";
	  	}
	  	$sql = "SELECT 
	  				fileName 
	  			FROM user_uploaded_images WHERE refID = :refID 
	  			AND refTable = :refTable 
	  			";
	  	$fileName = self::getData($sql, array(':refID'=>$refID, ':refTable'=>$refTable));
	  	if($fileName){
	  	$uploadedPath .= $fileName;	
	  	return $uploadedPath;
	  	}
	}

	public function generateProfileID(){
		$profileID = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNPQRSTUVWXYZ',2)),0,1);
		$profileID .= substr(str_shuffle(str_repeat('0123456789',8)),0,7);

		$sql = "SELECT profileID FROM user_master WHERE profileID = :profileID ";
		$data = self::getData($sql, array('profileID'=>$profileID));
		if($data){
		self::generateProfileID();
		}
		return $profileID;
	}

	public function getAgeList()
	{
		$ageFrm = 18;
		$ageTo = 60;
		$arr = array();
		$arr2 = array();
		for($i = $ageFrm; $i<= $ageTo; $i++)
		{
			$arr[] = $i;
		}

		foreach($arr as $row)
		{
			$arr2[$row] = $row;
		}
		return $arr2;
	}

	public function getHeightList()
	{
		$ageFrm = 4;
		$ageTo = 10;
		$arr = array();
		$arr2 = array();
		for($i = $ageFrm; $i<= $ageTo; $i++)
		{
			$arr[] = $i;
			for($j=1; $j<10;$j++)
			{
				$arr[] = $i.'.'.$j;	
			}
			
		}

		foreach($arr as $row)
		{
			$arr2[$row] = $row;
		}
		return $arr2;
	}

	public function getAgeByDate($dob){		
		$date = date('Y-m-d');
		$sql = "SELECT ceil (DATEDIFF('$date', '$dob')/365) as age";
		$age= self::getData($sql);
		return $age;
	}

	public function prepareDate($year, $end = false){
		if($end){
			$createDate = date('Y-m-d', mktime(0,0,0, '12', '31', date('Y')-$year));
		}
		else{
			$createDate = date('Y-m-d', mktime(0,0,0, '01', '01', date('Y')-$year));
		}
		
		return $createDate;
	}

	public function getOpositeGender($gender = 'Male'){
		if($gender == 'Male'){
			return 'Female';
		}
		else{
			return 'Male';
		}
	}
}
	

?>
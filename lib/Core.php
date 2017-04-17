<?php

namespace app\lib;

use Yii;
use yii\db\Command;
use yii\helpers\FileHelper;
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

	function getRow($sql, $placeholders=false)
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
				
		$row = $cmd->queryOne();		
		return $row;
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

	function getLoggedAdmin()
    {
	    $admin = new \StdClass();
	    $admin->adminID = Yii::$app->session['loggedAdminID'];
	    
	    $sql = "SELECT
	    			AG.adminGroupCode,
	    			AG.super,
	    			AG.adminGroupID,
	    			AG.adminGroupCode,
	    			A.username,
	    			CONCAT(A.firstName, ' ', A.lastName) AS adminName
	    		FROM app_admin A
	    			INNER JOIN app_admin_group AG USING(adminGroupID)
	    		WHERE A.adminID = :adminID ";
	    $row = self::getRow($sql, array('adminID'=>$admin->adminID));
	    
	    $admin->groupCode = $row['adminGroupCode'];
	    $admin->superFlag =$row['super'];
	    $admin->username =$row['username'];
	    $admin->groupID =$row['adminGroupID'];
	    $admin->name =$row['adminName'];
	    $admin->groupCode =$row['adminGroupCode'];
	    
	    return $admin;
    }

    function getModuleName($moduleCode)
	{		
			$sql = "SELECT moduleName FROM app_module WHERE moduleCode = '$moduleCode'";
			return self::getData($sql);
	}
	
	function getControllerName($controllerID)
	{	
			$sql = "SELECT controllerName FROM app_controller WHERE controllerID = '$controllerID'";			
			return self::getData($sql);
	}

	public function getAllModules()
	{
		$modules = Yii::$app->getModules();
		unset($modules['gii']);
		unset($modules['debug']);
		
		$moduleArr = array_keys($modules);
		
		foreach($moduleArr as $module)
		{
			$submodules = Yii::$app->getModule($module)->getModules();
            $submoduleArr = array_keys($submodules);
            
 			foreach($submoduleArr as $submodule)
 			{
 				$moduleArr[] = $module ."/". $submodule;
       		}
		}
		
		asort($moduleArr);
		$moduleArr[] = "root";
		
		return $moduleArr;
	}
		
	function getModuleAssoc()
	{
		$sql = "SELECT moduleCode, moduleName
				FROM app_module
				ORDER BY moduleName";
				
		return self::getDropdownAssoc($sql);
	}
	function getDropdownAssoc($sql)
	{
		$arr = array();
		
		$db = Yii::$app->db;
		
		$cmd = $db->createCommand($sql);
		$rows = $cmd->queryAll();
		
		foreach($rows as $row)
		{
			$rowArr = array();
			foreach($row as $val)
			{
				$rowArr[] = $val;
			}
			
			$arr[$rowArr[0]] = $rowArr[1];
		}

		return $arr;
	}
	function getModuleControllerAssoc($moduleCode)
	{
		$allControllerNameArr = self::getModuleControllers($moduleCode);
		
		$arr = array();
		foreach($allControllerNameArr AS $value)
		{
			$arr[$value] = $value;
		}
		
		return $arr;
	}
	
	// added by Nibedita // getModuleControllers
	public function getModuleControllers($moduleCode)
	{
		$allModuleNameArr = self::getAllModules();
		//App::printR($allModuleNameArr);
		
		$appModulePath = self::getModulesPath(); 
		 
		$appControllerPathArr = array();
		foreach($allModuleNameArr as $value)
		{
			if($moduleCode == $value && $value == 'root')
			{
				$appControllerPath = self::getRootPath() . DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR .'controllers';
				$appControllerPathArr[] = $appControllerPath;
			}
			elseif($moduleCode == $value)
			{
				$appControllerPathArr[] = $appModulePath.DIRECTORY_SEPARATOR.$value.DIRECTORY_SEPARATOR."controllers";
			}
		}
		
		$controllersArr = array();
		foreach($appControllerPathArr as $appControllerPath)
		{
            if(is_dir($appControllerPath))
            {
                $fileLists = FileHelper::findFiles($appControllerPath);            
	            foreach($fileLists as $controllerPath)
	            { 
	                $controllersArr[] = substr($controllerPath,  strrpos($controllerPath, DIRECTORY_SEPARATOR)+1,-4); 
	            	 
	            }
        	}
        }
		
        return $controllersArr;
           
    }
	

    public function getRootPath()
	{
		$rootPath = Yii::$app->basePath;
		return $rootPath;
	}

	public function getModulesPath()
	{
		$path = self::getRootPath() . "/modules";
		return $path;
	}
	
	public function getCountryAssoc()
	{
		$sql = "SELECT countryCode, countryName FROM app_country ORDER BY countryName";
		$countryList = self::getDropdownAssoc($sql);
		return $countryList;
	}
	public function getCountryName($countryCode)
	{
		$sql = "SELECT countryName FROM app_country WHERE countryCode = :countryCode";
		return self::getData($sql, array(':countryCode'=>$countryCode));
	}
	function getAdminGroupAssoc()
	{	
		$sql = "SELECT adminGroupID,title 
				FROM app_admin_group
				ORDER BY title";
		return self::getDropdownAssoc($sql);
	}
}
?>
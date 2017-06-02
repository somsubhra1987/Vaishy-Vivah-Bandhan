<?php

namespace app\lib;

use Yii;
use yii\db\Command;
use yii\helpers\FileHelper;
use app\lib\Core;

class CustomFunctions
{
	function getEducationAssoc()
	{
		$sql = "SELECT educationID, degree
				FROM user_education
				ORDER BY degree";
				
		return Core::getDropdownAssoc($sql);
	}
	
	function getEmploymentSectorAssoc()
	{
		$sql = "SELECT employmentSectorID, sectorName
				FROM user_employment_sector
				ORDER BY sectorName";
				
		return Core::getDropdownAssoc($sql);
	}
	
	function getOccupationAssoc()
	{
		$sql = "SELECT occupationID, occupation
				FROM user_occupation
				ORDER BY occupation";
				
		return Core::getDropdownAssoc($sql);
	}
	
	function getBodyTypeAssoc()
	{
		$sql = "SELECT bodyTypeID, bodyType
				FROM user_body_type
				ORDER BY bodyType";
				
		return Core::getDropdownAssoc($sql);
	}
	
	function getStateAssoc($countryID)
	{
		$sql = "SELECT stateID, state
				FROM user_state
				WHERE countryID = '$countryID'
				ORDER BY state";
				
		return Core::getDropdownAssoc($sql);
	}

	function getProfileCreatedForAssoc()
	{
		$sql = "SELECT ID, createdFor
				FROM app_profilecreated_for
				ORDER BY createdFor ASC";
		return Core::getDropdownAssoc($sql);
	}
	
	function getReligionAssoc()
	{
		$sql = "SELECT religionID, religion
				FROM user_religion
				ORDER BY religion ASC";
		return Core::getDropdownAssoc($sql);
	}
	
	function getCasteAssoc($religionID = 0)
	{
		$whereCond = "";
		if($religionID > 0)
		{
			$whereCond = " WHERE religionID = '$religionID'";
		}
		$sql = "SELECT casteID, caste
				FROM user_caste	
				$whereCond
				ORDER BY caste ASC";
		return Core::getDropdownAssoc($sql);
	}
	
	function getGothramAssoc($religionID = 0)
	{
		$whereCond = "";
		if($religionID > 0)
		{
			$whereCond = " WHERE religionID = '$religionID'";
		}
		$sql = "SELECT gothramID, gothram
				FROM user_gothram
				$whereCond
				ORDER BY gothram ASC";
		return Core::getDropdownAssoc($sql);
	}
}
?>
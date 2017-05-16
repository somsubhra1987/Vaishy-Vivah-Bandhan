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
}
?>
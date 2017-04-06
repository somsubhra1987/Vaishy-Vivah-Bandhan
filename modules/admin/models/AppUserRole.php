<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "app_user_role".
 *
 * @property integer $userRoleID
 * @property string $userRoleCode
 * @property string $title
 * @property string $loggedInUrl
 */
class AppUserRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_user_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userRoleCode', 'title', 'loggedInUrl'], 'required'],
            [['userRoleCode', 'title'], 'string', 'max' => 30],
            [['loggedInUrl'], 'string', 'max' => 255],
            [['userRoleCode'], 'unique'],
            [['title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userRoleID' => 'ID',
            'userRoleCode' => 'User Role Code',
            'title' => 'Title',
            'loggedInUrl' => 'Logged In Url',
        ];
    }
    
    public function getUserRoleList()
    {
	    $roleArr = array();
	    
		$db = Yii::$app->db;
		
		$sql = "SELECT 
					userRoleID,
					title
				FROM app_user_role
				ORDER BY title	
				";
		
		$cmd = $db->createCommand($sql);
		$rows = $cmd->queryAll();
		
		foreach($rows as $row)
		{
			$rowArr = array();
			foreach($row as $val)
			{
				$rowArr[] = $val;
			}
			
			$roleArr[$rowArr[0]] = $rowArr[1];
		}

		return $roleArr;    
	}
}

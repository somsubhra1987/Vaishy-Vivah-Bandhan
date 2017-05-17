<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "app_settings".
 *
 * @property string $settingsID
 * @property string $type
 * @property string $value
 */
class Settings extends \yii\db\ActiveRecord
{
	public $contactPerson, $designation, $address, $contactNo, $whatsappNo, $emailID, $facebookLink, $twitterLink, $gplusLink, $youtubeLink, $rssLink, $mapLink;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['value'], 'string'],
            [['type'], 'string', 'max' => 255],
            [['type'], 'unique'],
			[['value', 'contactPerson', 'contactNo', 'whatsappNo', 'emailID', 'facebookLink', 'twitterLink', 'gplusLink', 'youtubeLink', 'rssLink', 'mapLink', 'designation', 'address'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'settingsID' => 'Settings ID',
            'type' => 'Type',
            'value' => 'Value',
			'contactPerson' => 'Contact Person',
			'contactNo' => 'Contact No',
			'whatsappNo' => 'Whatsapp No',
			'emailID' => 'Email ID',
			'facebookLink' => 'Facebook Link',
			'twitterLink' => 'Twitter Link',
			'gplusLink' => 'Gplus Link',
			'youtubeLink' => 'Youtube Link',
			'rssLink' => 'RSS Link',
			'mapLink' => 'Google Map Link',
			'designation' => 'Designation',
			'address' => 'Address',
        ];
    }
	
	public function truncateTable()
	{
	 	Yii::$app->db->createCommand("TRUNCATE TABLE `app_settings`")->execute();
		return true;
	}
}

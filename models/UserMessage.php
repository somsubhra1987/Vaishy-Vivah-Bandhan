<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_message".
 *
 * @property string $messageID
 * @property string $mobileNumber
 * @property string $messageBody
 * @property string $createdDateTime
 * @property string $apiResponse
 */
class UserMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobileNumber', 'messageBody', 'apiResponse'], 'required'],
            [['messageBody', 'apiResponse'], 'string'],
            [['createdDateTime'], 'safe'],
            [['mobileNumber'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'messageID' => 'Message ID',
            'mobileNumber' => 'Mobile Number',
            'messageBody' => 'Message Body',
            'createdDateTime' => 'Created Date Time',
            'apiResponse' => 'Api Response',
        ];
    }
}

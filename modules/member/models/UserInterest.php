<?php

namespace app\modules\member\models;

use Yii;

/**
 * This is the model class for table "user_interest".
 *
 * @property string $interestID
 * @property string $sendByUserID
 * @property string $sendToUserID
 * @property string $messageSent
 * @property string $sendAt
 * @property integer $viewStatus
 * @property integer $acceptedRejectedStatus
 * @property string $acceptedRejectedAt
 */
class UserInterest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_interest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sendByUserID', 'sendToUserID'], 'required'],
            [['sendByUserID', 'sendToUserID', 'viewStatus', 'acceptedRejectedStatus'], 'integer'],
            [['messageSent'], 'string'],
            [['sendAt', 'viewStatus', 'acceptedRejectedStatus', 'acceptedRejectedAt', 'messageSent'], 'safe'],
			[['sendByUserID', 'sendToUserID'], 'unique', 'targetAttribute' => ['sendByUserID', 'sendToUserID'], 'message' => 'You have already send interest to this user'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'interestID' => 'Interest ID',
            'sendByUserID' => 'Send By',
            'sendToUserID' => 'Send To',
            'messageSent' => 'Message',
            'sendAt' => 'Send At',
            'viewStatus' => 'Status',
            'acceptedRejectedStatus' => 'Accepted / Rejected',
            'acceptedRejectedAt' => 'Accepted / Rejected At',
        ];
    }
}

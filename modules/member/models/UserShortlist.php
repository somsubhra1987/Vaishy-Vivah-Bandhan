<?php

namespace app\modules\member\models;

use Yii;

/**
 * This is the model class for table "user_shortlist".
 *
 * @property string $shortlistID
 * @property string $shortlistedByUserID
 * @property string $shortlistedUserID
 * @property string $shortlistedAt
 * @property integer $status
 */
class UserShortlist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_shortlist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shortlistedByUserID', 'shortlistedUserID', 'status'], 'required'],
            [['shortlistedByUserID', 'shortlistedUserID', 'status'], 'integer'],
            [['shortlistedAt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shortlistID' => 'Shortlist ID',
            'shortlistedByUserID' => 'Shortlisted By User ID',
            'shortlistedUserID' => 'Shortlisted User ID',
            'shortlistedAt' => 'Shortlisted At',
            'status' => 'Status',
        ];
    }
}

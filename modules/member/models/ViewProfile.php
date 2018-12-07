<?php

namespace app\modules\member\models;

use Yii;

/**
 * This is the model class for table "user_view_profile".
 *
 * @property string $viewProfileID
 * @property string $viewedByUserID
 * @property string $viewedUserID
 * @property string $viewedAt
 * @property integer $status
 */
class ViewProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_view_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['viewedByUserID', 'viewedUserID', 'status'], 'required'],
            [['viewedByUserID', 'viewedUserID', 'status'], 'integer'],
            [['viewedAt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'viewProfileID' => 'View Profile ID',
            'viewedByUserID' => 'Viewed By User ID',
            'viewedUserID' => 'Viewed User ID',
            'viewedAt' => 'Viewed At',
            'status' => 'Status',
        ];
    }
}

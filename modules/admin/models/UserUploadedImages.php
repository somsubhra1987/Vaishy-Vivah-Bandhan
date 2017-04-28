<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user_uploaded_images".
 *
 * @property string $ID
 * @property string $fileName
 * @property integer $refID
 * @property string $refTable
 * @property integer $adminVerifiedStatus
 * @property integer $showInDp
 */
class UserUploadedImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_uploaded_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fileName', 'refID', 'refTable', 'adminVerifiedStatus', 'showInDp'], 'required'],
            [['refID', 'adminVerifiedStatus', 'showInDp'], 'integer'],
            [['fileName'], 'string', 'max' => 255],
            [['refTable'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'fileName' => 'File Name',
            'refID' => 'Ref ID',
            'refTable' => 'Ref Table',
            'adminVerifiedStatus' => 'Admin Verified Status',
            'showInDp' => 'Show In Dp',
        ];
    }
}

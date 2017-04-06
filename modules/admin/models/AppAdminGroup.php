<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "app_admin_group".
 *
 * @property integer $adminGroupID
 * @property string $adminGroupCode
 * @property string $title
 * @property integer $super
 */
class AppAdminGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_admin_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['adminGroupCode', 'title'], 'required'],
            [['super'], 'integer'],
            [['adminGroupCode', 'title'], 'string', 'max' => 30],
            [['adminGroupCode'], 'unique'],
            [['title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'adminGroupID' => 'ID',
            'adminGroupCode' => 'Admin Group Code',
            'title' => 'Title',
            'super' => 'Super',
        ];
    }
}

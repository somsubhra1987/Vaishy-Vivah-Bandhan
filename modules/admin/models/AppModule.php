<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "app_module".
 *
 * @property string $moduleCode
 * @property string $moduleName
 * @property integer $active
 */
class AppModule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_module';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['moduleCode', 'moduleName', 'active'], 'required'],
            [['active'], 'integer'],
            [['moduleCode', 'moduleName'], 'string', 'max' => 50],
            [['moduleName'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'moduleCode' => 'Module Code',
            'moduleName' => 'Module Name',
            'active' => 'Active',
        ];
    }
}

<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "app_controller".
 *
 * @property integer $controllerID
 * @property string $moduleCode
 * @property string $controllerName
 * @property integer $active
 */
class AppController extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_controller';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['moduleCode', 'controllerName', 'active'], 'required'],
            [['active'], 'integer'],
            [['moduleCode', 'controllerName'], 'string', 'max' => 50],
            [['controllerName', 'moduleCode'], 'unique', 'targetAttribute' => ['controllerName', 'moduleCode'], 'message' => 'The combination of Module Code and Controller Name has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'controllerID' => 'Controller ID',
            'moduleCode' => 'Module Code',
            'controllerName' => 'Controller Name',
            'active' => 'Active',
        ];
    }
}

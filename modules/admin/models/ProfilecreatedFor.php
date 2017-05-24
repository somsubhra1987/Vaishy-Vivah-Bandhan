<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "app_profilecreated_for".
 *
 * @property string $ID
 * @property string $createdFor
 */
class ProfilecreatedFor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_profilecreated_for';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createdFor'], 'required'],
            [['createdFor'], 'string', 'max' => 255],
            [['createdFor'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'createdFor' => 'Created For',
        ];
    }
}

<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user_religion".
 *
 * @property string $religionID
 * @property string $religion
 */
class Religion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_religion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['religion'], 'required'],
            [['religion'], 'string', 'max' => 100],
            [['religion'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'religionID' => 'Religion ID',
            'religion' => 'Religion',
        ];
    }
}

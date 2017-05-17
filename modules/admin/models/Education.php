<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user_education".
 *
 * @property string $educationID
 * @property string $degree
 */
class Education extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_education';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['degree'], 'required'],
            [['degree'], 'string', 'max' => 255],
            [['degree'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'educationID' => 'Education ID',
            'degree' => 'Degree',
        ];
    }
}

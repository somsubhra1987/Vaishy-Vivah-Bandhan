<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user_occupation".
 *
 * @property string $occupationID
 * @property string $occupation
 */
class Occupation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_occupation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['occupation'], 'required'],
            [['occupation'], 'string', 'max' => 255],
            [['occupation'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'occupationID' => 'Occupation ID',
            'occupation' => 'Occupation',
        ];
    }
}

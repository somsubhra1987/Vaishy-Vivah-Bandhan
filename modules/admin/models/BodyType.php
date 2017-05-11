<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user_body_type".
 *
 * @property string $bodyTypeID
 * @property string $bodyType
 */
class BodyType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_body_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bodyType'], 'required'],
            [['bodyType'], 'string', 'max' => 255],
            [['bodyType'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bodyTypeID' => 'Body Type ID',
            'bodyType' => 'Body Type',
        ];
    }
}

<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user_gothram".
 *
 * @property string $gothramID
 * @property string $religionID
 * @property string $gothram
 */
class Gothram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_gothram';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['religionID', 'gothram'], 'required'],
            [['religionID'], 'integer'],
            [['gothram'], 'string', 'max' => 100],
            [['religionID', 'gothram'], 'unique', 'targetAttribute' => ['religionID', 'gothram'], 'message' => 'The combination of Religion ID and Gothram has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gothramID' => 'Gothram ID',
            'religionID' => 'Religion ID',
            'gothram' => 'Gothram',
        ];
    }
}

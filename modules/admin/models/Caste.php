<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user_caste".
 *
 * @property string $casteID
 * @property string $religionID
 * @property string $caste
 */
class Caste extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_caste';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['religionID', 'caste'], 'required'],
            [['religionID'], 'integer'],
            [['caste'], 'string', 'max' => 100],
            [['religionID', 'caste'], 'unique', 'targetAttribute' => ['religionID', 'caste'], 'message' => 'The combination of Religion ID and Caste has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'casteID' => 'Caste ID',
            'religionID' => 'Religion ID',
            'caste' => 'Caste',
        ];
    }
}

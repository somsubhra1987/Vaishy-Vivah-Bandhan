<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user_state".
 *
 * @property string $stateID
 * @property string $state
 * @property string $countryID
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state', 'countryID'], 'required'],
            [['countryID'], 'integer'],
            [['state'], 'string', 'max' => 255],
            [['state', 'countryID'], 'unique', 'targetAttribute' => ['state', 'countryID'], 'message' => 'The combination of State and Country ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stateID' => 'State ID',
            'state' => 'State',
            'countryID' => 'Country ID',
        ];
    }
}

<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user_country".
 *
 * @property string $countryID
 * @property string $country
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country'], 'required'],
            [['country'], 'string', 'max' => 255],
            [['country'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'countryID' => 'Country ID',
            'country' => 'Country',
        ];
    }
}

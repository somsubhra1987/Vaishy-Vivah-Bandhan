<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user_employment_sector".
 *
 * @property string $employmentSectorID
 * @property string $sectorName
 */
class EmploymentSector extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_employment_sector';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sectorName'], 'required'],
            [['sectorName'], 'string', 'max' => 255],
            [['sectorName'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'employmentSectorID' => 'Employment Sector ID',
            'sectorName' => 'Sector Name',
        ];
    }
}

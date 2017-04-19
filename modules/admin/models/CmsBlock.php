<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "cms_block".
 *
 * @property string $blockID
 * @property string $blockCode
 * @property string $title
 * @property string $content
 */
class CmsBlock extends \yii\db\ActiveRecord
{
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blockCode', 'title', 'content'], 'required'],
            [['content'], 'string'],
            [['blockCode', 'title'], 'string', 'max' => 50],
            [['blockCode'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'blockID' => 'Block ID',
            'blockCode' => 'Block Code',
            'title' => 'Title',
            'content' => 'Content',
        ];
    }	
}
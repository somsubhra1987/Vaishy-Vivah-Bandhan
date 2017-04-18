<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "cms_page_type".
 *
 * @property integer $pageTypeID
 * @property string $pageTypeCode
 * @property string $title
 * @property string $folderName
 * @property integer $listingOrder
 * @property integer $showInSitemap
 */
class CmsPageType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_page_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pageTypeCode', 'title', 'folderName'], 'required'],
            [['listingOrder', 'showInSitemap'],'safe'],
            [['listingOrder', 'showInSitemap'],'default','value'=>'0'],
            [['listingOrder', 'showInSitemap'], 'integer'],
            [['pageTypeCode'], 'string', 'max' => 30],
            [['title', 'folderName'], 'string', 'max' => 50],
            [['pageTypeCode'], 'unique'],
            [['title'], 'unique'],
            [['folderName'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pageTypeID' => 'Page Type ID',
            'pageTypeCode' => 'Page Type Code',
            'title' => 'Title',
            'folderName' => 'Folder Name',
            'listingOrder' => 'Listing Order',
            'showInSitemap' => 'Show In Sitemap',
        ];
    }
}

<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\CmsPage;

/**
 * CmsPageSearch represents the model behind the search form about `app\modules\admin\cms\models\CmsPage`.
 */
class CmsPageSearch extends CmsPage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pageID', 'pageTypeID', 'refID', 'showInSitemap', 'active'], 'integer'],
            [['templateDir', 'pageName', 'friendlyName', 'content', 'refTable', 'seoTitle', 'seoDescription', 'seoKeyword', 'seoH1Headline', 'extraHeader', 'altTag', 'dateCreated', 'lastSeoUpdateOn', 'lastContentUpdateOn', 'sitemapPriority', 'sitemapChangeFreq'], 'safe'],
            [['listingOrder'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CmsPage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=> ['defaultPageSize' => 10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'pageID' => $this->pageID,
            'pageTypeID' => $this->pageTypeID,
            'refID' => $this->refID,
            'dateCreated' => $this->dateCreated,
            'lastSeoUpdateOn' => $this->lastSeoUpdateOn,
            'lastContentUpdateOn' => $this->lastContentUpdateOn,
            'showInSitemap' => $this->showInSitemap,
            'listingOrder' => $this->listingOrder,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'templateDir', $this->templateDir])
            ->andFilterWhere(['like', 'pageName', $this->pageName])
            ->andFilterWhere(['like', 'friendlyName', $this->friendlyName])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'refTable', $this->refTable])
            ->andFilterWhere(['like', 'seoTitle', $this->seoTitle])
            ->andFilterWhere(['like', 'seoDescription', $this->seoDescription])
            ->andFilterWhere(['like', 'seoKeyword', $this->seoKeyword])
            ->andFilterWhere(['like', 'seoH1Headline', $this->seoH1Headline])
            ->andFilterWhere(['like', 'extraHeader', $this->extraHeader])
            ->andFilterWhere(['like', 'altTag', $this->altTag])
            ->andFilterWhere(['like', 'sitemapPriority', $this->sitemapPriority])
            ->andFilterWhere(['like', 'sitemapChangeFreq', $this->sitemapChangeFreq]);

        return $dataProvider;
    }
}

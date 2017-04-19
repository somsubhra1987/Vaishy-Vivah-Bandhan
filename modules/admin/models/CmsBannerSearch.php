<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\CmsBanner;

/**
 * CmsBannerSearch represents the model behind the search form about `app\modules\admin\cms\models\CmsBanner`.
 */
class CmsBannerSearch extends CmsBanner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bannerID', 'regionBannerID', 'active', 'clickCount'], 'integer'],
            [['bannerTypeCode', 'title', 'image', 'textContent', 'htmlContent', 'targetPage', 'targetFile', 'target', 'dateTimeCreated'], 'safe'],
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
        $query = CmsBanner::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'bannerID' => $this->bannerID,
            'regionBannerID' => $this->regionBannerID,
            'active' => $this->active,
            'dateTimeCreated' => $this->dateTimeCreated,
            'clickCount' => $this->clickCount,
            'listingOrder' => $this->listingOrder,
        ]);

        $query->andFilterWhere(['like', 'bannerTypeCode', $this->bannerTypeCode])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'textContent', $this->textContent])
            ->andFilterWhere(['like', 'htmlContent', $this->htmlContent])
            ->andFilterWhere(['like', 'targetPage', $this->targetPage])
            ->andFilterWhere(['like', 'targetFile', $this->targetFile])
            ->andFilterWhere(['like', 'target', $this->target]);

        return $dataProvider;
    }
}

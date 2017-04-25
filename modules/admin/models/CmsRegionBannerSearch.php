<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\CmsRegionBanner;

/**
 * CmsRegionBannerSearch represents the model behind the search form about `app\modules\admin\cms\models\CmsRegionBanner`.
 */
class CmsRegionBannerSearch extends CmsRegionBanner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['regionBannerID', 'bannerWidth', 'bannerHeight', 'bannerLimit', 'needLink'], 'integer'],
            [['title', 'description'], 'safe'],
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
        $query = CmsRegionBanner::find();

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
            'regionBannerID' => $this->regionBannerID,
            'bannerWidth' => $this->bannerWidth,
            'bannerHeight' => $this->bannerHeight,
            'bannerLimit' => $this->bannerLimit,
            'needLink' => $this->needLink,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}

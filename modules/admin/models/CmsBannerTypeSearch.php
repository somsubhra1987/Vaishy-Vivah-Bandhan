<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\CmsBannerType;

/**
 * CmsBannerTypeSearch represents the model behind the search form about `app\modules\admin\cms\models\CmsBannerType`.
 */
class CmsBannerTypeSearch extends CmsBannerType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bannerTypeCode', 'title'], 'safe'],
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
        $query = CmsBannerType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'bannerTypeCode', $this->bannerTypeCode])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}

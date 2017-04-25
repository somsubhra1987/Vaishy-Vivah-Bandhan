<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\CmsRegion;

/**
 * CmsRegionSearch represents the model behind the search form about `app\modules\admin\cms\models\CmsRegion`.
 */
class CmsRegionSearch extends CmsRegion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['regionID', 'listingOrder', 'isShared'], 'integer'],
            [['themeDir', 'regionCode', 'title'], 'safe'],
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
        $query = CmsRegion::find();

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
            'regionID' => $this->regionID,
            'listingOrder' => $this->listingOrder,
            'isShared' => $this->isShared,
        ]);

        $query->andFilterWhere(['like', 'themeDir', $this->themeDir])
            ->andFilterWhere(['like', 'regionCode', $this->regionCode])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}

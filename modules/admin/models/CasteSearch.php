<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Caste;

/**
 * CasteSearch represents the model behind the search form about `app\modules\admin\models\Caste`.
 */
class CasteSearch extends Caste
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['casteID', 'religionID'], 'integer'],
            [['caste'], 'safe'],
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
        $query = Caste::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'casteID' => $this->casteID,
            'religionID' => $this->religionID,
        ]);

        $query->andFilterWhere(['like', 'caste', $this->caste]);

        return $dataProvider;
    }
}

<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\EmploymentSector;

/**
 * EmploymentSectorSearch represents the model behind the search form about `app\modules\admin\models\EmploymentSector`.
 */
class EmploymentSectorSearch extends EmploymentSector
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employmentSectorID'], 'integer'],
            [['sectorName'], 'safe'],
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
        $query = EmploymentSector::find();

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
            'employmentSectorID' => $this->employmentSectorID,
        ]);

        $query->andFilterWhere(['like', 'sectorName', $this->sectorName]);

        return $dataProvider;
    }
}
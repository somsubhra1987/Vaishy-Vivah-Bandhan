<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Testimonials;

/**
 * TestimonialsSearch represents the model behind the search form about `app\modules\admin\models\Testimonials`.
 */
class TestimonialsSearch extends Testimonials
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['testimonialsID'], 'integer'],
            [['groomName', 'groomShortDescription', 'brideName', 'brideShortDescription', 'coupleImage'], 'safe'],
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
        $query = Testimonials::find();

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
            'testimonialsID' => $this->testimonialsID,
        ]);

        $query->andFilterWhere(['like', 'groomName', $this->groomName])
            ->andFilterWhere(['like', 'groomShortDescription', $this->groomShortDescription])
            ->andFilterWhere(['like', 'brideName', $this->brideName])
            ->andFilterWhere(['like', 'brideShortDescription', $this->brideShortDescription])
            ->andFilterWhere(['like', 'coupleImage', $this->coupleImage]);

        return $dataProvider;
    }
}

<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\AppController;

/**
 * AppControllerSearch represents the model behind the search form about `app\modules\admin\models\AppController`.
 */
class AppControllerSearch extends AppController
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['controllerID', 'active'], 'integer'],
            [['moduleCode', 'controllerName'], 'safe'],
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
        $query = AppController::find();

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
            'controllerID' => $this->controllerID,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'moduleCode', $this->moduleCode])
            ->andFilterWhere(['like', 'controllerName', $this->controllerName]);

        return $dataProvider;
    }
}

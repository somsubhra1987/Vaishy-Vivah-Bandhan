<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\AppModule;

/**
 * AppModuleSearch represents the model behind the search form about `app\modules\admin\models\AppModule`.
 */
class AppModuleSearch extends AppModule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['moduleCode', 'moduleName'], 'safe'],
            [['active'], 'integer'],
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
        $query = AppModule::find();

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
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'moduleCode', $this->moduleCode])
            ->andFilterWhere(['like', 'moduleName', $this->moduleName]);

        return $dataProvider;
    }
}

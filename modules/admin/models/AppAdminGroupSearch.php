<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\AppAdminGroup;

/**
 * AppAdminGroupSearch represents the model behind the search form about `app\modules\admin\models\AppAdminGroup`.
 */
class AppAdminGroupSearch extends AppAdminGroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['adminGroupID', 'super'], 'integer'],
            [['adminGroupCode', 'title'], 'safe'],
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
        $query = AppAdminGroup::find();

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
            'adminGroupID' => $this->adminGroupID,
            'super' => $this->super,
        ]);

        $query->andFilterWhere(['like', 'adminGroupCode', $this->adminGroupCode])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}

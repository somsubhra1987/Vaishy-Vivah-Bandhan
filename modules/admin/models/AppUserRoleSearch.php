<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\AppUserRole;

/**
 * AppUserRoleSearch represents the model behind the search form about `app\modules\admin\models\AppUserRole`.
 */
class AppUserRoleSearch extends AppUserRole
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userRoleID'], 'integer'],
            [['userRoleCode', 'title', 'loggedInUrl'], 'safe'],
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
        $query = AppUserRole::find();

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
            'userRoleID' => $this->userRoleID,
        ]);

        $query->andFilterWhere(['like', 'userRoleCode', $this->userRoleCode])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'loggedInUrl', $this->loggedInUrl]);

        return $dataProvider;
    }
}

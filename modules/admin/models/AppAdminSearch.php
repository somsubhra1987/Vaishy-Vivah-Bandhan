<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\AppAdminGroup;
use app\modules\admin\models\AppAdmin;
/**
 * AppAdminSearch represents the model behind the search form about `app\modules\admin\models\AppAdmin`.
 */
class AppAdminSearch extends AppAdmin
{
    /**
     * @inheritdoc
     */
  
    public function rules()
    {
        return [
            [['adminID', 'adminGroupID', 'active'], 'integer'],
            [['username', 'password', 'email', 'firstName', 'lastName', 'dateTimeCreated', 'address', 'countryCode', 'state', 'city', 'zip', 'phone', 'mobile', 'signature','adminGroupName'], 'safe'],
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
        $query = AppAdmin::find();
        $query->select('app_admin.*, app_admin_group.title AS adminGroupName');
        $query->innerJoin('app_admin_group', 'app_admin.adminGroupID = app_admin_group.adminGroupID');
		
		
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
            'adminID' => $this->adminID,
            'adminGroupID' => $this->adminGroupID,
            'dateTimeCreated' => $this->dateTimeCreated,
            'active' => $this->active,
        ]);
		
        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'app_admin_group.title', $this->adminGroupName])
            ->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'countryCode', $this->countryCode])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'signature', $this->signature]);

        return $dataProvider;
    }
}

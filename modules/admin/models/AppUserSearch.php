<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\AppUser;

/**
 * AppUserSearch represents the model behind the search form about `app\modules\admin\models\AppUser`.
 */
class AppUserSearch extends AppUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userID', 'activated', 'cancelled', 'subscribed'], 'integer'],
            [['username', 'dateRegistered', 'password', 'email', 'firstName', 'lastName', 'dateTimeCreated', 'address', 'countryCode', 'state', 'city', 'zip', 'phone', 'mobile', 'signature', 'regUserIp', 'regUserAgent', 'authKey', 'authKeyCreatedOn', 'accessToken', 'accessTokenCreatedOn', 'lastLoggedInOn', 'lastLoggedInUserIp', 'lastLoggedInUserAgent', 'paypalEmailID','company'], 'safe'],
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
        $query = AppUser::find()->select(" * , DATE(dateTimeCreated) as dateRegistered");
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['userID'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $dataProvider->query->andWhere(['deletedFlag' => 0]);

        $query->andFilterWhere([
            'userID' => $this->userID,
            'dateTimeCreated' => $this->dateTimeCreated,           
            'activated' => $this->activated,
            'cancelled' => $this->cancelled,
            'subscribed' => $this->subscribed,
            'authKeyCreatedOn' => $this->authKeyCreatedOn,
            'accessTokenCreatedOn' => $this->accessTokenCreatedOn,
            'lastLoggedInOn' => $this->lastLoggedInOn,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'dateTimeCreated', $this->dateRegistered])
            ->andFilterWhere(['like', 'countryCode', $this->countryCode])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'signature', $this->signature])
            ->andFilterWhere(['like', 'regUserIp', $this->regUserIp])
            ->andFilterWhere(['like', 'regUserAgent', $this->regUserAgent])
            ->andFilterWhere(['like', 'authKey', $this->authKey])
            ->andFilterWhere(['like', 'accessToken', $this->accessToken])
            ->andFilterWhere(['like', 'lastLoggedInUserIp', $this->lastLoggedInUserIp])
            ->andFilterWhere(['like', 'lastLoggedInUserAgent', $this->lastLoggedInUserAgent]);

        return $dataProvider;
    }
}

<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\UserMaster;

/**
 * UserMasterSearch represents the model behind the search form about `app\modules\admin\models\UserMaster`.
 */
class UserMasterSearch extends UserMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userID', 'isActive'], 'integer'],
            [['profileID', 'firstName', 'lastName', 'gender', 'dob', 'email', 'userPassword', 'phoneNo', 'address', 'country', 'state', 'city', 'subject', 'personalInfo', 'aboutFamily', 'partnerPreference', 'profileCreatedFor', 'bodyType', 'age', 'physicalStatus'], 'safe'],
            [['height'], 'number'],
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
        $query = UserMaster::find();

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
            'userID' => $this->userID,
            'dob' => $this->dob,
            'height' => $this->height,
            'age' => $this->age,
            'isActive' => $this->isActive,
        ]);

        $query->andFilterWhere(['like', 'profileID', $this->profileID])
            ->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'userPassword', $this->userPassword])
            ->andFilterWhere(['like', 'phoneNo', $this->phoneNo])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'personalInfo', $this->personalInfo])
            ->andFilterWhere(['like', 'aboutFamily', $this->aboutFamily])
            ->andFilterWhere(['like', 'partnerPreference', $this->partnerPreference])
            ->andFilterWhere(['like', 'profileCreatedFor', $this->profileCreatedFor])
            ->andFilterWhere(['like', 'bodyType', $this->bodyType])
            ->andFilterWhere(['like', 'physicalStatus', $this->physicalStatus]);

        return $dataProvider;
    }
}

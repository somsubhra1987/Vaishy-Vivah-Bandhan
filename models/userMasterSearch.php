<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserMaster;
use app\lib\Core;

/**
 * userMasterSearch represents the model behind the search form about `app\models\userMaster`.
 */
class userMasterSearch extends userMaster
{
    /**
     * @inheritdoc
     */
    public $age2, $dob2;
    public function rules()
    {
        return [
            [['userID', 'isActive'], 'integer'],
            [['profileID', 'firstName', 'lastName', 'gender', 'dob', 'dob2', 'email', 'userPassword', 'phoneNo', 'address', 'country', 'state', 'city', 'subject', 'personalInfo', 'aboutFamily', 'partnerPreference', 'age', 'age2', 'profileCreatedFor', 'bodyType', 'height', 'physicalStatus', 'height2'], 'safe'],
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
            ->andFilterWhere(['like', 'partnerPreference', $this->partnerPreference]);

        return $dataProvider;
    }

    public function searchmatche($params){
       // Core::printR($params);
        $this->load($params);
        $this->gender = Core::getOpositeGender(Core::getLoggedUser()->gender);

        if($this->age){
            $this->dob = Core::prepareDate($this->age, true);            
        }
        if($this->age2){
            $this->dob2 = Core::prepareDate($this->age2);            
        }

        $query = UserMaster::find()->where('1');

        if($this->age!= '' && $this->age2 != ''){
            $query->andWhere(['between','dob', $this->dob2, $this->dob]);
        }

        if($this->height >0 && $this->height2 >0){
            $query->andWhere(['between','height', $this->height, $this->height2]);
        }

        if($this->gender){
            $query->andWhere(['gender'=>$this->gender]);
        }


        $dataList = $query->all();

        $rwquery = $query->createCommand()->getRawSql();
       // die($rwquery);
        return $dataList;
    }
}

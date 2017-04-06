<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\CmsMenu;

/**
 * CmsMenuSearch represents the model behind the search form about `app\modules\admin\cms\models\CmsMenu`.
 */
class CmsMenuSearch extends CmsMenu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menuID', 'parentID', 'controllerID', 'active'], 'integer'],
            [['menuCode', 'title', 'moduleCode', 'linkUrl', 'target', 'helpTips'], 'safe'],
            [['listingOrder'], 'number'],
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
        $query = CmsMenu::find();

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
            'menuID' => $this->menuID,
            'parentID' => $this->parentID,
            'controllerID' => $this->controllerID,
            'listingOrder' => $this->listingOrder,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'menuCode', $this->menuCode])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'moduleCode', $this->moduleCode])
            ->andFilterWhere(['like', 'linkUrl', $this->linkUrl])
            ->andFilterWhere(['like', 'target', $this->target])
            ->andFilterWhere(['like', 'helpTips', $this->helpTips]);

        return $dataProvider;
    }
}

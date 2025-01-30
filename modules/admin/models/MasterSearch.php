<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Master;

/**
 * MasterSearch represents the model behind the search form of `app\modules\admin\models\Master`.
 */
class MasterSearch extends Master
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'page', 'number', 'visible'], 'integer'],
            [['name', 'image', 'projects', 'experience', 'age', 'specialization', 'in_company', 'about'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Master::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'pageSizeLimit' => [1, 500],
                'pageSize' => $_SESSION['per-page'],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'page' => $this->page,
            'number' => $this->number,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'projects', $this->projects])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'specialization', $this->specialization])
            ->andFilterWhere(['like', 'in_company', $this->in_company])
            ->andFilterWhere(['like', 'about', $this->about]);

        return $dataProvider;
    }
}

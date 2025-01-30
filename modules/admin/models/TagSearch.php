<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Tag;

/**
 * TagSearch represents the model behind the search form of `app\modules\admin\models\Tag`.
 */
class TagSearch extends Tag
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'disposition', 'number', 'visible'], 'integer'],
            [['name', 'text', 'city'], 'safe'],
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
        $query = Tag::find();

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
            'disposition' => $this->disposition,
            'number' => $this->number,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'text', $this->text]);

        // фильтр Город
        if($this->city){
            $query->andFilterWhere([
                'OR',
                ['like', 'city', $this->city, false],
                ['like', 'city', $this->city.',%', false],
                ['like', 'city', '%,'.$this->city, false],
                ['like', 'city', '%,'.$this->city.',%', false],
            ]);
        }

        return $dataProvider;
    }
}

<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Review;

/**
 * ReviewSearch represents the model behind the search form of `app\modules\admin\models\Review`.
 */
class ReviewSearch extends Review
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'master', 'rating', 'visible'], 'integer'],
            [['header', 'name', 'text', 'service'], 'safe'],
            [['date'], 'date', 'format' => 'dd.mm.yyyy'],
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
        $query = Review::find();

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
            'master' => $this->master,
            'rating' => $this->rating,
            // 'date' => $this->date,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'header', $this->header])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'service', $this->service])
            ->andFilterWhere(['like', 'text', $this->text]);

        // фильтр даты
        if(isset($this->date) && !empty($this->date)){
            $query->andFilterWhere(['>=', 'date', \app\helpers\CustomHelper::custom_timestamp($this->date)]);
            $query->andFilterWhere(['<', 'date', \app\helpers\CustomHelper::custom_timestamp($this->date)+3600*24]);
        }

        return $dataProvider;
    }
}

<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Banner;

/**
 * BannerSearch represents the model behind the search form of `app\modules\admin\models\Banner`.
 */
class BannerSearch extends Banner
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'use_page_header', 'visible'], 'integer'],
            [['name', 'header', 'subtitle', 'image', 'item1', 'item2', 'item3', 'item4', 'ico1', 'ico2', 'ico3', 'ico4', 'form', 'button', 'note'], 'safe'],
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
        $query = Banner::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_ASC]],
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
            'use_page_header' => $this->use_page_header,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'header', $this->header])
            ->andFilterWhere(['like', 'subtitle', $this->subtitle])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'item1', $this->item1])
            ->andFilterWhere(['like', 'item2', $this->item2])
            ->andFilterWhere(['like', 'item3', $this->item3])
            ->andFilterWhere(['like', 'item4', $this->item4])
            ->andFilterWhere(['like', 'ico1', $this->ico1])
            ->andFilterWhere(['like', 'ico2', $this->ico2])
            ->andFilterWhere(['like', 'ico3', $this->ico3])
            ->andFilterWhere(['like', 'ico4', $this->ico4])
            ->andFilterWhere(['like', 'form', $this->form])
            ->andFilterWhere(['like', 'button', $this->button])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}

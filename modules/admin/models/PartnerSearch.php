<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Partner;

/**
 * PartnerSearch represents the model behind the search form of `app\modules\admin\models\Partner`.
 */
class PartnerSearch extends Partner
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'visible'], 'integer'],
            [['name', 'phone', 'params', 'front_email', 'back_email', 'mail_subject', 'wokrtime', 'tag_header', 'tag_body', 'city', 'page'], 'safe'],
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
        $query = Partner::find();

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
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'params', $this->params])
            ->andFilterWhere(['like', 'front_email', $this->front_email])
            ->andFilterWhere(['like', 'back_email', $this->back_email])
            ->andFilterWhere(['like', 'mail_subject', $this->mail_subject])
            ->andFilterWhere(['like', 'wokrtime', $this->wokrtime])
            // ->andFilterWhere(['like', 'city', $this->city])
            // ->andFilterWhere(['like', 'page', $this->page])
            ->andFilterWhere(['like', 'tag_header', $this->tag_header])
            ->andFilterWhere(['like', 'tag_body', $this->tag_body]);

        // фильтр Категорий
        if($this->page){
            $query->andFilterWhere([
                'OR',
                ['like', 'page', $this->page, false],
                ['like', 'page', $this->page.',%', false],
                ['like', 'page', '%,'.$this->page, false],
                ['like', 'page', '%,'.$this->page.',%', false],
            ]);
        }

        // фильтр Городов
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

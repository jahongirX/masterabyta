<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Searchindex;

/**
 * SearchindexSearch represents the model behind the search form of `app\modules\admin\models\Searchindex`.
 */
class SearchindexSearch extends Searchindex
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'page_id'], 'integer'],
            [['page_name', 'page_alias', 'text'], 'safe'],
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
        $query = Searchindex::find();

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
            'page_id' => $this->page_id,
        ]);

        $query->andFilterWhere(['like', 'page_name', $this->page_name])
            ->andFilterWhere(['like', 'page_alias', $this->page_alias])
            ->andFilterWhere(['like', 'text', $this->text]);

        // Если не передан поисковой запрос, не возвраш=щаем никаких результатов 
        if (!isset($this->text) || $this->text === '') {
            $query->andFilterWhere([
                'id' => 0,
            ]);
        }

        return $dataProvider;
    }
}

<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\City;

/**
 * CitySearch represents the model behind the search form of `app\modules\admin\models\City`.
 */
class CitySearch extends City
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'price_type', 'number', 'visible'], 'integer'],
            [['name', 'alias', 'params', 'map', 'address', 'front_email', 'phone', 'wokrtime', 'back_email', 'district', 'street', 'metro', 'shortcode_remont', 'tag_header', 'tag_body', 'robots_txt'], 'safe'],
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
        $query = City::find();

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
            'price_type' => $this->price_type,
            'number' => $this->number,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'params', $this->params])
            ->andFilterWhere(['like', 'map', $this->map])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'front_email', $this->front_email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'wokrtime', $this->wokrtime])
            ->andFilterWhere(['like', 'back_email', $this->back_email])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'metro', $this->metro])
            ->andFilterWhere(['like', 'shortcode_remont', $this->shortcode_remont])
            ->andFilterWhere(['like', 'tag_header', $this->tag_header])
            ->andFilterWhere(['like', 'tag_body', $this->tag_body])
            ->andFilterWhere(['like', 'robots_txt', $this->robots_txt]);

        return $dataProvider;
    }
}

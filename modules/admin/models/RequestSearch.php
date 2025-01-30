<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Request;

/**
 * RequestSearch represents the model behind the search form of `app\modules\admin\models\Request`.
 */
class RequestSearch extends Request
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'city', 'page', 'partner', 'rukiizplech_code', 'servicelead_code'], 'integer'],
            [['phone'], 'safe'],
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
        $query = Request::find();

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
            'city' => $this->city,
            'page' => $this->page,
            'partner' => $this->partner,
            'rukiizplech_code' => $this->rukiizplech_code,
            'servicelead_code' => $this->servicelead_code,
            // 'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'phone', $this->phone]);

        // фильтр даты
        if(isset($this->date) && !empty($this->date)){
            $query->andFilterWhere(['>=', 'date', \app\helpers\CustomHelper::custom_timestamp($this->date)]);
            $query->andFilterWhere(['<', 'date', \app\helpers\CustomHelper::custom_timestamp($this->date)+3600*24]);
        }

        return $dataProvider;
    }
}

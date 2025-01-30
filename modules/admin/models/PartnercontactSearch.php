<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Partnercontact;

/**
 * PartnercontactSearch represents the model behind the search form of `app\modules\admin\models\Partnercontact`.
 */
class PartnercontactSearch extends Partnercontact
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'partner_id', 'offer_id_cpa_servicelead', 'thread_id_cpa_servicelead'], 'integer'],
            [['name', 'phone', 'token_cpa_rukiizplech', 'token_cpa_servicelead', 'token_cpa_leadcentre'], 'safe'],
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
        $query = Partnercontact::find();

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
            'partner_id' => $this->partner_id,
            'offer_id_cpa_servicelead' => $this->offer_id_cpa_servicelead,
            'thread_id_cpa_servicelead' => $this->thread_id_cpa_servicelead,
        ]);

        $query->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'token_cpa_rukiizplech', $this->token_cpa_rukiizplech])
            ->andFilterWhere(['like', 'token_cpa_servicelead', $this->token_cpa_servicelead])
            ->andFilterWhere(['like', 'token_cpa_leadcentre', $this->token_cpa_leadcentre]);

        return $dataProvider;
    }
}

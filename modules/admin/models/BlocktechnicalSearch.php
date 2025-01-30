<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Blocktechnical;

/**
 * BlocktechnicalSearch represents the model behind the search form of `app\modules\admin\models\Blocktechnical`.
 */
class BlocktechnicalSearch extends Blocktechnical
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'menu1', 'menu2', 'visible'], 'integer'],
            [['name', 'header', 'subtitle', 'image', 'item', 'button', 'note', 'form'], 'safe'],
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
        $query = Blocktechnical::find();

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
            'menu1' => $this->menu1,
            'menu2' => $this->menu2,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'header', $this->header])
            ->andFilterWhere(['like', 'subtitle', $this->subtitle])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'item', $this->item])
            ->andFilterWhere(['like', 'button', $this->button])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'form', $this->form]);

        return $dataProvider;
    }
}

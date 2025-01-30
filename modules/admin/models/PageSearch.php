<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Page;

/**
 * PageSearch represents the model behind the search form of `app\modules\admin\models\Page`.
 */
class PageSearch extends Page
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent', 'template', 'content_two_title_on', 'content_two_on', 'skryt_na_poddomene', 'city', 'sh_pricerow', 'banner_id', 'sidebar_visible', 'block_leadback_price_visible', 'block_masters_visible', 'block_reviews_visible', 'block_benefits_visible', 'block_how_we_work_visible', 'block_ulicy_visible', 'block_districts_visible', 'block_leadback_visible', 'visible'], 'integer'],
            [['name', 'permalink', 'redirect', 'title', 'description', 'image', 'tag_header', 'tag_body', 'content', 'content_aside', 'content_two_title', 'content_two', 'content_two_aside', 'customprice', 'table', 'after_table', 'sidebar_menu', 'block_how_we_work_4_title', 'block_how_we_work_4_text'], 'safe'],
            [['date_create', 'lastmod'], 'date', 'format' => 'dd.mm.yyyy'],
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
        $query = Page::find();

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
            'parent' => $this->parent,
            'template' => $this->template,
            'content_two_title_on' => $this->content_two_title_on,
            'content_two_on' => $this->content_two_on,
            'skryt_na_poddomene' => $this->skryt_na_poddomene,
            'sh_pricerow' => $this->sh_pricerow,
            'banner_id' => $this->banner_id,
            'sidebar_visible' => $this->sidebar_visible,
            'block_leadback_price_visible' => $this->block_leadback_price_visible,
            'block_masters_visible' => $this->block_masters_visible,
            'block_reviews_visible' => $this->block_reviews_visible,
            'block_benefits_visible' => $this->block_benefits_visible,
            'block_how_we_work_visible' => $this->block_how_we_work_visible,
            'block_ulicy_visible' => $this->block_ulicy_visible,
            'block_districts_visible' => $this->block_districts_visible,
            'block_leadback_visible' => $this->block_leadback_visible,
            'visible' => $this->visible,
            // 'date_create' => $this->date_create,
            // 'lastmod' => $this->lastmod,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'permalink', $this->permalink])
            ->andFilterWhere(['like', 'redirect', $this->redirect])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'tag_header', $this->tag_header])
            ->andFilterWhere(['like', 'tag_body', $this->tag_body])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'content_aside', $this->content_aside])
            ->andFilterWhere(['like', 'content_two_title', $this->content_two_title])
            ->andFilterWhere(['like', 'content_two', $this->content_two])
            ->andFilterWhere(['like', 'content_two_aside', $this->content_two_aside])
            ->andFilterWhere(['like', 'customprice', $this->customprice])
            ->andFilterWhere(['like', 'table', $this->table])
            ->andFilterWhere(['like', 'after_table', $this->after_table])
            ->andFilterWhere(['like', 'sidebar_menu', $this->sidebar_menu])
            ->andFilterWhere(['like', 'block_how_we_work_4_title', $this->block_how_we_work_4_title])
            ->andFilterWhere(['like', 'block_how_we_work_4_text', $this->block_how_we_work_4_text]);

        // фильтр даты создания
        if(isset($this->date_create) && !empty($this->date_create)){
            $query->andFilterWhere(['>=', 'date_create', custom_timestamp($this->date_create)]);
            $query->andFilterWhere(['<', 'date_create', custom_timestamp($this->date_create)+3600*24]);
        }

        // фильтр даты редактирования
        if(isset($this->lastmod) && !empty($this->lastmod)){
            $query->andFilterWhere(['>=', 'lastmod', custom_timestamp($this->lastmod)]);
            $query->andFilterWhere(['<', 'lastmod', custom_timestamp($this->lastmod)+3600*24]);
        }

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

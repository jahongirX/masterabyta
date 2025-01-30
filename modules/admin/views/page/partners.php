<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

// массив городов
$GLOBALS['city'] = $city;

// массив родительских страниц
$GLOBALS['parents'] = $parents;

// Партнеры
$GLOBALS['partners'] = $partners;

// Контакты партнеров
$GLOBALS['partnercontacts'] = $partnercontacts;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Прикрепленные партнеры';
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'format' => 'text',
                'contentOptions' =>['class' => 'admin-table-iindex-id'],
                'filterOptions' =>['class' => 'admin-table-iindex-id'],
                'value' => function($data){
                    return $data->id;
                },
            ],
            'name',
            [
                'attribute' => 'parent',
                'format' => 'text',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName($GLOBALS['parents'], $data->parent);
                },
                'filter' => $GLOBALS['parents'],
            ],
            [
                'attribute' => 'city',
                'format' => 'raw',
                'value' => function($data){
                    $data->city = explode(',', $data->city);
                    return \app\helpers\CustomHelper::custom_array_cities($GLOBALS['city'], $data->city, $data->id);
                },
                'filter' => $city,
            ],
            'skryt_na_poddomene:boolean',
            [
                'attribute' => 'visible',
                'format' => 'boolean',
                'contentOptions' =>['class' => 'admin-table-iindex-visible'],
                'filterOptions' =>['class' => 'admin-table-iindex-visible'],
            ],

            [
                'label' => 'Partner',
                'format' => 'raw',
                'value' => function($data){
                    if (!empty($GLOBALS['partners']) && !empty($GLOBALS['partners'][$data->id])) {
                        $partners = $GLOBALS['partners'][$data->id];
                        return \app\helpers\CustomHelper::custom_array_partners($partners, 'partner');
                    }
                    return null;
                },
            ],

            [
                'attribute' => 'Partner Contacts',
                'format' => 'raw',
                'value' => function($data){
                    if (!empty($GLOBALS['partnercontacts']) && !empty($GLOBALS['partnercontacts'][$data->id])) {
                        $partnercontacts = $GLOBALS['partnercontacts'][$data->id];
                        return \app\helpers\CustomHelper::custom_array_partners($partnercontacts, 'partnercontacts');
                    }
                    return null;
                },
            ],

        ],
    ]); ?>


</div>

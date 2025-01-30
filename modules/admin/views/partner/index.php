<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

// названия страниц
$GLOBALS['page'] = $page;

// названия городов
$GLOBALS['city'] = $city;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Партнеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partner-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="clearfix m-b-sm">
        <?= Html::a('Create Partner', ['create'], ['class' => 'btn btn-success']) ?>

        <input type="text" class="form-control GridView-rows only_number" data-url="<?= Url::current(['per-page' => 20]) ?>" value="<?= $_SESSION['per-page'] ?>" maxlength="4" autocomplete="off">
    </div>

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
            'params:ntext',
            'phone',
            'front_email',
            // 'back_email',
            // 'mail_subject',
            //'wokrtime',
            //'tag_header:ntext',
            //'tag_body:ntext',
            [
                'attribute' => 'city',
                'format' => 'raw',
                'value' => function($data){
                    $data->city = explode(',', $data->city);
                    return \app\helpers\CustomHelper::custom_array_cities($GLOBALS['city'], $data->city, $data->id);
                },
                'filter' => $city,
            ],
            [
                'attribute' => 'page',
                'format' => 'raw',
                'value' => function($data){
                    $data->page = explode(',', $data->page);
                    return \app\helpers\CustomHelper::custom_array_cities($GLOBALS['page'], $data->page);
                },
                'filter' => $page,
            ],
            'visible:boolean',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'filterOptions' => [
                    'class' => 'admin-table-filter-close-column',
                    'data-to' => Url::to('/admin/tag/index'),
                    'data-current' => Url::current(),
                ],
            ],
        ],
    ]); ?>


</div>

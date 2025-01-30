<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

// массив мастеров
$GLOBALS['master'] = $master;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="clearfix m-b-sm">
        <?= Html::a('Create Review', ['create'], ['class' => 'btn btn-success']) ?>

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
            'header',
            'name',
            [
                'attribute' => 'master',
                'format' => 'text',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName($GLOBALS['master'], $data->master);
                },
                'filter' => $GLOBALS['master'],
            ],
            //'service:ntext',
            'rating',
            //'text:ntext',
            [
                'attribute' => 'date',
                'format' => 'html',
                'contentOptions' =>['class' => 'admin-table-iindex-date'],
                'filterOptions' =>['class' => 'admin-table-iindex-date'],
                'value' => function($data){
                    return \app\helpers\CustomHelper::custom_date($data->date);
                },
            ],
            'visible:boolean',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'filterOptions' => [
                    'class' => 'admin-table-filter-close-column',
                    'data-to' => Url::to('/admin/review/index'),
                    'data-current' => Url::current(),
                ],
            ],
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

// названия городов
$GLOBALS['city'] = $city;

// названия страниц
$GLOBALS['page'] = $page;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="clearfix m-b-sm">
        <?php if(Yii::$app->user->can('requestCreate')): ?>
            <?= Html::a('Create Request', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>

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
            'phone',
            [
                'attribute' => 'city',
                'format' => 'html',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName($GLOBALS['city'], $data->city);
                },
                'filter' => $city,
            ],
            [
                'attribute' => 'page',
                'format' => 'html',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName($GLOBALS['page'], $data->page);
                },
                'filter' => $page,
            ],
            'partner',
            'rukiizplech_code',
            'servicelead_code',
            [
                'attribute' => 'date',
                'format' => 'html',
                'value' => function($data){             
                    return \app\helpers\CustomHelper::custom_date($data->date);
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {delete}',
                'filterOptions' => [
                    'class' => 'admin-table-filter-close-column',
                    'data-to' => Url::to('/admin/request/index'),
                    'data-current' => Url::current(),
                ],
            ],
        ],
    ]); ?>


</div>

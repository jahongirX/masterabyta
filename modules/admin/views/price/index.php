<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

// разделы прайса
$GLOBALS['price_section'] = $price_section;

// единицы измерения
$GLOBALS['units'] = $units;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Прайс';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="clearfix m-b-sm">
        <?= Html::a('Create Price', ['create'], ['class' => 'btn btn-success']) ?>

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
            [
                'attribute' => 'price_section',
                'format' => 'text',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName($GLOBALS['price_section'], $data->price_section);
                },
                'filter' => $price_section,
            ],
            [
                'attribute' => 'unit',
                'format' => 'text',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName($GLOBALS['units'], $data->unit);
                },
                'filter' => $GLOBALS['units'],
            ],
            'price_msk',
            'price_region',
            //'link',
            'number',
            'visible:boolean',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'filterOptions' => [
                    'class' => 'admin-table-filter-close-column',
                    'data-to' => Url::to('/admin/price/index'),
                    'data-current' => Url::current(),
                ],
            ],
        ],
    ]); ?>


</div>

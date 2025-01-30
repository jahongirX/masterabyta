<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PriceSectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Разделы прайса';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-section-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="clearfix m-b-sm">
        <?= Html::a('Create Price Section', ['create'], ['class' => 'btn btn-success']) ?>

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
                'attribute' => 'visible',
                'format' => 'boolean',
                'contentOptions' =>['class' => 'admin-table-iindex-visible'],
                'filterOptions' =>['class' => 'admin-table-iindex-visible'],
                'value' => function($data){
                    return $data->visible;
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'filterOptions' => [
                    'class' => 'admin-table-filter-close-column',
                    'data-to' => Url::to('/admin/price-section/index'),
                    'data-current' => Url::current(),
                ],
            ],
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SearchindexSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поиск';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="searchindex-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="clearfix m-b-sm">
        <?php // echo Html::a('Create Searchindex', ['create'], ['class' => 'btn btn-success']) ?>

        <input type="text" class="form-control GridView-rows only_number" data-url="<?= Url::current(['per-page' => 20]) ?>" value="<?= $_SESSION['per-page'] ?>" maxlength="4" autocomplete="off">
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            /*
            [
                'attribute' => 'id',
                'format' => 'text',
                'contentOptions' =>['class' => 'admin-table-iindex-id'],
                'filterOptions' =>['class' => 'admin-table-iindex-id'],
                'value' => function($data){
                    return $data->id;
                },
            ],
            */
            // 'page_id',
            // 'page_name',
            // 'page_alias',
            [
                'attribute' => 'text',
                'format' => 'raw',
                'label' => 'Поиск',
                'value' => function($data){
                    return '<a target="_blank" rel="noreferrer noopener nofollow" href="'.Url::to(["page/view", 'id' => $data->id], true).'">'.Url::to(["page/view", 'id' => $data->id], true).'</a>';
                },
            ],

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

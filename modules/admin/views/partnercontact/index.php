<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PartnercontactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакты партнеров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partnercontact-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="clearfix m-b-sm">
        <?= Html::a('Create Partnercontact', ['create'], ['class' => 'btn btn-success']) ?>

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
            'partner_id',
            'name',
            // 'phone',
            // 'token_cpa_rukiizplech',
            // 'token_cpa_servicelead',
            // 'offer_id_cpa_servicelead',
            // 'thread_id_cpa_servicelead',
            // 'token_cpa_leadcentre',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'filterOptions' => [
                    'class' => 'admin-table-filter-close-column',
                    'data-to' => Url::to('/admin/partnercontact/index'),
                    'data-current' => Url::current(),
                ],
            ],
        ],
    ]); ?>


</div>

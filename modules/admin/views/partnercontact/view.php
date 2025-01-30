<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Partnercontact */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Контакты партнеров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="partnercontact-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                  'attribute' => 'partner_id',
                  'format' => 'html',
                  'value' => function($data){
                        if (!empty($data->partner_id)) {
                              return '<a href="' .Url::to(['/admin/partner/view', 'id'=>$data->partner_id]). '">' . $data->partner_id . '</a>';
                        } else {
                              return null;
                        }
                  }
            ],
            'name',
            // 'phone',
            'token_cpa_rukiizplech',
            'token_cpa_servicelead',
            'offer_id_cpa_servicelead',
            'thread_id_cpa_servicelead',
            'token_cpa_leadcentre',
        ],
    ]) ?>

</div>

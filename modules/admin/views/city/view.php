<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\City */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Города', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="city-view">

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
            'name',
            'alias',
            'params:ntext',
            'map:ntext',
            'address',
            'front_email:email',
            'phone',
            'wokrtime',
            [
                'attribute' => 'price_type',
                'format' => 'text',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName(Yii::$app->params['price_types'], $data->price_type);
                },
            ],
            'back_email:email',
            [
                'attribute' => 'district',
                'value' => \app\helpers\CustomHelper::custom_longtext_collapsed($model->district),
                'format' => 'raw',
            ],
            [
                'attribute' => 'street',
                'value' => \app\helpers\CustomHelper::custom_longtext_collapsed($model->street),
                'format' => 'raw',
            ],
            [
                'attribute' => 'metro',
                'value' => \app\helpers\CustomHelper::custom_longtext_collapsed($model->metro),
                'format' => 'raw',
            ],
            'shortcode_remont:ntext',
            'tag_header:ntext',
            'tag_body:ntext',
            'robots_txt:ntext',
            'number',
            'visible:boolean',
        ],
    ]) ?>

</div>

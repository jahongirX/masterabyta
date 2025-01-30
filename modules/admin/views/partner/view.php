<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// названия страниц
$GLOBALS['page'] = $page;

// названия городов
$GLOBALS['city'] = $city;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Partner */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Партнеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="partner-view">

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
        <?= Html::a('Привязка городов и услуг по id', ['city-manage', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'params:ntext',
            'phone',
            'front_email:email',
            'back_email:email',
            'mail_subject',
            'wokrtime',
            'tag_header:ntext',
            'tag_body:ntext',
            [
                'attribute' => 'city',
                'value' => \app\helpers\CustomHelper::custom_array_cities($GLOBALS['city'], $model->city, $model->id),
                'format' => 'raw',
            ],
            [
                'attribute' => 'page',
                'value' => \app\helpers\CustomHelper::custom_array_cities($GLOBALS['page'], $model->page),
                'format' => 'raw',
            ],
            'visible:boolean',
        ],
    ]) ?>

</div>

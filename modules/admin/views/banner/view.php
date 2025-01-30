<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Banner */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Баннеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="banner-view">

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
            'header',
            'use_page_header:boolean',
            'subtitle',
            [
                'attribute' => 'image',
                'value' => \app\helpers\CustomHelper::getAdminCustomImage($model, 'image'),
                'format' => 'html',
            ],
            'item1',
            [
                'attribute' => 'ico1',
                'value' => \app\helpers\CustomHelper::getAdminCustomImage($model, 'ico1'),
                'format' => 'html',
            ],
            'item2',
            [
                'attribute' => 'ico2',
                'value' => \app\helpers\CustomHelper::getAdminCustomImage($model, 'ico2'),
                'format' => 'html',
            ],
            'item3',
            [
                'attribute' => 'ico3',
                'value' => \app\helpers\CustomHelper::getAdminCustomImage($model, 'ico3'),
                'format' => 'html',
            ],
            'item4',
            [
                'attribute' => 'ico4',
                'value' => \app\helpers\CustomHelper::getAdminCustomImage($model, 'ico4'),
                'format' => 'html',
            ],
            'form:ntext',
            'button',
            'note:ntext',
            'visible:boolean',
        ],
    ]) ?>

</div>

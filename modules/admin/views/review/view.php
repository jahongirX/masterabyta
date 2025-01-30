<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// массив мастеров
$GLOBALS['master'] = $master;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Review */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="review-view">

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
            'header',
            'name',
            [
                'attribute' => 'master',
                'value' => function($data) {
                    return \app\helpers\CustomHelper::customParamName($GLOBALS['master'], $data->master);
                },
                'format' => 'raw',
            ],
            'service:ntext',
            'rating',
            'text:ntext',
            [
                'attribute' => 'date',
                'format' => 'html',
                'value' => function($data){
                    if (!empty($data->date)) {
                        return \app\helpers\CustomHelper::custom_date($data->date);
                    } else {
                        return null;
                    }
                },
            ],
            'visible:boolean',
        ],
    ]) ?>

</div>

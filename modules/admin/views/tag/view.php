<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// названия городов
$GLOBALS['city'] = $city;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tag */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tag-view">

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
            [
                'attribute' => 'disposition',
                'format' => 'text',
                'value' => function($data) {             
                    return \app\helpers\CustomHelper::customParamName(Yii::$app->params['tag_disposition'], $data->disposition);
                },
            ],
            'text:ntext',
            [
                'attribute' => 'city',
                'value' => function($data) {
                    return \app\helpers\CustomHelper::custom_array_cities($GLOBALS['city'], $data->city);
                },
                'format' => 'raw',
            ],
            'number',
            'visible:boolean',
        ],
    ]) ?>

</div>

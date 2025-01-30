<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// массив меню
$GLOBALS['menu'] = $menu;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Blocktechnical */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Технические блоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="blocktechnical-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /* ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php */ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'header',
            'subtitle',
            [
                'attribute' => 'image',
                'value' => \app\helpers\CustomHelper::getAdminCustomImage($model, 'image'),
                'format' => 'html',
            ],
            'item:ntext',
            'button',
            'note:ntext',
            'form:ntext',
            [
                'attribute' => 'menu1',
                'format' => 'html',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName($GLOBALS['menu'], $data->menu1);
                },
            ],
            [
                'attribute' => 'menu2',
                'format' => 'html',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName($GLOBALS['menu'], $data->menu2);
                },
            ],
            'visible:boolean',
        ],
    ]) ?>

</div>

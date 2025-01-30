<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// разделы прайса
$GLOBALS['price_section'] = $price_section;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Price */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Прайс', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="price-view">

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
                  'attribute' => 'price_section',
                  'format' => 'html',
                  'value' => function($data){
                        if (!empty($data->price_section)) {
                              return '<a href="' .Url::to(['/admin/price-section/view', 'id'=>$data->price_section]). '">' . \app\helpers\CustomHelper::customParamName($GLOBALS['price_section'], $data->price_section) . '</a>';
                        }
                  },
            ],
            'unit',
            'price_msk',
            'price_region',
            'link',
            'number',
            'visible:boolean',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// названия прайсов
$GLOBALS['price'] = $price;

// названия категорий
$GLOBALS['price_section'] = $price_section;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Pricetable */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Таблицы цен', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pricetable-view">

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
                'attribute' => 'price',
                'value' => \app\helpers\CustomHelper::custom_array_names($GLOBALS['price'], $model->price, '/admin/price/view/'),
                'format' => 'raw',
            ],
            'visible:boolean',
        ],
    ]) ?>

</div>

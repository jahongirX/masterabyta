<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Price */

$this->title = 'Create Price';
$this->params['breadcrumbs'][] = ['label' => 'Прайс', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'price_section' => $price_section,
    ]) ?>

</div>

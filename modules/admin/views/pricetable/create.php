<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Pricetable */

$this->title = 'Create Pricetable';
$this->params['breadcrumbs'][] = ['label' => 'Таблицы цен', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pricetable-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'price' => $price,
        'price_section' => $price_section,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PriceSection */

$this->title = 'Create Price Section';
$this->params['breadcrumbs'][] = ['label' => 'Разделы прайса', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-section-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

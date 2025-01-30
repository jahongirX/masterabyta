<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Blocktechnical */

$this->title = 'Create Block';
$this->params['breadcrumbs'][] = ['label' => 'Технические блоки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blocktechnical-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'menu' => $menu,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Searchindex */

$this->title = 'Create Searchindex';
$this->params['breadcrumbs'][] = ['label' => 'Поиск', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="searchindex-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $partner app\modules\admin\models\Partner */

$this->title = 'Привязка городов и услуг: ' . $partner->name;
$this->params['breadcrumbs'][] = ['label' => 'Партнеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $partner->name, 'url' => ['view', 'id' => $partner->id]];
$this->params['breadcrumbs'][] = 'Привязка городов и услуг по id';
?>
<div class="partner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="partner-form">

	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'city')->textarea(['rows' => 6]) ?>

	    <?= $form->field($model, 'page')->textarea(['rows' => 6]) ?>


	    <div class="form-group">
	        <?= Html::submitButton('Привязать', ['class' => 'btn btn-success', 'name' => 'action', 'value' => 'link']) ?>

	        <?= Html::submitButton('Отвязать', ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'unlink']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>

</div>

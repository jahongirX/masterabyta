<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Price */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="price-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_section')->dropDownList($price_section) ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_msk')->textInput(['maxlength' => true, 'class' => 'form-control float_number']) ?>

    <?= $form->field($model, 'price_region')->textInput(['maxlength' => true, 'class' => 'form-control float_number']) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true, 'class' => 'form-control only_number']) ?>

    <?= $form->field($model, 'visible')->dropDownList(['1' => 'Опубликовано', '0' => 'Черновик']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

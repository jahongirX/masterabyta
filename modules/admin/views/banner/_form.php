<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'header')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'use_page_header')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= \app\helpers\CustomHelper::ElFinderInputFile($form, $model, 'image'); ?>

    <?= $form->field($model, 'item1')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= \app\helpers\CustomHelper::ElFinderInputFile($form, $model, 'ico1'); ?>

    <?= $form->field($model, 'item2')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= \app\helpers\CustomHelper::ElFinderInputFile($form, $model, 'ico2'); ?>

    <?= $form->field($model, 'item3')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= \app\helpers\CustomHelper::ElFinderInputFile($form, $model, 'ico3'); ?>

    <?= $form->field($model, 'item4')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= \app\helpers\CustomHelper::ElFinderInputFile($form, $model, 'ico4'); ?>

    <?= $form->field($model, 'form')->textarea(['maxlength' => true, 'class' => 'form-control textarea-control']) ?>

    <?= $form->field($model, 'button')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <?= $form->field($model, 'note')->textarea(['maxlength' => true, 'class' => 'form-control textarea-control']) ?>

    <?= $form->field($model, 'visible')->dropDownList(['1' => 'Опубликовано', '0' => 'Черновик']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

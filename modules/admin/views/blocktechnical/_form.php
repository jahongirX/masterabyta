<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Blocktechnical */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blocktechnical-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'header')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>

    <?= \app\helpers\CustomHelper::ElFinderInputFile($form, $model, 'image'); ?>

    <?= $form->field($model, 'item')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'button')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'form')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'menu1')->dropDownList($menu) ?>

    <?= $form->field($model, 'menu2')->dropDownList($menu) ?>

    <?= $form->field($model, 'visible')->dropDownList(['1' => 'Опубликовано', '0' => 'Черновик']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

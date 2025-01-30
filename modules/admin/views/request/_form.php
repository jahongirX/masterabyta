<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->dropDownList($city) ?>

    <?= $form->field($model, 'page')->dropDownList($page) ?>

    <?= $form->field($model, 'partner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rukiizplech_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'servicelead_code')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'date')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

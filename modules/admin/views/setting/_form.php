<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<?php if(!$model->isNewRecord){
	$readonly = true;
}else{
	$readonly = false;
} ?>

<div class="setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'readonly' => $readonly, 'disabled' => $readonly]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'readonly' => $readonly, 'disabled' => $readonly]) ?>

    <?= $form->field($model, 'value')->textarea(['maxlength' => true, 'class' => 'form-control textarea-control']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Tag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'disposition')->dropDownList($tag_disposition) ?>

    <?= $form->field($model, 'text')->textarea(['maxlength' => true, 'class' => 'form-control textarea-control']) ?>

    <div class="checkboxList">
        <?= $form->field($model, 'city')->checkboxList($city, ['item' => 
            function($index, $label, $name, $checked, $value) {
                return Html::checkbox($name, $checked, [
                    'value' => $value,
                    'label' => $label
                ]);
            }
        ]) ?>
        <div class="m-b-sm">
            <label class="btn btn-default btn-sm checkboxList-toggle-btn">
                <input type="checkbox" class="checkboxList-toggle-all" name="all" value="1">
                <span>ВСЕ</span>
            </label>
        </div>
    </div>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true, 'class' => 'form-control only_number']) ?>

    <?= $form->field($model, 'visible')->dropDownList(['1' => 'Опубликовано', '0' => 'Черновик']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

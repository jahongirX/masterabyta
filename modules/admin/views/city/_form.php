<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'params')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'map')->textInput(['maxlength' => true]) ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            Карточка организации
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'front_email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'wokrtime')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'price_type')->dropDownList(Yii::$app->params['price_types']) ?>

    <?= $form->field($model, 'back_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'district')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'street')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'metro')->textarea(['rows' => 6]) ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            Шорткод ремонт не делается
            <br>
            <small>[remont]</small>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'shortcode_remont')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'tag_header')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tag_body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'robots_txt')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'visible')->dropDownList(['1' => 'Опубликовано', '0' => 'Черновик']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

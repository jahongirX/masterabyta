<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'alias') ?>

    <?= $form->field($model, 'params') ?>

    <?= $form->field($model, 'map') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'front_email') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'wokrtime') ?>

    <?php // echo $form->field($model, 'price_type') ?>

    <?php // echo $form->field($model, 'back_email') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'metro') ?>

    <?php // echo $form->field($model, 'shortcode_remont') ?>

    <?php // echo $form->field($model, 'tag_header') ?>

    <?php // echo $form->field($model, 'tag_body') ?>

    <?php // echo $form->field($model, 'robots_txt') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PartnerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'params') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'front_email') ?>

    <?= $form->field($model, 'back_email') ?>

    <?php // echo $form->field($model, 'mail_subject') ?>

    <?php // echo $form->field($model, 'wokrtime') ?>

    <?php // echo $form->field($model, 'tag_header') ?>

    <?php // echo $form->field($model, 'tag_body') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'page') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

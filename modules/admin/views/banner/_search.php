<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\BannerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'header') ?>

    <?= $form->field($model, 'use_page_header') ?>

    <?= $form->field($model, 'subtitle') ?>

    <?= $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'item1') ?>
    <?php // echo $form->field($model, 'item2') ?>
    <?php // echo $form->field($model, 'item3') ?>
    <?php // echo $form->field($model, 'item4') ?>

    <?php // echo $form->field($model, 'ico1') ?>
    <?php // echo $form->field($model, 'ico2') ?>
    <?php // echo $form->field($model, 'ico3') ?>
    <?php // echo $form->field($model, 'ico4') ?>

    <?php // echo $form->field($model, 'form') ?>

    <?php // echo $form->field($model, 'button') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

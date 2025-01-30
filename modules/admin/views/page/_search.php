<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'parent') ?>

    <?= $form->field($model, 'template') ?>

    <?php // echo $form->field($model, 'permalink') ?>

    <?php // echo $form->field($model, 'redirect') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'tag_header') ?>

    <?php // echo $form->field($model, 'tag_body') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'content_aside') ?>

    <?php // echo $form->field($model, 'content_two_title_on') ?>

    <?php // echo $form->field($model, 'content_two_title') ?>

    <?php // echo $form->field($model, 'content_two_on') ?>

    <?php // echo $form->field($model, 'content_two') ?>

    <?php // echo $form->field($model, 'content_two_aside') ?>

    <?php // echo $form->field($model, 'skryt_na_poddomene') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'sh_pricerow') ?>

    <?php // echo $form->field($model, 'customprice') ?>

    <?php // echo $form->field($model, 'table') ?>

    <?php // echo $form->field($model, 'after_table') ?>

    <?php // echo $form->field($model, 'banner_id') ?>

    <?php // echo $form->field($model, 'sidebar_visible') ?>

    <?php // echo $form->field($model, 'sidebar_menu') ?>

    <?php // echo $form->field($model, 'block_leadback_price_visible') ?>

    <?php // echo $form->field($model, 'block_masters_visible') ?>

    <?php // echo $form->field($model, 'block_reviews_visible') ?>

    <?php // echo $form->field($model, 'block_benefits_visible') ?>

    <?php // echo $form->field($model, 'block_how_we_work_visible') ?>

    <?php // echo $form->field($model, 'block_how_we_work_4_title') ?>

    <?php // echo $form->field($model, 'block_how_we_work_4_text') ?>

    <?php // echo $form->field($model, 'block_ulicy_visible') ?>

    <?php // echo $form->field($model, 'block_districts_visible') ?>

    <?php // echo $form->field($model, 'block_leadback_visible') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'lastmod') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

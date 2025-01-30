<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PartnercontactSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partnercontact-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'partner_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'token_cpa_rukiizplech') ?>

    <?= $form->field($model, 'token_cpa_servicelead') ?>

    <?= $form->field($model, 'offer_id_cpa_servicelead') ?>

    <?= $form->field($model, 'thread_id_cpa_servicelead') ?>

    <?= $form->field($model, 'token_cpa_leadcentre') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

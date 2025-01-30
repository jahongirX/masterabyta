<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Partnercontact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partnercontact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'partner_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    Ruki-iz-plech.ru
                </div>
            </div>
        </div>
        <div class="panel-body">

            <?= $form->field($model, 'token_cpa_rukiizplech')->textInput(['maxlength' => true]) ?>

        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    ServiceLead.top
                </div>
            </div>
        </div>
        <div class="panel-body">

            <?= $form->field($model, 'token_cpa_servicelead')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'offer_id_cpa_servicelead')->textInput(['class' => 'only_number form-control', 'maxlength' => true]) ?>

            <?= $form->field($model, 'thread_id_cpa_servicelead')->textInput(['class' => 'only_number form-control', 'maxlength' => true]) ?>

        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    Bt-lead-centre.ru
                </div>
            </div>
        </div>
        <div class="panel-body">

            <?= $form->field($model, 'token_cpa_leadcentre')->textInput(['maxlength' => true]) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

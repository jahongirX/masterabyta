<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// названия ролей пользователей
$user_roles = Yii::$app->params['user_roles'];
$user_roles = \app\helpers\CustomHelper::custom_array_unshift($user_roles, '— Выбрать —');

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->dropDownList($user_roles) ?>

    <?php // echo $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord): ?>
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?php else: ?>
        <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>
    <?php endif; ?>

    <?php // echo $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ban')->checkbox(['value' => 1]) ?>

    <?php // echo $form->field($model, 'date_reg')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="block">
    <div class="container">
        <div class="site-login">

            <?php if( Yii::$app->session->hasFlash('success') ){
                echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' .Yii::$app->session->getFlash('success'). '</div>';
            }elseif( Yii::$app->session->hasFlash('error') ){
                echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' .Yii::$app->session->getFlash('error'). '</div>';
            } ?>

            <h1 class="text-left m-b-md"><?= Html::encode($this->title) ?></h1>

            <?php if (empty($_SESSION['2FA'])): ?>

                <p>Please fill out the following fields to login:</p>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
                ]); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"col-lg-offset-1 col-lg-3 clearfix\"><span class=\"pull-left\" style=\"margin-right: 8px\">{input}</span> {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                    ]) ?>

                    <div class="form-group">
                        <div class="col-lg-offset-1 col-lg-11">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                    </div>

                <?php ActiveForm::end(); ?>

            <?php else: ?>

                <p>Enter the code from e-mail:</p>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label hidden'],
                    ],
                ]); ?>

                    <?= $form->field($model, 'code')->textInput(['autofocus' => true]) ?>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>
                    </div>

                <?php ActiveForm::end(); ?>

            <?php endif; ?>

            
        </div>
    </div>
</div>


<?php 
    $recaptchaV3Helper = new \app\helpers\RecaptchaV3Helper();
    $recaptchaLoginFormHandler_js = $recaptchaV3Helper->getJsFormHandler('login-form', 'login');
    $this->registerJs($recaptchaLoginFormHandler_js);
?>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
mihaildev\elfinder\Assets::noConflict($this);

$ckawesomeUrl = Yii::$app->assetManager->publish('@app/web/js/admin/ck-editor/ckawesome');
$this->registerJs("CKEDITOR.plugins.addExternal( 'ckawesome', '".$ckawesomeUrl[1]."/', 'plugin.js' );");

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Pricetablehtml */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pricetablehtml-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'header')->textInput(['maxlength' => true]) ?>

    <?php 
        echo $form->field($model, "price")->widget(CKEditor::className(),[
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
                'extraPlugins' => 'ckawesome', //fontawesome
            ]),
        ]);
    ?>

    <?= $form->field($model, 'visible')->dropDownList(['1' => 'Опубликовано', '0' => 'Черновик']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

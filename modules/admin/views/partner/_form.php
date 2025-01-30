<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Partner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'params')->textarea(['rows' => 6]) ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            Карточка организации
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'front_email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'wokrtime')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'back_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail_subject')->textInput(['maxlength' => true]) ?>

    
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    Tags
                </div>
                <div class="col-xs-6 text-right">
                    <label class="btn btn-default btn-sm panel-open-btn">
                        <span class="panel-open-btn-text">Open</span>
                        <input name="blockunique-toggle-checkbox-tags" type="checkbox" class="checkbox-blockunique-toggle" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="blockunique-toggle-form">
                <?= $form->field($model, 'tag_header')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'tag_body')->textarea(['rows' => 6]) ?>
            </div>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    Города
                </div>
                <div class="col-xs-6 text-right">
                    <label class="btn btn-default btn-sm panel-open-btn">
                        <span class="panel-open-btn-text">Open</span>
                        <input name="blockunique-toggle-checkbox-cities" type="checkbox" class="checkbox-blockunique-toggle" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="blockunique-toggle-form">
                <div class="checkboxList">
                    <div class="checkboxListColumn">
                        <?= $form->field($model, 'city')->checkboxList($city, ['item' => 
                            function($index, $label, $name, $checked, $value) {
                                return Html::checkbox($name, $checked, [
                                    'value' => $value,
                                    'label' => $label
                                ]);
                            }
                        ]) ?>
                    </div>
                    <div class="m-b-sm">
                        <label class="btn btn-default btn-sm checkboxList-toggle-btn">
                            <input type="checkbox" class="checkboxList-toggle-all" name="all" value="1">
                            <span>ВСЕ</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    Страницы
                </div>
                <div class="col-xs-6 text-right">
                    <label class="btn btn-default btn-sm panel-open-btn">
                        <span class="panel-open-btn-text">Open</span>
                        <input name="blockunique-toggle-checkbox-pages" type="checkbox" class="checkbox-blockunique-toggle" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="blockunique-toggle-form">
                <div class="checkboxList">
                    <div class="checkboxListColumn">
                        <?= $form->field($model, 'page')->checkboxList($page, ['item' => 
                            function($index, $label, $name, $checked, $value) {
                                return Html::checkbox($name, $checked, [
                                    'value' => $value,
                                    'label' => $label
                                ]);
                            }
                        ]) ?>
                    </div>
                    <div class="m-b-sm">
                        <label class="btn btn-default btn-sm checkboxList-toggle-btn">
                            <input type="checkbox" class="checkboxList-toggle-all" name="all" value="1">
                            <span>ВСЕ</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?= $form->field($model, 'visible')->dropDownList(['1' => 'Опубликовано', '0' => 'Черновик']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

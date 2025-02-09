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
/* @var $model app\modules\admin\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent')->textInput() ?>

    <?= $form->field($model, 'template')->dropDownList($templates) ?>

    <?= $form->field($model, 'permalink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'redirect')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= \app\helpers\CustomHelper::ElFinderInputFile($form, $model, 'image'); ?>

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

    <?= $form->field($model, 'banner_id')->dropDownList($banner) ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    Контент
                </div>
                <div class="col-xs-6 text-right">
                    <label class="btn btn-default btn-sm panel-open-btn">
                        <span class="panel-open-btn-text">Open</span>
                        <input name="blockunique-toggle-checkbox-content" type="checkbox" class="checkbox-blockunique-toggle" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="blockunique-toggle-form">
                <?= $form->field($model, 'content_aside')->textarea(['rows' => 6]) ?>

                <?php 
                    echo $form->field($model, 'content')->widget(CKEditor::className(),[
                        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                            'inline' => false, //по умолчанию false
                            'extraPlugins' => 'ckawesome', //fontawesome
                        ]),
                    ]);
                ?>
            </div>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    Title 2
                </div>
                <div class="col-xs-6 text-right">
                    <label class="btn btn-default btn-sm panel-open-btn">
                        <span class="panel-open-btn-text">Open</span>
                        <input name="blockunique-toggle-checkbox-content_two_title" type="checkbox" class="checkbox-blockunique-toggle" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'content_two_title_on')->checkbox(['value' => 1]) ?>
            <div class="blockunique-toggle-form">

                <?= $form->field($model, 'content_two_title')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    Контент 2
                </div>
                <div class="col-xs-6 text-right">
                    <label class="btn btn-default btn-sm panel-open-btn">
                        <span class="panel-open-btn-text">Open</span>
                        <input name="blockunique-toggle-checkbox-content_two" type="checkbox" class="checkbox-blockunique-toggle" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'content_two_on')->checkbox(['value' => 1]) ?>
            <div class="blockunique-toggle-form">

                <?= $form->field($model, 'content_two_aside')->textarea(['rows' => 6]) ?>

                <?php 
                    echo $form->field($model, 'content_two')->widget(CKEditor::className(),[
                        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                            'inline' => false, //по умолчанию false
                            'extraPlugins' => 'ckawesome', //fontawesome
                        ]),
                    ]);
                ?>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    Контент 3
                </div>
                <div class="col-xs-6 text-right">
                    <label class="btn btn-default btn-sm panel-open-btn">
                        <span class="panel-open-btn-text">Open</span>
                        <input name="blockunique-toggle-checkbox-content_three" type="checkbox" class="checkbox-blockunique-toggle" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'content_three_on')->checkbox(['value' => 1]) ?>
            <div class="blockunique-toggle-form">

                <?php
                echo $form->field($model, 'content_three')->widget(CKEditor::className(),[
                    'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                        'inline' => false, //по умолчанию false
                        'extraPlugins' => 'ckawesome', //fontawesome
                    ]),
                ]);
                ?>
            </div>
        </div>
    </div>

    
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    City
                </div>
                <div class="col-xs-6 text-right">
                    <label class="btn btn-default btn-sm panel-open-btn">
                        <span class="panel-open-btn-text">Open</span>
                        <input name="blockunique-toggle-checkbox-city" type="checkbox" class="checkbox-blockunique-toggle" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="blockunique-toggle-form">

                <div class="checkboxList">
                    <?= $form->field($model, 'city')->checkboxList($city, ['item' => 
                        function($index, $label, $name, $checked, $value) {
                            return Html::checkbox($name, $checked, [
                                'value' => $value,
                                'label' => $label
                            ]);
                        }
                    ]) ?>
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


    <?= $form->field($model, 'skryt_na_poddomene')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'sh_pricerow')->dropDownList($price) ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    Customprice
                </div>
                <div class="col-xs-6 text-right">
                    <label class="btn btn-default btn-sm panel-open-btn">
                        <span class="panel-open-btn-text">Open</span>
                        <input name="blockunique-toggle-checkbox-customprice" type="checkbox" class="checkbox-blockunique-toggle" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="blockunique-toggle-form">

                <?= $form->field($model, 'customprice')->textarea(['rows' => 6]) ?>
            </div>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    Калькулятор
                </div>
                <div class="col-xs-6 text-right">
                    <label class="btn btn-default btn-sm panel-open-btn">
                        <span class="panel-open-btn-text">Open</span>
                        <input name="blockunique-toggle-checkbox-calcul" type="checkbox" class="checkbox-blockunique-toggle" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="blockunique-toggle-form">
                <?php 
                    echo $form->field($model, 'table')->widget(CKEditor::className(),[
                        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                            'inline' => false, //по умолчанию false
                            'extraPlugins' => 'ckawesome', //fontawesome
                        ]),
                    ]);
                ?>

                <?php 
                    echo $form->field($model, 'after_table')->widget(CKEditor::className(),[
                        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                            'inline' => false, //по умолчанию false
                            'extraPlugins' => 'ckawesome', //fontawesome
                        ]),
                    ]);
                ?>
            </div>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    Sidebar
                </div>
                <div class="col-xs-6 text-right">
                    <label class="btn btn-default btn-sm panel-open-btn">
                        <span class="panel-open-btn-text">Open</span>
                        <input name="blockunique-toggle-checkbox-sidebar" type="checkbox" class="checkbox-blockunique-toggle" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'sidebar_visible')->checkbox(['value' => 1]) ?>
            <div class="blockunique-toggle-form">

                <?= $form->field($model, 'sidebar_menu')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

    <?= $form->field($model, 'block_leadback_price_visible')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'block_masters_visible')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'block_reviews_visible')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'block_benefits_visible')->checkbox(['value' => 1]) ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    Как мы работаем
                </div>
                <div class="col-xs-6 text-right">
                    <label class="btn btn-default btn-sm panel-open-btn">
                        <span class="panel-open-btn-text">Open</span>
                        <input name="blockunique-toggle-checkbox-how_we_work" type="checkbox" class="checkbox-blockunique-toggle" value="1">
                    </label>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'block_how_we_work_visible')->checkbox(['value' => 1]) ?>
            <div class="blockunique-toggle-form">

                <?= $form->field($model, 'block_how_we_work_4_title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'block_how_we_work_4_text')->textarea(['rows' => 6]) ?>
            </div>
        </div>
    </div>

    <?= $form->field($model, 'block_ulicy_visible')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'block_districts_visible')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'block_leadback_visible')->checkbox(['value' => 1]) ?>

    <?= $form->field($model, 'visible')->dropDownList(['1' => 'Опубликовано', '0' => 'Черновик']) ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <?php // echo $form->field($model, 'lastmod')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

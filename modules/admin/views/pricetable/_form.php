<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Pricetable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pricetable-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            Price
        </div>
        <div class="panel-body">
            <div>
                <?php if (!empty($price_section)): ?>

                    <div class="form-group">
                        <select class="form-control" data-toggle="nav-tabs-change" data-target="#nav-tabs-price">
                            <?php foreach ($price_section as $key => $value): ?>
                                <?php if (!empty($key)): ?>
                                    <option value="#price-tabs-1-<?= $key ?>"><?= $value ?></option>
                                <?php else: ?>
                                    <option value="#price-tabs-1-0">Без категории</option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <ul class="nav nav-tabs hidden" role="tablist" id="nav-tabs-price">
                        <?php foreach ($price_section as $key => $value): ?>
                            <?php if (!empty($key)): ?>
                                <li role="presentation"><a href="#price-tabs-1-<?= $key ?>" aria-controls="price-tabs-1-<?= $key ?>" role="tab" data-toggle="tab"><?= $value ?></a></li>
                            <?php else: ?>
                                <li role="presentation" class="active"><a href="#price-tabs-1-0" aria-controls="price-tabs-1-0" role="tab" data-toggle="tab">Без категории</a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>

                    <div class="tab-content">
                        <?php foreach ($price_section as $key => $value): ?>
                            <?php
                                if (empty($key)) {
                                    $key = 0;
                                    $price_section_tab_active_class = 'in active';
                                } else {
                                    $price_section_tab_active_class = '';
                                }
                            ?>
                            <div role="tabpanel" class="tab-pane fade <?= $price_section_tab_active_class ?>" id="price-tabs-1-<?= $key ?>">
                                <?php $price_section_list = (!empty($price[$key])) ? $price[$key] : null;  ?>

                                <div class="checkboxList">
                                    <?php if (!empty($price_section_list) && is_array($price_section_list)): ?>
                                        <?= $form->field($model, "price[$key]")->checkboxList($price_section_list, ['item' => 
                                            function($index, $label, $name, $checked, $value) {
                                                return Html::checkbox($name, $checked, [
                                                    'value' => $value,
                                                    'label' => $label
                                                ]);
                                            },
                                            'value' => $model->price
                                        ]) ?>
                                    <?php endif; ?>
                                    <div class="m-b-sm">
                                        <label class="btn btn-default btn-sm checkboxList-toggle-btn">
                                            <input type="checkbox" class="checkboxList-toggle-all" name="all" value="1">
                                            <span>ВСЕ</span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <?= $form->field($model, 'visible')->dropDownList(['1' => 'Опубликовано', '0' => 'Черновик']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

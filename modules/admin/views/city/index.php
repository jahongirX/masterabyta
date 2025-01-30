<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Города';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="clearfix m-b-sm">
        <?= Html::a('Create City', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::Button('Show Cities', ['class' => 'btn btn-primary', 'id' => 'checked-cities-show']) ?>
        <?= Html::Button('Hide Cities', ['class' => 'btn btn-warning', 'id' => 'checked-cities-hide']) ?>

        <input type="text" class="form-control GridView-rows only_number" data-url="<?= Url::current(['per-page' => 20]) ?>" value="<?= $_SESSION['per-page'] ?>" maxlength="4" autocomplete="off">
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            [
                'format' => 'raw',
                'headerOptions' =>['class' => 'grid-view-check-all-rows'],
                'value' => function($data){
                    return '<input type="checkbox" class="cities-check" name="cities-check[]" value="'.$data->id.'">';
                },
            ],
            [
                'attribute' => 'id',
                'format' => 'text',
                'contentOptions' =>['class' => 'admin-table-iindex-id'],
                'filterOptions' =>['class' => 'admin-table-iindex-id'],
                'value' => function($data){
                    return $data->id;
                },
            ],
            'name',
            'alias',
            //'params:ntext',
            //'map:ntext',
            //'address',
            //'front_email:email',
            //'phone',
            //'wokrtime',
            [
                'attribute' => 'price_type',
                'format' => 'text',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName(Yii::$app->params['price_types'], $data->price_type);
                },
                'filter' => Yii::$app->params['price_types'],
            ],
            //'back_email:email',
            //'district:ntext',
            //'street:ntext',
            //'metro:ntext',
            //'shortcode_remont:ntext',
            //'tag_header:ntext',
            //'tag_body:ntext',
            //'robots_txt:ntext',
            [
                'attribute' => 'number',
                'contentOptions' =>['class' => 'admin-table-iindex-visible'],
                'filterOptions' =>['class' => 'admin-table-iindex-visible'],
            ],
            [
                'attribute' => 'visible',
                'format' => 'boolean',
                'contentOptions' =>['class' => 'admin-table-iindex-visible'],
                'filterOptions' =>['class' => 'admin-table-iindex-visible'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'filterOptions' => [
                    'class' => 'admin-table-filter-close-column',
                    'data-to' => Url::to('/admin/city/index'),
                    'data-current' => Url::current(),
                ],
            ],
        ],
    ]); ?>


</div>






<?php 
$checked_cities_delete_js = <<<JS
$(document).on('click', '#checked-cities-hide', function(e){
    e.preventDefault();

    var cities_check = $('.cities-check:checked');
    if (cities_check.length < 1) {
        alert('Ничего не выбрано!');
    } else {

        if (!confirm('Are you sure you want to hide checked items?')) {
            return false;
        }

        var cities = new Array;
        cities_check.each(function(){
            var one = $(this).val() || null;
            if (one) {
                cities.push(one);
            }
        });
        if (cities.length > 0) {
            cities = cities.join(',');
            if (cities) {
                var csrf_name = $('meta[name="csrf-param"]').attr('content') || '';
                var csrf_value = $('meta[name="csrf-token"]').attr('content') || '';

                var formData = new FormData();
                formData.append(csrf_name, csrf_value);
                formData.append('cities', cities);

                $.ajax({
                  url:  "/admin/city/mass-update/?visible=0",
                  type: 'POST',
                  dataType: 'json',
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: formData,
                  success: function(data){

                  }
                });

            }
        }
    }

    return false;
});

$(document).on('click', '#checked-cities-show', function(e){
    e.preventDefault();

    var cities_check = $('.cities-check:checked');
    if (cities_check.length < 1) {
        alert('Ничего не выбрано!');
    } else {

        if (!confirm('Are you sure you want to show checked items?')) {
            return false;
        }

        var cities = new Array;
        cities_check.each(function(){
            var one = $(this).val() || null;
            if (one) {
                cities.push(one);
            }
        });
        if (cities.length > 0) {
            cities = cities.join(',');
            if (cities) {
                var csrf_name = $('meta[name="csrf-param"]').attr('content') || '';
                var csrf_value = $('meta[name="csrf-token"]').attr('content') || '';

                var formData = new FormData();
                formData.append(csrf_name, csrf_value);
                formData.append('cities', cities);

                $.ajax({
                  url:  "/admin/city/mass-update/?visible=1",
                  type: 'POST',
                  dataType: 'json',
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: formData,
                  success: function(data){

                  }
                });

            }
        }
    }

    return false;
});
JS;

$this->registerJs($checked_cities_delete_js); ?>

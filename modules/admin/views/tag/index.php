<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

// названия городов
$GLOBALS['city'] = $city;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="clearfix m-b-sm">
        <?= Html::a('Create Tag', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::Button('Show Tags', ['class' => 'btn btn-primary', 'id' => 'checked-tags-show']) ?>
        <?= Html::Button('Hide Tags', ['class' => 'btn btn-warning', 'id' => 'checked-tags-hide']) ?>

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
                    return '<input type="checkbox" class="tags-check" name="tags-check[]" value="'.$data->id.'">';
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
            [
                'attribute' => 'disposition',
                'format' => 'text',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName(Yii::$app->params['tag_disposition'], $data->disposition);
                },
                'filter' => Yii::$app->params['tag_disposition'],
            ],
            // 'text:ntext',
            [
                'attribute' => 'city',
                'format' => 'raw',
                'value' => function($data){
                    $data->city = explode(',', $data->city);
                    return \app\helpers\CustomHelper::custom_array_cities($GLOBALS['city'], $data->city, $data->id);
                },
                'filter' => $city,
            ],
            [
                'attribute' => 'number',
                'format' => 'text',
                'contentOptions' =>['class' => 'admin-table-iindex-id'],
                'filterOptions' =>['class' => 'admin-table-iindex-id'],
                'value' => function($data){
                    return $data->number;
                },
            ],
            'visible:boolean',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'filterOptions' => [
                    'class' => 'admin-table-filter-close-column',
                    'data-to' => Url::to('/admin/tag/index'),
                    'data-current' => Url::current(),
                ],
            ],
        ],
    ]); ?>


</div>


<?php 
$checked_tags_mass_update_js = <<<JS
$(document).on('click', '#checked-tags-show', function(e){
    e.preventDefault();

    var tags_check = $('.tags-check:checked');
    if (tags_check.length < 1) {
        alert('Ничего не выбрано!');
    } else {

        if (!confirm('Are you sure you want to show checked items?')) {
            return false;
        }

        var tags = new Array;
        tags_check.each(function(){
            var one = $(this).val() || null;
            if (one) {
                tags.push(one);
            }
        });
        if (tags.length > 0) {
            tags = tags.join(',');
            if (tags) {
                var csrf_name = $('meta[name="csrf-param"]').attr('content') || '';
                var csrf_value = $('meta[name="csrf-token"]').attr('content') || '';

                var formData = new FormData();
                formData.append(csrf_name, csrf_value);
                formData.append('tags', tags);

                $.ajax({
                  url:  "/admin/tag/mass-update?visible=1",
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

$(document).on('click', '#checked-tags-hide', function(e){
    e.preventDefault();

    var tags_check = $('.tags-check:checked');
    if (tags_check.length < 1) {
        alert('Ничего не выбрано!');
    } else {

        if (!confirm('Are you sure you want to hide checked items?')) {
            return false;
        }

        var tags = new Array;
        tags_check.each(function(){
            var one = $(this).val() || null;
            if (one) {
                tags.push(one);
            }
        });
        if (tags.length > 0) {
            tags = tags.join(',');
            if (tags) {
                var csrf_name = $('meta[name="csrf-param"]').attr('content') || '';
                var csrf_value = $('meta[name="csrf-token"]').attr('content') || '';

                var formData = new FormData();
                formData.append(csrf_name, csrf_value);
                formData.append('tags', tags);

                $.ajax({
                  url:  "/admin/tag/mass-update?visible=0",
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

$this->registerJs($checked_tags_mass_update_js); ?>
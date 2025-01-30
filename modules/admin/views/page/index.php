<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

// массив баннеров
$GLOBALS['banner'] = $banner;

// массив городов
$GLOBALS['city'] = $city;

// массив шаблонов
$GLOBALS['templates'] = $templates;

// массив родительских страниц
$GLOBALS['parents'] = $parents;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="clearfix m-b-sm">
        <?= Html::a('Create Page', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::Button('Show Pages', ['class' => 'btn btn-primary', 'id' => 'checked-pages-show']) ?>
        <?= Html::Button('Hide Pages', ['class' => 'btn btn-warning', 'id' => 'checked-pages-hide']) ?>
        <?= Html::a('Прикрепленные партнеры', ['partners'], ['class' => 'btn btn-default']) ?>

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
                    return '<input type="checkbox" class="pages-check" name="pages-check[]" value="'.$data->id.'">';
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
                'attribute' => 'parent',
                'format' => 'text',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName($GLOBALS['parents'], $data->parent);
                },
                'filter' => $GLOBALS['parents'],
            ],
            [
                'attribute' => 'template',
                'format' => 'text',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName($GLOBALS['templates'], $data->template);
                },
                'filter' => $GLOBALS['templates'],
            ],
            'permalink',
            //'redirect',
            //'title',
            //'description',
            //'image',
            //'tag_header:ntext',
            //'tag_body:ntext',
            //'content:ntext',
            //'content_aside:ntext',
            //'content_two_title_on',
            //'content_two_title',
            //'content_two_on',
            //'content_two:ntext',
            //'content_two_aside:ntext',
            [
                'attribute' => 'city',
                'format' => 'raw',
                'value' => function($data){
                    $data->city = explode(',', $data->city);
                    return \app\helpers\CustomHelper::custom_array_cities($GLOBALS['city'], $data->city, $data->id);
                },
                'filter' => $city,
            ],
            //'skryt_na_poddomene',
            //'sh_pricerow',
            //'customprice:ntext',
            //'table:ntext',
            //'after_table:ntext',
            //'banner_id',
            //'sidebar_visible',
            //'sidebar_menu',
            //'block_leadback_price_visible',
            //'block_masters_visible',
            //'block_reviews_visible',
            //'block_benefits_visible',
            //'block_how_we_work_visible',
            //'block_how_we_work_4_title',
            //'block_how_we_work_4_text:ntext',
            //'block_ulicy_visible',
            //'block_districts_visible',
            //'block_leadback_visible',
            [
                'attribute' => 'visible',
                'format' => 'boolean',
                'contentOptions' =>['class' => 'admin-table-iindex-visible'],
                'filterOptions' =>['class' => 'admin-table-iindex-visible'],
            ],
            //'date_create',
            //'lastmod',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'filterOptions' => [
                    'class' => 'admin-table-filter-close-column',
                    'data-to' => Url::to('/admin/page/index'),
                    'data-current' => Url::current(),
                ],
            ],
            [
                'format' => 'html',
                'value' => function($data){
                    return '<a href="'.Url::to(['/admin/page/copy', 'id' => $data->id]).'" title="Создать копию"><span class="glyphicon glyphicon-duplicate"></span></a>';
                },
            ],
            [
                'format' => 'raw',
                'value' => function($data){
                    return '<a target="_blank" rel="noopener noreferrer nofollow" href="'.\app\helpers\UrlHelper::to(['page' => $data->permalink]).'" title="Открыть страницу на сайте"><span class="glyphicon glyphicon-globe"></span></a>';
                },
            ],
        ],
    ]); ?>


</div>






<?php 
$checked_pages_delete_js = <<<JS
$(document).on('click', '#checked-pages-hide', function(e){
    e.preventDefault();

    var pages_check = $('.pages-check:checked');
    if (pages_check.length < 1) {
        alert('Ничего не выбрано!');
    } else {

        if (!confirm('Are you sure you want to hide checked items?')) {
            return false;
        }

        var pages = new Array;
        pages_check.each(function(){
            var one = $(this).val() || null;
            if (one) {
                pages.push(one);
            }
        });
        if (pages.length > 0) {
            pages = pages.join(',');
            if (pages) {
                var csrf_name = $('meta[name="csrf-param"]').attr('content') || '';
                var csrf_value = $('meta[name="csrf-token"]').attr('content') || '';

                var formData = new FormData();
                formData.append(csrf_name, csrf_value);
                formData.append('pages', pages);

                $.ajax({
                  url:  "/admin/page/mass-update/?visible=0",
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

$(document).on('click', '#checked-pages-show', function(e){
    e.preventDefault();

    var pages_check = $('.pages-check:checked');
    if (pages_check.length < 1) {
        alert('Ничего не выбрано!');
    } else {

        if (!confirm('Are you sure you want to show checked items?')) {
            return false;
        }

        var pages = new Array;
        pages_check.each(function(){
            var one = $(this).val() || null;
            if (one) {
                pages.push(one);
            }
        });
        if (pages.length > 0) {
            pages = pages.join(',');
            if (pages) {
                var csrf_name = $('meta[name="csrf-param"]').attr('content') || '';
                var csrf_value = $('meta[name="csrf-token"]').attr('content') || '';

                var formData = new FormData();
                formData.append(csrf_name, csrf_value);
                formData.append('pages', pages);

                $.ajax({
                  url:  "/admin/page/mass-update/?visible=1",
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

$this->registerJs($checked_pages_delete_js); ?>

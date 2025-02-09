<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// массив баннеров
$GLOBALS['banner'] = $banner;

// массив городов
$GLOBALS['city'] = $city;

// массив цен
$GLOBALS['price'] = $price;

// массив шаблонов
$GLOBALS['templates'] = $templates;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Page */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'parent',
            [
                'attribute' => 'template',
                'format' => 'html',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName($GLOBALS['templates'], $data->template);
                },
            ],
            'permalink',
            'redirect',
            'title',
            'description',
            [
                'attribute' => 'image',
                'value' => \app\helpers\CustomHelper::getAdminCustomImage($model, 'image'),
                'format' => 'html',
            ],
            'tag_header:ntext',
            'tag_body:ntext',
            [
                'attribute' => 'banner_id',
                'format' => 'html',
                'value' => function($data){
                    return \app\helpers\CustomHelper::customParamName($GLOBALS['banner'], $data->banner_id);
                },
            ],
            [
                'attribute' => 'content',
                'value' => \app\helpers\CustomHelper::custom_longtext_collapsed($model->content, 550),
                'format' => 'raw',
            ],
            [
                'attribute' => 'content_aside',
                'value' => \app\helpers\CustomHelper::custom_longtext_collapsed($model->content_aside, 550),
                'format' => 'raw',
            ],
            'content_two_title_on:boolean',
            'content_two_title',
            'content_two_on:boolean',
            [
                'attribute' => 'content_two_aside',
                'value' => \app\helpers\CustomHelper::custom_longtext_collapsed($model->content_two_aside, 550),
                'format' => 'raw',
            ],
            [
                'attribute' => 'content_two',
                'value' => \app\helpers\CustomHelper::custom_longtext_collapsed($model->content_two, 550),
                'format' => 'raw',
            ],
            [
                'attribute' => 'content_three',
                'value' => \app\helpers\CustomHelper::custom_longtext_collapsed($model->content_three, 550),
                'format' => 'raw',
            ],
            [
                'attribute' => 'city',
                'value' => \app\helpers\CustomHelper::custom_array_cities($GLOBALS['city'], $model->city),
                'format' => 'raw',
            ],
            'skryt_na_poddomene:boolean',
            [
                'attribute' => 'sh_pricerow',
                'format' => 'raw',
                'value' => function($data){
                    if (!empty($data->sh_pricerow)) {
                        return '<a target="_blank" href="/admin/price/view/?id='.$data->sh_pricerow.'">'.\app\helpers\CustomHelper::customParamName($GLOBALS['price'], $data->sh_pricerow).'</a>';
                    } else {
                        return null;
                    }
                },
            ],
            [
                'attribute' => 'customprice',
                'value' => \app\helpers\CustomHelper::custom_longtext_collapsed($model->customprice, 550),
                'format' => 'raw',
            ],
            [
                'attribute' => 'table',
                'value' => \app\helpers\CustomHelper::custom_longtext_collapsed($model->table, 550),
                'format' => 'raw',
            ],
            [
                'attribute' => 'after_table',
                'value' => \app\helpers\CustomHelper::custom_longtext_collapsed($model->after_table, 550),
                'format' => 'raw',
            ],
            'sidebar_visible:boolean',
            'sidebar_menu',
            'block_leadback_price_visible:boolean',
            'block_masters_visible:boolean',
            'block_reviews_visible:boolean',
            'block_benefits_visible:boolean',
            'block_how_we_work_visible:boolean',
            'block_how_we_work_4_title',
            'block_how_we_work_4_text:ntext',
            'block_ulicy_visible',
            'block_districts_visible:boolean',
            'block_leadback_visible:boolean',
            'visible:boolean',
            [
                'attribute' => 'date_create',
                'format' => 'html',
                'value' => function($data){
                    if (!empty($data->date_create)) {
                        return \app\helpers\CustomHelper::custom_date($data->date_create);
                    } else {
                        return null;
                    }
                },
            ],
            [
                'attribute' => 'lastmod',
                'format' => 'html',
                'value' => function($data){
                    if (!empty($data->lastmod)) {
                        return \app\helpers\CustomHelper::custom_admin_datetime($data->lastmod);
                    } else {
                        return null;
                    }
                },
            ],
        ],
    ]) ?>

</div>

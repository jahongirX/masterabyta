<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

// названия городов
$GLOBALS['city'] = $city;

// названия страниц
$GLOBALS['page'] = $page;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Request */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(Yii::$app->user->can('requestUpdate')): ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?php if(Yii::$app->user->can('requestDelete')): ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'phone',
            [
                'attribute' => 'city',
                'value' => \app\helpers\CustomHelper::customParamName($GLOBALS['city'], $model->city),
                'format' => 'html',
            ],
            [
                'attribute' => 'page',
                'value' => \app\helpers\CustomHelper::customParamName($GLOBALS['page'], $model->page),
                'format' => 'html',
            ],
            [
                  'attribute' => 'partner',
                  'format' => 'html',
                  'value' => function($data){
                        if (!empty($data->partner)) {
                              return '<a href="' .Url::to(['/admin/partner/view', 'id'=>$data->partner]). '">' . $data->partner . '</a>';
                        } else {
                              return null;
                        }
                  }
            ],
            'rukiizplech_code',
            'servicelead_code',
            [
                'attribute' => 'date',
                'format' => 'html',
                'value' => function($data){             
                    return \app\helpers\CustomHelper::custom_admin_datetime($data->date);
                },
            ],
        ],
    ]) ?>

</div>

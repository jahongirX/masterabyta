<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

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
            'email:email',
            [
                'attribute' => 'role',
                'format' => 'text',
                'value' => function($data){             
                    return \app\helpers\CustomHelper::customParamName(Yii::$app->params['user_roles'], $data->role);
                },
            ],
            // 'password',
            // 'auth_key',
            'ban:boolean',
            [
                'attribute' => 'date_reg',
                'format' => 'html',
                'value' => function($data){             
                    return \app\helpers\CustomHelper::custom_admin_datetime($data->date_reg);
                },
            ],
        ],
    ]) ?>

</div>

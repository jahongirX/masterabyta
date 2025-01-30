<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;


if(!Yii::$app->user->isGuest && preg_match('/^admin\/.*\z/', Yii::$app->controller->module->requestedRoute)){
    $this->context->layout = '@app/modules/admin/views/layouts/admin';
    $home = Url::to(['/admin/default']);
}else{
    $this->context->layout = '@app/views/layouts/error';
    $home = Url::to(['/']);
}

if ($name === 'Not Found (#404)') {
    $name = 'Ошибка 404';
    $message = 'К сожалению, страница не найдена.';
}

$this->title = $name;
?>


<div class="container content">
    <div class="row p-t-md">
        <?php if(Yii::$app->user->isGuest || !preg_match('/^admin\/.*\z/', Yii::$app->controller->module->requestedRoute)): ?>
            <div class="three-mod columns">
                <?php require_once __DIR__.'/../layouts/include/sidebar.php'; ?>
            </div>
        <?php endif; ?>

        <div class="nine-mod columns">
            <h1><?= Html::encode($this->title) ?></h1>
            <p><?= nl2br(Html::encode($message)) ?></p>
            <p><a href="<?= $home ?>">Вернуться на главную</a></p>
        </div>
    </div>
</div>

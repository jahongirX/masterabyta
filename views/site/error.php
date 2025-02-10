<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;



?>
<div class="breadcrumbs">
    <div class="wrap">
        <span><span><a href="<?=Url::home()?>">Главная</a></span></span>   </div>
</div>
<div class="pagecontent">
    <div class="wrap">
        <h1 class="blocktitle">Ошибка 404</h1>
        <div class="contnt">
            <p>К сожалению, запрашиваемая Вами страница не найдена.</p>
            <p><a href="/">Вернуться на главную</a></p>
        </div>
    </div>
</div>

<?=\app\widgets\ZadatVopros::widget()?>

<?php

use yii\web\NotFoundHttpException;

if (isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    $news_item = \app\models\News::findOne($id);
}else{
    throw new NotFoundHttpException('Страница не найдена.', 404);
}
?>
<div class="breadcrumbs" style="margin-top: 50px;">
    <div class="wrap">
        <span><span><a href="<?=\yii\helpers\Url::home()?>">Главная</a></span> / <span><a href="<?=\yii\helpers\Url::to(['/category/articles/'])?>">Полезные статьи</a></span> / <span class="breadcrumb_last" aria-current="page"><?=$news_item->title?></span></span>   </div>
</div>
<div class="pagecontent">
    <div class="wrap">
        <h1 class="blocktitle"><?=$news_item->title?></h1>
        <div class="contnt">
            <div class="date"><?=date('d.m.Y' , strtotime($news_item->created_at))?></div>
            <?=html_entity_decode($news_item->content);?>
        </div>
        <?=\app\widgets\ZadatVopros::widget()?>
</div>
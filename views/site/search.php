<?php
?>
<div class="breadcrumbs" style="margin-top: 50px">
    <div class="wrap">
        <span><span><a href="<?=\yii\helpers\Url::home()?>">Главная</a></span></span>   </div>
</div>
<div class="pagecontent catbox">
    <div class="wrap">
        <h1 class="blocktitle"><?=!empty($page['title']) ? $page['title'] : ''?></h1>
        <div class="category">
            <?php if (!empty($result)): ?>
                <?php foreach ($result as $item): ?>
                <?php
                    $shortText = mb_substr($item['text'], 0, 775, 'UTF-8');
                ?>
                    <div class="article" style="padding-left:30px;  padding-top:10px; padding-bottom:20px; height:auto;">
                        <a href="<?=$item['href']?>" class="title"><?=$item['page_name']?></a>
                        <p><?=$shortText?></p>
                        <a href="<?=$item['href']?>" class="more">Читать далее</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>По вашему запросу ничего не найдено.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= \app\widgets\ZadatVopros::widget() ?>

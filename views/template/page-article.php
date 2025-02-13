<?php 

use yii\helpers\Url;
use app\helpers\CustomHelper;
use app\helpers\VariableHelper;
use app\helpers\UrlHelper;
use app\models\City;
use app\models\Menu;
use app\models\Page;
use app\models\Blocktechnical;
use app\models\Setting;
use yii\widgets\LinkPager;


$this->params['breadcrumbs'][] = ['label' => 'Полезные статьи', 'url' => '/category/poleznye-stati/'];
$this->params['breadcrumbs'][] = Page::getTitle();

?>
    <style>
        .pages{
            display: flex;
            list-style: none;
            justify-content: center;
        }
        .active a{
            width: 40px;
            height: 40px;
            background: #ffc500;
            border-radius: 40px;
        }
    </style>

<?php require_once __DIR__.'/../layouts/include/banner.php'; ?>

<?php
$pageTitle = Page::getTitle();
?>
<div class="breadcrumbs" style="margin-top: 60px;">
    <div class="wrap">
        <span><span><a href="<?=Url::home()?>">Главная</a></span> / <span class="breadcrumb_last" aria-current="page">Полезные статьи</span></span>   </div>
</div>
<div class="pagecontent catbox">
    <div class="wrap">
        <h1 class="blocktitle">Полезные статьи</h1>
        <div class="category">
            <?php if (!empty($news)): ?>
                <?php foreach ($news as $item): ?>
                    <div class="article">
                        <img width="240" height="190" src="<?=!empty($item->image) ? $item->image : ''?>" class="attachment-post size-post wp-post-image" alt="Как собрать шкаф купе" decoding="async">            <span class="date">31.12.2023</span>
                        <a href="<?=Url::to(['/news/view' , 'id' => $item->id])?>" class="title"><?=$item->title?></a>
                        <p><?=$item->description?></p>
                        <a href="<?=Url::to(['/news/view' , 'id' => $item->id])?>" class="more">Читать далее</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
            echo LinkPager::widget([
                'pagination' => $pagination,
                'options' => ['class' => 'pages pagenavi'],
                'prevPageLabel' => false,
                'nextPageLabel' => false,
                'hideOnSinglePage' => true,
            ]);
        ?>


</div>
<?=\app\widgets\ZadatVopros::widget()?>
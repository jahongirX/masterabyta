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


$this->params['breadcrumbs'][] = Page::getTitle();


?>
<style>
    .price-toggler-wrap{
        margin-bottom: 30px;
    }
    .textblock li{
        margin-bottom: 0;
    }
    .textblock p{
        margin: 0;
        padding: 0;
    }
    .textblock h2, .textblock h2.blocktitle{
        margin: 0;
    }
</style>
<?php require_once __DIR__.'/../layouts/include/banner.php'; ?>
<?php
$pageTitle = Page::getTitle();
$pageContent = Page::getContent();
//echo    '<pre>';
//print_r($page);die();
?>
<div class="breadcrumbs mt15">
    <div class="wrap">
        <span><span><a href="<?=Url::home()?>">Главная</a></span> / <span class="breadcrumb_last" aria-current="page"><?=$pageTitle?></span></span>   </div>
</div>

<?php if (!empty($pageContent)): ?>
<?php if (!empty($page)){
//    $pageContent = str_replace()
    } ?>
    <div class="textblock" style="padding-bottom:0;margin-bottom:20px">
        <div class="wrap">
            <div><?= $pageContent ?></div>
        </div>
    </div>

<?php endif; ?>

<?=\app\widgets\NenashliBanner::widget()?>

<div class="textblock" style="padding-bottom:0;margin-bottom:20px">
    <div class="wrap">
        <div><?= html_entity_decode($page->content_two) ?></div>
    </div>
</div>
<div class="ourservicesblock">
    <div class="wrap">
         <span class="blocktitle">
            Другие наши услуги</span>
        <ul>
            <li><a href="/uslugi-santehnika/"><span>Услуги сантехника<span></a></li>
            <li><a href="/remont-mebeli/"><span>Ремонт мебели<span></a></li>
            <li><a href="/melkij-remont-v-kvartire/"><span>Мелкий ремонт<span></a></li>
            <li><a href="/sborka-mebeli/"><span>Сборка мебели<span></a></li>
            <li><a href="/uslugi-elektrika/"><span>Услуги электрика<span></a></li>
            <li><a href="/uslugi-klininga/"><span>Услуги клининга<span></a></li>
            <li><a href="/remont-plastikovyh-okonl"><span>Ремонт пластиковых окон<span></a></li>
            <li><a href="/zhena-na-chas/"><span>Жена на час<span></a></li>
            <li><a href="/uslugi-plotnika/"><span>Услуги плотника<span></a></li>
            <li style="display:none"></li>
        </ul>
    </div>
</div>


<?=\app\widgets\Whyus::widget()?>
<div class="textblock" style="padding-bottom:0;margin-bottom:20px">
    <div class="wrap">
        <div><?= html_entity_decode($page->content_three) ?></div>
    </div>
</div>
<?//=\app\widgets\LargeTextBlock::widget()?>
<?=\app\widgets\SearchMetro::widget()?>
<?=\app\widgets\HowToOrder::widget()?>
<?=\app\widgets\OrderServiceBanner::widget()?>
<?=\app\widgets\Video::widget()?>
<?=\app\widgets\Testimonials::widget()?>
<?=\app\widgets\Masters::widget()?>
<?=\app\widgets\HaveQuestions::widget()?>


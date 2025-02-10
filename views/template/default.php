<?php 

use yii\helpers\Url;
use app\helpers\CustomHelper;
use app\helpers\VariableHelper;
use app\helpers\UrlHelper;
use app\models\City;
use app\models\Menu;
use app\models\Page;
use app\models\Review;
use app\models\Blocktechnical;
use app\models\Setting;


$this->params['breadcrumbs'][] = Page::getTitle();


?>

<?=\app\widgets\Zastavka::widget() ?>

<?php
$pageTitle = Page::getTitle();
$pageContent = Page::getContent();
//echo '<pre>';
//print_r($page);die();
?>
<style>
    p strong{
        margin 10px 0 !important;
        display: inline-block;
    }
</style>
<div class="breadcrumbs">
    <div class="wrap">
     <span><span><a href="<?=Url::home()?>">Главная</a></span> / <span class="breadcrumb_last"
                                                                    aria-current="page"><?=$pageTitle?></span></span>
    </div>
</div>
<div class="pagecontent">
    <div class="wrap">
        <h1 class="blocktitle"><?=$pageTitle?></h1>
        <div class="contnt">
            <?=$pageContent?>
            <?php if (!empty($page) && !empty($page->permalink)): ?>
            <?php if ($page->permalink == 'kontakty'): ?>
            <p>
                <script type="text/javascript" charset="utf-8" async
                        src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A581805a9caa779b370ed6c690ec9ae6dfb2eaaae2a6e5a31f36d95677b8e11de&amp;width=100%25&amp;height=519&amp;lang=ru_RU&amp;scroll=true"></script>
            </p>
            <?php endif; ?>
            <?php endif; ?>
        </div>

    </div>
</div>
<?=\app\widgets\ZadatVopros::widget()?>

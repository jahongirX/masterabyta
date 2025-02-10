<?php

use yii\helpers\Url;
use app\helpers\CustomHelper;
use app\helpers\VariableHelper;
use app\helpers\UrlHelper;
use app\models\City;
use app\models\Menu;
use app\models\Master;
use app\models\Page;
use app\models\Review;
use app\models\Blocktechnical;
use app\models\Setting;


$this->params['breadcrumbs'][] = Page::getTitle();


$cityId = Yii::$app->params['city']['id'];
$mesterPagesPermalinkArr = Page::find()->select(['id', 'permalink'])->where(['template' => 18])->andWhere(['visible' => 1])->andWhere([
    'OR',
    ['city' => $cityId],
    ['like', 'city', "{$cityId},%", false],
    ['like', 'city', "%,{$cityId}", false],
    ['like', 'city', "%,{$cityId},%", false]
    ])->asArray()->all();
$mesterPagesPermalinkArr = CustomHelper::customParamArray($mesterPagesPermalinkArr, 'id', 'permalink');


// массив всех мастеров
$mastersArr = Master::find()->asArray()->all();
$mastersArr = CustomHelper::customMultiParamArray($mastersArr, 'id');


?>
<style>
    .pagecontent h1.blocktitle{
        padding-top: 25px;
    }
</style>
<?=\app\widgets\Zastavka::widget() ?>
<?php
$pageTitle = Page::getTitle();
$pageContent = Page::getContent();
?>
<div class="pagecontent pb30">
    <div class="wrap">
        <h1 class="blocktitle">Отзывы клиентов</h1>
        <div class="contnt">
            <?=$pageContent?>
        </div>
    </div>
</div>
<div class="reviewsblock">
        <div class="wrap">
            <div class="articles">
                <?php if (!empty(Yii::$app->params['page']['block_reviews_visible'])): ?>
                    <?php $reviews = Review::find()->where(['visible' => 1])->orderBy(['date' => SORT_DESC, 'id' => SORT_DESC])->asArray()->all(); ?>
                    <?php if (!empty($reviews)): ?>
                        <?php foreach($reviews as $review): ?>
                        <?php
                            $user_image = '/default/user.jpg';
                            if (!empty($review['user_image'])){
                                $user_image = $review['user_image'];
                            }
                        ?>
                            <div class="article" style="margin-bottom:30px">
                                <div class="top">
                                    <img width="80" height="80" src="<?=$user_image?>" class="attachment-photo size-photo wp-post-image" alt="" decoding="async" loading="lazy" srcset="" sizes="auto, (max-width: 80px) 100vw, 80px">
                                    <span class="name"><?=$review['name']?></span>
                                </div>
                                <?php if (!empty($review['image'])): ?>
                                    <a href="<?=$review['image']?>" data-fancybox="gallery"><img src="<?=$review['image']?>"></a>
                                <?php endif; ?>
                                <p><?=$review['text']?></p>
                            </div>

                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?=\app\widgets\ZadatVopros::widget()?>


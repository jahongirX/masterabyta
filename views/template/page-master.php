<?php 

use yii\helpers\Url;
use app\helpers\CustomHelper;
use app\helpers\VariableHelper;
use app\helpers\UrlHelper;
use app\models\City;
use app\models\Menu;
use app\models\Page;
use app\models\Master;
use app\models\Review;
use app\models\Blocktechnical;
use app\models\Setting;


$this->params['breadcrumbs'][] = ['label' => 'Наши мастера', 'url' => '/master/'];
$this->params['breadcrumbs'][] = Page::getTitle();

$master = Master::find()->where(['page' => Yii::$app->params['page']['id']])->limit(1)->asArray()->one();


?>

<?php require_once __DIR__.'/../layouts/include/banner.php'; ?>


<div class="container content">
    <div class="row">

        <?php if (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['sidebar_visible'])): ?>
            <div class="three-mod columns">
                <?php require_once __DIR__.'/../layouts/include/sidebar.php'; ?>
            </div>
            <div class="nine-mod columns">
        <?php else: ?>
            <div class="twelve columns">
        <?php endif; ?>

        <?php require_once __DIR__.'/../layouts/include/breadcrumbs.php'; ?>

            <?php 
                $pageTitle = Page::getTitle();
                $pageContent = Page::getContent();
            ?>

            <?php if (empty(Yii::$app->params['banner_use_page_header'])): ?>
                <?php if (!empty($pageTitle)): ?>
                    <h1><?= CustomHelper::custom_br($pageTitle) ?></h1>
                <?php endif; ?>
            <?php else: ?>
                <div style="margin-bottom: 10px;"></div>
            <?php endif; ?>

            <div class="b-master-card">
                <div class="b-master-card__row">
                    <div class="b-master-card__col-left">
                        <div class="b-master-card__image-wrap">
                            <?php if (!empty($master['image'])): ?>
                                <img width="140" height="140" src="<?= $master['image'] ?>" class="b-master-card__image" alt="<?= CustomHelper::custom_inline($master['name']) ?>">
                            <?php endif; ?>
                        </div>
                        <div class="b-master-card__text-wrap">
                            <?php if (!empty($master['name'])): ?>
                                <div class="b-master-card__name"><?= $master['name'] ?></div>
                            <?php endif; ?>
                            <?php if (!empty($master['specialization'])): ?>
                                <div class="b-master-card__specialization"><?= $master['specialization'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="b-master-card__col-right">
                        <ul class="b-master-card__list">
                            <li><span class="item-icon"><i class="fa fa-check"></i></span> Личные данные подтверждены</li>
                            <li><span class="item-icon"><i class="fa fa-star"></i></span>Предоставляет гарантию</li>
                            <li><span class="item-icon"><i class="fa fa-clock-o"></i></span>Стаж работы: <b><?= $master['experience'] ?> лет</b></li>
                            <li><span class="item-icon"><i class="fa fa-gear"></i></span>Выполненных заказов: <b><?= $master['projects'] ?></b></li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php if (!empty($pageContent)): ?>
                <div><?= $pageContent ?></div>
            <?php endif; ?>


            <?php require_once __DIR__.'/../layouts/include/leadback-price.php'; ?>


            <?php if (!empty(Yii::$app->params['page']['block_reviews_visible'])): ?>
                <?php if (!empty($master['id'])): ?>
                    <?php $reviews = Review::find()->where(['visible' => 1])->andWhere(['master' => $master['id']])->orderBy(['date' => SORT_DESC, 'id' => SORT_DESC])->limit(3)->asArray()->all(); ?>
                    <?php if (!empty($reviews)): ?>
                        <h2 class="mt30 mb30 text-center">Отзывы</h2>
                        <?php foreach($reviews as $review): ?>
                            <div class="review">
                                  <div class="review-top flex-justify">
                                    <div class="review-name"><?= $review['name'] ?></div>
                                    <div class="user-review-rating mt0"><?= \app\models\Review::stars($review['rating']) ?> <b><?= $review['rating'] ?></b></div>
                                </div>
                                <div class="review-text">
                                    <?= $review['text'] ?>
                                    <div class="spacer"></div>
                                    <?php if (!empty($review['date'])): ?>
                                        <div class="user-review-date"><?= date('d.m.Y', $review['date']) ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($review['service'])): ?>
                                        <?php $service = Menu::controlMenuArray($review['service']); ?>
                                        <?php if (!empty($service) && is_array($service)): ?>
                                            <div class="user-review-service">Заказанные услуги: <?= Review::formatMenuHtml($service) ?></div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- <a href="/otzyvy/" class="all-masters">Все отзывы</a> -->
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>


            <?php if (!empty(Yii::$app->params['page']['block_benefits_visible'])): ?>
                <h2 class="mt30 mb30 text-center">Наши преимущества</h2>
                <?php require_once __DIR__.'/benefits-2.php'; ?>
            <?php endif; ?>


            <?php require_once __DIR__.'/../layouts/include/how-we-work.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/ulicy.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/leadback-2.php'; ?>

        </div>
    </div>
</div>

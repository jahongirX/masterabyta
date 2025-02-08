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

<?=\app\widgets\Zastavka::widget() ?>

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

          <?php if (!empty($pageContent)): ?>
              <div><?= $pageContent ?></div>
          <?php endif; ?>



          <?php if (!empty(Yii::$app->params['page']['block_reviews_visible'])): ?>
            <?php $reviews = Review::find()->where(['visible' => 1])->orderBy(['date' => SORT_DESC, 'id' => SORT_DESC])->asArray()->all(); ?>
            <?php if (!empty($reviews)): ?>
              <!-- <h2 class="mt30 mb30 text-center">Отзывы клиентов</h2> -->
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
                        <?php if (!empty($review['master']) && !empty($mastersArr) && !empty($mastersArr[$review['master']])): ?>
                          <?php $masterOne = $mastersArr[$review['master']]; ?>
                          <div class="user-review-master">Мастер: 
                              <?php if (!empty($masterOne['page']) && !empty($mesterPagesPermalinkArr) && !empty($mesterPagesPermalinkArr[$masterOne['page']])): ?>
                                  <a href="<?= UrlHelper::to(['city' => '/', 'page' => $mesterPagesPermalinkArr[$masterOne['page']]]) ?>">
                                      <b><?= $masterOne['name'] ?></b>
                                  </a>
                              <?php else: ?>
                                  <b><?= $masterOne['name'] ?></b>
                              <?php endif; ?>
                          </div>
                      <?php endif; ?>
                    </div>
                  </div>
              <?php endforeach; ?>
            <?php endif; ?>
          <?php endif; ?>



          <?php require_once __DIR__.'/../layouts/include/leadback-2.php'; ?>


        </div>
    </div>
</div>

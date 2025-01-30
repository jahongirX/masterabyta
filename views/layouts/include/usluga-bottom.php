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


<?php if (!empty(Yii::$app->params['page']['block_masters_visible'])): ?>
    <?php $masters = Master::find()->where(['visible' => 1])->orderBy(['number' => SORT_DESC, 'id' => SORT_DESC])->limit(3)->asArray()->all(); ?>
    <?php if (!empty($masters)): ?>
        <h2 class="mt30 mb30 text-center">Наши лучшие мастера</h2>
        <div class="masters">
            <div class="masters-inner">
                <?php foreach($masters as $one): ?>
                    <div class="masters-col">
                        <div class="master">
                            <div class="master-top">
                                <div class="master-top-left">
                                    <?php if (!empty($one['image'])): ?>
                                        <?php if (!empty($one['page']) && !empty($mesterPagesPermalinkArr[$one['page']])): ?>
                                            <a href="<?= UrlHelper::to(['page' => $mesterPagesPermalinkArr[$one['page']]]) ?>">
                                                <img width="300" height="300" src="<?= $one['image'] ?>" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" decoding="async" fetchpriority="high">
                                            </a>
                                        <?php else: ?>
                                            <img width="300" height="300" src="<?= $one['image'] ?>" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" decoding="async" fetchpriority="high">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="master-top-right">
                                    <?php if (!empty($one['projects'])): ?>
                                        <div class="master-top-right-info">
                                            <b><?= $one['projects'] ?></b>
                                            работ за последний месяц
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($one['experience'])): ?>
                                        <div class="master-top-right-info">
                                            <b><?= $one['experience'] ?></b>
                                            лет<br> опыта
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="master-bottom">
                                <?php if (!empty($one['name'])): ?>
                                    <div class="master-name">
                                        <?php if (!empty($one['page']) && !empty($mesterPagesPermalinkArr[$one['page']])): ?>
                                            <a href="<?= UrlHelper::to(['page' => $mesterPagesPermalinkArr[$one['page']]]) ?>"><?= $one['name'] ?></a>
                                        <?php else: ?>
                                            <?= $one['name'] ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="master-table">
                                    <table>
                                        <?php if (!empty($one['age'])): ?>
                                            <tr>
                                                <td>Возраст:</td>
                                                <td><?= $one['age'] ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (!empty($one['specialization'])): ?>
                                            <tr>
                                                <td>Специализация:</td>
                                                <td><?= $one['specialization'] ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (!empty($one['in_company'])): ?>
                                            <tr>
                                                <td>В компании:</td>
                                                <td><?= $one['in_company'] ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if (!empty($one['about'])): ?>
                                            <tr>
                                                <td colspan="2"><b>О мастере:</b><br><span style="font-weight:normal"><?= $one['about'] ?></span></td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <a href="/master/" class="all-masters">Все мастера</a>
    <?php endif; ?>
<?php endif; ?>




<?php if (!empty(Yii::$app->params['page']['block_reviews_visible'])): ?>
    <?php $reviews = Review::find()->where(['visible' => 1])->orderBy(['date' => SORT_DESC, 'id' => SORT_DESC])->limit(3)->asArray()->all(); ?>
    <?php if (!empty($reviews)): ?>
        <h2 class="mt30 mb30 text-center">Отзывы клиентов</h2>
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
                                <a href="<?= UrlHelper::to(['page' => $mesterPagesPermalinkArr[$masterOne['page']]]) ?>">
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
        <a href="/reviews/" class="all-masters">Все отзывы</a>
    <?php endif; ?>
<?php endif; ?>




<?php if (!empty(Yii::$app->params['page']['block_benefits_visible'])): ?>
    <h2 class="mt30 mb30 text-center">Наши преимущества</h2>
    <?php require_once __DIR__.'/benefits-2.php'; ?>
<?php endif; ?>
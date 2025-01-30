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

            <?php if (!empty($pageContent)): ?>
                <div><?= $pageContent ?></div>
            <?php endif; ?>



          <?php if (!empty(Yii::$app->params['page']['block_masters_visible'])): ?>
            <?php $masters = Master::find()->where(['visible' => 1])->orderBy(['number' => SORT_DESC, 'id' => SORT_DESC])->asArray()->all(); ?>
            <?php if (!empty($masters)): ?>
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
            <?php endif; ?>
          <?php endif; ?>



          <?php require_once __DIR__.'/../layouts/include/leadback-2.php'; ?>


        </div>
    </div>
</div>

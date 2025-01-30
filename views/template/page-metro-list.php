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


$metro = Page::find()->select(['id', 'name', 'permalink'])->where(['template' => 14])->andWhere(['visible' => 1])->andWhere([
    'OR',
    ['like', 'city', Yii::$app->params['city']['id'], false],
    ['like', 'city', Yii::$app->params['city']['id'].',%', false],
    ['like', 'city', '%,'.Yii::$app->params['city']['id'], false],
    ['like', 'city', '%,'.Yii::$app->params['city']['id'].',%', false],
    ])->orderBy(['name' => SORT_ASC])->asArray()->all();

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


            <?php if (!empty($metro)): ?>
                <ul>
                    <?php foreach ($metro as $one): ?>
                        <?php if (!empty($one)): ?>
                            <li><a href="<?= UrlHelper::to(['page' => $one['permalink']]) ?>"><?= $one['name'] ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>


            <?php require_once __DIR__.'/../layouts/include/leadback-price.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/usluga-bottom.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/how-we-work.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/ulicy.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/leadback-2.php'; ?>

        </div>
    </div>
</div>

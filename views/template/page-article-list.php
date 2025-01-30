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
use yii\data\Pagination;
use yii\widgets\LinkPager;


$this->params['breadcrumbs'][] = Page::getTitle();


$pageList_query = Page::find()->where(['template' => 17])->andWhere(['visible' => 1]);

$params = array();
$params['page'] = (!empty($_GET['page'])) ? (int) $_GET['page'] : 0;
// Создаем объект пагинации
$pageList_pagination = new Pagination([
    'defaultPageSize' => 10, // Количество записей на одной странице
    'totalCount' => $pageList_query->count(), // Общее количество записей
    'route' => Yii::$app->params['page']['permalink'],
    'params' => $params,
]);

$pageList = $pageList_query->orderBy(['date_create' => SORT_DESC])->offset($pageList_pagination->offset)->limit($pageList_pagination->limit)->asArray()->all();


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

            
            <?php if (!empty($pageList)): ?>
                <div class="b-article__list">
                    <?php foreach ($pageList as $one): ?>
                        <?php if (!empty($one)): ?>
                            <div class="b-article__item">
                                <div class="b-article__item-image-wrap">
                                    <a href="<?= UrlHelper::to(['city' => '/', 'page' => $one['permalink']]) ?>">
                                        <?php if (!empty($one['image'])): ?>
                                            <img src="<?= $one['image'] ?>" alt="" class="b-article__item-image">
                                        <?php elseif (file_exists(Yii::getAlias('@app/web/upload/elfinder/articles/placeholder.webp'))): ?>
                                            <img src="/upload/elfinder/articles/placeholder.webp" alt="" class="b-article__item-image">
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="b-article__item-content">
                                    <?php $one_date_create = $one['date_create']; ?>
                                    <?php if (!empty($one_date_create)): ?>
                                        <div class="b-article__item-date"><?= CustomHelper::custom_date($one_date_create) ?></div>
                                    <?php endif; ?>
                                    <?php 
                                        $one_name = $one['name'];
                                        if (!City::isMainCity() && !empty($one['content_two_title_on'])) {
                                            $one_name = ['content_two_title'];
                                        }
                                        if (!empty($one_name)) {
                                            $one_name = VariableHelper::variableSubstitution($one_name);
                                        }
                                    ?>
                                    <?php if (!empty($one_name)): ?>
                                        <div class="b-article__item-title">
                                            <a href="<?= UrlHelper::to(['city' => '/', 'page' => $one['permalink']]) ?>">
                                                <?= $one_name ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <?php 
                                        $one_content = $one['content'];
                                        if (!City::isMainCity() && !empty($one['content_two_on'])) {
                                            $one_content = ['content_two'];
                                            if (!empty($one['content_two_aside'])) {
                                                $one_content = $one['content_two_aside'] . $one_content;
                                            }
                                        } else {
                                            if (!empty($one['content_aside'])) {
                                                $one_content = $one['content_aside'] . $one_content;
                                            }
                                        }
                                        if (!empty($one_content)) {
                                            $one_content = VariableHelper::variableSubstitution($one_content);
                                            $one_content = strip_tags($one_content);
                                            $one_content = CustomHelper::truncateText($one_content, 255);
                                        }
                                    ?>
                                    <?php if (!empty($one_content)): ?>
                                        <div class="b-article__item-text"><?= $one_content ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endforeach; ?>
                </div>

                <?= LinkPager::widget([
                    'pagination' => $pageList_pagination,
                ]) ?>
            <?php endif; ?>


            <?php require_once __DIR__.'/../layouts/include/leadback-price.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/usluga-bottom.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/how-we-work.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/ulicy.php'; ?>
            <?php require_once __DIR__.'/../layouts/include/leadback-2.php'; ?>

        </div>
    </div>
</div>

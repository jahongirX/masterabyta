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

$passcode = '12345';

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

            <?php $pass = (isset($_POST["pass"])) ? $_POST["pass"] : ''; ?>
            <?php if($pass==$passcode): ?>

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

            <?php else: ?>

                <?php 
                    $pageTitle = Page::getTitle();
                ?>

                <?php if (!empty($pageTitle)): ?>
                    <h1><?= CustomHelper::custom_br($pageTitle) ?></h1>
                <?php endif; ?>

                <p>Защищенная страница</p>
                <form action="" method="post">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>">
                    <p>Введите пароль:</p>
                    <input type="password" name="pass">
                    <button type="submit">Отправить</button>
                </form>
                <?php if(isset($_POST["pass"])): ?>
                    <p style="color:#ff0000">Пароль введен не верно</p>
                <?php endif; ?>

            <?php endif; ?>

        </div>
    </div>
</div>
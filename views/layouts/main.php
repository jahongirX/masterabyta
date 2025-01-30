<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\MainAsset;
use app\helpers\VariableHelper;
use app\helpers\UrlHelper;

MainAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?= \app\helpers\CustomHelper::custom_get_page_script(1) ?>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.webmanifest">

    <?php $this->head() ?>

    <?php require_once __DIR__.'/include/style.php'; ?>

    <?php if ($yandex = VariableHelper::getParamValue('yandex')): ?>
        <meta name="yandex-verification" content="<?= $yandex ?>" />
    <?php endif; ?>

    <?= \app\helpers\CustomHelper::custom_get_page_script(2) ?>

    <script>
        <?php if (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['id'])) {
            echo 'var post_id = ' . Yii::$app->params['page']['id'] . ';';
        } else {
            echo 'var post_id = null;';
        } ?>
        var page_url = '<?= UrlHelper::to(["page" => Yii::$app->params["permalink"]]) ?>';
    </script>

    <?php if (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['tag_header'])) {
        echo Yii::$app->params['page']['tag_header'];
    } ?>
    <?php if (!empty(Yii::$app->params['city']) && !empty(Yii::$app->params['city']['tag_header'])) {
        echo Yii::$app->params['city']['tag_header'];
    } ?>
    <?php if (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['tag_header'])) {
        echo Yii::$app->params['partner']['tag_header'];
    } ?>

    <?php 
        $recaptchaV3Helper = new \app\helpers\RecaptchaV3Helper();
        echo $recaptchaV3Helper->getScript();

        $recaptchaPublicKey = $recaptchaV3Helper->getPublicKey();
        echo "<script>var recaptcha_public_key = '{$recaptchaPublicKey}';</script>";
    ?>
</head>
<body id="top">

<?= \app\helpers\CustomHelper::custom_get_page_script(3) ?>

<?php $this->beginBody() ?>

<?php require_once __DIR__.'/include/header.php'; ?>

<div class="body-content">
    <?= $content ?>
</div>

<?php require_once __DIR__.'/include/footer.php'; ?>
<?php require_once __DIR__.'/include/modal.php'; ?>

<?php $this->endBody() ?>

<?= \app\helpers\CustomHelper::custom_get_page_script(4) ?>

<?php require_once __DIR__.'/include/scripts.php'; ?>

<?php if (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['tag_body'])) {
    echo Yii::$app->params['page']['tag_body'];
} ?>
<?php if (!empty(Yii::$app->params['city']) && !empty(Yii::$app->params['city']['tag_body'])) {
    echo Yii::$app->params['city']['tag_body'];
} ?>
<?php if (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['tag_body'])) {
    echo Yii::$app->params['partner']['tag_body'];
} ?>

</body>
</html>
<?php $this->endPage() ?>

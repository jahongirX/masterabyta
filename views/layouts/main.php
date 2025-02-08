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
    <style id='classic-theme-styles-inline-css' type='text/css'>
        /*! This file is auto-generated */
        .wp-block-button__link {
            color: #fff;
            background-color: #32373c;
            border-radius: 9999px;
            box-shadow: none;
            text-decoration: none;
            padding: calc(.667em + 2px) calc(1.333em + 2px);
            font-size: 1.125em
        }

        .wp-block-file__button {
            background: #32373c;
            color: #fff;
            text-decoration: none
        }
    </style>
    <style id='global-styles-inline-css' type='text/css'>
        :root {
            --wp--preset--aspect-ratio--square: 1;
            --wp--preset--aspect-ratio--4-3: 4/3;
            --wp--preset--aspect-ratio--3-4: 3/4;
            --wp--preset--aspect-ratio--3-2: 3/2;
            --wp--preset--aspect-ratio--2-3: 2/3;
            --wp--preset--aspect-ratio--16-9: 16/9;
            --wp--preset--aspect-ratio--9-16: 9/16;
            --wp--preset--color--black: #000000;
            --wp--preset--color--cyan-bluish-gray: #abb8c3;
            --wp--preset--color--white: #ffffff;
            --wp--preset--color--pale-pink: #f78da7;
            --wp--preset--color--vivid-red: #cf2e2e;
            --wp--preset--color--luminous-vivid-orange: #ff6900;
            --wp--preset--color--luminous-vivid-amber: #fcb900;
            --wp--preset--color--light-green-cyan: #7bdcb5;
            --wp--preset--color--vivid-green-cyan: #00d084;
            --wp--preset--color--pale-cyan-blue: #8ed1fc;
            --wp--preset--color--vivid-cyan-blue: #0693e3;
            --wp--preset--color--vivid-purple: #9b51e0;
            --wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg, rgba(6, 147, 227, 1) 0%, rgb(155, 81, 224) 100%);
            --wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 100%);
            --wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg, rgba(252, 185, 0, 1) 0%, rgba(255, 105, 0, 1) 100%);
            --wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg, rgba(255, 105, 0, 1) 0%, rgb(207, 46, 46) 100%);
            --wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg, rgb(238, 238, 238) 0%, rgb(169, 184, 195) 100%);
            --wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
            --wp--preset--gradient--blush-light-purple: linear-gradient(135deg, rgb(255, 206, 236) 0%, rgb(152, 150, 240) 100%);
            --wp--preset--gradient--blush-bordeaux: linear-gradient(135deg, rgb(254, 205, 165) 0%, rgb(254, 45, 45) 50%, rgb(107, 0, 62) 100%);
            --wp--preset--gradient--luminous-dusk: linear-gradient(135deg, rgb(255, 203, 112) 0%, rgb(199, 81, 192) 50%, rgb(65, 88, 208) 100%);
            --wp--preset--gradient--pale-ocean: linear-gradient(135deg, rgb(255, 245, 203) 0%, rgb(182, 227, 212) 50%, rgb(51, 167, 181) 100%);
            --wp--preset--gradient--electric-grass: linear-gradient(135deg, rgb(202, 248, 128) 0%, rgb(113, 206, 126) 100%);
            --wp--preset--gradient--midnight: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
            --wp--preset--font-size--small: 13px;
            --wp--preset--font-size--medium: 20px;
            --wp--preset--font-size--large: 36px;
            --wp--preset--font-size--x-large: 42px;
            --wp--preset--spacing--20: 0.44rem;
            --wp--preset--spacing--30: 0.67rem;
            --wp--preset--spacing--40: 1rem;
            --wp--preset--spacing--50: 1.5rem;
            --wp--preset--spacing--60: 2.25rem;
            --wp--preset--spacing--70: 3.38rem;
            --wp--preset--spacing--80: 5.06rem;
            --wp--preset--shadow--natural: 6px 6px 9px rgba(0, 0, 0, 0.2);
            --wp--preset--shadow--deep: 12px 12px 50px rgba(0, 0, 0, 0.4);
            --wp--preset--shadow--sharp: 6px 6px 0px rgba(0, 0, 0, 0.2);
            --wp--preset--shadow--outlined: 6px 6px 0px -3px rgba(255, 255, 255, 1), 6px 6px rgba(0, 0, 0, 1);
            --wp--preset--shadow--crisp: 6px 6px 0px rgba(0, 0, 0, 1);
        }

        :where(.is-layout-flex) {
            gap: 0.5em;
        }

        :where(.is-layout-grid) {
            gap: 0.5em;
        }

        body .is-layout-flex {
            display: flex;
        }

        .is-layout-flex {
            flex-wrap: wrap;
            align-items: center;
        }

        .is-layout-flex> :is(*, div) {
            margin: 0;
        }

        body .is-layout-grid {
            display: grid;
        }

        .is-layout-grid> :is(*, div) {
            margin: 0;
        }

        :where(.wp-block-columns.is-layout-flex) {
            gap: 2em;
        }

        :where(.wp-block-columns.is-layout-grid) {
            gap: 2em;
        }

        :where(.wp-block-post-template.is-layout-flex) {
            gap: 1.25em;
        }

        :where(.wp-block-post-template.is-layout-grid) {
            gap: 1.25em;
        }

        .has-black-color {
            color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-color {
            color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-color {
            color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-color {
            color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-color {
            color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-color {
            color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-color {
            color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-color {
            color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-color {
            color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-color {
            color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-color {
            color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-color {
            color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-background-color {
            background-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-background-color {
            background-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-background-color {
            background-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-background-color {
            background-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-background-color {
            background-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-background-color {
            background-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-background-color {
            background-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-background-color {
            background-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-background-color {
            background-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-background-color {
            background-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-border-color {
            border-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-border-color {
            border-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-border-color {
            border-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-border-color {
            border-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-border-color {
            border-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-border-color {
            border-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-border-color {
            border-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-border-color {
            border-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-border-color {
            border-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-border-color {
            border-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-vivid-cyan-blue-to-vivid-purple-gradient-background {
            background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;
        }

        .has-light-green-cyan-to-vivid-green-cyan-gradient-background {
            background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;
        }

        .has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-orange-to-vivid-red-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;
        }

        .has-very-light-gray-to-cyan-bluish-gray-gradient-background {
            background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;
        }

        .has-cool-to-warm-spectrum-gradient-background {
            background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;
        }

        .has-blush-light-purple-gradient-background {
            background: var(--wp--preset--gradient--blush-light-purple) !important;
        }

        .has-blush-bordeaux-gradient-background {
            background: var(--wp--preset--gradient--blush-bordeaux) !important;
        }

        .has-luminous-dusk-gradient-background {
            background: var(--wp--preset--gradient--luminous-dusk) !important;
        }

        .has-pale-ocean-gradient-background {
            background: var(--wp--preset--gradient--pale-ocean) !important;
        }

        .has-electric-grass-gradient-background {
            background: var(--wp--preset--gradient--electric-grass) !important;
        }

        .has-midnight-gradient-background {
            background: var(--wp--preset--gradient--midnight) !important;
        }

        .has-small-font-size {
            font-size: var(--wp--preset--font-size--small) !important;
        }

        .has-medium-font-size {
            font-size: var(--wp--preset--font-size--medium) !important;
        }

        .has-large-font-size {
            font-size: var(--wp--preset--font-size--large) !important;
        }

        .has-x-large-font-size {
            font-size: var(--wp--preset--font-size--x-large) !important;
        }

        :where(.wp-block-post-template.is-layout-flex) {
            gap: 1.25em;
        }

        :where(.wp-block-post-template.is-layout-grid) {
            gap: 1.25em;
        }

        :where(.wp-block-columns.is-layout-flex) {
            gap: 2em;
        }

        :where(.wp-block-columns.is-layout-grid) {
            gap: 2em;
        }

        :root :where(.wp-block-pullquote) {
            font-size: 1.5em;
            line-height: 1.6;
        }
    </style>

    <script>
        var js_town = 'Москва';
        var js_domain = 'https://mastervdom.site/';

    </script>
    <style>
        .mytimer input[type=submit] {
            background-color: #00A4B7 !important;
            border: 0px !important;
            font-weight: bold;
            color: #fff !important;
        }

        .mytimer input[type=submit]:hover {
            background-color: #00D1E9 !important;
        }

        .mytimer input[type=submit]:focus {
            background-color: #00A4B7 !important;
        }

        .vizvat-mastera input[type=submit] {
            background-color: #00A4B7 !important;
            border: 0px !important;
            font-weight: bold;
            color: #fff !important;
            width: 100% !important;
            height: 50px;
            margin-top: 5px;
            border-radius: 5px;
            font-size: 16px;
        }

        .vizvat-mastera input[type="checkbox"]:checked+.wpcf7-list-item-label:before {
            background: #00a4b7 url('libs/res/chk.png') center center no-repeat;
            border: 2px solid #00a4b7 !important;
        }

        .mytimer input[type="checkbox"]:checked+.wpcf7-list-item-label:before {
            display: none;
        }

        .mytimer input[type="checkbox"]+.wpcf7-list-item-label:before {
            display: none;
        }

        .mytimer .wpcf7-list-item-label {
            text-align: left;
            display: inline;
            padding-left: 0px !important;
            padding-bottom: 0px !important;
            height: auto !important;
            padding-top: 0px !important;
            margin-top: 0px !important;
            top: 0px !important;
        }

        .mytimer input[type="checkbox"] {
            width: 16px;
            height: 16px;
            display: inline;
            margin-right: 5px !important;
            position: relative !important;
            vertical-align: middle !important;

        }

        .mytimer input[type="checkbox"]:checked {
            background-color: #000;
        }

        .mytimer input[type="checkbox"]:checked:hover {
            background-color: #30A5B7;
        }

        .mytimer .wpcf7-list-item {
            margin-left: 0px !important;
        }

        .mytimer .wpcf7-form-control-wrap {
            padding-left: 0px !important;
            text-align: left !important;
            white-space: nowrap;
        }


        @media only screen and (max-width: 900px) {
            .mytimer .wpcf7-form-control-wrap {
                white-space: wrap;
                display: block;
                margin-top: 10px !important;
            }
        }



        .mytimer .wpcf7-list-item-label {
        @media only screen and (max-width: 850px) {
            white-space: wrap;
            margin-top: 10px !important;
        }

        .mytimer input[type="checkbox"] {
            margin-top: 10px !important;
        }
        }

        .vizvat-mastera input[type="checkbox"]+.wpcf7-list-item-label {
            text-align: left !important;
            left: -8px !important;
        }

        @media only screen and (max-width: 768px) {
            .vizvat-mastera input[type="checkbox"]+.wpcf7-list-item-label {
                margin-top: 20px;
                color: black;
            }

            .vizvat-mastera input[type="checkbox"]+.wpcf7-list-item-label a {
                color: black !important;
            }
        }

        @media only screen and (max-width: 768px) {
            .mytimer input[type="checkbox"]+.wpcf7-list-item-label {
                margin-top: 20px;
                color: black;
            }

            .mytimer input[type="checkbox"]+.wpcf7-list-item-label a {
                color: black !important;
            }
        }

        .wpcf7-acceptance {
            min-width: 250px !important;
        }

        @media only screen and (max-width: 1200px) {
            .wpcf7-acceptance {
                margin-top: 10px !important;
            }
        }



        .wpcf7-spinner {
            display: none;
        }

        .blue {
            margin-bottom: 50px !important;
        }

        @media only screen and (max-width: 800px) {
            .big-table {
                overflow: auto;
                position: relative;
            }

            .big-table table {
                display: inline-block;
                vertical-align: top;
                max-width: 100%;
                overflow-x: auto;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
                text-align: left !impportant;
            }
        }

        .big-table ul li {
            text-align: left !important;
        }

        .soglasen {
            font-size: 10px;
            color: #000;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .soglasen a {
            color: #000;
        }

        @media only screen and (max-width: 900px) {
            .soglasen {
                color: #000;
            }

            .soglasen a {
                color: #000;
            }
        }

        /*2023-09-20 BORIS*/
        .newhead-mob {
            width: 100%;
            height: 80px;
            position: fixed;
            top: 0px;
            left: 0px;
            z-index: 99;
        }

        .header-top-menu-left ul li a {
            font-size: 12px;
        }

        .howblock>.wrap>.cols {
            margin-top: 15px;
        }

        .reviewblock .articles .article p {
            overflow: hidden;
            height: 204px;
        }

        .zastavka-right-top {
            z-index: 1;
            position: relative;
        }

        @media (max-width: 767px) {
            body {
                padding-top: 20px;
            }

            .header_servicebtn {
                position: absolute;
                width: 100%;
                top: 80px;
                left: 0px;
                text-align: center;
            }

            .zastavka {
                padding-top: 120px;
            }

        }

        @media (max-width: 1170px) {
            .masters-block {
                margin-bottom: 60px;
            }

        }

        @media (max-width: 1170px) and (min-width: 700px) {

            .ourservicesblock ul {
                display: flex;
                justify-content: stretch;
                flex-wrap: wrap;
                gap: 1.1em;
            }

            .ourservicesblock ul li {
                margin-bottom: 0px;
            }

            .ourservicesblock ul li a {
                font-size: 13px;
                line-height: 14px;
                display: flex;
                align-items: center;
            }
        }

        @media (max-width:1170px) {
            .whyusblock {
                height: initial !important;
                margin-bottom: 0px !important;
                padding-bottom: 0px !important
            }

            .whyusblock>.wrap {
                width: calc(100% + 20px) !important;
                padding-left: 0px;
                padding-right: 0px;
                margin-left: -10px;
                margin-right: -10px;
            }

            .whyusblock .cols {
                height: initial !important;
                padding-bottom: 0px;
            }

            .whyusblock .cols>div {
                float: none !important;
            }

            .whyusblock .cols>.col8 {
                padding: 30px;
                margin: auto;
                max-width: 560px;
            }

            .whyusblock .cols>.col8 .btn {
                width: 120px;
                max-width: initial;
                margin: auto;
                display: block;
            }

            #whyusholder {
                display: block !important;
                width: 100%;
                float: none;
                background: #00adc1;
            }

            #whyusholder>div {
                padding: 0px 30px 40px !important;
            }

            #whyusholder form {
                max-width: 280px;
                margin: auto;
            }

        }
    </style>
</head>
<body data-rsssl=1 post-id="2">
<?php $this->beginBody() ?>

<?=\app\widgets\Header::widget()?>

<?=$content?>

<?=\app\widgets\Footer::widget()?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>document.addEventListener("copy", (event) => { var pagelink = "\nИсточник: https://masterabyta.ru"; event.clipboardData.setData("text", document.getSelection() + pagelink); event.preventDefault(); });</script>
<script type="text/javascript" id="wp-i18n-js-after">
    /* <![CDATA[ */
    wp.i18n.setLocaleData({ 'text direction\u0004ltr': ['ltr'] });
    /* ]]> */
</script>
<script type="text/javascript" id="contact-form-7-js-before">
    /* <![CDATA[ */
    var wpcf7 = {
        "api": {
            "root": "https:\/\/masterabyta.ru\/wp-json\/",
            "namespace": "contact-form-7\/v1"
        }
    };
    /* ]]> */
</script>
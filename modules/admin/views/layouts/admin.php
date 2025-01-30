<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Setting;
use app\helpers\CustomHelper;

/**
 * Активный пункт меню (boolean)
 * $var - название контроллера (string)
 */
function AdminActiveMenuPoint($var){
    $controllerName = Yii::$app->controller->id;
    if($controllerName === $var){
        return true;
    }
    return false;
}

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Админ панель | <?= Html::encode($this->title) ?></title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <?php $this->head() ?>    
    <?php
        $v = time();
        $this->registerCssFile("@web/css/admin/admin.css?{$v}", [
            'depends' => 'app\assets\AppAsset',
        ]);
        $this->registerJsFile("@web/js/admin/admin.js?{$v}", [
            'depends' => 'app\assets\AppAsset',
        ]);
    ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<span>'. Setting::getSetting('name') .'</span>',
        'brandUrl' => Url::to(['/admin/default']),
        'options' => [
            'class' => 'navbar-inverse',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            [
                'label' => 'Структура',
                'visible' => CustomHelper::custom_user_can(['contentView', 'pageView', 'cityView', 'pricesectionView', 'priceView', 'pricetableView', 'pricetablehtmlView', 'masterView', 'reviewView', 'bannerView', 'searchindexView']),
                'items' => [
                    ['label' => 'Контент', 'url' => ['/admin/content'], 'active' => AdminActiveMenuPoint('content'), 'visible' => Yii::$app->user->can('contentView')],
                    ['label' => 'Страницы', 'url' => ['/admin/page'], 'active' => AdminActiveMenuPoint('page'), 'visible' => Yii::$app->user->can('pageView')],
                    ['label' => 'Города', 'url' => ['/admin/city'], 'active' => AdminActiveMenuPoint('city'), 'visible' => Yii::$app->user->can('cityView')],
                    ['label' => 'Разделы прайса', 'url' => ['/admin/price-section'], 'active' => AdminActiveMenuPoint('price-section'), 'visible' => Yii::$app->user->can('pricesectionView')],
                    ['label' => 'Прайс', 'url' => ['/admin/price'], 'active' => AdminActiveMenuPoint('price'), 'visible' => Yii::$app->user->can('priceView')],
                    ['label' => 'Таблицы цен', 'url' => ['/admin/pricetable'], 'active' => AdminActiveMenuPoint('pricetable'), 'visible' => Yii::$app->user->can('pricetableView')],
                    ['label' => 'Таблицы цен HTML', 'url' => ['/admin/pricetablehtml'], 'active' => AdminActiveMenuPoint('pricetablehtml'), 'visible' => Yii::$app->user->can('pricetablehtmlView')],
                    ['label' => 'Мастера', 'url' => ['/admin/master'], 'active' => AdminActiveMenuPoint('master'), 'visible' => Yii::$app->user->can('masterView')],
                    ['label' => 'Отзывы', 'url' => ['/admin/review'], 'active' => AdminActiveMenuPoint('review'), 'visible' => Yii::$app->user->can('reviewView')],
                    ['label' => 'Баннеры', 'url' => ['/admin/banner'], 'active' => AdminActiveMenuPoint('banner'), 'visible' => Yii::$app->user->can('bannerView')],
                    ['label' => 'Поиск', 'url' => ['/admin/searchindex'], 'active' => AdminActiveMenuPoint('searchindex'), 'visible' => Yii::$app->user->can('searchindexView')],
                ],
            ],

            [
                'label' => 'Настройки',
                'visible' => CustomHelper::custom_user_can(['partnerView', 'partnercontactView', 'blocktechnicalView', 'redirectView', 'menuView', 'tagView', 'settingView']),
                'items' => [
                    ['label' => 'Партнеры', 'url' => ['/admin/partner'], 'active' => AdminActiveMenuPoint('partner'), 'visible' => Yii::$app->user->can('partnerView')],
                    ['label' => 'Контакты партнеров', 'url' => ['/admin/partnercontact'], 'active' => AdminActiveMenuPoint('partnercontact'), 'visible' => Yii::$app->user->can('partnercontactView')],
                    ['label' => 'Технические блоки', 'url' => ['/admin/blocktechnical'], 'active' => AdminActiveMenuPoint('blocktechnical'), 'visible' => Yii::$app->user->can('blocktechnicalView')],
                    ['label' => 'Переадресации', 'url' => ['/admin/redirect'], 'active' => AdminActiveMenuPoint('redirect'), 'visible' => Yii::$app->user->can('redirectView')],
                    ['label' => 'Меню', 'url' => ['/admin/menu'], 'active' => AdminActiveMenuPoint('menu'), 'visible' => Yii::$app->user->can('menuView')],
                    ['label' => 'Теги', 'url' => ['/admin/tag'], 'active' => AdminActiveMenuPoint('tag'), 'visible' => Yii::$app->user->can('tagView')],
                    ['label' => 'Настройки сайта', 'url' => ['/admin/setting'], 'active' => AdminActiveMenuPoint('setting'), 'visible' => Yii::$app->user->can('settingView')],
                ],
            ],

            ['label' => 'Пользователи', 'url' => ['/admin/user'], 'active' => AdminActiveMenuPoint('user'), 'visible' => Yii::$app->user->can('userView')],
            ['label' => 'Заявки', 'url' => ['/admin/request'], 'active' => AdminActiveMenuPoint('request'), 'visible' => Yii::$app->user->can('requestView')],
            
            
            
            
            Yii::$app->user->isGuest ? (
                // ['label' => 'Вход', 'url' => ['/site/login']]
                ['label' => 'Вход', 'url' => ['/site/c9e2b723478d81d18']]
            ) : (
                [
                    'label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> <span class="username">' . Yii::$app->user->identity->email. '</span>',
                    'items' => [
                        ['label' => 'Профиль', 'url' => ['/admin/user/view', 'id' => Yii::$app->user->identity->id], 'visible' => (Yii::$app->user->can('userView') && Yii::$app->user->identity->role !== 10)],
                        ['label' => 'Сайт', 'url' => ['/']],
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Выход',
                            ['class' => 'btn btn-link logout']
                            )
                        . Html::endForm()
                        . '</li>',
                    ],
                ]
            )
            
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => [
                'label' => 'Админ панель',
                'url' => ['/admin/default'],
            ]
        ]) ?>
        <?php if(Yii::$app->response->statusCode == 200): ?>
            <?php if( isset(Yii::$app->params['warning']) ){
                echo '<div class="alert alert-warning" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' .Yii::$app->params['warning']. '</div>';
            } ?>
            <?php if( Yii::$app->session->hasFlash('success') ){
                echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' .Yii::$app->session->getFlash('success'). '</div>';
            }elseif( Yii::$app->session->hasFlash('error') ){
                echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' .Yii::$app->session->getFlash('error'). '</div>';
            } ?>
        <?php endif; ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; 
            <?php if(Setting::getSetting('name')): ?>
                <a href="<?= Yii::$app->homeUrl ?>"><?= Setting::getSetting('name') ?></a> 
            <?php endif; ?>
            <?= date('Y') ?>
        </p>
        
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php 

use yii\helpers\Url;
use app\helpers\CustomHelper;
use app\helpers\VariableHelper;
use app\models\Setting;
use app\models\Menu;


?>

<div class="hero">
    <video class="video" autoplay muted loop>
        <source src="/img/bg-video.mp4" type="video/mp4">
        <source src="/img/bg-video.webm" type="video/webm">
    </video>
    <div class="overlay"></div>
    <div class="intro">
        <div class="horizontal-center">
            <div class="vertical-center">
                <h1 class="hero-header">Сервис бытовых услуг в <?= VariableHelper::getParamValue('gorode') ?></h1>
                <p class="hero-text">Услуги муж на час <span class="brand">от 200 рублей!</span><br>Ремонт бытовой техники
                    <span class="brand">от 500 рублей!</span></p>
                <a href="#main-form-stop" class="button hero-button scroll-link" data-up="50">Оставить заявку</a>
            </div>
        </div>
    </div>
</div>
<div class="container" id="products-stop">
    <div class="row top-adv-wrapper-front">
        <div class="top-adv-item advantage-1">
			<p>Любой мелкий ремонт и другие задачи по дому</p>
		</div>
        <div class="top-adv-item advantage-2">
			<p>Приедем в течение часа или в удобное время</p>
		</div>
		<div class="top-adv-item advantage-3">
			<p>Выезд мастера бесплатно<br />Работаем круглосуточно!</p>
		</div>
		<div class="top-adv-item advantage-4">
			<p>Низкие цены на услуги<br />Гарантия до 1 года</p>
		</div>
    </div>
    <div class="row">
        <p class="block-header">Мы оказываем <span class="brand">широкий</span> спектр услуг:</p>
    </div>


    <?php if (!empty($page['sidebar_visible']) && !empty($page['sidebar_menu'])): ?>
        <?php 
            $sidebar_menu = preg_replace('/[^\d\,]/', '', $page['sidebar_menu']);
            $sidebar_menu_id = explode(',', $sidebar_menu);
        ?>
        <?php if (!empty($sidebar_menu_id)): ?>
            <?php $sidebar_menu = \app\models\Menu::find()->where(['id' => $sidebar_menu_id])->andWhere(['visible' => 1])->asArray()->all(); ?>
            <?php if (!empty($sidebar_menu)): ?>
                <?php $sidebar_menu = CustomHelper::CustomMultiParamArray($sidebar_menu, 'id'); ?>
                <div class="b-products-list__row">
                <?php foreach ($sidebar_menu_id as $one): ?>
                    <?php if (!empty($one) && !empty($sidebar_menu[$one])): ?>
                        <?php
                            $menu_one = $sidebar_menu[$one];
                            $menu_header = \app\models\Menu::controlMenuArray($menu_one['header']);
                            $menu_items = \app\models\Menu::controlMenuArray($menu_one['menu']);
                            $menu_items = \app\models\Menu::formatMenuHtml($menu_items, 'products-list', 8);
                        ?>
                        <?php if (!empty($menu_header[0])): ?>
                            <div class="b-products-list__col">
                                <a class="products-list-header" href="<?= $menu_header[0]['link'] ?>">
                                    <?php if (!empty($menu_one['image'])): ?>
                                        <span class="products-list-header__image-wrap"><img src="<?= $menu_one['image'] ?>" alt=""></span>
                                    <?php endif; ?>
                                    <?= $menu_header[0]['name'] ?>
                                </a>
                                <?= $menu_items ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>


</div>


<div class="container">
    <div class="row">
        <div class="row intro-text">
            <div><?= CustomHelper::custom_br($page['content']) ?></div>
        </div>
    </div>
</div>

<div class="border"></div>

<div class="main-form-wrapper">
    <div class="container" id="main-form-stop">
        <p class="main-form-header block-header u-center">Есть вопросы? Оставьте заявку на <span class="brand">бесплатную</span>
            консультацию!</p>
        <div class="row">
            <form action="<?= Url::to(['/site/send']) ?>" method="post" class="leadback-popup__form form-validator custom-send-form">
                <div class="row">
                    <div class="six columns">
                        <div class="form-group width-full">
                            <label for="main-form-name">Ваше имя</label>
                            <input class="form-control width-full" type="text" id="main-form-name" name="name" placeholder="Как к Вам обращаться">
                        </div>
                    </div>
                    <div class="six columns">
                        <div class="form-group width-full">
                            <label for="main-form-phone">Контактный телефон</label>
                            <input class="form-control width-full" type="tel" id="main-form-phone" name="phone" inputmode="tel" data-inputmask="'mask': '+7 (999) 999-99-99'" required placeholder="Ваш номер">
                        </div>
                    </div>
                </div>
                <label for="main-form-question">Что Вас интересует?</label>
                <textarea class="form-control width-full" id="main-form-question" name="question" placeholder="Перечислите желаемые услуги или оставьте это поле пустым" style="margin-bottom: 35px;"></textarea>

                <?php if ($agreement = Setting::getSetting('checkbox-text-agreement')): ?>
                    <div class="personal-data" style="text-align: start;"><?= CustomHelper::custom_br(str_replace('[button]', 'Отправить заявку', $agreement)) ?></div>
                <?php endif; ?>

                <button class="leadback__form-btn leadback__form-submit" type="submit">Отправить заявку</button>
            </form>
        </div>
    </div>
</div>

<div class="border"></div>

<div class="container">
    <p class="block-header">Мы работаем <span class="brand">во всех</span> районах <?= VariableHelper::getParamValue('goroda') ?>!</p>
    <div class="row">
        <div class="tags">
            <?php if (!empty(Yii::$app->params['city']['district']) && is_array(Yii::$app->params['city']['district'])): ?>
                <?php $ra = Yii::$app->params['city']['district']; ?>
                <?php for ($i=0; $i < count($ra); $i++): ?>
                    <span><?php echo $ra[$i]; ?></span>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="adv-wrapper">
    <div class="container">
        <p class="block-header mt30 mb30"><span class="brand">Наши</span> преимущества:</p>

        <?php require_once __DIR__.'/../layouts/include/benefits-2.php'; ?>

        <h2 class="mt30 mb30 text-center">Отзывы клиентов:</h2>                

        <?php $reviews = \app\models\Review::find()->where(['visible' => 1])->orderBy(['date' => SORT_DESC])->asArray()->limit(3)->all(); ?>

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
                <?php if (!empty($review['master'])): ?>
                    <div class="user-review-master">Мастер: <b><?= \app\models\Review::getMasterName($review['master']) ?></b></div>
                <?php endif; ?>
            </div>
        </div>

        <?php endforeach; ?>

        <a href="/reviews/" class="all-masters">Все отзывы</a>      
        <p>&nbsp;</p>       

    </div>
</div>

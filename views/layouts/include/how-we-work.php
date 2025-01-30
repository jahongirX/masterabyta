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


?>


<?php if (!empty(Yii::$app->params['page']['block_how_we_work_visible'])): ?>
<h2 class="mt30 mb30 text-center">Как проводятся работы?</h2>
<div class="how-faq-list">
    <div class="how-faq-list-item">
        <div class="how-faq-list-item-num">1</div>
        <div class="how-faq-list-item-content">
            <div class="how-faq-list-item-content-title">Вы делаете заказ</div>
            <?php $how_we_workPhone = Blocktechnical::getPhone(); ?>
            <div class="how-faq-list-item-content-text">Вы можете вызвать нашего мастера сантехника любым способом: позвонить оператору по номеру телефона <a href="tel:<?= CustomHelper::phone_link($how_we_workPhone) ?>"><?= $how_we_workPhone ?></a> или заполнить форму заявки онлайн на сайте, указав удобное для вас время.</div>
        </div>
    </div>
    <div class="how-faq-list-item">
        <div class="how-faq-list-item-num">2</div>
        <div class="how-faq-list-item-content">
            <div class="how-faq-list-item-content-title">Бесплатная диагностика</div>
            <div class="how-faq-list-item-content-text">Мастер бесплатно определит причину неисправности и подберет оптимальный способ ее устранения.</div>
        </div>
    </div>
    <div class="how-faq-list-item">
        <div class="how-faq-list-item-num">3</div>
        <div class="how-faq-list-item-content">
            <div class="how-faq-list-item-content-title">Оценка стоимости</div>
            <div class="how-faq-list-item-content-text">Сантехник рассчитает сумму, руководствуясь расценками на расходные материалы, а также ценами на отдельные виды услуг из прайс-листа.</div>
        </div>
    </div>
    <div class="how-faq-list-item">
        <div class="how-faq-list-item-num">4</div>
        <div class="how-faq-list-item-content">

            <?php if (!empty(Yii::$app->params['page']['block_how_we_work_4_title'])): ?>
                <div class="how-faq-list-item-content-title"><?= Yii::$app->params['page']['block_how_we_work_4_title'] ?></div>
            <?php else: ?>
                <div class="how-faq-list-item-content-title">Проведение сантехнических работ</div>
            <?php endif; ?>

            <?php if (!empty(Yii::$app->params['page']['block_how_we_work_4_text'])): ?>
                <div class="how-faq-list-item-content-text"><?= Yii::$app->params['page']['block_how_we_work_4_text'] ?></div>
            <?php else: ?>
                <div class="how-faq-list-item-content-text">Мастер оказывает сантехнические услуги. По завершению работ вам выдадут акт выполненных работ и гарантийный талон. Оплатить услуги вы можете любым удобным для вас способом: наличными мастеру, переводом на банковскую карту, по безналичному расчету.</div>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php endif; ?>
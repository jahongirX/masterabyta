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

<?php if (!empty(Yii::$app->params['page']['block_leadback_price_visible'])): ?>
    <form action="<?= Url::to(['/site/send']) ?>" method="post" class="leadback-popup__form form-validator custom-send-form" style="margin-bottom: 45px;">
        <p class="main-form-header h3 u-center">Уточните цену у наших <span class="brand">специалистов</span>! Оставьте заявку на <span class="brand">бесплатную</span> консультацию!</p>
        <div class="row">
            <div class="six columns">
                <div class="form-group width-full">
                    <label for="leadback-price-form-name">Ваше имя</label>
                    <input class="form-control width-full" type="text" id="leadback-price-form-name" name="name" placeholder="Как к вам обращаться">
                </div>
            </div>
            <div class="six columns">
                <div class="form-group width-full">
                    <label for="leadback-price-form-phone">Контактный телефон</label>
                    <input class="form-control width-full" type="tel" id="leadback-price-form-phone" name="phone" inputmode="tel" data-inputmask="'mask': '+7 (999) 999-99-99'" required placeholder="Ваш номер">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="leadback-price-form-question">Что Вас интересует?</label>
            <textarea class="form-control width-full" id="leadback-price-form-question" name="question" placeholder="Перечислите желаемые услуги или оставьте это поле пустым"></textarea>
        </div>

        <?php if ($agreement = Setting::getSetting('checkbox-text-agreement')): ?>
            <div class="personal-data" style="text-align: start;"><?= CustomHelper::custom_br(str_replace('[button]', 'Отправить заявку', $agreement)) ?></div>
        <?php endif; ?>
        
        <button class="leadback__form-btn leadback__form-submit" type="submit">Отправить заявку</button>
    </form>
<?php endif; ?>
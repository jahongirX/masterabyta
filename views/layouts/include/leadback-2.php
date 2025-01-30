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

<?php if (!empty(Yii::$app->params['page']['block_leadback_visible'])): ?>
  <div class="leadback-2">
    <div class="leadback-2__content">
      <div class="leadback-2__title">Оставьте заявку на бесплатную консультацию</div>
      <div class="leadback-2__subtitle">Мы обязательно поможем решить вашу проблему!</div>
      <form action="<?= Url::to(['/site/send']) ?>" method="post" class="leadback-popup__form form-validator custom-send-form">
        <div class="leadback-2__content-row">
          <div class="leadback-2__content-col">
              <div class="form-group width-full">
                  <input class="form-control width-full" type="text" id="leadback-form-name" name="name" placeholder="Ваше имя">
              </div>
              <div class="form-group width-full">
                  <input class="form-control width-full" type="tel" id="leadback-form-phone" name="phone" inputmode="tel" data-inputmask="'mask': '+7 (999) 999-99-99'" required placeholder="Ваш телефон">
              </div>
          </div>
          <div class="leadback-2__content-col">
            <div class="form-group">
              <textarea class="form-control width-full" id="leadback-form-question" name="question" placeholder="Комментарий"></textarea>
            </div>
          </div>
        </div>
        <div class="leadback-2__content-row">
          <div class="leadback-2__content-col">
            <?php if ($agreement = Setting::getSetting('checkbox-text-agreement')): ?>
              <div class="personal-data" style="text-align: start;"><?= CustomHelper::custom_br(str_replace('[button]', 'Отправить заявку', $agreement)) ?></div>
            <?php endif; ?>
          </div>
          <div class="leadback-2__content-col">
            <button class="leadback__form-btn leadback__form-submit" type="submit">Отправить заявку</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php endif; ?>
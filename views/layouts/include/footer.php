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


$footer = (!empty(Yii::$app->params['blocktechnical']) && !empty(Yii::$app->params['blocktechnical'][2])) ? Yii::$app->params['blocktechnical'][2] : null;

?>


<?php if (!empty($footer)): ?>
<footer class="container vcard">
  <div class="row">
    <div class="footer-wrapper">
      <div class="six columns">
        <?php if (!empty($footer['menu1'])): ?>
          <?php $footer_menu1 = Menu::getMenuHtml($footer['menu1'], 'footer-menu'); ?>
          <?php if (!empty($footer_menu1)): ?>
            <?= $footer_menu1 ?>
          <?php endif; ?>
        <?php endif; ?>
        <p class="copyright">© «<?= Setting::getSetting('name') ?>», 2016-<?= VariableHelper::getValue('god') ?>. Все права защищены.</p>
      </div>
      <div class="two columns invisible">
        <div class="stamp"></div>
      </div>

      <div class="four columns">
        <?php $footerPhone = Blocktechnical::getPhone(); ?>
        <?php if (!empty($footerPhone)): ?>
          <a class="footer-tel tel u-cf" href="tel:<?= CustomHelper::phone_link($footerPhone) ?>"><?= $footerPhone ?></a>
        <?php endif; ?>
        
        <div class="footer-address adr u-cf">
          <?php if (!empty(Yii::$app->params['city']['name'])): ?>
            г. <span class="locality"><?= Yii::$app->params['city']['name'] ?></span>
          <?php endif; ?>
          <?php if (!empty(Yii::$app->params['city']['address'])): ?>
            , <span class="street-address"><?= Yii::$app->params['city']['address'] ?></span>
          <?php endif; ?>
        </div>
        <?php if (!empty(Yii::$app->params['city']['front_email'])): ?>
          <div class="footer-email"><?= Yii::$app->params['city']['front_email'] ?></div>
        <?php endif; ?>

        <?php /* ?>
        <ul class="footer-social">
          <!--
          <li class="footer-social-item">
            <a href="https://vk.com/husbandforanhourinmoscow" target="_blank">
              <i class="fa fa-vk" aria-hidden="true"></i>
            </a>
          </li>
          <li class="footer-social-item">
            <a href="https://www.facebook.com/%D0%94%D0%BE%D0%BC%D0%B0%D1%88%D0%BD%D0%B8%D0%B5-%D0%BC%D0%B0%D1%81%D1%82%D0%B5%D1%80%D0%B0-320717598282354/" target="_blank">
              <i class="fa fa-facebook-official" aria-hidden="true"></i>
            </a>
          </li>
          <li class="footer-social-item">
            <a href="https://www.youtube.com/channel/UC05-aDo3-AkE3JAiuwqrO6w" target="_blank">
              <i class="fa fa-youtube-play" aria-hidden="true"></i>
            </a>
          </li>
          <li class="footer-social-item">
            <a href="https://ok.ru/group/58053872189490" target="_blank">
              <i class="fa fa-odnoklassniki-square" aria-hidden="true"></i>
            </a>
          </li>
          <li class="footer-social-item">
            <a href="https://twitter.com/dmasteraru" target="_blank">
              <i class="fa fa-twitter-square" aria-hidden="true"></i>
            </a>
          </li>
          <li class="footer-social-item">
            <a href="https://plus.google.com/u/0/b/112694900019417888574/+%D0%94%D0%BE%D0%BC%D0%B0%D1%88%D0%BD%D0%B8%D0%B5%D0%BC%D0%B0%D1%81%D1%82%D0%B5%D1%80%D0%B0%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0" target="_blank">
              <i class="fa fa-google-plus-square" aria-hidden="true"></i>
            </a>
          </li>
          <li class="footer-social-item">
            <a href="#" target="_blank">
              <i class="fa fa-sitemap" aria-hidden="true"></i>
            </a>
          </li>
          -->
        </ul>
        <?php */ ?>
      </div>
    </div>
    <div class="footer-brand">Информация на сайте не является публичной офертой. <a target="_blank" href="https://san-tehniki.com/polzovatelskoe-soglashenie/">Пользовательское соглашение</a>. Разработка и продвижение — <a target="_blank" href="https://etalon-web.ru" rel="nofollow">etalon-WEB</a>.
    </div>
  </div>
</footer>
<?php endif; ?>
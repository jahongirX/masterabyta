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

$navbar = (!empty(Yii::$app->params['blocktechnical']) && !empty(Yii::$app->params['blocktechnical'][1])) ? Yii::$app->params['blocktechnical'][1] : null;
if (!empty($navbar)) {
  $navbar['header'] = VariableHelper::variableSubstitution($navbar['header']);
  $navbar['subtitle'] = VariableHelper::variableSubstitution($navbar['subtitle']);
  $navbar['item'] = VariableHelper::variableSubstitution($navbar['item']);
  $navbar['button'] = VariableHelper::variableSubstitution($navbar['button']);
  $navbar['note'] = VariableHelper::variableSubstitution($navbar['note']);
  $navbar['form'] = VariableHelper::variableSubstitution($navbar['form']);
}

?>


<?php if ($navbar): ?>
<header>
    <div class="header-top">
        <div class="container">
            <div class="header-top-inner">
                <div class="header-top-left">
                    <div class="header-town">
                    <span>Ваш город:</span>
                    <a href="#" class="select-town" data-toggle="modal" data-target="#modal-towns"><em><?= Yii::$app->params['city']['name'] ?></em></a>
                    </div>
                </div>
                <div class="header-top-center">
                  <?php if (!empty($navbar['menu1'])): ?>
                    <?php $navbar_menu1 = Menu::getMenuHtml($navbar['menu1'], 'small-menu'); ?>
                    <?php if (!empty($navbar_menu1)): ?>
                      <?= $navbar_menu1 ?>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
                <div class="header-top-right">
                    <div class="order">
                        <div class="header-town header-town-2">
                          <span>Ваш город:</span>
                          <a href="#" class="select-town" data-toggle="modal" data-target="#modal-towns"><em><?= Yii::$app->params['city']['name'] ?></em></a>
                        </div>
                        <a class="order-link link-tel" href="#modal-call-back" role="button" data-toggle="modal">Заказать звонок</a>
                        <?php if (Page::isFrontPageTemplate()): ?>
                            <a class="order-link link-order" id="link-order" href="#main-form-stop">Оставить заявку</a>
                        <?php else: ?>
                            <a class="order-link link-order" id="link-order" href="#modal-call-back-2" role="button" data-toggle="modal">Оставить заявку</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="header-bottom">
            <div class="header-bottom-left">
              <?php if (!empty($navbar['image'])): ?>
                <a href="<?= Url::to(['/']) ?>">
                  <img class="main-logo" src="<?= $navbar['image'] ?>" alt="<?= Setting::getSetting('name') ?>">
                </a>
              <?php endif; ?>
              <?php if (!empty($navbar['subtitle'])): ?>
                <p class="main-slogan"><?= CustomHelper::custom_br($navbar['subtitle']); ?></p>
              <?php endif; ?>
            </div>
            <div class="header-bottom-right">

                
                <div class="main-tel-block u-cf">
                  <?php $headerPhone = Blocktechnical::getPhone(); ?>
                  <?php if (!empty($headerPhone)): ?>
                    <a class="main-tel main-tel-2" href="tel:<?= CustomHelper::phone_link($headerPhone) ?>"><?= $headerPhone ?></a>
                  <?php endif; ?>
                </div>

                <button id="main-menu-hamburger-sm" class="main-menu-hamburger u-cf">МЕНЮ <i class="fa fa-bars" aria-hidden="true"></i></button>
                <button id="main-menu-hamburger-md" class="main-menu-hamburger u-cf">МЕНЮ <i class="fa fa-bars" aria-hidden="true"></i></button>
                <div id="main-menu-wrapper">
                  <?php if (!empty($navbar['menu2'])): ?>
                    <?php $navbar_menu2 = Menu::getMenuHtml($navbar['menu2'], 'main-menu'); ?>
                    <?php if (!empty($navbar_menu2)): ?>
                      <?= $navbar_menu2 ?>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
            </div>
        </div>
        
    </div>


<!-- Modal -->
<div id="modal-towns" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="h4 modal-title">Выберите город</div>
      </div>
      <div class="modal-body">
        <div class="towns-search">
          <div class="towns-search-left"><i class="fa fa-search"></i></div>
          <div class="towns-search-right"><input type="text" name="towns-search" placeholder="Поиск..."></div>
        </div>
        <div class="towns-list">
          <?php
            $towns = City::getCitiesList();
            $city_default_id = Setting::getSetting('city-default');
            $page_permalink = (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['permalink'])) ? Yii::$app->params['page']['permalink'] : null;
            foreach($towns as $town) {
              if (!empty($town['id'])) {
                if ($town['id'] == $city_default_id) {
                  echo '<div class="town"><a href="'.UrlHelper::to(['page' => $page_permalink]).'">'.CustomHelper::custom_inline($town['name']).'</a></div>';
                } else {
                  echo '<div class="town"><a href="'.UrlHelper::to(['city' => $town['alias'], 'page' => $page_permalink]).'" data-town="'.CustomHelper::custom_inline($town['alias']).'">'.CustomHelper::custom_inline($town['name']).'</a></div>';
                }
              }
            }
          ?>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="modal-anketa" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="h4 modal-title">Ваша анкета отправлена. Специалист отдела кадров свяжется с Вами в ближайшее время.</div>
      </div>
      <div class="modal-body">
        <button class="anketa-modal-close">Ок</button>
      </div>
    </div>

  </div>
</div>

<?php /* ?>
<!-- botfaqtor.ru --> 
<script> (function ab(){ var request = new XMLHttpRequest(); request.open('GET', "https://scripts.botfaqtor.ru/one/53974", false); request.send(); if(request.status == 200) eval(request.responseText); })(); </script>
<?php */ ?>

</header>
<?php endif; ?>
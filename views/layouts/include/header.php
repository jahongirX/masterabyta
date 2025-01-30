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

<?php $searchValue = (isset(Yii::$app->params['s'])) ? (string) Yii::$app->params['s'] : ''; ?>

<?php if ($navbar): ?>
<header>
  <div class="header" id="header">

    <div class="header-fixed hidden" id="header-fixed">
      <div class="container">
        <div class="header__row"></div>
      </div>
    </div>
    
    <?php if (Page::isFrontPageTemplate()): ?>
      <div class="container">
    <?php else: ?>
      <div class="container header__container">
    <?php endif; ?>

        <div class="header__row" id="header-row">
          <div class="header__col-left">
            <div class="main-logo-wrap">
              <?php if (!empty($navbar['image'])): ?>
                <a href="<?= Url::to(['/']) ?>">
                  <img class="main-logo" src="<?= $navbar['image'] ?>" alt="<?= Setting::getSetting('name') ?>">
                </a>
              <?php endif; ?>
              <div class="main-logo-text-wrap">
                <?php if (!empty($navbar['header'])): ?>
                  <p class="main-header"><?= CustomHelper::custom_br($navbar['header']); ?></p>
                <?php endif; ?>
                <?php if (!empty($navbar['subtitle'])): ?>
                  <p class="main-slogan"><?= CustomHelper::custom_br($navbar['subtitle']); ?></p>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <?php /**/ ?>
          <form action="/search" class="header__search-form">
            <div class="form-group">
              <input type="text" name="s" value="<?= $searchValue ?>" class="form-control header__search" placeholder="Поиск">
            </div>
          </form>
          <?php /**/ ?>

          <div class="header__col-right">
            <div class="header__contacts">
              <div class="header__contacts-left">
                <?php $headerPhone = Blocktechnical::getPhone(); ?>
                  <?php if (!empty($headerPhone)): ?>
                  <div class="header__phone-wrap">
                    <a class="main-tel main-tel-2" href="tel:<?= CustomHelper::phone_link($headerPhone) ?>"><?= $headerPhone ?></a>
                    <?php if (!empty($navbar['item'])): ?>
                      <div class="header__online"><span><?= CustomHelper::custom_br($navbar['item']); ?></span></div>
                  <?php endif; ?>
                  </div>
                <?php endif; ?>
              </div>
              <div class="header__contacts-right">
                <?php if (!empty($navbar['button'])): ?>
                  <?php if (Page::isFrontPageTemplate()): ?>
                      <a class="header__contacts-btn scroll-link" data-up="50" href="#main-form-stop"><?= CustomHelper::custom_br($navbar['button']); ?></a>
                  <?php else: ?>
                      <a class="header__contacts-btn" href="#modal-call-back-2" role="button" data-toggle="modal"><?= CustomHelper::custom_br($navbar['button']); ?></a>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

        <div class="main-menu__box">
          <div class="main-menu__row">
            <div class="main-menu__col-left">
              <div class="header-town__row">
                <div class="header-town">
                  <span>Ваш город:</span>
                  <a href="#" class="select-town" data-toggle="modal" data-target="#modal-towns"><em><?= Yii::$app->params['city']['name'] ?></em></a>
                </div>

                <div class="main-menu-hamburger__wrap">
                  <button id="main-menu-hamburger-md" class="main-menu-hamburger u-cf"><i class="fa fa-bars" aria-hidden="true"></i> Меню</button>
                </div>
              </div>
            </div>
            <div class="main-menu__col-right">
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
        
    </div>
  </div>


<!-- Modal -->
<div id="modal-towns" class="modal modal-city fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="h4 modal-title">Выберите город</div>
      </div>
      <div class="modal-body">
        <div class="hidden">
          <?php if (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['id'])): ?>
            <input type="hidden" name="page" value="<?= Yii::$app->params['page']['id'] ?>">
          <?php endif; ?>
        </div>
        <div class="towns-search">
          <div class="towns-search-left"><i class="fa fa-search"></i></div>
          <div class="towns-search-right"><input type="text" name="towns-search" placeholder="Поиск..."></div>
        </div>
        <div class="towns-list" id="modal-city-list"><?php
          /*
          $towns = City::getCitiesList();
          $city_default_id = Setting::getSetting('city-default');
          $page_permalink = (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['permalink'])) ? Yii::$app->params['page']['permalink'] : null;
          foreach($towns as $town) {
            if (!empty($town['id'])) {
              if ($town['id'] == $city_default_id) {
                echo '<div class="town"><a href="'.UrlHelper::to(['city' => '/', 'page' => $page_permalink]).'">'.CustomHelper::custom_inline($town['name']).'</a></div>';
              } else {
                echo '<div class="town"><a href="'.UrlHelper::to(['city' => $town['alias'], 'page' => $page_permalink]).'" data-town="'.CustomHelper::custom_inline($town['alias']).'">'.CustomHelper::custom_inline($town['name']).'</a></div>';
              }
            }
          }
          /**/
        ?></div>
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
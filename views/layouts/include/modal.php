<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\helpers\CustomHelper;
use app\helpers\VariableHelper;
use app\models\Setting;

$modal = (!empty(Yii::$app->params['blocktechnical'])) ? Yii::$app->params['blocktechnical'] : null;

?>

<div id="modal-call-back" class="modal fade modal-operator" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="h1 modal-title">Заказать звонок</div>
      </div>
      <div class="modal-body">
        <p class="modal-body-text">Перезвоним в течение<br> 5 минут!</p>
        <form action="<?= Url::to(['/site/send']) ?>" method="post" class="leadback-popup__form form-validator custom-send-form">
          <div class="form-group">
            <input class="form-control" type="text" id="modal-call-back-name" name="name" placeholder="Ваше имя">
          </div>
          <div class="form-group">
            <input class="form-control" type="tel" id="modal-call-back-phone" name="phone" inputmode="tel" data-inputmask="'mask': '+7 (999) 999-99-99'" required placeholder="Ваш номер">
          </div>

          <?php if ($agreement = Setting::getSetting('checkbox-text-agreement')): ?>
            <div class="personal-data"><?= CustomHelper::custom_br(str_replace('[button]', 'Отправить заявку', $agreement)) ?></div>
          <?php endif; ?>

          <button class="leadback__form-btn modal-call-back-submit" type="submit">Отправить заявку</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php if (!empty($modal[4])): ?>
  <div id="modal-call-back-2" class="modal fade modal-operator" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <?php if (!empty($modal[4]['header'])): ?>
            <div class="h1 modal-title"><?= $modal[4]['header'] ?></div>
          <?php endif; ?>
        </div>
        <div class="modal-body">
          <?php if (!empty($modal[4]['subtitle'])): ?>
            <p class="modal-body-text"><?= $modal[4]['subtitle'] ?></p>
          <?php endif; ?>
          <form action="<?= Url::to(['/site/send']) ?>" method="post" class="leadback-popup__form form-validator custom-send-form">
            <div class="form-group">
              <input class="form-control" type="text" id="modal-call-back-2-name" name="name" placeholder="Ваше имя">
            </div>
            <div class="form-group">
              <input class="form-control" type="tel" id="modal-call-back-2-phone" name="phone" inputmode="tel" data-inputmask="'mask': '+7 (999) 999-99-99'" required placeholder="Ваш номер">
            </div>

            <?php if ($agreement = Setting::getSetting('checkbox-text-agreement')): ?>
              <div class="personal-data"><?= CustomHelper::custom_br(str_replace('[button]', 'Отправить заявку', $agreement)) ?></div>
            <?php endif; ?>

            <?php if (!empty($modal[4]['button'])): ?>
              <button class="leadback__form-btn modal-call-back-submit" type="submit"><?= $modal[4]['button'] ?></button>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<div id="modal-image" class="modal fade" role="dialog">
  <div class="modal-img-dialog">
    <a href="" data-dismiss="modal"><img class="staff-img-big" src="/img/mastera-big.png" alt="Наши мастера на карте"></a>
  </div>
</div>

<div id="modal-thx" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="h1 modal-title">Спасибо!</div>
      </div>
      <div class="modal-body">
        <p class="modal-body-text">Ваша заявка успешно отправлена. Наш специалист перезвонит Вам в течение 5
          минут. Есть свободные мастера для выезда!</p>
          <div class="p-t-md">
            <button type="button" class="modal-call-back-submit" data-dismiss="modal">Закрыть</button>
          </div>
      </div>
    </div>
  </div>
</div>
<div style="display: none;" class="modal-backdrop fade"></div>

<script>
  var js_town = "<?= Yii::$app->params['city']['name'] ?>";
  var js_domain = "https://<?= Yii::$app->params['domain'] ?>";
  var js_metrika = "<?= VariableHelper::getParamValue('metrika') ?>";
</script>




<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    fn_initRegionSelectorByUtmCode();
  });


  function fn_initRegionSelectorByUtmCode() {
    var url = new URL(window.location);
    var code = url.searchParams.get('utm_gorod') || '';
    if (code.length == 0) return;
    let btn = document.querySelector('.header-town a.select-town');
    if (btn) {
      btn.click();
    }
  }
</script>





<?php /* ?>
<script>
  <?php
  $dm = get_domain();
  if ($dm != "moscow") {
    $dm = "https://" . $dm . ".egdu.ru";
  } else {
    $dm = "https://egdu.ru";
  }
  ?>
  var js_town = "<?= Yii::$app->params['city']['name'] ?>";
  var js_domain = '<?php echo $dm; ?>';
  var js_metrika = '<?php echo get_town_param("metrika"); ?>';
</script>


<!-- Yandex.Metrika counter -->
<script type="text/javascript">
  (function(m, e, t, r, i, k, a) {
    m[i] = m[i] || function() {
      (m[i].a = m[i].a || []).push(arguments)
    };
    m[i].l = 1 * new Date();
    for (var j = 0; j < document.scripts.length; j++) {
      if (document.scripts[j].src === r) {
        return;
      }
    }
    k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
  })
  (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

  ym(93311892, "init", {
    clickmap: true,
    trackLinks: true,
    accurateTrackBounce: true,
    webvisor: true
  });
</script>
<noscript>
  <div><img src="https://mc.yandex.ru/watch/93311892" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>
<!-- /Yandex.Metrika counter -->

<script>
  document.addEventListener('wpcf7mailsent', function(event) {
    ym(93311892, 'reachGoal', 'LEADBACK_CALL');
  }, false);
</script>


<script>
  document.addEventListener("DOMContentLoaded", function(event) {
    fn_initRegionSelectorByUtmCode();
  });


  function fn_initRegionSelectorByUtmCode() {
    $('.wpcf7-form').find('br').remove(); // Убрать строчку, если плагин починится
    var url = new URL(window.location);
    fn_adjustModalTownsRedirect(url);
    var code = url.searchParams.get('utm_gorod') || '';
    if (code.length == 0) return;
    let btn = document.querySelector('.header-town a.select-town');
    if (btn) {
      btn.click();
    }
  }

  function fn_adjustModalTownsRedirect(url) {
    let modal = document.getElementById('modal-towns');
    let townLinks = modal.querySelectorAll('.town a');
    if (townLinks.length > 0) {
      townLinks.forEach(function(link) {
        link.addEventListener("click", (e) => fn_onModalTownLinkClick(e, url))
      });
    }
  }

  function fn_onModalTownLinkClick(e, url) {
    if (e) {
      e.preventDefault();
      e.stopPropagation();
    }
    let href = e.target.getAttribute('href');
    if (url.pathname && url.pathname.length > 1) href += url.pathname;
    location.href = href;
  }
</script>

<!-- МЕНЯЕМ ЛИДБЕКС-->
<!-- Begin LeadBack code {literal} -->
<script>
  var _emv = _emv || [];
  _emv['campaign'] = '<?php
                      $gtel = $_SERVER[HTTP_HOST];
                      $itel = wp_get_post_parent_id(get_the_ID()); // получаем id родительской страницы
                      switch ($gtel) {
                        case 'egdu.ru':
                          echo "ddcbd2b526b89452de47d5d8";
                          break;
                        default:
                          switch ($itel) {
                            case '9793':
                              echo "ddcbd2b526b89456dba115cc";
                              break;
                            case '9565':
                              echo "ddcbd2b526b89456dba115cc";
                              break;
                            default:
                              echo "ddcbd2b526b89404a03012c1";
                          }
                      } ?>';
  (function() {
    var em = document.createElement('script');
    em.type = 'text/javascript';
    em.async = true;
    em.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'leadback.ru/js/leadback.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(em, s);
  })();
</script>
<!-- End LeadBack code {/literal} -->



<script src="/sender/script.js"></script>
<?php */ ?>
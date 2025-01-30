<?php 

use yii\helpers\Url;
use app\helpers\CustomHelper;
use app\helpers\VariableHelper;
use app\helpers\UrlHelper;
use app\models\City;
use app\models\Menu;
use app\models\Page;
use app\models\Review;
use app\models\Blocktechnical;
use app\models\Setting;


?>

<script>
    function scrollToTop(){
        jQuery('html, body').animate({
            scrollTop: 0
        }, 500);
    }   
    function resizeIframe() {
      var obj = document.getElementById('anketa');
      obj.style.minHeight = obj.contentWindow.document.body.scrollHeight + 'px';
    }
    setInterval('resizeIframe()',500);
    function anketaThanks(){
        jQuery('html, body').animate({
            scrollTop: 0
        }, 100);
        jQuery("#modal-anketa").modal();
    }
    function showAferta(){
        jQuery(document).ready(function(){
            var oferta_text = jQuery("#hidden-oferta").html();
            jQuery("#anketa").contents().find("#oferta").html(oferta_text);
        })
    }
</script>


<?php require_once __DIR__.'/../layouts/include/banner.php'; ?>

<div class="container content">
    <div class="row">

        <?php if (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['sidebar_visible'])): ?>
          <div class="three-mod columns">
              <?php require_once __DIR__.'/../layouts/include/sidebar.php'; ?>
          </div>
          <div class="nine-mod columns">
        <?php else: ?>
          <div class="twelve columns">
        <?php endif; ?>

          <div style="display:none" id="hidden-oferta">
            <?php 
                $pageTitle = Page::getTitle();
                $pageContent = Page::getContent();
            ?>
            <?php if (!empty($pageContent)): ?>
                <div><?= $pageContent ?></div>
            <?php endif; ?>
          </div>

          <iframe id="anketa" src="/pages/anketa.php" scrolling="no" style="overflow: hidden; border:none; width:100%" onload="resizeIframe()"></iframe>

        </div>
    </div>
</div>

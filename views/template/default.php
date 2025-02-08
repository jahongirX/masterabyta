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


$this->params['breadcrumbs'][] = Page::getTitle();


?>

<?=\app\widgets\Zastavka::widget() ?>

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

        <?php require_once __DIR__.'/../layouts/include/breadcrumbs.php'; ?>

          <?php
            $pageTitle = Page::getTitle();
            $pageContent = Page::getContent();
          ?>

<!--          --><?php //if (empty(Yii::$app->params['banner_use_page_header'])): ?>
<!--              --><?php //if (!empty($pageTitle)): ?>
<!--                  <h1>--><?//= CustomHelper::custom_br($pageTitle) ?><!--</h1>-->
<!--              --><?php //endif; ?>
<!--          --><?php //else: ?>
<!--              <div style="margin-bottom: 10px;"></div>-->
<!--          --><?php //endif; ?>

<!--          --><?php //if (!empty($pageContent)): ?>
<!--            <div>--><?//= $pageContent ?><!--</div>-->
<!--          --><?php //endif; ?>

<!--          --><?php //require_once __DIR__.'/../layouts/include/leadback-2.php'; ?>

        </div>
    </div>
</div>
    <div class="breadcrumbs">
        <div class="wrap">
         <span><span><a href="<?=Url::home()?>">Главная</a></span> / <span class="breadcrumb_last"
                                                                        aria-current="page">Контакты</span></span>
        </div>
    </div>
    <div class="pagecontent">
        <div class="wrap">
            <h1 class="blocktitle">Контакты</h1>
            <div class="contnt">
                <div class="the-contacts">
                    <p><i class="fa fa-map-marker"></i><strong>Адрес:</strong> г. Москва, ул. Усиевича, д. 4</p>
                    <p><i class="fa fa-phone"></i><strong>Телефоны:</strong> <a href="tel://+7 (499) 390-53-90">+7 (499)
                            390-53-90</a> или <a href="tel://+7 (929) 605-63-54">+7 (929) 605-63-54</a></p>
                    <p><i class="fa fa-clock-o"></i><strong>Режим работы:</strong> с 9:00 до 21:00, без выходных.</p>
                    <p><i class="fa fa-envelope"></i><strong>E-mail:</strong> <a
                                href="mailto:info@masterabyta.ru">info@masterabyta.ru</a></p>
                </div>
                <p>
                    <script type="text/javascript" charset="utf-8" async
                            src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A581805a9caa779b370ed6c690ec9ae6dfb2eaaae2a6e5a31f36d95677b8e11de&amp;width=100%25&amp;height=519&amp;lang=ru_RU&amp;scroll=true"></script>
                </p>
            </div>
            <div class="consult">
                <div class="title">Оставьте заявку на БЕСПЛАТНУЮ консультацию. <br> Перезвоним в течение 5 минут!</div>

                <div class="wpcf7 no-js" id="wpcf7-f129-o2" lang="ru-RU" dir="ltr" data-wpcf7-id="129">
                    <div class="screen-reader-response">
                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                        <ul></ul>
                    </div>
                    <form action="https://masterabyta.ru/kontakty/#wpcf7-f129-o2" method="post" class="wpcf7-form init"
                          aria-label="Контактная форма" novalidate="novalidate" data-status="init">
                        <div style="display: none;">
                            <input type="hidden" name="_wpcf7" value="129" />
                            <input type="hidden" name="_wpcf7_version" value="6.0.3" />
                            <input type="hidden" name="_wpcf7_locale" value="ru_RU" />
                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f129-o2" />
                            <input type="hidden" name="_wpcf7_container_post" value="0" />
                            <input type="hidden" name="_wpcf7_posted_data_hash" value="" />
                            <input type="hidden" name="_wpcf7_recaptcha_response" value="" />
                        </div>
                        <span id="wpcf7-679b668de9d66-wrapper" class="wpcf7-form-control-wrap email-wrap"
                              style="display:none !important; visibility:hidden !important;"><label
                                    for="wpcf7-679b668de9d66-field" class="hp-message">Оставьте это поле пустым.</label><input
                                    id="wpcf7-679b668de9d66-field" class="wpcf7-form-control wpcf7-text" type="text" name="email"
                                    value="" size="40" tabindex="-1" autocomplete="new-password" /></span>
                        <input class="wpcf7-form-control wpcf7-hidden" value="" type="hidden" name="domain" />
                        <input class="wpcf7-form-control wpcf7-hidden" value="" type="hidden" name="post-id" />
                        <input class="wpcf7-form-control wpcf7-hidden" value="" type="hidden" name="town" />
                        <input class="wpcf7-form-control wpcf7-hidden" value="" type="hidden" name="utm_source" />
                        <input class="wpcf7-form-control wpcf7-hidden" value="" type="hidden" name="fpage" />
                        <div class="cols">
                            <div class="col6"><span class="wpcf7-form-control-wrap" data-name="iname"><input size="40"
                                                                                                             maxlength="400" class="wpcf7-form-control wpcf7-text" aria-invalid="false"
                                                                                                             placeholder="Ваше имя" value="" type="text" name="iname" /></span><span
                                        class="wpcf7-form-control-wrap" data-name="tel"><input size="40" maxlength="400"
                                                                                               class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel"
                                                                                               aria-required="true" aria-invalid="false" placeholder="Ваш телефон" value="" type="tel"
                                                                                               name="tel" /></span>
                                <p class="soglasen" style="color:#fff;">Нажимая на кнопку "Отправить", вы принимаете условия <a
                                            href="../soglasie/index.html" target="_blank" style="color:#fff;">Согласия</a> и <a
                                            href="../privacy-policy/index.html" target="_blank" style="color:#fff;">Политики
                                        конфиденциальности</a>.</p>
                            </div>
                            <div class="col6"><span class="wpcf7-form-control-wrap" data-name="subj"><textarea cols="40"
                                                                                                               rows="10" maxlength="2000" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"
                                                                                                               placeholder="Ваш вопрос" name="subj"></textarea></span><input
                                        class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="Отправить" /></div>
                        </div>
                        <div class="wpcf7-response-output" aria-hidden="true"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

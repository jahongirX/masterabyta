<?php 

use yii\helpers\Url;
use app\helpers\CustomHelper;
use app\helpers\VariableHelper;
use app\helpers\UrlHelper;
use app\models\City;
use app\models\Page;
use app\models\Banner;
use app\models\Blocktechnical;
use app\models\Setting;


if (!empty(Yii::$app->params['page']) && !empty(Yii::$app->params['page']['banner_id'])) {
    $banner = Banner::find()->where(['id' => Yii::$app->params['page']['banner_id']])->andWhere(['visible' => 1])->asArray()->limit(1)->one();
}

?>


<?php if (!empty($banner)): ?>
    <div class="header_servicebtn"><a href="#" class="servicesblock">Наши услуги</a></div>
    <div class="zastavka">
        <div class="wrap">
            <div class="zastavka-inner">
                <div class="zastavka-left">
                    <div class="zastavka-pic">
                        <?php if(!empty($banner['image'])): ?>
                        <img src="<?=$banner['image']?>">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="zastavka-right">
                    <div class="zastavka-right-top">
                        <div class="zastavka-title">
                            <h1><?=$page->name?></h1>
                        </div>
                        <div class="zastavka-subtitle">Работаем честно, аккуратно и без грязи! Стоимость услуг от 100 руб.
                        </div>
                    </div>
                    <div class="zastavka-right-bottom">
                        <div class="zastavka-right-bottom-left">
                            <div class="zastavka-items">
                                <div class="zastavka-item">
                                    <div class="zastavka-item-icon"><img src="/libs/img/zas1.png"></div>
                                    <div class="zastavka-item-text">Быстро! Бесплатный приезд<br> мастера от 30 минут!</div>
                                </div>
                                <div class="zastavka-item">
                                    <div class="zastavka-item-icon"><img src="/libs/img/zas2.png"></div>
                                    <div class="zastavka-item-text">Мастера заключают<br> договор и дают гарантию!</div>
                                </div>
                                <div class="zastavka-item">
                                    <div class="zastavka-item-icon"><img src="/libs/img/zas3.png"></div>
                                    <div class="zastavka-item-text">Оплата после выполнения<br> и приема работ.</div>
                                </div>
                                <div class="zastavka-item">
                                    <div class="zastavka-item-icon"><img src="/libs/img/zas4.png"></div>
                                    <div class="zastavka-item-text">Скидка до 15%<br> при заказе через сайт!</div>
                                </div>
                            </div>
                        </div>
                        <div class="zastavka-right-bottom-right">
                            <div class="zastavka-form">
                                <div class="zastavka-form-title">Оставьте заявку!</div>
                                <div class="zastavka-form-subtitle">Перезвоним в течение 5 минут!</div>


                                <div class="wpcf7 no-js" id="wpcf7-f127-o1" lang="ru-RU" dir="ltr" data-wpcf7-id="127">
                                    <div class="screen-reader-response">
                                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                                        <ul></ul>
                                    </div>
                                    <form action="https://masterabyta.ru/#wpcf7-f127-o1" method="post" class="wpcf7-form init"
                                          aria-label="Контактная форма" novalidate="novalidate" data-status="init">
                                        <div style="display: none;">
                                            <input type="hidden" name="_wpcf7" value="127" />
                                            <input type="hidden" name="_wpcf7_version" value="6.0.3" />
                                            <input type="hidden" name="_wpcf7_locale" value="ru_RU" />
                                            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f127-o1" />
                                            <input type="hidden" name="_wpcf7_container_post" value="0" />
                                            <input type="hidden" name="_wpcf7_posted_data_hash" value="" />
                                            <input type="hidden" name="_wpcf7_recaptcha_response" value="" />
                                        </div>
                                        <span id="wpcf7-679b667677446-wrapper" class="wpcf7-form-control-wrap email-wrap"
                                              style="display:none !important; visibility:hidden !important;"><label
                                                    for="wpcf7-679b667677446-field" class="hp-message">Оставьте это поле
                                    пустым.</label><input id="wpcf7-679b667677446-field"
                                                          class="wpcf7-form-control wpcf7-text" type="text" name="email" value="" size="40"
                                                          tabindex="-1" autocomplete="new-password" /></span><input
                                                class="wpcf7-form-control wpcf7-hidden" value="" type="hidden" name="domain" /><input
                                                class="wpcf7-form-control wpcf7-hidden" value="" type="hidden" name="town" /><input
                                                class="wpcf7-form-control wpcf7-hidden" value="" type="hidden" name="post-id" /><input
                                                class="wpcf7-form-control wpcf7-hidden" value="" type="hidden"
                                                name="utm_source" /><input class="wpcf7-form-control wpcf7-hidden" value=""
                                                                           type="hidden" name="fpage" />
                                        <div class="vizvat-mastera"><span class="wpcf7-form-control-wrap" data-name="tel"><input
                                                        size="40" maxlength="400"
                                                        class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel"
                                                        aria-required="true" aria-invalid="false" placeholder="Ваш телефон" value=""
                                                        type="tel" name="tel" /></span>
                                            <p class="soglasen">Нажимая на кнопку "Вызвать мастера", вы принимаете условия <a
                                                        href="soglasie/index.html" target="_blank">Согласия</a> и <a
                                                        href="privacy-policy/index.html" target="_blank">Политики конфиденциальности</a>.
                                            </p>
                                            <input class="wpcf7-form-control wpcf7-submit has-spinner btn btn-submit" type="submit"
                                                   value="Вызвать мастера" />
                                        </div>
                                        <div class="wpcf7-response-output" aria-hidden="true"></div>
                                    </form>
                                </div>
                                <div class="show-mob">
                                    <div class="zastavka-form-subtitle">Перезвоним в течение 5 минут!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="after-intro">
        <div class="wrap">
            <div class="after-intro-inner">
                <div class="after-intro-item">
                    <div class="after-intro-item-icon"><img src="/libs/img/intro-r.png"></div>
                    <div class="after-intro-item-text">
                        <b>16 лет</b>
                        <span>опыт работы</span>
                    </div>
                </div>
                <div class="after-intro-item">
                    <div class="after-intro-item-icon"><img src="/libs/img/intro-r.png"></div>
                    <div class="after-intro-item-text">
                        <b>более 200</b>
                        <span>опытных мастеров</span>
                    </div>
                </div>
                <div class="after-intro-item">
                    <div class="after-intro-item-icon"><img src="/libs/img/intro-r.png"></div>
                    <div class="after-intro-item-text">
                        <b>более 2000</b>
                        <span>заказов в месяц</span>
                    </div>
                </div>
                <div class="after-intro-item">
                    <div class="after-intro-item-icon"><img src="/libs/img/intro-r.png"></div>
                    <div class="after-intro-item-text">
                        <b>более 150 000</b>
                        <span>довольных клиентов</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container b-helmet b-helmet-2">

        <div class="b-helmet__content">
<!--            <div class="b-helmet__header">-->
<!--                --><?php //if (!empty($banner['use_page_header'])) {
//                    $banner['header'] = Page::getTitle();
//                    Yii::$app->params['banner_use_page_header'] = 1;
//                } ?>
<!--                --><?php //if (!empty($banner['header'])): ?>
<!--                    <h1 class="b-helmet__title">--><?//= CustomHelper::custom_br($banner['header']) ?><!--</h1>-->
<!--                --><?php //endif; ?>
<!--                --><?php //if (!empty($banner['subtitle'])): ?>
<!--                    <div class="b-helmet__subtitle">--><?//= CustomHelper::custom_br($banner['subtitle']) ?><!--</div>-->
<!--                --><?php //endif; ?>
<!--            </div>-->

<!--            <div class="b-helmet__advantages-wrap">-->
<!--                <div class="b-helmet__advantages">-->
<!--                    --><?php //for ($i=1; $i <= 4; $i++): ?>
<!--                        --><?php //if (!empty($banner["item{$i}"])): ?>
<!--                            <div class="b-helmet__advantages-item">-->
<!--                                --><?php //if (!empty($banner["ico{$i}"])): ?>
<!--                                    <div class="b-helmet__advantages-item-ico-wrap">-->
<!--                                        <img src="--><?//= $banner["ico{$i}"] ?><!--" alt="" class="b-helmet__advantages-item-ico">-->
<!--                                    </div>-->
<!--                                --><?php //endif; ?>
<!--                                <div class="b-helmet__advantages-item-text">--><?//= $banner["item{$i}"] ?><!--</div>-->
<!--                            </div>-->
<!--                        --><?php //endif; ?>
<!--                    --><?php //endfor; ?>
<!--                </div>-->
<!--            </div>-->

<!--            <div class="b-helmet__form-wrapper">-->
<!---->
<!--                --><?php //if (!empty($banner['form'])): ?>
<!--                    <div class="b-helmet__form-title">--><?//= CustomHelper::custom_br($banner['form']) ?><!--</div>-->
<!--                --><?php //endif; ?>
<!---->
<!--                --><?php //if (!empty($banner['note'])): ?>
<!--                    <div class="b-helmet__form-note">--><?//= CustomHelper::custom_br($banner['note']) ?><!--</div>-->
<!--                --><?php //endif; ?>
<!---->
<!--                <form action="--><?//= Url::to(['/site/send']) ?><!--" method="post" class="b-helmet__form form-validator custom-send-form">-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <input class="form-control" type="tel" name="phone" inputmode="tel" data-inputmask="'mask': '+7 (999) 999-99-99'" required placeholder="Контактный телефон"/>-->
<!--                    </div>-->
<!---->
<!--                    <button type="submit" class="b-helmet__form-btn">--><?//= CustomHelper::custom_br($banner['button']) ?><!--</button>-->
<!---->
<!--                </form>-->
<!---->
<!--                --><?php //if ($agreement = Setting::getSetting('checkbox-text-agreement')): ?>
<!--                    <div class="b-helmet__form-privacy">--><?//= CustomHelper::custom_br(str_replace('[button]', $banner['button'], $agreement)) ?><!--</div>-->
<!--                --><?php //endif; ?>
<!---->
<!--            </div>-->

        </div>
    </div>

<?php endif; ?>



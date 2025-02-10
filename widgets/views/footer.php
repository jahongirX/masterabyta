<div class="footer">
    <div class="wrap vcard">
        <span class="hidden fn org">Мастера Бытовых Услуг</span>
        <a class="hidden url" href="https://moscow.masterabyta.ru/">moscow.masterabyta.ru</a>
        <img style="display:none" class="hidden photo" src="libs/res/logo1.png">
        <div class="footer-inner">
            <div class="footer-left">
                <a href="<?=\yii\helpers\Url::home()?>" class="logo"><img src="libs/res/logo1.png" alt=""></a>
                <div class="footer-left-copy"><?=\app\models\Setting::getSetting('copyright')?><br>Все права
                    защищены. <a style="color:#ffa500" href="libs/uploads/2024/04/Prajs-list.xlsx" target="blank">Скачать
                        прайс-лист на услуги.</a></div>
                <span class="soc">
                  Присоединяйтесь к нам в соц. сетях:
                  <ul>
                     <!--<li class="tw"><a href="https://twitter.com/masterabyta" target="_blank" rel="noopener noreferrer"><img src="/libs/res/tw.png" alt="res/tw.png"></a></li>
                  <li class="fb"><a href="https://www.facebook.com/1915763928511067" target="_blank" rel="noopener noreferrer"><img src="/libs/res/fb.png" alt="res/fb.png"></a></li>-->
                     <li class="vk"><a href="https://vk.com/public171657232" target="_blank"
                                       rel="noopener noreferrer"><img src="libs/res/vk.png" alt=""></a></li>
                  </ul>
               </span>
            </div>
            <div class="footer-right">
                <div class="footer-right-top">
                    <div class="menu-podval-container">
                        <ul id="menu-podval" class="menu">
                            <li id="menu-item-4717"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4717"><a
                                    href="gde-my-rabotaem/">Где мы работаем?</a></li>
                            <li id="menu-item-93"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-93"><a
                                    href="o-kompanii/">О компании</a></li>
                            <li id="menu-item-94"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-94"><a
                                    href="vakansii/">Вакансии</a></li>
                            <li id="menu-item-92"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-92"><a
                                    href="tseny/">Цены</a></li>
                            <li id="menu-item-95"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-95"><a
                                    href="garantiya/">Гарантия</a></li>
                            <li id="menu-item-2639"
                                class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2639"><a
                                    href="category/articles/">Полезные статьи</a></li>
                            <li id="menu-item-97"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-97"><a
                                    href="kontakty/">Контакты</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-right-bottom">
                    <div class="footer-right-bottom-left">
                        <div class="footer-items">
                            <div class="footer-item">
                                <div class="footer-item-left">Режим работы:</div>
                                <div class="footer-item-right"><span class="openingHours"><?=\app\models\Setting::getSetting('rejim_raboti')?></span></div>
                            </div>
                            <div class="footer-item">
                                <div class="footer-item-left">Адрес:</div>
                                <div class="footer-item-right adr"><span class="locality"><?=\app\models\Setting::getSetting('address')?></div>
                            </div>
                            <div class="footer-item">
                                <div class="footer-item-left">E-mail:</div>
                                <div class="footer-item-right"><a class="email"
                                                                  href="mailto:<?=\app\models\Setting::getSetting('email')?>"><?=\app\models\Setting::getSetting('email')?></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-right-bottom-right">
                        <div class="footer-right-phones">
                            <div class="footer-phone">
                                <i class="fa fa-phone"></i>
                                <a href="tel:+7 (499) 390-53-90" class="tel"><?=\app\models\Setting::getSetting('phone_number_2')?></a>
                            </div>
                            <div class="footer-phone">
                                <i class="fa fa-phone"></i>
                                <a href="tel:+7 (929) 605-63-54" class="tel"><?=\app\models\Setting::getSetting('phone')?></a>
                            </div>
                        </div>
                        <a class="footer-get-call btn" onclick="$('.popform').show(); return false;">Заказать звонок</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Мы используем файлы Cookie и Яндекс Метрику. Сайт не является публичной офертой и носит
                информационно-справочный характер. Цены на сайте и в прайс-листе мастеров могут различаться. <a
                    href="polzovatelskoe-soglashenie/" target="_blank">Пользовательское соглашение</a></p>
            <p>Создание и продвижение - <a href="https://etalon-web.ru/" target="_blank">Etalon-Web</a>. <a
                    href="rekvizity-operatora-personalnyh-dannyh/" target="_blank">Реквизиты оператора
                    персональных данных.</a></p>
        </div>
    </div>
</div>

<div class="popsearch">
    <div class="wrap">
        <span>Поиск</span>
        <a onClick="$('.popsearch').hide();" class="close">X</a>
        <form method="get" id="search" action="https://masterabyta.ru/">
            <input type="text" name="s" placeholder="Введите запрос">
            <input type="submit" value="Искать" class="btn">
        </form>
    </div>
</div>
<div class="popform">
    <div class="wrap">
        <a onClick="$('.popform').hide();" class="close">Закрыть <span>X</span></a>
        <span class="title"><b style="display:block;line-height:1.2">Оставьте заявку!</b>
            <span style="font-size:14px;display:block;margin-top:5px">Бесплатно проконсультируем и подберем<br>
               подходящего специалиста. <em
                    style="display:block;margin-top:5px;font-weight: bold;font-style:normal;">Свободно более 100
                  мастеров.</em></span></span>

        <div class="wpcf7 no-js" id="wpcf7-f128-o3" lang="ru-RU" dir="ltr" data-wpcf7-id="128">
            <div class="screen-reader-response">
                <p role="status" aria-live="polite" aria-atomic="true"></p>
                <ul></ul>
            </div>
            <form action="https://masterabyta.ru/#wpcf7-f128-o3" method="post" class="wpcf7-form init"
                  aria-label="Контактная форма" novalidate="novalidate" data-status="init">
                <div style="display: none;">
                    <input type="hidden" name="_wpcf7" value="128" />
                    <input type="hidden" name="_wpcf7_version" value="6.0.3" />
                    <input type="hidden" name="_wpcf7_locale" value="ru_RU" />
                    <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f128-o3" />
                    <input type="hidden" name="_wpcf7_container_post" value="0" />
                    <input type="hidden" name="_wpcf7_posted_data_hash" value="" />
                    <input type="hidden" name="_wpcf7_recaptcha_response" value="" />
                </div>
                <span id="wpcf7-679b66768150f-wrapper" class="wpcf7-form-control-wrap email-wrap"
                      style="display:none !important; visibility:hidden !important;"><label for="wpcf7-679b66768150f-field"
                                                                                            class="hp-message">Оставьте это поле пустым.</label><input id="wpcf7-679b66768150f-field"
                                                                                                                                                       class="wpcf7-form-control wpcf7-text" type="text" name="email" value="" size="40" tabindex="-1"
                                                                                                                                                       autocomplete="new-password" /></span><input class="wpcf7-form-control wpcf7-hidden" value=""
                                                                                                                                                                                                   type="hidden" name="post-id" /><input class="wpcf7-form-control wpcf7-hidden" value="" type="hidden"
                                                                                                                                                                                                                                         name="domain" /><input class="wpcf7-form-control wpcf7-hidden" value="" type="hidden"
                                                                                                                                                                                                                                                                name="town" /><input class="wpcf7-form-control wpcf7-hidden" value="" type="hidden"
                                                                                                                                                                                                                                                                                     name="utm_source" /><input class="wpcf7-form-control wpcf7-hidden" value="" type="hidden"
                                                                                                                                                                                                                                                                                                                name="fpage" />
                <span class="wpcf7-form-control-wrap" data-name="iname"><input size="40" maxlength="400"
                                                                               class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="Ваше имя" value=""
                                                                               type="text" name="iname" /></span><span class="wpcf7-form-control-wrap" data-name="tel"><input
                        size="40" maxlength="400"
                        class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel"
                        aria-required="true" aria-invalid="false" placeholder="Ваш телефон" value="" type="tel"
                        name="tel" /></span><span class="wpcf7-form-control-wrap" data-name="subj"><textarea cols="40"
                                                                                                             rows="10" maxlength="2000" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"
                                                                                                             placeholder="Ваш вопрос" name="subj"></textarea></span>
                <p class="soglasen" style="color:#fff">Нажимая на кнопку "Отправить", вы принимаете условия <a
                        href="soglasie/" target="_blank" style="color:#fff!important;">Согласия</a> и <a
                        href="privacy-policy/" target="_blank" style="color:#fff!important;">Политики
                        конфиденциальности</a>.</p><input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit"
                                                          value="Отправить" />
                <div class="wpcf7-response-output" aria-hidden="true"></div>
            </form>
        </div>
    </div>
</div>
<div class="popsuccess">
    <div class="wrap">
        <span>Ваше <br>сообщение <br>успешно <br>отправлено!</span>
        <a onClick="$('.popsuccess').hide();" class="btn">Закрыть</a>
    </div>
</div>
<div id="custom-callback"></div>
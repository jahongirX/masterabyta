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


$this->params['breadcrumbs'][] = ['label' => 'Полезные статьи', 'url' => '/category/poleznye-stati/'];
$this->params['breadcrumbs'][] = Page::getTitle();

?>

<?php require_once __DIR__.'/../layouts/include/banner.php'; ?>

<?php
$pageTitle = Page::getTitle();
$pageContent = Page::getContent();
?>
<div class="breadcrumbs" style="margin-top: 60px;">
    <div class="wrap">
        <span><span><a href="<?=Url::home()?>">Главная</a></span> / <span class="breadcrumb_last" aria-current="page">Полезные статьи</span></span>   </div>
</div>
<div class="pagecontent catbox">
    <div class="wrap">
        <h1 class="blocktitle">Полезные статьи</h1>
        <div class="category">
            <div class="article">
                <img width="240" height="190" src="https://masterabyta.ru/wp-content/uploads/2023/12/Kak-sobrat-shkaf-kupe-240x190.jpg" class="attachment-post size-post wp-post-image" alt="Как собрать шкаф купе" decoding="async">            <span class="date">31.12.2023</span>
                <a href="https://masterabyta.ru/kak-sobrat-shkaf-kupe/" class="title">Как собрать шкаф купе</a>
                <p>Шкаф-купе поставляется от производителя в виде разрозненных деталей и, как правило, к такой мебели прикладывается инструкция по сборке. Если следовать руководству и пошагово выполнять все действия, то можно самостоятельно собрать габаритную мебель. Для большинства моделей шкафов-купе схема сборки – стандартная. Этапы сборки Перед тем, как приступить к работе, проверьте комплектацию шкафа. Сверьте наличие всех деталей […]</p>
                <a href="https://masterabyta.ru/kak-sobrat-shkaf-kupe/" class="more">Читать далее</a>
            </div>
        </div>
        <div class="pages pagenavi"><span class="current">1</span><a href="https://masterabyta.ru/category/articles/page/2/" class="inactive">2</a><a href="https://masterabyta.ru/category/articles/page/3/" class="inactive">3</a><a href="https://masterabyta.ru/category/articles/page/4/" class="inactive">4</a><a href="https://masterabyta.ru/category/articles/page/5/" class="inactive">5</a><a href="https://masterabyta.ru/category/articles/page/6/" class="inactive">6</a><a href="https://masterabyta.ru/category/articles/page/7/" class="inactive">7</a><a href="https://masterabyta.ru/category/articles/page/8/" class="inactive">8</a><a href="https://masterabyta.ru/category/articles/page/9/" class="inactive">9</a></div>
        <div class="consult">
            <div class="title">Оставьте заявку на БЕСПЛАТНУЮ консультацию. <br> Перезвоним в течение 5 минут!</div>

            <div class="wpcf7 js" id="wpcf7-f129-o2" lang="ru-RU" dir="ltr" data-wpcf7-id="129">
                <div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p> <ul></ul></div>
                <form action="/category/articles/#wpcf7-f129-o2" method="post" class="wpcf7-form init" aria-label="Контактная форма" novalidate="novalidate" data-status="init">
                    <div style="display: none;">
                        <input type="hidden" name="_wpcf7" value="129">
                        <input type="hidden" name="_wpcf7_version" value="6.0.3">
                        <input type="hidden" name="_wpcf7_locale" value="ru_RU">
                        <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f129-o2">
                        <input type="hidden" name="_wpcf7_container_post" value="0">
                        <input type="hidden" name="_wpcf7_posted_data_hash" value="">
                        <input type="hidden" name="_wpcf7_recaptcha_response" value="03AFcWeA6xkjQng0M9Rjcu5WY17AHrfzLIhLaV0jO7__No8H-Za-L5Yq2ppi-qOxDdVlPwHjuOnIhVBgQDBXpZL43AkEXGUrDIJAR2I21u1DRlz-UUuHAWyoJmlmyrm2ahehe6eXELScj7_3SiEu3Bpe_f37dsI0f3FsWjegRssUzrKivj0F--u3HjqQQvlkeW8t_-cQtSJngmNM82oDTSGjwCeBa87Biu1NACIRsgXjC0wwXA827l2SKze6iGk-1f5Mw771985MMIY2avWzZ69JUKEDVJ27DHtffcfR7FntVVpUvyDodDdtxkUk5BFZ3G8WMUp5K0zLeDhObCD5FDyWw11jOVBYCUXXQ4qygxQpnqBtftawF8XhGLRbRyN2RCcOALW779QijSgb7MUyw0S-8n0R2x5dXFnPVC8jaO05dnNDB5P_bvSZOz7dGX1gk3JDctvzZ3-rkUvXl8enBvjzjhV5O5Gq_SihchDSRUxGzO7kLYpos-aBa_dqyLPv2zO4jSdBhOqrOXOuwT1Aumqs7snM1gtGg6ELkTPGhiE404yQGN0z9te_GfoOIOZ_wAu7GBwHeyekIFmQ7n4aJDM13KvzjrscWyyEfG50ql_eOlSO42T2iq1GlFhvOmp3On230XG7GOADyzbeDbVSpe9Yy2ajoVDLwIlN2Aan0Xpnkn-lRlulyP7vnKsyjsHOgqTFVTSGSWvPES6nNHpG_GdJcXgtlPDBCByJzXvJytTnkwvRjhOel70JRA-f7n1yESr0qN_FgqzHAcbrBFw32lfKtHalE0bRzbcxEEvoYTvv901uip_yk9fLBuyFTeFgLlBe5lrfPVDvl0eTaGGx8ZTpAG3A-M0wmWIvbn5QmvyeH46SpuZ5alf7mLbOQZinDgMfta13IC8T_kxw2aw9LClcgZ_Ed121NqSw">
                    </div>
                    <span id="wpcf7-67a9de24028cd-wrapper" class="wpcf7-form-control-wrap email-wrap" style="display:none !important; visibility:hidden !important;"><label for="wpcf7-67a9de24028cd-field" class="hp-message">Оставьте это поле пустым.</label><input id="wpcf7-67a9de24028cd-field" class="wpcf7-form-control wpcf7-text" type="text" name="email" value="" size="40" tabindex="-1" autocomplete="new-password"></span>
                    <input class="wpcf7-form-control wpcf7-hidden" value="https://mastervdom.site" type="hidden" name="domain">
                    <input class="wpcf7-form-control wpcf7-hidden" value="4507" type="hidden" name="post-id">
                    <input class="wpcf7-form-control wpcf7-hidden" value="Москва" type="hidden" name="town">
                    <input class="wpcf7-form-control wpcf7-hidden" value="Не определено" type="hidden" name="utm_source">
                    <input class="wpcf7-form-control wpcf7-hidden" value="Полезные статьи (https://masterabyta.ru/category/articles/)" type="hidden" name="fpage">
                    <div class="cols"><div class="col6"><span class="wpcf7-form-control-wrap" data-name="iname"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="Ваше имя" value="" type="text" name="iname"></span><span class="wpcf7-form-control-wrap" data-name="tel"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" placeholder="Ваш телефон" value="" type="tel" name="tel"></span><p class="soglasen" style="color:#fff;">Нажимая на кнопку "Отправить", вы принимаете условия <a href="https://masterabyta.ru/soglasie/" target="_blank" style="color:#fff;">Согласия</a> и <a href="https://masterabyta.ru/privacy-policy/" target="_blank" style="color:#fff;">Политики конфиденциальности</a>.</p></div><div class="col6"><span class="wpcf7-form-control-wrap" data-name="subj"><textarea cols="40" rows="10" maxlength="2000" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Ваш вопрос" name="subj"></textarea></span><input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="Отправить"><span class="wpcf7-spinner"></span></div></div><div class="wpcf7-response-output" aria-hidden="true"></div>
                </form>
            </div>
        </div>   </div>
</div>
<?=\app\widgets\ZadatVopros::widget()?>
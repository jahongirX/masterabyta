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

    <?php require_once __DIR__.'/banner-2.php'; ?>

    <?php /* ?>
    <div class="container b-helmet">
        <?php if (!empty($banner['image'])): ?>
            <div class="b-helmet__bg" style="background-image: url('<?= $banner['image'] ?>')"></div>
        <?php endif; ?>

        <div class="b-helmet__content">
            <div class="b-helmet__header">
                <?php if (!empty($banner['use_page_header'])) {
                    $banner['header'] = Page::getTitle();
                    Yii::$app->params['banner_use_page_header'] = 1;
                } ?>
                <?php if (!empty($banner['header'])): ?>
                    <h1 class="b-helmet__title"><?= CustomHelper::custom_br($banner['header']) ?></h1>
                <?php endif; ?>
                <?php if (!empty($banner['subtitle'])): ?>
                    <div class="b-helmet__subtitle"><?= CustomHelper::custom_br($banner['subtitle']) ?></div>
                <?php endif; ?>
            </div>

            <div class="b-helmet__advantages">
                <?php for ($i=1; $i <= 4; $i++): ?>
                    <?php if (!empty($banner["item{$i}"])): ?>
                        <div class="b-helmet__advantages-item">
                            <?php if (!empty($banner["ico{$i}"])): ?>
                                <div class="b-helmet__advantages-item-ico-wrap">
                                    <img src="<?= $banner["ico{$i}"] ?>" alt="" class="b-helmet__advantages-item-ico">
                                </div>
                            <?php endif; ?>
                            <div class="b-helmet__advantages-item-text"><?= $banner["item{$i}"] ?></div>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>

            <div class="b-helmet__form-wrapper">

                <?php if (!empty($banner['form'])): ?>
                    <div class="b-helmet__form-title"><?= CustomHelper::custom_br($banner['form']) ?></div>
                <?php endif; ?>

                <?php if (!empty($banner['note'])): ?>
                    <div class="b-helmet__form-note"><?= CustomHelper::custom_br($banner['note']) ?></div>
                <?php endif; ?>

                <form action="<?= Url::to(['/site/send']) ?>" method="post" class="b-helmet__form form-validator custom-send-form">
                    
                    <div class="form-group">
                        <input class="form-control" type="tel" name="phone" inputmode="tel" data-inputmask="'mask': '+7 (999) 999-99-99'" required placeholder="Контактный телефон"/>
                    </div>

                    <button type="submit" class="b-helmet__form-btn"><?= CustomHelper::custom_br($banner['button']) ?></button>

                </form>

                <?php if ($agreement = Setting::getSetting('checkbox-text-agreement')): ?>
                    <div class="b-helmet__form-privacy"><?= CustomHelper::custom_br(str_replace('[button]', $banner['button'], $agreement)) ?></div>
                <?php endif; ?>

            </div>

        </div>
    </div>
    <?php */ ?>

<?php endif; ?>



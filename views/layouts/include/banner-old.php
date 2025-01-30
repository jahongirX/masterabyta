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
    
<div class="container banner" style="height: inherit">
    <?php if (!empty($banner['image'])): ?>
        <div class="banner-bg" style="background-image: url('<?= $banner['image'] ?>')"></div>
    <?php endif; ?>
    <div class="row">
        <div class="banner-content">
            <div class="banner-header">
                <?php if (!empty($banner['header'])): ?>
                    <p><?= CustomHelper::custom_br($banner['header']) ?></p>
                <?php endif; ?>
                </div>
                <div id="banner-advantages">
                    <div class="advantages-icons">
                        <?php if (!empty($banner['item'])): ?>
                            <?php 
                                $banner_item = trim($banner['item']);
                                $banner_item = preg_replace("@[\r\n]+@", '\r\n', $banner_item);
                                $banner_item = explode('\r\n', $banner_item);
                                $banner_item = array_map('trim', $banner_item);
                            ?>
                            <?php if (!empty($banner_item) && is_array($banner_item)): ?>
                                <?php $banner_item_counter = 1; ?>
                                <?php foreach ($banner_item as $one): ?>
                                    <?php if (!empty($one)): ?>
                                        <p class="advantage-<?= $banner_item_counter ?>"><span><?= $one ?></span></p>
                                    <?php endif; ?>
                                    <?php $banner_item_counter++; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                   </div>
               </div>
               <div id="banner-form-wrapper">

                <form action="<?= Url::to(['/site/send']) ?>" method="post" class="leadback-popup__form form-validator custom-send-form">
                    <?php if (!empty($banner['form'])): ?>
                        <p class="banner-form-intro"><?= CustomHelper::custom_br($banner['form']) ?></p>
                    <?php endif; ?>
                    <div class="form-group">
                        <input class="banner-form-input-text form-control" type="text" name="name" placeholder="Ваше имя">
                    </div>
                    <div class="form-group">
                        <input class="banner-form-input-text form-control" type="tel" name="phone" inputmode="tel" data-inputmask="'mask': '+7 (999) 999-99-99'" required placeholder="Контактный телефон"/>
                    </div>
                    <div class="form-group">
                        <textarea class="banner-form-input-text form-control" name="question" placeholder="Что вас интересует?" style="width: 100%; margin-bottom: 0px;"></textarea>
                    </div>
                    <?php if ($agreement = Setting::getSetting('checkbox-text-agreement')): ?>
                        <div class="personal-data" style="text-align: start; line-height: 1.1; font-size: 12px;"><?= CustomHelper::custom_br(str_replace('[button]', $banner['button'], $agreement)) ?></div>
                    <?php endif; ?>

                    <button type="submit" class="banner-form-submit leadback__form-btn"><?= CustomHelper::custom_br($banner['button']) ?></button>
                </form>

            </div>
            <div class="banner-discount">
                <?php if (!empty($banner['note'])): ?>
                    <p><?= CustomHelper::custom_br($banner['note']) ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php

use yii\helpers\Url;

?>

<div class="admin-default-index">
    <div class="admin-category"> 
    	<ul class="category-list clearfix">
            <?php if(Yii::$app->user->can('contentView')): ?>
                <li> <a href="<?= Url::to(['/admin/content']) ?>"> <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> <span class="category-name">Контент</span> </a> </li> 
            <?php endif; ?>
            <?php if(Yii::$app->user->can('pageView')): ?>
                <li> <a href="<?= Url::to(['/admin/page']) ?>"> <span class="glyphicon glyphicon-file" aria-hidden="true"></span> <span class="category-name">Страницы</span> </a> </li> 
            <?php endif; ?>
            <?php if(Yii::$app->user->can('cityView')): ?>
                <li> <a href="<?= Url::to(['/admin/city']) ?>"> <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <span class="category-name">Города</span> </a> </li> 
            <?php endif; ?>
            <?php if(Yii::$app->user->can('requestView')): ?>
                <li> <a href="<?= Url::to(['/admin/request']) ?>"> <span class="glyphicon glyphicon-send" aria-hidden="true"></span> <span class="category-name">Заявки</span> </a> </li> 
    		<?php endif; ?>
            <?php if(Yii::$app->user->can('pricesectionView')): ?>
                <li> <a href="<?= Url::to(['/admin/price-section']) ?>"> <span style="display: flex; justify-content: center; align-items: flex-end;"><span class="glyphicon glyphicon-folder-open small" aria-hidden="true"></span><span class="glyphicon glyphicon-rub" aria-hidden="true" style="font-size: 20px !important; margin-left: -16px; color: #FFF !important;"></span></span> <span class="category-name">Разделы прайса</span> </a> </li> 
            <?php endif; ?>
            <?php if(Yii::$app->user->can('priceView')): ?>
                <li> <a href="<?= Url::to(['/admin/price']) ?>"> <span class="glyphicon glyphicon-rub" aria-hidden="true"></span> <span class="category-name">Прайс</span> </a> </li> 
            <?php endif; ?>
            <?php if(Yii::$app->user->can('pricetableView')): ?>
                <li> <a href="<?= Url::to(['/admin/pricetable']) ?>"> <span style="display: flex; justify-content: center; align-items: flex-end;"><span class="glyphicon glyphicon-file small" aria-hidden="true"></span><span class="glyphicon glyphicon-rub" aria-hidden="true" style="font-size: 20px !important; margin-left: -26px; color: #FFF !important;"></span></span> <span class="category-name">Таблицы цен</span> </a> </li> 
            <?php endif; ?>
            <?php if(Yii::$app->user->can('pricetablehtmlView')): ?>
                <li> <a href="<?= Url::to(['/admin/pricetablehtml']) ?>"> <span style="display: flex; justify-content: center; align-items: flex-end;"><span class="glyphicon glyphicon-file small" aria-hidden="true"></span><span class="glyphicon glyphicon-rub" aria-hidden="true" style="font-size: 20px !important; margin-left: -26px; color: #FFF !important;"></span></span> <span class="category-name">Таблицы цен HTML</span> </a> </li> 
            <?php endif; ?>
            <?php if(Yii::$app->user->can('masterView')): ?>
                <li> <a href="<?= Url::to(['/admin/master']) ?>"> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> <span class="category-name">Мастера</span> </a> </li> 
            <?php endif; ?>
            <?php if(Yii::$app->user->can('reviewView')): ?>
                <li> <a href="<?= Url::to(['/admin/review']) ?>"> <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> <span class="category-name">Отзывы</span> </a> </li> 
            <?php endif; ?>
            <?php if(Yii::$app->user->can('bannerView')): ?>
                <li> <a href="<?= Url::to(['/admin/banner']) ?>"> <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> <span class="category-name">Баннеры</span> </a> </li> 
            <?php endif; ?>
            <?php if(Yii::$app->user->can('partnerView')): ?>
                <li> <a href="<?= Url::to(['/admin/partner']) ?>"> <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> <span class="category-name">Партнеры</span> </a> </li> 
            <?php endif; ?>
            <?php if(Yii::$app->user->can('partnercontactView')): ?>
                <li> <a href="<?= Url::to(['/admin/partnercontact']) ?>"> <span style="display: flex; justify-content: center; align-items: flex-end;"><span class="glyphicon glyphicon-map-marker small" aria-hidden="true"></span><span class="glyphicon glyphicon-briefcase" aria-hidden="true" style="font-size: 20px !important; margin-left: -14px; margin-bottom: 12px;"></span></span> <span class="category-name">Контакты партнеров</span> </a> </li> 
            <?php endif; ?>
            <?php if(Yii::$app->user->can('settingView')): ?>
                <li> <a href="<?= Url::to(['/admin/setting']) ?>"> <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> <span class="category-name">Настройки</span> </a> </li> 
            <?php endif; ?>
            <?php if(Yii::$app->user->can('tagView')): ?>
                <li> <a href="<?= Url::to(['/admin/tag']) ?>"> <span class="glyphicon glyphicon-console" aria-hidden="true"></span> <span class="category-name">Теги</span> </a> </li> 
    		<?php endif; ?>
            <?php if(Yii::$app->user->can('menuView')): ?>
                <li> <a href="<?= Url::to(['/admin/menu']) ?>"> <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> <span class="category-name">Меню</span> </a> </li> 
    		<?php endif; ?>
            <?php if(Yii::$app->user->can('userView')): ?>
                <li> <a href="<?= Url::to(['/admin/user']) ?>"> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <span class="category-name">Пользователи</span> </a> </li>
            <?php endif; ?>
            <?php if(Yii::$app->user->can('searchindexView')): ?>
                <li> <a href="<?= Url::to(['/admin/searchindex']) ?>"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span> <span class="category-name">Поиск</span> </a> </li>
            <?php endif; ?>
            <?php if(Yii::$app->user->can('redirectView')): ?>
                <li> <a href="<?= Url::to(['/admin/redirect']) ?>"> <span class="glyphicon glyphicon-random" aria-hidden="true"></span> <span class="category-name">Переадресации</span> </a> </li>
            <?php endif; ?>
    	</ul>
    </div>
</div>

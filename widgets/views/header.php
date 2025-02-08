<div class="popup" id="popup-towns">
    <div class="popup-title">Выберите город</div>
    <div class="towns-search">
        <div class="towns-search-left"><i class="fa fa-search"></i></div>
        <div class="towns-search-right"><input type="" name="" placeholder="Поиск..."></div>
    </div>
    <div class="towns-list">

    </div>
</div>
<div class="popup" id="popup-anketa">
    <div class="popup-title" style="max-width:400px">Ваша анкета отправлена.<br>Специалист отдела кадров свяжется с
        Вами в ближайшее время.</div>
    <div style="text-align:center;margin-top:20px"><a href="<?=\yii\helpers\Url::home()?>" class="btn">На главную</a></div>
</div>
<div class="newhead">
    <a href="/#" class="close">X</a>
    <div class="newhead-inner wrap">
        <div class="newhead-top">
            <div class="header-top-menu-inner">
                <div class="header-top-menu-left">
                    <div class="menu-menyu-verhnee-container">
                        <ul id="menu-menyu-verhnee" class="menu">
                            <li id="menu-item-4716"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4716"><a
                                    href="<?=\yii\helpers\Url::to(['/chastye-voprosy/'])?>">Частые вопросы</a></li>
                            <li id="menu-item-2302"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2302"><a
                                    href="/otzyvy/">Отзывы клиентов</a></li>
                            <li id="menu-item-2303"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2303"><a
                                    href="/garantiya/">Гарантия</a></li>
                            <li id="menu-item-2638"
                                class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-2638"><a
                                    href="/category/articles/">Статьи</a></li>
                            <li id="menu-item-2313"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2313"><a
                                    href="/tseny/">Цены</a></li>
                            <li id="menu-item-2311"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2311"><a
                                    href="/kontakty/">Контакты</a></li>
                        </ul>
                    </div>
                </div>
                <div class="header-top-menu-right">
                    <div class="header-town">
                        <div class="header-town-icon">
                            <img src="/libs/img/town.png">
                        </div>
                        <div class="header-town-current">Москва</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="newhead-middle">
            <div class="newhead-middle-col newhead-middle-col-1">
                <a href="<?=\yii\helpers\Url::home()?>" class="logo display-block"><img src="/libs/res/logo.png" alt="header logo"></a>
            </div>
            <div class="newhead-middle-col newhead-middle-col-2">
                <form method="get" id="searchform" action="https://masterabyta.ru/" class="h320">
                    <input type="text" name="s" placeholder="Поиск...">
                    <input type="submit" value="search">
                </form>
            </div>
            <div class="newhead-middle-col newhead-middle-col-3">
                <a href="mailto:info@masterabyta.ru" class="newhead-email">
                    <b>info@masterabyta.ru</b>
                </a>
                <div class="newhead-time">с 9:00 до 21:00, без выходных</div>
            </div>
            <div class="newhead-middle-col newhead-middle-col-4">
                <div class="newhead-phones">
                    <a href="tel:+7 (499) 390-53-90" class="newhead-phone">+7 (499) 390-53-90</a>
                    <a href="tel:+7 (929) 605-63-54" class="newhead-phone">+7 (929) 605-63-54</a>
                </div>
                <div class="newhead-get-call" onclick="$('.popform').show(); return false;">Заказать звонок</div>
                <div class="newhead-mob-town">
                    <div class="header-town">
                        <div class="header-town-icon">
                            <img src="/libs/img/town.png">
                        </div>
                        <div class="header-town-current">Москва</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="newhead-bottom">
            <div class="bigmenu">
                <div class="menu-uslugi-mobilnoe-container">
                    <ul id="menu-uslugi-mobilnoe" class="menu">
                        <?php if(!empty($models)): ?>
                        <?php foreach ($models as $model): ?>
                        <?php
                            $child_menus = null;
                            $parent_name = null;
                           if (!empty($model->id)){
                               $child_menus = $model->getMenuArray($model->id);
                           }
                           if (!empty($model->name)){
                               $parent_name = trim(str_replace("Каталог -", "", $model->name));
                           }
//                           echo '<pre>';
//                           print_r($model);die();
                        ?>
                        <li id="menu-item-2319"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2319">

                            <a href="#">
                                <div class="bigmenu-pic" ></div>
                                <?=$parent_name?>
                            </a>
                            <ul class="sub-menu">
                                <?php if(!empty($child_menus)): ?>
                                    <?php foreach ($child_menus as $child_menu): ?>
                                        <li id="menu-item"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-210"><a
                                            href="<?=\yii\helpers\Url::to($child_menu['link'])?>"><?=$child_menu['name']?></a></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="mobilemenubox a320">
                <a onClick="$('.popsearch').show();" class="showsearch"></a>
                <a onClick="$('.popsvc').show();" class="showsvcs"> Наши услуги</a>
                <a onClick="$('.popmenu').show();" class="showmenu"></a>
            </div>
        </div>
    </div>
</div>
<div class="newhead-mob">
    <div class="wrap">
        <div class="newhead-mob-inner">
            <div class="newhead-mob-left">
                <div class="newhead-mob-menu-button"><!--onClick="$('.popsvc').show();"--><img src="/libs/res/menu.png">
                </div>
            </div>
            <div class="newhead-mob-center"><a href="index.html"><img src="/libs/res/logo.png" alt=""></a></div>
            <div class="newhead-mob-left">
                <a href="tel:+7 (499) 390-53-90" class="newhead-mob-phone animated tada"><i class="fa fa-phone"></i></a>
            </div>
        </div>
    </div>
</div>
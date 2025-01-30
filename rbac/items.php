<?php

return [
    'adminPanel' => [
        'type' => 2,
        'description' => 'Админ панель',
    ],
    'ElfinderFull' => [
        'type' => 2,
        'description' => 'Elfinder',
    ],
    'bannerView' => [
        'type' => 2,
        'description' => 'Просмотр "Баннеры"',
    ],
    'bannerCreate' => [
        'type' => 2,
        'description' => 'Добавление "Баннеры"',
        'children' => [
            'bannerView',
        ],
    ],
    'bannerUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Баннеры"',
        'children' => [
            'bannerView',
        ],
    ],
    'bannerDelete' => [
        'type' => 2,
        'description' => 'Удаление "Баннеры"',
        'children' => [
            'bannerView',
            'bannerFileRemove',
        ],
    ],
    'bannerFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Баннеры"',
    ],
    'bannerFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Баннеры"',
        'children' => [
            'bannerView',
            'bannerCreate',
            'bannerUpdate',
            'bannerDelete',
        ],
    ],
    'blockView' => [
        'type' => 2,
        'description' => 'Просмотр "Блоки"',
    ],
    'blockCreate' => [
        'type' => 2,
        'description' => 'Добавление "Блоки"',
        'children' => [
            'blockView',
        ],
    ],
    'blockUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Блоки"',
        'children' => [
            'blockView',
        ],
    ],
    'blockDelete' => [
        'type' => 2,
        'description' => 'Удаление "Блоки"',
        'children' => [
            'blockView',
            'blockFileRemove',
        ],
    ],
    'blockFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Блоки"',
    ],
    'blockFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Блоки"',
        'children' => [
            'blockView',
            'blockCreate',
            'blockUpdate',
            'blockDelete',
        ],
    ],
    'blockuniqueView' => [
        'type' => 2,
        'description' => 'Просмотр "Уникальные блоки"',
    ],
    'blockuniqueCreate' => [
        'type' => 2,
        'description' => 'Добавление "Уникальные блоки"',
        'children' => [
            'blockuniqueView',
        ],
    ],
    'blockuniqueUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Уникальные блоки"',
        'children' => [
            'blockuniqueView',
        ],
    ],
    'blockuniqueDelete' => [
        'type' => 2,
        'description' => 'Удаление "Уникальные блоки"',
        'children' => [
            'blockuniqueView',
            'blockuniqueFileRemove',
        ],
    ],
    'blockuniqueFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Уникальные блоки"',
    ],
    'blockuniqueFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Уникальные блоки"',
        'children' => [
            'blockuniqueView',
            'blockuniqueCreate',
            'blockuniqueUpdate',
            'blockuniqueDelete',
        ],
    ],
    'blocktechnicalView' => [
        'type' => 2,
        'description' => 'Просмотр "Технические блоки"',
    ],
    'blocktechnicalCreate' => [
        'type' => 2,
        'description' => 'Добавление "Технические блоки"',
        'children' => [
            'blocktechnicalView',
        ],
    ],
    'blocktechnicalUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Технические блоки"',
        'children' => [
            'blocktechnicalView',
        ],
    ],
    'blocktechnicalDelete' => [
        'type' => 2,
        'description' => 'Удаление "Технические блоки"',
        'children' => [
            'blocktechnicalView',
            'blocktechnicalFileRemove',
        ],
    ],
    'blocktechnicalFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Технические блоки"',
    ],
    'blocktechnicalFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Технические блоки"',
        'children' => [
            'blocktechnicalView',
            'blocktechnicalCreate',
            'blocktechnicalUpdate',
            'blocktechnicalDelete',
        ],
    ],
    'categoryView' => [
        'type' => 2,
        'description' => 'Просмотр "Категории"',
    ],
    'categoryCreate' => [
        'type' => 2,
        'description' => 'Добавление "Категории"',
        'children' => [
            'categoryView',
        ],
    ],
    'categoryUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Категории"',
        'children' => [
            'categoryView',
        ],
    ],
    'categoryDelete' => [
        'type' => 2,
        'description' => 'Удаление "Категории"',
        'children' => [
            'categoryView',
            'categoryFileRemove',
        ],
    ],
    'categoryFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Категории"',
    ],
    'categoryFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Категории"',
        'children' => [
            'categoryView',
            'categoryCreate',
            'categoryUpdate',
            'categoryDelete',
        ],
    ],
    'cityView' => [
        'type' => 2,
        'description' => 'Просмотр "Города"',
    ],
    'cityCreate' => [
        'type' => 2,
        'description' => 'Добавление "Города"',
        'children' => [
            'cityView',
        ],
    ],
    'cityUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Города"',
        'children' => [
            'cityView',
        ],
    ],
    'cityDelete' => [
        'type' => 2,
        'description' => 'Удаление "Города"',
        'children' => [
            'cityView',
            'cityFileRemove',
        ],
    ],
    'cityFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Города"',
    ],
    'cityFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Города"',
        'children' => [
            'cityView',
            'cityCreate',
            'cityUpdate',
            'cityDelete',
        ],
    ],
    'contentView' => [
        'type' => 2,
        'description' => 'Просмотр "Контент"',
    ],
    'contentCreate' => [
        'type' => 2,
        'description' => 'Добавление "Контент"',
        'children' => [
            'contentView',
        ],
    ],
    'contentUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Контент"',
        'children' => [
            'contentView',
        ],
    ],
    'contentDelete' => [
        'type' => 2,
        'description' => 'Удаление "Контент"',
        'children' => [
            'contentView',
            'contentFileRemove',
        ],
    ],
    'contentFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Контент"',
    ],
    'contentFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Контент"',
        'children' => [
            'contentView',
            'contentCreate',
            'contentUpdate',
            'contentDelete',
        ],
    ],
    'menuView' => [
        'type' => 2,
        'description' => 'Просмотр "Меню"',
    ],
    'menuCreate' => [
        'type' => 2,
        'description' => 'Добавление "Меню"',
        'children' => [
            'menuView',
        ],
    ],
    'menuUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Меню"',
        'children' => [
            'menuView',
        ],
    ],
    'menuDelete' => [
        'type' => 2,
        'description' => 'Удаление "Меню"',
        'children' => [
            'menuView',
            'menuFileRemove',
        ],
    ],
    'menuFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Меню"',
    ],
    'menuFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Меню"',
        'children' => [
            'menuView',
            'menuCreate',
            'menuUpdate',
            'menuDelete',
        ],
    ],
    'masterView' => [
        'type' => 2,
        'description' => 'Просмотр "Мастер"',
    ],
    'masterCreate' => [
        'type' => 2,
        'description' => 'Добавление "Мастер"',
        'children' => [
            'masterView',
        ],
    ],
    'masterUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Мастер"',
        'children' => [
            'masterView',
        ],
    ],
    'masterDelete' => [
        'type' => 2,
        'description' => 'Удаление "Мастер"',
        'children' => [
            'masterView',
            'masterFileRemove',
        ],
    ],
    'masterFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Мастер"',
    ],
    'masterFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Мастер"',
        'children' => [
            'masterView',
            'masterCreate',
            'masterUpdate',
            'masterDelete',
        ],
    ],
    'pageView' => [
        'type' => 2,
        'description' => 'Просмотр "Страницы"',
    ],
    'pageCreate' => [
        'type' => 2,
        'description' => 'Добавление "Страницы"',
        'children' => [
            'pageView',
        ],
    ],
    'pageUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Страницы"',
        'children' => [
            'pageView',
        ],
    ],
    'pageDelete' => [
        'type' => 2,
        'description' => 'Удаление "Страницы"',
        'children' => [
            'pageView',
            'pageFileRemove',
        ],
    ],
    'pageFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Страницы"',
    ],
    'pageFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Страницы"',
        'children' => [
            'pageView',
            'pageCreate',
            'pageUpdate',
            'pageDelete',
        ],
    ],
    'partnerView' => [
        'type' => 2,
        'description' => 'Просмотр "Партнеры"',
    ],
    'partnerCreate' => [
        'type' => 2,
        'description' => 'Добавление "Партнеры"',
        'children' => [
            'partnerView',
        ],
    ],
    'partnerUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Партнеры"',
        'children' => [
            'partnerView',
        ],
    ],
    'partnerDelete' => [
        'type' => 2,
        'description' => 'Удаление "Партнеры"',
        'children' => [
            'partnerView',
            'partnerFileRemove',
        ],
    ],
    'partnerFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Партнеры"',
    ],
    'partnerFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Партнеры"',
        'children' => [
            'partnerView',
            'partnerCreate',
            'partnerUpdate',
            'partnerDelete',
        ],
    ],
    'partnercontactView' => [
        'type' => 2,
        'description' => 'Просмотр "Контакты партнеров"',
    ],
    'partnercontactCreate' => [
        'type' => 2,
        'description' => 'Добавление "Контакты партнеров"',
        'children' => [
            'partnercontactView',
        ],
    ],
    'partnercontactUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Контакты партнеров"',
        'children' => [
            'partnercontactView',
        ],
    ],
    'partnercontactDelete' => [
        'type' => 2,
        'description' => 'Удаление "Контакты партнеров"',
        'children' => [
            'partnercontactView',
            'partnercontactFileRemove',
        ],
    ],
    'partnercontactFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Контакты партнеров"',
    ],
    'partnercontactFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Контакты партнеров"',
        'children' => [
            'partnercontactView',
            'partnercontactCreate',
            'partnercontactUpdate',
            'partnercontactDelete',
        ],
    ],
    'priceView' => [
        'type' => 2,
        'description' => 'Просмотр "Цены"',
    ],
    'priceCreate' => [
        'type' => 2,
        'description' => 'Добавление "Цены"',
        'children' => [
            'priceView',
        ],
    ],
    'priceUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Цены"',
        'children' => [
            'priceView',
        ],
    ],
    'priceDelete' => [
        'type' => 2,
        'description' => 'Удаление "Цены"',
        'children' => [
            'priceView',
            'priceFileRemove',
        ],
    ],
    'priceFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Цены"',
    ],
    'priceFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Цены"',
        'children' => [
            'priceView',
            'priceCreate',
            'priceUpdate',
            'priceDelete',
        ],
    ],
    'pricesectionView' => [
        'type' => 2,
        'description' => 'Просмотр "Разделы прайса"',
    ],
    'pricesectionCreate' => [
        'type' => 2,
        'description' => 'Добавление "Разделы прайса"',
        'children' => [
            'pricesectionView',
        ],
    ],
    'pricesectionUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Разделы прайса"',
        'children' => [
            'pricesectionView',
        ],
    ],
    'pricesectionDelete' => [
        'type' => 2,
        'description' => 'Удаление "Разделы прайса"',
        'children' => [
            'pricesectionView',
            'pricesectionFileRemove',
        ],
    ],
    'pricesectionFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Разделы прайса"',
    ],
    'pricesectionFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Разделы прайса"',
        'children' => [
            'pricesectionView',
            'pricesectionCreate',
            'pricesectionUpdate',
            'pricesectionDelete',
        ],
    ],
    'pricetableView' => [
        'type' => 2,
        'description' => 'Просмотр "Таблицы цен"',
    ],
    'pricetableCreate' => [
        'type' => 2,
        'description' => 'Добавление "Таблицы цен"',
        'children' => [
            'pricetableView',
        ],
    ],
    'pricetableUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Таблицы цен"',
        'children' => [
            'pricetableView',
        ],
    ],
    'pricetableDelete' => [
        'type' => 2,
        'description' => 'Удаление "Таблицы цен"',
        'children' => [
            'pricetableView',
            'pricetableFileRemove',
        ],
    ],
    'pricetableFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Таблицы цен"',
    ],
    'pricetableFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Таблицы цен"',
        'children' => [
            'pricetableView',
            'pricetableCreate',
            'pricetableUpdate',
            'pricetableDelete',
        ],
    ],
    'pricetablehtmlView' => [
        'type' => 2,
        'description' => 'Просмотр "Таблицы цен HTML"',
    ],
    'pricetablehtmlCreate' => [
        'type' => 2,
        'description' => 'Добавление "Таблицы цен HTML"',
        'children' => [
            'pricetablehtmlView',
        ],
    ],
    'pricetablehtmlUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Таблицы цен HTML"',
        'children' => [
            'pricetablehtmlView',
        ],
    ],
    'pricetablehtmlDelete' => [
        'type' => 2,
        'description' => 'Удаление "Таблицы цен HTML"',
        'children' => [
            'pricetablehtmlView',
            'pricetablehtmlFileRemove',
        ],
    ],
    'pricetablehtmlFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Таблицы цен HTML"',
    ],
    'pricetablehtmlFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Таблицы цен HTML"',
        'children' => [
            'pricetablehtmlView',
            'pricetablehtmlCreate',
            'pricetablehtmlUpdate',
            'pricetablehtmlDelete',
        ],
    ],
    'redirectView' => [
        'type' => 2,
        'description' => 'Просмотр "Переадресации"',
    ],
    'redirectCreate' => [
        'type' => 2,
        'description' => 'Добавление "Переадресации"',
        'children' => [
            'redirectView',
        ],
    ],
    'redirectUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Переадресации"',
        'children' => [
            'redirectView',
        ],
    ],
    'redirectDelete' => [
        'type' => 2,
        'description' => 'Удаление "Переадресации"',
        'children' => [
            'redirectView',
            'redirectFileRemove',
        ],
    ],
    'redirectFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Переадресации"',
    ],
    'redirectFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Переадресации"',
        'children' => [
            'redirectView',
            'redirectCreate',
            'redirectUpdate',
            'redirectDelete',
        ],
    ],
    'requestView' => [
        'type' => 2,
        'description' => 'Просмотр "Заявки"',
    ],
    'requestCreate' => [
        'type' => 2,
        'description' => 'Добавление "Заявки"',
        'children' => [
            'requestView',
        ],
    ],
    'requestUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Заявки"',
        'children' => [
            'requestView',
        ],
    ],
    'requestDelete' => [
        'type' => 2,
        'description' => 'Удаление "Заявки"',
        'children' => [
            'requestView',
            'requestFileRemove',
        ],
    ],
    'requestFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Заявки"',
    ],
    'requestFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Заявки"',
        'children' => [
            'requestView',
            'requestCreate',
            'requestUpdate',
            'requestDelete',
        ],
    ],
    'reviewView' => [
        'type' => 2,
        'description' => 'Просмотр "Отзывы"',
    ],
    'reviewCreate' => [
        'type' => 2,
        'description' => 'Добавление "Отзывы"',
        'children' => [
            'reviewView',
        ],
    ],
    'reviewUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Отзывы"',
        'children' => [
            'reviewView',
        ],
    ],
    'reviewDelete' => [
        'type' => 2,
        'description' => 'Удаление "Отзывы"',
        'children' => [
            'reviewView',
            'reviewFileRemove',
        ],
    ],
    'reviewFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Отзывы"',
    ],
    'reviewFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Отзывы"',
        'children' => [
            'reviewView',
            'reviewCreate',
            'reviewUpdate',
            'reviewDelete',
        ],
    ],
    'searchindexView' => [
        'type' => 2,
        'description' => 'Просмотр "Посковой индекс"',
    ],
    'searchindexCreate' => [
        'type' => 2,
        'description' => 'Добавление "Посковой индекс"',
        'children' => [
            'searchindexView',
        ],
    ],
    'searchindexUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Посковой индекс"',
        'children' => [
            'searchindexView',
        ],
    ],
    'searchindexDelete' => [
        'type' => 2,
        'description' => 'Удаление "Посковой индекс"',
        'children' => [
            'searchindexView',
            'searchindexFileRemove',
        ],
    ],
    'searchindexFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Посковой индекс"',
    ],
    'searchindexFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Посковой индекс"',
        'children' => [
            'searchindexView',
            'searchindexCreate',
            'searchindexUpdate',
            'searchindexDelete',
        ],
    ],
    'serviceView' => [
        'type' => 2,
        'description' => 'Просмотр "Услуги"',
    ],
    'serviceCreate' => [
        'type' => 2,
        'description' => 'Добавление "Услуги"',
        'children' => [
            'serviceView',
        ],
    ],
    'serviceUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Услуги"',
        'children' => [
            'serviceView',
        ],
    ],
    'serviceDelete' => [
        'type' => 2,
        'description' => 'Удаление "Услуги"',
        'children' => [
            'serviceView',
            'serviceFileRemove',
        ],
    ],
    'serviceFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Услуги"',
    ],
    'serviceFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Услуги"',
        'children' => [
            'serviceView',
            'serviceCreate',
            'serviceUpdate',
            'serviceDelete',
        ],
    ],
    'servicecenterView' => [
        'type' => 2,
        'description' => 'Просмотр "Сервисные центры"',
    ],
    'servicecenterCreate' => [
        'type' => 2,
        'description' => 'Добавление "Сервисные центры"',
        'children' => [
            'servicecenterView',
        ],
    ],
    'servicecenterUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Сервисные центры"',
        'children' => [
            'servicecenterView',
        ],
    ],
    'servicecenterDelete' => [
        'type' => 2,
        'description' => 'Удаление "Сервисные центры"',
        'children' => [
            'servicecenterView',
            'servicecenterFileRemove',
        ],
    ],
    'servicecenterFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Сервисные центры"',
    ],
    'servicecenterFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Сервисные центры"',
        'children' => [
            'servicecenterView',
            'servicecenterCreate',
            'servicecenterUpdate',
            'servicecenterDelete',
        ],
    ],
    'servicecontrolView' => [
        'type' => 2,
        'description' => 'Просмотр "Услуги (управление услугами)"',
    ],
    'servicecontrolCreate' => [
        'type' => 2,
        'description' => 'Добавление "Услуги (управление услугами)"',
        'children' => [
            'servicecontrolView',
        ],
    ],
    'servicecontrolUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Услуги (управление услугами)"',
        'children' => [
            'servicecontrolView',
        ],
    ],
    'servicecontrolDelete' => [
        'type' => 2,
        'description' => 'Удаление "Услуги (управление услугами)"',
        'children' => [
            'servicecontrolView',
            'servicecontrolFileRemove',
        ],
    ],
    'servicecontrolFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Услуги (управление услугами)"',
    ],
    'servicecontrolFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Услуги (управление услугами)"',
        'children' => [
            'servicecontrolView',
            'servicecontrolCreate',
            'servicecontrolUpdate',
            'servicecontrolDelete',
        ],
    ],
    'settingView' => [
        'type' => 2,
        'description' => 'Просмотр "Настройки"',
    ],
    'settingCreate' => [
        'type' => 2,
        'description' => 'Добавление "Настройки"',
        'children' => [
            'settingView',
        ],
    ],
    'settingUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Настройки"',
        'children' => [
            'settingView',
        ],
    ],
    'settingDelete' => [
        'type' => 2,
        'description' => 'Удаление "Настройки"',
        'children' => [
            'settingView',
            'settingFileRemove',
        ],
    ],
    'settingFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Настройки"',
    ],
    'settingFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Настройки"',
        'children' => [
            'settingView',
            'settingCreate',
            'settingUpdate',
            'settingDelete',
        ],
    ],
    'streetView' => [
        'type' => 2,
        'description' => 'Просмотр "Улицы"',
    ],
    'streetCreate' => [
        'type' => 2,
        'description' => 'Добавление "Улицы"',
        'children' => [
            'streetView',
        ],
    ],
    'streetUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Улицы"',
        'children' => [
            'streetView',
        ],
    ],
    'streetDelete' => [
        'type' => 2,
        'description' => 'Удаление "Улицы"',
        'children' => [
            'streetView',
            'streetFileRemove',
        ],
    ],
    'streetFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Улицы"',
    ],
    'streetFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Улицы"',
        'children' => [
            'streetView',
            'streetCreate',
            'streetUpdate',
            'streetDelete',
        ],
    ],
    'streettemplateView' => [
        'type' => 2,
        'description' => 'Просмотр "Шаблон адресной страницы"',
    ],
    'streettemplateCreate' => [
        'type' => 2,
        'description' => 'Добавление "Шаблон адресной страницы"',
        'children' => [
            'streettemplateView',
        ],
    ],
    'streettemplateUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Шаблон адресной страницы"',
        'children' => [
            'streettemplateView',
        ],
    ],
    'streettemplateDelete' => [
        'type' => 2,
        'description' => 'Удаление "Шаблон адресной страницы"',
        'children' => [
            'streettemplateView',
            'streettemplateFileRemove',
        ],
    ],
    'streettemplateFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Шаблон адресной страницы"',
    ],
    'streettemplateFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Шаблон адресной страницы"',
        'children' => [
            'streettemplateView',
            'streettemplateCreate',
            'streettemplateUpdate',
            'streettemplateDelete',
        ],
    ],
    'streetpageView' => [
        'type' => 2,
        'description' => 'Просмотр "Адресные страницы"',
    ],
    'streetpageCreate' => [
        'type' => 2,
        'description' => 'Добавление "Адресные страницы"',
        'children' => [
            'streetpageView',
        ],
    ],
    'streetpageUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Адресные страницы"',
        'children' => [
            'streetpageView',
        ],
    ],
    'streetpageDelete' => [
        'type' => 2,
        'description' => 'Удаление "Адресные страницы"',
        'children' => [
            'streetpageView',
            'streetpageFileRemove',
        ],
    ],
    'streetpageFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Адресные страницы"',
    ],
    'streetpageFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Адресные страницы"',
        'children' => [
            'streetpageView',
            'streetpageCreate',
            'streetpageUpdate',
            'streetpageDelete',
        ],
    ],
    'tagView' => [
        'type' => 2,
        'description' => 'Просмотр "Теги"',
    ],
    'tagCreate' => [
        'type' => 2,
        'description' => 'Добавление "Теги"',
        'children' => [
            'tagView',
        ],
    ],
    'tagUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Теги"',
        'children' => [
            'tagView',
        ],
    ],
    'tagDelete' => [
        'type' => 2,
        'description' => 'Удаление "Теги"',
        'children' => [
            'tagView',
            'tagFileRemove',
        ],
    ],
    'tagFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Теги"',
    ],
    'tagFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Теги"',
        'children' => [
            'tagView',
            'tagCreate',
            'tagUpdate',
            'tagDelete',
        ],
    ],
    'userView' => [
        'type' => 2,
        'description' => 'Просмотр "Пользователи"',
    ],
    'userCreate' => [
        'type' => 2,
        'description' => 'Добавление "Пользователи"',
        'children' => [
            'userView',
        ],
    ],
    'userUpdate' => [
        'type' => 2,
        'description' => 'Редактирование "Пользователи"',
        'children' => [
            'userView',
        ],
    ],
    'userDelete' => [
        'type' => 2,
        'description' => 'Удаление "Пользователи"',
        'children' => [
            'userView',
            'userFileRemove',
        ],
    ],
    'userFileRemove' => [
        'type' => 2,
        'description' => 'Удаление файлов "Пользователи"',
    ],
    'userFull' => [
        'type' => 2,
        'description' => 'Полный доступ "Пользователи"',
        'children' => [
            'userView',
            'userCreate',
            'userUpdate',
            'userDelete',
        ],
    ],
    'user' => [
        'type' => 1,
        'description' => 'Пользователь',
        'ruleName' => 'userRole',
    ],
    'manager' => [
        'type' => 1,
        'description' => 'Менеджер',
        'ruleName' => 'userRole',
        'children' => [
            'adminPanel',
            'bannerView',
            'blocktechnicalView',
            'cityView',
            'menuView',
            'masterView',
            'pageView',
            'partnerView',
            'partnercontactView',
            'priceView',
            'pricesectionView',
            'pricetableView',
            'pricetablehtmlView',
            'requestView',
            'redirectView',
            'reviewView',
            'searchindexView',
            'settingView',
            'tagView',
            'userView',
        ],
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Администратор',
        'ruleName' => 'userRole',
        'children' => [
            'adminPanel',
            'ElfinderFull',
            'bannerFull',
            'blocktechnicalCreate',
            'blocktechnicalUpdate',
            'cityFull',
            'menuFull',
            'masterFull',
            'pageFull',
            'partnerFull',
            'partnercontactFull',
            'priceFull',
            'pricesectionFull',
            'pricetableFull',
            'pricetablehtmlFull',
            'requestDelete',
            'redirectFull',
            'reviewFull',
            'searchindexView',
            'settingFull',
            'tagFull',
            'userFull',
        ],
    ],
];

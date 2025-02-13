<?php

return [

    // Роли пользователей
    'user_roles' => array(
        '1' => 'Пользователь',
        // '2' => 'Менеджер',
    	'99' => 'Администратор',
    ),
    
    // Расположение тегов в шаблоне
    'tag_disposition' => array(
        '1' => 'В начале HEAD',
        '2' => 'В конце HEAD',
        '3' => 'В начале BODY',
        '4' => 'В конце BODY',
    ),

    // типы цен
    'price_types' => array(
        '2' => 'Обычные',
        '1' => 'Московские',
    ),

    // шаблоны страниц
    'templates' => array(
        '0' => [
            'name' => 'Шаблон по умолчанию',
            'file' => 'default',
        ],
        '1' => [
            'name' => 'Главная',
            'file' => 'front-page',
        ],
        '2' => [
            'name' => 'Услуга',
            'file' => 'page-service',
        ],
        '3' => [
            'name' => 'Анкета жена на час',
            'file' => 'page-anketa-zhena',
        ],
        '4' => [
            'name' => 'Анкета',
            'file' => 'page-anketa',
        ],
        '5' => [
            'name' => 'Калькулятор',
            'file' => 'page-calc',
        ],
        '6' => [
            'name' => 'Защищенная страница',
            'file' => 'page-protected',
        ],
        '7' => [
            'name' => 'Отзывы',
            'file' => 'page-reviews',
        ],
        '8' => [
            'name' => 'Вакансии',
            'file' => 'page-vakansii',
        ],
        '9' => [
            'name' => 'Список мастеров',
            'file' => 'page-master-list',
        ],
        '10' => [
            'name' => 'Согласие',
            'file' => 'page-soglasie',
        ],
        '11' => [
            'name' => 'Политика',
            'file' => 'page-privacy-policy',
        ],
        '12' => [
            'name' => 'Список метро',
            'file' => 'page-metro-list',
        ],
        '13' => [
            'name' => 'Список улиц',
            'file' => 'page-street-list',
        ],
        '14' => [
            'name' => 'Станция метро',
            'file' => 'page-metro',
        ],
        '15' => [
            'name' => 'Улица',
            'file' => 'page-street',
        ],
        '16' => [
            'name' => 'Список статей',
            'file' => 'page-article-list',
        ],
        '17' => [
            'name' => 'Статья',
            'file' => 'page-article',
        ],
        '18' => [
            'name' => 'Страница мастера',
            'file' => 'page-master',
        ],
        '19' => [
            'name' => 'Цены',
            'file' => 'tseny',
        ],
        '20' => [
            'name' => 'Статья view',
            'file' => 'news-view',
        ],
    ),

    // уровень домена
    'domain-level' => 2,

    'currency-symbol' => '<span class="rub">₽</span>',

    // поправочный коэффициент для сортировки улиц
    'street-srand' => 1000000,
];
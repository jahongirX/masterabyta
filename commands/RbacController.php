<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\rbac\UserRoleRule;


class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Удаляем старые данные
        $auth->removeAll();

        // Права для доступа к админке

        $adminPanel = $auth->createPermission('adminPanel');
        $adminPanel->description = 'Админ панель';
        $auth->add($adminPanel);



        // Права для доступа к файловому менеджеру

        $ElfinderFull = $auth->createPermission('ElfinderFull');
        $ElfinderFull->description = 'Elfinder';
        $auth->add($ElfinderFull);



        // Права для работы с "Баннеры"

        $bannerView = $auth->createPermission('bannerView');
        $bannerView->description = 'Просмотр "Баннеры"';
        $auth->add($bannerView);

        $bannerCreate = $auth->createPermission('bannerCreate');
        $bannerCreate->description = 'Добавление "Баннеры"';
        $auth->add($bannerCreate);

        $bannerUpdate = $auth->createPermission('bannerUpdate');
        $bannerUpdate->description = 'Редактирование "Баннеры"';
        $auth->add($bannerUpdate);

        $bannerDelete = $auth->createPermission('bannerDelete');
        $bannerDelete->description = 'Удаление "Баннеры"';
        $auth->add($bannerDelete);

        $bannerFileRemove = $auth->createPermission('bannerFileRemove');
        $bannerFileRemove->description = 'Удаление файлов "Баннеры"';
        $auth->add($bannerFileRemove);

        $bannerFull = $auth->createPermission('bannerFull');
        $bannerFull->description = 'Полный доступ "Баннеры"';
        $auth->add($bannerFull);

        $auth->addChild($bannerCreate, $bannerView);
        $auth->addChild($bannerUpdate, $bannerView);
        $auth->addChild($bannerDelete, $bannerView);
        $auth->addChild($bannerDelete, $bannerFileRemove);

        $auth->addChild($bannerFull, $bannerView);
        $auth->addChild($bannerFull, $bannerCreate);
        $auth->addChild($bannerFull, $bannerUpdate);
        $auth->addChild($bannerFull, $bannerDelete);



        // Права для работы с "Блоки"

        $blockView = $auth->createPermission('blockView');
        $blockView->description = 'Просмотр "Блоки"';
        $auth->add($blockView);

        $blockCreate = $auth->createPermission('blockCreate');
        $blockCreate->description = 'Добавление "Блоки"';
        $auth->add($blockCreate);

        $blockUpdate = $auth->createPermission('blockUpdate');
        $blockUpdate->description = 'Редактирование "Блоки"';
        $auth->add($blockUpdate);

        $blockDelete = $auth->createPermission('blockDelete');
        $blockDelete->description = 'Удаление "Блоки"';
        $auth->add($blockDelete);

        $blockFileRemove = $auth->createPermission('blockFileRemove');
        $blockFileRemove->description = 'Удаление файлов "Блоки"';
        $auth->add($blockFileRemove);

        $blockFull = $auth->createPermission('blockFull');
        $blockFull->description = 'Полный доступ "Блоки"';
        $auth->add($blockFull);

        $auth->addChild($blockCreate, $blockView);
        $auth->addChild($blockUpdate, $blockView);
        $auth->addChild($blockDelete, $blockView);
        $auth->addChild($blockDelete, $blockFileRemove);

        $auth->addChild($blockFull, $blockView);
        $auth->addChild($blockFull, $blockCreate);
        $auth->addChild($blockFull, $blockUpdate);
        $auth->addChild($blockFull, $blockDelete);



        // Права для работы с "Уникальные блоки"

        $blockuniqueView = $auth->createPermission('blockuniqueView');
        $blockuniqueView->description = 'Просмотр "Уникальные блоки"';
        $auth->add($blockuniqueView);

        $blockuniqueCreate = $auth->createPermission('blockuniqueCreate');
        $blockuniqueCreate->description = 'Добавление "Уникальные блоки"';
        $auth->add($blockuniqueCreate);

        $blockuniqueUpdate = $auth->createPermission('blockuniqueUpdate');
        $blockuniqueUpdate->description = 'Редактирование "Уникальные блоки"';
        $auth->add($blockuniqueUpdate);

        $blockuniqueDelete = $auth->createPermission('blockuniqueDelete');
        $blockuniqueDelete->description = 'Удаление "Уникальные блоки"';
        $auth->add($blockuniqueDelete);

        $blockuniqueFileRemove = $auth->createPermission('blockuniqueFileRemove');
        $blockuniqueFileRemove->description = 'Удаление файлов "Уникальные блоки"';
        $auth->add($blockuniqueFileRemove);

        $blockuniqueFull = $auth->createPermission('blockuniqueFull');
        $blockuniqueFull->description = 'Полный доступ "Уникальные блоки"';
        $auth->add($blockuniqueFull);

        $auth->addChild($blockuniqueCreate, $blockuniqueView);
        $auth->addChild($blockuniqueUpdate, $blockuniqueView);
        $auth->addChild($blockuniqueDelete, $blockuniqueView);
        $auth->addChild($blockuniqueDelete, $blockuniqueFileRemove);

        $auth->addChild($blockuniqueFull, $blockuniqueView);
        $auth->addChild($blockuniqueFull, $blockuniqueCreate);
        $auth->addChild($blockuniqueFull, $blockuniqueUpdate);
        $auth->addChild($blockuniqueFull, $blockuniqueDelete);



        // Права для работы с "Технические блоки"

        $blocktechnicalView = $auth->createPermission('blocktechnicalView');
        $blocktechnicalView->description = 'Просмотр "Технические блоки"';
        $auth->add($blocktechnicalView);

        $blocktechnicalCreate = $auth->createPermission('blocktechnicalCreate');
        $blocktechnicalCreate->description = 'Добавление "Технические блоки"';
        $auth->add($blocktechnicalCreate);

        $blocktechnicalUpdate = $auth->createPermission('blocktechnicalUpdate');
        $blocktechnicalUpdate->description = 'Редактирование "Технические блоки"';
        $auth->add($blocktechnicalUpdate);

        $blocktechnicalDelete = $auth->createPermission('blocktechnicalDelete');
        $blocktechnicalDelete->description = 'Удаление "Технические блоки"';
        $auth->add($blocktechnicalDelete);

        $blocktechnicalFileRemove = $auth->createPermission('blocktechnicalFileRemove');
        $blocktechnicalFileRemove->description = 'Удаление файлов "Технические блоки"';
        $auth->add($blocktechnicalFileRemove);

        $blocktechnicalFull = $auth->createPermission('blocktechnicalFull');
        $blocktechnicalFull->description = 'Полный доступ "Технические блоки"';
        $auth->add($blocktechnicalFull);

        $auth->addChild($blocktechnicalCreate, $blocktechnicalView);
        $auth->addChild($blocktechnicalUpdate, $blocktechnicalView);
        $auth->addChild($blocktechnicalDelete, $blocktechnicalView);
        $auth->addChild($blocktechnicalDelete, $blocktechnicalFileRemove);

        $auth->addChild($blocktechnicalFull, $blocktechnicalView);
        $auth->addChild($blocktechnicalFull, $blocktechnicalCreate);
        $auth->addChild($blocktechnicalFull, $blocktechnicalUpdate);
        $auth->addChild($blocktechnicalFull, $blocktechnicalDelete);



        // Права для работы с "Категории"

        $categoryView = $auth->createPermission('categoryView');
        $categoryView->description = 'Просмотр "Категории"';
        $auth->add($categoryView);

        $categoryCreate = $auth->createPermission('categoryCreate');
        $categoryCreate->description = 'Добавление "Категории"';
        $auth->add($categoryCreate);

        $categoryUpdate = $auth->createPermission('categoryUpdate');
        $categoryUpdate->description = 'Редактирование "Категории"';
        $auth->add($categoryUpdate);

        $categoryDelete = $auth->createPermission('categoryDelete');
        $categoryDelete->description = 'Удаление "Категории"';
        $auth->add($categoryDelete);

        $categoryFileRemove = $auth->createPermission('categoryFileRemove');
        $categoryFileRemove->description = 'Удаление файлов "Категории"';
        $auth->add($categoryFileRemove);

        $categoryFull = $auth->createPermission('categoryFull');
        $categoryFull->description = 'Полный доступ "Категории"';
        $auth->add($categoryFull);

        $auth->addChild($categoryCreate, $categoryView);
        $auth->addChild($categoryUpdate, $categoryView);
        $auth->addChild($categoryDelete, $categoryView);
        $auth->addChild($categoryDelete, $categoryFileRemove);

        $auth->addChild($categoryFull, $categoryView);
        $auth->addChild($categoryFull, $categoryCreate);
        $auth->addChild($categoryFull, $categoryUpdate);
        $auth->addChild($categoryFull, $categoryDelete);



        // Права для работы с "Города"

        $cityView = $auth->createPermission('cityView');
        $cityView->description = 'Просмотр "Города"';
        $auth->add($cityView);

        $cityCreate = $auth->createPermission('cityCreate');
        $cityCreate->description = 'Добавление "Города"';
        $auth->add($cityCreate);

        $cityUpdate = $auth->createPermission('cityUpdate');
        $cityUpdate->description = 'Редактирование "Города"';
        $auth->add($cityUpdate);

        $cityDelete = $auth->createPermission('cityDelete');
        $cityDelete->description = 'Удаление "Города"';
        $auth->add($cityDelete);

        $cityFileRemove = $auth->createPermission('cityFileRemove');
        $cityFileRemove->description = 'Удаление файлов "Города"';
        $auth->add($cityFileRemove);

        $cityFull = $auth->createPermission('cityFull');
        $cityFull->description = 'Полный доступ "Города"';
        $auth->add($cityFull);

        $auth->addChild($cityCreate, $cityView);
        $auth->addChild($cityUpdate, $cityView);
        $auth->addChild($cityDelete, $cityView);
        $auth->addChild($cityDelete, $cityFileRemove);

        $auth->addChild($cityFull, $cityView);
        $auth->addChild($cityFull, $cityCreate);
        $auth->addChild($cityFull, $cityUpdate);
        $auth->addChild($cityFull, $cityDelete);



        // Права для работы с "Контент"

        $contentView = $auth->createPermission('contentView');
        $contentView->description = 'Просмотр "Контент"';
        $auth->add($contentView);

        $contentCreate = $auth->createPermission('contentCreate');
        $contentCreate->description = 'Добавление "Контент"';
        $auth->add($contentCreate);

        $contentUpdate = $auth->createPermission('contentUpdate');
        $contentUpdate->description = 'Редактирование "Контент"';
        $auth->add($contentUpdate);

        $contentDelete = $auth->createPermission('contentDelete');
        $contentDelete->description = 'Удаление "Контент"';
        $auth->add($contentDelete);

        $contentFileRemove = $auth->createPermission('contentFileRemove');
        $contentFileRemove->description = 'Удаление файлов "Контент"';
        $auth->add($contentFileRemove);

        $contentFull = $auth->createPermission('contentFull');
        $contentFull->description = 'Полный доступ "Контент"';
        $auth->add($contentFull);

        $auth->addChild($contentCreate, $contentView);
        $auth->addChild($contentUpdate, $contentView);
        $auth->addChild($contentDelete, $contentView);
        $auth->addChild($contentDelete, $contentFileRemove);

        $auth->addChild($contentFull, $contentView);
        $auth->addChild($contentFull, $contentCreate);
        $auth->addChild($contentFull, $contentUpdate);
        $auth->addChild($contentFull, $contentDelete);



        // Права для работы с "Меню"

        $menuView = $auth->createPermission('menuView');
        $menuView->description = 'Просмотр "Меню"';
        $auth->add($menuView);

        $menuCreate = $auth->createPermission('menuCreate');
        $menuCreate->description = 'Добавление "Меню"';
        $auth->add($menuCreate);

        $menuUpdate = $auth->createPermission('menuUpdate');
        $menuUpdate->description = 'Редактирование "Меню"';
        $auth->add($menuUpdate);

        $menuDelete = $auth->createPermission('menuDelete');
        $menuDelete->description = 'Удаление "Меню"';
        $auth->add($menuDelete);

        $menuFileRemove = $auth->createPermission('menuFileRemove');
        $menuFileRemove->description = 'Удаление файлов "Меню"';
        $auth->add($menuFileRemove);

        $menuFull = $auth->createPermission('menuFull');
        $menuFull->description = 'Полный доступ "Меню"';
        $auth->add($menuFull);

        $auth->addChild($menuCreate, $menuView);
        $auth->addChild($menuUpdate, $menuView);
        $auth->addChild($menuDelete, $menuView);
        $auth->addChild($menuDelete, $menuFileRemove);

        $auth->addChild($menuFull, $menuView);
        $auth->addChild($menuFull, $menuCreate);
        $auth->addChild($menuFull, $menuUpdate);
        $auth->addChild($menuFull, $menuDelete);



        // Права для работы с "Мастер"

        $masterView = $auth->createPermission('masterView');
        $masterView->description = 'Просмотр "Мастер"';
        $auth->add($masterView);

        $masterCreate = $auth->createPermission('masterCreate');
        $masterCreate->description = 'Добавление "Мастер"';
        $auth->add($masterCreate);

        $masterUpdate = $auth->createPermission('masterUpdate');
        $masterUpdate->description = 'Редактирование "Мастер"';
        $auth->add($masterUpdate);

        $masterDelete = $auth->createPermission('masterDelete');
        $masterDelete->description = 'Удаление "Мастер"';
        $auth->add($masterDelete);

        $masterFileRemove = $auth->createPermission('masterFileRemove');
        $masterFileRemove->description = 'Удаление файлов "Мастер"';
        $auth->add($masterFileRemove);

        $masterFull = $auth->createPermission('masterFull');
        $masterFull->description = 'Полный доступ "Мастер"';
        $auth->add($masterFull);

        $auth->addChild($masterCreate, $masterView);
        $auth->addChild($masterUpdate, $masterView);
        $auth->addChild($masterDelete, $masterView);
        $auth->addChild($masterDelete, $masterFileRemove);

        $auth->addChild($masterFull, $masterView);
        $auth->addChild($masterFull, $masterCreate);
        $auth->addChild($masterFull, $masterUpdate);
        $auth->addChild($masterFull, $masterDelete);



        // Права для работы с "Страницы"

        $pageView = $auth->createPermission('pageView');
        $pageView->description = 'Просмотр "Страницы"';
        $auth->add($pageView);

        $pageCreate = $auth->createPermission('pageCreate');
        $pageCreate->description = 'Добавление "Страницы"';
        $auth->add($pageCreate);

        $pageUpdate = $auth->createPermission('pageUpdate');
        $pageUpdate->description = 'Редактирование "Страницы"';
        $auth->add($pageUpdate);

        $pageDelete = $auth->createPermission('pageDelete');
        $pageDelete->description = 'Удаление "Страницы"';
        $auth->add($pageDelete);

        $pageFileRemove = $auth->createPermission('pageFileRemove');
        $pageFileRemove->description = 'Удаление файлов "Страницы"';
        $auth->add($pageFileRemove);

        $pageFull = $auth->createPermission('pageFull');
        $pageFull->description = 'Полный доступ "Страницы"';
        $auth->add($pageFull);

        $auth->addChild($pageCreate, $pageView);
        $auth->addChild($pageUpdate, $pageView);
        $auth->addChild($pageDelete, $pageView);
        $auth->addChild($pageDelete, $pageFileRemove);

        $auth->addChild($pageFull, $pageView);
        $auth->addChild($pageFull, $pageCreate);
        $auth->addChild($pageFull, $pageUpdate);
        $auth->addChild($pageFull, $pageDelete);



        // Права для работы с "Партнеры"

        $partnerView = $auth->createPermission('partnerView');
        $partnerView->description = 'Просмотр "Партнеры"';
        $auth->add($partnerView);

        $partnerCreate = $auth->createPermission('partnerCreate');
        $partnerCreate->description = 'Добавление "Партнеры"';
        $auth->add($partnerCreate);

        $partnerUpdate = $auth->createPermission('partnerUpdate');
        $partnerUpdate->description = 'Редактирование "Партнеры"';
        $auth->add($partnerUpdate);

        $partnerDelete = $auth->createPermission('partnerDelete');
        $partnerDelete->description = 'Удаление "Партнеры"';
        $auth->add($partnerDelete);

        $partnerFileRemove = $auth->createPermission('partnerFileRemove');
        $partnerFileRemove->description = 'Удаление файлов "Партнеры"';
        $auth->add($partnerFileRemove);

        $partnerFull = $auth->createPermission('partnerFull');
        $partnerFull->description = 'Полный доступ "Партнеры"';
        $auth->add($partnerFull);

        $auth->addChild($partnerCreate, $partnerView);
        $auth->addChild($partnerUpdate, $partnerView);
        $auth->addChild($partnerDelete, $partnerView);
        $auth->addChild($partnerDelete, $partnerFileRemove);

        $auth->addChild($partnerFull, $partnerView);
        $auth->addChild($partnerFull, $partnerCreate);
        $auth->addChild($partnerFull, $partnerUpdate);
        $auth->addChild($partnerFull, $partnerDelete);



        // Права для работы с "Контакты партнеров"

        $partnercontactView = $auth->createPermission('partnercontactView');
        $partnercontactView->description = 'Просмотр "Контакты партнеров"';
        $auth->add($partnercontactView);

        $partnercontactCreate = $auth->createPermission('partnercontactCreate');
        $partnercontactCreate->description = 'Добавление "Контакты партнеров"';
        $auth->add($partnercontactCreate);

        $partnercontactUpdate = $auth->createPermission('partnercontactUpdate');
        $partnercontactUpdate->description = 'Редактирование "Контакты партнеров"';
        $auth->add($partnercontactUpdate);

        $partnercontactDelete = $auth->createPermission('partnercontactDelete');
        $partnercontactDelete->description = 'Удаление "Контакты партнеров"';
        $auth->add($partnercontactDelete);

        $partnercontactFileRemove = $auth->createPermission('partnercontactFileRemove');
        $partnercontactFileRemove->description = 'Удаление файлов "Контакты партнеров"';
        $auth->add($partnercontactFileRemove);

        $partnercontactFull = $auth->createPermission('partnercontactFull');
        $partnercontactFull->description = 'Полный доступ "Контакты партнеров"';
        $auth->add($partnercontactFull);

        $auth->addChild($partnercontactCreate, $partnercontactView);
        $auth->addChild($partnercontactUpdate, $partnercontactView);
        $auth->addChild($partnercontactDelete, $partnercontactView);
        $auth->addChild($partnercontactDelete, $partnercontactFileRemove);

        $auth->addChild($partnercontactFull, $partnercontactView);
        $auth->addChild($partnercontactFull, $partnercontactCreate);
        $auth->addChild($partnercontactFull, $partnercontactUpdate);
        $auth->addChild($partnercontactFull, $partnercontactDelete);



        // Права для работы с "Цены"

        $priceView = $auth->createPermission('priceView');
        $priceView->description = 'Просмотр "Цены"';
        $auth->add($priceView);

        $priceCreate = $auth->createPermission('priceCreate');
        $priceCreate->description = 'Добавление "Цены"';
        $auth->add($priceCreate);

        $priceUpdate = $auth->createPermission('priceUpdate');
        $priceUpdate->description = 'Редактирование "Цены"';
        $auth->add($priceUpdate);

        $priceDelete = $auth->createPermission('priceDelete');
        $priceDelete->description = 'Удаление "Цены"';
        $auth->add($priceDelete);

        $priceFileRemove = $auth->createPermission('priceFileRemove');
        $priceFileRemove->description = 'Удаление файлов "Цены"';
        $auth->add($priceFileRemove);

        $priceFull = $auth->createPermission('priceFull');
        $priceFull->description = 'Полный доступ "Цены"';
        $auth->add($priceFull);

        $auth->addChild($priceCreate, $priceView);
        $auth->addChild($priceUpdate, $priceView);
        $auth->addChild($priceDelete, $priceView);
        $auth->addChild($priceDelete, $priceFileRemove);

        $auth->addChild($priceFull, $priceView);
        $auth->addChild($priceFull, $priceCreate);
        $auth->addChild($priceFull, $priceUpdate);
        $auth->addChild($priceFull, $priceDelete);



        // Права для работы с "Разделы прайса"

        $pricesectionView = $auth->createPermission('pricesectionView');
        $pricesectionView->description = 'Просмотр "Разделы прайса"';
        $auth->add($pricesectionView);

        $pricesectionCreate = $auth->createPermission('pricesectionCreate');
        $pricesectionCreate->description = 'Добавление "Разделы прайса"';
        $auth->add($pricesectionCreate);

        $pricesectionUpdate = $auth->createPermission('pricesectionUpdate');
        $pricesectionUpdate->description = 'Редактирование "Разделы прайса"';
        $auth->add($pricesectionUpdate);

        $pricesectionDelete = $auth->createPermission('pricesectionDelete');
        $pricesectionDelete->description = 'Удаление "Разделы прайса"';
        $auth->add($pricesectionDelete);

        $pricesectionFileRemove = $auth->createPermission('pricesectionFileRemove');
        $pricesectionFileRemove->description = 'Удаление файлов "Разделы прайса"';
        $auth->add($pricesectionFileRemove);

        $pricesectionFull = $auth->createPermission('pricesectionFull');
        $pricesectionFull->description = 'Полный доступ "Разделы прайса"';
        $auth->add($pricesectionFull);

        $auth->addChild($pricesectionCreate, $pricesectionView);
        $auth->addChild($pricesectionUpdate, $pricesectionView);
        $auth->addChild($pricesectionDelete, $pricesectionView);
        $auth->addChild($pricesectionDelete, $pricesectionFileRemove);

        $auth->addChild($pricesectionFull, $pricesectionView);
        $auth->addChild($pricesectionFull, $pricesectionCreate);
        $auth->addChild($pricesectionFull, $pricesectionUpdate);
        $auth->addChild($pricesectionFull, $pricesectionDelete);



        // Права для работы с "Таблицы цен"

        $pricetableView = $auth->createPermission('pricetableView');
        $pricetableView->description = 'Просмотр "Таблицы цен"';
        $auth->add($pricetableView);

        $pricetableCreate = $auth->createPermission('pricetableCreate');
        $pricetableCreate->description = 'Добавление "Таблицы цен"';
        $auth->add($pricetableCreate);

        $pricetableUpdate = $auth->createPermission('pricetableUpdate');
        $pricetableUpdate->description = 'Редактирование "Таблицы цен"';
        $auth->add($pricetableUpdate);

        $pricetableDelete = $auth->createPermission('pricetableDelete');
        $pricetableDelete->description = 'Удаление "Таблицы цен"';
        $auth->add($pricetableDelete);

        $pricetableFileRemove = $auth->createPermission('pricetableFileRemove');
        $pricetableFileRemove->description = 'Удаление файлов "Таблицы цен"';
        $auth->add($pricetableFileRemove);

        $pricetableFull = $auth->createPermission('pricetableFull');
        $pricetableFull->description = 'Полный доступ "Таблицы цен"';
        $auth->add($pricetableFull);

        $auth->addChild($pricetableCreate, $pricetableView);
        $auth->addChild($pricetableUpdate, $pricetableView);
        $auth->addChild($pricetableDelete, $pricetableView);
        $auth->addChild($pricetableDelete, $pricetableFileRemove);

        $auth->addChild($pricetableFull, $pricetableView);
        $auth->addChild($pricetableFull, $pricetableCreate);
        $auth->addChild($pricetableFull, $pricetableUpdate);
        $auth->addChild($pricetableFull, $pricetableDelete);



        // Права для работы с "Таблицы цен HTML"

        $pricetablehtmlView = $auth->createPermission('pricetablehtmlView');
        $pricetablehtmlView->description = 'Просмотр "Таблицы цен HTML"';
        $auth->add($pricetablehtmlView);

        $pricetablehtmlCreate = $auth->createPermission('pricetablehtmlCreate');
        $pricetablehtmlCreate->description = 'Добавление "Таблицы цен HTML"';
        $auth->add($pricetablehtmlCreate);

        $pricetablehtmlUpdate = $auth->createPermission('pricetablehtmlUpdate');
        $pricetablehtmlUpdate->description = 'Редактирование "Таблицы цен HTML"';
        $auth->add($pricetablehtmlUpdate);

        $pricetablehtmlDelete = $auth->createPermission('pricetablehtmlDelete');
        $pricetablehtmlDelete->description = 'Удаление "Таблицы цен HTML"';
        $auth->add($pricetablehtmlDelete);

        $pricetablehtmlFileRemove = $auth->createPermission('pricetablehtmlFileRemove');
        $pricetablehtmlFileRemove->description = 'Удаление файлов "Таблицы цен HTML"';
        $auth->add($pricetablehtmlFileRemove);

        $pricetablehtmlFull = $auth->createPermission('pricetablehtmlFull');
        $pricetablehtmlFull->description = 'Полный доступ "Таблицы цен HTML"';
        $auth->add($pricetablehtmlFull);

        $auth->addChild($pricetablehtmlCreate, $pricetablehtmlView);
        $auth->addChild($pricetablehtmlUpdate, $pricetablehtmlView);
        $auth->addChild($pricetablehtmlDelete, $pricetablehtmlView);
        $auth->addChild($pricetablehtmlDelete, $pricetablehtmlFileRemove);

        $auth->addChild($pricetablehtmlFull, $pricetablehtmlView);
        $auth->addChild($pricetablehtmlFull, $pricetablehtmlCreate);
        $auth->addChild($pricetablehtmlFull, $pricetablehtmlUpdate);
        $auth->addChild($pricetablehtmlFull, $pricetablehtmlDelete);



        // Права для работы с "Товары"

        $redirectView = $auth->createPermission('redirectView');
        $redirectView->description = 'Просмотр "Переадресации"';
        $auth->add($redirectView);

        $redirectCreate = $auth->createPermission('redirectCreate');
        $redirectCreate->description = 'Добавление "Переадресации"';
        $auth->add($redirectCreate);

        $redirectUpdate = $auth->createPermission('redirectUpdate');
        $redirectUpdate->description = 'Редактирование "Переадресации"';
        $auth->add($redirectUpdate);

        $redirectDelete = $auth->createPermission('redirectDelete');
        $redirectDelete->description = 'Удаление "Переадресации"';
        $auth->add($redirectDelete);

        $redirectFileRemove = $auth->createPermission('redirectFileRemove');
        $redirectFileRemove->description = 'Удаление файлов "Переадресации"';
        $auth->add($redirectFileRemove);

        $redirectFull = $auth->createPermission('redirectFull');
        $redirectFull->description = 'Полный доступ "Переадресации"';
        $auth->add($redirectFull);

        $auth->addChild($redirectCreate, $redirectView);
        $auth->addChild($redirectUpdate, $redirectView);
        $auth->addChild($redirectDelete, $redirectView);
        $auth->addChild($redirectDelete, $redirectFileRemove);

        $auth->addChild($redirectFull, $redirectView);
        $auth->addChild($redirectFull, $redirectCreate);
        $auth->addChild($redirectFull, $redirectUpdate);
        $auth->addChild($redirectFull, $redirectDelete);



        // Права для работы с "Заявки"

        $requestView = $auth->createPermission('requestView');
        $requestView->description = 'Просмотр "Заявки"';
        $auth->add($requestView);

        $requestCreate = $auth->createPermission('requestCreate');
        $requestCreate->description = 'Добавление "Заявки"';
        $auth->add($requestCreate);

        $requestUpdate = $auth->createPermission('requestUpdate');
        $requestUpdate->description = 'Редактирование "Заявки"';
        $auth->add($requestUpdate);

        $requestDelete = $auth->createPermission('requestDelete');
        $requestDelete->description = 'Удаление "Заявки"';
        $auth->add($requestDelete);

        $requestFileRemove = $auth->createPermission('requestFileRemove');
        $requestFileRemove->description = 'Удаление файлов "Заявки"';
        $auth->add($requestFileRemove);

        $requestFull = $auth->createPermission('requestFull');
        $requestFull->description = 'Полный доступ "Заявки"';
        $auth->add($requestFull);

        $auth->addChild($requestCreate, $requestView);
        $auth->addChild($requestUpdate, $requestView);
        $auth->addChild($requestDelete, $requestView);
        $auth->addChild($requestDelete, $requestFileRemove);

        $auth->addChild($requestFull, $requestView);
        $auth->addChild($requestFull, $requestCreate);
        $auth->addChild($requestFull, $requestUpdate);
        $auth->addChild($requestFull, $requestDelete);



        // Права для работы с "Отзывы"

        $reviewView = $auth->createPermission('reviewView');
        $reviewView->description = 'Просмотр "Отзывы"';
        $auth->add($reviewView);

        $reviewCreate = $auth->createPermission('reviewCreate');
        $reviewCreate->description = 'Добавление "Отзывы"';
        $auth->add($reviewCreate);

        $reviewUpdate = $auth->createPermission('reviewUpdate');
        $reviewUpdate->description = 'Редактирование "Отзывы"';
        $auth->add($reviewUpdate);

        $reviewDelete = $auth->createPermission('reviewDelete');
        $reviewDelete->description = 'Удаление "Отзывы"';
        $auth->add($reviewDelete);

        $reviewFileRemove = $auth->createPermission('reviewFileRemove');
        $reviewFileRemove->description = 'Удаление файлов "Отзывы"';
        $auth->add($reviewFileRemove);

        $reviewFull = $auth->createPermission('reviewFull');
        $reviewFull->description = 'Полный доступ "Отзывы"';
        $auth->add($reviewFull);

        $auth->addChild($reviewCreate, $reviewView);
        $auth->addChild($reviewUpdate, $reviewView);
        $auth->addChild($reviewDelete, $reviewView);
        $auth->addChild($reviewDelete, $reviewFileRemove);

        $auth->addChild($reviewFull, $reviewView);
        $auth->addChild($reviewFull, $reviewCreate);
        $auth->addChild($reviewFull, $reviewUpdate);
        $auth->addChild($reviewFull, $reviewDelete);



        // Права для работы с "Посковой индекс"

        $searchindexView = $auth->createPermission('searchindexView');
        $searchindexView->description = 'Просмотр "Посковой индекс"';
        $auth->add($searchindexView);

        $searchindexCreate = $auth->createPermission('searchindexCreate');
        $searchindexCreate->description = 'Добавление "Посковой индекс"';
        $auth->add($searchindexCreate);

        $searchindexUpdate = $auth->createPermission('searchindexUpdate');
        $searchindexUpdate->description = 'Редактирование "Посковой индекс"';
        $auth->add($searchindexUpdate);

        $searchindexDelete = $auth->createPermission('searchindexDelete');
        $searchindexDelete->description = 'Удаление "Посковой индекс"';
        $auth->add($searchindexDelete);

        $searchindexFileRemove = $auth->createPermission('searchindexFileRemove');
        $searchindexFileRemove->description = 'Удаление файлов "Посковой индекс"';
        $auth->add($searchindexFileRemove);

        $searchindexFull = $auth->createPermission('searchindexFull');
        $searchindexFull->description = 'Полный доступ "Посковой индекс"';
        $auth->add($searchindexFull);

        $auth->addChild($searchindexCreate, $searchindexView);
        $auth->addChild($searchindexUpdate, $searchindexView);
        $auth->addChild($searchindexDelete, $searchindexView);
        $auth->addChild($searchindexDelete, $searchindexFileRemove);

        $auth->addChild($searchindexFull, $searchindexView);
        $auth->addChild($searchindexFull, $searchindexCreate);
        $auth->addChild($searchindexFull, $searchindexUpdate);
        $auth->addChild($searchindexFull, $searchindexDelete);



        // Права для работы с "Услуги"

        $serviceView = $auth->createPermission('serviceView');
        $serviceView->description = 'Просмотр "Услуги"';
        $auth->add($serviceView);

        $serviceCreate = $auth->createPermission('serviceCreate');
        $serviceCreate->description = 'Добавление "Услуги"';
        $auth->add($serviceCreate);

        $serviceUpdate = $auth->createPermission('serviceUpdate');
        $serviceUpdate->description = 'Редактирование "Услуги"';
        $auth->add($serviceUpdate);

        $serviceDelete = $auth->createPermission('serviceDelete');
        $serviceDelete->description = 'Удаление "Услуги"';
        $auth->add($serviceDelete);

        $serviceFileRemove = $auth->createPermission('serviceFileRemove');
        $serviceFileRemove->description = 'Удаление файлов "Услуги"';
        $auth->add($serviceFileRemove);

        $serviceFull = $auth->createPermission('serviceFull');
        $serviceFull->description = 'Полный доступ "Услуги"';
        $auth->add($serviceFull);

        $auth->addChild($serviceCreate, $serviceView);
        $auth->addChild($serviceUpdate, $serviceView);
        $auth->addChild($serviceDelete, $serviceView);
        $auth->addChild($serviceDelete, $serviceFileRemove);

        $auth->addChild($serviceFull, $serviceView);
        $auth->addChild($serviceFull, $serviceCreate);
        $auth->addChild($serviceFull, $serviceUpdate);
        $auth->addChild($serviceFull, $serviceDelete);



        // Права для работы с "Сервисные центры"

        $servicecenterView = $auth->createPermission('servicecenterView');
        $servicecenterView->description = 'Просмотр "Сервисные центры"';
        $auth->add($servicecenterView);

        $servicecenterCreate = $auth->createPermission('servicecenterCreate');
        $servicecenterCreate->description = 'Добавление "Сервисные центры"';
        $auth->add($servicecenterCreate);

        $servicecenterUpdate = $auth->createPermission('servicecenterUpdate');
        $servicecenterUpdate->description = 'Редактирование "Сервисные центры"';
        $auth->add($servicecenterUpdate);

        $servicecenterDelete = $auth->createPermission('servicecenterDelete');
        $servicecenterDelete->description = 'Удаление "Сервисные центры"';
        $auth->add($servicecenterDelete);

        $servicecenterFileRemove = $auth->createPermission('servicecenterFileRemove');
        $servicecenterFileRemove->description = 'Удаление файлов "Сервисные центры"';
        $auth->add($servicecenterFileRemove);

        $servicecenterFull = $auth->createPermission('servicecenterFull');
        $servicecenterFull->description = 'Полный доступ "Сервисные центры"';
        $auth->add($servicecenterFull);

        $auth->addChild($servicecenterCreate, $servicecenterView);
        $auth->addChild($servicecenterUpdate, $servicecenterView);
        $auth->addChild($servicecenterDelete, $servicecenterView);
        $auth->addChild($servicecenterDelete, $servicecenterFileRemove);

        $auth->addChild($servicecenterFull, $servicecenterView);
        $auth->addChild($servicecenterFull, $servicecenterCreate);
        $auth->addChild($servicecenterFull, $servicecenterUpdate);
        $auth->addChild($servicecenterFull, $servicecenterDelete);



        // Права для работы с "Услуги (управление услугами)"

        $servicecontrolView = $auth->createPermission('servicecontrolView');
        $servicecontrolView->description = 'Просмотр "Услуги (управление услугами)"';
        $auth->add($servicecontrolView);

        $servicecontrolCreate = $auth->createPermission('servicecontrolCreate');
        $servicecontrolCreate->description = 'Добавление "Услуги (управление услугами)"';
        $auth->add($servicecontrolCreate);

        $servicecontrolUpdate = $auth->createPermission('servicecontrolUpdate');
        $servicecontrolUpdate->description = 'Редактирование "Услуги (управление услугами)"';
        $auth->add($servicecontrolUpdate);

        $servicecontrolDelete = $auth->createPermission('servicecontrolDelete');
        $servicecontrolDelete->description = 'Удаление "Услуги (управление услугами)"';
        $auth->add($servicecontrolDelete);

        $servicecontrolFileRemove = $auth->createPermission('servicecontrolFileRemove');
        $servicecontrolFileRemove->description = 'Удаление файлов "Услуги (управление услугами)"';
        $auth->add($servicecontrolFileRemove);

        $servicecontrolFull = $auth->createPermission('servicecontrolFull');
        $servicecontrolFull->description = 'Полный доступ "Услуги (управление услугами)"';
        $auth->add($servicecontrolFull);

        $auth->addChild($servicecontrolCreate, $servicecontrolView);
        $auth->addChild($servicecontrolUpdate, $servicecontrolView);
        $auth->addChild($servicecontrolDelete, $servicecontrolView);
        $auth->addChild($servicecontrolDelete, $servicecontrolFileRemove);

        $auth->addChild($servicecontrolFull, $servicecontrolView);
        $auth->addChild($servicecontrolFull, $servicecontrolCreate);
        $auth->addChild($servicecontrolFull, $servicecontrolUpdate);
        $auth->addChild($servicecontrolFull, $servicecontrolDelete);




        // Права для работы с "Настройки"

        $settingView = $auth->createPermission('settingView');
        $settingView->description = 'Просмотр "Настройки"';
        $auth->add($settingView);

        $settingCreate = $auth->createPermission('settingCreate');
        $settingCreate->description = 'Добавление "Настройки"';
        $auth->add($settingCreate);

        $settingUpdate = $auth->createPermission('settingUpdate');
        $settingUpdate->description = 'Редактирование "Настройки"';
        $auth->add($settingUpdate);

        $settingDelete = $auth->createPermission('settingDelete');
        $settingDelete->description = 'Удаление "Настройки"';
        $auth->add($settingDelete);

        $settingFileRemove = $auth->createPermission('settingFileRemove');
        $settingFileRemove->description = 'Удаление файлов "Настройки"';
        $auth->add($settingFileRemove);

        $settingFull = $auth->createPermission('settingFull');
        $settingFull->description = 'Полный доступ "Настройки"';
        $auth->add($settingFull);

        $auth->addChild($settingCreate, $settingView);
        $auth->addChild($settingUpdate, $settingView);
        $auth->addChild($settingDelete, $settingView);
        $auth->addChild($settingDelete, $settingFileRemove);

        $auth->addChild($settingFull, $settingView);
        $auth->addChild($settingFull, $settingCreate);
        $auth->addChild($settingFull, $settingUpdate);
        $auth->addChild($settingFull, $settingDelete);



        // Права для работы с "Улицы"

        $streetView = $auth->createPermission('streetView');
        $streetView->description = 'Просмотр "Улицы"';
        $auth->add($streetView);

        $streetCreate = $auth->createPermission('streetCreate');
        $streetCreate->description = 'Добавление "Улицы"';
        $auth->add($streetCreate);

        $streetUpdate = $auth->createPermission('streetUpdate');
        $streetUpdate->description = 'Редактирование "Улицы"';
        $auth->add($streetUpdate);

        $streetDelete = $auth->createPermission('streetDelete');
        $streetDelete->description = 'Удаление "Улицы"';
        $auth->add($streetDelete);

        $streetFileRemove = $auth->createPermission('streetFileRemove');
        $streetFileRemove->description = 'Удаление файлов "Улицы"';
        $auth->add($streetFileRemove);

        $streetFull = $auth->createPermission('streetFull');
        $streetFull->description = 'Полный доступ "Улицы"';
        $auth->add($streetFull);

        $auth->addChild($streetCreate, $streetView);
        $auth->addChild($streetUpdate, $streetView);
        $auth->addChild($streetDelete, $streetView);
        $auth->addChild($streetDelete, $streetFileRemove);

        $auth->addChild($streetFull, $streetView);
        $auth->addChild($streetFull, $streetCreate);
        $auth->addChild($streetFull, $streetUpdate);
        $auth->addChild($streetFull, $streetDelete);



        // Права для работы с "Шаблон адресной страницы"

        $streettemplateView = $auth->createPermission('streettemplateView');
        $streettemplateView->description = 'Просмотр "Шаблон адресной страницы"';
        $auth->add($streettemplateView);

        $streettemplateCreate = $auth->createPermission('streettemplateCreate');
        $streettemplateCreate->description = 'Добавление "Шаблон адресной страницы"';
        $auth->add($streettemplateCreate);

        $streettemplateUpdate = $auth->createPermission('streettemplateUpdate');
        $streettemplateUpdate->description = 'Редактирование "Шаблон адресной страницы"';
        $auth->add($streettemplateUpdate);

        $streettemplateDelete = $auth->createPermission('streettemplateDelete');
        $streettemplateDelete->description = 'Удаление "Шаблон адресной страницы"';
        $auth->add($streettemplateDelete);

        $streettemplateFileRemove = $auth->createPermission('streettemplateFileRemove');
        $streettemplateFileRemove->description = 'Удаление файлов "Шаблон адресной страницы"';
        $auth->add($streettemplateFileRemove);

        $streettemplateFull = $auth->createPermission('streettemplateFull');
        $streettemplateFull->description = 'Полный доступ "Шаблон адресной страницы"';
        $auth->add($streettemplateFull);

        $auth->addChild($streettemplateCreate, $streettemplateView);
        $auth->addChild($streettemplateUpdate, $streettemplateView);
        $auth->addChild($streettemplateDelete, $streettemplateView);
        $auth->addChild($streettemplateDelete, $streettemplateFileRemove);

        $auth->addChild($streettemplateFull, $streettemplateView);
        $auth->addChild($streettemplateFull, $streettemplateCreate);
        $auth->addChild($streettemplateFull, $streettemplateUpdate);
        $auth->addChild($streettemplateFull, $streettemplateDelete);



        // Права для работы с "Адресные страницы"

        $streetpageView = $auth->createPermission('streetpageView');
        $streetpageView->description = 'Просмотр "Адресные страницы"';
        $auth->add($streetpageView);

        $streetpageCreate = $auth->createPermission('streetpageCreate');
        $streetpageCreate->description = 'Добавление "Адресные страницы"';
        $auth->add($streetpageCreate);

        $streetpageUpdate = $auth->createPermission('streetpageUpdate');
        $streetpageUpdate->description = 'Редактирование "Адресные страницы"';
        $auth->add($streetpageUpdate);

        $streetpageDelete = $auth->createPermission('streetpageDelete');
        $streetpageDelete->description = 'Удаление "Адресные страницы"';
        $auth->add($streetpageDelete);

        $streetpageFileRemove = $auth->createPermission('streetpageFileRemove');
        $streetpageFileRemove->description = 'Удаление файлов "Адресные страницы"';
        $auth->add($streetpageFileRemove);

        $streetpageFull = $auth->createPermission('streetpageFull');
        $streetpageFull->description = 'Полный доступ "Адресные страницы"';
        $auth->add($streetpageFull);

        $auth->addChild($streetpageCreate, $streetpageView);
        $auth->addChild($streetpageUpdate, $streetpageView);
        $auth->addChild($streetpageDelete, $streetpageView);
        $auth->addChild($streetpageDelete, $streetpageFileRemove);

        $auth->addChild($streetpageFull, $streetpageView);
        $auth->addChild($streetpageFull, $streetpageCreate);
        $auth->addChild($streetpageFull, $streetpageUpdate);
        $auth->addChild($streetpageFull, $streetpageDelete);



        // Права для работы с "Теги"

        $tagView = $auth->createPermission('tagView');
        $tagView->description = 'Просмотр "Теги"';
        $auth->add($tagView);

        $tagCreate = $auth->createPermission('tagCreate');
        $tagCreate->description = 'Добавление "Теги"';
        $auth->add($tagCreate);

        $tagUpdate = $auth->createPermission('tagUpdate');
        $tagUpdate->description = 'Редактирование "Теги"';
        $auth->add($tagUpdate);

        $tagDelete = $auth->createPermission('tagDelete');
        $tagDelete->description = 'Удаление "Теги"';
        $auth->add($tagDelete);

        $tagFileRemove = $auth->createPermission('tagFileRemove');
        $tagFileRemove->description = 'Удаление файлов "Теги"';
        $auth->add($tagFileRemove);

        $tagFull = $auth->createPermission('tagFull');
        $tagFull->description = 'Полный доступ "Теги"';
        $auth->add($tagFull);

        $auth->addChild($tagCreate, $tagView);
        $auth->addChild($tagUpdate, $tagView);
        $auth->addChild($tagDelete, $tagView);
        $auth->addChild($tagDelete, $tagFileRemove);

        $auth->addChild($tagFull, $tagView);
        $auth->addChild($tagFull, $tagCreate);
        $auth->addChild($tagFull, $tagUpdate);
        $auth->addChild($tagFull, $tagDelete);



        // Права для работы с "Пользователи"

        $userView = $auth->createPermission('userView');
        $userView->description = 'Просмотр "Пользователи"';
        $auth->add($userView);

        $userCreate = $auth->createPermission('userCreate');
        $userCreate->description = 'Добавление "Пользователи"';
        $auth->add($userCreate);

        $userUpdate = $auth->createPermission('userUpdate');
        $userUpdate->description = 'Редактирование "Пользователи"';
        $auth->add($userUpdate);

        $userDelete = $auth->createPermission('userDelete');
        $userDelete->description = 'Удаление "Пользователи"';
        $auth->add($userDelete);

        $userFileRemove = $auth->createPermission('userFileRemove');
        $userFileRemove->description = 'Удаление файлов "Пользователи"';
        $auth->add($userFileRemove);

        $userFull = $auth->createPermission('userFull');
        $userFull->description = 'Полный доступ "Пользователи"';
        $auth->add($userFull);

        $auth->addChild($userCreate, $userView);
        $auth->addChild($userUpdate, $userView);
        $auth->addChild($userDelete, $userView);
        $auth->addChild($userDelete, $userFileRemove);

        $auth->addChild($userFull, $userView);
        $auth->addChild($userFull, $userCreate);
        $auth->addChild($userFull, $userUpdate);
        $auth->addChild($userFull, $userDelete);


        
        // Добавляем объект определяющий правила для ролей пользователей, он будет сохранен в файл rules.php
        $rule = new UserRoleRule();
        $auth->add($rule);



        // Добавляем роли

        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $user->ruleName = $rule->name;
        $auth->add($user);

        $manager = $auth->createRole('manager');
        $manager->description = 'Менеджер';
        $manager->ruleName = $rule->name;
        $auth->add($manager);

        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $admin->ruleName = $rule->name;
        $auth->add($admin);


        // Наследование ролей

        $auth->addChild($manager, $adminPanel);
        $auth->addChild($manager, $bannerView);
        // $auth->addChild($manager, $blockView);
        // $auth->addChild($manager, $blockuniqueView);
        $auth->addChild($manager, $blocktechnicalView);
        $auth->addChild($manager, $cityView);
        // $auth->addChild($manager, $categoryView);
        // $auth->addChild($manager, $contentView);
        $auth->addChild($manager, $menuView);
        $auth->addChild($manager, $masterView);
        $auth->addChild($manager, $pageView);
        $auth->addChild($manager, $partnerView);
        $auth->addChild($manager, $partnercontactView);
        $auth->addChild($manager, $priceView);
        $auth->addChild($manager, $pricesectionView);
        $auth->addChild($manager, $pricetableView);
        $auth->addChild($manager, $pricetablehtmlView);
        $auth->addChild($manager, $requestView);
        $auth->addChild($manager, $redirectView);
        $auth->addChild($manager, $reviewView);
        $auth->addChild($manager, $searchindexView);
        // $auth->addChild($manager, $serviceView);
        // $auth->addChild($manager, $servicecenterView);
        // $auth->addChild($manager, $servicecontrolView);
        $auth->addChild($manager, $settingView);
        // $auth->addChild($manager, $streetView);
        // $auth->addChild($manager, $streettemplateView);
        // $auth->addChild($manager, $streetpageView);
        $auth->addChild($manager, $tagView);
        $auth->addChild($manager, $userView);



        $auth->addChild($admin, $adminPanel);
        $auth->addChild($admin, $ElfinderFull);
        $auth->addChild($admin, $bannerFull);
        // $auth->addChild($admin, $blockFull);
        // $auth->addChild($admin, $blockuniqueView);
        $auth->addChild($admin, $blocktechnicalCreate);
        $auth->addChild($admin, $blocktechnicalUpdate);
        // $auth->addChild($admin, $blocktechnicalFileRemove);
        // $auth->addChild($admin, $blockuniqueFileRemove);
        $auth->addChild($admin, $cityFull);
        // $auth->addChild($admin, $categoryFull);
        // $auth->addChild($admin, $contentFull);
        $auth->addChild($admin, $menuFull);
        $auth->addChild($admin, $masterFull);
        $auth->addChild($admin, $pageFull);
        $auth->addChild($admin, $partnerFull);
        $auth->addChild($admin, $partnercontactFull);
        $auth->addChild($admin, $priceFull);
        $auth->addChild($admin, $pricesectionFull);
        $auth->addChild($admin, $pricetableFull);
        $auth->addChild($admin, $pricetablehtmlFull);
        $auth->addChild($admin, $requestDelete);
        $auth->addChild($admin, $redirectFull);
        $auth->addChild($admin, $reviewFull);
        $auth->addChild($admin, $searchindexView);
        // $auth->addChild($admin, $serviceFull);
        // $auth->addChild($admin, $servicecenterFull);
        // $auth->addChild($admin, $servicecontrolFull);
        $auth->addChild($admin, $settingFull);
        // $auth->addChild($admin, $streetFull);
        // $auth->addChild($admin, $streettemplateFull);
        // $auth->addChild($admin, $streetpageFull);
        $auth->addChild($admin, $tagFull);
        $auth->addChild($admin, $userFull);

    }
}
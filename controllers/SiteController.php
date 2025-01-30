<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\LoginForm;
use app\models\Blocktechnical;
use app\models\City;
use app\models\Page;
use app\models\Partner;
use app\models\Price;
use app\models\Redirect;
use app\models\Request;
use app\models\Searchindex;
use app\models\Setting;
use app\models\Tag;
use app\models\User;
use app\helpers\CustomHelper;
use app\helpers\LibmailHelper;
use app\helpers\SmsRuHelper;
use app\helpers\RecaptchaV3Helper;
use app\helpers\SitemapHelper;
use app\helpers\VariableHelper;
use app\helpers\UrlHelper;
use yii\helpers\Url;
use \stdClass;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
    public function beforeAction($action) {
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        if(!session_id()) session_start();

        $cookies = Yii::$app->request->cookies;
        $utm_source = $cookies->getValue('utm_source', null);
        $utm_medium = $cookies->getValue('utm_medium', null);
        $utm_campaign = $cookies->getValue('utm_campaign', null);
        $utm_term = $cookies->getValue('utm_term', null);
        $utm_content = $cookies->getValue('utm_content', null);

        $data = Yii::$app->request->get();

        // Проверяем таблицу переадресаций и при необходимости выполняем 301 редирект
        Redirect::go301Redirect();

        if (!empty($data['utm_source']) || !empty($data['utm_medium']) || !empty($data['utm_campaign'])) {
            if (empty($utm_source) && empty($utm_medium) && empty($utm_campaign)) {

                $utm_source = (!empty($data['utm_source'])) ? $data['utm_source'] : null;
                $utm_medium = (!empty($data['utm_medium'])) ? $data['utm_medium'] : null;
                $utm_campaign = (!empty($data['utm_campaign'])) ? $data['utm_campaign'] : null;
                $utm_term = (!empty($data['utm_term'])) ? $data['utm_term'] : null;
                $utm_content = (!empty($data['utm_content'])) ? $data['utm_content'] : null;

                // получение коллекции (yii\web\CookieCollection) из компонента "response"
                $cookies = Yii::$app->response->cookies;
                // срок действия cookies
                $expire = time() + 3600*24*30;
                // добавление новой куки в HTTP-ответ
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'utm_source',
                    'value' => $utm_source,
                    'expire' => $expire,
                ]));
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'utm_medium',
                    'value' => $utm_medium,
                    'expire' => $expire,
                ]));
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'utm_campaign',
                    'value' => $utm_campaign,
                    'expire' => $expire,
                ]));
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'utm_term',
                    'value' => $utm_term,
                    'expire' => $expire,
                ]));
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'utm_content',
                    'value' => $utm_content,
                    'expire' => $expire,
                ]));
            }
        }

        Yii::$app->params['domain'] = City::getDomain();
        Yii::$app->params['city'] = City::getDomainCity();
        Yii::$app->params['blocktechnical'] = Blocktechnical::getBlocksArray();

        Yii::$app->params['tag'] = array();
        $tag = Tag::find()->select(['disposition', 'text'])->where(['visible' => 1])->andWhere([
            'OR',
            ['like', 'city', Yii::$app->params['city']['id'], false],
            ['like', 'city', Yii::$app->params['city']['id'].',%', false],
            ['like', 'city', '%,'.Yii::$app->params['city']['id'], false],
            ['like', 'city', '%,'.Yii::$app->params['city']['id'].',%', false],
        ])->orderBy(['number' => SORT_ASC, 'id' => SORT_ASC])->asArray()->all();
        if(!empty($tag) && is_array($tag)){
            foreach ($tag as $one) {
                if(!isset(Yii::$app->params['tag'][ $one['disposition'] ])){
                    Yii::$app->params['tag'][ $one['disposition'] ] = array();
                }
                Yii::$app->params['tag'][ $one['disposition'] ][] = $one['text'];
            }
        }

        $request_uri = (!empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : null;
        $request_uri = explode('?', $request_uri, 2);
        $request_uri = $request_uri[0];
        $permalink = trim($request_uri, '/');
        if ($permalink === '') {
            $permalink = '/';
        }
        Yii::$app->params['permalink'] = $permalink;

        // \app\helpers\CustomHelper::debug(\app\models\Menu::getActivePages());

        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Заполняем Title и Meta-теги страницы
     */
    protected function metaPage($page)
    {
        if (is_object($page)) {
            if (method_exists($page, 'getAttributes')) {
                $page = $page->getAttributes();
            }
        }

        if (is_array($page)) {
            if(!empty($page['redirect'])){
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: {$page['redirect']}");
                exit();
            }

            if(!empty($page['title'])){
                if (!empty($page['name'])) {
                    $page_name = strip_tags($page['name']);
                    $page['title'] = str_replace('{{name}}', $page_name, $page['title']);
                }
                if (!empty($page['header'])) {
                    $page_header = strip_tags($page['header']);
                    $page['title'] = str_replace('{{header}}', $page_header, $page['title']);
                }
                $title = VariableHelper::variableSubstitution($page['title']);
                $title = strip_tags($title);
                $this->view->title = $title;
            }
            if(!empty($page['keywords'])) {
                $keywords = VariableHelper::variableSubstitution($page['keywords']);
                $keywords = strip_tags($keywords);
                $this->view->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);
            }

            if(empty($page['description'])) {
                $page['description'] = Setting::getSetting('default-description-mask');
            }

            if(!empty($page['description'])) {
                if (!empty($page['name'])) {
                    $page_name = strip_tags($page['name']);
                    $page['description'] = str_replace('[name]', $page_name, $page['description']);
                }
                if (!empty($page['header'])) {
                    $page_header = strip_tags($page['header']);
                    $page['description'] = str_replace('[header]', $page_header, $page['description']);
                }
                $description = VariableHelper::variableSubstitution($page['description']);
                $description = strip_tags($description);
                $this->view->registerMetaTag(['name' => 'description', 'content' => $description]);
            }
            if (!empty($page['image'])) {
                $image = UrlHelper::to() . ltrim($page['image'], '/');
            }

            if(isset($page['noindex']) && $page['noindex'] == 1){
                $this->view->registerMetaTag(['name' => 'robots', 'content' => 'noindex']);
            }

            if (empty(Yii::$app->params['canonical'])) {
                Yii::$app->params['canonical'] = Url::canonical();
            }
            if (Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'search') {
                Yii::$app->params['canonical'] = null;
            }
            if (!empty(Yii::$app->params['canonical'])) {
                $this->view->registerLinkTag(['rel' => 'canonical', 'href' => Yii::$app->params['canonical']]);
            }

            // Schema.org data
            // if(!empty($title)) $this->view->registerMetaTag(['itemprop' => 'name', 'content' => $title]);
            // if(!empty($description)) $this->view->registerMetaTag(['itemprop' => 'description', 'content' => $description]);
            // if(!empty($image)) $this->view->registerMetaTag(['itemprop' => 'image', 'content' => $image]);

            // Open Graph data
            if(!empty(Yii::$app->language)) $this->view->registerMetaTag(['property' => 'og:locale', 'content' => Yii::$app->language]);
            if(!empty($title)) $this->view->registerMetaTag(['property' => 'og:title', 'content' => $title]);

            if (Page::isFrontPage()) {
                $this->view->registerMetaTag(['property' => 'og:type', 'content' => 'website']);
            } else{
                $this->view->registerMetaTag(['property' => 'og:type', 'content' => 'article']);
            }

            if (!empty($page['lastmod'])) {
                $modified_time = date('Y-m-d', $page['lastmod']). "T" .date('h:i:s', $page['lastmod']) . '+03:00';
                $this->view->registerMetaTag(['property' => 'article:modified_time', 'content' => $modified_time]);
            }

            $this->view->registerMetaTag(['property' => 'og:url', 'content' => Yii::$app->params['canonical']]);
            $site_name = Setting::getSetting('name');
            if (!empty($site_name)) {
                $site_name = strip_tags($site_name);
                $site_name = CustomHelper::mb_ucfirst($site_name);
                $this->view->registerMetaTag(['property' => 'og:site_name', 'content' => $site_name]);
            }
            if(!empty($description)) $this->view->registerMetaTag(['property' => 'og:description', 'content' => $description]);
            if(!empty($image)) $this->view->registerMetaTag(['property' => 'og:image', 'content' => $image]);

            // Twitter card
            $this->view->registerMetaTag(['name' => 'twitter:card', 'content' => 'summary_large_image']);
            // $this->view->registerMetaTag(['name' => 'twitter:site', 'content' => '']);
            if(!empty($title)) $this->view->registerMetaTag(['name' => 'twitter:title', 'content' => $title]);
            if(!empty($description)) $this->view->registerMetaTag(['name' => 'twitter:description', 'content' => $description]);
            if(!empty($image)) $this->view->registerMetaTag(['name' => 'twitter:image', 'content' => $image]);

        }
    }

    /**
     * ЧПУ
     */
    public function actionIndex()
    {
        // временно закрываем доступ к сайту для незарегистрированных пользователей
        // if(Yii::$app->user->isGuest){
        //     if (Yii::$app->controller->route != '/site/login') {
        //         header("HTTP/1.1 301 Moved Permanently");
        //         header("Location: /login");
        //         exit();
        //     }
        // }

        $request_uri = (!empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : null;
        $request_uri = explode('?', $request_uri, 2);

        // редирект на страницу без get параметров
        // if (!empty($request_uri[1])) {
        //     header("HTTP/1.1 301 Moved Permanently");
        //     header('Location: '.$request_uri[0]);
        //     exit();
        // }

        $request_uri = $request_uri[0];
        $permalink = trim($request_uri, '/');
        if ($permalink === '') {
            $permalink = '/';
        }
        Yii::$app->params['permalink'] = $permalink;

        $page = Page::find()->where(['permalink' => $permalink])->andWhere(['!=', 'template', 15])->limit(1)->one();
        if (empty($page)) {
            // if (preg_match('@^metro\/([^\\\]+)\z@', $permalink, $metro_alias)) {
            //     if (!empty($metro_alias[1]) && !empty(Yii::$app->params['city']['metro-url'])) {
            //         $metroArr = array();
            //         foreach (Yii::$app->params['city']['metro-url'] as $one) {
            //             if (is_array($one) && !empty($one[0]) && !empty($one[1])) {
            //                 $metroArr[$one[1]] = $one[0];
            //             }
            //         }
            //         if (!empty($metroArr[$metro_alias[1]])) {
            //             Yii::$app->params['city']['params']['metro'] = $metroArr[$metro_alias[1]];
            //             Yii::$app->params['metro'] = array(
            //                 'name' => $metroArr[$metro_alias[1]],
            //                 'alias' => $metro_alias[1]
            //                 );
            //         }
            //     }
            // }
            if (preg_match('@^address\/([^\\\]+)\z@', $permalink, $street_alias)) {
                if (!empty($street_alias[1]) && !empty(Yii::$app->params['city']['street-url'])) {
                    $streetArr = array();
                    foreach (Yii::$app->params['city']['street-url'] as $one) {
                        if (is_array($one) && !empty($one[0]) && !empty($one[1])) {
                            $streetArr[$one[1]] = $one[0];
                        }
                    }
                    if (!empty($streetArr[$street_alias[1]])) {
                        Yii::$app->params['city']['params']['ulica'] = $streetArr[$street_alias[1]];
                        Yii::$app->params['street'] = array(
                            'name' => $streetArr[$street_alias[1]],
                            'alias' => $street_alias[1]
                            );
                    }
                }
            }

            // if (!empty(Yii::$app->params['metro'])) {
            //     $page = Page::find()->where(['permalink' => 'metro/metro-name'])->andWhere(['visible' => 1])->limit(1)->one();
            // }
            if (!empty(Yii::$app->params['street'])) {
                $page = Page::find()->where(['permalink' => 'address/street-name'])->andWhere(['visible' => 1])->limit(1)->one();
            }
            if (!empty($page)) {
                $page->visible = 1;
            }
            
        }
        if (empty($page)) {
            throw new \yii\web\HttpException(404, 'Страница не найдена.');
        }

        if (empty($page->visible)) {
            if (empty($page->permalink) || $page->permalink === '/') {
                throw new \yii\web\HttpException(404, 'Страница не найдена.');
            } else {
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /");
                exit();
            }
        }

        if (!empty(Yii::$app->params['city']['id'])) {
            $pageCity = (!empty($page->city)) ? explode(',', $page->city) : array();
            if (!in_array(Yii::$app->params['city']['id'], $pageCity)) {
                if (empty($page->permalink) || $page->permalink === '/') {
                    throw new \yii\web\HttpException(404, 'Страница не найдена.');
                } else {
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: /");
                    exit();
                }
            }
        }

        if (!empty($page) && !empty($page->redirect)) {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: {$page->redirect}");
            exit();
        }

        if (!empty($page) && !empty($page->skryt_na_poddomene)) {
            if (!City::isMainCity()) {
                if (empty($page->permalink) || $page->permalink === '/') {
                    $url = UrlHelper::to(['city' => null, 'page' => '/']);
                } else {
                    $url = UrlHelper::to(['city' => Yii::$app->params['city']['alias'], 'page' => '/']);
                }
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: {$url}");
                exit();
            }
        }

        // Записываем в сессию страницу первого посещения
        if (empty($_SESSION['start_page_id'])) {
            if (!empty($page) && !empty($page->id)) {
                $_SESSION['start_page_id'] = $page->id;
            }
        }


        if (!empty($page)) {
            // Находим партнера
            $partner = Partner::getPartner(Yii::$app->params['city']['id'], $page->id);
            if (empty($partner) && !empty($page->parent)) {
                $partner = Partner::getPartner(Yii::$app->params['city']['id'], $page->parent);
            }
            // Обновляем карточку организации в соответствии с данными партнера
            Yii::$app->params['partner'] = $partner;
            if (!empty(Yii::$app->params['partner']['phone'])) {
                Yii::$app->params['city']['phone'] = Yii::$app->params['partner']['phone'];
            }
            if (!empty(Yii::$app->params['partner']['front_email'])) {
                Yii::$app->params['city']['front_email'] = Yii::$app->params['partner']['front_email'];
            }
            if (!empty(Yii::$app->params['partner']['wokrtime'])) {
                Yii::$app->params['city']['wokrtime'] = Yii::$app->params['partner']['wokrtime'];
            }

            $sprice = VariableHelper::getSprice($page->getAttributes());
            $page->name = VariableHelper::variableSubstitution($page->name);
            $page->title = VariableHelper::variableSubstitution($page->title);
            $page->description = VariableHelper::variableSubstitution($page->description);
            $page->content = VariableHelper::variableSubstitution($page->content);
            $page->content_aside = VariableHelper::variableSubstitution($page->content_aside);
            $page->content_two = VariableHelper::variableSubstitution($page->content_two);
            $page->content_two_aside = VariableHelper::variableSubstitution($page->content_two_aside);
            $page->content_two_title = VariableHelper::variableSubstitution($page->content_two_title);
            $page->block_how_we_work_4_title = VariableHelper::variableSubstitution($page->block_how_we_work_4_title);
            $page->block_how_we_work_4_text = VariableHelper::variableSubstitution($page->block_how_we_work_4_text);
            $page->table = VariableHelper::variableSubstitution($page->table);
            $page->after_table = VariableHelper::variableSubstitution($page->after_table);
            Yii::$app->params['page'] = $page->getAttributes();
            if (!empty(Yii::$app->params['street']) && !empty(Yii::$app->params['street']['alias'])) {
                Yii::$app->params['canonical'] = UrlHelper::to(['page' => 'address/' . Yii::$app->params['street']['alias']]);
            } else {
                Yii::$app->params['canonical'] = UrlHelper::to(['page' => $page->permalink]);
            }
            $this->metaPage($page);
            $template = $page->getTemplateFilename();
            return $this->render($template, [
                'page' => $page,
            ]);
        }

        throw new \yii\web\HttpException(404, 'Страница не найдена.');
    }

    /**
     * Результаты поиска
     */
    public function actionSearch($s = null)
    {
        if (!empty($s) || $s === '0') {
            $result = Searchindex::find()->where(['like', 'text', $s])->andWhere(['page_visible' => 1])->orderBy(['page_id' => SORT_ASC])->asArray()->all();
        } else {
            throw new \yii\web\HttpException(400, 'Введите поисковой запрос.');
        }

        $result_service = array();
        $result_category = array();
        $result_page = array();

        if (!empty($result) && is_array($result)) {
            $result_count = count($result);
            $page_id = array();
            for ($i=0; $i < $result_count; $i++) { 
                $page_id[] = $result[$i]['page_id'];
            }
            if (!empty($page_id)) {
                $page = Page::find()->select(['id', 'name', 'permalink', 'title'])->where(['id' => $page_id])->andWhere(['visible' => 1])->asArray()->all();
                $page = CustomHelper::CustomMultiParamArray($page, 'id');
            }

            for ($i=0; $i < $result_count; $i++) { 
                if (!empty($result[$i]) && !empty($result[$i]['page_alias'])) {
                    if (isset($page) && isset($page[$result[$i]['page_id']])) {
                        $result[$i]['href'] = UrlHelper::to(['page' => $result[$i]['page_alias']]);
                        $result[$i]['page_name'] = VariableHelper::variableSubstitution($page[$result[$i]['page_id']]['name']);
                        $result_page[$i] = $result[$i];
                    }
                }
            }
        }

        $result = array_merge($result_page, $result_category, $result_service);

        Yii::$app->params['s'] = $s;

        $searchValue = (isset(Yii::$app->params['s'])) ? (string) Yii::$app->params['s'] : '';
        $searchValue = htmlspecialchars($searchValue);

        $page = array(
            "title" => "Результаты поиска по запросу: {$searchValue}",
            "header" => "Результаты поиска по запросу: {$searchValue}"
            );
        $this->metaPage($page);

        return $this->render('search', [
            'page' => $page,
            'result' => $result,
        ]);
    }

    /**
     * sitemap.xml
     */
    public function actionSitemap()
    {
        $url = array();
        $url['index'] =  array();
        $url['page'] = array();

        $index = Page::find()->select(['id', 'permalink', 'lastmod'])->where(['visible' => 1])->andWhere(['permalink' => '/'])->asArray()->all();
        foreach ($index as $one) {
            if (!empty($one['permalink'])) {
                $one_url = UrlHelper::to();
                if (empty($index_lastmod)) {
                    $index_lastmod = $one['lastmod'];
                }
                $url['index'][$one_url] = $one['lastmod'];
            }
        }

        $page_query = Page::find()->select(['id', 'permalink', 'lastmod'])->where(['visible' => 1])->andWhere(['!=', 'permalink', '/'])->andWhere(['NOT IN', 'template', [1, 15]]);

        if (!empty(Yii::$app->params['city']['id'])) {
            $page_query->andWhere([
                'OR',
                ['like', 'city', Yii::$app->params['city']['id'], false],
                ['like', 'city', Yii::$app->params['city']['id'].',%', false],
                ['like', 'city', '%,'.Yii::$app->params['city']['id'], false],
                ['like', 'city', '%,'.Yii::$app->params['city']['id'].',%', false],
                ]);
        }

        $page = $page_query->asArray()->all();

        foreach ($page as $one) {
            if (!empty($one['permalink'])) {
                $one_url = UrlHelper::to(['page' => $one['permalink']]);
                if (empty($index_lastmod)) {
                    $index_lastmod = $one['lastmod'];
                }
                $url['page'][$one_url] = $one['lastmod'];
            }
        }

        if (empty($index_lastmod)) {
            $index_lastmod = time();
        }

        if (!empty(Yii::$app->params['city']['street-url'])) {
            foreach (Yii::$app->params['city']['street-url'] as $one) {
                if (is_array($one) && !empty($one[1])) {
                    $one_url = UrlHelper::to(['page' => "/address/{$one[1]}/"]);
                    $url['page'][$one_url] = $index_lastmod;
                }
            }
        }

        // if (!empty(Yii::$app->params['city']['metro-url'])) {
        //     foreach (Yii::$app->params['city']['metro-url'] as $one) {
        //         if (is_array($one) && !empty($one[1])) {
        //             $one_url = UrlHelper::to(['page' => "/metro/{$one[1]}/"]);
        //             $url['page'][$one_url] = $index_lastmod;
        //         }
        //     }
        // }

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'text/xml');

        return $this->renderPartial('sitemap', [
            'url' => $url,
        ]);
    }

    /**
     * robots.txt
     */
    public function actionRobots()
    {
        $robots_txt = Yii::$app->params['city']['robots_txt'];

        if (empty($robots_txt)) {
            $robots_txt = "User-agent: *

Clean-Param: utm_source&utm_medium&utm_campaign&utm_content&utm_term&utm_gorod&etext

Sitemap: ".Url::to('/', true)."sitemap.xml";
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'text/plain');

        return $this->renderPartial('robots', [
            'robots_txt' => $robots_txt,
        ]);
    }

    /**
     * Проверяем корректность данных от пользователя перед отправкой заявки на e-mail
     */
    public function actionSendValidate()
    {
        $recaptchaV3Helper = new RecaptchaV3Helper();

        if (Yii::$app->request->isAjax) {
            if (!empty($_POST)) {

                if (!$recaptchaV3Helper->validate('send')) {
                    return "captcha";
                    exit;
                }

                if (isset($_POST['acceptance']) && empty($_POST['acceptance'])) {
                    return "unacceptance";
                    exit;
                }

                $page_id = (!empty($_POST['page'])) ? $_POST['page'] : null;
                if (empty($page_id)) {
                    $page_id = (!empty($_SESSION['start_page_id'])) ? $_SESSION['start_page_id'] : null;
                }

                Yii::$app->params['partner'] = Partner::getPartner(Yii::$app->params['city']['id'], $page_id);
                if (empty(Yii::$app->params['partner'])) {
                    $api_page_default = Setting::getSetting('api-page-default');
                    if (!empty($api_page_default)) {
                        Yii::$app->params['partner'] = Partner::getPartner(Yii::$app->params['city']['id'], $api_page_default);
                    }
                }

                $body = '';
                $pageName = '';
                foreach ($_POST as $key => $value) {
                    if ($key === 'page') {
                        $value = Page::find()->select(['name'])->where(['id' => $value])->limit(1)->scalar();
                        if (!empty($value)) {
                            $value = VariableHelper::variableSubstitution($value);
                            if (empty($pageName) && !empty($value)) {
                                $pageName = $value;
                            }
                        }
                    }
                    if ($key === 'blocktechnical') {
                        $key = 'block';
                        $value = Blocktechnical::find()->select(['name'])->where(['id' => $value])->limit(1)->scalar();
                    }
                    if (!empty($key) && $key !== '_csrf' && $key !== 'blocktechnical' && $key !== 'acceptance' && $key !== 'agreement' && $key !== 'g-recaptcha-response' && $key !== 'ajax' && $key !== 'send') {
                        $body .= "<p><b>".strip_tags($key).":</b> ".strip_tags($value)."</p>";
                    }
                }
                $body .= "<p><b>city:</b> ".Yii::$app->params['city']['name']."</p>";

                $cookies = Yii::$app->request->cookies;
                $body .= "<p><b>utm_source:</b> ".$cookies->getValue('utm_source', null)."</p>";
                $body .= "<p><b>utm_medium:</b> ".$cookies->getValue('utm_medium', null)."</p>";
                $body .= "<p><b>utm_campaign:</b> ".$cookies->getValue('utm_campaign', null)."</p>";
                $body .= "<p><b>utm_term:</b> ".$cookies->getValue('utm_term', null)."</p>";
                $body .= "<p><b>utm_content:</b> ".$cookies->getValue('utm_content', null)."</p>";

                $adminEmail = Setting::getSetting('email-application');
                if (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['back_email'])) {
                    $adminEmail = $adminEmail . "\r\n" . implode("\r\n", Yii::$app->params['partner']['back_email']);
                } elseif (!empty(Yii::$app->params['city']) && !empty(Yii::$app->params['city']['back_email'])) {
                    $sendCityEmail = (int) Setting::getSetting('send-city-email');
                    if ($sendCityEmail) {
                        $adminEmail = $adminEmail . "\r\n" . implode("\r\n", Yii::$app->params['city']['back_email']);
                    }
                }

                if (!empty($adminEmail)) {
                    $adminEmail = str_replace(["\r\n", "\r", "\n", ',', ';'], ';', $adminEmail);
                    $adminEmail = preg_replace('/;+/', ';', $adminEmail);
                    $adminEmail = explode(';', $adminEmail);
                    $adminEmail = array_map('trim', $adminEmail);
                    $adminEmail = array_diff($adminEmail, array(''));
                    $adminEmail = array_unique($adminEmail);
                    if (!empty($adminEmail)) {
                        $_SESSION['send-confirm'] = $_POST;
                        return "ok";
                        exit;
                    }
                }
                return "error";
                exit;
            }
        }
        throw new NotFoundHttpException('Страница не найдена.', 404);
    }

    /**
     * Отправляем заявку на e-mail (при двухшаговой отправке)
     */
    public function actionSendConfirm()
    {
        if (Yii::$app->request->isAjax) {
            if (!empty($_SESSION['send-confirm'])) {

                $res = 0;
                $post = $_SESSION['send-confirm'];

                $page_id = (!empty($post['page'])) ? $post['page'] : null;
                if (empty($page_id)) {
                    $page_id = (!empty($_SESSION['start_page_id'])) ? $_SESSION['start_page_id'] : null;
                }

                Yii::$app->params['partner'] = Partner::getPartner(Yii::$app->params['city']['id'], $page_id);
                if (empty(Yii::$app->params['partner'])) {
                    $api_page_default = Setting::getSetting('api-page-default');
                    if (!empty($api_page_default)) {
                        Yii::$app->params['partner'] = Partner::getPartner(Yii::$app->params['city']['id'], $api_page_default);
                    }
                }

                $subject = (!empty($post["subject"])) ? $post["subject"] : 'Новая заявка - ' . Setting::getSetting('name') . ' - ' . Yii::$app->params['city']['name'];
                if (!empty(Yii::$app->params['partner']['mail_subject'])) {
                    $subject = VariableHelper::variableSubstitution(Yii::$app->params['partner']['mail_subject']);
                    $subject = strip_tags($subject);
                }

                $body = '';
                $pageName = '';
                foreach ($post as $key => $value) {
                    if ($key === 'page') {
                        $value = Page::find()->select(['name'])->where(['id' => $value])->limit(1)->scalar();
                        if (!empty($value)) {
                            $value = VariableHelper::variableSubstitution($value);
                            if (empty($pageName) && !empty($value)) {
                                $pageName = $value;
                            }
                        }
                    }
                    if ($key === 'blocktechnical') {
                        $key = 'block';
                        $value = Blocktechnical::find()->select(['name'])->where(['id' => $value])->limit(1)->scalar();
                    }
                    if (!empty($key) && $key !== '_csrf' && $key !== 'blocktechnical' && $key !== 'acceptance' && $key !== 'agreement' && $key !== 'g-recaptcha-response' && $key !== 'ajax' && $key !== 'send') {
                        $body .= "<p><b>".strip_tags($key).":</b> ".strip_tags($value)."</p>";
                    }
                }
                $body .= "<p><b>city:</b> ".Yii::$app->params['city']['name']."</p>";

                $cookies = Yii::$app->request->cookies;
                $body .= "<p><b>utm_source:</b> ".$cookies->getValue('utm_source', null)."</p>";
                $body .= "<p><b>utm_medium:</b> ".$cookies->getValue('utm_medium', null)."</p>";
                $body .= "<p><b>utm_campaign:</b> ".$cookies->getValue('utm_campaign', null)."</p>";
                $body .= "<p><b>utm_term:</b> ".$cookies->getValue('utm_term', null)."</p>";
                $body .= "<p><b>utm_content:</b> ".$cookies->getValue('utm_content', null)."</p>";

                $adminEmail = Setting::getSetting('email-application');
                if (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['back_email'])) {
                    $adminEmail = $adminEmail . "\r\n" . implode("\r\n", Yii::$app->params['partner']['back_email']);
                } elseif (!empty(Yii::$app->params['city']) && !empty(Yii::$app->params['city']['back_email'])) {
                    $sendCityEmail = (int) Setting::getSetting('send-city-email');
                    if ($sendCityEmail) {
                        $adminEmail = $adminEmail . "\r\n" . implode("\r\n", Yii::$app->params['city']['back_email']);
                    }
                }

                if (!empty($adminEmail)) {
                    $adminEmail = str_replace(["\r\n", "\r", "\n", ',', ';'], ';', $adminEmail);
                    $adminEmail = preg_replace('/;+/', ';', $adminEmail);
                    $adminEmail = explode(';', $adminEmail);
                    $adminEmail = array_map('trim', $adminEmail);
                    $adminEmail = array_diff($adminEmail, array(''));
                    $adminEmail = array_unique($adminEmail);
                    if (!empty($adminEmail)) {
                        $messages = array();
                        foreach ($adminEmail as $one) {
                            $messages[] = Yii::$app->mailer->compose('request', ['message' => $body])->setTo($one)->setSubject($subject);
                        }
                        if (!empty($messages)) {
                            $send = Yii::$app->mailer->sendMultiple($messages);
                            if ($send) {
                                $res++;
                            }
                        }
                    }
                }

                if ($res > 0) {
                    $name = (!empty($post["name"])) ? $post["name"] : null;
                    $phone = (!empty($post["phone"])) ? $post["phone"] : null;
                    if (empty($phone)) {
                        $phone = (!empty($post["tel"])) ? $post["tel"] : null;
                    }
                    $city = Yii::$app->params['city']['name'];
                    $comment = (!empty($post["question"])) ? $post["question"] : null;
                    $pageUrl = (!empty($post["page-url"])) ? $post["page-url"] : null;

                    // Отправляем заявку партнерам по API
                    $rukiizplech_code = null;
                    $servicelead_code = null;
                    $leadcentre_code = null;
                    if (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['token_cpa_rukiizplech']) && !empty($phone)) {
                        $rukiizplech_code = \app\helpers\CpaRukiIzPlechHelper::apiSend(Yii::$app->params['partner']['token_cpa_rukiizplech'], $phone);
                    }
                    if (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['token_cpa_servicelead']) && !empty($phone)) {
                        $servicelead_code = \app\helpers\CpaServiceleadTopHelper::apiSend(Yii::$app->params['partner']['token_cpa_servicelead'], $phone, $name, $city, Yii::$app->params['partner']['offer_id_cpa_servicelead'], Yii::$app->params['partner']['thread_id_cpa_servicelead']);
                    }
                    if (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['token_cpa_leadcentre']) && !empty($phone)) {
                        $leadcentre_code = \app\helpers\CpaLeadCentreHelper::apiSend(Yii::$app->params['partner']['token_cpa_leadcentre'], $phone, $name, $city, $comment, $pageName);
                    }
                    // Записываем заявку в БД
                    $partner_id = (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['id'])) ? Yii::$app->params['partner']['id'] : null;
                    if (!empty($phone)) {
                        Request::add($phone, Yii::$app->params['city']['id'], $page_id, $partner_id, $rukiizplech_code, $servicelead_code, $leadcentre_code);
                    }

                    // Создаем сделку в amoCRM
                    $amoCrmHelper = new \app\helpers\AmoCrmHelper();
                    $res = $amoCrmHelper->createLeadWithContact($name, $phone, $city, $comment, $pageUrl, $pageName);

                    unset($_SESSION['send-confirm']);
                    return "ok";
                } else {
                    unset($_SESSION['send-confirm']);
                    return "error";
                }
                exit;
            }
        }
        throw new NotFoundHttpException('Страница не найдена.', 404);
    }

    /**
     * Отправляем заявку на e-mail
     */
    public function actionSend()
    {
        $recaptchaV3Helper = new RecaptchaV3Helper();

        if (Yii::$app->request->isAjax) {
            if (!empty($_POST)) {

                if (!$recaptchaV3Helper->validate('send')) {
                    return "captcha";
                    exit;
                }

                if (isset($_POST['acceptance']) && empty($_POST['acceptance'])) {
                    return "unacceptance";
                    exit;
                }

                $res = 0;

                $page_id = (!empty($_POST['page'])) ? $_POST['page'] : null;
                if (empty($page_id)) {
                    $page_id = (!empty($_SESSION['start_page_id'])) ? $_SESSION['start_page_id'] : null;
                }

                Yii::$app->params['partner'] = Partner::getPartner(Yii::$app->params['city']['id'], $page_id);
                if (empty(Yii::$app->params['partner'])) {
                    $api_page_default = Setting::getSetting('api-page-default');
                    if (!empty($api_page_default)) {
                        Yii::$app->params['partner'] = Partner::getPartner(Yii::$app->params['city']['id'], $api_page_default);
                    }
                }

                $subject = (!empty($_POST["subject"])) ? $_POST["subject"] : 'Новая заявка - ' . Setting::getSetting('name') . ' - ' . Yii::$app->params['city']['name'];
                if (!empty(Yii::$app->params['partner']['mail_subject'])) {
                    $subject = VariableHelper::variableSubstitution(Yii::$app->params['partner']['mail_subject']);
                    $subject = strip_tags($subject);
                }

                $body = '';
                $pageName = '';
                foreach ($_POST as $key => $value) {
                    if ($key === 'page') {
                        $value = Page::find()->select(['name'])->where(['id' => $value])->limit(1)->scalar();
                        if (!empty($value)) {
                            $value = VariableHelper::variableSubstitution($value);
                            if (empty($pageName) && !empty($value)) {
                                $pageName = $value;
                            }
                        }
                    }
                    if ($key === 'blocktechnical') {
                        $key = 'block';
                        $value = Blocktechnical::find()->select(['name'])->where(['id' => $value])->limit(1)->scalar();
                    }
                    if (!empty($key) && $key !== '_csrf' && $key !== 'blocktechnical' && $key !== 'acceptance' && $key !== 'agreement' && $key !== 'g-recaptcha-response' && $key !== 'ajax' && $key !== 'send') {
                        $body .= "<p><b>".strip_tags($key).":</b> ".strip_tags($value)."</p>";
                    }
                }
                $body .= "<p><b>city:</b> ".Yii::$app->params['city']['name']."</p>";

                $cookies = Yii::$app->request->cookies;
                $body .= "<p><b>utm_source:</b> ".$cookies->getValue('utm_source', null)."</p>";
                $body .= "<p><b>utm_medium:</b> ".$cookies->getValue('utm_medium', null)."</p>";
                $body .= "<p><b>utm_campaign:</b> ".$cookies->getValue('utm_campaign', null)."</p>";
                $body .= "<p><b>utm_term:</b> ".$cookies->getValue('utm_term', null)."</p>";
                $body .= "<p><b>utm_content:</b> ".$cookies->getValue('utm_content', null)."</p>";

                $adminEmail = Setting::getSetting('email-application');
                if (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['back_email'])) {
                    $adminEmail = $adminEmail . "\r\n" . implode("\r\n", Yii::$app->params['partner']['back_email']);
                } elseif (!empty(Yii::$app->params['city']) && !empty(Yii::$app->params['city']['back_email'])) {
                    $sendCityEmail = (int) Setting::getSetting('send-city-email');
                    if ($sendCityEmail) {
                        $adminEmail = $adminEmail . "\r\n" . implode("\r\n", Yii::$app->params['city']['back_email']);
                    }
                }

                if (!empty($adminEmail)) {
                    $adminEmail = str_replace(["\r\n", "\r", "\n", ',', ';'], ';', $adminEmail);
                    $adminEmail = preg_replace('/;+/', ';', $adminEmail);
                    $adminEmail = explode(';', $adminEmail);
                    $adminEmail = array_map('trim', $adminEmail);
                    $adminEmail = array_diff($adminEmail, array(''));
                    $adminEmail = array_unique($adminEmail);
                    if (!empty($adminEmail)) {
                        $messages = array();
                        foreach ($adminEmail as $one) {
                            $messages[] = Yii::$app->mailer->compose('request', ['message' => $body])->setTo($one)->setSubject($subject);
                        }
                        if (!empty($messages)) {
                            $send = Yii::$app->mailer->sendMultiple($messages);
                            if ($send) {
                                $res++;
                            }
                        }
                    }
                }

                if ($res > 0) {
                    $name = (!empty($_POST["name"])) ? $_POST["name"] : null;
                    $phone = (!empty($_POST["phone"])) ? $_POST["phone"] : null;
                    $cityName = Yii::$app->params['city']['name'];
                    $comment = (!empty($_POST["question"])) ? $_POST["question"] : null;
                    $pageUrl = (!empty($_POST["page-url"])) ? $_POST["page-url"] : null;

                    // Отправляем заявку партнерам по API
                    $rukiizplech_code = null;
                    $servicelead_code = null;
                    $leadcentre_code = null;
                    if (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['token_cpa_rukiizplech']) && !empty($phone)) {
                        $rukiizplech_code = \app\helpers\CpaRukiIzPlechHelper::apiSend(Yii::$app->params['partner']['token_cpa_rukiizplech'], $phone);
                    }
                    if (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['token_cpa_servicelead']) && !empty($phone)) {
                        $servicelead_code = \app\helpers\CpaServiceleadTopHelper::apiSend(Yii::$app->params['partner']['token_cpa_servicelead'], $phone, $name, $cityName, Yii::$app->params['partner']['offer_id_cpa_servicelead'], Yii::$app->params['partner']['thread_id_cpa_servicelead']);
                    }
                    if (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['token_cpa_leadcentre']) && !empty($phone)) {
                        $leadcentre_code = \app\helpers\CpaLeadCentreHelper::apiSend(Yii::$app->params['partner']['token_cpa_leadcentre'], $phone, $name, $cityName, $comment, $pageName);
                    }
                    // Записываем заявку в БД
                    $partner_id = (!empty(Yii::$app->params['partner']) && !empty(Yii::$app->params['partner']['id'])) ? Yii::$app->params['partner']['id'] : null;
                    if (!empty($_POST["phone"])) {
                        Request::add($_POST["phone"], Yii::$app->params['city']['id'], $page_id, $partner_id, $rukiizplech_code, $servicelead_code, $leadcentre_code);
                    }

                    // Создаем сделку в amoCRM
                    $amoCrmHelper = new \app\helpers\AmoCrmHelper();
                    $res = $amoCrmHelper->createLeadWithContact($name, $phone, $cityName, $comment, $pageUrl, $pageName);

                    return "ok";
                } else {
                    return "error";
                }
                exit;
            }
        }
        throw new NotFoundHttpException('Страница не найдена.', 404);
    }

    /**
     * Login action.
     *
     * public function actionLogin()
     *
     * @return Response|string
     */
    public function actionC9e2b723478d81d18()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // $recaptchaV3Helper = new RecaptchaV3Helper();

        if (!empty($_SESSION['2FA'])) {
            // Второй шаг
            $model = new \app\models\TwoFAForm();
            if ($model->load(Yii::$app->request->post())) {

                if (!empty($recaptchaV3Helper) && !$recaptchaV3Helper->validate('login')) {
                    Yii::$app->session->setFlash('error', 'Подтвердите что вы не робот');
                    return $this->redirect('/c9e2b723478d81d18');
                }

                if ($model->login()) {
                    unset($_SESSION['2FA']);
                    return $this->redirect('/admin');
                } else {
                    unset($_SESSION['2FA']);
                    return $this->redirect('/c9e2b723478d81d18');
                }
            }

        } else {
            // Первый шаг
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post())) {

                if (!empty($recaptchaV3Helper) && !$recaptchaV3Helper->validate('login')) {
                    Yii::$app->session->setFlash('error', 'Подтвердите что вы не робот');
                    return $this->redirect('/c9e2b723478d81d18');
                }

                if ($model->login()) {
                    // return $this->goBack();
                    return $this->redirect('/c9e2b723478d81d18');
                }
            }
            $model->password = '';
        }

        $page = array(
            'title' => 'Вход на сайт',
            'noindex' => true
            );

        $this->metaPage($page);

        $this->layout = 'login';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Получаем список городов
     */
    public function actionGetCityList()
    {
        if (Yii::$app->request->isAjax) {
            $page = (int) Yii::$app->request->post('page', 0);
            $city_default_id = Setting::getSetting('city-default');
            $cities = City::getCitiesList();

            $page_permalink = Page::find()->select(['permalink'])->where(['id' => $page])->andWhere(['visible' => 1])->limit(1)->scalar();

            if (!empty($cities) && is_array($cities)) {
                foreach ($cities as $key => $value) {
                    if ($cities[$key]['id'] == $city_default_id) {
                        $cities[$key]['href'] = UrlHelper::to(['city' => '/', 'page' => $page_permalink]);
                    } else {
                        $cities[$key]['href'] = UrlHelper::to(['city' => $cities[$key]['alias'], 'page' => $page_permalink]);
                    }
                }
            }

            $data = array(
                'success' => 1,
                'page_id' => $page,
                'city_default_id' => $city_default_id,
                'data' => $cities,
                );
            return $this->asJson($data);
        }
        throw new \yii\web\HttpException(404, 'Страница не найдена.');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Страница обработки редиректов из amoCRM
     */
    public function actionAmocrmRedirect()
    {
        exit;
    }

    /**
     * Страница обработки хука об отключении интеграции amoCRM
     */
    public function actionAmocrmHook()
    {
        exit;
    }



/*
    public function actionTest()
    {
        $filename = __DIR__ . '\..\_Исходники\ТЗ профивдом - миграция на Yii2\ТЗ профивдом - миграция на Yii2\url-pages.csv';
        $fileHandle = fopen($filename, 'r');

        $data = array();
        while (($row = fgetcsv($fileHandle, 0, ';')) !== false) {
            if (!empty($row) && $row[1] === 'text/html; charset=UTF-8' && $row[2] == 200) {
                $data[] = $row[0];
            }
        }

        $data = array_unique($data);
        $data = implode("\r\n", $data);

        $filename = __DIR__ . '\..\_Исходники\ТЗ профивдом - миграция на Yii2\ТЗ профивдом - миграция на Yii2\pages.csv';
        file_put_contents($filename, $data);

        CustomHelper::debug($data);
        exit;
    }
*/

}

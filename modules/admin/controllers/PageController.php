<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Page;
use app\modules\admin\models\PageSearch;
use app\modules\admin\models\Banner;
use app\modules\admin\models\Price;
use app\modules\admin\models\City;
use app\modules\admin\models\Partner;
use app\modules\admin\models\Partnercontact;
use app\modules\admin\models\Searchindex;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->can('pageView');
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $banner = Banner::find()->select(['id', 'name'])->asArray()->all();
        $banner = \app\helpers\CustomHelper::customParamArray($banner, 'id', 'name');

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        $price = Price::find()->select(['id', 'name', 'price_region', 'price_msk', 'unit'])->asArray()->all();
        $price_count = count($price);
        for ($i=0; $i < $price_count; $i++) { 
            if (!empty($price[$i])) {
                $price[$i]['name'] = $price[$i]['name'] . ' ('.$price[$i]['price_region'].'/'.$price[$i]['unit'].') МСК - ' . $price[$i]['price_msk'].'/'.$price[$i]['unit'];
            }
        }
        $price = \app\helpers\CustomHelper::customParamArray($price, 'id', 'name');

        $templates = \app\models\Page::getTemplateNamesArray();

        $parents = Page::find()->select(['parent AS id', 'parent'])->where(['is not', 'parent', null])->andWhere(['>', 'parent', 0])->groupBy(['parent'])->asArray()->all();
        $parents = \app\helpers\CustomHelper::customParamArray($parents, 'id', 'parent');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'banner' => $banner,
            'city' => $city,
            'price' => $price,
            'templates' => $templates,
            'parents' => $parents,
        ]);
    }

    /**
     * Displays a single Page model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->can('pageView');
        $model = $this->findModel($id);
        $model->city = explode(',', $model->city);

        $banner = Banner::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $banner = \app\helpers\CustomHelper::customParamArray($banner, 'id', 'name');

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        $price = Price::find()->select(['id', 'name', 'price_region', 'price_msk', 'unit'])->asArray()->all();
        $price_count = count($price);
        for ($i=0; $i < $price_count; $i++) { 
            if (!empty($price[$i])) {
                $price[$i]['name'] = $price[$i]['name'] . ' ('.$price[$i]['price_region'].'/'.$price[$i]['unit'].') МСК - ' . $price[$i]['price_msk'].'/'.$price[$i]['unit'];
            }
        }
        $price = \app\helpers\CustomHelper::customParamArray($price, 'id', 'name');

        $templates = \app\models\Page::getTemplateNamesArray();
        
        return $this->render('view', [
            'model' => $model,
            'banner' => $banner,
            'city' => $city,
            'price' => $price,
            'templates' => $templates,
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->can('pageView');
        $model = new Page();

        $banner = Banner::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $banner = \app\helpers\CustomHelper::customParamArray($banner, 'id', 'name');
        $banner = \app\helpers\CustomHelper::custom_array_unshift($banner, '— Выбрать —');

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        $price = Price::find()->select(['id', 'name', 'price_region', 'price_msk', 'unit'])->asArray()->all();
        $price_count = count($price);
        for ($i=0; $i < $price_count; $i++) { 
            if (!empty($price[$i])) {
                $price[$i]['name'] = $price[$i]['name'] . ' ('.$price[$i]['price_region'].'/'.$price[$i]['unit'].') МСК - ' . $price[$i]['price_msk'].'/'.$price[$i]['unit'];
            }
        }
        $price = \app\helpers\CustomHelper::customParamArray($price, 'id', 'name');
        $price = \app\helpers\CustomHelper::custom_array_unshift($price, '— Выбрать —');

        $templates = \app\models\Page::getTemplateNamesArray();
        $templates = \app\helpers\CustomHelper::custom_array_unshift($templates, '— Выбрать —');

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('pageCreate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['create']);
            }
            if (empty($model->date_create)) {
                $model->date_create = time();
            } else {
                $model->date_create = \app\helpers\CustomHelper::custom_timestamp($model->date_create);
            }
            $model->lastmod = time();
            if(is_array($model->city)) $model->city = implode(',', $model->city);
            if ($model->validate()) {
                $model->parent = \app\helpers\CustomHelper::custom_empty_to_null($model->parent);
                $model->redirect = \app\helpers\CustomHelper::custom_empty_to_null($model->redirect);
                $model->title = \app\helpers\CustomHelper::custom_empty_to_null($model->title);
                $model->description = \app\helpers\CustomHelper::custom_empty_to_null($model->description);
                $model->image = \app\helpers\CustomHelper::custom_empty_to_null($model->image);
                $model->tag_header = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_header);
                $model->tag_body = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_body);
                $model->content = \app\helpers\CustomHelper::custom_empty_to_null($model->content);
                $model->content_aside = \app\helpers\CustomHelper::custom_empty_to_null($model->content_aside);
                $model->content_two_title_on = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two_title_on);
                $model->content_two_title = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two_title);
                $model->content_two_on = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two_on);
                $model->content_two = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two);
                $model->content_two_aside = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two_aside);
                $model->skryt_na_poddomene = \app\helpers\CustomHelper::custom_empty_to_null($model->skryt_na_poddomene);
                $model->city = \app\helpers\CustomHelper::custom_empty_to_null($model->city);
                $model->sh_pricerow = \app\helpers\CustomHelper::custom_empty_to_null($model->sh_pricerow);
                $model->customprice = \app\helpers\CustomHelper::custom_empty_to_null($model->customprice);
                $model->table = \app\helpers\CustomHelper::custom_empty_to_null($model->table);
                $model->after_table = \app\helpers\CustomHelper::custom_empty_to_null($model->after_table);
                $model->banner_id = \app\helpers\CustomHelper::custom_empty_to_null($model->banner_id);
                $model->sidebar_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->sidebar_visible);
                $model->sidebar_menu = \app\helpers\CustomHelper::custom_empty_to_null($model->sidebar_menu);
                $model->block_leadback_price_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_leadback_price_visible);
                $model->block_masters_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_masters_visible);
                $model->block_reviews_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_reviews_visible);
                $model->block_benefits_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_benefits_visible);
                $model->block_how_we_work_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_how_we_work_visible);
                $model->block_how_we_work_4_title = \app\helpers\CustomHelper::custom_empty_to_null($model->block_how_we_work_4_title);
                $model->block_how_we_work_4_text = \app\helpers\CustomHelper::custom_empty_to_null($model->block_how_we_work_4_text);
                $model->block_ulicy_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_ulicy_visible);
                $model->block_districts_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_districts_visible);
                $model->block_leadback_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_leadback_visible);
                $model->date_create = \app\helpers\CustomHelper::custom_empty_to_null($model->date_create);
                if($model->save()){
                    Yii::$app->session->setFlash('success', "Запись успешно добавлена");

                    // создаем поисковой индекс
                    Searchindex::create($model->id, $model->name, $model->permalink, $model->visible);

                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    Yii::$app->session->setFlash('error', "Не удалось добавить запись!");
                }
            }else{
                Yii::$app->session->setFlash('error', "Не удалось добавить запись!");
            }
        }

        return $this->render('create', [
            'model' => $model,
            'banner' => $banner,
            'city' => $city,
            'price' => $price,
            'templates' => $templates,
        ]);
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->can('pageView');
        $model = $this->findModel($id);
        $model->city = explode(',', $model->city);

        if (!empty($model->date_create)) {
            $model->date_create = \app\helpers\CustomHelper::custom_date($model->date_create);
        }

        $banner = Banner::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $banner = \app\helpers\CustomHelper::customParamArray($banner, 'id', 'name');
        $banner = \app\helpers\CustomHelper::custom_array_unshift($banner, '— Выбрать —');

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        $price = Price::find()->select(['id', 'name', 'price_region', 'price_msk', 'unit'])->asArray()->all();
        $price_count = count($price);
        for ($i=0; $i < $price_count; $i++) { 
            if (!empty($price[$i])) {
                $price[$i]['name'] = $price[$i]['name'] . ' ('.$price[$i]['price_region'].'/'.$price[$i]['unit'].') МСК - ' . $price[$i]['price_msk'].'/'.$price[$i]['unit'];
            }
        }
        $price = \app\helpers\CustomHelper::customParamArray($price, 'id', 'name');
        $price = \app\helpers\CustomHelper::custom_array_unshift($price, '— Выбрать —');

        $templates = \app\models\Page::getTemplateNamesArray();
        $templates = \app\helpers\CustomHelper::custom_array_unshift($templates, '— Выбрать —');

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('pageUpdate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['update', 'id' => $id]);
            }
            if (empty($model->date_create)) {
                $model->date_create = time();
            } else {
                $model->date_create = \app\helpers\CustomHelper::custom_timestamp($model->date_create);
            }
            $model->lastmod = time();
            if(is_array($model->city)) $model->city = implode(',', $model->city);
            if ($model->validate()) {
                $model->parent = \app\helpers\CustomHelper::custom_empty_to_null($model->parent);
                $model->redirect = \app\helpers\CustomHelper::custom_empty_to_null($model->redirect);
                $model->title = \app\helpers\CustomHelper::custom_empty_to_null($model->title);
                $model->description = \app\helpers\CustomHelper::custom_empty_to_null($model->description);
                $model->image = \app\helpers\CustomHelper::custom_empty_to_null($model->image);
                $model->tag_header = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_header);
                $model->tag_body = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_body);
                $model->content = \app\helpers\CustomHelper::custom_empty_to_null($model->content);
                $model->content_aside = \app\helpers\CustomHelper::custom_empty_to_null($model->content_aside);
                $model->content_two_title_on = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two_title_on);
                $model->content_two_title = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two_title);
                $model->content_two_on = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two_on);
                $model->content_two = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two);
                $model->content_two_aside = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two_aside);
                $model->skryt_na_poddomene = \app\helpers\CustomHelper::custom_empty_to_null($model->skryt_na_poddomene);
                $model->city = \app\helpers\CustomHelper::custom_empty_to_null($model->city);
                $model->sh_pricerow = \app\helpers\CustomHelper::custom_empty_to_null($model->sh_pricerow);
                $model->customprice = \app\helpers\CustomHelper::custom_empty_to_null($model->customprice);
                $model->table = \app\helpers\CustomHelper::custom_empty_to_null($model->table);
                $model->after_table = \app\helpers\CustomHelper::custom_empty_to_null($model->after_table);
                $model->banner_id = \app\helpers\CustomHelper::custom_empty_to_null($model->banner_id);
                $model->sidebar_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->sidebar_visible);
                $model->sidebar_menu = \app\helpers\CustomHelper::custom_empty_to_null($model->sidebar_menu);
                $model->block_leadback_price_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_leadback_price_visible);
                $model->block_masters_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_masters_visible);
                $model->block_reviews_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_reviews_visible);
                $model->block_benefits_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_benefits_visible);
                $model->block_how_we_work_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_how_we_work_visible);
                $model->block_how_we_work_4_title = \app\helpers\CustomHelper::custom_empty_to_null($model->block_how_we_work_4_title);
                $model->block_how_we_work_4_text = \app\helpers\CustomHelper::custom_empty_to_null($model->block_how_we_work_4_text);
                $model->block_ulicy_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_ulicy_visible);
                $model->block_districts_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_districts_visible);
                $model->block_leadback_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_leadback_visible);
                $model->date_create = \app\helpers\CustomHelper::custom_empty_to_null($model->date_create);
                if($model->save()){
                    Yii::$app->session->setFlash('success', "Запись успешно обновлена");

                    // создаем поисковой индекс
                    Searchindex::create($model->id, $model->name, $model->permalink, $model->visible);

                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    Yii::$app->session->setFlash('error', "Не удалось обновить запись!");
                }
            }else{
                Yii::$app->session->setFlash('error', "Не удалось обновить запись!");
            }
        }

        return $this->render('update', [
            'model' => $model,
            'banner' => $banner,
            'city' => $city,
            'price' => $price,
            'templates' => $templates,
        ]);
    }

    /**
     * Copy a new Page model.
     * If copy is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCopy($id)
    {
        $this->can('pageView');
        // $this->can('pageCreate');
        $model = new Page();

        $banner = Banner::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $banner = \app\helpers\CustomHelper::customParamArray($banner, 'id', 'name');
        $banner = \app\helpers\CustomHelper::custom_array_unshift($banner, '— Выбрать —');

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        $price = Price::find()->select(['id', 'name', 'price_region', 'price_msk', 'unit'])->asArray()->all();
        $price_count = count($price);
        for ($i=0; $i < $price_count; $i++) { 
            if (!empty($price[$i])) {
                $price[$i]['name'] = $price[$i]['name'] . ' ('.$price[$i]['price_region'].'/'.$price[$i]['unit'].') МСК - ' . $price[$i]['price_msk'].'/'.$price[$i]['unit'];
            }
        }
        $price = \app\helpers\CustomHelper::customParamArray($price, 'id', 'name');
        $price = \app\helpers\CustomHelper::custom_array_unshift($price, '— Выбрать —');

        $templates = \app\models\Page::getTemplateNamesArray();
        $templates = \app\helpers\CustomHelper::custom_array_unshift($templates, '— Выбрать —');

        $modelCopy = $this->findModel($id);
        if (!empty($modelCopy)) {
            $modelCopy->city = explode(',', $modelCopy->city);
            $modelCopy = $modelCopy->getAttributes();
            if (!empty($modelCopy) && is_array($modelCopy)) {
                foreach ($modelCopy as $key => $value) {
                    if ($key !== 'id' && $key !== 'permalink') {
                        $model->$key = $value;
                    }
                }
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('pageCreate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['create']);
            }
            if (empty($model->date_create)) {
                $model->date_create = time();
            } else {
                $model->date_create = \app\helpers\CustomHelper::custom_timestamp($model->date_create);
            }
            $model->lastmod = time();
            if(is_array($model->city)) $model->city = implode(',', $model->city);
            if ($model->validate()) {
                $model->parent = \app\helpers\CustomHelper::custom_empty_to_null($model->parent);
                $model->redirect = \app\helpers\CustomHelper::custom_empty_to_null($model->redirect);
                $model->title = \app\helpers\CustomHelper::custom_empty_to_null($model->title);
                $model->description = \app\helpers\CustomHelper::custom_empty_to_null($model->description);
                $model->image = \app\helpers\CustomHelper::custom_empty_to_null($model->image);
                $model->tag_header = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_header);
                $model->tag_body = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_body);
                $model->content = \app\helpers\CustomHelper::custom_empty_to_null($model->content);
                $model->content_two_title_on = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two_title_on);
                $model->content_two_title = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two_title);
                $model->content_two_on = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two_on);
                $model->content_two = \app\helpers\CustomHelper::custom_empty_to_null($model->content_two);
                $model->skryt_na_poddomene = \app\helpers\CustomHelper::custom_empty_to_null($model->skryt_na_poddomene);
                $model->city = \app\helpers\CustomHelper::custom_empty_to_null($model->city);
                $model->sh_pricerow = \app\helpers\CustomHelper::custom_empty_to_null($model->sh_pricerow);
                $model->customprice = \app\helpers\CustomHelper::custom_empty_to_null($model->customprice);
                $model->table = \app\helpers\CustomHelper::custom_empty_to_null($model->table);
                $model->banner_id = \app\helpers\CustomHelper::custom_empty_to_null($model->banner_id);
                $model->sidebar_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->sidebar_visible);
                $model->sidebar_menu = \app\helpers\CustomHelper::custom_empty_to_null($model->sidebar_menu);
                $model->block_leadback_price_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_leadback_price_visible);
                $model->block_masters_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_masters_visible);
                $model->block_reviews_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_reviews_visible);
                $model->block_benefits_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_benefits_visible);
                $model->block_how_we_work_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_how_we_work_visible);
                $model->block_how_we_work_4_title = \app\helpers\CustomHelper::custom_empty_to_null($model->block_how_we_work_4_title);
                $model->block_how_we_work_4_text = \app\helpers\CustomHelper::custom_empty_to_null($model->block_how_we_work_4_text);
                $model->block_ulicy_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_ulicy_visible);
                $model->block_districts_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_districts_visible);
                $model->block_leadback_visible = \app\helpers\CustomHelper::custom_empty_to_null($model->block_leadback_visible);
                $model->date_create = \app\helpers\CustomHelper::custom_empty_to_null($model->date_create);
                if($model->save()){
                    Yii::$app->session->setFlash('success', "Запись успешно добавлена");

                    // создаем поисковой индекс
                    Searchindex::create($model->id, $model->name, $model->permalink, $model->visible);

                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    Yii::$app->session->setFlash('error', "Не удалось добавить запись!");
                }
            }else{
                Yii::$app->session->setFlash('error', "Не удалось добавить запись!");
            }
        }

        return $this->render('copy', [
            'model' => $model,
            'banner' => $banner,
            'city' => $city,
            'price' => $price,
            'templates' => $templates,
        ]);
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->can('pageDelete');
        $model = $this->findModel($id);
        $this->beforeDelete($model);
        if( $model->delete() ){
            Searchindex::deleteAll(['page_id' => $id]);
            Yii::$app->session->setFlash('success', "Запись удалена");
        }else{
            Yii::$app->session->setFlash('error', "Не удалось удалить запись!");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * Прикрепленные партнеры
     */
    public function actionPartners()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModelAttributes = $searchModel->getAttributes();

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        $parents = Page::find()->select(['parent AS id', 'parent'])->where(['is not', 'parent', null])->andWhere(['>', 'parent', 0])->groupBy(['parent'])->asArray()->all();
        $parents = \app\helpers\CustomHelper::customParamArray($parents, 'id', 'parent');

        $partners_query = Partner::find()->select(['id', 'name', 'page']);
        if (!empty($searchModelAttributes['city'])) {
            $partners_query->where([
                'OR',
                ['like', 'city', $searchModelAttributes['city'], false],
                ['like', 'city', $searchModelAttributes['city'].',%', false],
                ['like', 'city', '%,'.$searchModelAttributes['city'], false],
                ['like', 'city', '%,'.$searchModelAttributes['city'].',%', false],
            ]);
        }
        $partners = $partners_query->asArray()->all();

        $partner_pages = \app\helpers\CustomHelper::customParamArray($partners, 'id', 'page');

        $data = array();
        if (!empty($partners)) {
            foreach ($partners as $partner) {
                if (!empty($partner) && !empty($partner['page'])) {
                    $pages = explode(',', $partner['page']);
                    if (!empty($pages) && is_array($pages)) {
                        foreach ($pages as $one) {
                            if (!empty($one)) {
                                if (empty($data[$one])) {
                                    $data[$one] = array();
                                }
                                $data[$one][$partner['id']] = $partner['name'];
                            }
                        }
                    }
                }
            }
        }
        $partners = $data;
        unset($data);


        $partnercontacts_query = Partnercontact::find()->select(['id', 'name', 'partner_id']);
        $partnercontacts = $partnercontacts_query->asArray()->all();
        $data = array();
        if (!empty($partnercontacts)) {
            foreach ($partnercontacts as $partnercontact) {
                if (!empty($partnercontact) && !empty($partnercontact['partner_id']) && !empty($partner_pages[$partnercontact['partner_id']])) {
                    $pages = $partner_pages[$partnercontact['partner_id']];
                    $pages = explode(',', $pages);
                    if (!empty($pages) && is_array($pages)) {
                        foreach ($pages as $one) {
                            if (!empty($one)) {
                                if (empty($data[$one])) {
                                    $data[$one] = array();
                                }
                                if (!empty($partners) && !empty($partners[$one]) && !empty($partners[$one][$partnercontact['partner_id']])) {
                                    $data[$one][$partnercontact['id']] = $partnercontact['name'];
                                }
                            }
                        }
                    }
                }
            }
        }
        $partnercontacts = $data;
        unset($data);


        return $this->render('partners', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'city' => $city,
            'parents' => $parents,
            'partners' => $partners,
            'partnercontacts' => $partnercontacts,
        ]);
    }

    /**
     * Массовое редактирование страниц
     */
    public function actionMassUpdate($visible)
    {
        $act = (!empty($visible)) ? 'включить' : 'скрыть';

        if (!Yii::$app->user->can('pageUpdate')) {
            Yii::$app->session->setFlash('error', "Не удалось {$act} страницы. Доступ закрыт.");
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->post()) {
            
            $post = Yii::$app->request->post();
            if (!empty($post) && !empty($post['pages'])) {
                $pages = preg_replace('/[^\d,]/', '', $post['pages']);
                if (!empty($pages)) {
                    $pages = explode(',', $pages);
                    if (!empty($pages) && is_array($pages)) {

                        if (!empty($visible)) {
                            $res = Page::updateAll(['visible' => 1], ['id' => $pages]);
                        } else {
                            $res = Page::updateAll(['visible' => 0], ['id' => $pages]);
                        }

                        if (!empty($res)) {
                            $message = (!empty($visible)) ? "Включено {$res} страниц" : "Скрыто {$res} страниц";
                            Yii::$app->session->setFlash('success', $message);
                            return $this->redirect(['index']);
                        }
                    }
                }
            }
        }
        Yii::$app->session->setFlash('error', "Не удалось {$act} страницы");
        return $this->redirect(['index']);
    }
}

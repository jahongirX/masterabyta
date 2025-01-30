<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Partner;
use app\modules\admin\models\PartnerSearch;
use app\modules\admin\models\Page;
use app\modules\admin\models\City;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * PartnerController implements the CRUD actions for Partner model.
 */
class PartnerController extends AppController
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
     * Lists all Partner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->can('partnerView');
        $searchModel = new PartnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $page = Page::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $page = \app\helpers\CustomHelper::customParamArray($page, 'id', 'name');

        $city = City::find()->select(['id', 'name'])->orderBy(['number' => SORT_ASC, 'id' => SORT_ASC])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'page' => $page,
            'city' => $city,
        ]);
    }

    /**
     * Displays a single Partner model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->can('partnerView');
        $model = $this->findModel($id);
        $model->page = explode(',', $model->page);
        $model->city = explode(',', $model->city);

        $page = Page::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $page = \app\helpers\CustomHelper::customParamArray($page, 'id', 'name');

        $city = City::find()->select(['id', 'name'])->orderBy(['number' => SORT_ASC, 'id' => SORT_ASC])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');
        
        return $this->render('view', [
            'model' => $model,
            'page' => $page,
            'city' => $city,
        ]);
    }

    /**
     * Creates a new Partner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->can('partnerView');
        // $this->can('partnerCreate');
        $model = new Partner();

        $page = Page::find()->where(['visible' => 1])->select(['id', 'name'])->orderBy(['name' => SORT_ASC])->asArray()->all();
        $page = \app\helpers\CustomHelper::customParamArray($page, 'id', 'name');

        $city = City::find()->where(['visible' => 1])->select(['id', 'name'])->orderBy(['name' => SORT_ASC])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('partnerCreate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['create']);
            }
            if(is_array($model->page)) $model->page = implode(',', $model->page);
            if(is_array($model->city)) $model->city = implode(',', $model->city);
            if ($model->validate()) {
                $model->params = \app\helpers\CustomHelper::custom_empty_to_null($model->params);
                $model->phone = \app\helpers\CustomHelper::custom_empty_to_null($model->phone);
                $model->front_email = \app\helpers\CustomHelper::custom_empty_to_null($model->front_email);
                $model->wokrtime = \app\helpers\CustomHelper::custom_empty_to_null($model->wokrtime);
                $model->tag_header = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_header);
                $model->tag_body = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_body);
                $model->page = \app\helpers\CustomHelper::custom_empty_to_null($model->page);
                $model->city = \app\helpers\CustomHelper::custom_empty_to_null($model->city);
                $model->mail_subject = \app\helpers\CustomHelper::custom_empty_to_null($model->mail_subject);

                // проверка на уникальность Город + Категория
                /*
                $where_city_page = array();
                $partner_page = explode(',', $model->page);
                $partner_city = explode(',', $model->city);
                if (!empty($partner_page) && is_array($partner_page) && !empty($partner_city) && is_array($partner_city)) {
                    foreach ($partner_city as $one_city) {
                        if (!empty($one_city)) {
                            foreach ($partner_page as $one_page) {
                                if (!empty($one_page)) {
                                    $where_city_page[] = array(
                                        'AND',
                                        [
                                            'OR',
                                            ['like', 'city', $one_city, false],
                                            ['like', 'city', $one_city.',%', false],
                                            ['like', 'city', '%,'.$one_city, false],
                                            ['like', 'city', '%,'.$one_city.',%', false],
                                        ],
                                        [
                                            'OR',
                                            ['like', 'page', $one_page, false],
                                            ['like', 'page', $one_page.',%', false],
                                            ['like', 'page', '%,'.$one_page, false],
                                            ['like', 'page', '%,'.$one_page.',%', false],
                                        ],
                                    );
                                }
                            }
                        }
                    }
                }
                if (!empty($where_city_page)) {
                    $where_city_page[-1] = 'OR';
                    sort($where_city_page);
                    $partner_city_page_double = Partner::find()->select(['id', 'name'])->where($where_city_page)->asArray()->all();
                    $partner_city_page_double = \app\helpers\CustomHelper::customParamArray($partner_city_page_double, 'id', 'name');
                    if (!empty($partner_city_page_double)) {
                        $double_array = array();
                        foreach ($partner_city_page_double as $one_double_id => $one_double_name) {
                            $double_array[] = '<a target="_blank", rel="nofollow noopener noreferrer" href="'.Url::to(['/admin/partner/view', 'id' => $one_double_id]).'">'.$one_double_name.'</a>';
                        }
                        if (!empty($double_array)) {
                            $error = 'Не удалось добавить запись! <br>Дублируются город + категория с другими партерами: <br>' . implode('<br>', $double_array);
                            Yii::$app->session->setFlash('error', $error);
                            return $this->redirect(['create']);
                        }
                    }
                }
                */

                if($model->save()){
                    Yii::$app->session->setFlash('success', "Запись успешно добавлена");
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
            'page' => $page,
            'city' => $city,
        ]);
    }

    /**
     * Updates an existing Partner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->can('partnerView');
        // $this->can('partnerUpdate');
        $model = $this->findModel($id);
        $model->page = explode(',', $model->page);
        $model->city = explode(',', $model->city);

        $page = Page::find()->where(['visible' => 1])->select(['id', 'name'])->orderBy(['name' => SORT_ASC])->asArray()->all();
        $page = \app\helpers\CustomHelper::customParamArray($page, 'id', 'name');

        $city = City::find()->where(['visible' => 1])->select(['id', 'name'])->orderBy(['name' => SORT_ASC])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('partnerUpdate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['update', 'id' => $id]);
            }
            if(is_array($model->page)) $model->page = implode(',', $model->page);
            if(is_array($model->city)) $model->city = implode(',', $model->city);
            if ($model->validate()) {
                $model->params = \app\helpers\CustomHelper::custom_empty_to_null($model->params);
                $model->phone = \app\helpers\CustomHelper::custom_empty_to_null($model->phone);
                $model->front_email = \app\helpers\CustomHelper::custom_empty_to_null($model->front_email);
                $model->wokrtime = \app\helpers\CustomHelper::custom_empty_to_null($model->wokrtime);
                $model->tag_header = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_header);
                $model->tag_body = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_body);
                $model->page = \app\helpers\CustomHelper::custom_empty_to_null($model->page);
                $model->city = \app\helpers\CustomHelper::custom_empty_to_null($model->city);
                $model->mail_subject = \app\helpers\CustomHelper::custom_empty_to_null($model->mail_subject);

                // проверка на уникальность Город + Категория
                /*
                $where_city_page = array();
                $partner_page = explode(',', $model->page);
                $partner_city = explode(',', $model->city);
                if (!empty($partner_page) && is_array($partner_page) && !empty($partner_city) && is_array($partner_city)) {
                    foreach ($partner_city as $one_city) {
                        if (!empty($one_city)) {
                            foreach ($partner_page as $one_page) {
                                if (!empty($one_page)) {
                                    $where_city_page[] = array(
                                        'AND',
                                        [
                                            'OR',
                                            ['like', 'city', $one_city, false],
                                            ['like', 'city', $one_city.',%', false],
                                            ['like', 'city', '%,'.$one_city, false],
                                            ['like', 'city', '%,'.$one_city.',%', false],
                                        ],
                                        [
                                            'OR',
                                            ['like', 'page', $one_page, false],
                                            ['like', 'page', $one_page.',%', false],
                                            ['like', 'page', '%,'.$one_page, false],
                                            ['like', 'page', '%,'.$one_page.',%', false],
                                        ],
                                    );
                                }
                            }
                        }
                    }
                }
                if (!empty($where_city_page)) {
                    $where_city_page[-1] = 'OR';
                    sort($where_city_page);
                    $partner_city_page_double = Partner::find()->select(['id', 'name'])->where($where_city_page)->andWhere(['!=', 'id', $model->id])->asArray()->all();
                    $partner_city_page_double = \app\helpers\CustomHelper::customParamArray($partner_city_page_double, 'id', 'name');
                    if (!empty($partner_city_page_double)) {
                        $double_array = array();
                        foreach ($partner_city_page_double as $one_double_id => $one_double_name) {
                            $double_array[] = '<a target="_blank", rel="nofollow noopener noreferrer" href="'.Url::to(['/admin/partner/view', 'id' => $one_double_id]).'">'.$one_double_name.'</a>';
                        }
                        if (!empty($double_array)) {
                            $error = 'Не удалось обновить запись! <br>Дублируются город + категория с другими партерами: <br>' . implode('<br>', $double_array);
                            Yii::$app->session->setFlash('error', $error);
                            return $this->redirect(['update', 'id' => $model->id]);
                        }
                    }
                }
                */

                if($model->save()){
                    Yii::$app->session->setFlash('success', "Запись успешно обновлена");
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
            'page' => $page,
            'city' => $city,
        ]);
    }

    /**
     * Deletes an existing Partner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->can('partnerDelete');
        $model = $this->findModel($id);
        $this->beforeDelete($model);
        if( $model->delete() ){
            Yii::$app->session->setFlash('success', "Запись удалена");
        }else{
            Yii::$app->session->setFlash('error', "Не удалось удалить запись!");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Partner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Partner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Partner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Привязываем/отвязываем город и страницы
     */
    public function actionCityManage($id)
    {
        $this->can('partnerUpdate');
        $partner = $this->findModel($id);
        $partner->page = explode(',', $partner->page);
        $partner->city = explode(',', $partner->city);
        $model = new \app\modules\admin\models\PartnerManageForm();

        if ($model->load(Yii::$app->request->post())) {

            $post = Yii::$app->request->post();
            $action = (!empty($post['action'])) ? $post['action'] : null;

            if (!empty($model->city)) {
                $city = array();
                $model->city = str_replace(["\r\n", "\r", "\n"], ',', $model->city);
                $model->city = explode(',', $model->city);
                if (!empty($model->city) && is_array($model->city)) {
                    foreach ($model->city as $one) {
                        $one_city = (int) $one;
                        if (!empty($one_city)) {
                            $city[] = $one_city;
                        }
                    }
                }
                $city = array_unique($city);
                if (!empty($city)) {
                    $city = City::find()->select(['id'])->where(['id' => $city])->asArray()->column();
                    if (!empty($city) && is_array($city)) {
                        if ($action === 'link') {
                            $partner->city = array_merge($partner->city, $city);
                        } elseif ($action === 'unlink') {
                            $partner->city = array_diff($partner->city, $city);
                        }
                        $partner->city = array_unique($partner->city);
                    }
                }
            }

            if (!empty($model->page)) {
                $page = array();
                $model->page = str_replace(["\r\n", "\r", "\n"], ',', $model->page);
                $model->page = explode(',', $model->page);
                if (!empty($model->page) && is_array($model->page)) {
                    foreach ($model->page as $one) {
                        $one_page = (int) $one;
                        if (!empty($one_page)) {
                            $page[] = $one_page;
                        }
                    }
                }
                $page = array_unique($page);
                if (!empty($page)) {
                    $page = Page::find()->select(['id'])->where(['id' => $page])->asArray()->column();
                    if (!empty($page) && is_array($page)) {
                        if ($action === 'link') {
                            $partner->page = array_merge($partner->page, $page);
                        } elseif ($action === 'unlink') {
                            $partner->page = array_diff($partner->page, $page);
                        }
                        $partner->page = array_unique($partner->page);
                    }
                }
            }

            $partner->page = implode(',', $partner->page);
            $partner->city = implode(',', $partner->city);

            if ($partner->validate()) {
                if($partner->save()){
                    Yii::$app->session->setFlash('success', "Запись успешно обновлена");
                    return $this->redirect(['view', 'id' => $partner->id]);
                }else{
                    Yii::$app->session->setFlash('error', "Не удалось обновить запись!");
                }
            }else{
                Yii::$app->session->setFlash('error', "Не удалось обновить запись!");
            }
        }

        return $this->render('city-manage', [
            'partner' => $partner,
            'model' => $model,
        ]);
    }
}

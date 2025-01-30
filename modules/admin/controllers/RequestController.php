<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Request;
use app\modules\admin\models\RequestSearch;
use app\modules\admin\models\City;
use app\modules\admin\models\Page;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends AppController
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
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->can('requestView');
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        $page = Page::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $page = \app\helpers\CustomHelper::customParamArray($page, 'id', 'name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'city' => $city,
            'page' => $page,
        ]);
    }

    /**
     * Displays a single Request model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->can('requestView');
        $model = $this->findModel($id);

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        $page = Page::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $page = \app\helpers\CustomHelper::customParamArray($page, 'id', 'name');
        
        return $this->render('view', [
            'model' => $model,
            'city' => $city,
            'page' => $page,
        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->can('requestView');
        $this->can('requestCreate');
        $model = new Request();

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');
        $city = \app\helpers\CustomHelper::custom_array_unshift($city, '— Выбрать —', FALSE);

        $page = Page::find()->select(['id', 'name'])->asArray()->all();
        $page = \app\helpers\CustomHelper::customParamArray($page, 'id', 'name');
        $page = \app\helpers\CustomHelper::custom_array_unshift($page, '— Выбрать —', FALSE);

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('requestCreate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['create']);
            }
            $model->date = time();
            if ($model->validate()) {
                $model->phone = \app\helpers\CustomHelper::custom_empty_to_null($model->phone);
                $model->city = \app\helpers\CustomHelper::custom_empty_to_null($model->city);
                $model->page = \app\helpers\CustomHelper::custom_empty_to_null($model->page);
                $model->partner = \app\helpers\CustomHelper::custom_empty_to_null($model->partner);
                $model->rukiizplech_code = \app\helpers\CustomHelper::custom_empty_to_null($model->rukiizplech_code);
                $model->servicelead_code = \app\helpers\CustomHelper::custom_empty_to_null($model->servicelead_code);

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
            'city' => $city,
            'page' => $page,
        ]);
    }

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->can('requestView');
        $this->can('requestUpdate');
        $model = $this->findModel($id);

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');
        $city = \app\helpers\CustomHelper::custom_array_unshift($city, '— Выбрать —', FALSE);

        $page = Page::find()->select(['id', 'name'])->asArray()->all();
        $page = \app\helpers\CustomHelper::customParamArray($page, 'id', 'name');
        $page = \app\helpers\CustomHelper::custom_array_unshift($page, '— Выбрать —', FALSE);

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('requestUpdate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['update', 'id' => $id]);
            }
            if ($model->validate()) {
                $model->phone = \app\helpers\CustomHelper::custom_empty_to_null($model->phone);
                $model->city = \app\helpers\CustomHelper::custom_empty_to_null($model->city);
                $model->page = \app\helpers\CustomHelper::custom_empty_to_null($model->page);
                $model->partner = \app\helpers\CustomHelper::custom_empty_to_null($model->partner);
                $model->rukiizplech_code = \app\helpers\CustomHelper::custom_empty_to_null($model->rukiizplech_code);
                $model->servicelead_code = \app\helpers\CustomHelper::custom_empty_to_null($model->servicelead_code);

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
            'city' => $city,
            'page' => $page,
        ]);
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->can('requestDelete');
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
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

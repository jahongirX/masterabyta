<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\City;
use app\modules\admin\models\CitySearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CityController implements the CRUD actions for City model.
 */
class CityController extends AppController
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
     * Lists all City models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->can('cityView');
        $searchModel = new CitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single City model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->can('cityView');
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new City model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->can('cityView');
        $model = new City();

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('cityCreate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['create']);
            }
            if ($model->validate()) {
                $model->params = \app\helpers\CustomHelper::custom_empty_to_null($model->params);
                $model->map = \app\helpers\CustomHelper::custom_empty_to_null($model->map);
                $model->address = \app\helpers\CustomHelper::custom_empty_to_null($model->address);
                $model->front_email = \app\helpers\CustomHelper::custom_empty_to_null($model->front_email);
                $model->phone = \app\helpers\CustomHelper::custom_empty_to_null($model->phone);
                $model->wokrtime = \app\helpers\CustomHelper::custom_empty_to_null($model->wokrtime);
                $model->back_email = \app\helpers\CustomHelper::custom_empty_to_null($model->back_email);
                $model->district = \app\helpers\CustomHelper::custom_empty_to_null($model->district);
                $model->street = \app\helpers\CustomHelper::custom_empty_to_null($model->street);
                $model->metro = \app\helpers\CustomHelper::custom_empty_to_null($model->metro);
                $model->shortcode_remont = \app\helpers\CustomHelper::custom_empty_to_null($model->shortcode_remont);
                $model->tag_header = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_header);
                $model->tag_body = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_body);
                $model->robots_txt = \app\helpers\CustomHelper::custom_empty_to_null($model->robots_txt);
                $model->number = \app\helpers\CustomHelper::custom_empty_to_null($model->number);
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
        ]);
    }

    /**
     * Updates an existing City model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->can('cityView');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('cityUpdate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['update', 'id' => $id]);
            }
            if ($model->validate()) {
                $model->params = \app\helpers\CustomHelper::custom_empty_to_null($model->params);
                $model->map = \app\helpers\CustomHelper::custom_empty_to_null($model->map);
                $model->address = \app\helpers\CustomHelper::custom_empty_to_null($model->address);
                $model->front_email = \app\helpers\CustomHelper::custom_empty_to_null($model->front_email);
                $model->phone = \app\helpers\CustomHelper::custom_empty_to_null($model->phone);
                $model->wokrtime = \app\helpers\CustomHelper::custom_empty_to_null($model->wokrtime);
                $model->back_email = \app\helpers\CustomHelper::custom_empty_to_null($model->back_email);
                $model->district = \app\helpers\CustomHelper::custom_empty_to_null($model->district);
                $model->street = \app\helpers\CustomHelper::custom_empty_to_null($model->street);
                $model->metro = \app\helpers\CustomHelper::custom_empty_to_null($model->metro);
                $model->shortcode_remont = \app\helpers\CustomHelper::custom_empty_to_null($model->shortcode_remont);
                $model->tag_header = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_header);
                $model->tag_body = \app\helpers\CustomHelper::custom_empty_to_null($model->tag_body);
                $model->robots_txt = \app\helpers\CustomHelper::custom_empty_to_null($model->robots_txt);
                $model->number = \app\helpers\CustomHelper::custom_empty_to_null($model->number);
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
        ]);
    }

    /**
     * Deletes an existing City model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->can('cityDelete');
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
     * Finds the City model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return City the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = City::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Массовое редактирование городов
     */
    public function actionMassUpdate($visible)
    {
        $act = (!empty($visible)) ? 'включить' : 'скрыть';

        if (!Yii::$app->user->can('cityUpdate')) {
            Yii::$app->session->setFlash('error', "Не удалось {$act} города. Доступ закрыт.");
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->post()) {
            
            $post = Yii::$app->request->post();
            if (!empty($post) && !empty($post['cities'])) {
                $cities = preg_replace('/[^\d,]/', '', $post['cities']);
                if (!empty($cities)) {
                    $cities = explode(',', $cities);
                    if (!empty($cities) && is_array($cities)) {

                        if (!empty($visible)) {
                            $res = City::updateAll(['visible' => 1], ['id' => $cities]);
                        } else {
                            $res = City::updateAll(['visible' => 0], ['id' => $cities]);
                        }

                        if (!empty($res)) {
                            $message = (!empty($visible)) ? "Включено {$res} городов" : "Скрыто {$res} городов";
                            Yii::$app->session->setFlash('success', $message);
                            return $this->redirect(['index']);
                        }
                    }
                }
            }
        }
        Yii::$app->session->setFlash('error', "Не удалось {$act} города");
        return $this->redirect(['index']);
    }
}

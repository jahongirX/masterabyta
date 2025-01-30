<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Master;
use app\modules\admin\models\MasterSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MasterController implements the CRUD actions for Master model.
 */
class MasterController extends AppController
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
     * Lists all Master models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->can('masterView');
        $searchModel = new MasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Master model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->can('masterView');
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Master model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->can('masterView');
        $model = new Master();

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('masterCreate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['create']);
            }
            if ($model->validate()) {
                $model->image = \app\helpers\CustomHelper::custom_empty_to_null($model->image);
                $model->projects = \app\helpers\CustomHelper::custom_empty_to_null($model->projects);
                $model->experience = \app\helpers\CustomHelper::custom_empty_to_null($model->experience);
                $model->age = \app\helpers\CustomHelper::custom_empty_to_null($model->age);
                $model->specialization = \app\helpers\CustomHelper::custom_empty_to_null($model->specialization);
                $model->in_company = \app\helpers\CustomHelper::custom_empty_to_null($model->in_company);
                $model->about = \app\helpers\CustomHelper::custom_empty_to_null($model->about);
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
     * Updates an existing Master model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->can('masterView');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('masterUpdate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['update', 'id' => $id]);
            }
            if ($model->validate()) {
                $model->image = \app\helpers\CustomHelper::custom_empty_to_null($model->image);
                $model->projects = \app\helpers\CustomHelper::custom_empty_to_null($model->projects);
                $model->experience = \app\helpers\CustomHelper::custom_empty_to_null($model->experience);
                $model->age = \app\helpers\CustomHelper::custom_empty_to_null($model->age);
                $model->specialization = \app\helpers\CustomHelper::custom_empty_to_null($model->specialization);
                $model->in_company = \app\helpers\CustomHelper::custom_empty_to_null($model->in_company);
                $model->about = \app\helpers\CustomHelper::custom_empty_to_null($model->about);
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
     * Deletes an existing Master model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->can('masterDelete');
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
     * Finds the Master model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Master the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Master::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

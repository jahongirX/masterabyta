<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Review;
use app\modules\admin\models\ReviewSearch;
use app\modules\admin\models\Master;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReviewController implements the CRUD actions for Review model.
 */
class ReviewController extends AppController
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
     * Lists all Review models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->can('reviewView');
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $master = Master::find()->select(['id', 'name'])->asArray()->all();
        $master = \app\helpers\CustomHelper::customParamArray($master, 'id', 'name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'master' => $master,
        ]);
    }

    /**
     * Displays a single Review model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->can('reviewView');
        $model = $this->findModel($id);

        $master = Master::find()->select(['id', 'name'])->asArray()->all();
        $master = \app\helpers\CustomHelper::customParamArray($master, 'id', 'name');
        
        return $this->render('view', [
            'model' => $model,
            'master' => $master,
        ]);
    }

    /**
     * Creates a new Review model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->can('reviewView');
        $model = new Review();

        $master = Master::find()->select(['id', 'name'])->asArray()->all();
        $master = \app\helpers\CustomHelper::customParamArray($master, 'id', 'name');
        $master = \app\helpers\CustomHelper::custom_array_unshift($master, '— Выбрать —');

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('reviewCreate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['create']);
            }
            if (empty($model->date)) {
                $model->date = time();
                $model->date = \app\helpers\CustomHelper::custom_date($model->date);
            }
            if ($model->validate()) {
                $model->date = \app\helpers\CustomHelper::custom_timestamp($model->date);
                $model->master = \app\helpers\CustomHelper::custom_empty_to_null($model->master);
                $model->service = \app\helpers\CustomHelper::custom_empty_to_null($model->service);
                $model->rating = \app\helpers\CustomHelper::custom_empty_to_null($model->rating);
                $model->text = \app\helpers\CustomHelper::custom_empty_to_null($model->text);
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
            'master' => $master,
        ]);
    }

    /**
     * Updates an existing Review model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->can('reviewView');
        $model = $this->findModel($id);
        $model->date = \app\helpers\CustomHelper::custom_date($model->date);

        $master = Master::find()->select(['id', 'name'])->asArray()->all();
        $master = \app\helpers\CustomHelper::customParamArray($master, 'id', 'name');
        $master = \app\helpers\CustomHelper::custom_array_unshift($master, '— Выбрать —');

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('reviewUpdate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['update', 'id' => $id]);
            }
            if ($model->validate()) {
                $model->date = \app\helpers\CustomHelper::custom_timestamp($model->date);
                $model->master = \app\helpers\CustomHelper::custom_empty_to_null($model->master);
                $model->service = \app\helpers\CustomHelper::custom_empty_to_null($model->service);
                $model->rating = \app\helpers\CustomHelper::custom_empty_to_null($model->rating);
                $model->text = \app\helpers\CustomHelper::custom_empty_to_null($model->text);
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
            'master' => $master,
        ]);
    }

    /**
     * Deletes an existing Review model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->can('reviewDelete');
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
     * Finds the Review model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Review the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Review::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

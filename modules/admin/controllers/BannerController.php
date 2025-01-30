<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Banner;
use app\modules\admin\models\BannerSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends AppController
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
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->can('bannerView');
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->can('bannerView');
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->can('bannerCreate');
        $model = new Banner();

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('bannerCreate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['create']);
            }
            if ($model->validate()) {
                $model->header = \app\helpers\CustomHelper::custom_empty_to_null($model->header);
                $model->subtitle = \app\helpers\CustomHelper::custom_empty_to_null($model->subtitle);
                $model->image = \app\helpers\CustomHelper::custom_empty_to_null($model->image);
                $model->form = \app\helpers\CustomHelper::custom_empty_to_null($model->form);
                $model->button = \app\helpers\CustomHelper::custom_empty_to_null($model->button);
                $model->note = \app\helpers\CustomHelper::custom_empty_to_null($model->note);
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
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->can('bannerUpdate');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('bannerUpdate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['update', 'id' => $id]);
            }
            if ($model->validate()) {
                $model->header = \app\helpers\CustomHelper::custom_empty_to_null($model->header);
                $model->subtitle = \app\helpers\CustomHelper::custom_empty_to_null($model->subtitle);
                $model->image = \app\helpers\CustomHelper::custom_empty_to_null($model->image);
                $model->form = \app\helpers\CustomHelper::custom_empty_to_null($model->form);
                $model->button = \app\helpers\CustomHelper::custom_empty_to_null($model->button);
                $model->note = \app\helpers\CustomHelper::custom_empty_to_null($model->note);
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
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->can('bannerDelete');
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
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionItems(){
        $banners = Banner::find()->all();
        if (!empty($banners)) {
            foreach ($banners as $banner) {
                $items = array();
                if (!empty($banner->item1)) {
                    $items[] = $banner->item1;
                }
                if (!empty($banner->item2)) {
                    $items[] = $banner->item2;
                }
                if (!empty($banner->item3)) {
                    $items[] = $banner->item3;
                }
                if (!empty($banner->item4)) {
                    $items[] = $banner->item4;
                }

                if (!empty($items)) {
                    $banner->item = implode("\r\n", $items);
                }

                $banner->use_page_header = 0;
                $banner->validate();
                $banner->save();

            }
        
        }
    }
}

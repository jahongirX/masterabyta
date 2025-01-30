<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Price;
use app\modules\admin\models\PriceSearch;
use app\modules\admin\models\PriceSection;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PriceController implements the CRUD actions for Price model.
 */
class PriceController extends AppController
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
     * Lists all Price models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->can('priceView');
        $searchModel = new PriceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $price_section = PriceSection::find()->select(['id', 'name'])->asArray()->all();
        $price_section = \app\helpers\CustomHelper::customParamArray($price_section, 'id', 'name');

        $units = Price::find()->select(['unit AS id', 'unit'])->where(['is not', 'unit', null])->andWhere(['>', 'unit', 0])->groupBy(['unit'])->asArray()->all();
        $units = \app\helpers\CustomHelper::customParamArray($units, 'id', 'unit');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'price_section' => $price_section,
            'units' => $units,
        ]);
    }

    /**
     * Displays a single Price model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->can('priceView');
        $model = $this->findModel($id);

        $price_section = PriceSection::find()->select(['id', 'name'])->asArray()->all();
        $price_section = \app\helpers\CustomHelper::customParamArray($price_section, 'id', 'name');

        return $this->render('view', [
            'model' => $model,
            'price_section' => $price_section,
        ]);
    }

    /**
     * Creates a new Price model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $this->can('priceCreate');
        $model = new Price();

        $tableName = Price::tableName();
        $id = \app\helpers\CustomHelper::getAutoIncrement($tableName);
        if (!empty($id)) {
            $model->number = $id;
        }

        $price_section = PriceSection::find()->select(['id', 'name'])->asArray()->all();
        $price_section = \app\helpers\CustomHelper::customParamArray($price_section, 'id', 'name');
        $price_section = \app\helpers\CustomHelper::custom_array_unshift($price_section, '— Выбрать —', FALSE);

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('priceCreate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['create']);
            }
            if ($model->validate()) {
                $model->price_section = \app\helpers\CustomHelper::custom_empty_to_null($model->price_section);
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
            'price_section' => $price_section,
        ]);
    }

    /**
     * Updates an existing Price model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // $this->can('priceUpdate');
        $model = $this->findModel($id);

        $price_section = PriceSection::find()->select(['id', 'name'])->asArray()->all();
        $price_section = \app\helpers\CustomHelper::customParamArray($price_section, 'id', 'name');
        $price_section = \app\helpers\CustomHelper::custom_array_unshift($price_section, '— Выбрать —', FALSE);

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('priceUpdate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['update', 'id' => $id]);
            }
            if ($model->validate()) {
                $model->price_section = \app\helpers\CustomHelper::custom_empty_to_null($model->price_section);
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', "Запись успешно обновлена");
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', "Не удалось обновить запись!");
                }
            } else {
                Yii::$app->session->setFlash('error', "Не удалось обновить запись!");
            }
        }

        return $this->render('update', [
            'model' => $model,
            'price_section' => $price_section,
        ]);
    }

    /**
     * Deletes an existing Price model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->can('priceDelete');
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
     * Finds the Price model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Price the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Price::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

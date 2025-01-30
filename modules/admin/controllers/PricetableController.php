<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Pricetable;
use app\modules\admin\models\PricetableSearch;
use app\modules\admin\models\Price;
use app\modules\admin\models\PriceSection;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PricetableController implements the CRUD actions for Pricetable model.
 */
class PricetableController extends AppController
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
     * Lists all Pricetable models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->can('pricetableView');
        $searchModel = new PricetableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $price = Price::find()->select(['id', 'name', 'price_section'])->asArray()->all();
        $price = \app\helpers\CustomHelper::customParamArray($price, 'id', 'name');

        $price_section = PriceSection::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $price_section = \app\helpers\CustomHelper::customParamArray($price_section, 'id', 'name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'price' => $price,
            'price_section' => $price_section,
        ]);
    }

    /**
     * Displays a single Pricetable model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->can('pricetableView');
        $model = $this->findModel($id);
        $model->price = explode(',', $model->price);

        $price = Price::find()->select(['id', 'name', 'price_section'])->asArray()->all();
        $price = \app\helpers\CustomHelper::customParamArray($price, 'id', 'name');

        $price_section = PriceSection::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $price_section = \app\helpers\CustomHelper::customParamArray($price_section, 'id', 'name');
        
        return $this->render('view', [
            'model' => $model,
            'price' => $price,
            'price_section' => $price_section,
        ]);
    }

    /**
     * Creates a new Pricetable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->can('pricetableCreate');
        $model = new Pricetable();

        $price = Price::find()->select(['id', 'name', 'price_section'])->asArray()->all();
        // $price = \app\helpers\CustomHelper::customParamArray($price, 'id', 'name');
        // $price = \app\helpers\CustomHelper::custom_array_unshift($price, '— Выбрать —', FALSE);

        $price_section = PriceSection::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $price_section = \app\helpers\CustomHelper::customParamArray($price_section, 'id', 'name');
        $price_section = \app\helpers\CustomHelper::custom_array_unshift($price_section, '— Выбрать —', FALSE);

        $price_by_section = array();
        foreach ($price as $one) {
            if (!empty($one['id'])) {
                if (!empty($one['price_section'])) {
                    if (empty($price_by_section[$one['price_section']])) {
                        $price_by_section[$one['price_section']] = array();
                    }
                    $price_by_section[$one['price_section']][$one['id']] = $one['name'];
                } else {
                    if (empty($price_by_section[0])) {
                        $price_by_section[0] = array();
                    }
                    $price_by_section[0][$one['id']] = $one['name'];
                }
            }
        }
        $price = $price_by_section;
        unset($price_by_section);

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('pricetableCreate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['create']);
            }
            if(is_array($model->price)){
                $model_price = array();
                foreach ($model->price as $one_model_price) {
                    if (!empty($one_model_price) && is_array($one_model_price)) {
                        $model_price = array_merge($model_price, $one_model_price);
                    }
                }
                $model->price = $model_price;
                unset($model_price);
                if (is_array($model->price)) {
                    $model->price = implode(',', $model->price);
                }
            }
            if ($model->validate()) {
                $model->price = \app\helpers\CustomHelper::custom_empty_to_null($model->price);
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
            'price' => $price,
            'price_section' => $price_section,
        ]);
    }

    /**
     * Updates an existing Pricetable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->can('pricetableUpdate');
        $model = $this->findModel($id);
        $model->price = explode(',', $model->price);

        $price = Price::find()->select(['id', 'name', 'price_section'])->asArray()->all();
        // $price = \app\helpers\CustomHelper::customParamArray($price, 'id', 'name');
        // $price = \app\helpers\CustomHelper::custom_array_unshift($price, '— Выбрать —', FALSE);

        $price_section = PriceSection::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $price_section = \app\helpers\CustomHelper::customParamArray($price_section, 'id', 'name');
        $price_section = \app\helpers\CustomHelper::custom_array_unshift($price_section, '— Выбрать —', FALSE);

        $price_by_section = array();
        foreach ($price as $one) {
            if (!empty($one['id'])) {
                if (!empty($one['price_section'])) {
                    if (empty($price_by_section[$one['price_section']])) {
                        $price_by_section[$one['price_section']] = array();
                    }
                    $price_by_section[$one['price_section']][$one['id']] = $one['name'];
                } else {
                    if (empty($price_by_section[0])) {
                        $price_by_section[0] = array();
                    }
                    $price_by_section[0][$one['id']] = $one['name'];
                }
            }
        }
        $price = $price_by_section;
        unset($price_by_section);

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('pricetableUpdate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['update', 'id' => $id]);
            }

            if(is_array($model->price)){
                $model_price = array();
                foreach ($model->price as $one_model_price) {
                    if (!empty($one_model_price) && is_array($one_model_price)) {
                        $model_price = array_merge($model_price, $one_model_price);
                    }
                }
                $model->price = $model_price;
                unset($model_price);
                if (is_array($model->price)) {
                    $model->price = implode(',', $model->price);
                }
            }
            if ($model->validate()) {
                $model->price = \app\helpers\CustomHelper::custom_empty_to_null($model->price);
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
            'price' => $price,
            'price_section' => $price_section,
        ]);
    }

    /**
     * Deletes an existing Pricetable model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->can('pricetableDelete');
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
     * Finds the Pricetable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Pricetable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pricetable::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

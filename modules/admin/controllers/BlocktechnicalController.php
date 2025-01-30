<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Blocktechnical;
use app\modules\admin\models\BlocktechnicalSearch;
use app\modules\admin\models\Menu;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlocktechnicalController implements the CRUD actions for Blocktechnical model.
 */
class BlocktechnicalController extends AppController
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
     * Lists all Blocktechnical models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->can('blocktechnicalView');
        $searchModel = new BlocktechnicalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $menu = Menu::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $menu = \app\helpers\CustomHelper::customParamArray($menu, 'id', 'name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'menu' => $menu,
        ]);
    }

    /**
     * Displays a single Blocktechnical model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->can('blocktechnicalView');
        $model = $this->findModel($id);

        $menu = Menu::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $menu = \app\helpers\CustomHelper::customParamArray($menu, 'id', 'name');
        
        return $this->render('view', [
            'model' => $model,
            'menu' => $menu,
        ]);
    }

    /**
     * Creates a new Blocktechnical model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->can('blocktechnicalView');
        $model = new Blocktechnical();

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('blocktechnicalCreate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['create']);
            }
            if ($model->validate()) {
                $model->header = \app\helpers\CustomHelper::custom_empty_to_null($model->header);
                $model->subtitle = \app\helpers\CustomHelper::custom_empty_to_null($model->subtitle);
                $model->image = \app\helpers\CustomHelper::custom_empty_to_null($model->image);
                $model->item = \app\helpers\CustomHelper::custom_empty_to_null($model->item);
                $model->button = \app\helpers\CustomHelper::custom_empty_to_null($model->button);
                $model->note = \app\helpers\CustomHelper::custom_empty_to_null($model->note);
                $model->form = \app\helpers\CustomHelper::custom_empty_to_null($model->form);
                $model->menu1 = \app\helpers\CustomHelper::custom_empty_to_null($model->menu1);
                $model->menu2 = \app\helpers\CustomHelper::custom_empty_to_null($model->menu2);
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

        $menu = Menu::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $menu = \app\helpers\CustomHelper::customParamArray($menu, 'id', 'name');
        $menu = \app\helpers\CustomHelper::custom_array_unshift($menu, '— Выбрать —', FALSE);

        return $this->render('create', [
            'model' => $model,
            'menu' => $menu,
        ]);
    }

    /**
     * Updates an existing Blocktechnical model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->can('blocktechnicalView');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('blocktechnicalUpdate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['update', 'id' => $id]);
            }
            if ($model->validate()) {
                $model->header = \app\helpers\CustomHelper::custom_empty_to_null($model->header);
                $model->subtitle = \app\helpers\CustomHelper::custom_empty_to_null($model->subtitle);
                $model->image = \app\helpers\CustomHelper::custom_empty_to_null($model->image);
                $model->item = \app\helpers\CustomHelper::custom_empty_to_null($model->item);
                $model->button = \app\helpers\CustomHelper::custom_empty_to_null($model->button);
                $model->note = \app\helpers\CustomHelper::custom_empty_to_null($model->note);
                $model->form = \app\helpers\CustomHelper::custom_empty_to_null($model->form);
                $model->menu1 = \app\helpers\CustomHelper::custom_empty_to_null($model->menu1);
                $model->menu2 = \app\helpers\CustomHelper::custom_empty_to_null($model->menu2);
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

        $menu = Menu::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        $menu = \app\helpers\CustomHelper::customParamArray($menu, 'id', 'name');
        $menu = \app\helpers\CustomHelper::custom_array_unshift($menu, '— Выбрать —', FALSE);

        return $this->render('update', [
            'model' => $model,
            'menu' => $menu,
        ]);
    }

    /**
     * Deletes an existing Blocktechnical model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->can('blocktechnicalDelete');
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
     * Finds the Blocktechnical model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blocktechnical the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blocktechnical::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

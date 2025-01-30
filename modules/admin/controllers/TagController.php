<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Tag;
use app\modules\admin\models\TagSearch;
use app\modules\admin\models\City;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TagController implements the CRUD actions for Tag model.
 */
class TagController extends AppController
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
     * Lists all Tag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->can('tagView');
        $searchModel = new TagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'city' => $city,
        ]);
    }

    /**
     * Displays a single Tag model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->can('tagView');
        $model = $this->findModel($id);
        $model->city = explode(',', $model->city);

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');
        
        return $this->render('view', [
            'model' => $model,
            'city' => $city,
        ]);
    }

    /**
     * Creates a new Tag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->can('tagView');
        // $this->can('tagCreate');
        $model = new Tag();

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('tagCreate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['create']);
            }
            if(is_array($model->city)) $model->city = implode(',', $model->city);
            if ($model->validate()) {
                $model->text = \app\helpers\CustomHelper::custom_empty_to_null($model->text);
                $model->city = \app\helpers\CustomHelper::custom_empty_to_null($model->city);
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

        $tag_disposition = \app\helpers\CustomHelper::custom_array_unshift(Yii::$app->params['tag_disposition'], '— Выбрать —', FALSE);

        return $this->render('create', [
            'model' => $model,
            'city' => $city,
            'tag_disposition' => $tag_disposition,
        ]);
    }

    /**
     * Updates an existing Tag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->can('tagView');
        // $this->can('tagUpdate');
        $model = $this->findModel($id);
        $model->city = explode(',', $model->city);

        $city = City::find()->select(['id', 'name'])->asArray()->all();
        $city = \app\helpers\CustomHelper::customParamArray($city, 'id', 'name');

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->can('tagUpdate')) {
                Yii::$app->session->setFlash('error', 'Недостаточно прав!');
                return $this->redirect(['update', 'id' => $id]);
            }
            if(is_array($model->city)) $model->city = implode(',', $model->city);
            if ($model->validate()) {
                $model->text = \app\helpers\CustomHelper::custom_empty_to_null($model->text);
                $model->city = \app\helpers\CustomHelper::custom_empty_to_null($model->city);
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

        $tag_disposition = \app\helpers\CustomHelper::custom_array_unshift(Yii::$app->params['tag_disposition'], '— Выбрать —', FALSE);

        return $this->render('update', [
            'model' => $model,
            'city' => $city,
            'tag_disposition' => $tag_disposition,
        ]);
    }

    /**
     * Deletes an existing Tag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->can('tagDelete');
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
     * Finds the Tag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Tag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Массовое редактирование тегов
     */
    public function actionMassUpdate($visible)
    {
        $act = (!empty($visible)) ? 'включить' : 'скрыть';

        if (!Yii::$app->user->can('tagUpdate')) {
            Yii::$app->session->setFlash('error', "Не удалось {$act} теги. Доступ закрыт.");
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->post()) {
            
            $post = Yii::$app->request->post();
            if (!empty($post) && !empty($post['tags'])) {
                $tags = preg_replace('/[^\d,]/', '', $post['tags']);
                if (!empty($tags)) {
                    $tags = explode(',', $tags);
                    if (!empty($tags) && is_array($tags)) {

                        if (!empty($visible)) {
                            $res = Tag::updateAll(['visible' => 1], ['id' => $tags]);
                        } else {
                            $res = Tag::updateAll(['visible' => 0], ['id' => $tags]);
                        }

                        if (!empty($res)) {
                            $message = (!empty($visible)) ? "Включено {$res} тегов" : "Скрыто {$res} тегов";
                            Yii::$app->session->setFlash('success', $message);
                            return $this->redirect(['index']);
                        }
                    }
                }
            }
        }
        Yii::$app->session->setFlash('error', "Не удалось {$act} теги");
        return $this->redirect(['index']);
    }
}

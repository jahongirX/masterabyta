<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use app\helpers\CustomHelper;


class AppController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        if(!session_id()) session_start();
        if(isset(Yii::$app->request->get()['per-page']) && !empty(Yii::$app->request->get()['per-page'])){
            $_SESSION['per-page'] = (int) Yii::$app->request->get()['per-page'];
        }
        if(!isset($_SESSION['per-page']) || empty($_SESSION['per-page'])){
            $_SESSION['per-page'] = 20;
        }
        if($_SESSION['per-page'] < 1){
            $_SESSION['per-page'] = 1;
        }
        if($_SESSION['per-page'] > 500){
            $_SESSION['per-page'] = 500;
        }
    }

    /**
     * Удаляем изображение (плагин CostaRico/yii2-images)
     */
    public function actionRemoveImage($id, $image)
    {
        $model = $this->findModel($id);
        $number = (int) $image;
        $images = $model->getImages();
        if( $images[$number] ){
            $model->removeImage($images[$number]);
            Yii::$app->session->setFlash('success', 'Изображение удалено.');
        }else{
            Yii::$app->session->setFlash('error', 'Не удалось удалить изображение!');
        }
        return $this->redirect(['update', 'id' => $model->id]);
    }



    /**
     * Удаляем изображение или файл (кастомно)
     * @param string $id
     */
    public function actionCustomRemoveFile($id, $param, $redirect = null)
    {
        $id = (int) $id;
        $model = $this->findModel($id);
        $class_name = CustomHelper::getClassName($model);

        $action = $class_name. 'FileRemove';
        if (!Yii::$app->user->can($action)) {
            Yii::$app->session->setFlash('error', 'Недостаточно прав для удаления файлов!');
            if (!empty($redirect)) {
                header('Location: '.$redirect);
                exit;
            }
            return $this->redirect(['update', 'id' => $id]);
        }

        if(isset($model->$param)){
            $image = Yii::getAlias('@webroot') . '/upload/custom/'.$class_name.'/' . $model->id . '/' . $param . '/' . $model->$param;
            if(file_exists($image)) @unlink($image);
            $model->$param = null;
            $model->save(false);
            Yii::$app->session->setFlash('success', 'Файл удален.');
            if (!empty($redirect)) {
                header('Location: '.$redirect);
                exit;
            }
            return $this->redirect(['update', 'id' => $id]);
        } else {
            Yii::$app->session->setFlash('error', 'Не удалось удалить файл!');
            if (!empty($redirect)) {
                header('Location: '.$redirect);
                exit;
            }
            return $this->redirect(['update', 'id' => $id]);
        }
    }


    /**
     * Проверяем права доступа к действию
     */
    protected function can($action)
    {
        if (!Yii::$app->user->can($action)) {
            throw new \yii\web\ForbiddenHttpException('Доступ закрыт.');
            Yii::$app->end();
        }
    }


    /**
     * Удаляем изображения, перед удалением поста (кастомно)
     */
    protected function beforeDelete($model)
    {
        // удаляем папку с кастомными файлами
        $class_name = CustomHelper::getClassName($model);
        $dir = Yii::getAlias('@webroot') . '/upload/custom/' . $class_name . '/' . $model->id;
        if(is_dir($dir)) CustomHelper::remDir($dir);

        // удаляем изображения галереи (плагин CostaRico/yii2-images)
        if($model->hasMethod('getImages')){
            $images = $model->getImages();
            $count_images = count($images);
            for($i=0; $i<$count_images; $i++){
                if( $images[$i] ) $model->removeImage($images[$i]);
            }
        }
        return true;
    }


    /**
     * Удаляем изображение при загрузке нового (кастомно)
     */
    protected function removeOldImage($image_old, $image_new, $id, $param){
        if($image_old != $image_new){
            $model = $this->findModel($id);
            $class_name = CustomHelper::getClassName($model);
            $image_old = Yii::getAlias('@webroot') . '/upload/custom/' . $class_name . '/' . $model->id . '/' . $param . '/' . $image_old;
            if(file_exists($image_old)) @unlink($image_old);
        }
    }



}


?>
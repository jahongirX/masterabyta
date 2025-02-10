<?php


namespace app\widgets;


use app\models\Page;
use app\models\Review;
use yii\bootstrap\Widget;

class Testimonials extends Widget
{
    public function run()
    {
        $models = Review::find()->where(['visible' => 1])->orderBy(['date' => SORT_DESC])->limit(10)->all();
        return $this->render('testimonials' , [
            'models' => $models,
        ]);
    }
}
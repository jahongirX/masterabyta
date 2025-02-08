<?php


namespace app\widgets;


use yii\bootstrap\Widget;

class Testimonials extends Widget
{
    public function run()
    {
        return $this->render('testimonials');
    }
}
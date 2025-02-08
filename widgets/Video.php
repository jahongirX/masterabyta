<?php


namespace app\widgets;


use yii\bootstrap\Widget;

class Video extends Widget
{
    public function run(){
        return $this->render('video');
    }
}
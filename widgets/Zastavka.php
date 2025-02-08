<?php


namespace app\widgets;


use yii\bootstrap\Widget;

class Zastavka extends Widget
{
    public function run(){
        return $this->render('zastavka');
    }
}
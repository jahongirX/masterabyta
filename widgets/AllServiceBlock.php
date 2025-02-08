<?php


namespace app\widgets;


use yii\bootstrap\Widget;

class AllServiceBlock extends Widget
{
    public function run()
    {
        return $this->render('all-service-block');
    }
}
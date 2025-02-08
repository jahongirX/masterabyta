<?php


namespace app\widgets;


use yii\bootstrap\Widget;

class AllWidgets extends Widget
{
    public function run()
    {
        return $this->render('all-widgets');
    }
}
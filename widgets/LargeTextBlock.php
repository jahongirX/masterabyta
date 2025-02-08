<?php


namespace app\widgets;


use yii\bootstrap\Widget;

class LargeTextBlock extends Widget
{
    public function run()
    {
        return $this->render('large-text-block');
    }
}
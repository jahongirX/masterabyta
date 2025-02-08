<?php


namespace app\widgets;


use yii\bootstrap\Widget;

class TextBlock extends Widget
{
    public function run()
    {
        return $this->render('text-block');
    }
}
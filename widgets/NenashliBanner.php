<?php


namespace app\widgets;


use yii\bootstrap\Widget;

class NenashliBanner extends Widget
{
    public function run()
    {
        return $this->render('nenashli-banner');
    }
}
<?php


namespace app\widgets;


use yii\bootstrap\Widget;

class OrderServiceBanner extends Widget
{
    public function run()
    {
        return $this->render('order-service');
    }
}
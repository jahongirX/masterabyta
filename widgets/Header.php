<?php


namespace app\widgets;


use app\models\Menu;
use yii\bootstrap\Widget;

class Header extends Widget
{
    public function run(){
        $models = Menu::getActiveMenus();
        return $this->render('header' , [
            'models' => $models
        ]);
    }
}
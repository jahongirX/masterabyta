<?php


namespace app\widgets;


use app\modules\admin\models\Master;
use yii\bootstrap\Widget;

class Masters extends Widget
{
    public function run()
    {
        $models = Master::find()->where(['visible' => 1])->all();
        return $this->render('masters' , ['models' => $models]);
    }
}
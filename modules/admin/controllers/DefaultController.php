<?php

namespace app\modules\admin\controllers;

use Yii;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AppController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }



    /**
     * Экспорт данных из БД в файл
     */
    public function actionDbExport(){
        $data = array();
        $models = array();
        $models[] = \app\modules\admin\models\Banner::find()->all();
        $models[] = \app\modules\admin\models\Blocktechnical::find()->all();
        $models[] = \app\modules\admin\models\City::find()->all();
        // $models[] = \app\modules\admin\models\Content::find()->all();
        $models[] = \app\modules\admin\models\Master::find()->all();
        $models[] = \app\modules\admin\models\Menu::find()->all();
        $models[] = \app\modules\admin\models\Page::find()->all();
        $models[] = \app\modules\admin\models\Partner::find()->all();
        $models[] = \app\modules\admin\models\Partnercontact::find()->all();
        $models[] = \app\modules\admin\models\Price::find()->all();
        $models[] = \app\modules\admin\models\PriceSection::find()->all();
        $models[] = \app\modules\admin\models\Pricetable::find()->all();
        $models[] = \app\modules\admin\models\Pricetablehtml::find()->all();
        $models[] = \app\modules\admin\models\Redirect::find()->all();
        $models[] = \app\modules\admin\models\Request::find()->all();
        $models[] = \app\modules\admin\models\Review::find()->all();
        $models[] = \app\modules\admin\models\Setting::find()->all();
        $models[] = \app\modules\admin\models\Tag::find()->all();
        $models[] = \app\modules\admin\models\User::find()->all();

        if (!empty($models) && is_array($models)) {
            foreach ($models as $model) {
                if (!empty($model[0])) {
                    $tableName = $model[0]->tableName();
                    $tableData = array();
                    $model_count = count($model);
                    for ($i=0; $i < $model_count; $i++) { 
                        $tableData[] = $model[$i]->getAttributes();
                    }
                    $data[$tableName] = $tableData;
                }
            }
        }
        $data = json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        $filename = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'export-' . date('Y-m-d') . '.txt';
        @file_put_contents($filename, $data);
        // var_dump($filename);
        exit;
    }


    /**
     * Генерируем индексы для поиска по страницам
     */
    public function actionGenerateSearchIndex()
    {
        $page = \app\modules\admin\models\Page::find()->orderBy(['id' => SORT_ASC])->asArray()->all();
        if (!empty($page)) {
            foreach ($page as $one) {
                // создаем поисковой индекс
                \app\modules\admin\models\Searchindex::create($one['id'], $one['name'], $one['permalink'], $one['visible']);
            }
        }
        $searchindex = \app\modules\admin\models\Searchindex::find()->select(['id', 'page_id', 'page_name', 'page_alias', 'page_visible'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        \app\helpers\CustomHelper::debug($searchindex);
    }


}

<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\CurlHelper;
use app\helpers\UrlHelper;

/**
 * This is the model class for table "{{%searchindex}}".
 *
 * @property int $id
 * @property int $page_id
 * @property string|null $page_name
 * @property string|null $page_alias
 * @property string|null $text
 */
class Searchindex extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%searchindex}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id'], 'required'],
            [['page_id'], 'integer'],
            [['text'], 'string'],
            [['page_name', 'page_alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'page_name' => 'Page Name',
            'page_alias' => 'Page Alias',
            'text' => 'Text',
        ];
    }

    public static function create($pageId, $pageName, $pageAlias, $pageVisible){

        $url = UrlHelper::to(['page' => $pageAlias]);

        $data = CurlHelper::newObj()->get($url)->body();
        if ($data) {
            $data = preg_replace('#<header(.*?)>(.*?)</header>#is', '', $data);
            $data = preg_replace('#<footer(.*?)>(.*?)</body>#is', '</body>', $data);
            $data = preg_replace('#<aside(.*?)>(.*?)</aside>#is', '', $data);
            $data = preg_replace('#<style(.*?)>(.*?)</style>#is', '', $data);
            $data = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $data);
            $data = strip_tags($data);
            $data = preg_replace('#\s+#', ' ', $data);

            $model = static::find()->andWhere(['page_id' => $pageId])->limit(1)->one();
            if (empty($model)) {
                $model = new static();
            }
            $model->page_id = $pageId;
            $model->page_name = $pageName;
            $model->page_alias = $pageAlias;
            $model->page_visible = $pageVisible;
            $model->text = \app\helpers\CustomHelper::custom_empty_to_null($data);
            if ($model->validate() && $model->save()) {
                return true;
            }
        }
        return false;
    }

}

<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent
 * @property int $template
 * @property string $permalink
 * @property string|null $redirect
 * @property string|null $title
 * @property string|null $description
 * @property string|null $image
 * @property string|null $tag_header
 * @property string|null $tag_body
 * @property string|null $content
 * @property string|null $content_aside
 * @property int|null $content_two_title_on
 * @property string|null $content_two_title
 * @property int|null $content_two_on
 * @property string|null $content_two
 * @property int|null $skryt_na_poddomene
 * @property string|null $city
 * @property int|null $sh_pricerow
 * @property string|null $customprice
 * @property string|null $table
 * @property string|null $after_table
 * @property int|null $banner_id
 * @property int|null $sidebar_visible
 * @property string|null $sidebar_menu
 * @property int|null $block_leadback_price_visible
 * @property int|null $block_masters_visible
 * @property int|null $block_reviews_visible
 * @property int|null $block_benefits_visible
 * @property int|null $block_how_we_work_visible
 * @property string|null $block_how_we_work_4_title
 * @property string|null $block_how_we_work_4_text
 * @property int|null $block_ulicy_visible
 * @property int|null $block_districts_visible
 * @property int|null $block_leadback_visible
 * @property int $visible
 * @property int|null $date_create
 * @property int|null $lastmod
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'template', 'permalink'], 'required'],
            [['parent', 'template', 'content_two_title_on', 'content_two_on', 'skryt_na_poddomene', 'sh_pricerow', 'banner_id', 'sidebar_visible', 'block_leadback_price_visible', 'block_masters_visible', 'block_reviews_visible', 'block_benefits_visible', 'block_how_we_work_visible', 'block_ulicy_visible', 'block_districts_visible', 'block_leadback_visible', 'visible', 'date_create', 'lastmod'], 'default', 'value' => null],
            [['parent', 'template', 'content_two_title_on', 'content_two_on', 'skryt_na_poddomene', 'sh_pricerow', 'banner_id', 'sidebar_visible', 'block_leadback_price_visible', 'block_masters_visible', 'block_reviews_visible', 'block_benefits_visible', 'block_how_we_work_visible', 'block_ulicy_visible', 'block_districts_visible', 'block_leadback_visible', 'visible'], 'integer'],
            [['tag_header', 'tag_body', 'content', 'content_aside', 'content_two', 'content_two_aside', 'customprice', 'table', 'after_table', 'block_how_we_work_4_text'], 'string'],
            [['name', 'permalink', 'redirect', 'title', 'description', 'image', 'content_two_title', 'sidebar_menu', 'block_how_we_work_4_title'], 'string', 'max' => 255],
            [['date_create', 'lastmod'], 'safe'],
            [['city'], 'safe'],
            [['permalink'], 'unique'],
            [['permalink'], 'match', 'pattern' => '/^[\da-z-\/]+$/', 'message' => 'Только буквы (a-z), цифры (0-9), слеш (/) и дефис (-)'],
            [['permalink'], 'filter', 'filter' => function($value){
                $value = trim($value);
                $value = trim($value, '/');
                if ($value === '') {
                    $value = '/';
                }
                return $value;
            }],
            [['permalink'], 'filter', 'filter' => function($value){
                $value = trim($value);
                $value = trim($value, '/');
                if ($value !== '') {
                    $value = preg_replace('@^((metro|master)/)+@', '', $value);
                    $value = 'metro/'.$value;
                }
                return $value;
            }, 'when' => function ($model) {
                return $model->template == 14;
            }],
            [['permalink'], 'filter', 'filter' => function($value){
                $value = trim($value);
                $value = trim($value, '/');
                if ($value !== '') {
                    $value = preg_replace('@^((metro|master)/)+@', '', $value);
                    $value = 'master/'.$value;
                }
                return $value;
            }, 'when' => function ($model) {
                return $model->template == 18;
            }],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent' => 'Parent',
            'template' => 'Template',
            'permalink' => 'Permalink',
            'redirect' => 'Redirect',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'tag_header' => 'Tag Header',
            'tag_body' => 'Tag Body',
            'content' => 'Content',
            'content_aside' => 'Content Aside',
            'content_two_title_on' => 'Content Two Title Visible',
            'content_two_title' => 'Content Two Title',
            'content_two_on' => 'Content Two Visible',
            'content_two' => 'Content Two',
            'content_aside' => 'Content Two Aside',
            'skryt_na_poddomene' => 'Skryt Na Poddomene',
            'city' => 'City',
            'sh_pricerow' => 'Sh Pricerow',
            'customprice' => 'Customprice',
            'table' => 'Table',
            'after_table' => 'After Table',
            'banner_id' => 'Banner ID',
            'sidebar_visible' => 'Sidebar Visible',
            'sidebar_menu' => 'Sidebar Menu',
            'block_leadback_price_visible' => 'Block Leadback Price Visible',
            'block_masters_visible' => 'Block Masters Visible',
            'block_reviews_visible' => 'Block Reviews Visible',
            'block_benefits_visible' => 'Block Benefits Visible',
            'block_how_we_work_visible' => 'Block How We Work Visible',
            'block_how_we_work_4_title' => 'Block How We Work 4 Title',
            'block_how_we_work_4_text' => 'Block How We Work 4 Text',
            'block_ulicy_visible' => 'Block Ulicy Visible',
            'block_districts_visible' => 'Block Districts Visible',
            'block_leadback_visible' => 'Block Leadback Visible',
            'visible' => 'Visible',
            'date_create' => 'Date create',
            'lastmod' => 'Date edit',
        ];
    }
}

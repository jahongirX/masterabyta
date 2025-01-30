<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%banner}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $header
 * @property int $use_page_header
 * @property string|null $subtitle
 * @property string|null $image
 * @property string|null $item1
 * @property string|null $item2
 * @property string|null $item3
 * @property string|null $item4
 * @property string|null $ico1
 * @property string|null $ico2
 * @property string|null $ico3
 * @property string|null $ico4
 * @property string|null $form
 * @property string|null $button
 * @property string|null $note
 * @property int $visible
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%banner}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
            [['form', 'note'], 'string'],
            [['visible', 'use_page_header'], 'integer'],
            [['visible', 'use_page_header'], 'default', 'value' => 0],
            [['name', 'header', 'subtitle', 'image', 'button'], 'string', 'max' => 255],
            [['item1', 'item2', 'item3', 'item4'], 'string', 'max' => 255],
            [['ico1', 'ico2', 'ico3', 'ico4'], 'string', 'max' => 255],
            [['item1', 'item2', 'item3', 'item4'], 'default', 'value' => null],
            [['ico1', 'ico2', 'ico3', 'ico4'], 'default', 'value' => null],
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
            'header' => 'Header',
            'use_page_header' => 'Use page header',
            'subtitle' => 'Subtitle',
            'image' => 'Image',
            'item1' => 'Item 1',
            'item2' => 'Item 2',
            'item3' => 'Item 3',
            'item4' => 'Item 4',
            'ico1' => 'Ico 1',
            'ico2' => 'Ico 2',
            'ico3' => 'Ico 3',
            'ico4' => 'Ico 4',
            'form' => 'Form',
            'button' => 'Button',
            'note' => 'Note',
            'visible' => 'Visible',
        ];
    }
}

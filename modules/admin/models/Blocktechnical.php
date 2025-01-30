<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%blocktechnical}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $header
 * @property string|null $subtitle
 * @property string|null $image
 * @property string|null $item
 * @property string|null $button
 * @property string|null $note
 * @property string|null $form
 * @property int|null $menu1
 * @property int|null $menu2
 * @property int $visible
 */
class Blocktechnical extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blocktechnical}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['item', 'note', 'form'], 'string'],
            [['menu1', 'menu2', 'visible'], 'default', 'value' => null],
            [['menu1', 'menu2', 'visible'], 'integer'],
            [['name', 'header', 'subtitle', 'image', 'button'], 'string', 'max' => 255],
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
            'subtitle' => 'Subtitle',
            'image' => 'Image',
            'item' => 'Item',
            'button' => 'Button',
            'note' => 'Note',
            'form' => 'Form',
            'menu1' => 'Menu 1',
            'menu2' => 'Menu 2',
            'visible' => 'Visible',
        ];
    }
}

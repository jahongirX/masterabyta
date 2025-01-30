<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $header
 * @property string|null $image
 * @property string|null $menu
 * @property int $visible
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['visible'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255],
            [['header'], 'string', 'max' => 1200],
            [['menu'], 'string'],
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
            'image' => 'Image',
            'menu' => 'Menu',
            'visible' => 'Visible',
        ];
    }
}

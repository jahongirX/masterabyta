<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%master}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property string|null $projects
 * @property string|null $experience
 * @property string|null $age
 * @property string|null $specialization
 * @property string|null $in_company
 * @property string|null $about
 * @property int|null $page
 * @property int|null $number
 * @property int $visible
 */
class Master extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%master}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['about'], 'string'],
            [['page'], 'unique'],
            [['number', 'page', 'visible'], 'default', 'value' => null],
            [['number', 'page', 'visible'], 'integer'],
            [['name', 'image', 'projects', 'experience', 'age', 'specialization', 'in_company'], 'string', 'max' => 255],
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
            'image' => 'Image',
            'projects' => 'Projects',
            'experience' => 'Experience',
            'age' => 'Age',
            'specialization' => 'Specialization',
            'in_company' => 'In Company',
            'about' => 'About',
            'number' => 'Number',
            'page' => 'Page',
            'visible' => 'Visible',
        ];
    }
}

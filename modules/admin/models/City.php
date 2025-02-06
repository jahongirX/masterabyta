<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%city}}".
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property string|null $params
 * @property string|null $map
 * @property string|null $address
 * @property string|null $front_email
 * @property string|null $phone
 * @property string|null $wokrtime
 * @property int $price_type
 * @property string|null $back_email
 * @property string|null $district
 * @property string|null $street
 * @property string|null $metro
 * @property string|null $shortcode_remont
 * @property string|null $tag_header
 * @property string|null $tag_body
 * @property string|null $robots_txt
 * @property int|null $number
 * @property int $visible
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['params', 'map', 'district', 'street', 'metro', 'shortcode_remont', 'tag_header', 'tag_body', 'robots_txt','metro'], 'string'],
            [['price_type', 'number', 'visible'], 'default', 'value' => null],
            [['price_type', 'number', 'visible'], 'integer'],
            [['name', 'alias', 'address', 'front_email', 'phone', 'wokrtime', 'back_email'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['alias'], 'match', 'pattern' => '/^[\da-z-]+$/', 'message' => 'Только буквы (a-z), цифры (0-9) и дефис (-)'],
            [['name'], 'unique'],
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
            'alias' => 'Alias',
            'params' => 'Params',
            'map' => 'Map',
            'address' => 'Address',
            'front_email' => 'Front Email',
            'phone' => 'Phone',
            'wokrtime' => 'Wokrtime',
            'price_type' => 'Price Type',
            'back_email' => 'Back Email',
            'district' => 'District',
            'street' => 'Street',
            'metro' => 'Metro',
            'shortcode_remont' => 'Shortcode Remont',
            'tag_header' => 'Tag Header',
            'tag_body' => 'Tag Body',
            'robots_txt' => 'Robots Txt',
            'number' => 'Number',
            'visible' => 'Visible',
        ];
    }
}

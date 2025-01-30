<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%redirect}}".
 *
 * @property int $id
 * @property string $from_url
 * @property string $to_url
 * @property int $visible
 */
class Redirect extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%redirect}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_url', 'to_url'], 'required'],
            [['visible'], 'integer'],
            [['from_url', 'to_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_url' => 'URL From',
            'to_url' => 'URL To',
            'visible' => 'Visible',
        ];
    }
}

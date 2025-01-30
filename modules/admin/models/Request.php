<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "{{%request}}".
 *
 * @property int $id
 * @property string|null $phone
 * @property int|null $city
 * @property int|null $page
 * @property int|null $partner
 * @property string|null $rukiizplech_code
 * @property string|null $servicelead_code
 * @property int $date
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%request}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city', 'page', 'partner', 'rukiizplech_code', 'servicelead_code'], 'integer'],
            [['phone'], 'string', 'max' => 255],
            [['phone', 'city', 'page', 'partner', 'rukiizplech_code', 'servicelead_code'], 'default', 'value' => null],
            [['date'], 'trim'],
            [['date'], 'default', 'value' => null],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'city' => 'City',
            'page' => 'Page',
            'partner' => 'Partner ID',
            'rukiizplech_code' => 'Rukiizplech Code',
            'servicelead_code' => 'Servicelead Code',
            'date' => 'Date',
        ];
    }
}

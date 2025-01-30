<?php 

namespace app\modules\admin\models;

use yii\base\Model;

use app\helpers\CustomHelper;

class PartnerManageForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $city;
    public $page;

    public function rules()
    {
        return [
            [['city', 'page'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'city' => 'Города',
            'page' => 'Страницы',
        ];
    }
}


 ?>